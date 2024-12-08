<?php



if ($_SERVER["SERVER_ADDR"] == '127.0.0.1') {
    define('CATS_EXCLUSIVE', [38, 39, 40]);

    define(
        'CATS_EXCLUSIVE_ASSOC',
        [
            'shopping-lists' => 38,
            'splendor-collective-guides' => 39,
            'splendor-collective-stories' => 40,
        ],
    );
} elseif ($_SERVER["SERVER_ADDR"] == '192.186.222.228') {
    define('CATS_EXCLUSIVE', [6416, 6417, 6415]);

    define(
        'CATS_EXCLUSIVE_ASSOC',
        [
            'shopping-lists' => 6416,
            'splendor-collective-guides' => 6417,
            'splendor-collective' => 6415,
        ],
    );
} else {
    define('CATS_EXCLUSIVE', [603, 602, 589]);

    define(
        'CATS_EXCLUSIVE_ASSOC',
        [
            'shopping-lists' => 603,
            'splendor-collective-guides' => 602,
            'splendor-collective' => 589,
        ],
    );
}


///www.avintagesplendor.com



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
* rewrite_url
*/
function rewrite_url() {

    add_rewrite_rule('shopping/([^/]*)?', 'index.php?pagename=shopping&stories_tag=$matches[1]', 'top');

    add_rewrite_rule('stories/([^/]*)?', 'index.php?pagename=stories&stories_tag=$matches[1]', 'top');

    add_rewrite_rule('^category/([^/]+)/([^/]+)/([^/]*)?$', 'index.php?category_name=$matches[1]/$matches[2]&stories_tag=$matches[3]', 'top');
}
add_action('init', 'rewrite_url');



/*
* query_url
*/
function query_url($query_vars) {
    $query_vars[] = 'stories_tag';
    return $query_vars;
}
add_filter('query_vars', 'query_url');



/*
* template_redirect
*/
function template_redirect() {
    if (is_shop()) {
        $shop = get_field('pages', 'option');
        $shop = $shop['shop'];

        wp_redirect(get_permalink($shop), 301);
        exit();
    }

    $pages                   = get_field('pages', 'option');
    $the_splendor_collective = $pages['the_splendor_collective'];
    $sc_portal               = $pages['sc_portal'];

    if (is_page($the_splendor_collective) && wcl_is_subscriber()) {
        wp_redirect(get_permalink($sc_portal), 301);
        exit();
    }
}
add_action('template_redirect', 'template_redirect');





/* 
set_comment_status_pending
 */
function set_comment_status_pending($comment_id) {
    wp_set_comment_status($comment_id, 'hold');
}
add_action('comment_post', 'set_comment_status_pending');






/* 
add_body_class
 */
function add_body_class($classes) {
    global $woocommerce;
    if ($woocommerce->cart->is_empty()) {
        $classes[] = 'wcl-cart-empty';
    }

    if (!has_permission_for_exclusive()) {
        $classes[] = 'wcl-not-has-permission';
    }

    return $classes;
}
add_filter('body_class', 'add_body_class');






/* 
has_permission_for_exclusive
 */
function has_permission_for_exclusive() {
    $state = false;
    $post_id = get_the_ID();
    $members_access_role = get_post_meta($post_id, '_members_access_role');

    if (empty($members_access_role)) {
        return true;
    }

    $user_id = get_current_user_id();
    $user_has_role = false;

    foreach ($members_access_role as $role) {
        if (user_can($user_id, $role)) {
            $user_has_role = true;
            break;
        }
    }

    if ($user_has_role || current_user_can('administrator')) {
        $state = true;
    }

    //var_dump( $state );

    return $state;
}





/* 
wcl_is_subscriber
 */
function wcl_is_subscriber() {
    $user    = wp_get_current_user();
    $user_id = $user->ID;

    if (current_user_can('administrator')) {
        return true;
    }

    $subscriptions = wcs_user_has_subscription($user_id);

    return $subscriptions;
}




/* 
wcl_is_exclusive_storie
 */
