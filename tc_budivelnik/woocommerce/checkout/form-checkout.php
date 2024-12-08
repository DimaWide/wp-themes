<?php

/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
}
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

	<?php if ($checkout->get_checkout_fields()) : ?>

		<?php do_action('woocommerce_checkout_before_customer_details'); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php do_action('woocommerce_checkout_billing'); ?>

				<?php
				$methods = get_available_payment_methods();
				?>
				<?php if (!empty($methods)) : ?>
					<?php
					$session = WC()->session;
					$chosen_payment_method = $session->get('chosen_payment_method');
					?>
					<div class="data-b1 data-type-payments">
						<h3 class="data-b1-title">
							Оплата
						</h3>

						<select id="payment_methods_dropdown">
							<?php foreach ($methods as $id => $title) : ?>
								<?php
								$selected = ($id === $chosen_payment_method) ? 'selected="selected"' : '';
								?>
								<option value="<?php echo esc_attr($id); ?>" <?php echo $selected; ?>><?php echo esc_html($title); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				<?php endif; ?>

				<?php if (!is_user_logged_in()) : ?>
					<div class="data-personal-account">
						<div class="cmp-field-checkbox data-personal-account-checkbox">
							<div class="cmp-checkbox">
								<input type="checkbox" id="create_account" name="create_account" required>

								<label for="create_account">
									<span>Створити особитий кабінет</span>
								</label>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<div class="col-2">
				<?php do_action('woocommerce_checkout_shipping'); ?>
			</div>
		</div>

		<?php do_action('woocommerce_checkout_after_customer_details'); ?>

	<?php endif; ?>

	<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

	<?php do_action('woocommerce_checkout_before_order_review'); ?>

	<div class="data-col-orders">
		<!-- Custom -->
		<?php get_template_part('template-parts/woocommerce/checkout-order-review'); ?>

		<div id="order_review" class="woocommerce-checkout-review-order">
			<div class="data-coupone mod-v2">
				<div class="data-coupone-inner">
					<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e('Промокод', 'woocommerce'); ?>" id="coupon_code" value="" />
					<button type="button" name="apply_coupon" value="<?php esc_attr_e('Застосувати', 'woocommerce'); ?>"><?php esc_html_e('Застосувати', 'woocommerce'); ?></button>
				</div>
			</div>

			<h3 id="order_review_heading"><?php esc_html_e('Разом', 'woocommerce'); ?></h3>
			
			<?php do_action('woocommerce_checkout_order_review'); ?>
		</div>
	</div>

	<?php do_action('woocommerce_checkout_after_order_review'); ?>

</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>