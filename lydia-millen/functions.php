<?php




define('WCL_THEME_VERSION', '1.5');







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

	wp_enqueue_style('swiper',  get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), WCL_THEME_VERSION);
	wp_enqueue_script('swiper',  get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), WCL_THEME_VERSION, true);

	// Styles

	wp_enqueue_style('wcl-custom-style', get_template_directory_uri() . '/css/wcl-style.min.css', array(), WCL_THEME_VERSION);
	wp_enqueue_style('style-subscribe', get_template_directory_uri() . '/css/style-subscribe.css', array(), WCL_THEME_VERSION);

	// Scripts
	wp_enqueue_script('wcl-functions-js', get_template_directory_uri() . '/js/wcl-functions.js', array(), WCL_THEME_VERSION, true);

	wp_localize_script('wcl-functions-js', 'wcl_obj', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'site_url' => site_url('/'),
		'template_url' => get_template_directory_uri(),
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
add_image_size('image-size-1', 1166, 640, true); // Section 6
add_image_size('image-size-1@2x', 2332, 1280, true);
add_image_size('image-size-3', 1048, 0, false);
add_image_size('image-size-3@2x', 2096, 0, false);
add_image_size('image-size-9', 764, 700, true); // Section 6
add_image_size('image-size-9@2x', 1528, 1400, true);

add_image_size('image-size-2', 329, 468, true); // Section 2
add_image_size('image-size-2@2x', 658, 936, true);

add_image_size('image-size-11', 489, 646, true); // Acf Block 5
add_image_size('image-size-11@2x', 978, 1292, true);

add_image_size('image-size-16', 1166, 1080, true); // Post By Month
add_image_size('image-size-16@2x', 2332, 2160, true);
add_image_size('image-size-14', 1085, 748, true); // Category Landing
add_image_size('image-size-14@2x', 2170, 1496, true);











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
	register_nav_menu('header-right', 'Header Right');
	register_nav_menu('footer-about', 'Footer About');
	register_nav_menu('footer-topics', 'Footer Topics');
}

add_action('after_setup_theme', 'wcl_register_nav_menus');




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
}





/*
* =========================================
* 	CUSTOM FUNCTIONS
* =========================================
*/

require_once get_theme_file_path('/inc/register-post-types.php');
require_once get_theme_file_path('/inc/helper-functions.php');
require_once get_theme_file_path('/inc/ajax-requests.php');





/*
* Allow upload big images
*/
add_filter( 'big_image_size_threshold', '__return_false' );





/*
* Disable default WP image compression on resizing
*/
add_filter( 'wp_editor_set_quality', function($quality, $mime_type) {
    return 100; // Quality level for all images (0-100)
}, 10, 2);
