( function() {
    /*
     * Handles toggling the navigation menu for small screens.
     */
    var container, button, menu;

    container = document.getElementById( 'site-navigation' );
    if ( ! container )
        return;

    //button = container.getElementsByTagName( 'button' )[0];
    button = document.getElementById( 'nav-menu-toggle' );
    if ( ! button )
        return;

    menu = container.getElementsByTagName( 'ul' )[0];
    // Hide menu toggle button if menu is empty and return early.
    if ( 'undefined' === typeof menu )
        return;

    if ( -1 === menu.className.indexOf( 'nav-menu' ) )
        menu.className += ' nav-menu';

    button.onclick = function() {
        if ( -1 !== container.className.indexOf( 'toggled' ) ) {
            container.className = container.className.replace( ' toggled', '' );
        }
        else
            container.className += ' toggled';
    };

    /*
     * Skip link focus fix
     */
    var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
        is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
        is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

    if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
        window.addEventListener( 'hashchange', function() {
            var element = document.getElementById( location.hash.substring( 1 ) );

            if ( element ) {
                if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
                    element.tabIndex = -1;

                element.focus();
            }
        }, false );
    }

} )();

jQuery(document).ready(function($){
    /*
     * set header image size automatically
     */
    // var $site_header_height = $('#masthead').height();
    // var $header_container_height = $('.header-container').height();
    // var $window = $(window).on('resize', function() {
    //     $('.header-image').css('height', $site_header_height + $header_container_height + 50);
    // }).trigger('resize');

    // var $site_content_position = $( '#content' ).offset();
    // $(window).on('resize', function() {
    //     $('.header-image').css('height', $site_content_position.top);
    // }).trigger('resize');
    

	/* 
	 * Apply parallax effect to header image
	 */
	$(window).scroll(function(e){
		var scrolled = $(window).scrollTop();
		$('.header-image').css('top', -(scrolled * 0.3) + 'px');
	});

	/* 
	 * Toggles mobile menu on and off
	 */
	// $('.menu-toggle').click(function(){
 //        $('.menu-toggle').toggleClass('active');
 //        $('.main-navigation').toggleClass('toggled').slideToggle(300);
 //    });
 //    $( window ).resize(function() {
 //        var win = $(this);
 //        if ( win.width() > 600 ) {
 //            $('.main-navigation').show();
 //        }
 //        else if ( win.width() <= 600 ) {
 //            $('.main-navigation').hide();
 //        }
 //    });

    /*
     * Masonry settings to organize image galleries
     */
    var $gallery_container = $('.gallery');
    gallery_runMasonry();
    
    function gallery_runMasonry() {
        // initialize
        $gallery_container.masonry({
            columnWidth: 8,
            itemSelector: '.gallery-item',
            isFitWidth: true,
            isAnimated: true
        });
    }

    /* 
	 * Masonry settings to organize footer widgets
	 */
    var $container = $( '#footer-widgets' ).masonry();
    enquire.register("screen and ( min-width:768px )", {

        // Triggered when a media query matches.
        match : function() {
            $container.masonry({
                columnWidth: 50,
                itemSelector: '.widget',
                isFitWidth: true,
                isAnimated: true
            });
        },

        // Triggered when the media query transitions 
        // from a matched state to an unmatched state
        unmatch : function() {
            $container.masonry( 'destroy' );
        }
    });
});