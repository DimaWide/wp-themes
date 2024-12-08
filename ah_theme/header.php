<!DOCTYPE html>
<html <?php echo get_language_attributes(); ?>>

<head>

	<?php

	$hostname = $_SERVER['SERVER_NAME'];

	if ($hostname === 'a3hconsulting.com' || $hostname === 'www.a3hconsulting.com') {
	?>

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-Z05VGWF8S7"></script>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments);
			}
			gtag('js', new Date());

			gtag('config', 'G-Z05VGWF8S7');
		</script>

	<?php
	}
	?>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo wp_get_document_title(); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<!-- Start cookieyes banner -->
	<script id=“cookieyes” type=“text/javascript” src=“https://cdn-cookieyes.com/client_data/bd96e38d1f6f1e13527da7f0/script.js”></script> <!-- End cookieyes banner -->

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>



	<!-- 
	====================================================================
		DEVELOPED BY WebComplete (webcomplete.io)
	====================================================================
	 -->


	<?php
	$logo_for_light_theme = get_field('logo_for_light_theme', 'option');
	$logo_for_light_theme = wp_get_attachment_image($logo_for_light_theme, 'full');
	$logo_for_dark_theme = get_field('logo_for_dark_theme', 'option');
	$logo_for_dark_theme = wp_get_attachment_image($logo_for_dark_theme, 'full');
	?>
	<div class="wcl-body-inner">

		<!-- HEADER -->
		<header class="wcl-header" id="wcl-main-header">
			<div class="data-container wcl-container">
				<div class="data-row">
					<?php if (!empty($logo_for_light_theme || $logo_for_dark_theme)) : ?>
						<div class="wcl-logo data-logo">
							<a href="<?php echo site_url('/'); ?>">
								<?php if (!empty($logo_for_light_theme)) : ?>
									<span class="m2-item mod-light">
										<?php echo $logo_for_light_theme; ?>
									</span>
								<?php endif; ?>

								<?php if (!empty($logo_for_dark_theme)) : ?>
									<span class="m2-item mod-dark">
										<?php echo $logo_for_dark_theme; ?>
									</span>
								<?php endif; ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="data-nav">
						<div class="data-nav-inner">
							<?php wp_nav_menu(
								array(
									'container'      => '',
									'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
									'theme_location' => 'main-menu',
									'depth'          => 2,
									'fallback_cb'    => '',
									'walker'         => new wcl_Walker_Nav_Menu(),
								)
							); ?>
						</div>
					</div>

					<div class="data-btn-menu">
						<div class="data-btn-menu-item">
							<img src="<?php echo get_stylesheet_directory_uri() . '/img/menu-btn.svg', false; ?>" alt="img">
						</div>

						<div class="data-btn-menu-item">
							<img src="<?php echo get_stylesheet_directory_uri() . '/img/menu-btn-close.svg', false; ?>" alt="img">
						</div>
					</div>
				</div>
			</div>
		</header> <!-- #wcl-main-header -->