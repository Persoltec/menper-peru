// BEGIN HIDE MENU WHEN MENU ITEM CLICKED
jQuery('.touchy-by-bonfire ul li a').on('click touchend', function(e) {
'use strict';
    if(jQuery('.touchy-by-bonfire-wrapper').hasClass('touchy-menu-active'))
    {   
        /* hide accordion menu */
        jQuery(".touchy-by-bonfire-wrapper").removeClass("touchy-menu-active");
        /* hide menu button active colors */
        jQuery(".touchy-menu-button").removeClass("touchy-menu-button-active");
        /* hide close div */
        jQuery('.touchy-overlay').removeClass('touchy-overlay-active');
        
        /* close sub-menu */
        jQuery(".touchy-by-bonfire .menu > li").find(".sub-menu").delay(10).slideUp(350);
        jQuery(".touchy-by-bonfire .menu > li > span, .sub-menu > li > span").removeClass("touchy-submenu-active");
    }
});
// END HIDE MENU WHEN MENU ITEM CLICKED