jQuery(document).ready(function ($) {
'use strict';
	/* accordion */
	$(".touchy-by-bonfire .menu > li.menu-item-has-children > a, .touchy-by-bonfire .sub-menu > li.menu-item-has-children > a").on('click touchend', function(e) {
	e.preventDefault();
		if (false == $(this).next().next().is(':visible')) {
			$(this).parent().siblings().find(".sub-menu").slideUp(300);
			$(this).siblings().find(".sub-menu").slideUp(300);
			$(this).parent().siblings().find("span").removeClass("touchy-submenu-active");
            $(this).siblings().find("span").removeClass("touchy-submenu-active");
		}
		$(this).next().next().slideToggle(300);
		$(this).next().toggleClass("touchy-submenu-active");
	})

	/* hover */
	$(".touchy-by-bonfire .menu > li.menu-item-has-children > a, .touchy-by-bonfire .sub-menu > li.menu-item-has-children > a").hover(
		function() {
			$(this).parent().addClass("full-item-arrow-hover");
		},
		function() {
			$(this).parent().removeClass("full-item-arrow-hover");
	});
	$(".touchy-by-bonfire .menu > li > span, .touchy-by-bonfire .sub-menu > li > span").hover(
		function() {
			$(this).parent().addClass("full-item-arrow-hover");
		},
		function() {
			$(this).parent().removeClass("full-item-arrow-hover");
	});
	
	/* sub-menu arrow animation */
	$(".touchy-by-bonfire .menu > li.menu-item-has-children > a").on('click touchend', function(e) {
	e.preventDefault();
		if($(".touchy-by-bonfire .sub-menu > li > span").hasClass('touchy-submenu-active'))
			{
				$(".touchy-by-bonfire .sub-menu > li > span").removeClass("touchy-submenu-active");
			}
	})
	
});