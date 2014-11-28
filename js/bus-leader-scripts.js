( function() {
    /*
     * Handles toggling the navigation menu for small screens.
     */
    var container, button, menu;

    container = document.getElementById( 'site-navigation' );
    if ( ! container )
        return;

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
        else {
            container.className += ' toggled';
        }
        if ( -1 !== button.className.indexOf( 'clicked' ) ) {
            button.className = button.className.replace( ' clicked', '' );
        }
        else {
            button.className += ' clicked';
        }
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
	 * Apply parallax effect to header image
	 */
	$(window).scroll(function(e){
		var scrolled = $(window).scrollTop();
		$('.header-image').css('top', -(scrolled * 0.3) + 'px');
	});

    /* 
     * Custom Superfish settings for keyboard accessible nav menu
     */
    var sf= $('ul.nav-menu');
    enquire.register("screen and (min-width:1025px)", {

        // Triggered when a media query matches.
        match : function() {
            sf.superfish({
                delay: 200,
                speed: 'fast'
            });
        },

        // Triggered when the media query transitions
        // from a matched state to an unmatched state.
        unmatch : function() {
            sf.superfish('destroy');
        }
    });

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