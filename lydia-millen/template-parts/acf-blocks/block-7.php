<?php


$image = get_field('image');
$image = wp_get_attachment_image($image, 'image-size-11');
$title = get_field('title');
$copy  = get_field('copy');
?>
<div class="wcl-acf-block-7 wcl-block-clear">
    <div class="data-inner">
        <div class="data-container wcl-container">
            <div class="data-row">
                <?php if (!empty($image)) : ?>
                    <div class="data-col data-a">
                        <div class="data-img">
                            <?php echo $image; ?>

                            <div class="wcl-shape">
                                <div class="d5-item"></div>
                                <div class="d5-item"></div>
                                <div class="d5-item"></div>
                                <div class="d5-item"></div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="data-col data-b">
                    <?php if (!empty($title)) : ?>
                        <h2 class="data-title">
                            <?php echo $title; ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (!empty($copy)) : ?>
                        <div class="data-text">
                            <?php echo wpautop($copy); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>