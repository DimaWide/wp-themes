<?php




define('WCL_THEME_VERSION', '0.196');







/*
* =========================================
* 	STYLES & SCRIPTS
* =========================================
*/


/*
* Enqueueing Styles & Scripts
*/
function wcl_theme_enqueue_scripts() {

	// Swiper
	wp_enqueue_style('swiper-wcl',  get_template_directory_uri() . '/css/swiper-bundle.min.css', array(), WCL_THEME_VERSION);
	wp_enqueue_script('swiper-wcl',  get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), WCL_THEME_VERSION, true);

	// Styles
	wp_enqueue_style('wcl-custom-style', get_template_directory_uri() . '/css/wcl-style.min.css', array(), WCL_THEME_VERSION);

	// Scripts
	wp_enqueue_script('wcl-functions-js', get_template_directory_uri() . '/js/wcl-functions.js', array(), WCL_THEME_VERSION, true);

	wp_localize_script('wcl-functions-js', 'wcl_obj', array(
		'ajax_url'     => admin_url('admin-ajax.php'),
		'site_url'     => site_url('/'),
		'template_url' => get_template_directory_uri(),
		'blog_url'     => wcl_get_blog_slug(),
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
add_image_size('image-size-1', 366, 200, true);
add_image_size('image-size-1@2x', 732, 400, true);
add_image_size('image-size-2', 112, 78, true);
add_image_size('image-size-2@2x', 224, 156, true);
add_image_size('image-size-3', 384, 280, true);
add_image_size('image-size-3@2x', 768, 560, true);
add_image_size('image-size-4', 1216, 720, true);
add_image_size('image-size-4@2x', 2432, 1440, true);
add_image_size('image-size-5', 592, 640, true);
add_image_size('image-size-5@2x', 1184, 1280, true);
add_image_size('image-size-6', 40, 40, true);
add_image_size('image-size-6@2x', 80, 80, true);











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
	register_nav_menu('footer-copyright-menu', 'Footer Copyright Menu');
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












function multisite_filter_canonical_for_all_types( $canonical ) {

    if ( !is_main_site() ) {

        $main_site_id = get_main_site_id();
        switch_to_blog( $main_site_id );

        if ( is_single() ) {

            // Handle single posts.
            $post_slug = get_queried_object()->post_name;
            $posts = get_posts( array(
                'post_type' => 'post',
                'name'      => $post_slug,
            ) );

            $permalink = empty( $posts ) ? '' : get_permalink( $posts[0] );

        } elseif ( is_category() ) {

            // Handle category pages.
            $category_slug = get_queried_object()->slug;
            $category_link = get_category_link( get_category_by_slug( $category_slug )->term_id );
            $permalink = $category_link ? $category_link : '';

        } elseif ( is_tag() ) {

            // Handle tag pages.
            $tag_slug = get_queried_object()->slug;
            $tag_link = get_tag_link( get_tag( $tag_slug )->term_id );
            $permalink = $tag_link ? $tag_link : '';

        } elseif ( is_author() ) {

            // Handle author pages.
            $author = get_queried_object();
            $author_posts_url = get_author_posts_url( $author->ID, $author->user_nicename );
            $permalink = $author_posts_url ? $author_posts_url : '';

        } else {

            // If it's not a single post, category, tag, or author page, don't change the canonical URL.
            $permalink = '';
            
        }

        restore_current_blog();
        return $permalink ? $permalink : $canonical;

    }

    return $canonical;

}
add_filter( 'wpseo_canonical', 'multisite_filter_canonical_for_all_types' );








/*
* =========================================
* 	CUSTOM FUNCTIONS
* =========================================
*/

// !!! YOUR CUSTOM FUNCTIONS GO HERE !!!


require_once get_theme_file_path('/inc/helper-functions.php');
require_once get_theme_file_path('/inc/ajax-requests.php');