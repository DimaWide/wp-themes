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

	<?php
	$pages = get_field('pages', 'option');

	$logo_header = get_field('logo_header', 'option');
	$logo_header = wp_get_attachment_image($logo_header, 'full');

	$social_media = get_field('social_media', 'option');

	$contact_info = get_field('contact_info', 'option');
	$place        = $contact_info['place'];
	$phone        = $contact_info['phone'];

	$hd_button = get_field('header_button', 'option');

	$hd_button_text     = !empty($hd_button['button_text']) ? $hd_button['button_text'] : __('Get started', 'reway-theme');
	$hd_button_text_spa = !empty($hd_button['button_text_spa_page']) ? $hd_button['button_text_spa_page'] : __('Make a reservation', 'reway-theme');

	?>

	<div class="wcl-body-inner">
		<!-- HEADER -->
		<header class="wcl-header" id="wcl-main-header" itemscope itemtype="https://schema.org/WPHeader">
			<div class="data-container wcl-container">
				<div class="data-row">
					<div class="data-col">
						<div class="hamburger">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>

					<div class="data-col">
						<?php if (!empty($logo_header)) : ?>
							<div class="data-logo-out" itemprop="subjectOf" itemscope itemtype="https://schema.org/Organization">
								<div class="data-logo" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
									<a href="<?php echo wcl_get_current_site_url_lang(); ?>" itemprop="url">
										<?php echo $logo_header; ?>
									</a>
								</div>
							</div>
						<?php endif; ?>
					</div>

					<div class="data-col">
						<div class="data-unit">
							<?php
							$languages = apply_filters('wpml_active_languages', null, 'orderby=id&order=desc');
							?>
							<?php if (!empty($languages)) : ?>
								<div class="data-lang" itemprop="subjectOf" itemscope itemtype="https://schema.org/Language">
									<div class="data-lang-ico">
										<img src="<?php echo get_stylesheet_directory_uri() . '/img/ico-lang.svg'; ?>" alt="ico-lang">
									</div>

									<?php
									$current_language = apply_filters('wpml_current_language', NULL);
									?>
									<div class="wcl-cmp-4-lang">
										<div class="cmp4-selected">
											<?php echo $current_language; ?>
										</div>

										<div class="cmp4-list">
											<?php foreach ($languages as $code => $language) : ?>
												<?php
												$class_selected = '';

												if ($language['language_code'] === $current_language) {
													$class_selected = 'active';
												}
												?>
												<div class="cmp4-item <?php echo $class_selected; ?>">
													<a href="<?php echo $language['url']; ?>" itemprop="url">
														<?php echo $language['language_code']; ?>
													</a>
												</div>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
							<?php endif; ?>

							<?php if (!empty($phone)) : ?>
								<div class="data-phone" itemprop="subjectOf" itemscope itemtype="https://schema.org/ContactPoint">
									<a href="tel:<?php echo $phone; ?>" itemprop="telephone" content="<?php echo $phone; ?>">
										<img src="<?php echo get_stylesheet_directory_uri() . '/img/phone.svg'; ?>" alt="ico-phone">
									</a>
								</div>
							<?php endif; ?>

							<?php if (isset($pages['spa']) && $pages['spa'] == get_the_ID()) : ?>
								<div class="data-link">
									<button class="wcl-cmp-button mod-type-2 js-popup-open" itemprop="subjectOf" itemscope itemtype="https://schema.org/Action" data-target="make-a-reservation"><?php echo $hd_button_text_spa; ?></button>
								</div>
							<?php else : ?>
								<div class="data-link">
									<button class="wcl-cmp-button mod-type-2 js-popup-open" itemprop="subjectOf" itemscope itemtype="https://schema.org/Action" data-target="become-a-member"><?php echo $hd_button_text; ?></button>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<?php if (isset($pages['spa']) && $pages['spa'] == get_the_ID()) : ?>
				<div class="data-link mod-spa">
					<button class="wcl-cmp-button mod-type-2 js-popup-open" itemprop="subjectOf" itemscope itemtype="https://schema.org/Action" data-target="make-a-reservation"><?php echo $hd_button_text_spa; ?></button>
				</div>
			<?php endif; ?>

			<div class="data-nav">
				<div class="data-nav-inner">
					<div class="data-container wcl-container">
						<?php wp_nav_menu(
							array(
								'container'      => '',
								'items_wrap'     => '<ul class="data-menu" itemprop="subjectOf" itemscope itemtype="https://schema.org/SiteNavigationElement">%3$s</ul>',
								'theme_location' => 'main-menu',
								'depth'          => 1,
								'fallback_cb'    => '',
								'walker'         => new Custom_Walker_Nav_Menu(),
							)
						); ?>

						<div class="wcl-cmp-1-block">
							<div class="cmp1-row">
								<div class="cmp1-col">
									<?php if (!empty($place)) : ?>
										<div class="cmp1-place" itemprop="subjectOf" itemscope itemtype="https://schema.org/PostalAddress">
											<img src="<?php echo get_stylesheet_directory_uri() . '/img/marker.svg'; ?>" alt="img">

											<span itemprop="addressRegion">
												<?php echo $place; ?>
											</span>
										</div>
									<?php endif; ?>

									<?php if (!empty($social_media)) : ?>
										<ul class="cmp1-social-media" itemprop="subjectOf" itemscope itemtype="https://schema.org/Organization">
											<?php if (!empty($social_media['twitter'])) : ?>
												<li class="cmp1-social-media-item">
													<a href="<?php echo $social_media['twitter']['url']; ?>" target="_blank" rel="noopener nofollow" itemprop="url">
														<img src="<?php echo get_stylesheet_directory_uri() . '/img/twitter.svg'; ?>" alt="img" itemprop="image">
													</a>
												</li>
											<?php endif; ?>

											<?php if (!empty($social_media['facebook'])) : ?>
												<li class="cmp1-social-media-item">
													<a href="<?php echo $social_media['facebook']['url']; ?>" target="_blank" rel="noopener nofollow" itemprop="url">
														<img src="<?php echo get_stylesheet_directory_uri() . '/img/facebook.svg'; ?>" alt="img" itemprop="image">
													</a>
												</li>
											<?php endif; ?>

											<?php if (!empty($social_media['instagram'])) : ?>
												<li class="cmp1-social-media-item">
													<a href="<?php echo $social_media['instagram']['url']; ?>" target="_blank" rel="noopener nofollow" itemprop="url">
														<img src="<?php echo get_stylesheet_directory_uri() . '/img/instagram.svg'; ?>" alt="img" itemprop="image">
													</a>
												</li>
											<?php endif; ?>

											<?php if (!empty($social_media['linkedin'])) : ?>
												<li class="cmp1-social-media-item">
													<a href="<?php echo $social_media['linkedin']['url']; ?>" target="_blank" rel="noopener nofollow" itemprop="url">
														<img src="<?php echo get_stylesheet_directory_uri() . '/img/linkedin.svg'; ?>" alt="img" itemprop="image">
													</a>
												</li>
											<?php endif; ?>
										</ul>
									<?php endif; ?>
								</div>

								<div class="cmp1-col">
									<div class="cmp1-link">
										<button class="wcl-cmp-button mod-type-2 js-popup-open" itemprop="subjectOf" itemscope itemtype="https://schema.org/Action" data-target="become-a-member"><?php echo $hd_button_text; ?></button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header> <!-- #wcl-main-header -->