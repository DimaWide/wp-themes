<?php


$logo               = get_field('logo', 'option');
$logo               = wp_get_attachment_image($logo, 'full');
$logo_private_black = get_field('logo_private_black', 'option');
$logo_private_black = wp_get_attachment_image($logo_private_black, 'full');

$sticky_offset = '';

if (is_front_page()) {
    $sticky_offset = 'mod-sticky-offset';
} else {
    $sticky_offset = 'mod-sticky';
}
?>
<?php get_template_part('template-parts/header-nav'); ?>

<div class="wcl-border">
    <div class="data-item"></div>
    <div class="data-item"></div>
    <div class="data-item"></div>
    <div class="data-item"></div>
</div>

<header class="wcl-header wcl-header-e3 js-header <?php echo $sticky_offset; ?>" id="wcl-main-header">
    <div class="data-container">
        <div class="data-row">
            <div class="data-col">
                <div class="wcl-t3-btn-menu">
                    <div class="t3-text">
                        <span>
                            Menu
                        </span>

                        <span>
                            Close
                        </span>
                    </div>

                    <div class="t3-img">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/hd_menu_ico.svg'; ?>" alt="img">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/popup_close.svg'; ?>" alt="img">
                    </div>
                </div>

                <div class="data-btn-b">
                    <a href="<?php echo get_home_url(); ?>" class="wcl-link">
                        Homepage
                    </a>
                </div>
            </div>

            <div class="data-col">
                <div class="data-logo">
                    <a href="<?php echo site_url('/'); ?>">
                        <?php if (!empty($logo)) : ?>
                            <?php echo $logo; ?>
                        <?php else :
                            echo get_bloginfo('name');
                        endif; ?>
                    </a>
                </div>
            </div>

            <div class="data-col">
                <div class="data-btns">
                    <div class="data-btns-item">
                        <?php get_template_part('template-parts/search-form'); ?>
                    </div>

                    <div class="data-btns-item">
                        <a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>" class="data-btns-sign wcl-t2-icon">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/sign.svg'; ?>" alt="img">
                        </a>
                    </div>

                    <?php
                    $cart = WC()->cart;
                    $product_count = $cart->get_cart_contents_count();
                    ?>
                    <div class="data-btns-item">
                        <a href="<?php echo get_permalink(wc_get_page_id('cart')); ?>" class="data-btns-cart wcl-t2-icon mod-cart">
                            <div class="t2-img">
                                <?php if (!empty($product_count)) : ?>
                                    <span><?php echo $product_count; ?></span>
                                <?php endif; ?>
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/cart.svg'; ?>" alt="img">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>