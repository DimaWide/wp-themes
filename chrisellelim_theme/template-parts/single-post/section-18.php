<?php

$outfit     = get_sub_field('outfit');
$shop_list  = get_field('shop', $outfit);
$thumbnail  = get_the_post_thumbnail($outfit, 'image-e');
$class_shop = 'has-shop';
if (empty($shop_list)) {
    $shop_list = [''];
    $class_shop = '';
}
$args = array(
    'post_type' => 'shop',
    'post__in'  => $shop_list,
    'orderby'   => 'post__in'
);
$shops = get_posts($args);
$data_shop = [];
?>
<div class="wcl-section-18">
    <div class="data-container wcl-container">
        <div class="data-inner">
            <?php if (!empty($shops)) : ?>
                <div class="data-a">
                    <div class="data-a-a wcl-slider">
                        <div class="d3-list-out">
                            <div class="swiper d3-list">
                                <div class="swiper-wrapper d3-list-inner">
                                    <?php foreach ($shops as $item) : ?>
                                        <?php
                                        $image = get_the_post_thumbnail($item->ID, 'image-f');
                                        $data['title'] = get_the_title($item->ID);
                                        $data['permalink'] = get_the_permalink($item->ID);
                                        if (empty($data_shop)) {
                                            $data_shop[] = $data;
                                        }
                                        ?>
                                        <div class="d3-item swiper-slide" data-title="<?php echo $data['title']; ?>" data-link="<?php echo $data['permalink']; ?>">
                                            <a href="<?php echo $data['permalink']; ?>" class="d3-item-inner" target="_blank">
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
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right-3.svg'; ?>" alt="img">
                                </div>
                                <div class="d3-list-nav-btn mod-next">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-right-3.svg'; ?>" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($data_shop)) : ?>
                        <div class="data-a-b wcl-block-2">
                            <p>
                                <?php echo $data_shop[0]['title']; ?>
                            </p>
                            <p>
                                <span>Khaite</span>
                                <a href="<?php echo $data_shop[0]['permalink']; ?>">Shop now</a>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="data-b">
                <div class="data-b-inner">
                    <?php if (!empty($thumbnail)) : ?>
                        <div class="data-b-img">
                            <?php echo $thumbnail; ?>
                        </div>
                    <?php endif; ?>

                    <div class="data-b-info">
                        <div class="data-b-info-title">
                            Shop the look
                        </div>

                        <div class="data-b-info-index">
                            <?php echo '01'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>