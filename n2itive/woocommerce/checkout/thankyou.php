<?php

/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined('ABSPATH') || exit;


$model_cars = [];
foreach ($order->get_items() as $item_id => $item) {
    $selected_model = $item->get_meta('Model Car');

    if (!empty($selected_model)) {
        $model_cars[] = $selected_model;
    }
}

$model_cars = array_unique($model_cars);

$data = get_tesla_configurator_data();

$selectedModel = $data['selectedModel'];
$teslaModels   = $data['teslaModels'];
$model         = getModelBySlug($teslaModels, $selectedModel);
?>
<div class="woocommerce-order">
    <div class="sct-thank-you">
        <div class="data-container">
            <div class="data-header">
                <h1 class="data-title">
                    Thank you for <br>
                    your order!
                </h1>

                <div class="data-img-mobile">
                    <div class="data-img mod-one">
                        <img class=""
                            src="<?php echo get_stylesheet_directory_uri() . '/img/thank-you-cars.png'; ?>"
                            height="47px"
                            alt="<?= $model['name'] ?>">
                    </div>
                </div>

                <div class="data-img-desktop">
                    <?php if (! empty($model_cars) && count($model_cars) < 2): ?>
                        <div class="data-img mod-two">
                            <img class=""
                                src="<?php echo get_stylesheet_directory_uri() . '/img/cars/thank-you/' . $model_cars[0] . '.png'; ?>"
                                srcset="<?php echo get_stylesheet_directory_uri() . '/img/cars/thank-you/' . $model_cars[0] . '.png'; ?> 1x, <?php echo get_stylesheet_directory_uri() . '/img/cars/thank-you/' . $model_cars[0] . '.png'; ?> 2x"
                                height="244px"
                                alt="<?= $model['name'] ?>">
                        </div>
                    <?php else: ?>
                        <div class="data-img mod-one">
                            <img class=""
                                src="<?php echo get_stylesheet_directory_uri() . '/img/thank-you-cars.png'; ?>"
                                srcset="<?php echo get_stylesheet_directory_uri() . '/img/thank-you-cars.png'; ?> 1x, <?php echo get_stylesheet_directory_uri() . '/img/thank-you-cars2x.png'; ?> 2x"
                                height="244px"
                                alt="<?= $model['name'] ?>">
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="data-b1">
                <?php
                $customer_name    = $order->get_billing_first_name();
                $order_number     = $order->get_order_number();
                $order_date       = $order->get_date_created()->date('F j, Y');
                $email            = $order->get_billing_email();
                $shipping_address = $order->get_formatted_shipping_address();
                $items            = $order->get_items();
                $subtotal         = $order->get_subtotal();
                $discount         = $order->get_discount_total();
                $shipping_total   = $order->get_shipping_total();
                $tax_total        = $order->get_total_tax();
                $payment_method   = $order->get_payment_method_title();
                $total            = $order->get_total();
                $phone = $order->get_billing_phone(); // Номер телефона клиента

                $shipping_address = $order->get_formatted_shipping_address();

                if ($shipping_address) {
                    $shipping_address = str_replace('<br/>', ', ', $shipping_address);
                }
                ?>
                <div class="data-row">
                    <div class="data-col">
                        <div class="data-b1-inner">
                            <!-- Table 1: General Information -->
                            <table class="data-table thank-you-table">
                                <h3 class="data-table-title">General Information</h3>
                                <?php if (!empty($customer_name)) : ?>
                                    <tr>
                                        <td><?php echo esc_html($customer_name); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($order_number)) : ?>
                                    <tr>
                                        <td><?php echo esc_html('Order Number #' . $order_number); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($order_date)) : ?>
                                    <tr>
                                        <td><?php echo esc_html($order_date); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($email)) : ?>
                                    <tr>
                                        <td><?php echo esc_html($email); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if (!empty($phone)) : ?>
                                    <tr>
                                        <td><?php echo esc_html($phone); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </table>

                            <!-- Table 2: Shipping Order -->
                            <table class="data-table thank-you-table">
                                <h3 class="data-table-title">Shipping Order</h3>
                                <tr>
                                    <td><?php echo esc_html($customer_name); ?></td>
                                </tr>

                                <tr>
                                    <td>N2ITIVE</td>
                                </tr>

                                <tr>
                                    <td><?php echo $shipping_address; ?></td>
                                </tr>

                            </table>
                        </div>
                    </div>

                    <div class="data-col">
                        <div class="data-b1-inner">
                            <!-- Table 3: Your Order -->
                            <h3 class="data-table-title">Your Order</h3>

                            <table class="data-table mod-order thank-you-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item_id => $item): ?>
                                        <?php
                                        $product = $item->get_product();
                                        $image = wp_get_attachment_image($product->get_image_id(), 'image-size-4');
                                        ?>
                                        <tr class="data-table-item mod-product">
                                            <td>
                                                <?php if ($product): ?>
                                                    <div class="data-b2">
                                                        <?php if (! empty($image)): ?>
                                                            <div class="data-b2-img">
                                                                <?php echo $image; ?>
                                                            </div>
                                                        <?php endif; ?>

                                                        <div class="data-b2-title">
                                                            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" target="_blank">
                                                                <?php echo esc_html($item->get_name()); ?>

                                                                <span class="data-b2-quantity">X<?php echo $item->get_quantity(); ?></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <?php echo wc_price($item->get_total()); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Subtotal:</td>
                                        <td><?php echo wc_price($subtotal); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Discount:</td>
                                        <td><?php echo wc_price($discount); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Shipping Cost:</td>
                                        <td><?php echo wc_price($shipping_total); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tax:</td>
                                        <td><?php echo wc_price($tax_total); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Payment Method:</td>
                                        <td><?php echo esc_html($payment_method); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Total:</td>
                                        <td><strong><?php echo wc_price($total); ?></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="data-link">
                    <a href="<?php echo site_url(); ?>" class="cmp-button mod-red">Return to the homepage</a>
                </div>
            </div>
        </div>
    </div>





    <?php if (false): ?>
        <?php
        if ($order) :

            do_action('woocommerce_before_thankyou', $order->get_id());
        ?>

            <?php if ($order->has_status('failed')) : ?>

                <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

                <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                    <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>" class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
                    <?php if (is_user_logged_in()) : ?>
                        <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
                    <?php endif; ?>
                </p>

            <?php else : ?>

                <?php wc_get_template('checkout/order-received.php', array('order' => $order)); ?>

                <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

                    <li class="woocommerce-order-overview__order order">
                        <?php esc_html_e('Order number:', 'woocommerce'); ?>
                        <strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                ?></strong>
                    </li>

                    <li class="woocommerce-order-overview__date date">
                        <?php esc_html_e('Date:', 'woocommerce'); ?>
                        <strong><?php echo wc_format_datetime($order->get_date_created()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                ?></strong>
                    </li>

                    <?php if (is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email()) : ?>
                        <li class="woocommerce-order-overview__email email">
                            <?php esc_html_e('Email:', 'woocommerce'); ?>
                            <strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                    ?></strong>
                        </li>
                    <?php endif; ?>

                    <li class="woocommerce-order-overview__total total">
                        <?php esc_html_e('Total:', 'woocommerce'); ?>
                        <strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                ?></strong>
                    </li>

                    <?php if ($order->get_payment_method_title()) : ?>
                        <li class="woocommerce-order-overview__payment-method method">
                            <?php esc_html_e('Payment method:', 'woocommerce'); ?>
                            <strong><?php echo wp_kses_post($order->get_payment_method_title()); ?></strong>
                        </li>
                    <?php endif; ?>

                </ul>

            <?php endif; ?>

            <?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
            <?php do_action('woocommerce_thankyou', $order->get_id()); ?>

        <?php else : ?>

            <?php wc_get_template('checkout/order-received.php', array('order' => false)); ?>

        <?php endif; ?>
    <?php endif; ?>
</div>