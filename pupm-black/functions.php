<?php




define('WCL_THEME_VERSION', '0.152');





/*
* =========================================
* 	STYLES & SCRIPTS
* =========================================
*/




/*
* Enqueueing Styles & Scripts
*/
function wcl_theme_enqueue_scripts() {
	global $current_sol_price;
	// Remove jQuery from front-end of the website
	//wp_deregister_script('jquery');

	// Styles
	wp_enqueue_style('wcl-custom-style', get_template_directory_uri() . '/css/wcl-style.min.css', array(), WCL_THEME_VERSION);

	// Scripts
	// wp_enqueue_script('wcl-websocket-js', get_template_directory_uri() . '/js/websocket-connection.js', array(), WCL_THEME_VERSION, true);

	if (is_page('dex-paid')) {
		wp_enqueue_script('tsparticles', get_template_directory_uri() . '/js/tsparticles.min.js', array(), WCL_THEME_VERSION, true);
		wp_enqueue_script('html2canvas', get_template_directory_uri() . '/js/html2canvas.min.js', array(), WCL_THEME_VERSION, true);
	}

	wp_enqueue_script('wcl-functions-js', get_template_directory_uri() . '/js/wcl-functions.js', array(), WCL_THEME_VERSION, true);

	$sound_file            = get_field('sound_add_new_field', 'option');
	$sound_url             = wp_get_attachment_url($sound_file);
	$sound_file_check_paid = get_field('sound_check_paid_active', 'option');
	$sound_url_check_paid  = wp_get_attachment_url($sound_file_check_paid);
	$token_fields          = get_option('wcl_token_fields');

	$tables_field = get_field('tables_field', 'option');

	$count_fields_new_livestream        = $tables_field['new_livestream'] ?? 4;
	$count_fields_new_livestream_mobile = $tables_field['new_livestream_mobile'] ?? 4;
	$count_fields_dex_paid              = $tables_field['dex_paid'] ?? 5;
	$count_fields_dex_paid_mobile       = $tables_field['dex_paid_mobile'] ?? 4;
	$count_fields_big_buys              = $tables_field['big_buys'] ?? 10;
	$count_fields_big_buys_mobile       = $tables_field['big_buys_mobile'] ?? 7;

	wp_localize_script('wcl-functions-js', 'wcl_obj', array(
		'ajax_url'             => admin_url('admin-ajax.php'),
		'site_url'             => site_url('/'),
		'template_url'         => get_template_directory_uri(),
		'sound_file_url'       => $sound_url ? $sound_url : null,
		'sound_url_check_paid' => $sound_url_check_paid ? $sound_url_check_paid : null,
		'tokenFields'          => $token_fields,
		'current_sol_price'    => $current_sol_price,
		'tablesMaxRows' => [
			'BigBuys'              => array(
				'desktop' => $count_fields_big_buys,
				'mobile'  => $count_fields_big_buys_mobile
			),
			'DexPaid' => array(
				'desktop' => $count_fields_dex_paid,
				'mobile'  => $count_fields_dex_paid_mobile
			),
			'LiveStream' => array(
				'desktop' => $count_fields_new_livestream,
				'mobile'  => $count_fields_new_livestream_mobile
			),
		],
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
add_image_size('image-size-1', 65, 65, true);
add_image_size('image-size-1@2x', 130, 130, true);















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


require_once get_theme_file_path('/inc/acf-blocks-functions.php');
require_once get_theme_file_path('/inc/DataOptimizer.php');
require_once get_theme_file_path('/inc/database-functions.php');
require_once get_theme_file_path('/inc/helper-functions.php');
require_once get_theme_file_path('/inc/token-functions.php');
require_once get_theme_file_path('/inc/ajax-functions.php');
require_once get_theme_file_path('/inc/check_dex.php');
require_once get_theme_file_path('/inc/pumpfun-api.php');
