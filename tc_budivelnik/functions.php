<?php




define('WCL_THEME_VERSION', '0.166');







/*
* =========================================
* 	STYLES & SCRIPTS
* =========================================
*/


/*
* Enqueueing Styles & Scripts
*/
function wcl_theme_enqueue_scripts() {

	// Remove jQuery from front-end of the website
	//wp_deregister_script('jquery');

	// Swiper
	wp_enqueue_style('swiper-wcl',  get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), WCL_THEME_VERSION);
	wp_enqueue_script('swiper-wcl',  get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), WCL_THEME_VERSION, true);

	if (is_product()) {
		wp_enqueue_style('magnific-popup-css', get_template_directory_uri() . '/css/magnific-popup.min.css');
		wp_enqueue_script('magnific-popup-js', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array('jquery'), null, true);
	}

	wp_enqueue_script('jquery-mask',  get_template_directory_uri() . '/js/jquery.mask.min.js', array('jquery'), WCL_THEME_VERSION, true);

	// Styles
	wp_enqueue_style('wcl-custom-style', get_template_directory_uri() . '/css/wcl-style.min.css', array(), WCL_THEME_VERSION);

	// Scripts
	wp_enqueue_script('wcl-functions-js', get_template_directory_uri() . '/js/wcl-functions.js', array(), WCL_THEME_VERSION, true);


	wp_localize_script('wcl-functions-js', 'wcl_obj', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'site_url' => site_url('/'),
		'template_url' => get_template_directory_uri(),
		'nonce'    => wp_create_nonce('remove_item_nonce'),
	));
}
add_action('wp_enqueue_scripts', 'wcl_theme_enqueue_scripts');



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

	unset($sizes['woocommerce_thumbnail']);    // disable thumbnail size
	unset($sizes['woocommerce_single']);    // disable thumbnail size
	unset($sizes['woocommerce_gallery_thumbnail']);    // disable thumbnail size
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
add_image_size('image-size-1', 838, 0, false); // acf block 1
add_image_size('image-size-1@2x', 1676, 0, false);
add_image_size('image-size-2', 470, 0, false); // acf block 1
add_image_size('image-size-2@2x', 940, 0, false);
add_image_size('image-size-3', 170, 0, false); // acf block 2 / product
add_image_size('image-size-3@2x', 340, 0, false);










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
	register_nav_menu('menu-1', 'Корисна інформація');
	register_nav_menu('menu-2', 'Header Menu');
	register_nav_menu('footer-menu-1', 'Footer Menu 1');
	register_nav_menu('footer-menu-2', 'Footer Menu 2');
	register_nav_menu('footer-menu-3', 'Footer Menu 3');
	register_nav_menu('sidebar-menu', 'Sidebar Menu');
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
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'WCL Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'icon_url'		=> 'dashicons-admin-home',
	));

	// Theme Settings Subpage
	acf_add_options_sub_page(array(
		'page_title'  => 'Subpage',
		'menu_title'  => 'Subpage',
		'parent_slug' => 'theme-general-settings',
	));
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
* 	CUSTOM FUNCTIONS
* =========================================
*/

// !!! YOUR CUSTOM FUNCTIONS GO HERE !!!

require_once get_theme_file_path('/vendor/autoload.php');
require_once get_theme_file_path('/inc/acf-blocks-functions.php');
require_once get_theme_file_path('/inc/ajax-requests.php');
require_once get_theme_file_path('/inc/helper-functions.php');
require_once get_theme_file_path('/inc/woocommerce-functions.php');
