<?php if( get_theme_mod('bonfire_touchy_hide_search_button') == '') { ?>
    <a <?php if( get_theme_mod('bonfire_touchy_search_new_tab') != '') { ?>target="_blank" <?php } ?>href="<?php if( get_theme_mod('bonfire_touchy_search_link') != '') { ?><?php echo get_theme_mod('bonfire_touchy_search_link'); ?><?php } ?>" class="touchy-search-button<?php if( get_theme_mod('bonfire_touchy_search_link') == '') { ?> touchy-toggle-search<?php } ?>">
        <span class="touchy-search-text-label-offset">
            <?php if( get_theme_mod('bonfire_touchy_search_icon') == '') { ?>
                <div class="touchy-default-search-outer">
                    <div class="touchy-default-search-inner"></div>
                </div>
            <?php } else { ?>
                <i class="fa <?php echo get_theme_mod('bonfire_touchy_search_icon'); ?>"></i>
            <?php } ?>
        </span>
    </a>
<?php } ?>