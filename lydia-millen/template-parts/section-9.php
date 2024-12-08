<?php


$images = get_sub_field('images');
$text   = get_sub_field('text');
?>
<div class="wcl-section-9">
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
                <?php if (!empty($images)) : ?>
                    <div class="data-list swiper">
                        <div class="data-list-inner swiper-wrapper">
                            <?php foreach ((array)$images as $key => $image_id) : ?>
                                <?php
                                $image = wp_get_attachment_image($image_id, 'image-size-11');
                                ?>
                                <div class="data-item swiper-slide">
                                    <?php echo $image; ?>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <?php if (!empty($text)) : ?>
                    <div class="data-text">
                        <div class="data-text-inner">
                            <?php echo wpautop($text); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>