// Masonry settings to organize footer widgets
jQuery(document).ready(function($){
    var $container = $('#footer-widgets');
    var $masonryOn;
    var $columnWidth = 50;
    //var $gutter = 10;
    
    if ($(document).width() > 819) { // TODO: Change this breakpoint for footer // was 879
        $masonryOn = true;
        runMasonry();
    }

    $(window).resize( function() {
        if ($(document).width() < 819) { // TODO: Change this breakpoint for footer
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