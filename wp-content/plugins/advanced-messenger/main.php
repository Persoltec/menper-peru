<?php
/*
Plugin Name: Advanced Facebook Messenger Live-Chat
Plugin URI: social-streams.com/messenger
Description: Facebook Messenger live chat on every page of your site.
Version: 1.1.1
Author: Looks Awesome
Author URI: http://looks-awesome.com
License: Commercial License
Text Domain: nks-messenger
Domain Path: /lang
*/


global $nks_msg_options;

load_plugin_textdomain('nks-messenger', false, basename( dirname( __FILE__ ) ) . '/lang' );

if (!defined('NKS_MSG_VERSION_KEY')) {
    define('NKS_MSG_VERSION_KEY', 'nks_msg_version');
}

if (!defined('NKS_MSG_VERSION_NUM')) {
    define('NKS_MSG_VERSION_NUM', '1.1.1');
}

add_option(NKS_MSG_VERSION_KEY, NKS_MSG_VERSION_NUM);

add_action( 'admin_menu', 'nks_msg_menu' );


function nks_msg_menu() {
    add_options_page( 'Advanced FB Messenger', '<span style="display: inline-block;border-left:3px solid #0484ff; padding-left:3px;position: relative;left: -6px;">FB Messenger</span>', 'manage_options', 'nks_msg_options', 'nks_msg_page' );
}

add_action( 'admin_init', 'nks_msg_register_settings_page' );

function nks_msg_register_settings_page () {
    register_setting( 'nks_msg_options', 'nks_msg_options', '' );
}

/**
 * Settings page in the WP Admin
 */
function nks_msg_page() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.', 'nks-messenger' ) );
    }

    include_once(dirname(__FILE__) . '/settings.php');

    nks_msg_register_settings();

    wp_enqueue_script("jquery");
    wp_enqueue_script( 'nks_msg_tinycolor', plugins_url('/js/tinycolor.js', __FILE__) );
    wp_enqueue_script( 'nks_msg_colorpickersliders', plugins_url('/js/jquery.colorpickersliders.js', __FILE__) );
    wp_enqueue_script( 'nks_msg_admin', plugins_url('/js/admin.js', __FILE__) );

    //wp_register_style('open-sans-font', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300' );
    wp_register_style('nks_msg_lato_font', '//fonts.googleapis.com/css?family=Lato:300normal,400normal,400italic,600normal&subset=all' );
    wp_enqueue_style( 'nks_msg_lato_font' );

    wp_register_style('colorpickersliders-ui-css', plugins_url('/css/jquery.colorpickersliders.css', __FILE__));
    wp_enqueue_style( 'colorpickersliders-ui-css' );

    wp_register_style('nks-msg-admin-css', plugins_url('/css/admin.css', __FILE__));
    wp_enqueue_style( 'nks-msg-admin-css' );

    include_once(dirname(__FILE__) . '/options-page.php');
}


add_filter('plugin_action_links_advanced-messenger/main.php', 'nks_msg_plugin_action_links', 10, 1);

function nks_msg_plugin_action_links($links) {
    $settings_page = add_query_arg(array('page' => 'nks_msg_options'), admin_url('options-general.php'));
    $settings_link = '<a href="'.esc_url($settings_page).'">'.__('Settings', 'nks-messenger' ).'</a>';
    array_unshift($links, $settings_link);
    return $links;
}

add_action('wp_enqueue_scripts', 'nks_msg_scripts');

add_action('wp_head', 'nks_msg_dynamic_css');
add_action('wp_footer', 'nks_msg_main_html');

