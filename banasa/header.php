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
		
		$logo         = get_field('logo', 'option');
		$logo         = wp_get_attachment_image($logo, 'full');
		$social_media = get_field('social_media', 'option');
		?>
		<!-- HEADER -->
		<header class="wcl-header" id="wcl-main-header">
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
							<?php wp_nav_menu(array(
								'theme_location' => 'main-menu',
								'container'      => 'false',
								'menu_class'     => 'data-menu nav main-menu',
								'depth'          => 2,
							)); ?>

							<?php if (!empty($social_media)) : ?>
								<ul class="cmp-social-media">
									<?php if (!empty($social_media['linkedin'])) : ?>
										<li class="cmp-item">
											<a href="<?php echo $social_media['linkedin']['url']; ?>" target="_blank" rel="noopener nofollow">
												<img src="<?php echo get_stylesheet_directory_uri() . '/img/linkedin.svg'; ?>" alt="img">
											</a>
										</li>
									<?php endif; ?>

									<?php if (!empty($social_media['instagram'])) : ?>
										<li class="cmp-item">
											<a href="<?php echo $social_media['instagram']['url']; ?>" target="_blank" rel="noopener nofollow">
												<img src="<?php echo get_stylesheet_directory_uri() . '/img/instagram.svg'; ?>" alt="img">
											</a>
										</li>
									<?php endif; ?>
								</ul>
							<?php endif; ?>
						</nav>
					</div>

					<div class="data-col">
						<?php
						custom_language_switcher();
						?>
					</div>

					<div class="data-col">
						<?php if (!empty($social_media)) : ?>
							<ul class="cmp-social-media">
								<?php if (!empty($social_media['linkedin'])) : ?>
									<li class="cmp-item">
										<a href="<?php echo $social_media['linkedin']['url']; ?>" target="_blank" rel="noopener nofollow">
											<img src="<?php echo get_stylesheet_directory_uri() . '/img/linkedin.svg'; ?>" alt="img">
										</a>
									</li>
								<?php endif; ?>

								<?php if (!empty($social_media['instagram'])) : ?>
									<li class="cmp-item">
										<a href="<?php echo $social_media['instagram']['url']; ?>" target="_blank" rel="noopener nofollow">
											<img src="<?php echo get_stylesheet_directory_uri() . '/img/instagram.svg'; ?>" alt="img">
										</a>
									</li>
								<?php endif; ?>
							</ul>
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