<?php

$image         = get_the_post_thumbnail($post->ID, 'image-size-11');
$products      = get_field('products');
$class_product = 'has-product';
$iframe        = get_field('youtube_video');

preg_match('/youtu.be\/([\s\S]+)/i', (string) $iframe, $matches);

if (!empty($iframe) && ! empty($matches[1])) {
    $iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $matches[1] .
        '?autoplay=0&controls=1&showinfo=0" title="YouTube video player" frameborder="0" 
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}

preg_match('/\/embed\/([a-zA-Z0-9_-]+)/', $iframe, $matches);
$videoId = $matches[1];

if (empty($products)) {
    $products = [''];
    $class_product = '';
} else{
    $products  = array_column((array)$products, 'product');
}

$args = array(
    'posts_per_page' => 10,
    'post_type'      => 'cd-product',
    'post__in'       => $products,
    'orderby'        => 'post__in',
);

$products_obj = get_posts($args);
?>
<div class="data-item <?php echo 'post-' . $post->ID . ' ' . $class_product; ?>" data-post-id="<?php echo $post->ID; ?>" id="<?php echo 'video-' . get_the_ID(); ?>">
    <div class="data-item-inner" onclick="gtag('event', 'https://youtu.be/<?php echo $videoId; ?>', {'event_category': 'Video','event_label': '<?php echo get_the_title(); ?>' })">
        <?php if (!empty($products_obj)) : ?>
            <div class="data-item-shop">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/video-shop-icon.svg'; ?>" alt="img">
            </div>
        <?php endif; ?>

        <?php if (!empty($iframe)) : ?>
            <div class="data-item-iframe" data-video="<?php echo esc_attr($iframe); ?>"></div>
        <?php endif; ?>

        <?php if (!empty($image)) : ?>
            <div class="data-item-img">
                <?php echo $image; ?>

                <div class="data-item-play">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-play.svg'; ?>" alt="img">
                </div>
            </div>
        <?php endif; ?>

        <h3 class="data-item-title">
            <?php echo get_the_title(); ?>
        </h3>

        <?php if (!empty($products_obj)) : ?>
            <?php
            $counter = 0;
            ob_start();
            ?>
            <div class="data-product swiper">
                <div class="data-product-inner swiper-wrapper">
                    <?php foreach ($products_obj as $product) : ?>
                        <?php
                        $counter++;
                        $product_link = get_field('link', $product->ID);
                        $product_link = !empty($product_link) ? $product_link : '#';
                        ?>
                        <div class="data-product-item swiper-slide">
                            <a href="<?php echo $product_link; ?>" target="_blank" class="data-product-item-inner">
                                <div class="data-product-item-img">
                                    <?php echo get_the_post_thumbnail($product->ID, 'image-size-2'); ?>
                                </div>

                                <div class="data-product-item-num">
                                    N°<?php echo $counter; ?>
                                </div>

                                <h3 class="data-product-item-title">
                                    <?php
                                    echo mb_strimwidth(get_the_title($product->ID), 0, 85, '...');
                                    ?>
                                </h3>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (count($products_obj) > 1) : ?>
                    <div class="data-product-nav">
                        <div class="data-product-nav-btn mod-prev">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-arrow.png'; ?>" alt="img">
                        </div>

                        <div class="data-product-nav-btn mod-next">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/sc-6-arrow.png'; ?>" alt="img">
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php
            $product = ob_get_clean();
            ?>
            <div class="data-product-a" data-product="<?php echo esc_attr($product); ?>"></div>
        <?php endif; ?>
    </div>
</div>