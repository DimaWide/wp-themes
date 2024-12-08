<?php

$logo_light = get_field('logo_light', 'option');
$logo_light = wp_get_attachment_image($logo_light, 'full');

$mobile_logo_light = get_field('mobile_logo_light', 'option');
$mobile_logo_light = wp_get_attachment_image($mobile_logo_light, 'full');

$social_media = get_field('social_media', 'option');

$slogan_text  = get_field('slogan_text', 'option');
$developed_by = get_field('developed_by', 'option');

$is_edit_account = $_SERVER['REQUEST_URI'];
?>
<?php if (strpos($is_edit_account, '/my-account/edit-account/') !== false) : ?>
	<?php get_template_part('template-parts/change-password'); ?>
<?php endif; ?>

<?php get_template_part('template-parts/review-form'); ?>

<?php get_template_part('template-parts/get-call'); ?>

<?php get_template_part('template-parts/add-product-popup'); ?>

<!-- FOOTER -->
<footer class="wcl-footer" id="wcl-main-footer">

	<div class="data-container wcl-container">
		<div class="data-row">
			<div class="data-col">
				<?php if (!empty($logo_light)) : ?>
					<div class="data-logo">
						<a href="<?php echo site_url(); ?>">
							<?php echo $logo_light; ?>

							<?php if (!empty($mobile_logo_light)) : ?>
								<?php echo $mobile_logo_light; ?>
							<?php endif; ?>
						</a>
					</div>
				<?php endif; ?>

				<?php if (!empty($slogan_text)) : ?>
					<div class="data-slogan">
						<?php echo $slogan_text; ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($social_media)) : ?>
					<ul class="cmp-2-social-media">
						<?php if (!empty($social_media['facebook'])) : ?>
							<li class="cmp2-item">
								<a href="<?php echo $social_media['facebook']['url']; ?>" target="_blank" rel="noopener nofollow">
									<img src="<?php echo get_stylesheet_directory_uri() . '/img/facebook.svg'; ?>" alt="img">
								</a>
							</li>
						<?php endif; ?>

						<?php if (!empty($social_media['instagram'])) : ?>
							<li class="cmp2-item">
								<a href="<?php echo $social_media['instagram']['url']; ?>" target="_blank" rel="noopener nofollow">
									<img src="<?php echo get_stylesheet_directory_uri() . '/img/instagram.svg'; ?>" alt="img">
								</a>
							</li>
						<?php endif; ?>

						<?php if (!empty($social_media['telegram'])) : ?>
							<li class="cmp2-item">
								<a href="<?php echo $social_media['telegram']['url']; ?>" target="_blank" rel="noopener nofollow">
									<img src="<?php echo get_stylesheet_directory_uri() . '/img/telegram.svg'; ?>" alt="img">
								</a>
							</li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>
			</div>

			<div class="data-col">
				<div class="data-b1">
					<div class="data-b1-title">
						Корисна інформація
					</div>

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
			</div>

			<div class="data-col">
				<div class="data-b1">
					<div class="data-b1-title">
						Категорії товарів
					</div>

					<div class="data-cats">
						<div class="data-cats-col">
							<?php
							wp_nav_menu(array(
								'theme_location' => 'footer-menu-1',
								'menu_id'        => 'footer-menu-1',
								'menu_class'     => 'data-menu',
								'depth'          => 1
							));
							?>
						</div>

						<div class="data-cats-col">
							<?php
							wp_nav_menu(array(
								'theme_location' => 'footer-menu-2',
								'menu_id'        => 'footer-menu-2',
								'menu_class'     => 'data-menu',
								'depth'          => 1
							));
							?>
						</div>

						<div class="data-cats-col">
							<?php
							wp_nav_menu(array(
								'theme_location' => 'footer-menu-3',
								'menu_id'        => 'footer-menu-3',
								'menu_class'     => 'data-menu',
								'depth'          => 1
							));
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="data-b2">
			<div class="data-b2-col">
				<div class="data-copyright">
					<?php echo get_bloginfo('name') . ' © ' . date('Y'); ?>
				</div>
			</div>

			<div class="data-b2-col">
				<?php if (!empty($developed_by)) : ?>
					<?php
					$logo = $developed_by['logo'];
					$logo = wp_get_attachment_image($logo, 'full');

					$link = $developed_by['link'];

					$link_url    = $link['url'];
					$link_title  = $link['title'];
					$link_target = $link['target'] ?: '_self';
					?>
					<div class="data-developed-by">
						<a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>">
							<?php if (!empty($logo)) : ?>
								<span class="data-developed-by-logo">
									<?php echo $logo; ?>
								</span>
							<?php endif; ?>

							<?php echo $link_title; ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<!-- !!! FOOTER CONTENT GOES HERE !!! -->

</footer> <!-- #wcl-main-footer -->

<script>

</script>



</div> <!-- .wcl-body-inner -->

<?php wp_footer(); ?>


</body>

</html>