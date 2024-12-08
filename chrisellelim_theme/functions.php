<?php

/**
 * @package $THEME_NAME PACKAGE
 */

define('WCL_THEME_VERSION', '1.21');

/*
* =========================================
* 	STYLES & SCRIPTS
* =========================================
*/

/*
* Enqueueing Styles & Scripts
*/
function wcl_theme_enqueue_scripts() {
	// wp_deregister_script('jquery');
	//wp_enqueue_style('scrollbar',  get_template_directory_uri() . '/css/perfect-scrollbar.css', array(), WCL_THEME_VERSION, true);
	wp_enqueue_style('swiper',  get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), WCL_THEME_VERSION);
	wp_enqueue_script('swiper',  get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), WCL_THEME_VERSION, true);
	wp_enqueue_style('wcl-custom-style', get_template_directory_uri() . '/css/wcl-style.min.css', array(), WCL_THEME_VERSION);
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
add_image_size('image-a', 560, 722, true);
add_image_size('image-a@2x', 1120, 1444, true);
add_image_size('image-b', 559, 405, true);
add_image_size('image-b@2x', 1118, 810, true);
add_image_size('image-c', 1920, 1080, true);
add_image_size('image-c@2x', 3840, 2160, true);
add_image_size('image-d', 393, 564, true);
add_image_size('image-d@2x', 786, 1128, true);
add_image_size('image-e', 413, 460, true);
add_image_size('image-e@2x', 826, 920, true);
add_image_size('image-f', 261, 370, true); // Octagon Slider Item
add_image_size('image-f@2x', 522, 740, true);
add_image_size('image-g', 490, 680, true); // Vertical
add_image_size('image-g@2x', 980, 1360, true);
add_image_size('image-h', 476, 480, true);
add_image_size('image-h@2x', 952, 960, true);
add_image_size('image-i', 270, 270, true); // Thing
add_image_size('image-i@2x', 540, 540, true);
add_image_size('image-i-2v', 464, 634, true); // Thing
add_image_size('image-i-2v@2x', 928, 1268, true);
add_image_size('image-j', 700, 463, true);
add_image_size('image-j@2x', 1400, 926, true);
add_image_size('image-k', 375, 768, true);
add_image_size('image-k@2x', 750, 1536, true);
add_image_size('image-l', 780, 510, true);
add_image_size('image-l@2x', 1560, 1020, true); 
add_image_size('image-m', 354, 453, true);
add_image_size('image-m@2x', 708, 906, true);
add_image_size('image-n', 407, 523, true);
add_image_size('image-n@2x', 814, 1046, true);
add_image_size('image-o', 884, 573, true); // Single-post H
add_image_size('image-o@2x', 1748, 1146, true);
add_image_size('image-o-2', 884, 1091, true); // Single-post V
add_image_size('image-o-2@2x', 1748, 2082, true);
add_image_size('image-p', 286, 354, true);
add_image_size('image-p@2x', 572, 708, true);
add_image_size('image-q', 118, 152, true);
add_image_size('image-q@2x', 236, 304, true);
add_image_size('image-r', 377, 433, true); // Outfit
add_image_size('image-r@2x', 754, 866, true);
add_image_size('image-r-2v', 766, 875, true); // Outfit
add_image_size('image-r-2v@2x', 1532, 1750, true);
add_image_size('image-s', 772, 502, true); // Horizontal 
add_image_size('image-s@2x', 1544, 1004, true);
add_image_size('image-t', 595, 768, true);
add_image_size('image-t@2x', 1190, 1536, true);
add_image_size('image-u', 301, 386, true);
add_image_size('image-u@2x', 602, 772, true);
add_image_size('image-v', 470, 350, true);
add_image_size('image-v@2x', 940, 1416, true);
add_image_size('image-w', 508, 398, true);
add_image_size('image-w@2x', 1016, 796, true);
add_image_size('image-x', 240, 50, true);
add_image_size('image-x@2x', 480, 100, true);

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
	register_nav_menu('main-menu-2', 'Main Menu 2');

	register_nav_menu('footer-menu', 'Footer Menu');
	register_nav_menu('footer-menu-2', 'Footer Menu 2');
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

}



/*
* =========================================
* 	CUSTOM FUNCTIONS
* =========================================
*/

require_once get_theme_file_path('/inc/helper-functions.php');
