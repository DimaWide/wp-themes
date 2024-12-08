<!DOCTYPE html>
<html <?php echo get_language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

	<title><?php echo wp_get_document_title(); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


	<!-- 
	====================================================================
		DEVELOPED BY WebComplete (webcomplete.io)
	====================================================================
	 -->

	<style id="myStyle">
		#billing_address_1_field {
			display: none !important;
		}
	</style>

	
	<div class="wcl-body-inner">

		<?php
		$logo_dark    = get_field('logo_dark', 'option');
		$logo_dark    = wp_get_attachment_image_url($logo_dark, 'full');
		$phone_number = get_field('phone_number', 'option');

		$mobile_logo_light = get_field('mobile_logo_light', 'option');
		$mobile_logo_light = wp_get_attachment_image_url($mobile_logo_light, 'full');
		?>
		<!-- HEADER -->
		<header class="wcl-header" id="wcl-main-header">
			<div class="data-nav">
				<div class="data-nav-menu">
					<li class="data-nav-menu-item mod-all-product">
						<a href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>">Всі товари</a>
					</li>

					<li class="data-nav-menu-item mod-top-seller">
						<a href="<?php echo get_permalink(woocommerce_get_page_id('shop')) . '?discounted_products=yes'; ?>">Акційні пропозиції</a>
					</li>
				</div>

				<div class="data-nav-menu">
					<?php wp_nav_menu(
						array(
							'container'      => '',
							'items_wrap'     => '<ul class="data-nav-menu">%3$s</ul>',
							'theme_location' => 'menu-2',
							'depth'          => 1,
							'fallback_cb'    => '',
						)
					); ?>
				</div>

				<?php wp_nav_menu(
					array(
						'container'      => '',
						'items_wrap'     => '<ul class="data-nav-menu mod-type-2">%3$s</ul>',
						'theme_location' => 'menu-1',
						'depth'          => 1,
						'fallback_cb'    => '',
					)
				); ?>
			</div>

			<div class="data-b1">
				<div class="data-container wcl-container">
					<div class="data-b1-row">
						<div class="data-b1-col">
							<?php wp_nav_menu(
								array(
									'container'      => '',
									'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
									'theme_location' => 'menu-1',
									'depth'          => 1,
									'fallback_cb'    => '',
								)
							); ?>
						</div>

						<div class="data-b1-col">
							<div class="data-personal-office">
								<a href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>">
									<img src="<?php echo get_stylesheet_directory_uri() . '/img/user.svg'; ?>" alt="img">
									<span>Особистий кабінет</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="data-b2">
				<div class="data-container wcl-container">
					<div class="data-b2-row">
						<div class="data-b2-col">
							<div class="data-btn-menu">
								<div class="data-btn-menu-item">
									<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/menu-btn.svg', false); ?>
								</div>

								<div class="data-btn-menu-item">
									<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/menu-btn-close.svg', false); ?>
								</div>
							</div>

							<?php if (!empty($logo_dark)) : ?>
								<div class="data-logo">
									<a href="<?php echo site_url(); ?>">
										<?php echo file_get_contents($logo_dark, false); ?>

										<?php if (!empty($mobile_logo_light)) : ?>
											<?php echo file_get_contents($mobile_logo_light, false); ?>
										<?php endif; ?>
									</a>
								</div>
							<?php endif; ?>
						</div>

						<div class="data-b2-col">
							<div class="data-search">
								<!-- /// get_search_form();  -->
								<?php aws_get_search_form(true); ?>
							</div>
						</div>

						<div class="data-b2-col">
							<?php if (!empty($phone_number)) : ?>
								<div class="data-phone">
									<a href="tel:<?php echo $phone_number; ?>">
										<img src="<?php echo get_stylesheet_directory_uri() . '/img/phone.svg'; ?>" alt="phone">

										<span>
											<?php echo $phone_number; ?>
										</span>
									</a>
								</div>

								<div class="data-get-call">
									<a href="#" class="cmp-button mod-hover js-popup-open" data-target="get-call">Замовити дзвінок</a>
								</div>
							<?php endif; ?>
						</div>

						<div class="data-b2-col">
							<?php
							$wishlist = '';
							$link = home_url('/my-account/wishlist/');

							if (is_user_logged_in()) {
								$wishlist = get_user_meta(get_current_user_id(), 'wishlist', true);
							} else {
								$link = home_url('/shop/wishlist/');

								if (isset($_COOKIE['wishlist'])) {
									$wishlist = json_decode(stripslashes($_COOKIE['wishlist']), true);
								}
							}

							$classes = '';

							if (!empty($wishlist)) {
								$classes = 'is-fill';

								if (count($wishlist) > 99) {
									$classes .= ' is-99-more';
								} elseif (count($wishlist) > 9) {
									$classes .= ' is-10-more';
								}
							}

							?>
							<div class="data-wish-list <?php echo $classes; ?>">
								<a href="<?php echo $link; ?>">
									<div class="data-wish-list-icon">
										<img src="<?php echo get_stylesheet_directory_uri() . '/img/hearth-2.svg'; ?>" alt="img">

										<div class="data-wish-list-count">
											<?php if (!empty($wishlist)) : ?>
												<?php if (count($wishlist) > 99) : ?>
													<?php echo '99+'; ?>
												<?php endif; ?>
												<?php echo count($wishlist); ?>
											<?php endif; ?>
										</div>
									</div>

									<div class="data-wish-list-label">Обране</div>
								</a>
							</div>

							<?php
							$cart = WC()->cart;
							$product_count = $cart->get_cart_contents_count();
							?>
							<div class="data-cart">
								<a href="<?php echo wc_get_cart_url(); ?>" class="data-cart-link">
									<div class="data-cart-icon">
										<img src="<?php echo get_stylesheet_directory_uri() . '/img/cart-2.svg'; ?>" alt="img">

										<?php if (!empty($product_count)) : ?>
											<div class="data-cart-count">
												<span>
													<?php echo $product_count; ?>
												</span>
											</div>
										<?php endif; ?>
									</div>

									<div class="data-cart-info">
										<div class="data-cart-label">
											<?php if (!empty($product_count)) : ?>
												<?php
												$pluralized = pluralize($product_count);
												echo "$product_count $pluralized.";
												?>
											<?php else : ?>
												Кошик
											<?php endif; ?>
										</div>

										<div class="data-cart-state">
											<?php if (!empty($product_count)) : ?>
												<?php
												$cart_total = WC()->cart->get_total('raw');
												$formatted_cart_total = number_format($cart_total, 2, '.', ' ');
												echo '<span> ' . $formatted_cart_total . ' грн' . '</span>';
												?>
											<?php else : ?>
												Порожньо
											<?php endif; ?>
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="data-b3">
				<div class="data-container wcl-container">
					<div class="data-b3-row">
						<div class="data-b3-col">
							<div class="data-b3-btn">
								<a href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>" class="cmp-button mod-all-product">
									<img src="<?php echo get_stylesheet_directory_uri() . '/img/all-product.svg'; ?>" alt="img">
									Всі товари
								</a>
							</div>

							<div class="data-b3-btn">
								<a href="<?php echo get_permalink(woocommerce_get_page_id('shop')) . '?discounted_products=yes'; ?>" class="cmp-button mod-promotional">
									<img src="<?php echo get_stylesheet_directory_uri() . '/img/promotional.svg'; ?>" alt="img">
									Акційні пропозиції
								</a>
							</div>
						</div>

						<div class="data-b3-col">
							<?php wp_nav_menu(
								array(
									'container'      => '',
									'items_wrap'     => '<ul class="data-b3-menu">%3$s</ul>',
									'theme_location' => 'menu-2',
									'depth'          => 1,
									'fallback_cb'    => '',
								)
							); ?>
						</div>
					</div>
				</div>
			</div>
		</header> <!-- #wcl-main-header -->