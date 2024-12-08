<?php 

  
/*
* wcl_post_type_product
*/
function wcl_post_type_product() {
    $labels = array(
        'name'               => _x('Products', 'Post Type General Name'),
        'singular_name'      => _x('Product', 'Post Type Singular Name'),
        'add_new'            => __('Add New'),
        'add_new_item'       => __('Add New Product'),
        'edit_item'          => __('Edit Product'),
        'new_item'           => __('New Product'),
        'all_items'          => __('All Products'),
        'view_item'          => __('View Product'),
        'search_items'       => __('Search Product'),
        'not_found'          => __('Not Found'),
        'not_found_in_trash' => __('Not found in Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Products'),
    );

    $args = array(
        'label'             => __('Products'),
        'labels'            => $labels,
        'public'            => false,
        'show_ui'           => true,
        'supports'          => array('title', 'thumbnail'),
        'show_in_nav_menus' => true,
        '_builtin'          => false,
        'has_archive'       => false,
        'menu_position'     => 5,
        'rewrite'   => array('slug' => 'product'),
    );

    register_post_type('cd-product', $args);

    $args = array(
        'hierarchical'  => true,
        'labels'        => array(
            'name'              => 'Product Categories',
            'singular_name'     => 'Product Category',
            'search_items'      => 'Search Categories',
            'all_items'         => 'All Categories',
            'view_item '        => 'View Category',
            'parent_item'       => 'Parent Category',
            'parent_item_colon' => 'Parent Category:',
            'edit_item'         => 'Edit Category',
            'update_item'       => 'Update Category',
            'add_new_item'      => 'Add New Category',
            'new_item_name'     => 'New Category Name',
            'menu_name'         => 'Product Categories',
            'back_to_items'     => '← Back to Category',
        ),
        'show_ui'       => true,
        'query_var'     => true,
    );

    register_taxonomy('cd-product-category', 'cd-product', $args);

    $args = array(
        'hierarchical'  => true,
        'labels'        => array(
            'name'              => 'Edits',
            'singular_name'     => 'Edit',
            'search_items'      => 'Search Edits',
            'all_items'         => 'All Edits',
            'view_item '        => 'View Edit',
            'parent_item'       => 'Parent Edit',
            'parent_item_colon' => 'Parent Edit:',
            'edit_item'         => 'Edit Edit',
            'update_item'       => 'Update Edit',
            'add_new_item'      => 'Add New Edit',
            'new_item_name'     => 'New Edit Name',
            'menu_name'         => 'Edits',
            'back_to_items'     => '← Back to Edit',
        ),
        'show_ui'       => true,
        'query_var'     => true,
    );

    register_taxonomy('cd-product-edit', 'cd-product', $args);

    $args = array(
        'hierarchical'  => true,
        'labels'        => array(
            'name'              => 'Collections',
            'singular_name'     => 'Collection',
            'search_items'      => 'Search Collections',
            'all_items'         => 'All Collections',
            'view_item '        => 'View Collection',
            'parent_item'       => 'Parent Collection',
            'parent_item_colon' => 'Parent Collection:',
            'edit_item'         => 'Collection Collection',
            'update_item'       => 'Update Collection',
            'add_new_item'      => 'Add New Collection',
            'new_item_name'     => 'New Collection Name',
            'menu_name'         => 'Collections',
            'back_to_items'     => '← Back to Collection',
        ),
        'show_ui'       => true,
        'query_var'     => true,
        'rewrite' => array('slug' => 'product-collection', 'with_front' => true),
    );

    register_taxonomy('cd-product-collection', 'cd-product', $args);
}
add_action('init', 'wcl_post_type_product');


/*
* wcl_post_type_video
*/
function wcl_post_type_video() {
    $labels = array(
        'name'               => _x('Videos', 'Post Type General Name'),
        'singular_name'      => _x('Video', 'Post Type Singular Name'),
        'add_new'            => __('Add New'),
        'add_new_item'       => __('Add New Video'),
        'edit_item'          => __('Edit Video'),
        'new_item'           => __('New Video'),
        'all_items'          => __('All Videos'),
        'view_item'          => __('View Video'),
        'search_items'       => __('Search Video'),
        'not_found'          => __('Not Found'),
        'not_found_in_trash' => __('Not found in Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Videos'),
    );

    $args = array(
        'label'             => __('Videos'),
        'labels'            => $labels,
        'public'            => false,
        'show_ui'           => true,
        'supports'          => array('title', 'thumbnail'),
        'show_in_nav_menus' => true,
        '_builtin'          => false,
        'has_archive'       => false,
        'menu_position'     => 5,
        'menu_icon'         => 'dashicons-format-video',
        'rewrite'           => array('slug' => 'video'),
    );

    register_post_type('cd-video', $args);

    $args = array(
        'hierarchical'  => true,
        'labels'        => array(
            'name'              => 'Video Categories',
            'singular_name'     => 'Video Category',
            'search_items'      => 'Search Categories',
            'all_items'         => 'All Categories',
            'view_item '        => 'View Category',
            'parent_item'       => 'Parent Category',
            'parent_item_colon' => 'Parent Category:',
            'edit_item'         => 'Edit Category',
            'update_item'       => 'Update Category',
            'add_new_item'      => 'Add New Category',
            'new_item_name'     => 'New Category Name',
            'menu_name'         => 'Video Categories',
            'back_to_items'     => '← Back to Category',
        ),
        'show_ui'   => true,
        'query_var' => true,
        'public'    => false,
    );

    register_taxonomy('cd-video-category', 'cd-video', $args);
}
add_action('init', 'wcl_post_type_video');


/*
* wcl_post_type_outfit
*/
function wcl_post_type_outfit() {
    $labels = array(
        'name'               => _x('Outfits', 'Post Type General Name'),
        'singular_name'      => _x('Outfit', 'Post Type Singular Name'),
        'add_new'            => __('Add New'),
        'add_new_item'       => __('Add New Outfit'),
        'edit_item'          => __('Edit Outfit'),
        'new_item'           => __('New Outfit'),
        'all_items'          => __('All Outfits'),
        'view_item'          => __('View Outfit'),
        'search_items'       => __('Search Outfit'),
        'not_found'          => __('Not Found'),
        'not_found_in_trash' => __('Not found in Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Outfits'),
    );

    $args = array(
        'label'             => __('Outfits'),
        'labels'            => $labels,
        'public'            => true,
        'show_ui'           => true,
        'supports'          => array('title', 'thumbnail'),
        'show_in_nav_menus' => true,
        '_builtin'          => false,
        'has_archive'       => false,
        'menu_position'     => 5,
        'rewrite'           => array('slug' => 'outfit'),
        //  'menu_icon'         => 'dashicons-format-video',
    );

    register_post_type('cd-outfit', $args);

    $args = array(
        'hierarchical'  => true,
        'labels'        => array(
            'name'              => 'Outfit Categories',
            'singular_name'     => 'Outfit Category',
            'search_items'      => 'Search Categories',
            'all_items'         => 'All Categories',
            'view_item '        => 'View Category',
            'parent_item'       => 'Parent Category',
            'parent_item_colon' => 'Parent Category:',
            'edit_item'         => 'Edit Category',
            'update_item'       => 'Update Category',
            'add_new_item'      => 'Add New Category',
            'new_item_name'     => 'New Category Name',
            'menu_name'         => 'Outfit Categories',
            'back_to_items'     => '← Back to Category',
        ),
        'show_ui'       => true,
        'query_var'     => true,
    );

    register_taxonomy('cd-outfit-category', 'cd-outfit', $args);
}
add_action('init', 'wcl_post_type_outfit');