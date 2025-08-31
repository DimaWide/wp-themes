<?php

// pages
$pages     = get_field('pages', 'option');
$blog      = get_option('page_for_posts');
$page_slug = get_post_field('post_name', $blog);

// cats
$current_category = '';

if (is_category()) {
    $current_category = get_queried_object()->slug;
}

// main query
$search     = get_query_var('s');
$page       = !empty(get_query_var('paged')) ? get_query_var('paged') : 1;
$page_items = 4; 

$sticky_posts = get_option('sticky_posts');

$sticky_args = array(
    'post_type'      => 'post',
    'posts_per_page' => $page_items, 
    'paged'          => $page,
    's'              => $search,
    'post_status'    => 'publish',
    'post__in'       => $sticky_posts, 
    'orderby'        => 'post__in', 
);

if (!empty($current_category)) {
    $sticky_args['tax_query'] = [
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $current_category,
        ),
    ];
}

$sticky_query = new WP_Query($sticky_args);

$sticky_count = $sticky_query->post_count;

$regular_args = array(
    'post_type'      => 'post',
    'posts_per_page' => $page_items - $sticky_count, 
    'paged'          => $page,
    's'              => $search,
    'post_status'    => 'publish',
    'post__not_in'   => $sticky_posts, 
);

if (!empty($current_category)) {
    $regular_args['tax_query'] = [
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $current_category,
        ),
    ];
}

$regular_query = new WP_Query($regular_args);

$combined_posts = array_merge($sticky_query->posts, $regular_query->posts);

$total_pages = max($sticky_query->max_num_pages, $regular_query->max_num_pages);
$has_more    = ($page < $total_pages) ? true : false;
$post_count  = count($combined_posts);
?>

<!-- acf-12-blog -->
<div class="acf-12-blog" data-cat="<?php echo $current_category; ?>">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <div class="data-list-out">
                    <div class="data-list">
                        <?php if ($post_count > 0) : ?>
                            <?php foreach ($combined_posts as $post) : ?>
                                <?php setup_postdata($post); ?>
                                <div class="data-item">
                                    <?php get_template_part('template-parts/components/cmp-5-post'); ?>
                                </div>
                            <?php endforeach; 
                            wp_reset_postdata(); ?>
                        <?php else : ?>
                            <div class="data-list-empty">
                                No posts found
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php
                $class_nav = '';
                if ($total_pages > 1) {
                    $class_nav = 'active';
                }
                ?>
                <?php if (!empty($post_count)): ?>
                    <div class="data-load-more <?php echo $class_nav; ?>">
                        <?php if ($has_more) : ?>
                            <button class="data-load-more-btn cmp-button mod-red" data-page="<?php echo $page; ?>">
                                Load more
                            </button>
                        <?php else : ?>
                            <button class="data-load-more-btn cmp-button mod-red" data-page="<?php echo $page; ?>" disabled="true">
                                All viewed
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <?php get_template_part('template-parts/components/cmp-6-sidebar'); ?>
            </div>
        </div>
    </div>
</div>

