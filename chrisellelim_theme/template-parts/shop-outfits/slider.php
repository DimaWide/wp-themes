<?php

$shops = $args['shops'];
?>
<div class="wcl-slider">
    <div class="d3-list-out">
        <div class="swiper d3-list">
            <div class="swiper-wrapper d3-list-inner">
                <?php foreach ($shops as $item) : ?>
                    <?php
                    $image = get_the_post_thumbnail($item->ID, 'image-i');
                    $link  = get_field('link', $item->ID);
                    ?>
                    <div class="d3-item swiper-slide">
                        <a href="<?php echo $link; ?>" class="d3-item-inner" target="_blank">
                            <?php if (!empty($image)) : ?>
                                <div class="d3-item-img">
                                    <?php echo $image; ?>
                                </div>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="d3-list-nav">
            <div class="d3-list-nav-btn mod-prev">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right-4.svg'; ?>" alt="img">
            </div>
            <div class="d3-list-nav-btn mod-next">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right-4.svg'; ?>" alt="img">
            </div>
        </div>
    </div>
</div>