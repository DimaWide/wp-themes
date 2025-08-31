<?php

$title = get_field('title');
$images = get_field('images');
?>
<!-- acf-5-gallery – Gallery -->
<div class="acf-5-gallery">
    <div class="data-container wcl-container">
        <?php if (!empty($title)) : ?>
            <h2 class="data-title cmp-title">
                <?php echo $title; ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($images)) : ?>
            <div class="data-slider-out">
                <div class="data-slider-container">
                    <div class="data-slider swiper">
                        <div class="data-slider-inner swiper-wrapper">
                            <?php foreach ((array)$images as $key => $image_id) : ?>
                                <?php
                                $image_full_url = wp_get_attachment_url($image_id);
                                $image          = wp_get_attachment_image($image_id, 'image-size-3');
                                $image_alt      = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                                ?>
                                <?php if (!empty($image)) : ?>
                                    <div class="data-item swiper-slide" itemprop="itemListElement">
                                        <div class="data-item-inner">
                                            <div class="data-item-img" itemprop="image">
                                                <a href="<?php echo esc_url($image_full_url); ?>" data-fancybox="gallery-<?php echo $gallery_index; ?>" data-caption="<?php echo esc_attr($image_alt); ?>">
                                                    <?php echo $image; ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="data-slider-nav">
                        <div class="data-slider-nav-btn mod-prev">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-left.svg'; ?>" alt="img">
                        </div>

                        <div class="data-slider-pagination swiper-pagination"></div>

                        <div class="data-slider-nav-btn mod-next">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right.svg'; ?>" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>