function nks_msg_scripts() {
    global $nks_msg_show;
    $options = nks_msg_get_options();
    $post_id = get_queried_object_id();
    if ($options['nks_msg_test_mode'] === 'yes' && !current_user_can( 'manage_options' ) ) return;

    $nks_msg_show = nks_msg_check_display_rule(json_decode($options['nks_msg_display']), wp_is_mobile(), $post_id);

    if ($nks_msg_show) {

        wp_enqueue_script(
            'nks_msg_main_js',
            plugins_url('/js/nks-messenger.js', __FILE__),
            array( 'jquery' )
        );

        $js_opts = array(
            'ajaxurl' => admin_url( 'admin-ajax.php', is_ssl() ),
            'sidebar_type' => $options['nks_msg_sidebar_type'],
            'theme' => $options['nks_msg_theme'],
            'sidebar_pos' => $options['nks_msg_sidebar_pos'],
            'base_color' => $options['nks_msg_base_color'],
            'label' => $options['nks_msg_label_style'],
            'label_top' => $options['nks_msg_label_top'],
            'label_vis' => $options['nks_msg_label_vis'],
            'label_tooltip' => $options['nks_msg_label_tooltip'],
            'label_tooltip_text' => $options['nks_msg_label_tooltip_text'],
            'label_scroll_selector' => $options['nks_msg_label_vis_selector'],
            'label_mouseover' => $options['nks_msg_label_mouseover'],
            'togglers' => $options['nks_msg_togglers'],
            'path' => plugins_url('/img/', __FILE__)
        );

        $js_opts['plugin_ver'] = NKS_MSG_VERSION_NUM;

        wp_localize_script( 'nks_msg_main_js', 'NksMessengerOpts', $js_opts);

//        wp_register_style( 'nks_msg_styles', plugins_url('/css/nks-messenger.css', __FILE__) );
//        wp_enqueue_style( 'nks_msg_styles' );
    }
}


function nks_msg_dynamic_css() {
    global $nks_msg_show;
    $options = nks_msg_get_options();
    if ($options['nks_msg_test_mode'] === 'yes' && !current_user_can( 'manage_options' ) ) return;

    if (isset($nks_msg_show) && $nks_msg_show) {
        include_once(dirname(__FILE__) . '/nks-msg-dynamic.php');
    }
}
function nks_msg_main_html() {
    global $nks_msg_show;
    $options = nks_msg_get_options();
    if ($options['nks_msg_test_mode'] === 'yes' && !current_user_can( 'manage_options' ) ) return;

    if (isset($nks_msg_show) && $nks_msg_show) {
        include_once(dirname(__FILE__) . '/nks-messenger.php');
    }
}

function nks_msg_is_mobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function nks_msg_get_lang_id($id, $type = 'page') {
    if ( function_exists('icl_object_id') ) {
        $id = icl_object_id($id, $type, true);
    }

    return $id;
}

function nks_msg_check_location ($opt, $post_id) {

    if ( is_home() ) {

        //browser()->log  ( 'home' );

        $show = isset($opt->location->wp_pages->home);
        if ( !$show && $post_id ){
            $show = isset($opt->location->pages->$post_id);
        }

        // check if blog page is front page too
        if ( !$show && is_front_page() /*&& isset($opt['page-front'])*/ ) {
            //browser()->log  ( 'home front' );
            $show = isset($opt->location->wp_pages->front);
        }

    } else if ( is_front_page() ) {
        //browser()->log  ( 'front' );

        $show = isset($opt->location->wp_pages->front);
        if ( !$show && $post_id ) {
            $show = isset($opt->location->pages->$post_id);
        }
    } else if ( is_category() ) {
        //browser()->log  ( 'cat' );
        //browser()->log  ( get_query_var('cat') );
        $catid = get_query_var('cat');
        $show = isset($opt->location->cats->$catid);
    } /*else if ( is_tax() ) {
				$term = get_queried_object();
				$tax = $term->taxonomy;
				$show = isset($opt->location->cats->$tax);
				unset($term);
				unset($tax);
			} else if ( is_post_type_archive() ) {
				$type = get_post_type();
				$show = isset($opt['type-'. $type .'-archive']) ? $opt['type-'. $type .'-archive'] : false;
			}*/ else if ( is_archive() ) {
        //browser()->log  ( 'archive' );

        $show = isset($opt->location->wp_pages->archive);
    } else if ( is_single() ) {
        //browser()->log  ( 'single' );

        $type = get_post_type();
        $show = isset($opt->location->wp_pages->single);

        if ( !$show  && $type != 'page' && $type != 'post') {
            $show = isset($opt->location->cposts->$type);
        }

        if ( !$show ) {
            $cats = get_the_category();
            foreach ( $cats as $cat ) {
                if ($show) break;
                $c_id = nks_msg_get_lang_id($cat->cat_ID, 'category');
                $show = isset($opt->location->cats->$c_id);
                unset($c_id);
                unset($cat);
            }
        }

    } else if ( is_404() ) {
        $show = isset($opt->location->wp_pages->forbidden);
        //browser()->log  ( '404' );
        //browser()->log  ( isset($opt->location->wp_pages->forbidden));

    } else if ( is_search() ) {
        //browser()->log  ( 'search' );

        $show = isset($opt->location->wp_pages->search);
    } else if ( $post_id ) {
        //browser()->log  ( 'post id' );

        $show = isset($opt->location->pages->$post_id);
    } else {
        //browser()->log  ( 'super else' );

        $show = false;
    }

    if ( $post_id && !$show && isset($opt->location->ids) && !empty($opt->location->ids) ) {
        //browser()->log  ( 'ids' );

        $other_ids = $opt->location->ids;
        foreach ( $other_ids as $other_id ) {
            if ( $post_id == (int) $other_id ) {
                $show = true;
            }
        }
    }

    if ( !$show && defined('ICL_LANGUAGE_CODE') ) {
        // check for WPML widgets
        $lang = ICL_LANGUAGE_CODE;
        $show = isset($opt->location->langs->$lang );
    }

    if ( !isset($show) ) {
        //browser()->log  ( '!isset($show)' );
        $show = false;
    }

    return $show;
}

