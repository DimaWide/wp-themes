<?php

$align = $args['align'];
$type = get_field('type');
$type = !empty($type) ? $type : 'youtube';
if ($align == 'right') {
    $image = get_the_post_thumbnail($post->ID, 'image-g');
} else {
    $image = get_the_post_thumbnail($post->ID, 'image-s');
}

$title = get_field('title');
if (empty($title)) {
    $title = get_the_title();
}
$youtube_link = get_field('youtube_link');
$iframe       = '';

$shop_list = get_field('shop');
$class_shop = 'has-shop';
if (empty($shop_list)) {
    $shop_list = [''];
    $class_shop = '';
}
$args = array(
    'post_type' => 'shop',
    'post__in'  => $shop_list,
    'orderby' => 'post__in'
);
$shops = get_posts($args);
$data_shop = [];
?>
<div class="d5-item <?php echo 'mod-' . $type . ' mod-' . $align . ' ' . $class_shop; ?>">
    <?php if ($type == 'youtube') : ?>
        <?php
        if (!empty($youtube_link)) {
            if ($type == 'youtube') {
                parse_str(parse_url($youtube_link, PHP_URL_QUERY), $my_array_of_vars);
                $iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $my_array_of_vars['v'] .
                    '?autoplay=1&controls=1&showinfo=0" title="YouTube video player" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            }
        }
        ?>
        <div class="d5-item-a">
            <?php if (!empty($image)) : ?>
                <div class="d5-item-a-img">
                    <?php echo $image; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($iframe)) : ?>
                <div class="d5-item-a-iframe" data-video="<?php echo esc_attr($iframe); ?>"></div>
            <?php endif; ?>

            <div class="d5-item-a-play">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/play.svg'; ?>" alt="img">
            </div>
            <div class="d5-item-a-label">
                <span>Hover to shop</span>
                <span>Watch the video</span>
            </div>
        </div>
    <?php else : ?>
        <a href="<?php echo $youtube_link; ?>" class="d5-item-a" target="_blank">
            <?php if (!empty($image)) : ?>
                <div class="d5-item-a-img">
                    <?php echo $image; ?>
                </div>
            <?php endif; ?>

            <div class="d5-item-a-play">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/play.svg'; ?>" alt="img">
            </div>

            <div class="d5-item-a-label">
                <span>Hover to shop</span>
                <span>Watch the video</span>
            </div>
        </a>
    <?php endif; ?>

    <div class="d5-item-b">
        <div class="d5-item-b-a">
            <?php if (!empty($title)) : ?>
                <h2 class="d5-item-b-a-title">
                    <a href="<?php echo $youtube_link; ?>" target="_blank">
                        <?php echo $title; ?>
                    </a>
                </h2>
            <?php endif; ?>

            <div class="d5-item-b-a-cat">
                <a href="#" class="d5-item-b-a-cat-link">
                    Fashion
                </a>
            </div>
        </div>

        <div class="d5-item-b-b">
            <div class="d5-item-b-b-note">
                Shop the video
            </div>

            <?php if (!empty($shops)) : ?>
                <div class="wcl-slider">
                    <div class="d3-list-out">
                        <div class="swiper d3-list">
                            <div class="swiper-wrapper d3-list-inner">
                                <?php foreach ($shops as $item) : ?>
                                    <?php
                                    $image = get_the_post_thumbnail($item->ID, 'image-i');
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
                    <div class="d5-item-b-b-info wcl-block-2">
                        <p>
                            <?php echo $data_shop[0]['title']; ?>
                        </p>
                        <p>
                            <span>Khaite</span>
                            <a href="<?php echo $data_shop[0]['permalink']; ?>">Shop now</a>
                        </p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>