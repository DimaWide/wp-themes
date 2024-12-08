<?php

$title    = get_field('title');
$subtitle = get_field('subtitle');
$link     = get_field('link');

$select_by = get_field('select_by');
$select_by = !empty($select_by) ? $select_by : '';

$style       = get_field('style');
$style       = !empty($style) ? $style : 'default';
$style_class = 'mod-' . $style;

$posts_per_page = 3;
$slider_class     = '';

$slider = get_field('slider');

if ($style == '4-item') {
    $posts_per_page = 4;
}

if (!empty($slider)) {
    $slider_class = 'mod-slider';
    $posts_per_page = -1;
}
?>
<!-- Acf Block #2 - Find Bali's Finest Accommodations Tailored for You -->
<div class="wcl-acf-block-2 wcl-section <?php echo $style_class . ' ' . $slider_class; ?>">
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

        <?php
        $args = [];
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
        <?php if ($slider_class == 'mod-slider') : ?>
            <?php if ($query_obj->have_posts()) : ?>
                <div class="data-list-out">
                    <div class="data-list-inner-two">
                        <div class="data-list swiper">
                            <div class="data-list-inner swiper-wrapper">
                                <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                                    <?php
                                    $cats  = get_the_terms($post->ID, 'category');
                                    $image = get_the_post_thumbnail($post->ID, 'image-size-3');
                                    ?>
                                    <div class="data-item swiper-slide">
                                        <a href="<?php echo get_permalink(); ?>" class="data-item-inner">
                                            <?php if (!empty($image)) : ?>
                                                <div class="data-item-img">
                                                    <?php echo $image; ?>
                                                </div>
                                            <?php endif; ?>

                                            <div class="data-item-info">
                                                <?php if (!empty($cats)) : ?>
                                                    <div class="data-item-cat">
                                                        <?php echo $cats[0]->name; ?>
                                                    </div>
                                                <?php endif; ?>

                                                <h3 class="data-item-title">
                                                    <?php echo strtolower(get_the_title()); ?>
                                                </h3>
                                            </div>
                                        </a>
                                    </div>
                                <?php endwhile;
                                wp_reset_postdata(); ?>
                            </div>
                        </div>

                        <div class="data-list-nav">
                            <div class="data-list-nav-btn mod-prev">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-right-blue.svg'; ?>" alt="img">
                            </div>

                            <div class="data-list-nav-btn mod-next">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-right-blue.svg'; ?>" alt="img">
                            </div>
                        </div>
                    </div>

                    <?php
                    $active_nav = '';
                    if ($total_count > $posts_per_page) {
                        $active_nav = 'active';
                    }
                    ?>
                    <div class="data-list-pagination-out <?php echo $active_nav; ?>">
                        <div class="data-list-pagination"></div>
                    </div>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <?php if ($query_obj->have_posts()) : ?>
                <div class="data-list">
                    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                        <?php
                        $cats  = get_the_terms($post->ID, 'category');
                        $image = get_the_post_thumbnail($post->ID, 'image-size-3');
                        ?>
                        <div class="data-item">
                            <a href="<?php echo get_permalink(); ?>" class="data-item-inner">
                                <?php if (!empty($image)) : ?>
                                    <div class="data-item-img">
                                        <?php echo $image; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="data-item-info">
                                    <?php if (!empty($cats)) : ?>
                                        <div class="data-item-cat">
                                            <?php echo $cats[0]->name; ?>
                                        </div>
                                    <?php endif; ?>

                                    <h3 class="data-item-title">
                                        <?php echo strtolower(get_the_title()); ?>
                                    </h3>
                                </div>
                            </a>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (!empty($link)) : ?>
            <?php
            $link_url    = $link['url'];
            $link_title  = $link['title'];
            $link_target = $link['target'] ?: '_self';
            ?>
            <div class="data-link wcl-block-4-link">
                <a href="<?php echo $link_url; ?>" class="wcl-btn" target="<?php echo $link_target; ?>">
                    <?php echo $link_title; ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>