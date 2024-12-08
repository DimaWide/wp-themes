<?php

$in_wishlist = '';

if (product_in_wishlist_user($post->ID)) {
    $in_wishlist = 'mod-in-wishlist';
}

$counter = isset($GLOBALS['wcl_counter']) ? $GLOBALS['wcl_counter'] : '';

$product    = wc_get_product($post->ID);
$product_id = $product->get_id();
$price      = $product->get_price();
$price      = $product->get_regular_price();
$sale_price = $product->get_sale_price();
$image      = get_the_post_thumbnail($product_id, 'image-size-3');

if (!is_user_logged_in()) {
    $in_wishlist = is_product_in_wishlist($product_id) ? 'mod-in-wishlist' : '';
}
?>
<div class="cmp-3-product data-item js-post-item <?php echo $in_wishlist; ?> product-<?php echo $product_id; ?>" data-id="<?php echo $product_id; ?>">
    <div class="cmp3-inner">
        <div class="cmp3-wishlist-btn <?php echo (!empty($in_wishlist)) ? 'active mod-added' : ''; ?>">
            <div class="cmp3-wishlist-btn-item">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/hearth.png'; ?>" alt="img">
            </div>

            <div class="cmp3-wishlist-btn-item">
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/hearth-fill.png'; ?>" alt="img">
            </div>

            <div class="cmp3-wishlist-btn-notify"> </div>
        </div>

        <a href="<?php the_permalink(); ?>" class="cmp3-b1">
            <div class="cmp3-label">
                <?php if (is_product_best_seller($product_id)) : ?>
                    <span class="mod-top-seller">Топ подажів</span>
                <?php elseif (is_product_new($product_id)) : ?>
                    <span class="mod-new">Новинка</span>
                <?php elseif ($product->is_on_sale()) : ?>
                    <span class="mod-featured">Акція</span>
                <?php endif; ?>
            </div>

            <?php if (!empty($image)) : ?>
                <div class="cmp3-image">
                    <?php echo $image; ?>
                </div>
            <?php endif; ?>
        </a>

        <div class="cmp3-info">
            <h3 class="cmp3-title js-post-item-title">
                <div class="cmp3-title-inner">
                    <?php echo get_the_title(); ?>
                </div>
            </h3>

            <div class="cmp3-b2">
                <?php if ($product->is_on_sale()) : ?>
                    <div class="cmp3-price mod-is-sale">
                        <div class="cmp3-price-old"><?php echo wc_price($price); ?></div>
                        <div class="cmp3-price-new"><?php echo wc_price($sale_price); ?></div>
                    </div>
                <?php else : ?>
                    <span class="cmp3-price"><?php echo wc_price($price); ?></span>
                <?php endif; ?>

                <div class="cmp3-cart" data-product-id="<?php echo $product_id; ?>">
                    <div class="cmp3-cart-inner">
                        <a class="cmp3-cart-inner-2" href="<?php echo get_permalink($product_id) . $product->add_to_cart_url(); ?>">
                            <div class="cmp3-cart-button-text">
                                <span>В кошик</span>
                            </div>

                            <div class="cmp3-cart-button-ico">
                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/cart-ico.svg', false); ?>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>