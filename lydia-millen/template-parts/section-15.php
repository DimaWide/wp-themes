<?php

$list = get_sub_field('list');
?>
<div class="wcl-section-15">
    <div class="data-container wcl-container">
        <?php if (!empty($list)) : ?>
            <div class="data-list-out">
                <div class="data-list swiper">
                    <div class="data-list-inner swiper-wrapper">
                        <?php foreach ((array)$list as $key => $image_id) : ?>
                            <?php
                            $image = wp_get_attachment_image($image_id, 'image-size-1');
                            ?>
                            <div class="data-item swiper-slide">
                                <?php echo $image; ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>