<?php


/*
* wcl_post_type_product
*/
function wcl_post_type_product() {
    $labels = array(
        'name'               => _x('Products External', 'Post Type General Name'),
        'singular_name'      => _x('Product External', 'Post Type Singular Name'),
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
        'menu_name'          => __('Products External'),
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
        'taxonomies'        => ['post_tag'],
        'menu_position'     => 5,
        'menu_icon'         => 'dashicons-products',
        'rewrite'           => array('slug' => 'product-external'),
    );

    register_post_type('wcl-product', $args);
}
add_action('init', 'wcl_post_type_product');

