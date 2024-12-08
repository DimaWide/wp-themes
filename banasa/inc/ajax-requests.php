<?php



/**
 * projects_listing_load_posts
 */
function projects_listing_load_posts() {
    $page_items = isset($_POST['page_items']) ? $_POST['page_items'] : 9;
    $page       = isset($_POST['page']) ? $_POST['page'] : 1;
    $category   = isset($_POST['category']) ? $_POST['category'] : '';

    $args = array(
        'post_type'      => 'project',
        'posts_per_page' => $page_items,
        'paged'          => $page,
    );

    if (!empty($category) && $category !== 'all') {
        $args['tax_query'] = [
            'relation' => 'AND',
            array(
                'taxonomy' => 'project_category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        ];
    };

    $query_obj   = new WP_Query($args);
    $post_count  = $query_obj->post_count;
    $total_pages = $query_obj->max_num_pages;
    $has_more    = ($page < $total_pages) ? true : false;
    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php get_template_part('template-parts/project-item'); ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="data-list-empty">
            No found
        </div>
    <?php endif; ?>
    <?php
    $output['posts'] = ob_get_clean();

    ob_start();
    ?>
    <?php if ($has_more) : ?>
        <button class="data-load-more-btn cmp-button mod-btn" data-page="<?php echo $page; ?>">
            <?php
            if (function_exists('icl_t')) {
                echo icl_t('banasa', 'load_more', 'Carga más');
            } else {
                echo 'Carga más';
            }
            ?>
        </button>
    <?php else : ?>
        <button class="data-load-more-btn cmp-button mod-btn" data-page="<?php echo $page; ?>" disabled="true">
            <?php
            if (function_exists('icl_t')) {
                echo icl_t('banasa', 'all_viewed', 'Todo visto');
            } else {
                echo 'Todo visto';
            }
            ?>
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    $output['total_pages'] = $total_pages;

    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_projects_listing_load_posts', 'projects_listing_load_posts');
add_action('wp_ajax_nopriv_projects_listing_load_posts', 'projects_listing_load_posts');




/**
 * blog_load_posts
 */
function blog_load_posts() {
    $page_items = isset($_POST['page_items']) ? $_POST['page_items'] : 9;
    $page       = isset($_POST['page']) ? $_POST['page'] : 1;
    $search     = $_POST['search'];
    $category   = $_POST['category'];

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $page_items,
        'paged'          => $page,
        's'              => $search,
    );

    if (!empty($category)) {
        $args['tax_query'] = [
            'relation' => 'AND',
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        ];
    };

    $query_obj   = new WP_Query($args);
    $post_count  = $query_obj->post_count;
    $total_pages = $query_obj->max_num_pages;
    $has_more    = ($page < $total_pages) ? true : false;
    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php get_template_part('template-parts/components/cmp-1-post'); ?>
        <?php endwhile;
        wp_reset_postdata(); ?>
    <?php else : ?>
        <div class="data-list-empty">
            No found
        </div>
    <?php endif; ?>
    <?php
    $output['posts'] = ob_get_clean();

    ob_start();
    ?>
    <?php if ($has_more) : ?>
        <button class="data-load-more-btn cmp-button mod-btn" data-page="<?php echo $page; ?>">
            <?php
            if (function_exists('icl_t')) {
                echo icl_t('banasa', 'load_more', 'Carga más');
            } else {
                echo 'Carga más';
            }
            ?>
        </button>
    <?php else : ?>
        <button class="data-load-more-btn cmp-button mod-btn" data-page="<?php echo $page; ?>" disabled="true">
            <?php
            if (function_exists('icl_t')) {
                echo icl_t('banasa', 'all_viewed', 'Todo visto');
            } else {
                echo 'Todo visto';
            }
            ?>
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    $output['total_pages'] = $total_pages;

    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_blog_load_posts', 'blog_load_posts');
add_action('wp_ajax_nopriv_blog_load_posts', 'blog_load_posts');
