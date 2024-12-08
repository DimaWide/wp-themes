<?php

/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */


if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}


if (isset($_GET['add-to-cart'])) {
	$_GET = array();
	wc_clear_notices();
	wp_redirect(get_permalink(woocommerce_get_page_id('cart'))); // Redirect to the same page to avoid resubmission
	exit;
}


get_header();

$notices = wc_get_notices();

$image_id    = get_post_thumbnail_id($post->ID, 'image-size-1');
$product     = wc_get_product($post->ID);
$gallery_ids = $product->get_gallery_image_ids();
$price       = $product->get_regular_price();
$sale_price  = $product->get_sale_price();

$product_status = $product->get_stock_status();
$product_sku    = $product->get_sku();
$attributes     = $product->get_attributes();

$desc        = wcl_get_description($post->ID);
$desc_tablet = wcl_get_description($post->ID, 282);

$in_wishlist = '';

array_unshift($gallery_ids, $image_id);

if (product_in_wishlist_user($post->ID)) {
	$in_wishlist = 'mod-in-wishlist';
}

if (!is_user_logged_in()) {
	$in_wishlist = is_product_in_wishlist($post->ID) ? 'mod-in-wishlist' : '';
}
?>
<div class="wcl-single-product" data-id="<?php echo $post->ID; ?>">
	<div class="data-container wcl-container">
		<?php if (!empty($notices)) : ?>
			<div class="wcl-wc-notice data-notice">
				<?php
				if (!empty($notices)) {
					foreach ($notices as $type => $type_notices) {
						foreach ($type_notices as $notice_data) {
							echo '<div class="woocommerce-message ' . esc_attr($type) . '" role="alert">';
							echo wp_kses_post($notice_data['notice']);
							echo '</div>';
						}
					}
					wc_clear_notices();
				}
				?>
			</div>
		<?php endif; ?>

		<div class="data-breadcrumb">
			<?php woocommerce_breadcrumb(); ?>
		</div>

		<h1 class="data-title">
			<?php echo get_the_title(); ?>
		</h1>

		<div class="data-row">
			<div class="data-col">
				<?php if (!empty($gallery_ids)) : ?>

					<div class="data-slider swiper">
						<div class="data-slider-inner swiper-wrapper">
							<?php foreach ($gallery_ids as $img_id) : ?>
								<?php
								$image_full = wp_get_attachment_image_src($img_id, 'full')[0];
								$image_thumb = wp_get_attachment_image($img_id, 'image-size-1');
								?>
								<div class="data-slider-item swiper-slide">
									<?php if (!empty($image_thumb)) : ?>
										<div class="data-slider-item-img">
											<a href="<?php echo esc_url($image_full); ?>" class="gallery-item" title="<?php echo esc_attr(get_post_field('post_title', $img_id)); ?>">
												<?php echo $image_thumb; ?>
											</a>
										</div>
									<?php endif; ?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>

					<?php if (count($gallery_ids) > 1) : ?>
						<div class="data-slider-2-out">
							<div class="data-slider-2 swiper">
								<div class="data-slider-2-inner swiper-wrapper">
									<?php foreach ($gallery_ids as $img_id) : ?>
										<?php
										$image_full = wp_get_attachment_image_src($img_id, 'full')[0];
										$image_thumb = wp_get_attachment_image($img_id, 'image-size-3');
										?>
										<div class="data-slider-2-item swiper-slide">
											<?php if (!empty($image_thumb)) : ?>
												<div class="data-slider-2-item-img">
													<a href="<?php echo esc_url($image_full); ?>" class="gallery-item" title="<?php echo esc_attr(get_post_field('post_title', $img_id)); ?>">
														<?php echo $image_thumb; ?>
													</a>
												</div>
											<?php endif; ?>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
							<div class="data-slider-2-nav">
								<div class="data-slider-2-nav-btn mod-prev">
									<img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-left.svg'; ?>" alt="img">
								</div>

								<div class="data-slider-2-nav-btn mod-next">
									<img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-left.svg'; ?>" alt="img">
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<?php if (!empty($desc_tablet) && (!empty($desc_tablet['short']))) : ?>
					<div class="data-desc mod-v2">
						<h3 class="data-desc-title">
							Опис товару
						</h3>

						<div class="data-desc-text">
							<div class="data-desc-short">
								<?php echo $desc_tablet['short']; ?>
							</div>

							<div class="data-desc-full">
								<?php echo $desc_tablet['full']; ?>
							</div>
						</div>

						<div class="data-desc-btn">
							<span>
								<span>Розгорнути опис</span>
								<span>Згорнути опис</span>
							</span>

							<img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-blue.svg'; ?>" alt="img">
						</div>
					</div>
				<?php endif; ?>
			</div>

			<div class="data-col">
				<div class="data-b1">
					<?php if (!empty($product_status)) : ?>
						<?php
						$product_status_new = '';
						if ($product_status === 'instock') {
							$product_status_new = 'Готовий до відправки';
						} elseif ($product_status === 'outofstock') {
							$product_status_new = 'Не в наявності';
						} elseif ($product_status === 'onbackorder') {
							$product_status_new = 'Можливий під замовлення';
						} else {
							$product_status_new = 'Статус не визначений';
						}
						?>
						<div class="data-ready-to-delivery">
							<?php echo $product_status_new ?>
						</div>
					<?php endif; ?>

					<?php if (!empty($product_sku)) : ?>
						<div class="data-articul">
							<?php echo 'Артикул: ' . $product_sku; ?>
						</div>
					<?php endif; ?>
				</div>


				<div class="data-b2">
					<?php if ($product->is_on_sale()) : ?>
						<?php
						$amount_sale = $price - $sale_price;

						$enable_price_per_unit = get_field('enable_price_per_unit');
						$enable_price_per_unit = isset($enable_price_per_unit) ? $enable_price_per_unit : true;
						?>
						<div class="data-price mod-is-sale">
							<div class="data-price-old">
								<span>
									<?php echo wc_price($price); ?>
								</span>

								<span class="data-price-amount-sale">
									<?php echo wc_price($amount_sale); ?>
								</span>
							</div>

							<?php if ($enable_price_per_unit) : ?>
								<div class="data-price-new"><?php echo add_new_tag_to_price_wc($sale_price); ?></div>
							<?php else : ?>
								<div class="data-price-new"><?php echo wc_price($sale_price); ?></div>
							<?php endif; ?>
						</div>
					<?php else : ?>
						<div class="data-price"><?php echo add_new_tag_to_price_wc($price); ?></div>
					<?php endif; ?>

					<div class="data-b2-col">
						<div class="data-cart">
							<?php get_template_part('woocommerce/single-product/add-to-cart/simple'); ?>
						</div>

						<div class="data-add-to-wishlist">
							<span>Додати до списку бажань</span>

							<div class="data-add-to-wishlist-btn <?php echo (!empty($in_wishlist)) ? 'active' : ''; ?>">
								<div class="data-add-to-wishlist-btn-item">
									<img src="<?php echo get_stylesheet_directory_uri() . '/img/hearth.png'; ?>" alt="img">
								</div>

								<div class="data-add-to-wishlist-btn-item">
									<img src="<?php echo get_stylesheet_directory_uri() . '/img/hearth-fill.png'; ?>" alt="img">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="data-delivery">
					<h3 class="data-delivery-title">
						Доставка
					</h3>

					<div class="data-delivery-list">
						<div class="data-delivery-item">
							<div class="data-delivery-item-icon">
								<img src="<?php echo get_stylesheet_directory_uri() . '/img/nova-poshta.svg'; ?>" alt="img">
							</div>

							<div class="data-delivery-item-info">
								<div class="data-delivery-item-text-1">
									Нова пошта за тарифами перевізника
								</div>

								<div class="data-delivery-item-text-2">
									Відправка за 1-2 дні
								</div>
							</div>
						</div>

						<div class="data-delivery-item">
							<div class="data-delivery-item-icon">
								<img src="<?php echo get_stylesheet_directory_uri() . '/img/ukr-poshta.svg'; ?>" alt="img">
							</div>

							<div class="data-delivery-item-info">
								<div class="data-delivery-item-text-1">
									Укрпошта за тарифами перевізника
								</div>

								<div class="data-delivery-item-text-2">
									Відправка за 1-2 дні
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php if (!empty($desc) && (!empty($desc['short']))) : ?>
					<div class="data-desc mod-v1">
						<h3 class="data-desc-title">
							Опис товару
						</h3>

						<div class="data-desc-text">
							<div class="data-desc-short">
								<span><?php echo $desc['short']; ?></span>
								<span><?php echo $desc_tablet['short']; ?></span>
							</div>

							<div class="data-desc-full">
								<?php echo $desc['full']; ?>
							</div>
						</div>

						<div class="data-desc-btn">
							<span>
								<span>Розгорнути опис</span>
								<span>Згорнути опис</span>
							</span>

							<img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-blue.svg'; ?>" alt="img">
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($attributes)) : ?>
					<?php
					$is_more = '';

					if (count($attributes) <= 3) {
						$is_more = 'mod-is-more';
					}

					$last_item_num = '.mod-last-item-num-' . count($attributes);
					?>
					<div class="data-attrs <?php echo $is_more; ?> <?php echo $last_item_num; ?>">
						<h3 class="data-attrs-title">
							Основні характеристики
						</h3>

						<div class="data-attrs-list">
							<?php foreach ($attributes as $attribute) : ?>
								<?php
								if ($attribute->is_taxonomy()) {
									$label = wc_attribute_label($attribute->get_name());
									$values = wc_get_product_terms($product->get_id(), $attribute->get_name(), array('fields' => 'names'));
									$value = implode(', ', $values);
								} else {
									$label = wc_attribute_label($attribute->get_name());
									$value = $attribute->get_options();
									$value = implode(', ', $value);
								}
								?>
								<div class="data-attrs-item">
									<div class="data-attrs-item-name">
										<?php echo $label; ?>
									</div>

									<div class="data-attrs-item-val">
										<?php echo $value ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>

						<?php if (count($attributes) > 3) : ?>
							<div class="data-attrs-btn">
								<span>
									<span>Всі характеристики</span>
									<span>Згорнути</span>
								</span>

								<img src="<?php echo get_stylesheet_directory_uri() . '/img/arrow-blue.svg'; ?>" alt="img">
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php
$args =  array(
	'type_layout' => 'other-product',
);
get_template_part('template-parts/other-poduct-cat', '', $args);
?>

<?php
get_footer();
