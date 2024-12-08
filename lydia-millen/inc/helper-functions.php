<?php


/*
* plug for vs
*/
if (false) {
    function get_field() {
    }
    function acf_add_options_page() {
    }
    function get_sub_field() {
    }
    function have_rows() {
    }
    function the_row() {
    }
    function get_row_layout() {
    }
    function get_field_object() {
    }
    function update_field() {
    }
    function acf_register_block_type() {
    }
}


/*
* Page Slug Body Class
*/
function add_slug_body_class($classes) {
    global $post;
    if (isset($post)) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter('body_class', 'add_slug_body_class');


/*
* my_excerpt_length
*/
function my_excerpt_length($length) {
    return 300;
}
add_filter('excerpt_length', 'my_excerpt_length');



/*
* request
*/
add_filter('request', function ($query_vars) {
    if (!empty($query_vars['s'])) {
        $query_vars['s'] = trim($query_vars['s']);
    }

    return $query_vars;
});



/*
* remove_attachment_pages
*/
function remove_attachment_pages() {
    global $wp_query;

    if (is_attachment()) {
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit();
    }
    return;
}
add_action('template_redirect', 'remove_attachment_pages', 10);



/*
* cleanup_attachment_link
*/
function cleanup_attachment_link($link) {
    return;
}
add_filter('attachment_link', 'cleanup_attachment_link');



/*
* redirect_child_category_to_parent
*/
function redirect_child_category_to_parent() {
    if (is_category()) {
        $category = get_queried_object();
        if ($category->parent) {
            $parent_category = get_category($category->parent);
            wp_redirect(get_category_link($parent_category->term_id));
            exit;
        }
    }
}
add_action('template_redirect', 'redirect_child_category_to_parent');


/*
* wpcf7_before_send_mail_function
*/
function wpcf7_before_send_mail_function($contact_form, $abort, $submission) {
    $dynamic_email = get_bloginfo('admin_email');
    $posted_data = $submission->get_posted_data();

    if ($posted_data["your-recipient"][0] == 'Brand Partnerships') {
        $dynamic_email = 'info@lydiaelisemillen.com';
    } elseif ($posted_data["your-recipient"][0] == 'Community Feedback') {
        $dynamic_email = 'info@lydiaelisemillen.com';
    } elseif ($posted_data["your-recipient"][0] == 'Media Enquiries') {
    } elseif ($posted_data["your-recipient"][0] == 'Gifting & PR') {
        $dynamic_email = 'fiona@lydiaelisemillen.com';
    }

    $properties = $contact_form->get_properties();
    $properties['mail']['recipient'] = $dynamic_email;
    $contact_form->set_properties($properties);

    return $contact_form;
}
add_filter('wpcf7_before_send_mail', 'wpcf7_before_send_mail_function', 10, 3);


/**
 * block_categories_all
 */
add_filter('block_categories_all', function ($categories) {

    // Adding a new category.
    $categories[] = array(
        'slug'  => 'wcl-category',
        'title' => 'WCL Blocks'
    );

    return $categories;
});


/**
 * wcl_acf_blocks_init
 */
function wcl_acf_blocks_init() {

    // Check function exists.
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'centered-text',
            'title'             => __('Centered Text'),
            'description'       => __('Centered Text Block.'),
            'render_template'   => 'template-parts/acf-blocks/block-8.php',
            'category'          => 'wcl-category',
            'mode' => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'image-box',
            'title'             => __('Image + Box'),
            'description'       => __('Image + Box'),
            'render_template'   => 'template-parts/acf-blocks/image-box.php',
            'category'          => 'wcl-category',
            'mode' => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'images-side-by-side',
            'title'             => __('Images side by side'),
            'description'       => __('Images side by side'),
            'render_template'   => 'template-parts/acf-blocks/block-5.php',
            'category'          => 'wcl-category',
            'mode' => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'cd-paragraph',
            'title'             => __('Paragraph'),
            'description'       => __('Paragraph'),
            'render_template'   => 'template-parts/acf-blocks/block-9.php',
            'category'          => 'wcl-category',
            'mode' => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'quote-image',
            'title'             => __('Quote + Image'),
            'description'       => __('Quote + Imag.'),
            'render_template'   => 'template-parts/acf-blocks/block-7.php',
            'category'          => 'wcl-category',
            'mode' => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'shop-slider',
            'title'             => __('Shop Slider - CD'),
            'description'       => __('Shop Slider'),
            'render_template'   => 'template-parts/acf-blocks/shop-slider.php',
            'category'          => 'wcl-category',
            'mode' => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'shop-slider-image',
            'title'             => __('Shop Slider + Image'),
            'description'       => __('Shop Slider + Image Block.'),
            'render_template'   => 'template-parts/acf-blocks/block-10.php',
            'category'          => 'wcl-category',
            'mode' => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'two-images-side-by-side-cta',
            'title'             => __('Two images side by side + CTA'),
            'description'       => __('Two images side by side + CTA'),
            'render_template'   => 'template-parts/acf-blocks/block-6.php',
            'category'          => 'wcl-category',
            'mode' => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'two-images-with-text',
            'title'             => __('Two images with text'),
            'description'       => __('Two images with text Block.'),
            'render_template'   => 'template-parts/acf-blocks/block-11.php',
            'category'          => 'wcl-category',
            'mode' => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'block-2',
            'title'             => __('Outfit'),
            'description'       => __('Outfit Block.'),
            'render_template'   => 'template-parts/acf-blocks/block-2.php',
            'category'          => 'wcl-category',
            'mode' => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'block-3',
            'title'             => __('Shop Slider - Wcl'),
            'description'       => __('Shop Slider - Wcl Block.'),
            'render_template'   => 'template-parts/acf-blocks/block-3.php',
            'category'          => 'wcl-category',
            'mode' => 'edit',
        ));

        acf_register_block_type(array(
            'name'              => 'block-4',
            'title'             => __('Shop The Edit'),
            'description'       => __('Shop The Edit Block.'),
            'render_template'   => 'template-parts/acf-blocks/block-4.php',
            'category'          => 'wcl-category',
            'mode' => 'edit',
        ));
    }
}
add_action('acf/init', 'wcl_acf_blocks_init');


