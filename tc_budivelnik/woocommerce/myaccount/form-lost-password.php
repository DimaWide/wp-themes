<?php

/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_lost_password_form');
?>

<form method="post" class="woocommerce-ResetPassword lost_reset_password">

	<h1 class="cmp-title mod-small data-title">
		Забули свій пароль?
	</h1>

	<p class="data-subtitle"><?php echo apply_filters('woocommerce_lost_password_message', esc_html__('Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce')); ?></p><?php // @codingStandardsIgnoreLine 
																																																											?>

	<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
		<input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Ім'я користувача або електронна пошта" type="text" name="user_login" id="user_login" autocomplete="username" />
	</p>

	<div class="clear"></div>

	<?php do_action('woocommerce_lostpassword_form'); ?>

	<p class="woocommerce-form-row form-row form-row-submit">
		<input type="hidden" name="wc_reset_password" value="true" />
		<button type="submit" class="cmp-button mod-big mod-btn mod-hover-2" value="<?php esc_attr_e('Reset password', 'woocommerce'); ?>"><?php esc_html_e('Reset password', 'woocommerce'); ?></button>
	</p>

	<?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>

</form>
<?php
do_action('woocommerce_after_lost_password_form');
