<?php

$image_1 = get_field('image_1');
$image_1 = wp_get_attachment_image($image_1, 'image-size-11');
$image_2 = get_field('image_2');
$image_2 = wp_get_attachment_image($image_2, 'image-size-11');
?>
<div class="wcl-acf-block-5 wcl-block-clear">
    <div class="data-inner">
        <div class="data-container wcl-container">
            <div class="data-row">
                <div class="data-col">
                    <?php if (!empty($image_1)) : ?>
                        <div class="data-img">
                            <?php echo $image_1; ?>

                            <div class="wcl-shape">
                                <div class="d5-item"></div>
                                <div class="d5-item"></div>
                                <div class="d5-item"></div>
                                <div class="d5-item"></div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="data-col">
                    <?php if (!empty($image_2)) : ?>
                        <div class="data-img">
                            <?php echo $image_2; ?>

                            <div class="wcl-shape">
                                <div class="d5-item"></div>
                                <div class="d5-item"></div>
                                <div class="d5-item"></div>
                                <div class="d5-item"></div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>