<?php 




?>
<?php if (!is_front_page()): ?>
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
 
    ?>
    <div class="data-container wcl-container">
        <div class="data-row">
            <div class="data-col">
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
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
