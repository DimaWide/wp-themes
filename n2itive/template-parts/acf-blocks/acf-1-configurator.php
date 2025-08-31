<?php

$title    = get_field('title');
$subtitle = get_field('subtitle');

?>
<!-- acf-1-configurator – Configurator -->
<div class="acf-1-configurator">
    <?php
    $data = get_tesla_configurator_data();

    $selectedModel     = $data['selectedModel'];
    $selectedCarOption = $data['selectedCarOption'];
    $selectedYear      = $data['selectedYear'];
    $stateConfigurator = $data['stateConfigurator'];
    $options           = $data['options'];
    $teslaModels       = $data['teslaModels'];

    $activeSlideIndex = array_search($selectedModel, array_column($teslaModels, 'slug'));

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 50,
        'tax_query'      => array(
            'relation' => 'AND',
        ),
    );

    if (! empty($selectedModel)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'pa_model',
            'field'    => 'slug',
            'terms'    => $selectedModel,
        );
    }

    if (! empty($selectedCarOption)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'pa_setting-options',
            'field'    => 'slug',
            'terms'    => $selectedCarOption,
        );
    }

    if (! empty($selectedYear)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'pa_model-year',
            'field'    => 'slug',
            'terms'    => $selectedYear,
        );
    }

    $query = new WP_Query($args);
    $post_count = $query->post_count;
    ?>
    <div class="data-container wcl-container">
        <div class="data-header">
            <?php if (!empty($title)) : ?>
                <h2 class="data-title">
                    <?php echo $title; ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($subtitle)) : ?>
                <div class="data-subtitle">
                    <?php echo $subtitle; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="data-row">
            <div class="data-col">
                <div class="data-year-select year-selection-container">
                    <div class="year-selection-container">
                        <select id="yearSelect">
                            <?php if (!empty($selectedModel)): ?>
                                <option value="" disabled> Select year</option>
                            <?php else: ?>
                                <option value="" selected> Select year</option>
                            <?php endif; ?>
                            
                            <?php
                            $selectedModelObj = null;
                            foreach ($teslaModels as $model) {
                                if ($model['slug'] === $selectedModel) {
                                    $selectedModelObj = $model;
                                    break;
                                }
                            }

                            if ($selectedModelObj) {
                                foreach ($selectedModelObj['years'] as $year) {
                                    $selected = ($year == $selectedYear) ? 'selected' : '';
                                    echo "<option value=\"$year\" $selected>$year</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="data-thumbnail-slider-out <?php echo $stateConfigurator > 0 ? 'state-ready' : ''; ?>">
                    <div class="data-b4 mod-one <?php echo $stateConfigurator > 0 ? 'state-ready' : ''; ?>">
                        <div class="data-b4-arrow">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-1-arrow.svg'; ?>" alt="img">
                        </div>

                        <div class="data-b4-text">
                            <div class="data-b4-title">
                                Step 1
                            </div>

                            <div class="data-b4-subtitle">
                                Select model of your Tesla
                            </div>
                        </div>
                    </div>

                    <div class="data-thumbnail-slider swiper swiper-container thumbnail-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($teslaModels as $index => $model): ?>
                                <div class="data-thumbnail-slider-item swiper-slide <?= $index === $activeSlideIndex ? 'swiper-slide-active selected' : '' ?>"
                                    data-slug="<?= $model['slug'] ?>"
                                    data-years='<?php echo json_encode($model['years']); ?>'>

                                    <div class="data-b2">
                                        <div class="data-b2-icon">
                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/cars/' . $model['image']; ?>" alt="<?= $model['name'] ?>">
                                        </div>

                                        <div class="data-b2-name">
                                            <?php echo $model['name']; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="data-b6">
                    <div class="data-b6-row">
                        <div class="data-b6-col">
                            <div class="data-b6-item">
                                <a href="<?php echo site_url('/'); ?>" class="data-b6-item-inner">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/mobile/Home.svg'; ?>">
                                    <span>Home</span>
                                </a>
                            </div>
                        </div>

                        <div class="data-b6-col">
                            <div class="data-b6-item">
                                <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="data-b6-item-inner">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/mobile/Bag.svg'; ?>">
                                    <span>Products</span>
                                </a>
                            </div>
                        </div>

                        <div class="data-b6-col">
                            <div class="data-b6-item">
                                <?php
                                $selectedModel = isset($_COOKIE['selectedModel']) ? $_COOKIE['selectedModel'] : 'model-s';

                                $teslaModelsSeconnd = [
                                    ['name' => 'Model S', 'slug' => 'model-s', 'image' => 'model-s.png'],
                                    ['name' => 'Model 3', 'slug' => 'model-3', 'image' => 'model-3.png'],
                                    ['name' => 'Model X', 'slug' => 'model-x', 'image' => 'model-x.png'],
                                    ['name' => 'Model Y', 'slug' => 'model-y', 'image' => 'model-y.png'],
                                    ['name' => 'Cybertruck', 'slug' => 'cybertruck', 'image' => 'cybertruck.png']
                                ];

                                $selectedModelData = current(array_filter($teslaModelsSeconnd, fn($model) => $model['slug'] === $selectedModel));
                                ?>
                                <div class="data-lang">
                                    <div class="wcl-cmp-4-lang js-popup-open mod-models-car-popup" data-target="models-car-popup">
                                        <div class="cmp4-selected">
                                            <div class="cmp4-selected-car-icon">
                                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/cars/' . $selectedModelData['image']; ?>" alt="img" id="selected-image">
                                            </div>

                                            <div class="cmp4-selected-name" id="selected-name">

                                            </div>

                                            <div class="cmp4-selected-arrow">
                                            </div>
                                        </div>

                                        <div class="cmp4-list">
                                            <?php foreach ($teslaModelsSeconnd as $car) : ?>
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

                                        <div class="cmp4-label">
                                            Select Car
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="data-b6-col">
                            <div class="data-b6-item">
                                <div class="data-b6-item-inner">
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

                                    <span>Cart</span>
                                </div>
                            </div>
                        </div>

                        <div class="data-b6-col">
                            <div class="data-b6-item">
                                <div class="data-b6-item-inner">
                                    <div class="data-btn-menu ">
                                        <div class="data-btn-menu-item">
                                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/mobile/Category.svg', false); ?>
                                        </div>

                                        <div class="data-btn-menu-item">
                                            <?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/mobile/Category.svg', false); ?>
                                        </div>
                                    </div>

                                    <span>Menu</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="data-b3 mod-mobile <?php echo $stateConfigurator === 1 ? 'state-active' : ''; ?> <?php echo $stateConfigurator === 2 ? 'state-ready' : ''; ?> <?php echo $stateConfigurator < 1 ? 'state-disabled' : ''; ?>">
                    <div class="data-b3-title-out">
                        <div class="data-b3-title">
                            Select Your Options
                        </div>

                        <div class="data-b4 mod-two <?php echo $stateConfigurator === 1 ? 'state-active' : ''; ?> <?php echo $stateConfigurator === 2 ? 'state-ready' : ''; ?> <?php echo $stateConfigurator < 1 ? 'state-disabled' : ''; ?>">
                            <div class="data-b4-arrow">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-1-arrow.svg'; ?>" alt="img">
                            </div>

                            <div class="data-b4-title">
                                Step 2
                            </div>
                        </div>
                    </div>





                    <ul class="data-b3-list" id="optionsList">
                        <?php foreach ($options as $key => $option): ?>
                            <?php
                            $selected = '';

                            if ($selectedCarOption == $key) {
                                $selected = 'selected';
                            }
                            ?>

                            <li class="data-b3-item <?php echo $selected; ?>" data-key="<?= $key ?>">
                                <div class="data-b3-item-btn cmp-button">
                                    <?= $option['name']; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="data-col">
                <div class="data-main-slider-out">
                    <div class="data-main-slider swiper swiper-container main-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($teslaModels as $index => $model): ?>
                                <?php
                                $note_1_text  = $model['note_1']['text'];
                                $note_1_image = $model['note_1']['image'];
                                $note_1_image = wp_get_attachment_image($note_1_image, 'image-size-5');

                                $note_2_text  = $model['note_2']['text'];
                                $note_2_image = $model['note_2']['image'];
                                $note_2_image = wp_get_attachment_image($note_2_image, 'image-size-5');
                                ?>
                                <div class="data-main-slider-item swiper-slide <?php echo $model['slug']; ?> <?= $index === $activeSlideIndex ? 'swiper-slide-active' : '' ?>" data-slug="<?= $model['slug'] ?>">
                                    <div class="data-b1-car">
                                        <div class="data-b1-car-img">
                                            <img class="data-b1-car-img-two lazy-image"
                                                src="<?php echo get_stylesheet_directory_uri() . '/img/cars/1x/' . $model['active_car'] ?>"
                                                srcset="<?php echo get_stylesheet_directory_uri() . '/img/cars/1x/' . $model['active_car'] ?> 1x, <?php echo get_stylesheet_directory_uri() . '/img/cars/2x/' . $model['active_car'] ?> 2x"
                                                alt="<?= $model['name'] ?>">

                                            <img class=""
                                                src="<?php echo get_stylesheet_directory_uri() . '/img/cars/1x/' . $model['main_image'] ?>"
                                                srcset="<?php echo get_stylesheet_directory_uri() . '/img/cars/1x/' . $model['main_image'] ?> 1x, <?php echo get_stylesheet_directory_uri() . '/img/cars/2x/' . $model['main_image'] ?> 2x"
                                                height="353px"
                                                alt="<?= $model['name'] ?>">
                                        </div>

                                        <div class="data-b1-note data-b1-note-1 mod-tesle-3-1">
                                            <div class="data-b1-note-plus">
                                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-1-plus.svg'; ?>" alt="img">
                                            </div>

                                            <div class="data-b1-note-card">
                                                <div class="data-b1-note-card-close">
                                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/cars/popup-close2.svg'; ?>" alt="img">
                                                </div>

                                                <div class="data-b1-note-card-img">
                                                    <?php if (! empty($note_1_image)): ?>
                                                        <?php echo $note_1_image; ?>
                                                    <?php endif; ?>
                                                </div>

                                                <?php if (! empty($note_1_text)): ?>
                                                    <div class="data-b1-note-card-desc">
                                                        <div class="data-b1-note-card-desc-inner">
                                                            <?php echo $note_1_text; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="data-b1-note data-b1-note-2 mod-tesle-3-2">
                                            <div class="data-b1-note-plus">
                                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-1-plus.svg'; ?>" alt="img">
                                            </div>

                                            <div class="data-b1-note-card">
                                                <div class="data-b1-note-card-close">
                                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/cars/popup-close2.svg'; ?>" alt="img">
                                                </div>

                                                <div class="data-b1-note-card-img">
                                                    <?php if (! empty($note_2_image)): ?>
                                                        <?php echo $note_2_image; ?>
                                                    <?php endif; ?>
                                                </div>

                                                <?php if (! empty($note_2_text)): ?>
                                                    <div class="data-b1-note-card-desc">
                                                        <div class="data-b1-note-card-desc-inner">
                                                            <?php echo $note_2_text; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="data-main-slider-nav">
                        <div class="data-main-slider-nav-btn mod-prev">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-left.svg'; ?>" alt="img">
                        </div>

                        <div class="data-main-slider-nav-btn mod-next">
                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/chevron-right.svg'; ?>" alt="img">
                        </div>
                    </div>
                </div>

                <div class="data-b3 <?php echo $stateConfigurator === 1 ? 'state-active' : ''; ?> <?php echo $stateConfigurator === 2 ? 'state-ready' : ''; ?> <?php echo $stateConfigurator < 1 ? 'state-disabled' : ''; ?>">
                    <div class="data-b3-title-out">
                        <div class="data-b3-title">
                            Select Your Options
                        </div>

                        <div class="data-b4 mod-two <?php echo $stateConfigurator === 1 ? 'state-active' : ''; ?> <?php echo $stateConfigurator === 2 ? 'state-ready' : ''; ?> <?php echo $stateConfigurator < 1 ? 'state-disabled' : ''; ?>">
                            <div class="data-b4-arrow">
                                <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-1-arrow.svg'; ?>" alt="img">
                            </div>

                            <div class="data-b4-title">
                                Step 2
                            </div>
                        </div>
                    </div>

                    <ul class="data-b3-list" id="optionsList">
                        <?php foreach ($options as $key => $option): ?>
                            <?php
                            $selected = '';

                            if ($selectedCarOption == $key) {
                                $selected = 'selected';
                            }
                            ?>

                            <li class="data-b3-item <?php echo $selected; ?>" data-key="<?= $key ?>">
                                <div class="data-b3-item-btn cmp-button">
                                    <?= $option['name']; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="data-col">
                <div class="data-b5 data-spares state-disabled  <?php echo $stateConfigurator === 2 ? 'state-active' : ''; ?> <?php echo $stateConfigurator === 3 ? 'state-ready' : ''; ?> <?php echo $stateConfigurator <= 2 ? 'state-disabled' : ''; ?>">
                    <div id="partsBlock" class="parts-block">
                        <div class="data-b5-list-out-2">
                            <div class="data-b4 mod-three   <?php echo $stateConfigurator === 2 ? 'state-active' : ''; ?> <?php echo $stateConfigurator === 3 ? 'state-ready' : ''; ?> <?php echo $stateConfigurator <= 2 ? 'state-disabled' : ''; ?>">
                                <div class="data-b4-arrow">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/acf-1-arrow.svg'; ?>" alt="img">
                                </div>

                                <div class="data-b4-text">
                                    <div class="data-b4-title">
                                        Step 3
                                    </div>

                                    <div class="data-b4-subtitle">
                                        Get Your Parts
                                    </div>
                                </div>
                            </div>

                            <div class="data-b5-list-out scroll-container" data-simplebar>
                                <ul id="productsList" class="data-b5-list">
                                    <?php if ($query->have_posts()) : ?>
                                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                                            <?php
                                            $image       = get_the_post_thumbnail($post->ID, 'image-size-4');
                                            $image_url   = 'http://loc.n2itive/wp-content/themes/n2itive-theme/img/cars/spare.png';
                                            $product_url = get_permalink(get_the_ID());
                                            ?>
                                            <li class="data-b5-item part" data-product-id="<?php echo esc_attr(get_the_ID()); ?>">
                                                <a href="<?php echo $product_url; ?>" class="data-b5-item-inner" target="_blank">
                                                    <div class="data-b5-item-img">
                                                        <?php if (! empty($image)): ?>
                                                            <?php echo $image; ?>
                                                        <?php else: ?>
                                                            <img src="<?php echo get_stylesheet_directory_uri() . '/img/cars/' . 'spare.png'; ?>" alt="img">
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="data-b5-item-name">
                                                        <?php echo esc_html(get_the_title()); ?>
                                                    </div>
                                                </a>
                                            </li>
                                        <?php endwhile; ?>
                                        <?php wp_reset_postdata(); ?>
                                    <?php else : ?>
                                        <li class="data-b5-item mod-no-found">No parts found</li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>