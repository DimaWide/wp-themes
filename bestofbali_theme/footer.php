<?php


$desc         = get_field('ft_desc', 'option');
$social_media = get_field('social_media', 'option');

?>

<?php if (!is_front_page()) : ?>
	<div class="wcl-dst-block-1 mod-type-1">
		<div class="data-container wcl-container">
			<?php
			$banner = get_field('banner', 'option');
			$shortcode_ads_2 = $banner['shortcode_ads_2'];
			?>
			<?php if (!empty($shortcode_ads_2)) : ?>
				<?php echo do_shortcode($shortcode_ads_2) ?>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>

<?php
get_template_part('template-parts/newsletter');
?>

<!-- FOOTER -->
<footer class="wcl-footer" id="wcl-main-footer">
	<div class="data-container wcl-container">
		<div class="data-row">
			<div class="data-col">
				<?php if (!empty($social_media)) : ?>
					<ul class="wcl-social">
						<?php if (!empty($social_media['facebook'])) : ?>
							<li class="m3-item">
								<a href="<?php echo $social_media['facebook']['url']; ?>" target="_blank">
									<img src="<?php echo get_stylesheet_directory_uri() . '/img/icon-facebook.svg'; ?>" alt="img">
								</a>
							</li>
						<?php endif; ?>

						<?php if (!empty($social_media['instagram'])) : ?>
							<li class="m3-item">
								<a href="<?php echo $social_media['instagram']['url']; ?>" target="_blank">
									<img src="<?php echo get_stylesheet_directory_uri() . '/img/icon-instagram.svg'; ?>" alt="img">
								</a>
							</li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>

				<div class="data-site-name">
					<a href="<?php echo site_url('/'); ?>">
						<?php echo get_bloginfo('name'); ?>
					</a>
				</div>

				<?php if (!empty($desc)) : ?>
					<div class="data-desc">
						<?php echo $desc; ?>
					</div>
				<?php endif; ?>

				<div class="data-created-by">
					Website designed by

					<a href="https://webcomplete.io/" target="_blank">WebComplete</a>
				</div>
			</div>

			<div class="data-col">
				<?php wp_nav_menu(
					array(
						'container'      => '',
						'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
						'theme_location' => 'footer-menu',
						'depth'          => 1,
						'fallback_cb'    => '',
						'link_before' => '<span>', 'link_after' => '</span>'
					)
				); ?>
			</div>
		</div>
	</div>
</footer> <!-- #wcl-main-footer -->



</div> <!-- .wcl-body-inner -->



<?php wp_footer(); ?>


</body>

</html>