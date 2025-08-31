<!DOCTYPE html>
<html <?php echo get_language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1, minimum-scale=1">

    <title><?php echo wp_get_document_title(); ?></title>

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php wp_head(); ?>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Protest+Revolution&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body <?php body_class(); ?>>


    <!-- 
	====================================================================
		DEVELOPED BY WebComplete (webcomplete.io)
	====================================================================
	 -->
    
    <?php
    $logo = get_field('logo', 'option');
    $logo = wp_get_attachment_image($logo, 'full');
    ?>
    <div class="wcl-body-inner">

        <!-- HEADER -->
        <header class="sct-header" id="wcl-main-header">
            <div class="data-container wcl-container">
                <div class="data-row">
                    <div class="data-col">
                        <?php if (!empty($logo)) : ?>
                            <div class="data-logo">
                                <a href="<?php echo site_url(); ?>">
                                    <?php echo $logo; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="data-col">
                        <div class="data-nav">
                            <?php wp_nav_menu(
                                array(
                                    'container'      => '',
                                    'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
                                    'theme_location' => 'main-menu',
                                    'depth'          => 1,
                                    'fallback_cb'    => '',
                                )
                            ); ?>
                        </div>

                        <div class="data-btn-menu active mod-close">
                            <div class="data-btn-menu-item">
                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/mobile/menu-close.svg', false); ?>
                            </div>

                            <div class="data-btn-menu-item">
                                <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/mobile/menu-close.svg', false); ?>
                            </div>
                        </div>
                    </div>

                    <div class="data-col">
                        <div class="data-b1">
                            <?php
                            $selectedModel = isset($_COOKIE['selectedModel']) ? $_COOKIE['selectedModel'] : 'model-s';

                            $teslaModels = [
                                ['name' => 'Model S', 'slug' => 'model-s', 'image' => 'model-s.png'],
                                ['name' => 'Model 3', 'slug' => 'model-3', 'image' => 'model-3.png'],
                                ['name' => 'Model X', 'slug' => 'model-x', 'image' => 'model-x.png'],
                                ['name' => 'Model Y', 'slug' => 'model-y', 'image' => 'model-y.png'],
                                ['name' => 'Cybertruck', 'slug' => 'cybertruck', 'image' => 'cybertruck.png']
                            ];

                            $selectedModelData = current(array_filter($teslaModels, fn($model) => $model['slug'] === $selectedModel));
                            ?>
                            <div class="data-lang">
                                <div class="wcl-cmp-4-lang js-popup-open mod-models-car-popup" data-target="models-car-popup">
                                    <div class="cmp4-selected">
                                        <div class="cmp4-selected-car-icon">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/cars/' . $selectedModelData['image']; ?>" alt="img" id="selected-image">
                                        </div>

                                        <div class="cmp4-selected-name" id="selected-name">
                                            <?php echo $selectedModelData['name']; ?>
                                        </div>

                                        <div class="cmp4-selected-arrow">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-left.svg'; ?>" alt="img">
                                        </div>
                                    </div>

                                    <div class="cmp4-list">
                                        <?php foreach ($teslaModels as $car) : ?>
                                            <div class="cmp4-item <?php echo ($car['slug'] === $selectedModelData['slug']) ? 'active' : ''; ?>"
                                                data-slug="<?php echo $car['slug']; ?>"
                                                data-name="<?php echo $car['name']; ?>"
                                                data-image="<?php echo get_stylesheet_directory_uri() . '/img/cars/' . $car['image']; ?>">
                                                <div class="cmp4-item-icon">
                                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/cars/' . $car['image']; ?>" alt="img">
                                                </div>
                                                <div class="cmp4-item-name">
                                                    <?php echo $car['name']; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $cart_count = WC()->cart->get_cart_contents_count()
                            ?>
                            <div class="data-cart js-popup-open mod-cart-product-popup" data-target="cart-product-popup">
                                <a href="<?php echo wc_get_cart_url(); ?>" class="data-cart-inner">
                                    <div class="data-cart-icon">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/buy.svg'; ?>" alt="img">
                                    </div>

                                    <?php if (! empty($cart_count)): ?>
                                        <span class="data-cart-count">
                                            <?php echo $cart_count; ?>
                                        </span>
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header> <!-- #wcl-main-header -->