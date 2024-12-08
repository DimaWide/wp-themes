<div id="order_review-new" class="data-orders-1">
    <h3 id="order_review_heading"><?php esc_html_e('Замовлення', 'woocommerce'); ?></h3>

    <?php get_template_part('woocommerce/checkout/form-coupon'); ?>

    <table class="data-orders-1-table ">
        <tbody>
            <?php
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
            ?>
                    <tr class="js-post-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                        <td>
                            <div class="data-order-item product-<?php echo $_product->get_id(); ?>">
                                <div class="data-order-item-image">
                                    <?php
                                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                    if (!$product_permalink) {
                                        echo $thumbnail; // PHPCS: XSS ok.
                                    } else {
                                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                                    }
                                    ?>
                                </div>

                                <div class="data-order-item-b1">
                                    <div class="data-order-item-info">
                                        <div class="data-order-item-title js-post-item-title">
                                            <div class="data-order-item-title-inner">
                                                <?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; ?>
                                            </div>
                                        </div>

                                        <div class="data-order-item-b1-e1">
                                            <div class="data-order-item-count">
                                                <?php echo $cart_item['quantity'] . ' од.'; ?>
                                            </div>

                                            <div class="data-order-item-price">
                                                <?php if ($_product->is_on_sale()) : ?>
                                                    <div class="data-order-item-price mod-is-sale">
                                                        <div class="data-order-item-price-old"><?php echo get_product_total_without_discount($_product->get_id(), $cart_item['quantity'], 'грн'); ?></div>
                                                        <div class="data-order-item-price-new"><?php echo get_product_total_with_discount($_product->get_id(), $cart_item['quantity'], 'грн'); ?></div>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="data-order-item-price">
                                                        <?php echo get_product_total_without_discount($_product->get_id(), $cart_item['quantity'], 'грн'); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
            <?php
                };
            };
            ?>
        </tbody>
    </table>
</div>