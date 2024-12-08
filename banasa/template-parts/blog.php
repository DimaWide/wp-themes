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
$page_items = 9;

$args = array(
    'post_type'      => 'post',
    'posts_per_page' => $page_items,
    'paged'          => $page,
    's'              => $search,
);

if (!empty($current_category)) {
    $args['tax_query'] = [
        'relation' => 'AND',
        array(
            'taxonomy' => 'category',
            'field'    => 'slug',
            'terms'    => $current_category,
        ),
    ];
};

$query_obj   = new WP_Query($args);
$total_pages = $query_obj->max_num_pages;
$has_more    = ($page < $total_pages) ? true : false;
$post_count  = $query_obj->post_count;
?>
<div class="wcl-blog mod-section-animate" data-slug-page="<?php echo $page_slug; ?>">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col data-content">
                <div class="data-list-out">
                    <div class="data-list">
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
                    </div>
                </div>

                <?php
                $class_nav = '';

                if ($total_pages  > 1) {
                    $class_nav = 'active';
                }
                ?>
                <div class="data-load-more <?php echo $class_nav; ?>">
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
                </div>
            </div>

            <div class="data-col">
                <?php get_template_part('template-parts/components/cmp-3-sidebar'); ?>
            </div>
        </div>
    </div>
</div>