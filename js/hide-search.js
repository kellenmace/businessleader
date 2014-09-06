/* 
 * Toggles search on and off
 */
jQuery(document).ready(function($){
    $('.search-toggle').click(function(){
    	$('.search-toggle').toggleClass('active');
        $('#search-container').slideToggle(200);

        // Hide mobile menu
        $('.menu-toggle').removeClass('active');
        $('.main-navigation').removeClass('toggled').css( "display", "none" );

        // Optional return false to avoid the page "jumping" when clicked
        return false;
    });
});

/* 
 * Apply parallax effect to featured image
 */
jQuery(document).ready(function($){
	$(window).scroll(function(e){
		var scrolled = $(window).scrollTop();
		$('.single-post-featured-image').css('top', -(scrolled * 0.2) + 'px');
	});
});