<?php

$image_1 = get_sub_field('image_1');
$image_1 = wp_get_attachment_image($image_1, 'image-o');
$image_2 = get_sub_field('image_2');
$image_2 = wp_get_attachment_image($image_2, 'image-o');
?>
<div class="wcl-section-14">
    <div class="data-container wcl-container">
        <div class="data-inner">
            <div class="data-imgs">
                <div class="data-imgs-1">
                    <?php if (!empty($image_1)) : ?>
                        <?php echo $image_1; ?>
                    <?php endif; ?>
                </div>

                <div class="data-imgs-2">
                    <?php if (!empty($image_2)) : ?>
                        <?php echo $image_2; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>