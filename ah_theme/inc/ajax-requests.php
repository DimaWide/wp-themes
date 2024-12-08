<?php



/**
 * blog_page_load_post
 */
function blog_page_load_post() {
    $page_items = 9;
    $page       = $_POST['page'] ? $_POST['page'] : 1;
    $offset     = ($page - 1) * $page_items;
    $categories = $_POST['cats'];

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $page_items,
        'paged'          => $page,
        'offset'         => $offset,
        'post_status'    => 'publish',
        'meta_key'       => 'featured_post',
        'orderby'        => array(
            'meta_value' => 'DESC',
            'date'       => 'DESC',
        ),
        'order'          => 'DESC',
    );

    if (!empty($categories)) {
        $categories_array= explode(',', $categories);

        $args['tax_query'] = [
            'relation' => 'OR',
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $categories_array,
            ),
        ];
    };

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    $pages_elem  = ceil(($total_count - $offset) / $page_items);
    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php get_template_part('template-parts/components/post-item'); ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="data-list-empty">
            No found
        </div>
    <?php endif; ?>

    <?php
    $output['posts'] = ob_get_clean();

    // Get pagination( 

    ob_start();

    blog_page_pagination($query_obj, $page, $categories);
    ?>
    <?php
    $output['pagination'] = ob_get_clean();

    // Get first post 

    ob_start();

    $first_post = [];
    
    if (!empty($categories) || $page != '1') {
        $first_post = $query_obj->posts[0];
        $first_post_id = $first_post->ID;

        $first_post = get_post($first_post_id);
    } else {
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
            'meta_key'       => 'featured_post',
            'orderby'        => array(
                'meta_value' => 'DESC',
                'date'       => 'DESC',
            ),
            'order'          => 'DESC',
        );

        $query_obj = new WP_Query($args);
        $total_count = $query_obj->found_posts;

        if (!empty($query_obj->posts)) {
            $first_post = $query_obj->posts[0];
        }
    }
    ?>
    <?php if (!empty($first_post)) : ?>
        <?php
        global $post;
        $post = $first_post;
        setup_postdata($first_post); ?>

        <?php get_template_part('template-parts/acf-blocks/block-5/item'); ?>

        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
<?php
    $output['first_post'] = ob_get_clean();

    $output['count_pages'] = $total_count / $page_items;

    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_blog_page_load_post', 'blog_page_load_post');
add_action('wp_ajax_nopriv_blog_page_load_post', 'blog_page_load_post');
