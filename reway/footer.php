<?php

$logo_footer = get_field('logo_footer', 'option');
$logo_footer = wp_get_attachment_image($logo_footer, 'full');

$social_media = get_field('social_media', 'option');

$contact_info = get_field('contact_info', 'option');
$place        = $contact_info['place'];

?>

<!-- Popup -->
<?php get_template_part('template-parts/popup', '', ['id' => 'become-a-member']); ?>

<!-- Popup -->
<?php get_template_part('template-parts/popup', '', ['id' => 'make-a-reservation']); ?>

<!-- FOOTER -->
<footer class="wcl-footer" id="wcl-main-footer" itemscope itemtype="https://schema.org/WPFooter">
	<div class="data-container wcl-container">
		<?php if (!empty($logo_footer)) : ?>
			<div class="data-logo-out" itemprop="subjectOf" itemscope itemtype="https://schema.org/Organization">
				<div class="data-logo" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
					<a href="<?php echo wcl_get_current_site_url_lang(); ?>" itemprop="url">
						<?php echo $logo_footer; ?>
					</a>
				</div>
			</div>
		<?php endif; ?>

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
			</div>
		</div>

		<div class="data-copyright">
			© <?php echo date('Y'); ?> reway - <?php _e('All rights reserved', 'reway-theme'); ?>
		</div>
	</div>
</footer> <!-- #wcl-main-footer -->

</div> <!-- .wcl-body-inner -->

<?php wp_footer(); ?>

</body>

</html>