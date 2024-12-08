<?php


$list_ids = get_field('single_post_sidebar_posts', 'option');
?>
<div class="m4-sidebar">
    <?php
    $args = array(
        'post_type'      => ['page', 'post'],
        'posts_per_page' => 4,
        'post_status'    => 'publish',
    );

    if (!empty($list_ids)) {
        $args['post__in'] = $list_ids;
        $args['orderby'] = 'post__in';
    } else{
        $args['meta_query'] = [
            'relation' => 'AND',
            array(
                'key'     => 'place_info_booking_place_aggregated_rating',
                'compare' => 'EXISTS',
            ),
            array(
                'key'     => 'place_info_booking_place_aggregated_rating',
                'compare' => '!=',
                'value'   => '0',
                'type'    => 'NUMERIC',
            ),
        ];
    }

    $query_obj   = new WP_Query($args);
    $total_count = $query_obj->found_posts;
    ?>
    <div class="m4-b1">
        <?php if ($query_obj->have_posts()) : ?>
            <h3 class="m4-b1-title">
                Must-Read Articles
            </h3>

            <div class="m4-b1-list">
                <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                    <?php
                    $image = get_the_post_thumbnail($post->ID, 'image-size-6');

                    if (empty($image)) {
                        $image = get_acf_gutenberg_image_id($post->ID);
                        $image = wp_get_attachment_image($image, 'image-size-6');
                    }
                    ?>
                    <div class="wcl-block-2 b4-b1-item">
                        <a href="<?php echo get_permalink(); ?>" class="m2-inner">
                            <div class="m2-info">
                                <h3 class="m2-title">
                                    <?php echo get_the_title(); ?>
                                </h3>
                            </div>

                            <?php if (!empty($image)) : ?>
                                <div class="m2-img">
                                    <?php echo $image; ?>
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="m4-b2">
        <div class="m4-b2-img">
            <?php
            $banner = get_field('banner', 'option');
            $shortcode_ads_1 = $banner['shortcode_ads_1'];
            ?>
            <?php if (!empty($shortcode_ads_1)) : ?>
                <?php echo do_shortcode($shortcode_ads_1) ?>
            <?php endif; ?>
        </div>
    </div>
</div>