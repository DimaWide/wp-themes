<!DOCTYPE html>
<html <?php echo get_language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo wp_get_document_title(); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body <?php body_class(); ?>>


	<!-- 
	====================================================================
		DEVELOPED BY WebComplete (webcomplete.io)
	====================================================================
	 -->


	<?php
	$state_user_subscription = get_state_user_subscription();

	$logo_header = get_field('logo_header', 'option');
	$logo_header = wp_get_attachment_image($logo_header, 'full');

	$products = get_field('products', 'option');
	$product  = $products['product_1'];
	?>

	<div class="wcl-body-inner">

		<!-- HEADER -->
		<header class="wcl-header" id="wcl-main-header">

			<div class="data-container wcl-container">
				<div class="data-row">
					<div class="data-col">
						<?php if (!empty($logo_header)) : ?>
							<div class="data-logo">
								<a href="<?php echo get_site_url(); ?>">
									<?php echo $logo_header; ?>
								</a>
							</div>
						<?php endif; ?>
					</div>

					<div class="data-col">
						<nav class="data-nav">
							<div class="data-nav-inner">
								<?php
								$menu_id = 'main-menu';

								if ($state_user_subscription == 'active') {
									$menu_id = 'menu-active-members';
								} elseif ($state_user_subscription == 'unactive') {
									$menu_id = 'menu-unactive-members';
								} elseif ($state_user_subscription == 'logged-out') {
									$menu_id = 'menu-logged-out-members';
								}
								?>

								<?php wp_nav_menu(
									array(
										'container'      => '',
										'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
										'theme_location' => $menu_id,
										'depth'          => 2,
										'fallback_cb'    => '',
										'walker'         => new Custom_Walker_Nav_Menu(),
										'link_before' => '<span>',
										'link_after' => '</span>',
									)
								); ?>

								<?php if (is_front_page() && $state_user_subscription != 'active'): ?>
									<div class="data-btn">
										<a href="<?php echo esc_url(wc_get_checkout_url()); ?>?add-to-cart=<?php echo $product; ?>" class="wcl-btn">
											Pirkti Narystę
										</a>
									</div>
								<?php endif; ?>
							</div>

							<div class="data-btn-menu mod-to-close">
								<div class="data-btn-menu-item">
									<img src="<?php echo get_stylesheet_directory_uri() . '/img/menu-btn-close.svg', false; ?>" alt="img">
								</div>
							</div>
						</nav>

						<div class="data-btn-menu mod-to-open">
							<div class="data-btn-menu-item">
								<img src="<?php echo get_stylesheet_directory_uri() . '/img/menu-btn.svg', false; ?>" alt="img">
							</div>
						</div>
					</div>
				</div>
			</div>
		</header> <!-- #wcl-main-header -->