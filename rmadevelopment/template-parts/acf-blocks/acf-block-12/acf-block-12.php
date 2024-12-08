<?php

if (display_preview_image($block)) {
    return;
}

$page_slug = get_post_field('post_name');

$page       = !empty(get_query_var('paged')) ? get_query_var('paged') : 1;
$page_items = ! empty(get_option('posts_per_page')) ? get_option('posts_per_page') : 4;

$args = array(
    'post_type'      => 'wcl-news',
    'posts_per_page' => $page_items,
    'paged'          => $page,
);

$query_obj   = new WP_Query($args);
$total_pages = $query_obj->max_num_pages;
$has_more    = ($page < $total_pages) ? true : false;
$post_count  = $query_obj->post_count;
?>
<!-- Acf Block #12 – News -->
<div class="wcl-acf-block-12" data-slug-page="<?php echo $page_slug; ?>">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col data-content">
                <div class="data-list-out">
                    <div class="data-list">
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
                    </div>
                </div>

                <?php
                $class_nav = '';

                if ($has_more) {
                    $class_nav = 'active';
                }
                ?>
                <div class="data-load-more <?php echo $class_nav; ?>">
                    <?php if ($has_more) : ?>
                        <button class="data-load-more-btn cmp-button mod-btn" data-page="<?php echo $page; ?>">
                            Load More
                        </button>
                    <?php else : ?>
                        <button class="data-load-more-btn cmp-button mod-btn" data-page="<?php echo $page; ?>" disabled="true">
                            All Viewed
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-col">
                <?php get_template_part('template-parts/sidebar'); ?>
            </div>
        </div>
    </div>
</div>