function nks_msg_check_display_rule($opt, $isMobile, $post_id) {

    $show = nks_msg_check_location($opt, $post_id);

    //browser()->log  ( '>>>> inclusion' );
    //browser()->log  ( $show );

    if ($show && $opt->rule->exclude || !$show && $opt->rule->include ) {
        $show = false;
    } else  {
        $show = true;
    }

    $user_ID = is_user_logged_in();
    //browser()->log  ( '>>>> loggedin' );
    //browser()->log  ( $user_ID );
    //browser()->log  ( '>>>> checked' );
    //browser()->log  ( $show );

    if ( ( $opt->user->loggedout && $user_ID ) || ( $opt->user->loggedin && !$user_ID ) ) {
        $show = false;
    }

    if ( $opt->mobile->no && $isMobile) {
        $show = false;
    }

    return $show;
}

function nks_msg_upload_filter( $file ){
    $arr = wp_check_filetype(basename($file['name']));
    $type = $arr['type'];
    $file['name'] = 'nks_msg_userpic.' . str_replace('image/', '', $type);
    return $file;
}

function nks_msg_debug_to_console($data) {
    if(is_array($data) || is_object($data))
    {
        echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
    } else {
        echo("<script>console.log('PHP: ".$data."');</script>");
    }
}

global $nks_msg_cached_opts;

