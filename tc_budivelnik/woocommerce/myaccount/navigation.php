<?php

/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
	exit;
}

do_action('woocommerce_before_account_navigation');
?>

<nav class="woocommerce-MyAccount-navigation">
	<ul>
		<?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
			<?php
			$img_name = 'account-my-orders';

			if ($endpoint == 'orders') {
				$img_name = 'account-my-orders';
			} elseif ($endpoint == 'edit-account') {
				$img_name = 'account-information';
			} elseif ($endpoint == 'wishlist') {
				$img_name = 'account-wishlist';
			}
			?>
			<li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
				<a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>">
					<span class="data-img">
						<img src="<?php echo get_stylesheet_directory_uri() . '/img/' . $img_name . '.svg'; ?>" alt="img">
					</span>

					<span>
						<?php echo esc_html($label); ?>
					</span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action('woocommerce_after_account_navigation'); ?>