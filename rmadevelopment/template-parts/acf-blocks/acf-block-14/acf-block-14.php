<?php

if (display_preview_image($block)) {
    return;
}

$title           = get_field('title');
$form_shortcode  = get_field('form_shortcode');
$location_in_map = get_field('location_in_map');

$contact_info = get_field('contact_info', 'option');
$address      = $contact_info['address'];
$email        = $contact_info['email'];
$phone        = $contact_info['phone'];
?>
<!-- Acf Block #14 – Contact Info & Form -->
<div class="wcl-acf-block-14">
    <div class="data-container wcl-container">
        <div class="data-info">
            <?php if (!empty($address)) : ?>
                <div class="data-info-item">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/location.svg'; ?>" alt="img">
                    <?php echo $address; ?>
                </div>
            <?php endif; ?>

            <?php if (! empty($email)): ?>
                <div class="data-info-item">
                    <a href="mailto:<?php echo $email; ?>">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/message.svg'; ?>" alt="img">
                        <?php echo $email; ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php if (!empty($phone)) : ?>
                <?php
                $phone_clean = preg_replace('/[^\d+]/', '', $phone);
                ?>
                <div class="data-info-item">
                    <a href="tel:<?php echo $phone_clean; ?>">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/call.svg'; ?>" alt="img">
                        <?php echo $phone; ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <div class="data-form">
            <?php if (!empty($title)) : ?>
                <h2 class="data-form-title">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($form_shortcode)) : ?>
                <div class="data-form-fields">
                    <?php echo do_shortcode($form_shortcode); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="data-map">
            <?php if (!empty($location_in_map)) : ?>
                <div class="data-map">
                    <?php echo $location_in_map; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>