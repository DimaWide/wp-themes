<?php




define('WCL_THEME_VERSION', '0.179');







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

	wp_enqueue_style('swiper-wcl',  get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), WCL_THEME_VERSION);
	wp_enqueue_script('swiper-wcl',  get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), WCL_THEME_VERSION, true);

	// Styles
	wp_enqueue_style('wcl-custom-style', get_template_directory_uri() . '/css/wcl-style.min.css', array(), WCL_THEME_VERSION);

	// Scripts
	wp_enqueue_script('wcl-bundle-js', get_template_directory_uri() . '/js/wcl-bundle.js', array(), WCL_THEME_VERSION, true);

	wp_localize_script('wcl-bundle-js', 'wcl_obj', array(
		'ajax_url'     => admin_url('admin-ajax.php'),
		'site_url'     => site_url('/'),
		'template_url' => get_template_directory_uri(),
	));
}
add_action('wp_enqueue_scripts', 'wcl_theme_enqueue_scripts');



/*
* remove_wc_style
*/
function remove_wc_style() {
	//wp_dequeue_style('sbi_styles');
	wp_dequeue_style('wcs-view-subscription');
}
add_action('wp_enqueue_scripts', 'remove_wc_style', 100);



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
	unset($sizes['woocommerce_thumbnail']);
	unset($sizes['woocommerce_single']);
	unset($sizes['woocommerce_gallery_thumbnail']);
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
add_image_size('image-size-1', 1296, 530, true); // wcl-section-1
add_image_size('image-size-1@2x', 2592, 1060, true);
add_image_size('image-size-2', 557, 625, true); // wcl-section-3
add_image_size('image-size-2@2x', 1114, 1250, true);
add_image_size('image-size-3', 400, 400, true); // wcl-section-7
add_image_size('image-size-3@2x', 800, 800, true);
add_image_size('image-size-4', 275, 345, true); // wcl-section-8
add_image_size('image-size-4@2x', 550, 690, true);
add_image_size('image-size-5', 560, 500, true); // wcl-section-9
add_image_size('image-size-5@2x', 1120, 1000, true);
add_image_size('image-size-6', 200, 200, true); // wcl-section-10
add_image_size('image-size-6@2x', 400, 400, true);
add_image_size('image-size-7', 755, 527, true); // wcl-section-14
add_image_size('image-size-7@2x', 1500, 1054, true);
add_image_size('image-size-8', 1166, 421, true); // wcl-section-3-e2
add_image_size('image-size-8@2x', 2332, 842, true);
add_image_size('image-size-9', 150, 150, true); // wcl-section-17
add_image_size('image-size-9@2x', 300, 300, true);
add_image_size('image-size-10', 516, 445, true); // wcl-section-18
add_image_size('image-size-10@2x', 1032, 890, true);
add_image_size('image-size-11', 390, 530, true); // wcl-section-11
add_image_size('image-size-11@2x', 780, 1060, true);
add_image_size('image-size-12', 667, 471, true); // wcl-single-banner
add_image_size('image-size-12@2x', 1334, 942, true);
add_image_size('image-size-13', 755, 420, true); // wcl-acf-block-2-v2 mod-shop-slider
add_image_size('image-size-13@2x', 1510, 840, true);
add_image_size('image-size-14', 320, 320, true); // wcl-section-25
add_image_size('image-size-14@2x', 640, 640, true);










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
		add_theme_support('woocommerce');
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
	register_nav_menu('header-menu', 'Header Menu');
	register_nav_menu('header-menu-2', 'Header Menu Second');
	register_nav_menu('header-mobile', 'Header Menu Mobile');
	register_nav_menu('header-mobile-logged', 'Header Menu Mobile Logged');
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
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'WCL Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'icon_url'		=> 'dashicons-admin-home',
	));

	// Theme Settings Subpage
	// acf_add_options_sub_page(array(
	// 	'page_title'  => 'Subpage',
	// 	'menu_title'  => 'Subpage',
	// 	'parent_slug' => 'theme-general-settings',
	// ));

}













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

require_once get_theme_file_path('/inc/register-post-types.php');
require_once get_theme_file_path('/inc/rewardstyle.php');
require_once get_theme_file_path('/inc/woocommerce-functions.php');
require_once get_theme_file_path('/inc/helper-functions.php');
require_once get_theme_file_path('/inc/ajax-requests.php');
