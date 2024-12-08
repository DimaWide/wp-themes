<?php

$place_info_booking = get_field('place_info_booking', get_the_ID());
$place_google_id    = $place_info_booking['place_google_id'];
$place_address      = $place_info_booking['place_address'];
?>
<div class="wcl-section-3">
    <div class="data-container wcl-container">
        <h2 class="data-title">
            Address
        </h2>

        <?php if (!empty($place_address)) : ?>
            <div class="data-address">
                <?php echo $place_address; ?>
            </div>
        <?php endif; ?>

        <div class="data-map" data-place-id="<?php echo $place_google_id; ?>"></div>

        <div class="data-img">
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

<div class="wcl-dst-block-1">
    <?php
    $banner = get_field('banner', 'option');
    $shortcode_ads_2 = $banner['shortcode_ads_2'];
    ?>
    <?php if (!empty($shortcode_ads_2)) : ?>
        <?php echo do_shortcode($shortcode_ads_2) ?>
    <?php endif; ?>
</div>