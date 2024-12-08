<?php

$title    = get_field('title');
$subtitle = get_field('subtitle');

$pages         = get_field('pages', 'option');
$video_listing = $pages['video_listing'];
$page_slug     = get_post_field('post_name', $video_listing);
$category_slug = 'video-category';

$terms = get_terms([
    'taxonomy'   => 'video_category',
    'hide_empty' => true,
]);

$current_category = '';

if (is_tax('video_category')) {
    $current_category = get_queried_object()->slug;
}

// Main Query
$page       = !empty(get_query_var('paged')) ? get_query_var('paged') : 1;
$page_items = 9;

$args = array(
    'post_type'      => ['video'],
  //  'post_type'      => 'video',
    'posts_per_page' => $page_items,
    'paged'          => $page,
);

if (!empty($current_category)) {
    $args['tax_query'] = [
        'relation' => 'AND',
        array(
            'taxonomy' => 'video_category',
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
<!-- Acf Block #6 – videos List -->
<div class="wcl-acf-block-12" data-slug-page="<?php echo $page_slug; ?>" data-slug-category="<?php echo $category_slug; ?>">
    <div class="data-container wcl-container">
        <div class="data-head">
            <?php if (!empty($title)) : ?>
                <h1 class="data-title">
                    <?php echo $title; ?>
                </h1>
            <?php endif; ?>

            <?php if (!empty($subtitle)) : ?>
                <div class="data-subtitle">
                    <?php echo $subtitle; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($terms) && !is_wp_error($terms)) : ?>
            <div class="data-cats">
                <ul class="data-cats-list">
                    <?php foreach ($terms as $term) : ?>
                        <?php
                        $active = '';

                        if ($term->slug == $current_category) {
                            $active = 'active';
                        }
                        ?>
                        <li class="data-cats-item">
                            <a href="<?php echo get_term_link((int)$term->term_id); ?>" class="<?php echo $active; ?>" data-slug="<?php echo $term->slug; ?>">
                                <?php echo $term->name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="data-list-out">
            <div class="data-list">
                <?php if ($query_obj->have_posts()) : ?>
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php get_template_part('template-parts/video-item'); ?>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                <?php else : ?>
                    <div class="data-list-empty">
                        Nerasta
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
                <button class="data-load-more-btn wcl-cmp-button mod-btn" data-page="<?php echo $page; ?>">
                    Įkelti daugiau
                </button>
            <?php else : ?>
                <button class="data-load-more-btn wcl-cmp-button mod-btn" data-page="<?php echo $page; ?>" disabled="true">
                    Visi peržiūrėti
                </button>
            <?php endif; ?>
        </div>
    </div>
</div>