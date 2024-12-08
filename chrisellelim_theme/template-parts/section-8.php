<?php


$image   = get_sub_field('image');
$image   = wp_get_attachment_image($image, 'image-c');
$image_2 = get_sub_field('image_2');
$image_2 = wp_get_attachment_image($image_2, 'image-k');
$logo    = get_sub_field('logo');
$logo    = wp_get_attachment_image($logo);
?>
<div class="wcl-section-8">
    <div class="data-imgs">
        <?php if (!empty($image)) : ?>
            <?php echo $image; ?>
        <?php endif; ?>
        
        <?php if (!empty($image_2)) : ?>
            <?php echo $image_2; ?>
        <?php endif; ?>
    </div>

    <div class="data-container wcl-container">
        <?php if (!empty($logo)) : ?>
            <h1 class="data-title">
                <?php echo $logo; ?>
            </h1>
        <?php endif; ?>
    </div>
</div>