<?php




$add_links_manually = get_field('add_links_manually');
$links_manually     = get_field('links_manually');
$address            = get_field('address');
$style              = get_field('style');

$style              = !empty($style) ? $style : 'default';
$style              = 'mod-' . $style;

$visible_the_address = get_field('visible_the_address');
$visible_the_address = !empty($visible_the_address) ? $visible_the_address : 'hide';
$visible_the_address_class = 'mod-' . $visible_the_address;




if ($style == 'mod-only-white-tab') {
    $place_id = get_field('place_id');
} else {
    $place_id = $post->ID;
    $content = get_field('content');
    $gallery = get_field('gallery');
}

$place_info_booking = get_field('place_info_booking', $place_id);
$external_link      = get_field('external_link', $place_id);
$local_rating       = get_field('best_of_bali_rating', $place_id);

if (!empty($local_rating)) {
    $local_rating = (float)$local_rating / 2;
}

$place_book_now_link              = $place_info_booking['place_book_now_link'];
$place_aggregated_rating          = $place_info_booking['place_aggregated_rating'];
$place_google_rating              = $place_info_booking['place_google_rating'];
$place_trip_advisor_rating        = $place_info_booking['place_trip_advisor_rating'];
$place_google_rating_totals       = $place_info_booking['place_google_rating_totals'];
$place_trip_advisor_rating_totals = $place_info_booking['place_trip_advisor_rating_totals'];
$serpapi_price_range              = $place_info_booking['serpapi_price_range'];
$place_address_link               = $place_info_booking['place_address_link'];


$address = wcl_format_address($address);



global $wcl_price_type;
$wcl_price_type = '';

if (!empty($serpapi_price_range)) {
    $wcl_price_type = 'serp';
    $place_price_range = $serpapi_price_range;
} else {
    $wcl_price_type = 'default';
    $place_price_range = $place_info_booking['place_price_range'];
}



$stars = $place_info_booking['serp_api_hotel_class'];

if (empty($stars)) {
    $stars = get_field('stars', $place_id);
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
    'external_link'       => $external_link,
    'place_book_now_link' => $place_book_now_link,
    'add_links_manually'  => $add_links_manually,
    'links_manually'      => $links_manually,
];

?>
<!-- Acf Block #13 - Single Post Info -->
<?php if ($style == 'mod-only-white-tab') : ?>
    <!-- Style - Only White Tab -->
    <div class="wcl-acf-block-13">
        <div class="data-container wcl-container">
            <div class="data-b2">
                <div class="data-b1">
                    <div class="data-b1-head">
                        <div class="data-title">
                            <?php echo get_the_title($place_id); ?>
                        </div>

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

                        <?php if (!empty($place_aggregated_rating) && $place_aggregated_rating != '0.0') : ?>
                            <div class="wcl-block-3 data-head-rating js-trigger">
                                <div class="q3-head">
                                    <?php echo get_rating_description($place_aggregated_rating); ?>

                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-down-2.svg'; ?>" alt="img">
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php
                    $args = array(
                        'ratings' => $ratings,
                    );
                    get_template_part('template-parts/components/acf-block-13/ratings', null, $args);
                    ?>

                    <div class="data-b3-list">
                        <?php if ($visible_the_address_class == 'mod-show' && !empty($address)) : ?>
                            <div class="data-b3-item">
                                <?php if (!empty($place_address_link)) : ?>
                                    <a class="data-b3-item-inner" href="<?php echo $place_address_link; ?>" target="_blank">
                                        <div class="data-b3-item-icon">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_9_Location.svg'; ?>" alt="img">
                                        </div>

                                        <div class="data-b3-item-val">
                                            <?php echo $address; ?>
                                            <span> - Google Map</span>
                                        </div>
                                    </a>
                                <?php else : ?>
                                    <div class="data-b3-item-icon">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_9_Location.svg'; ?>" alt="img">
                                    </div>

                                    <div class="data-b3-item-val">
                                        <?php echo $address; ?>
                                        <span> - Google Map</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($place_price_range)) : ?>
                            <div class="data-b3-item">
                                <div class="data-b3-item-icon">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/dollar-symbol.svg'; ?>" alt="img">
                                </div>

                                <div class="data-b3-item-val">
                                    <span>Price Range: </span>
                                    <?php echo wcl_get_price_range($place_price_range); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php
            $args = array(
                'links' => $links,
            );
            get_template_part('template-parts/components/acf-block-9/links', null, $args);
            ?>
        </div>
    </div>
<?php else : ?>
    <!-- Style - Default -->
    <div class="wcl-acf-block-13">
        <div class="data-container wcl-container">
            <?php if (!empty($gallery)) : ?>
                <div class="data-gallery data-list swiper">
                    <div class="data-list-inner swiper-wrapper">
                        <?php foreach ((array)$gallery as $item) : ?>
                            <?php
                            $image = wp_get_attachment_image($item, 'image-size-9');
                            ?>
                            <div class="data-item swiper-slide">
                                <?php if (!empty($image)) : ?>
                                    <div class="data-item-img">
                                        <?php echo $image; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach ?>
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

            <div class="data-b2">
                <div class="data-b1">
                    <div class="data-b1-head">
                        <div class="data-title">
                            <?php echo get_the_title(); ?>
                        </div>

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

                        <?php if (!empty($place_aggregated_rating) && $place_aggregated_rating != '0.0') : ?>
                            <div class="wcl-block-3 data-head-rating js-trigger">
                                <div class="q3-head">
                                    <?php echo get_rating_description($place_aggregated_rating); ?>

                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-down-2.svg'; ?>" alt="img">
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php
                    $args = array(
                        'ratings' => $ratings,
                    );
                    get_template_part('template-parts/components/acf-block-13/ratings', null, $args);
                    ?>

                    <div class="data-b3-list">
                        <?php if ($visible_the_address_class == 'mod-show' && !empty($address)) : ?>
                            <div class="data-b3-item">
                                <?php if (!empty($place_address_link)) : ?>
                                    <a class="data-b3-item-inner" href="<?php echo $place_address_link; ?>" target="_blank">
                                        <div class="data-b3-item-icon">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_9_Location.svg'; ?>" alt="img">
                                        </div>

                                        <div class="data-b3-item-val">
                                            <?php echo $address; ?>
                                            <span> - Google Map</span>
                                        </div>
                                    </a>
                                <?php else : ?>
                                    <div class="data-b3-item-icon">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf_9_Location.svg'; ?>" alt="img">
                                    </div>

                                    <div class="data-b3-item-val">
                                        <?php echo $address; ?>
                                        <span> - Google Map</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($place_price_range)) : ?>
                            <div class="data-b3-item">
                                <div class="data-b3-item-icon">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/dollar-symbol.svg'; ?>" alt="img">
                                </div>

                                <div class="data-b3-item-val">
                                    <span>Price Range: </span>
                                    <?php echo wcl_get_price_range($place_price_range); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php
                $args = array(
                    'links' => $links,
                );
                get_template_part('template-parts/components/acf-block-9/links', null, $args);
                ?>
            </div>

            <?php if (!empty($content)) : ?>
                <div class="data-content">
                    <?php echo $content; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>