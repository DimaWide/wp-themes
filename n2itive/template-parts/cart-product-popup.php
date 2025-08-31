<?php

$data = get_tesla_configurator_data();

$selectedModel     = $data['selectedModel'];
$selectedCarOption = $data['selectedCarOption'];
$selectedYear      = $data['selectedYear'];
$stateConfigurator = $data['stateConfigurator'];
$options           = $data['options'];
$teslaModels       = $data['teslaModels'];

$activeSlideIndex = array_search($selectedModel, array_column($teslaModels, 'slug'));
$activeSlideIndex = $activeSlideIndex === false ? '0' : $activeSlideIndex;
?>
<div class="cmp-4-popup mod-cart-product-popup" data-id="cart-product-popup">
    <div class="cmp4-overlay"></div>
    <div class="cmp4-inner-out">
        <div class="cmp4-inner" id="cart-product-popup">
            <div class="cmp-2-cart custom-popup" id="cmp-2-cart">
                <div class="cmp4-close js-close">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/img/cars/popup-close.svg'; ?>" alt="img">
                </div>

                <?php if (! WC()->cart->is_empty()) : ?>
                    <div class="data-items cart-items">
                        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                            $product               = $cart_item['data'];
                            $product_id            = $product->get_id();
                            $product_title         = $product->get_name();
                            $product_price         = wc_price($product->get_price());
                            $quantity              = $cart_item['quantity'];
                            $total_price           = $product->get_price() * $quantity;
                            $formatted_total_price = wc_price($total_price);
                            $image                 = get_the_post_thumbnail($product_id, 'image-size-4');
                        ?>
                            <div class="data-item cart-item <?php echo $product_id; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>">
                                <div class="data-item-img">
                                    <?php if (!empty($image)): ?>
                                        <?php echo $image; ?>
                                    <?php endif; ?>
                                </div>

                                <div class="data-item-info">
                                    <div class="data-item-title product-title"><?php echo $product_title; ?></div>
                                    <div class="data-item-price product-price">
                                        <span> <?php echo $quantity; ?>x</span> <span> <?php echo wc_price($product->get_price()); ?></span>
                                    </div>
                                </div>

                                <div class="data-item-remove">
                                    <button class="remove-item" data-cart-item-key="<?php echo $cart_item_key; ?>">
                                        <img src="<?php echo get_stylesheet_directory_uri() . '/img/cars/popup-close.svg'; ?>" alt="img">
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="data-footer">
                        <div class="data-subtotal">
                            <div class="data-subtotal-label">
                                Subtotal:
                            </div>

                            <div class="data-subtotal-value">
                                <?php echo WC()->cart->get_cart_total(); ?>
                            </div>
                        </div>

                        <div class="data-buttons">
                            <a href="<?php echo wc_get_cart_url(); ?>" class="cmp-button" id="view-cart-btn">View Cart</a>
                            <a href="<?php echo wc_get_checkout_url(); ?>" class="cmp-button" id="checkout-btn">Checkout</a>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="data-footer">
                        <div class="data-empty">
                            <p>Your cart is empty.</p>
                        </div>

                        <div class="data-buttons">
                            <a href="<?php echo wc_get_cart_url(); ?>" class="cmp-button" id="view-cart-btn">View Cart</a>
                            <a href="<?php echo wc_get_checkout_url(); ?>" class="cmp-button" id="checkout-btn">Checkout</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>