<?php


$logo               = get_field('logo', 'option');
$logo               = wp_get_attachment_image($logo, 'full');
$logo_private_black = get_field('logo_private_black', 'option');
$logo_private_black = wp_get_attachment_image($logo_private_black, 'full');

$pages               = get_field('pages', 'option');
$splendor_collective = $pages['the_splendor_collective'];
$sc_portal           = $pages['sc_portal'];

$sticky_offset = '';

if (is_front_page()) {
    $sticky_offset = 'mod-sticky-offset';
} else {
    $sticky_offset = 'mod-sticky';
}

$logged_header = '';

if (wcl_is_subscriber()) {
    $logged_header = 'wcl-header-e2';
}

// if ($_SERVER["SERVER_ADDR"] == '127.0.0.1') {
//     $logged_header = '';
// }
?>
<?php get_template_part('template-parts/header-nav'); ?>

<header class="wcl-header js-header <?php echo $logged_header . ' ' . $sticky_offset; ?>" id="wcl-main-header">
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

                <?php if (wcl_is_subscriber()) : ?>
                    <?php
                    $user = wp_get_current_user();
                    ?>
                    <div class="e2-a">
                        <div class="e2-a-logo">
                            <?php if (!empty($logo_private_black)) : ?>
                                <?php echo $logo_private_black; ?>
                            <?php endif; ?>
                        </div>

                        <div class="e2-a-name">
                            <?php if (!empty($user->first_name)) : ?>
                                <?php echo 'Hello, ' . $user->first_name; ?>
                            <?php else : ?>
                                Hello
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="e2-b">
                        <div class="e2-b-btn">
                            <a href="<?php echo get_home_url(); ?>" class="wcl-link">
                                Homepage
                            </a>
                        </div>

                        <?php wp_nav_menu(
                            array(
                                'container'      => '',
                                'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
                                'theme_location' => 'header-menu',
                                'depth'          => 2,
                                'fallback_cb'    => '',
                            )
                        ); ?>
                    </div>
                <?php else : ?>
                    <div class="data-btn">
                        <a href="<?php echo get_permalink($splendor_collective); ?>" class="wcl-link mod-gradient">
                            <span>Splendor Collective</span>
                        </a>
                    </div>

                    <?php wp_nav_menu(
                        array(
                            'container'      => '',
                            'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
                            'theme_location' => 'header-menu',
                            'depth'          => 2,
                            'fallback_cb'    => '',
                        )
                    ); ?>
                <?php endif; ?>
            </div>

            <div class="data-col">
                <div class="e2-logos">
                    <?php if (wcl_is_subscriber()) : ?>
                        <div class="e2-logos-item mod-a">
                            <div class="e2-logos-a">
                                <a href="<?php echo site_url('/'); ?>">
                                    SPLENDOR COLLECTIVE
                                </a>
                            </div>
                        </div>

                        <div class="e2-logos-item mod-b">
                            <div class="e2-logos-b">
                                <a href="<?php echo get_permalink($sc_portal); ?>">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/hd_logo_rotate.svg'; ?>" alt="img">
                                </a>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="data-logo">
                            <a href="<?php echo site_url('/'); ?>">
                                <?php if (!empty($logo)) : ?>
                                    <?php echo $logo; ?>
                                <?php else :
                                    echo get_bloginfo('name');
                                endif; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-col">
                <?php wp_nav_menu(
                    array(
                        'container'      => '',
                        'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
                        'theme_location' => 'header-menu-2',
                        'depth'          => 2,
                        'fallback_cb'    => '',
                    )
                ); ?>

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