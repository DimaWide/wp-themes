<?php


$title = get_sub_field('title');
$shop = get_field('pages', 'option');
$shop = $shop['shop'];

$args = array(
    'post_type'      => 'wcl-product',
    'posts_per_page' => 8,
    'post_status'    => 'publish',
);

$query_obj   = new WP_Query($args);
$total_count = $query_obj->found_posts;
?>
<div class="wcl-section-23">
    <div class="data-container wcl-container">
        <div class="data-a">
            <?php if (!empty($title)) : ?>
                <h2 class="data-title">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <div class="data-link">
                <a href="<?php echo get_permalink($shop); ?>" class="wcl-link">
                    Shop All
                    <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
                </a>
            </div>
        </div>

        <div class="data-list swiper">
            <div class="data-list-inner swiper-wrapper">
                <?php if ($query_obj->have_posts()) : ?>
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <div class="data-list-item swiper-slide">
                            <?php
                            get_template_part('template-parts/shop/item');
                            ?>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                <?php else : ?>
                    <div class="data-list-empty wcl-label-empty">
                        Nothing found
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="data-link-2">
            <a href="<?php echo get_permalink($shop); ?>" class="wcl-link">
                Shop now
                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
            </a>
        </div>

        <div class="data-btn-out">
            <div class="data-btn wcl-link mod-black-to-white">
                Back to top
                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
            </div>
        </div>
    </div>
</div>