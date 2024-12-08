<?php

if (display_preview_image($block)) {
    return;
}

$subtitle = get_field('subtitle');
$title    = get_field('title');
$bg_image = get_field('bg_image');
$bg_image = wp_get_attachment_image($bg_image, 'image-size-1');
?>
<!-- Acf Block #8 – Building -->
<div class="wcl-acf-block-8 mod-section-animate">
    <div class="data-container wcl-container">
        <div class="data-info">
            <?php if (!empty($subtitle)) : ?>
                <div class="data-subtitle">
                    <?php echo $subtitle; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($title)) : ?>
                <h2 class="data-title">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($bg_image)) : ?>
        <div class="data-bg-image">
            <?php echo $bg_image; ?>
        </div>
    <?php endif; ?>

    <div class="data-image-2">
        <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/acf-8-img.svg', false); ?>
    </div>
</div>