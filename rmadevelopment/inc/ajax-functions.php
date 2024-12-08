<?php

/**
 * news_load_posts
 */
function news_load_posts() {
    $page_items = ! empty(get_option('posts_per_page')) ? get_option('posts_per_page') : 4;
    $page       = isset($_POST['page']) ? $_POST['page'] : 1;

    $args = array(
        'post_type'      => 'wcl-news',
        'posts_per_page' => $page_items,
        'paged'          => $page,
    );

    $query_obj   = new WP_Query($args);
    $post_count  = $query_obj->post_count;
    $total_pages = $query_obj->max_num_pages;
    $has_more    = ($page < $total_pages) ? true : false;
    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php get_template_part('template-parts/news-item'); ?>
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
            Load More
        </button>
    <?php else : ?>
        <button class="data-load-more-btn cmp-button mod-btn" data-page="<?php echo $page; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    $output['total_pages'] = $total_pages;

    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_news_load_posts', 'news_load_posts');
add_action('wp_ajax_nopriv_news_load_posts', 'news_load_posts');






/**
 * blog_load_posts
 */
function blog_load_posts() {
    $page_items = ! empty(get_option('posts_per_page')) ? get_option('posts_per_page') : 4;
    $page       = isset($_POST['page']) ? $_POST['page'] : 1;

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => $page_items,
        'paged'          => $page,
    );

    $query_obj   = new WP_Query($args);
    $post_count  = $query_obj->post_count;
    $total_pages = $query_obj->max_num_pages;
    $has_more    = ($page < $total_pages) ? true : false;
    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php get_template_part('template-parts/news-item', null, ['type_page' => 'blog']); ?>
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
            Load More
        </button>
    <?php else : ?>
        <button class="data-load-more-btn cmp-button mod-btn" data-page="<?php echo $page; ?>" disabled="true">
            All Viewed
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






/**
 * project_load_posts
 */
function project_load_posts() {
    $page_items = ! empty(get_option('posts_per_page')) ? get_option('posts_per_page') : 4;
    $page       = isset($_POST['page']) ? $_POST['page'] : 1;

    $args = array(
        'post_type'      => 'project',
        'posts_per_page' => $page_items,
        'paged'          => $page,
    );

    $query_obj   = new WP_Query($args);
    $post_count  = $query_obj->post_count;
    $total_pages = $query_obj->max_num_pages;
    $has_more    = ($page < $total_pages) ? true : false;
    ob_start();
?>
    <?php if ($query_obj->have_posts()) : ?>
        <?php
        $count = $page_items;
        ?>
        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
            <?php
            $count++;
            $align = 'left';

            if ($count % 2 == 0) {
                $align = 'right';
            }

            $args =  array(
                'align' => $align,
            );
            ?>
            <?php get_template_part('template-parts/project-item', null, $args); ?>
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
            Load More
        </button>
    <?php else : ?>
        <button class="data-load-more-btn cmp-button mod-btn" data-page="<?php echo $page; ?>" disabled="true">
            All Viewed
        </button>
    <?php endif; ?>
<?php
    $output['button'] = ob_get_clean();
    $output['total_pages'] = $total_pages;

    echo json_encode($output);
    wp_die();
}
add_action('wp_ajax_project_load_posts', 'project_load_posts');
add_action('wp_ajax_nopriv_project_load_posts', 'project_load_posts');
