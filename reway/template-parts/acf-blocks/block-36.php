<?php

$tagline     = get_field('tagline');
$title       = get_field('title');
$description = get_field('description');
$image       = get_field('image');
$image       = wp_get_attachment_image($image, 'image-size-6');
$link        = get_field('link');

$style = get_field('style');
$style = !empty($style) ? $style : 'image-left';
$style = 'mod-' . $style;

$negative_bottom_margin = get_field('negative_bottom_margin');

if (!empty($negative_bottom_margin)) {
    $negative_bottom_margin = 'mod-negative-bot-margin';
}
?>
<!-- Acf Block #36 – Achieve Your Goals Quickly -->
<div class="wcl-acf-block-36 <?php echo $style; ?> <?php echo $negative_bottom_margin; ?>" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <?php if (!empty($image)) : ?>
            <div class="data-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
            </div>
        <?php endif; ?>

        <div class="data-block">
            <?php if (!empty($title)) : ?>
                <h2 class="wcl-cmp-title data-title" itemprop="headline">
                    <?php echo $title; ?>
                </h2>
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

    <div class="data-container wcl-container">
        <?php if (!empty($link)) : ?>
            <?php
            $link_url    = $link['url'];
            $link_title  = $link['title'];
            $link_target = $link['target'] ?: '_self';
            ?>
            <div class="data-link">
                <div class="data-link">
                    <button class="wcl-cmp-button js-popup-open" data-target="make-a-reservation">
                        <?php echo $link_title; ?>
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>