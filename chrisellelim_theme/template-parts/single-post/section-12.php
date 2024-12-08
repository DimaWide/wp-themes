<?php

$title       = get_sub_field('title');
$image_id       = get_sub_field('image');
$image       = wp_get_attachment_image($image_id, 'image-o');
$photography = get_sub_field('photography');
$location    = get_sub_field('location');
$type        = get_sub_field('type');
$type        = !empty($type) ? $type : 'h';
if ($type == 'v') {
    $image = wp_get_attachment_image($image_id, 'image-o-2');
}
?>
<div class="wcl-section-12 <?php echo 'type-' . $type; ?>">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h1 class="data-title">
                <?php echo $title; ?>
            </h1>
        <?php endif; ?>

        <div class="data-a">
            <?php if (!empty($image)) : ?>
                <div class="data-img">
                    <?php echo $image; ?>
                </div>
            <?php endif; ?>

            <div class="data-info">
                <div class="data-info-item">
                    <span class="data-info-item-label">
                        Photography
                    </span>

                    <?php if (!empty($photography)) : ?>
                        <span class="data-info-item-name">
                            <?php echo $photography; ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="data-info-item">
                    <span class="data-info-item-label">
                        Location
                    </span>

                    <?php if (!empty($location)) : ?>
                        <span class="data-info-item-name">
                            <?php echo $location; ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="data-mask"></div>
</div>