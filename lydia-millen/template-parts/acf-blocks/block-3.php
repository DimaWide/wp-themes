<?php

$title            = get_field('title');
$products         = get_field('products');
$background_color = get_field('background_color');
$background_color = !empty($background_color) ? $background_color : 'black';
$bordered         = get_field('bordered');
$bordered         = !empty($bordered) ? 'mod-border' : '';
?>
<?php if (!empty($products)) : ?>
    <div class="wcl-acf-block-3 wcl-block-clear <?php echo 'mod-' . $background_color . ' ' . $bordered; ?>">
        <div class="data-container wcl-container">
            <div class="data-inner">
                <?php if (!empty($title)) : ?>
                    <h2 class="data-title">
                        <?php echo $title; ?>
                    </h2>
                <?php endif; ?>

                <div class="data-list-out">
                    <div class="data-list swiper">
                        <div class="data-list-inner swiper-wrapper">
                            <?php foreach ((array)$products as $item_id) : ?>
                                <?php
                                $image = get_the_post_thumbnail($item_id, 'image-size-2');
                                $link  = get_field('link', $item_id);
                                ?>
                                <div class="data-item swiper-slide">
                                    <a href="<?php echo $link; ?>" target="_blank" class="data-item-inner" onclick="gtag('event', '<?php echo $link; ?>', {'event_category': 'Product','event_label': '<?php echo get_the_title($item_id); ?>' })">
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
            </div>
        </div>
    </div>
<?php endif; ?>