/* 
 * Apply parallax effect to featured image
 */
jQuery(document).ready(function($){
    $(window).scroll(function(e){
        var scrolled = $(window).scrollTop();
        $('.header-image').css('top', -(scrolled * 0.3) + 'px');
    });
});