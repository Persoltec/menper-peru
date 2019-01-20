<?php if( get_theme_mod('bonfire_touchy_hide_menu_button') == '') { ?>
<<?php if( get_theme_mod('bonfire_touchy_menu_button_link') != '') { ?>a<?php } else { ?>div<?php } ?> <?php if( get_theme_mod('bonfire_touchy_menu_button_new_tab') != '') { ?>target="_blank" <?php } ?>href="<?php if( get_theme_mod('bonfire_touchy_menu_button_link') != '') { ?><?php echo get_theme_mod('bonfire_touchy_menu_button_link'); ?><?php } ?>" class="touchy-menu-button<?php if( get_theme_mod('bonfire_touchy_menu_button_link') == '') { ?> touchy-toggle-menu<?php } ?>">
    <div class="touchy-menu-tooltip"></div>
    <span class="touchy-menu-text-label-offset">
        <?php if( get_theme_mod('bonfire_touchy_menu_icon') == '') { ?>
            <div class="touchy-default-menu"></div>
        <?php } else { ?>
            <i class="fa <?php echo get_theme_mod('bonfire_touchy_menu_icon'); ?>"></i>
        <?php } ?>
    </span>
</<?php if( get_theme_mod('bonfire_touchy_menu_button_link') != '') { ?>a<?php } else { ?>div<?php } ?>>
<?php } ?>