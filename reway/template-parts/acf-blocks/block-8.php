<?php

$title  = get_field('title');
$note   = get_field('note');
$images = get_field('images');
?>
<!-- Acf Block #8 – Gallery -->
<div class="wcl-acf-block-8" itemscope itemtype="https://schema.org/Article">
    <div class="data-container wcl-container">
        <div class="data-info">
            <?php if (!empty($title)) : ?>
                <h2 class="data-title" itemprop="headline">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($note)) : ?>
                <div class="data-note" itemprop="text">
                    <?php echo $note; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (!empty($images)) : ?>
        <div class="data-slider-out">
            <div class="data-slider-container" itemprop="subjectOf" itemscope itemtype="https://schema.org/ItemList">
                <div class="data-slider swiper">
                    <div class="data-slider-inner swiper-wrapper">
                        <?php foreach ((array)$images as $key => $image_id) : ?>
                            <?php
                            $image = wp_get_attachment_image($image_id, 'image-size-5');
                            ?>
                            <?php if (!empty($image)) : ?>
                                <div class="data-slider-item swiper-slide" itemprop="itemListElement">
                                    <div class="data-slider-item-inner">
                                        <div class="data-slider-item-img" itemprop="image">
                                            <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach ?>
                    </div>
                </div>

                <div class="data-slider-nav">
                    <div class="data-slider-nav-btn mod-prev">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-left.svg'; ?>" alt="img">
                    </div>

                    <div class="data-slider-nav-btn mod-next">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-left.svg'; ?>" alt="img">
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>