function wcl_is_exclusive_storie($post_id = '') {
    if (empty($post_id)) {
        $post_id = get_the_ID();
    }

    $cats         = get_the_terms($post_id, 'category');
    $is_exclusive = false;

    if (!empty($cats)) {
        foreach ($cats as $cat) {
            if (strpos($cat->slug, 'splendor-collective') !== false || in_array($cat->term_id, CATS_EXCLUSIVE)) {
                $is_exclusive = true;
                break;
            }
        }
    }

    return $is_exclusive;
}



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
custom_content_filter
 */
function custom_content_filter($content) {
    // if (is_single()) {
    //     if (wcl_is_exclusive_storie() && !wcl_is_subscriber()) {
    //         $content = get_template_part('template-parts/single/not-have-permission');
    //     }
    // }

    return $content;
}
add_filter('the_content', 'custom_content_filter');




/* 
wcl_get_primary_cat
 */
function wcl_get_primary_cat($post_id = '') {
    if (empty($post_id)) {
        $post_id = get_the_ID();
    }

    $cats    = get_the_terms($post_id, 'category');
    $primary = '';

    if (!empty($cats)) {
        foreach ($cats as $cat) {
            if (in_array($cat->term_id, CATS_EXCLUSIVE)) {
                $primary = $cat->term_id;
                break;
            }
        }
    }

    return $primary;
}






/* 
// Add a filter to customize the default avatar image
 */
function custom_default_avatar($avatar, $id_or_email, $size, $default, $alt) {
    $avatar_acf = get_field('avatar', 'user_' . get_current_user_id());
    $avatar_acf = wp_get_attachment_image($avatar_acf, 'image-size-9');
    if (!empty($avatar_acf)) {
        return $avatar_acf;
    }

    return $avatar;
}
add_filter('get_avatar', 'custom_default_avatar', 10, 5);




/* 
get_not_empty_tags_for_cat
 */
function get_not_empty_tags_for_cat($categorySlug) {
    global $wpdb;

    $query = "
        SELECT t.term_id, t.name, t.slug
        FROM {$wpdb->prefix}terms AS t
        INNER JOIN {$wpdb->prefix}term_taxonomy AS tt ON t.term_id = tt.term_id
        INNER JOIN {$wpdb->prefix}term_relationships AS tr ON tt.term_taxonomy_id = tr.term_taxonomy_id
        INNER JOIN {$wpdb->prefix}posts AS p ON tr.object_id = p.ID
        INNER JOIN {$wpdb->prefix}term_relationships AS tr_cat ON p.ID = tr_cat.object_id
        INNER JOIN {$wpdb->prefix}term_taxonomy AS tt_cat ON tr_cat.term_taxonomy_id = tt_cat.term_taxonomy_id
        INNER JOIN {$wpdb->prefix}terms AS t_cat ON tt_cat.term_id = t_cat.term_id
        WHERE tt.taxonomy = 'post_tag'
        AND t_cat.slug = %s
        GROUP BY t.term_id
        HAVING COUNT(DISTINCT p.ID) > 0
        LIMIT 10
    ";

    $tags = $wpdb->get_results($wpdb->prepare($query, $categorySlug), OBJECT);

    return $tags;
}




/* 
get_terms_by_post_type
 */
function get_terms_by_post_type($taxonomies, $post_types) {

    global $wpdb;

    $query = $wpdb->prepare(
        "SELECT  t.*, COUNT(*) from $wpdb->terms AS t
        INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id
        INNER JOIN $wpdb->term_relationships AS r ON r.term_taxonomy_id = tt.term_taxonomy_id
        INNER JOIN $wpdb->posts AS p ON p.ID = r.object_id
        WHERE p.post_type IN('%s') AND tt.taxonomy IN('%s')
        GROUP BY t.term_id
        LIMIT 10",
        join("', '", $post_types),
        join("', '", $taxonomies)
    );

    $results = $wpdb->get_results($query, OBJECT);

    return $results;
}




/* 
shop_page_get_post
 */
function shop_page_get_post($post_ids = ['']) {
    $posts_obj = get_posts(array(
        'post_type'           => 'post',
        'posts_per_page'      => 1,
        'post__not_in'        => $post_ids,
        'post_status'         => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => 'shopping-lists',
            ),
        ),
    ));

    return $posts_obj;
}



