<?php

/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined('ABSPATH') || exit;
?>
<div class="woocommerce-billing-fields">

	<?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>

	<div class="woocommerce-billing-fields__field-wrapper">
		<?php if (wc_ship_to_billing_address_only() && WC()->cart->needs_shipping()) : ?>

			<h3><?php esc_html_e('Billing &amp; Shipping', 'woocommerce'); ?></h3>

		<?php else : ?>

			<h3><?php esc_html_e('Billing details', 'woocommerce'); ?></h3>

		<?php endif; ?>

		<div class="data-fields-biling">
			<?php
			$fields = $checkout->get_checkout_fields('billing');

			foreach ($fields as $key => $field) {
				if ($key == 'billing_phone') {
			?>
					<p class="form-row form-row-wide validate-required validate-phone" id="billing_phone_field" data-priority="100">
						<span class="data-form-field">
							<?php
							$valid = !empty($billing_phone) ? 'valid' : 'not-valid';
							?>
							<span class="cmp-7-phone mod-wc data-phone ">
								<input type="hidden" name="billing_phone_valid" value="false">
								<input type="hidden" name="phone_code_country" value="+38">

								<span class="cmp7-container">
									<span class="cmp7-country-code">+38</span>

									<span class="cmp7-input-wrapper">
										<input type="tel" class="cmp7-phone" name="billing_phone" id="billing_phone" maxlength="14" placeholder="">
										<span class="cmp7-mask-text"></span>
									</span>
								</span>
							</span>
						</span>
					</p>
			<?php
				} else {
					woocommerce_form_field($key, $field, $checkout->get_value($key));
				}
			}
			?>
		</div>
	</div>

	<div class="data-b2 data-delivery">
		<h3 class="data-b2-title">
			Доставка
		</h3>

		<?php

		$chosen_shipping_methods = WC()->session->get('chosen_shipping_methods');
		// Получаем все зоны доставки
		$delivery_zones = WC_Shipping_Zones::get_zones();

		// Ищем зону доставки с названием "Ukraine"
		foreach ($delivery_zones as $zone) {
			if ($zone['zone_name'] === 'Ukraine') {
				echo '<select id="shipping-method-select" name="shipping_method">';

				// Получаем методы доставки для данной зоны
				$shipping_methods = $zone['shipping_methods'];

				foreach ($shipping_methods as $shipping_method) {

					// Check if this shipping method is the chosen one
					$selected = '';
					if (!empty($chosen_shipping_methods) && in_array($shipping_method->id . ':' . $shipping_method->instance_id, $chosen_shipping_methods)) {
						$selected = 'selected="selected"';
					}

					// Добавляем каждый метод доставки в качестве опции в select
					echo '<option value="' . esc_attr($shipping_method->id . ':' . $shipping_method->instance_id) . '" ' . $selected . '>';
					echo esc_html($shipping_method->title);
					echo '</option>';
				}

				echo '</select>';
			}
		}
		?>

		<?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>
	</div>
</div>

<?php if (!is_user_logged_in() && $checkout->is_registration_enabled()) : ?>
	<div class="woocommerce-account-fields">
		<?php if (!$checkout->is_registration_required()) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked((true === $checkout->get_value('createaccount') || (true === apply_filters('woocommerce_create_account_default_checked', false))), true); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e('Create an account?', 'woocommerce'); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action('woocommerce_before_checkout_registration_form', $checkout); ?>

		<?php if ($checkout->get_checkout_fields('account')) : ?>

			<div class="create-account">
				<?php foreach ($checkout->get_checkout_fields('account') as $key => $field) : ?>
					<?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action('woocommerce_after_checkout_registration_form', $checkout); ?>
	</div>
<?php endif; ?>