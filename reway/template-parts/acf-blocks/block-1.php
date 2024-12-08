<?php

$title         = get_field('title');
$subtitle      = get_field('subtitle');
$slider        = get_field('slider');
$video_desktop = get_field('video_desktop');

$type_heading = get_field('type_heading');
$type_heading = !empty($type_heading) ? $type_heading : 'h2';
?>
<!-- Acf Block #1 – Extraordinary -->
<div class="wcl-acf-block-1" itemscope itemtype="https://schema.org/Article">
    <div class="data-container">
        <div class="data-info">
            <?php if (!empty($title)) : ?>
                <?php if ($type_heading == 'h1') : ?>
                    <h1 class="wcl-cmp-title data-title" itemprop="headline">
                        <?php echo $title; ?>
                    </h1>
                <?php else : ?>
                    <h2 class="wcl-cmp-title data-title" itemprop="headline">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (!empty($subtitle)) : ?>
                <div class="data-subtitle" itemprop="alternativeHeadline">
                    <?php echo $subtitle; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($slider)) : ?>
            <div class="data-slider-nav-out">
                <div class="data-slider-nav-label">
                    <?php echo $slider[0]['name_for_nav_item']; ?>
                </div>

                <div class="data-slider-nav">
                    <?php foreach ((array)$slider as $key => $item) : ?>
                        <?php
                        $name = $item['name_for_nav_item'];

                        $current = '';

                        if ($key == 0) {
                            $current = 'active';
                        }
                        ?>
                        <?php if (!empty($name)) : ?>
                            <div class="data-slider-nav-item <?php echo $current; ?>">
                                <div class="data-slider-nav-item-text">
                                    <?php echo $name; ?>
                                </div>

                                <div class="data-slider-nav-item-ico">
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="data-arrow">
            <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-down.svg'; ?>" alt="img">
        </div>

        <?php if (!empty($video_desktop)) : ?>
            <div class="data-video-btn">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/play.svg'; ?>" class="mod-img-1" alt="img">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/pause.svg'; ?>" class="mod-img-2" alt="img">
            </div>
        <?php endif; ?>

        <?php if (!empty($slider)) : ?>
            <div class="data-slider swiper" itemprop="subjectOf" itemscope itemtype="https://schema.org/ItemList">
                <div class="data-slider-inner swiper-wrapper">
                    <?php foreach ((array)$slider as $key => $item) : ?>
                        <div class="data-slider-item swiper-slide" itemprop="itemListElement">
                            <div class="data-slider-item-media">
                                <?php
                                $image = $item['image'];
                                $image = wp_get_attachment_image($image, 'image-size-1');
                                ?>
                                <?php if (!empty($image)) : ?>
                                    <div class="data-slider-item-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                                        <?php echo str_replace('<img ', '<img itemprop="url" ', $image); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php if (!empty($video_desktop)) : ?>
        <div class="data-video">
            <?php
            $video_desktop = wp_get_attachment_url($video_desktop);
            ?>
            <video autoplay muted loop playsinline>
                <source src="<?php echo $video_desktop; ?>" type="video/mp4">
            </video>
        </div>
    <?php endif; ?>
</div>