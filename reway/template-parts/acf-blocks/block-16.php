<?php

$tagline           = get_field('tagline');
$title             = get_field('title');
$description       = get_field('description');
$image             = get_field('image');
$image             = wp_get_attachment_image($image, 'image-size-1');
$hotel_information = get_field('hotel_information', 'option');

$type_heading = get_field('type_heading');
$type_heading = !empty($type_heading) ? $type_heading : 'h2';
?>
<!-- Acf Block #16 – Luxurious Spa Experience in a Hotel Concept -->
<div class="wcl-acf-block-16" itemscope itemtype="https://schema.org/Article">
    <?php if (!empty($image)) : ?>
        <div class="data-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
            <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
        </div>
    <?php endif; ?>

    <div class="data-container wcl-container">
        <div class="data-inner">
            <?php if (!empty($tagline)) : ?>
                <div class="wcl-cmp-tagline data-tagline" itemprop="alternativeHeadline">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/marker.svg'; ?>" alt="img"><?php echo $tagline; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($title)) : ?>
                <?php if ($type_heading == 'h1') : ?>
                    <h1 class="wcl-cmp-title data-title" itemprop="headline">
                        <?php echo $title; ?>
                    </h1>
                <?php else : ?>
                    <h2 class="wcl-cmp-title data-title" itemprop="headline">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (!empty($hotel_information)) : ?>
                <div class="wcl-cmp-2-hotel-info data-hotel">
                    <?php
                    $rating  = $hotel_information['rating'];
                    $reviews = $hotel_information['number_reviews'];

                    $rating_round = round((float)$rating);
                    ?>
                    <?php if (!empty($rating)) : ?>
                        <div class="cmp2-rating">
                            <div class="cmp2-rating-val">
                                <?php echo $rating; ?>
                            </div>

                            <div class="cmp2-rating-stars">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                ?>
                                    <?php if ($rating_round >= $i) : ?>
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/star.svg'; ?>" alt="star">
                                    <?php endif; ?>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($reviews)) : ?>
                        <div class="cmp2-reviews">
                            <?php echo $reviews . ' user <br> reviews'; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($description)) : ?>
                <div class="wcl-cmp-info data-info">
                    <div class="wcl-cmp-desc data-desc" itemprop="description">
                        <?php echo $description; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>