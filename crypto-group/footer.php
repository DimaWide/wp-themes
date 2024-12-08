<?php

$logo_header = get_field('logo_header', 'option');
$logo_header = wp_get_attachment_image($logo_header, 'full');
$privacy     = get_field('privacy', 'option');

$privacy_image = $privacy['image'];
$privacy_image = wp_get_attachment_image($privacy_image, 'full');
$privacy_text  = $privacy['copyright'];
?>

<?php if (is_front_page()): ?>
	<?php get_template_part('template-parts/bar'); ?>
<?php endif; ?>

<?php get_template_part('template-parts/bar-two'); ?>

<?php get_template_part('template-parts/popup'); ?>

<?php get_template_part('template-parts/registration-popup'); ?>

<?php get_template_part('template-parts/login-popup'); ?>

<!-- FOOTER -->
<footer class="wcl-footer" id="wcl-main-footer">
	<div class="data-container wcl-container">
		<?php if (!empty($logo_header)) : ?>
			<div class="data-logo">
				<a href="<?php echo get_site_url(); ?>">
					<?php echo $logo_header; ?>
				</a>
			</div>
		<?php endif; ?>

		<?php if (have_rows('social_media', 'option')) : ?>
			<div class="data-b1">
				<?php while (have_rows('social_media', 'option')) : the_row(); ?>
					<div class="data-b1-col">
						<?php
						$group_1 = get_sub_field('group_1', 'option');
						?>
						<?php if (!empty($group_1)) : ?>
							<ul class="data-social-media">
								<?php if (!empty($group_1['youtube'])) : ?>
									<li class="data-social-media-item">
										<a href="<?php echo $group_1['youtube']['url']; ?>" target="_blank" rel="noopener nofollow">
											<span class="data-social-media-item-img">
												<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/media-youtube.svg', false); ?>
											</span>

											<?php echo $group_1['youtube']['title']; ?>
										</a>
									</li>
								<?php endif; ?>

								<?php if (!empty($group_1['instagram'])) : ?>
									<li class="data-social-media-item">
										<a href="<?php echo $group_1['instagram']['url']; ?>" target="_blank" rel="noopener nofollow">
											<span class="data-social-media-item-img">
												<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/media-instagram.svg', false); ?>
											</span>

											<?php echo $group_1['instagram']['title']; ?>
										</a>
									</li>
								<?php endif; ?>

								<?php if (!empty($group_1['facebook'])) : ?>
									<li class="data-social-media-item">
										<a href="<?php echo $group_1['facebook']['url']; ?>" target="_blank" rel="noopener nofollow">
											<span class="data-social-media-item-img">
												<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/media-facebook.svg', false); ?>
											</span>

											<?php echo $group_1['facebook']['title']; ?>
										</a>
									</li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>
					</div>

					<div class="data-b1-col">
						<?php
						$group_2 = get_sub_field('group_2', 'option');
						?>
						<?php if (!empty($group_2)) : ?>
							<ul class="data-social-media">
								<?php if (!empty($group_2['youtube'])) : ?>
									<li class="data-social-media-item">
										<a href="<?php echo $group_2['youtube']['url']; ?>" target="_blank" rel="noopener nofollow">
											<span class="data-social-media-item-img">
												<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/media-youtube.svg', false); ?>
											</span>

											<?php echo $group_2['youtube']['title']; ?>
										</a>
									</li>
								<?php endif; ?>

								<?php if (!empty($group_2['instagram'])) : ?>
									<li class="data-social-media-item">
										<a href="<?php echo $group_2['instagram']['url']; ?>" target="_blank" rel="noopener nofollow">
											<span class="data-social-media-item-img">
												<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/media-instagram.svg', false); ?>
											</span>

											<?php echo $group_2['instagram']['title']; ?>
										</a>
									</li>
								<?php endif; ?>

								<?php if (!empty($group_2['facebook'])) : ?>
									<li class="data-social-media-item">
										<a href="<?php echo $group_2['facebook']['url']; ?>" target="_blank" rel="noopener nofollow">
											<span class="data-social-media-item-img">
												<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/media-facebook.svg', false); ?>
											</span>

											<?php echo $group_2['facebook']['title']; ?>
										</a>
									</li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>

		<div class="data-privacy">
			<?php if (!empty($privacy_image)) : ?>
				<div class="data-privacy-img">
					<?php echo $privacy_image; ?>
				</div>
			<?php endif; ?>

			<?php if (!empty($privacy_text)) : ?>
				<div class="data-privacy-text">
					<?php echo replaceSecondYearWithCurrent($privacy_text); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</footer> <!-- #wcl-main-footer -->


</div> <!-- .wcl-body-inner -->


<?php wp_footer(); ?>


</body>

</html>