/* 
 * Toggles mobile menu on and off
 */
jQuery(document).ready(function($){
    $('.menu-toggle').click(function(){
        $('.menu-toggle').toggleClass('active');
        $('.main-navigation').toggleClass('toggled').slideToggle(300);

        // Optional return false to avoid the page "jumping" when clicked
        return false;
    });
});