<?php

$title    = get_field('title');
$subtitle = get_field('subtitle');

$select_by = get_field('select_by');
$select_by = !empty($select_by) ? $select_by : '';

$posts_per_page = 1;

$slider = get_field('slider');
$slider_class     = '';


if (!empty($slider)) {
    $slider_class = 'mod-slider';
    $posts_per_page = -1;
}
?>
<!-- Acf Block #3 - Explore Bali's Breathtaking Natural Wonders -->
<div class="wcl-acf-block-3 wcl-section <?php echo $slider_class; ?>">
    <div class="data-container">
        <div class="wcl-block-1 data-head">
            <?php if (!empty($subtitle)) : ?>
                <div class="m1-subtitle">
                    <?php echo $subtitle; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($title)) : ?>
                <h2 class="m1-title">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>
        </div>

        <?php
        $args      = [];
        $query_obj = [];

        if ($select_by == 'one') {
            $list = get_field('list');

            if (empty($list)) {
                $list = [''];
            }

            $args = array(
                'post_type'      => 'page',
                'posts_per_page' => $posts_per_page,
                'post__in'       => $list,
                'orderby'        => 'post__in',
                'post_status'    => 'publish',
            );
        } elseif ($select_by == 'category') {
            $category_id = get_field('category');

            $args = array(
                'post_type'      => 'page',
                'posts_per_page' => $posts_per_page,
                'post_status'    => 'publish',
            );

            $tax_query = array(
                array(
                    'taxonomy' => 'category',
                    'field'    => 'id',
                    'terms'    => $category_id,
                )
            );
            $args['tax_query'] = $tax_query;
        }

        $query_obj   = new WP_Query($args);
        $total_count = $query_obj->found_posts;
        ?>
        <?php if ($query_obj->have_posts()) : ?>
            <div class="data-list swiper">
                <div class="data-list-inner swiper-wrapper">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        $image = get_the_post_thumbnail($post->ID, 'image-size-4');
                        ?>
                        <div class="data-item swiper-slide">
                            <div class="data-item-inner">
                                <?php if (!empty($image)) : ?>
                                    <div class="data-item-img">
                                        <?php echo $image; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="data-item-info">
                                    <h3 class="data-item-title">
                                        <?php echo strtolower(get_the_title()); ?>
                                    </h3>

                                    <a href="<?php echo get_permalink(); ?>" class="data-item-link wcl-btn">
                                        Read Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>

                <div class="data-list-nav">
                    <div class="data-list-nav-btn mod-prev">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-left.svg'; ?>" alt="img">
                    </div>

                    <div class="data-list-nav-btn mod-next">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-left.svg'; ?>" alt="img">
                    </div>
                </div>

                <div class="data-list-pagination-out">
                    <div class="data-list-pagination"></div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>