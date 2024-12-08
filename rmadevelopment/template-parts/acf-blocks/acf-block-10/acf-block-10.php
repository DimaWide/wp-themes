<?php

if (display_preview_image($block)) {
    return;
}

$title    = get_field('title');
$subtitle = get_field('subtitle');
$image    = get_field('bg_image');
$image    = wp_get_attachment_image($image, 'image-size-7');
?>
<!-- Acf Block #10 – Hero Page -->
<div class="wcl-acf-block-10">
    <div class="data-container wcl-container">
        <div class="data-inner">
            <?php if (!empty($title)) : ?>
                <h1 class="data-title">
                    <?php echo $title; ?>
                </h1>
            <?php endif; ?>

            <?php if (!empty($subtitle)) : ?>
                <div class="data-subtitle">
                    <?php echo $subtitle; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($image)) : ?>
                <div class="data-image">
                    <?php echo $image; ?>
                </div>
            <?php endif; ?>

            <?php if (wcl_is_page('blog')): ?>
                <div class="data-lines-2">
                    <div class="line-container" data-length="128" data-orientation="vertical" data-offset="-400" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>

                    <div class="line-container" data-length="600" data-orientation="horizontal" data-offset="-400" data-scroll-coefficient="1">
                        <div class="line"></div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="data-lines">
                <div class="line-container" data-length="749" data-orientation="horizontal" data-offset="0" data-scroll-coefficient="1">
                    <div class="line"></div>
                </div>

                <div class="line-container" data-length="583" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                    <div class="line"></div>
                </div>

                <div class="line-container" data-length="583" data-orientation="vertical" data-offset="0" data-scroll-coefficient="1">
                    <div class="line"></div>
                </div>

                <div class="line-container" data-length="749" data-orientation="horizontal" data-offset="0" data-scroll-coefficient="1">
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </div>
</div>