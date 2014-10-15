jQuery(document).ready(function($){

	/* 
	 * Apply parallax effect to featured image
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

        // Optional return false to avoid the page "jumping" when clicked
        return false;
    });

    /* 
	 * Masonry settings to organize footer widgets
	 */
    var $container = $('#footer-widgets');
    var $masonryOn;
    var $columnWidth = 50;
    //var $gutter = 10;
    
    if ($(document).width() > 819) {
        $masonryOn = true;
        runMasonry();
    }

    $(window).resize( function() {
        if ($(document).width() < 819) {
            if ($masonryOn){
                $container.masonry('destroy');
                $masonryOn = false;
            }

        } else {
            $masonryOn = true;
            runMasonry();
        }
    });
    
    function runMasonry() {
        // initialize
        $container.masonry({
            columnWidth: $columnWidth,
            //gutter: $gutter,
            itemSelector: '.widget',
            isFitWidth: true,
            isAnimated: true
        });
    }
});