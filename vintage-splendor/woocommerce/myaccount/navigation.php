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
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
	exit;
}

$sc_portal = get_field('pages', 'option');
$sc_portal = $sc_portal['sc_portal'];

do_action('woocommerce_before_account_navigation');
?>

<nav class="woocommerce-MyAccount-navigation">
	<ul>
		<li class="item-splendor-collective">
			<a href="<?php echo get_permalink($sc_portal); ?>" class="wcl-link mod-gradient">
				<span>Splendor Collective</span>
				<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
			</a>
		</li>

		<?php foreach (wc_get_account_menu_items() as $endpoint => $label) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
				<?php
				if ($label == 'Dashboard') {
					$label = 'My Account';
				} elseif ($label == 'My Subscription') {
					$label = 'Subscriptions';
				} elseif ($label == 'Logout') {
					$label = 'Log out';
				}
				?>
				<a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>" class="wcl-link"><?php echo esc_html($label); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action('woocommerce_after_account_navigation'); ?>