<?php

/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);

$sc_portal = get_field('pages', 'option');
$sc_portal = $sc_portal['sc_portal'];
?>
<div class="wcl-wc-account-dashboard">
	<?php get_template_part('template-parts/woocommerce/avatar'); ?>

	<div class="data-b2">
		<p class="data-b2-hello">
			<?php
			printf(
				/* translators: 1: user display name 2: logout url */
				wp_kses(__('Hello %1$s</a>', 'woocommerce'), $allowed_html),
				'<strong>' . esc_html($current_user->display_name) . '</strong>'
			);
			?>
		</p>

		<p>So nice to have you here! <br>
			Check out all of the Splendor Collective Guides, Shopping Lists, and more.</p>

		<a href="<?php echo get_permalink($sc_portal); ?>" class="wcl-link">
			Click here
			<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
		</a>

		<p class="data-b2-not-jane">Not <?php echo $current_user->first_name; ?>?</p>

		<a href="<?php echo wc_logout_url(); ?>" class="wcl-link">
			Log out
			<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
		</a>
	</div>


	<?php

	$avatar      = get_field('avatar', 'user_' . get_current_user_id());
	$avatar_data = wp_get_attachment_image_src($avatar, 'full');
	$avatar_val  = '';

	if (!empty($avatar_data)) {
		$avatar_val = $avatar_data[0];
	}
	?>
	<div class="wcl-change-avatar">
		<h3 class="data-title">
			<?php _e('Change Avatar', 'theme-name') ?>
		</h3>

		<form class="data-form">
			<div class="data-img" data-val="<?php echo $avatar_val; ?>">
				<?php if (!empty($avatar_data)) { ?>
					<?php echo '<img src="' . $avatar_data[0] . '" width="' . $avatar_data[1] . '" height="' . $avatar_data[2] . '" alt="logo">'; ?>
				<?php } else {
					echo '<img src="" alt="">';
				} ?>
			</div>

			<div class="data-fields">
				<label for="user_avatar">
					<span class="wcl-link mod-center">
					Choose Image
					</span>
					<input type="file" id="user_avatar" name="user_avatar" required>
				</label>

				<button type="submit" class="wcl-link mod-black-to-white">
					Save
					<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
				</button>

				<button type="reset" class="wcl-link mod-center" name="cancel">Cancel</button>
			</div>
		</form>
	</div>



	<p>
		<?php
		/* translators: 1: Orders URL 2: Address URL 3: Account URL. */
		$dashboard_desc = __('From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">billing address</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce');
		if (wc_shipping_enabled()) {
			/* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
			$dashboard_desc = __('From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce');
		}
		printf(
			wp_kses($dashboard_desc, $allowed_html),
			esc_url(wc_get_endpoint_url('orders')),
			esc_url(wc_get_endpoint_url('edit-address')),
			esc_url(wc_get_endpoint_url('edit-account'))
		);
		?>
	</p>
</div>


<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_before_my_account');

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
