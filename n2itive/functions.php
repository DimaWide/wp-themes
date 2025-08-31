<?php


/** @desc this loads the composer autoload file */
// ToDo: Remove if you need it
// require get_theme_file_path( '/vendor/autoload.php' );

/** @desc this instantiates Dotenv and passes in our path to .env */
// ToDo: Remove if you need it
// $dotenv = Dotenv\Dotenv::createImmutable( ABSPATH );
// $dotenv->load();



define('WCL_THEME_VERSION', '0.248');


/*
 * =========================================
 * 	STYLES & SCRIPTS
 * =========================================
 */


error_reporting(error_level: E_ERROR | E_PARSE);

/*
 * Enqueueing Styles & Scripts
 */
function wcl_theme_enqueue_scripts() {

    $pages = get_field('pages', 'option');
    $installation = $pages['installation'];

    // Remove jQuery from front-end of the website
    //wp_deregister_script('jquery');

    // Swiper
    wp_enqueue_style('swiper-wcl',  get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), WCL_THEME_VERSION);
    wp_enqueue_script('swiper-wcl',  get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), WCL_THEME_VERSION, true);

    wp_enqueue_style('fancybox-wcl',  get_template_directory_uri() . '/css/fancybox.css', array(), WCL_THEME_VERSION);
    wp_enqueue_script('fancybox-wcl',  get_template_directory_uri() . '/js/fancybox.umd.js', array(), WCL_THEME_VERSION, true);

    wp_enqueue_style('OverlayScrollbars-wcl',  get_template_directory_uri() . '/css/OverlayScrollbars.min.css', array(), WCL_THEME_VERSION);
    wp_enqueue_script('OverlayScrollbars-wcl',  get_template_directory_uri() . '/js/OverlayScrollbars.min.js', array(), WCL_THEME_VERSION, true);

    if (! empty($installation) && is_page($installation)) {
        wp_enqueue_script('jspdf',  get_template_directory_uri() . '/js/jspdf.umd.min.js', array(), WCL_THEME_VERSION, true);
        wp_enqueue_script('jspdf.plugin.autotable',  get_template_directory_uri() . '/js/jspdf.plugin.autotable.min.js', array(), WCL_THEME_VERSION, true);
    }

    // Styles
    wp_enqueue_style('wcl-custom-style', get_template_directory_uri() . '/css/wcl-style.min.css', array(), WCL_THEME_VERSION);

    // Scripts
    wp_enqueue_script('wcl-functions-js', get_template_directory_uri() . '/js/wcl-functions.js', array(), WCL_THEME_VERSION, true);

    wp_localize_script('wcl-functions-js', 'wcl_obj', array(
        'ajax_url'     => admin_url('admin-ajax.php'),
        'site_url'     => site_url('/'),
        'template_url' => get_template_directory_uri(),
        'nonce'        => wp_create_nonce('remove_item_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'wcl_theme_enqueue_scripts');



function my_custom_admin_scripts() {
    // Подключаем JS файл только в админке
    wp_enqueue_script('my-custom-admin-js', get_template_directory_uri() . '/js/custom-admin.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'my_custom_admin_scripts');






function enqueue_woocommerce_cart_fragments() {
    wp_enqueue_script('wc-cart-fragments');
}
add_action('wp_enqueue_scripts', 'enqueue_woocommerce_cart_fragments');

/*
 * Enqueueing Styles & Scripts To Admin Panel
 */
function wcl_admin_enqueue_scripts($hook) {

    wp_enqueue_style('wcl-admin-style', get_template_directory_uri() . '/css/wcl-admin-style.min.css', array(), WCL_THEME_VERSION);
}

add_action('admin_enqueue_scripts', 'wcl_admin_enqueue_scripts');




/*
 * Remove Gutenberg Block Library CSS from loading on the frontend
 */
function wcl_remove_wp_block_library_css() {

    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS

}
add_action('wp_enqueue_scripts', 'wcl_remove_wp_block_library_css', 100);















/*
 * =========================================
 * 	IMAGE SIZES
 * =========================================
 */



/*
 * Remove default image sizes options
 */
// disable generated image sizes
function wcl_disable_unused_image_sizes($sizes) {

    unset($sizes['thumbnail']);    // disable thumbnail size
    unset($sizes['medium']);       // disable medium size
    unset($sizes['large']);        // disable large size
    unset($sizes['medium_large']); // disable medium-large size
    unset($sizes['1536x1536']);    // disable 2x medium-large size
    unset($sizes['2048x2048']);    // disable 2x large size
    return $sizes;
}
add_action('intermediate_image_sizes_advanced', 'wcl_disable_unused_image_sizes');


// disable other image sizes
function wcl_disable_other_images() {

    remove_image_size('post-thumbnail'); // disable set_post_thumbnail_size()
    remove_image_size('another-size');   // disable other add image sizes

}
add_action('init', 'wcl_disable_other_images');


// disable scaled image size
add_filter('big_image_size_threshold', '__return_false');





/*
 * Add custom image sizes
 */
// add_image_size('image-size-1', 400, 268, true);
// add_image_size('image-size-1@2x', 800, 536, true);

// add_image_size('image-size-2', 733, 506, true);
// add_image_size('image-size-2@2x', 1466, 1012, true);

// add_image_size('image-size-3', 885, 542, true);
// add_image_size('image-size-3@2x', 1770, 1084, true);

// add_image_size('image-size-4', 123, 123, true);
// add_image_size('image-size-4@2x', 246, 246, true);

// add_image_size('image-size-5', 302, 0, false);
// add_image_size('image-size-5@2x', 604, 0, false);

// add_image_size('image-size-6', 546, 251, true);
// add_image_size('image-size-6@2x', 1092, 502, true);










/*
 * =========================================
 * 	THEME SUPPORT
 * =========================================
 */



/*
 * Support HTML 5 tags for styles and scripts
 */
add_action(
    'after_setup_theme',
    function () {
        add_theme_support('html5', ['script', 'style']);
    }
);






/*
 * Add the ability to upload post thumbnails
 */
add_theme_support('post-thumbnails');






/*
 * Register Nav Manus
 */
function wcl_register_nav_menus() {
    register_nav_menu('main-menu', 'Main Menu');
    register_nav_menu('footer-menu', 'Footer Menu');
}

add_action('after_setup_theme', 'wcl_register_nav_menus');
















/*
 * =========================================
 * 	ACF Settings
 * =========================================
 */



/*
 * ACF Option Page
 */
if (function_exists('acf_add_options_page')) {

    // Theme Settings page
    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'WCL Settings',
        'menu_slug'  => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
        'icon_url'   => 'dashicons-admin-home',
    ));

    // Theme Settings Subpage
    // acf_add_options_sub_page(array(
    // 	'page_title'  => 'Subpage',
    // 	'menu_title'  => 'Subpage',
    // 	'parent_slug' => 'theme-general-settings',
    // ));

}







/* 
Add WooCommerce support
 */
function my_woocommerce_theme_setup() {
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'my_woocommerce_theme_setup');






/*
 * =======================================================
 * 	Make ACF fields works on Preview
 * =======================================================
 */

function wcl_fix_acf_field_post_id_on_preview($post_id, $original_post_id) {

    // Don't do anything to options
    if (is_string($post_id) && str_contains($post_id, 'option')) {
        return $post_id;
    }
    // Don't do anything to blocks
    if (is_string($original_post_id) && str_contains($original_post_id, 'block')) {
        return $post_id;
    }

    // This should only affect on post meta fields
    if (is_preview()) {
        return get_the_ID();
    }

    return $post_id;
}
add_filter('acf/validate_post_id', __NAMESPACE__ . '\wcl_fix_acf_field_post_id_on_preview', 10, 2);











/*
 * =========================================
 * 	Actions
 * =========================================
 */









/*
 * =========================================
 * 	Filters
 * =========================================
 */











/*
 * =========================================
 * 	Others Files
 * =========================================
 */


require_once get_theme_file_path('/inc/helpers.php');
require_once get_theme_file_path('/inc/acf-blocks.php');
require_once get_theme_file_path('/inc/ajax-functions.php');
require_once get_theme_file_path('/inc/woocommerce.php');

// Actions

// API

// CPT
