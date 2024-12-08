<?php

$image    = get_field('image');
$image    = wp_get_attachment_image($image, 'full');
$products = get_field('products');
return;
?>
<div class="wcl-acf-block-10 wcl-block-clear">
    <div class="data-container wcl-container">
        <div class="data-inner">
            <?php if (!empty($image)) : ?>
                <h2 class="data-image">
                    <?php echo $image; ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($products)) : ?>
                <div class="data-list-out">
                    <div class="data-list swiper">
                        <div class="data-list-inner swiper-wrapper">
                            <?php foreach ((array)$products as $item_id) : ?>
                                <?php
                                $image = get_the_post_thumbnail($item_id, 'image-size-2');
                                $link  = get_field('link', $item_id);
                                ?>
                                <div class="data-item swiper-slide">
                                    <a href="<?php echo $link; ?>" target="_blank" class="data-item-inner">
                                        <div class="data-item-img">
                                            <?php if (!empty($image)) : ?>
                                                <?php echo $image; ?>
                                            <?php endif; ?>

                                            <div class="wcl-post-view">
                                                Shop Now
                                            </div>
                                        </div>

                                        <h3 class="data-item-title">
                                            <?php echo get_the_title($item_id); ?>
                                        </h3>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="data-list-nav">
                        <div class="data-list-nav-btn mod-prev">
                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/acf-block-3-arrow-left.svg'); ?>
                        </div>

                        <div class="data-list-nav-btn mod-next">
                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/acf-block-3-arrow-left.svg'); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>