<?php

if (display_preview_image($block)) {
    return;
}

$title = get_field('title');
$description = get_field('description');

$bg_image = get_field('bg_image');
$bg_image = wp_get_attachment_image($bg_image, 'full');

?>
<!-- Acf Block #15 – Hero Page -->
<div class="wcl-acf-block-15">
    <div class="data-container wcl-container">
        <?php if (!empty($bg_image)) : ?>
            <div class="data-image">
                <?php echo $bg_image; ?>
            </div>
        <?php endif; ?>

        <div class="data-info">
            <?php if (!empty($title)) : ?>
                <h2 class="data-title">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($description)) : ?>
                <div class="data-desc">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>