<?php

$section_posts_in_down = get_field('section_posts_in_down', 'option');

$place = get_the_terms($post->ID, 'wcl-place');
if (!empty($place)) {
    $place = $place[0]->slug;
} else {
    $place = '';
}
?>

<?php foreach ((array)$section_posts_in_down as $key => $section) : ?>
    <?php
    $title           = $section['title'];
    $subtitle        = $section['subtitle'];
    $places          = $section['places'];
    $category        = $section['category'];
    $show_on_website = $section['show_on_website'] ?? true;

    if (empty($show_on_website)) {
        continue;
    }

    $args = array(
        'post_type'      => ['page', 'post'],
        'posts_per_page' => 3,
        'post_status'    => 'publish',
        'post__not_in'   => array(get_the_ID()),
    );

    if (!empty($places)) {
        $args['post__in'] = $places;
        $args['orderby'] = 'post__in';
    }

    if (empty($places)) {
        $tax_query = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'category',
                'field'    => 'id',
                'terms'    => $category,
            ),
            array(
                'taxonomy' => 'wcl-place',
                'field'    => 'slug',
                'terms'    => $place,
            )
        );

        $args['tax_query'] = $tax_query;

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
    <?php if ($query_obj->have_posts()) : ?>
        <!-- Acf Block #2 - Find Bali's Finest Accommodations Tailored for You -->
        <div class="wcl-acf-block-2 mod-destination wcl-section mod-slider">
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

                <div class="data-list swiper">
                    <div class="data-list-inner swiper-wrapper">
                        <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
                            <?php
                            $cats  = get_the_terms($post->ID, 'category');
                            $image = get_the_post_thumbnail($post->ID, 'image-size-3');

                            if (empty($image)) {
                                $image = get_acf_gutenberg_image_id($post->ID);
                                $image = wp_get_attachment_image($image, 'image-size-3');
                            }
                            ?>
                            <div class="data-item swiper-slide post-<?php echo $post->ID; ?>">
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
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>