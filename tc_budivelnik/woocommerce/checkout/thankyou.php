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
?>
<div class="woocommerce-order">
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

			<div class="wc-page-thankyou">
				<div class="data-container">
					<h1 class="data-title">
						Замовлення оформлене
					</h1>

					<div class="data-row">
						<div class="data-col">
							<div class="data-info">
								<?php
								$order_id           = $order->get_id();                                      // Номер заказа
								$item_count         = $order->get_item_count();                              // Количество товаров
								$order_total        = $order->get_total();                                   // Вартість замовлення
								$shipping_method    = $order->get_shipping_method();                         // Спосіб доставки
								$shipping_address   = $order->get_formatted_shipping_address();              // Адреса доставки
								$shipping_address_1 = $order->get_shipping_address_1();
								$shipping_date      = '';                                                    // Дата відправки - это поле нужно добавить и заполнять вручную или программно
								$shipping_date      = !empty($shipping_date) ? $shipping_date : '-';
								$shipping_city      = $order->get_shipping_city();                           // Get the shipping city
								$shipping_city      = !empty($shipping_city) ? 'м. ' . $shipping_city : '';

								if ($shipping_method == 'Новая почта') {
									$shipping_method = 'Нова пошта';
								}

								if ($shipping_method == 'Нова пошта') {
									if (mb_stripos($shipping_address_1, 'відділення') !== false) {
										$shipping_method = 'У відділення “Нова Пошта”';
									} elseif (mb_stripos($shipping_address_1, 'поштомат') !== false) {
										$shipping_method = 'До поштомату “Нова Пошта”';
									} else {
										$shipping_method = '“Нова Пошта”';
									}
								}
								?>
								<!-- data-b1 -->
								<div class="data-b1">
									<div class="data-b1-inner">
										<h2 class="data-b1-title">
											<?php esc_html_e('Інформація про замовлення', 'woocommerce'); ?>
										</h2>

										<table class="data-b1-table">
											<tbody>
												<tr class="data-b1-item order">
													<th><?php esc_html_e('№ замовлення:', 'woocommerce'); ?></th>
													<td><?php echo esc_html($order_id); ?></td>
												</tr>
												<tr class="data-b1-item item-count">
													<th><?php esc_html_e('Кількість товарів:', 'woocommerce'); ?></th>
													<td><?php echo esc_html($item_count . ' од.'); ?></td>
												</tr>
												<tr class="data-b1-item total">
													<th><?php esc_html_e('Вартість замовлення:', 'woocommerce'); ?></th>
													<td><?php echo wc_price($order_total); ?></td>
												</tr>
												<tr class="data-b1-item shipping-method">
													<th><?php esc_html_e('Спосіб доставки:', 'woocommerce'); ?></th>
													<td><?php echo esc_html($shipping_method); ?></td>
												</tr>
												<tr class="data-b1-item shipping-address">
													<th><?php esc_html_e('Адреса доставки:', 'woocommerce'); ?></th>
													<td><?php echo wp_kses_post($shipping_city . '. ' . $shipping_address_1); ?></td>
												</tr>
												<tr class="data-b1-item shipping-date">
													<th><?php esc_html_e('Дата відправки:', 'woocommerce'); ?></th>
													<td><?php echo esc_html($shipping_date); ?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>


								<!-- data-b2 -->
								<div class="data-b2">
									<table class="data-b2-table">
										<tbody>
											<?php
											foreach ($order->get_items() as $item_id => $item) {
												$product          = $item->get_product();
												$product_image    = $product ? $product->get_image() : '';
												$product_name     = $item->get_name();
												$product_quantity = $item->get_quantity();
												$product_total    = wc_price($item->get_total());
											?>
												<tr class="data-b2-item">
													<td class="data-b2-item-col product-thumbnail">
														<div class="data-b2-item-img">
															<?php echo $product_image; ?>
														</div>
													</td>

													<td class="data-b2-item-col product-name">
														<div class="data-b2-item-name">
															<?php echo $product_name; ?>
														</div>
													</td>

													<td class="data-b2-item-col product-quantity">
														<div class="data-b2-item-quantity">
															<?php echo $product_quantity . ' од.'; ?>
														</div>
													</td>

													<td class="data-b2-item-col product-total">
														<div class="data-b2-item-total">
															<?php echo $product_total; ?>
														</div>
													</td>
												</tr>
											<?php
											}
											?>
										</tbody>
									</table>
								</div>

								<!-- data-b3 -->
								<div class="data-b3">
									<table class="data-b3-table">
										<tbody>
											<tr class="data-b3-item">
												<th>Товари</th>
												<td><?php echo wc_price($order->get_subtotal()); ?></td>
											</tr>

											<tr class="data-b3-item">
												<th>Доставка</th>
												<td><?php echo wc_price($order->get_shipping_total()); ?></td>
											</tr>

											<tr class="data-b3-item total">
												<th>Сума замовлення</th>
												<td><?php echo wc_price($order->get_total()); ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="data-col">
							<div class="data-info mod-ver-2">
								<div class="data-b4">
									<div class="data-b4-label">
										Статус замовлення
									</div>

									<div class="data-b4-value">
										<?php echo wc_get_order_status_name($order->get_status()); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		<?php endif; ?>

	<?php else : ?>

		<div class="woocommerce wp-block-group alignwide">
			<div class="woocommerce-notices-wrapper"></div>

			<div class="wc-empty-cart-message">
				<div class="cart-empty woocommerce-info">
					Для оформлення замовлення оберіть товар.
				</div>
			</div>

			<p class="return-to-shop">
				<a class="cmp-button mod-transparency button wc-backward mod-hover-easy" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>">
					Повернутись в магазин
				</a>
			</p>
		</div>

		<?php wc_get_template('checkout/order-received.php', array('order' => false)); ?>

	<?php endif; ?>

</div>