// BEGIN SHOW/HIDE MAIN MENU
jQuery('.touchy-toggle-menu').on('click touchend', function(e) {
'use strict';
e.preventDefault();
	if(jQuery('.touchy-by-bonfire-wrapper').hasClass('touchy-menu-active'))
	{
		/* hide accordion menu */
		jQuery(".touchy-by-bonfire-wrapper").removeClass("touchy-menu-active");
		/* hide menu button active colors */
		jQuery(".touchy-menu-button").removeClass("touchy-menu-button-active");
		/* hide close div */
		jQuery('.touchy-overlay').removeClass('touchy-overlay-active');
	} else {
        /* hide search button active colors */
		jQuery(".touchy-search-button").removeClass("touchy-search-button-active");
        /* hide search field */
		jQuery(".touchy-search-wrapper").removeClass("touchy-search-wrapper-active");
        /* un-focus search field */
        jQuery('input.touchy-search-field:text').blur();
		/* show accordion menu */
		jQuery(".touchy-by-bonfire-wrapper").addClass("touchy-menu-active");
		/* show menu button active colors */
		jQuery(".touchy-menu-button").addClass("touchy-menu-button-active");
		/* show close div */
		jQuery('.touchy-overlay').addClass('touchy-overlay-active');
	}
});
// END SHOW/HIDE MAIN MENU

// BEGIN HIDE MAIN MENU, SEARCH FIELD AND OVRLAY WHEN CLICKED/TAPPED ON CLOSE DIV
jQuery('.touchy-overlay-inner').on('click touchend', function(e) {
'use strict';
	/* hide accordion menu */
	jQuery(".touchy-by-bonfire-wrapper").removeClass("touchy-menu-active");
	/* hide menu button active colors */
	jQuery(".touchy-menu-button").removeClass("touchy-menu-button-active");
    /* hide search button active colors */
    jQuery(".touchy-search-button").removeClass("touchy-search-button-active");
    /* hide search field */
    jQuery(".touchy-search-wrapper").removeClass("touchy-search-wrapper-active");
	/* hide close div */
	jQuery('.touchy-overlay').removeClass('touchy-overlay-active');
});
// END HIDE MAIN MENU, SEARCH FIELD AND OVRLAY WHEN CLICKED/TAPPED ON CLOSE DIV

// BEGIN CONVERTING DEFAULT WP MENU TO A SLIDE-DOWN ONE
jQuery(document).ready(function ($) {
'use strict';
	/* add sub-menu arrow */
	$('.touchy-by-bonfire ul li ul').before($('<span class="touchy-sub-arrow"><span class="touchy-sub-arrow-inner"></span></span>'));

	/* accordion */
	$(".touchy-by-bonfire .menu > li > span, .touchy-by-bonfire .sub-menu > li > span").on('click touchend', function(e) {
	e.preventDefault();
        /* before opening/closing sub-menu, remove smooth scroll (iOS workaround) */
        $(".touchy-by-bonfire").removeClass("smooth-scroll");
        
            if (false == $(this).next().is(':visible')) {
                $(this).parent().siblings().find(".sub-menu").delay(10).slideUp(350);
                $(this).siblings().find(".sub-menu").delay(10).slideUp(350);
                $(this).parent().siblings().find("span").removeClass("touchy-submenu-active");
                $(this).siblings().find("span").removeClass("touchy-submenu-active");
            }
            $(this).next().delay(10).slideToggle(350);
            $(this).toggleClass("touchy-submenu-active");
        
        /* after opening/closing sub-menu, restore smooth scroll (iOS workaround) */
        setTimeout(function() {
            $(".touchy-by-bonfire").addClass("smooth-scroll");
        }, 400);
	})
	
	/* sub-menu arrow animation */
	$(".touchy-by-bonfire .menu > li > span").on('click touchend', function(e) {
	e.preventDefault();
		if($(".touchy-by-bonfire .sub-menu > li > span").hasClass('touchy-submenu-active'))
			{
				$(".touchy-by-bonfire .sub-menu > li > span").removeClass("touchy-submenu-active");
			}
	})

	/* close sub-menus when menu button, search button or overlay clicked */
	$(".touchy-menu-button, .touchy-overlay-inner, .touchy-toggle-search").on('click touchend', function(e) {
		if($(".touchy-by-bonfire .menu > li > span, .touchy-by-bonfire .sub-menu > li > span").hasClass('touchy-submenu-active'))
			{
				$(".touchy-by-bonfire .menu > li").find(".sub-menu").delay(10).slideUp(350);
				$(".touchy-by-bonfire .menu > li > span, .sub-menu > li > span").removeClass("touchy-submenu-active");
			}
	})
	
});
// END CONVERTING DEFAULT WP MENU TO A SLIDE-DOWN ONE

// BEGIN CLEAR SEARCH FIELD
jQuery(".touchy-clear-search").on('click touchend', function(e) {
'use strict';
    jQuery('input.touchy-search-field:text').val('').focus();
});
// END CLEAR SEARCH FIELD

// BEGIN OPEN/CLOSE SEARCH FIELD
jQuery(".touchy-toggle-search").on('click touchend', function(e) {
'use strict';
e.preventDefault();
	if(jQuery('.touchy-search-wrapper').hasClass('touchy-search-wrapper-active'))
	{
		/* hide search button active colors */
		jQuery(".touchy-search-button").removeClass("touchy-search-button-active");
        /* hide search field */
		jQuery(".touchy-search-wrapper").removeClass("touchy-search-wrapper-active");
        /* un-focus search field */
        jQuery('input.touchy-search-field:text').blur();
        /* remove close div */
		jQuery('.touchy-overlay').removeClass('touchy-overlay-active');
	} else {
        /* hide accordion menu */
		jQuery(".touchy-by-bonfire-wrapper").removeClass("touchy-menu-active");
		/* hide menu button active colors */
		jQuery(".touchy-menu-button").removeClass("touchy-menu-button-active");
        /* show search button active colors */
		jQuery(".touchy-search-button").addClass("touchy-search-button-active");
		/* show search field */
		jQuery(".touchy-search-wrapper").addClass("touchy-search-wrapper-active");
        /* focus search field */
        jQuery('input.touchy-search-field:text').focus();
        /* show close div */
		jQuery('.touchy-overlay').addClass('touchy-overlay-active');
	}
});
// END OPEN/CLOSE SEARCH FIELD