/* 
shop_page_render_post
 */
function shop_page_render_post($posts) {
?>
    <?php if (!empty($posts)) : ?>
        <?php foreach ($posts as $key => $post_item) : ?>
            <?php
            global $post;
            $post = $post_item;
            setup_postdata($post_item);
            get_template_part('template-parts/shop/post-item');
            ?>
        <?php endforeach;
        wp_reset_postdata();
        ?>
    <?php endif; ?>
    <?php
}



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
            'name'            => 'acf-block-1',
            'title'           => __('Text Content'),
            'description'     => __('Text Content Block'),
            'render_template' => 'template-parts/acf-blocks/block-1.php',
            'category'        => 'wcl-category',
            'render_callback' => 'block_render_1',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));

        function block_render_1($block, $content = '', $is_preview = false) {
            if ($is_preview) {
    ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_1-2.jpg'; ?>" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-1');
            }
        }

        acf_register_block_type(array(
            'name'            => 'acf-block-2',
            'title'           => __('Content & Image with Shop Slider'),
            'description'     => __('Shop Block'),
            'render_template' => 'template-parts/acf-blocks/block-2.php',
            'category'        => 'wcl-category',
            'mode'            => 'edit',
            'render_callback' => 'block_render_2',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));


        function block_render_2($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_2-3.jpg'; ?>" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-2');
            }
        }

        acf_register_block_type(array(
            'name'            => 'acf-block-3',
            'title'           => __('Latest Favorites'),
            'description'     => __('Latest Favorites Block'),
            'render_template' => 'template-parts/acf-blocks/block-3.php',
            'category'        => 'wcl-category',
            'mode'            => 'edit',
            'render_callback' => 'block_render_3',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));


        function block_render_3($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_3-2.jpg'; ?>" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-3');
            }
        }

        acf_register_block_type(array(
            'name'            => 'acf-block-4',
            'title'           => __('Annette\'s picks'),
            'description'     => __('Annette\'s picks Block'),
            'render_template' => 'template-parts/acf-blocks/block-4.php',
            'category'        => 'wcl-category',
            'mode'            => 'edit',
            'render_callback' => 'block_render_4',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));


        function block_render_4($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_4-2.jpg'; ?>" alt="img">
            <?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-4');
            }
        }




        acf_register_block_type(array(
            'name'            => 'acf-block-5',
            'title'           => __('Image'),
            'description'     => __('Image Block'),
            'render_template' => 'template-parts/acf-blocks/block-5.php',
            'category'        => 'wcl-category',
            'mode'            => 'edit',
            'render_callback' => 'block_render_5',
            'mode'            => 'edit',
            'example'         => array(
                'attributes' => array(
                    'mode' => 'preview',
                ),
            ),
        ));


        function block_render_5($block, $content = '', $is_preview = false) {
            if ($is_preview) {
            ?>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_block_5-2.jpg'; ?>" alt="img">
<?php
                return;
            } else {
                get_template_part('template-parts/acf-blocks/block-5');
            }
        }


    }
}
add_action('acf/init', 'wcl_acf_blocks_init');






/**
 * get_first_image
 */
function get_first_image($post_content) {
    $pattern = '/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i';
    preg_match($pattern, $post_content, $matches);
    if ($matches && isset($matches[1])) {
        return $matches[1];
    } else {
        return false;
    }
}






/**
 * custom_post_thumbnail_html
 */
// Add a custom callback function to modify the post thumbnail HTML
function custom_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr) {
    if (empty($html)) {
        $new_image = '';

        $post_id = get_the_ID(); // Get the ID of the current post
        $post = get_post($post_id); // Retrieve the post object
        $new_image = get_first_image($post->post_content);

        if (!empty($new_image)) {
            $new_image = '<img src="' . $new_image . '" alt="Thumbnail" />';
        }

        return $new_image;
    } else {
        // Return the original post thumbnail HTML
        return $html;
    }
}
add_filter('post_thumbnail_html', 'custom_post_thumbnail_html', 10, 5);
