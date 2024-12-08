<?php

$banner_1 = get_field('banner_1');
$banner_2 = get_field('banner_2');
?>
<!-- Acf Block #1 – Слайдер, Банер -->
<div class="wcl-acf-block-1 cmp-5-grid">
    <div class="data-container wcl-container">
        <div class="cmp5-row data-row">
            <div class="cmp5-col data-col">
                <?php get_template_part('template-parts/sidebar'); ?>
            </div>

            <div class="cmp5-col data-col">
                <?php if (have_rows('slider')) : ?>
                    <div class="data-slider swiper">
                        <div class="data-slider-inner swiper-wrapper">
                            <?php while (have_rows('slider')) : the_row(); ?>
                                <?php
                                $image    = get_sub_field('image');
                                $image    = wp_get_attachment_image($image, 'image-size-1');
                                $link     = get_sub_field('link');
                                $link_url = !empty($link_url) ? $link_url : '#';
                                ?>
                                <div class="data-item swiper-slide">
                                    <a href="<?php echo $link_url; ?>" class="data-item-inner">
                                        <?php if (!empty($image)) : ?>
                                            <div class="data-item-img">
                                                <?php echo $image; ?>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>
                            <?php endwhile; ?>
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
                <?php endif; ?>

                <div class="data-b1 mod-type-1">
                    <div class="data-b1-col">
                        <?php if (!empty($banner_1)) : ?>
                            <?php
                            $image    = $banner_1['image'];
                            $image    = wp_get_attachment_image($image, 'image-size-2');
                            $link     = $banner_1['link'];
                            $link_url = !empty($link_url) ? $link_url : '#';
                            ?>
                            <div class="data-banner">
                                <a href="<?php echo $link_url; ?>" class="data-banner-inner">
                                    <?php if (!empty($image)) : ?>
                                        <div class="data-banner-img">
                                            <?php echo $image; ?>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="data-b1-col">
                        <?php if (!empty($banner_2)) : ?>
                            <?php
                            $image    = $banner_2['image'];
                            $image    = wp_get_attachment_image($image, 'image-size-2');
                            $link     = $banner_2['link'];
                            $link_url = !empty($link_url) ? $link_url : '#';
                            ?>
                            <div class="data-banner">
                                <a href="<?php echo $link_url; ?>" class="data-banner-inner">
                                    <?php if (!empty($image)) : ?>
                                        <div class="data-banner-img">
                                            <?php echo $image; ?>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>