<?php

/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_navigation'); ?>

<div class="woocommerce-MyAccount-content">
	<?php
	/**
	 * My Account content.
	 *
	 * @since 2.6.0
	 */
	do_action('woocommerce_account_content');

	get_template_part('template-parts/woocommerce/go-back');
	?>

	<?php if (!empty(is_wc_endpoint_url('view-subscription'))) : ?>
		<div class="data-b6-links">
			<a href="<?php echo get_permalink(wc_get_page_id('myaccount'))  . 'edit-address/billing/'; ?>" class="wcl-link">
				Edit
				<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
			</a>

			<a href="<?php echo get_permalink(wc_get_page_id('myaccount'))  . 'subscriptions/'; ?>" class="wcl-link">
				Go Back
				<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
			</a>
		</div>
	<?php endif; ?>
</div>