function nks_msg_get_options()
{
    global $nks_msg_cached_opts;

    if (isset($nks_msg_cached_opts)) return $nks_msg_cached_opts;

    $options = get_option('nks_msg_options');

    if (empty($options['nks_msg_forms'])) {
        $options['nks_msg_forms'] = 1;
    }

    if (empty($options['nks_msg_test_mode'])) {
        $options['nks_msg_test_mode'] = '';
    }
    if (empty($options['nks_msg_body'])) {
        $options['nks_msg_body'] = '';
    }

    if (empty($options['nks_msg_mc_token'])) {
        $options['nks_msg_mc_token'] = '';
    }
    if (empty($options['nks_msg_mc_lists'])) {
        $options['nks_msg_mc_lists'] = '';
    }
    if (empty($options['nks_msg_mc_list_id'])) {
        $options['nks_msg_mc_list_id'] = '';
    }
    if (empty($options['nks_msg_sub_question'])) {
        $options['nks_msg_sub_question'] = 'Subscribe to our news?';
    }

    if (strpos($_SERVER['REQUEST_URI'],'page=nks_msg_options')) $options['locations'] = nks_msg_get_locations();

    // THEME
    if (empty($options['nks_msg_theme'])) {
        $options['nks_msg_theme'] = 'minimalistic';
    }

    if (empty($options['nks_msg_flat_socialbar'])) {
        $options['nks_msg_flat_socialbar'] = 'top';
    }

    if (empty($options['nks_msg_invert_style'])) {
        $options['nks_msg_invert_style'] = '';
    }

    if (empty($options['nks_msg_custom_css'])) {
        $options['nks_msg_custom_css'] = '';
    }

    if (empty($options['nks_msg_base_color'])) {
        $options['nks_msg_base_color'] = '{"flat": "#2B93C0", "cube": "#c0392b", "minimalistic": "#50E3C2", "aerial": "#292929"}';
    }

    if (empty($options['nks_msg_color_schema'])) {
        $options['nks_msg_color_schema'] = '#c0392b,#cf4739,#cd3424,#d9593e,#c84c3f,#bb2d1f,#e96d3d,#e94e3d,#2f1420';
    }

    if (empty($options['nks_msg_rgba'])) {
        $options['nks_msg_rgba'] = '';
    }

    if (empty($options['nks_msg_image_bg'])) {
        $options['nks_msg_image_bg'] = 'none';
    }

    if (empty($options['nks_msg_userpic_style'])) {
        $options['nks_msg_userpic_style'] = 'theme_custom';
    }

    // GENERAL
    if (empty($options['nks_msg_sidebar_type'])) {
        $options['nks_msg_sidebar_type'] = 'push';
    }

    if (empty($options['nks_msg_display'])) {
        $opts = (object)array(
            "user" => (object)array(
                    "everyone" => 1,
                    "loggedin" => 0,
                    "loggedout" => 0
                ),
            "mobile" => (object)array(
                    "yes" => 1,
                    "no" => 0
                ),
            "rule" => (object)array(
                    "include" => 0,
                    "exclude" => 1
                ),
            "location" => (object)array(
                    "pages" => (object)array(),
                    "cposts" => (object)array(),
                    "cats" => (object)array(),
                    "taxes" => (object)array(),
                    "langs" => (object)array(),
                    "wp_pages" => (object)array(),
                    "ids" => array()
                )
        );
        $options['nks_msg_display'] =  json_encode($opts);
    }

    if (empty($options['nks_msg_enable_test'])) {
        $options['nks_msg_enable_test'] = false;
    }

    if (empty($options['nks_msg_fade_content'])) {
        $options['nks_msg_fade_content'] = 'none';
    }

    if (empty($options['nks_msg_sidebar_pos'])) {
        $options['nks_msg_sidebar_pos'] = 'right';
    }

    if (empty($options['nks_msg_ui_color'])) {
        $options['nks_msg_ui_color'] = 'rgb(4, 132, 255)';
    }
    if (empty($options['nks_msg_ui_hsl'])) {
        $options['nks_msg_ui_hsl'] = '{"h":0,"s":1,"l":1}';
    }

    if (empty($options['nks_msg_label_color'])) {
        $options['nks_msg_label_color'] = 'rgb(4, 132, 255)';
    }

    if (empty($options['nks_msg_label_hsl'])) {
        $options['nks_msg_label_hsl'] = '{"h":0,"s":1,"l":1}';
    }

    if (empty($options['nks_msg_label_style'])) {
        $options['nks_msg_label_style'] = '1';
    }
    if (empty($options['nks_msg_label_size'])) {
        $options['nks_msg_label_size'] = '2x';
    }

    if (empty($options['nks_msg_label_tooltip'])) {
        $options['nks_msg_label_tooltip'] = 'hover';
    }

    if (empty($options['nks_msg_lang'])) {
        $options['nks_msg_lang'] = 'en_US';
    }

    if (empty($options['nks_msg_page_id'])) {
        $options['nks_msg_page_id'] = '';
    }

    if (empty($options['nks_msg_label_tooltip_text'])) {
        $options['nks_msg_label_tooltip_text'] = 'Live Chat';
    }

    if (empty($options['nks_msg_loggedin'])) {
        $options['nks_msg_loggedin'] = '';
    }

    if (empty($options['nks_msg_loggedout'])) {
        $options['nks_msg_loggedout'] = '';
    }

    if (empty($options['nks_msg_tooltip_color'])) {
        $options['nks_msg_tooltip_color'] = 'rgb(4, 132, 255)';
    }

    if (empty($options['nks_msg_tooltip_grad'])) {
        $options['nks_msg_label_grad'] = 'rgb(22, 199, 255)';
    }

    if (empty($options['nks_msg_label_shape'])) {
        $options['nks_msg_label_shape'] = 'circle';
    }

    if (empty($options['nks_msg_metro'])) {
        $options['nks_msg_metro'] = '';
    }

    if (empty($options['nks_msg_label_invert'])) {
        $options['nks_msg_label_invert'] = '';
    }

    if (empty($options['nks_msg_label_top'])) {
        $options['nks_msg_label_top'] = '50%';
    }

    if (empty($options['nks_msg_label_top_mob'])) {
        $options['nks_msg_label_top_mob'] = '100px';
    }

    if (empty($options['nks_msg_label_vis'])) {
        $options['nks_msg_label_vis'] = 'visible';
    }
    if (empty($options['nks_msg_label_vis_selector'])) {
        $options['nks_msg_label_vis_selector'] = '';
    }

    if (empty($options['nks_msg_label_mouseover'])) {
        $options['nks_msg_label_mouseover'] = '';
    }

    if (empty($options['nks_msg_togglers'])) {
        $options['nks_msg_togglers'] = '';
    }



    $nks_msg_cached_opts = $options;

//	delete_option('nks_msg_options');
    return $options;
}

