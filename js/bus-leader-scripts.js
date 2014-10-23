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
	$('.menu-toggle').click(function(){
        $('.menu-toggle').toggleClass('active');
        $('.main-navigation').toggleClass('toggled').slideToggle(300);
    });
    $( window ).resize(function() {
        var win = $(this);
        if ( win.width() > 600 ) {
            $('.main-navigation').show();
        }
        else if ( win.width() <= 600 ) {
            $('.main-navigation').hide();
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