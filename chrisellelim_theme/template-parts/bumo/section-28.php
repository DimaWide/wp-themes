<?php


$title    = get_sub_field('title');
$subtitle = get_sub_field('subtitle');
$image_1  = get_sub_field('image_1');
$image_1  = wp_get_attachment_image($image_1, 'image-v');
$image_2  = get_sub_field('image_2');
$image_2  = wp_get_attachment_image($image_2, 'image-v');
?>
<div class="wcl-section-28">
    <div class="data-a">
        <div class="data-container wcl-container">
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

            <div class="data-el">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/sound-wave-2.png'; ?>" alt="img">
            </div>
        </div>
    </div>

    <div class="data-b">
        <div class="data-imgs">
            <?php if (!empty($image_1)) : ?>
                <div class="data-imgs-item">
                    <?php echo $image_1; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($image_2)) : ?>
                <div class="data-imgs-item">
                    <?php echo $image_2; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>