/**
 * wcl_save_post_add_product_to_post
 */
function wcl_save_post_add_product_to_post($post_id) {

    if (wp_is_post_revision($post_id) || get_post($post_id)->post_status != 'publish') {
        return;
    }

    $post_type = get_post_type($post_id);

    if ($post_type == 'post') {
        $terms         = get_the_terms($post_id, 'category');
        $term_product  = new stdClass();
        $allowed_terms = ['beauty', 'home', 'style'];

        if (!empty($terms)) {
            foreach ($terms as $term) {
                if (in_array($term->slug, $allowed_terms)) {
                    $term_product = $term;
                    break;
                }
            }
        }

        $args = array(
            'post_type'           => 'cd-product',
            'posts_per_page'      => 1,
            'ignore_sticky_posts' => 1,
            'post_status'         => ['publish'],
        );

        $props = get_object_vars($term_product);
        if (!empty($props)) {
            $args['tax_query'] = [
                'relation' => 'AND',
                array(
                    'taxonomy' => 'cd-product-category',
                    'field'    => 'slug',
                    'terms'    => $term_product->slug,
                ),
            ];
        };

        $last_product = new WP_Query($args);

        if (!empty($last_product)) {
            $product_list = get_field('product_list', $post_id);

            if (empty($product_list)) {
                update_field('field_63e6af450960b', $last_product->posts[0]->ID, $post_id);
            }
        }
    }
}
add_action('save_post', 'wcl_save_post_add_product_to_post');


/**
 * update
 */
add_action('post_updated', function ($post_id, $post, $post_before) {

    if ($post->post_type != 'post' && $post->post_type != 'cd-video')
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (wp_is_post_revision($post_id))
        return 'revision';

    if ($post->post_type == 'post') {
        // Update posts for included products 
        $blocks = parse_blocks($post->post_content);
        $products = array();

        foreach ($blocks as $key => $block) :
            if ($block['blockName'] == 'acf/block-3') :
                if ($block['attrs']['data']['products']) :
                    $products = array_merge($products, $block['attrs']['data']['products']);
                endif;
            endif;
        endforeach;

        $unique_products = array_unique($products);

        foreach ($unique_products as $key => $product) :
            $related_posts = get_post_meta($product, 'related_posts', true);

            if (empty($related_posts)) :
                $related_posts = array();
            endif;

            if (!in_array($post_id, $related_posts)) :
                $related_posts[] = $post_id;
            endif;

            update_post_meta($product, 'related_posts', $related_posts);
        endforeach;
        // -- Update posts for included products 

        if (!($post->post_content == $post_before->post_content)) :
            write_log("different content");

            // Remove post from removed products
            $blocks_before = parse_blocks($post_before->post_content);
            $products_before = array();
            foreach ($blocks_before as $key => $block) :
                if ($block['blockName'] == 'acf/block-3') :
                    if ($block['attrs']['data']['products']) :
                        $products_before = array_merge($products_before, $block['attrs']['data']['products']);
                    endif;
                endif;
            endforeach;
            $unique_products_before = array_unique($products_before);
            $removed_products = array_diff($unique_products_before, $unique_products);

            foreach ($removed_products as $key => $product) {
                $related_posts = get_post_meta($product, 'related_posts', true);

                if (!in_array($post_id, $related_posts)) {
                    $related_posts[] = $post_id;
                }

                $related_posts = wcl_remove_element($related_posts, $post_id);
                update_post_meta($product, 'related_posts', $related_posts);
            }
            // -- Remove post from removed products

            update_post_meta($post_id, 'related_products', $unique_products);
        endif;
    }
}, 10, 3);



/**
 * wcl_remove_element
 */
function wcl_remove_element($array, $value) {
    return array_diff($array, (is_array($value) ? $value : array($value)));
}


/**
 * write_log
 */
if (!function_exists('write_log')) {
    function write_log($log) {
        if (is_array($log) || is_object($log)) {
            error_log(print_r($log, true));
        } else {
            error_log($log);
        }
    }
}



/**
 * checkPostsStatus
 */
function checkPostsStatus($related_posts) {
    if (!empty($related_posts)) {
        foreach ((array)$related_posts  as $key => $related_posts_id) {
            $post_obj = get_post($related_posts_id);
            if ($post_obj->post_status != 'publish') {
                unset($related_posts[$key]);
            }
        }
    }

    return $related_posts;
}