global $nks_msg_locations;

function nks_msg_get_locations () {
    global $nks_msg_locations;

    if (isset($nks_msg_locations)) return $nks_msg_locations;

    $locations = new stdClass();

    // pages on site
    $pages = array();
	$fields = array('post_title', 'ID');

	$posts = get_posts( array(
		'post_type' => 'page',
		'post_status' => 'publish',
		'numberposts' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
		'fields' => 'ids, titles'
	));

	foreach($posts as $post) {
		$newPost = new stdClass();
		foreach($fields as $field) {
			$newPost->$field = $post->$field;
		}
		$pages[] = $newPost;
	}

	$locations->pages = $pages;

    // custom post types
    $locations->cposts = get_post_types( array(
        'public' => true,
    ), 'object');

    foreach ( array( 'revision', 'post', 'page', 'attachment', 'nav_menu_item' ) as $unset ) {
        unset($locations->cposts[$unset]);
    }

    foreach ( $locations->cposts as $c => $type ) {
        $post_taxes = get_object_taxonomies($c);
        foreach ( $post_taxes as $post_tax) {
            $locations->taxes[] = $post_tax;
        }
    }

    // categories
    $locations->cats = get_categories( array(
        'hide_empty'    => false,
        //'fields'        => 'id=>name', //added in 3.8
    ) );

    // WPML languages
    if (function_exists('icl_get_languages') ) {
        //browser()->log('detect langs');
        $locations->langs = icl_get_languages('skip_missing=0&orderby=code');
    }

    foreach ( $locations as $key => $val ) {

        if (!empty($val)) {
            $length = count($val);
            for ($i = 0; $i <= $length; $i++) {
                if (isset($val[$i])) {
                    //browser()->log  ( $val[$i] );
                }
            }
        }
    }

    $page_types = array(
        'front'     => __('Front', 'nks-messenger'),
        'home'      => __('Home/Blog', 'nks-messenger'),
        'archive'   => __('Archives'),
        'single'    => __('Single Post'),
        'forbidden' => '404',
        'search'    => __('Search'),
    );

    foreach ($page_types as $key => $label){
        //browser()->log  ( $key, $label );
        //$instance['page-'. $key] = isset($instance['page-'. $key]) ? $instance['page-'. $key] : false;
    }

    $locations->wp_pages = $page_types;

    $nks_msg_locations = $locations;
    return $locations;
}