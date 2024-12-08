<?php

$title    = get_field('title');
$subtitle = get_field('subtitle');
$image    = get_field('image');
$image    = wp_get_attachment_image($image, 'image-size-4');

$select_by = get_field('select_by');
$select_by = !empty($select_by) ? $select_by : '';

$posts_per_page = 3;

$slider = get_field('slider');
$slider_class     = '';

if (!empty($slider)) {
    $slider_class = 'mod-slider';
    $posts_per_page = -1;
}





$args = '';
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

<!-- Acf Block #6 - Uncover Bali's Best Beats and Clubs -->
<?php if ($query_obj->have_posts()) : ?>
    <div class="wcl-acf-block-6 wcl-section <?php echo $slider_class; ?>">
        <?php if (!empty($image)) : ?>
            <div class="data-img">
                <?php echo $image; ?>
            </div>
        <?php endif; ?>

        <div class="data-container wcl-container">
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

            <div class="data-list-out">
                <div class="data-list swiper">
                    <div class="data-list-inner swiper-wrapper">
                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                            <div class="data-item swiper-slide">
                                <a href="<?php echo get_permalink(); ?>" class="data-item-inner wcl-btn">
                                    <div class="data-item-title">
                                        <?php echo get_the_title(); ?>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                </div>

                <div class="data-list-nav">
                    <div class="data-list-nav-btn mod-prev">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-left.svg'; ?>" alt="img">
                    </div>

                    <div class="data-list-nav-btn mod-next">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-left.svg'; ?>" alt="img">
                    </div>
                </div>
            </div>
        </div>

        <div class="data-list-pagination-out">
            <div class="data-list-pagination"></div>
        </div>
    </div>
<?php endif; ?>