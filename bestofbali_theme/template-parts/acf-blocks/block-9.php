<?php

$style = get_field('style');
$style = !empty($style) ? $style : '';

$add_links_manually = get_field('add_links_manually');
$links_manually     = get_field('links_manually');



// Type Solo Block

$is_solo_block = '';

if (empty($args['block-id'])) {
    $is_solo_block = 'mod-solo';
}



// Processing listing and block 15 - Get out blocks data

$mod_class = '';
$args_template = '';

if (isset($args)) {
    $args_template = $args;
}

if (!empty($args_template) && $args_template['block-id'] == 'listing') {
    $mod_class = 'mod-listing';
    $style = 'style-2';
}

if (!empty($args_template) && $args_template['block-id'] == 15) {
    $mod_class = 'mod-block-15';
    $style = 'style-2';
}


// Get Place - Post

if (isset($args['place'])) {
    $place = $args['place'];
} else {
    $place = get_field('place');
}

if (empty($place)) {
    $place = [];
}

$args = array(
    'post_type'   => 'post',
    'post__in'    => [$place],
    'post_status' => ['publish', 'private'],
);

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

$query_obj = new WP_Query($args);
?>
<!-- Acf Block #9 – Place -->
<?php if ($query_obj->have_posts()) : ?>
    <?php while ($query_obj->have_posts()) : $query_obj->the_post(); ?>
        <?php
        $external_link           = get_field('external_link', $post->ID);
        $shortcode_advertising   = get_field('shortcode_advertising', $post->ID);
        $shortcode_advertising_2 = get_field('shortcode_advertising_2', $post->ID);
        $image                   = get_the_post_thumbnail($post->ID, 'image-size-9');
        $content_block_9_place   = get_field('content_block_9_place', $post->ID);
        $place_info_booking      = get_field('place_info_booking', $post->ID);

        $place_address             = $place_info_booking['place_address'];
        $place_address_link        = $place_info_booking['place_address_link'];
        $place_book_now_link       = $place_info_booking['place_book_now_link'];
        $place_aggregated_rating   = $place_info_booking['place_aggregated_rating'];
        $place_google_rating       = $place_info_booking['place_google_rating'];
        $place_trip_advisor_rating = $place_info_booking['place_trip_advisor_rating'];
        $stars                     = $place_info_booking['serp_api_hotel_class'];
        $serpapi_price_range       = $place_info_booking['serpapi_price_range'];
        $local_rating              = get_field('best_of_bali_rating', $post->ID);

        if (!empty($local_rating)) {
            $local_rating = (float)$local_rating / 2;
        }

        
        
        
        $place_address = wcl_format_address($place_address);



        global $wcl_price_type;
        $wcl_price_type = '';

        if (!empty($serpapi_price_range)) {
            $wcl_price_type = 'serp';
            $place_price_range = $serpapi_price_range;
        } else {
            $wcl_price_type = 'default';
            $place_price_range = $place_info_booking['place_price_range'];
        }



        if (empty($stars)) {
            $stars = get_field('stars', $post->ID);
        }

        $place_google_rating_totals = $place_info_booking['place_google_rating_totals'];
        $place_trip_advisor_rating_totals = $place_info_booking['place_trip_advisor_rating_totals'];





        $class_head = '';

        if (!empty($place_google_rating) || !empty($place_trip_advisor_rating) || !empty($place_aggregated_rating)) {
            $class_head = 'mod-type-2';
        }



        $ratings = [
            [
                'name'       => 'trip-advisor',
                'value'      => $place_trip_advisor_rating,
                'count_vote' => $place_trip_advisor_rating_totals,
                'title'      => 'TripAdvisor',
            ],
            [
                'name'       => 'google',
                'value'      => $place_google_rating,
                'count_vote' => $place_google_rating_totals,
                'title'      => 'Google',
            ],
            [
                'name'       => 'local',
                'value'      => $local_rating,
                'count_vote' => 1,
                'title'      => 'Best Of Bali',
            ],
        ];



        $links = [
            'args_template'       => $args_template,
            'external_link'       => $external_link,
            'place_book_now_link' => $place_book_now_link,
            'add_links_manually'  => $add_links_manually,
            'links_manually'      => $links_manually,
        ];



        $meta_info = [
            'place_price_range'  => $place_price_range,
            'place_address'      => $place_address,
            'place_address_link' => $place_address_link,
        ];
        ?>
        <?php if ($style == 'style-2') : ?>
            <!-- Second Style - LISTINGS - BUSINESSES -->
            <div class="wcl-acf-block-9 mod-style-2 wcl-section <?php echo $is_solo_block; ?> <?php echo 'post-' . $post->ID; ?> <?php echo $mod_class; ?>">
                <div class="data-container wcl-container">
                    <div class="data-head <?php echo $class_head; ?>">
                        <h2 class="data-head-title">
                            <?php if (!empty($GLOBALS['wcl_place_counter'])) : ?>
                                <span class="data-block-number"><?php echo $GLOBALS['wcl_place_counter']; ?>.</span>
                                <?php echo get_the_title(); ?>
                            <?php else : ?>
                                <?php echo get_the_title(); ?>
                            <?php endif; ?>
                        </h2>

                        <?php
                        $stars = round((float)$stars);
                        ?>
                        <?php if (!empty($stars)) : ?>
                            <?php if (has_category('hotel', $post)) : ?>
                                <div class="data-rating-2">
                                    <?php

                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i > 5) {
                                            break;
                                        }
                                    ?>
                                        <?php if ($stars >= $i) : ?>
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/star-1.svg'; ?>" alt="img">
                                        <?php endif; ?>
                                    <?php
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php
                        $class = '';

                        if (empty($place_google_rating)) {
                            $class = 'mod-type-2';
                        }
                        ?>
                        <?php if (!empty($place_aggregated_rating) && $place_aggregated_rating != '0.0') : ?>
                            <div class="data-head-rating <?php echo $class; ?>">
                                <?php echo get_rating_description($place_aggregated_rating); ?>

                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-down-2.svg'; ?>" alt="img">
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php
                    $args = array(
                        'ratings' => $ratings,
                    );
                    get_template_part('template-parts/components/acf-block-9/ratings', null, $args);
                    ?>

                    <?php if (!empty($image)) : ?>
                        <div class="data-img ">
                            <?php echo $image; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($content_block_9_place)) : ?>
                        <div class="data-desc">
                            <?php echo $content_block_9_place; ?>
                        </div>
                    <?php endif; ?>


                    <?php
                    $args = array(
                        'meta_info' => $meta_info,
                    );
                    get_template_part('template-parts/components/acf-block-9/meta-info', null, $args);
                    ?>


                    <?php
                    $args = array(
                        'links' => $links,
                    );
                    get_template_part('template-parts/components/acf-block-9/links', null, $args);
                    ?>

                    <?php if (!empty($shortcode_advertising) || !empty($shortcode_advertising_2)) : ?>
                        <div class="data-ads">
                            <?php if (!empty($shortcode_advertising)) : ?>
                                <div class="data-ads-item">
                                    <?php echo do_shortcode($shortcode_advertising); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($shortcode_advertising_2)) : ?>
                                <div class="data-ads-item">
                                    <?php echo do_shortcode($shortcode_advertising_2); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php else : ?>
            <!-- Style - Default -->
            <div class="wcl-acf-block-9 mod-default wcl-section <?php echo $is_solo_block; ?> <?php echo 'post-' . $post->ID; ?> <?php echo $mod_class; ?>">
                <div class="data-container wcl-container">
                    <div class="data-head <?php echo $class_head; ?>">
                        <h2 class="data-head-title">
                            <?php if (!empty($GLOBALS['wcl_place_counter'])) : ?>
                                <span class="data-block-number"><?php echo $GLOBALS['wcl_place_counter']; ?>.</span>
                                <?php echo get_the_title(); ?>
                            <?php else : ?>
                                <?php echo get_the_title(); ?>
                            <?php endif; ?>
                        </h2>

                        <?php
                        $stars = round((float)$stars);
                        ?>
                        <?php if (!empty($stars)) : ?>
                            <?php if (has_category('hotel', $post)) : ?>
                                <div class="data-rating-2">
                                    <?php

                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i > 5) {
                                            break;
                                        }
                                    ?>
                                        <?php if ($stars >= $i) : ?>
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/star-1.svg'; ?>" alt="img">
                                        <?php endif; ?>
                                    <?php
                                    }
                                    ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php
                        $class = '';

                        if (empty($place_google_rating)) {
                            $class = 'mod-type-2';
                        }
                        ?>
                        <?php if (!empty($place_aggregated_rating) && $place_aggregated_rating != '0.0') : ?>
                            <div class="data-head-rating <?php echo $class; ?>">
                                <?php echo get_rating_description($place_aggregated_rating); ?>

                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-down-2.svg'; ?>" alt="img">
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php
                    $args = array(
                        'ratings' => $ratings,
                    );
                    get_template_part('template-parts/components/acf-block-9/ratings', null, $args);
                    ?>

                    <?php if (!empty($image)) : ?>
                        <div class="data-img">
                            <?php echo $image; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($content_block_9_place)) : ?>
                        <div class="data-desc">
                            <?php echo $content_block_9_place; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($place_address)) : ?>
                        <div class="data-meta">
                            <div class="data-meta-address">
                                <?php if (!empty($place_address_link)) : ?>
                                    <a class="data-meta-address-inner" href="<?php echo $place_address_link; ?>" target="_blank">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/Location-blue.svg'; ?>" alt="img">
                                        <?php echo $place_address; ?>
                                        <span> - Google Map</span>
                                    </a>
                                <?php else : ?>
                                    <?php echo $place_address; ?>
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/Location-blue.svg'; ?>" alt="img">
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php
                    $args = array(
                        'links' => $links,
                    );
                    get_template_part('template-parts/components/acf-block-9/links', null, $args);
                    ?>

                    <?php if (!empty($shortcode_advertising) || !empty($shortcode_advertising_2)) : ?>
                        <div class="data-ads">
                            <?php if (!empty($shortcode_advertising)) : ?>
                                <div class="data-ads-item">
                                    <?php echo do_shortcode($shortcode_advertising); ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($shortcode_advertising_2)) : ?>
                                <div class="data-ads-item">
                                    <?php echo do_shortcode($shortcode_advertising_2); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endwhile;
    wp_reset_postdata(); ?>
<?php endif; ?>