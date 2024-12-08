<?php

/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if (!defined('ABSPATH')) {
	exit;
}

global $post;

if (!empty($breadcrumb)) {

	echo $wrap_before;

	echo '<div class="woocommerce-breadcrumb-inner">';

	if (is_wc_endpoint_url('order-received')) {
?>
		<a href="<?php echo site_url('/'); ?>">
			<span class="data-delimiter">
				<img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-breadcrumb.svg'; ?>" alt="img">
			</span>

			<span>Головна</span>
		</a>

		<?php
	} else {
		foreach ($breadcrumb as $key => $crumb) {

			echo $before;

			if (!empty($crumb[1]) && sizeof($breadcrumb) !== $key + 1) {
				if (get_the_ID() == wc_get_page_id('myaccount') && $key == 1) {
					echo '<a href="' . esc_url($crumb[1]) . '">' . 'Особистий кабінет' . '</a>';
				} else {
					if ($crumb[0] == 'Всі товари') {
						echo '<a class="mod-all-product" href="' . esc_url($crumb[1]) . '">' . esc_html($crumb[0]) . '</a>';
					} else{
						echo '<a href="' . esc_url($crumb[1]) . '">' . esc_html($crumb[0]) . '</a>';
					}
					
				}
			} else {
				if ($crumb[0] == 'Shop Page') {
					echo 'Всі товари';
				} elseif ($crumb[0] == 'Наші новини') {
					echo 'Новини';
				} elseif ($crumb[0] == 'My account') {
					echo 'Особистий кабінет';
				} else {
		?>
					<?php if ($crumb[0] == 'Всі товари') : ?>
						<span class="mod-all-product">
							<?php echo esc_html($crumb[0]); ?>
						</span>
					<?php else : ?>
						<span>
							<?php echo esc_html($crumb[0]); ?>
						</span>
					<?php endif; ?>


				<?php

				}
			}

			echo $after;

			if (sizeof($breadcrumb) !== $key + 1) {
				//echo $delimiter;
				?>
				<span class="data-delimiter">
					<img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-breadcrumb.svg'; ?>" alt="img">
				</span>
<?php
			}
		}
	}

	echo '</div>';

	echo $wrap_after;
}
