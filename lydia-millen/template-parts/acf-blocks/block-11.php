<?php


$title   = get_field('title');
$copy    = get_field('copy');
$content = get_field('content');
$image_1 = get_field('image_1');
$image_1 = wp_get_attachment_image($image_1, 'image-size-11');
$image_2 = get_field('image_2');
$image_2 = wp_get_attachment_image($image_2, 'image-size-11');
return;
?>
<div class="wcl-acf-block-11 wcl-block-clear">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($image_1)) : ?>
                    <div class="data-img">
                        <?php echo $image_1; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <?php if (!empty($title)) : ?>
                    <h2 class="data-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($copy)) : ?>
                    <div class="data-copy">
                        <?php echo $copy; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($content)) : ?>
                    <h2 class="data-content">
                        <?php echo $content; ?>
                    </h2>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <?php if (!empty($image_2)) : ?>
                    <div class="data-img">
                        <?php echo $image_2; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>