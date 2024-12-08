<?php

/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

global $product;
$product_id   = get_the_ID();
$has_in_cart  = false;
$contact_page = get_field('pages', 'option');
$contact_page = $contact_page['contact'];
?>

<?php
foreach (WC()->cart->get_cart() as $item) {
	if ($item['product_id'] == $product_id) {
		$has_in_cart = true;
	}
}
?>
<?php if (!empty($has_in_cart)) : ?>
	<div class="data-notice">
		“<?php echo get_the_title(); ?>” has been added to your cart.
	</div>
<?php endif; ?>

<div class="data-btns">
	<div class="data-btns-item">
		<?php if (!empty($has_in_cart)) : ?>
			<a href="<?php echo wc_get_cart_url(); ?>" class="wcl-link mod-btn-black">
				<span>View Cart</span>
				<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
			</a>
		<?php else : ?>
			<div class="woocommerce-variation-add-to-cart variations_button">
				<?php do_action('woocommerce_before_add_to_cart_button'); ?>

				<?php
				do_action('woocommerce_before_add_to_cart_quantity');

				woocommerce_quantity_input(
					array(
						'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
						'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
						'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
					)
				);

				do_action('woocommerce_after_add_to_cart_quantity');
				?>

				<button type="submit" class="wcl-link mod-btn-black single_add_to_cart_button button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>">
					<?php echo esc_html($product->single_add_to_cart_text()); ?>
					<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
				</button>

				<?php do_action('woocommerce_after_add_to_cart_button'); ?>

				<input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
				<input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
				<input type="hidden" name="variation_id" class="variation_id" value="0" />
			</div>
		<?php endif; ?>
	</div>

	<div class="data-btns-item">
		<a href="<?php echo get_permalink($contact_page); ?>" class="wcl-link">
			<span> Contact</span>
			<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
		</a>
	</div>

	<div class="data-btns-item">
		<a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>" class="wcl-link">
			<span> Sign in</span>
			<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
		</a>
	</div>
</div>