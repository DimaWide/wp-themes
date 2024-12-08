<!DOCTYPE html>
<html <?php echo get_language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

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



	<div class="wcl-body-inner">

		<?php
		$logo  = get_field('logo_light', 'option');
		$logo  = wp_get_attachment_image($logo, 'full');
		$phone = get_field('phone', 'option');
		?>
		<!-- HEADER -->
		<header class="wcl-header mod-v2" id="wcl-main-header">
			<div class="data-container wcl-container">
				<div class="data-row">
					<div class="data-col">
						<?php if (!empty($logo)) : ?>
							<div class="data-logo">
								<a href="<?php echo site_url(); ?>">
									<?php echo $logo; ?>
								</a>
							</div>
						<?php endif; ?>
					</div>

					<div class="data-col">
						<!-- Show Main Menu -->
						<nav class="data-nav header-navigation">
							<div class="data-nav-inner">
								<?php wp_nav_menu(array(
									'theme_location' => 'main-menu',
									'container'      => 'false',
									'menu_class'     => 'data-menu',
									'depth'          => 2,
								)); ?>

								<?php if (!empty($phone)) : ?>
									<?php
									$formatted_number = preg_replace('/\((.*?)\)/', '<span>($1)</span>', $phone);
									$phone_clean = preg_replace('/[^\d+]/', '', $phone);
									?>
									<div class="data-phone">
										<a href="tel:<?php echo $phone_clean; ?>">
											<?php echo $formatted_number; ?>
										</a>
									</div>
								<?php endif; ?>
							</div>

						</nav>
					</div>

					<div class="data-col">
						<?php if (!empty($phone)) : ?>
							<?php
							$formatted_number = preg_replace('/\((.*?)\)/', '<span>($1)</span>', $phone);
							$phone_clean = preg_replace('/[^\d+]/', '', $phone);
							?>
							<div class="data-phone">
								<a href="tel:<?php echo $phone_clean; ?>">
									<?php echo $formatted_number; ?>
								</a>
							</div>
						<?php endif; ?>

						<div class="data-btn-menu">
							<div class="data-btn-menu-item">
								<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/menu-btn.svg', false); ?>
							</div>

							<div class="data-btn-menu-item">
								<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/menu-btn-close.svg', false); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header> <!-- #wcl-main-header -->