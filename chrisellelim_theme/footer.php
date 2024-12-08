<?php


?>
<?php if (!is_page(397)) : ?>
	<?php
	get_template_part('template-parts/instagram');
	?>
<?php endif; ?>

<?php
$social    = get_field('social', 'option');
$logo      = get_field('ft_logo', 'option');
$mailchimp = get_field('mailchimp', 'option');
?>
<footer class="wcl-footer">
	<div class="data-1">
		<div class="data-container wcl-container">
			<div class="data-1-row">
				<div class="data-1-col">
					<?php wp_nav_menu(
						array(
							'container'      => '',
							'items_wrap'     => '<ul class="data-1-menu">%3$s</ul>',
							'theme_location' => 'footer-menu',
							'depth'          => 1,
							'fallback_cb'    => '__return_empty_string',
						)
					); ?>
				</div>

				<div class="data-1-col">
					<?php wp_nav_menu(
						array(
							'container'      => '',
							'items_wrap'     => '<ul class="data-1-menu">%3$s</ul>',
							'theme_location' => 'footer-menu-2',
							'depth'          => 1,
							'fallback_cb'    => '__return_empty_string',
						)
					); ?>
				</div>

				<div class="data-1-col">
					<div class="data-1-logo">
						<a href="<?php echo site_url('/'); ?>">
							<?php if (!empty($logo)) : ?>
								<img src="<?php echo $logo['url'];  ?>" alt="<?php echo get_bloginfo('name') ?>">
							<?php else :
								echo get_bloginfo('name');
							endif; ?>
						</a>
					</div>
				</div>

				<div class="data-1-col">
					<div class="wcl-subscribe">
						<?php if (!empty($mailchimp['title'])) : ?>
							<h3 class="data-title">
								<?php echo wpautop($mailchimp['title']); ?>
							</h3>
						<?php endif; ?>

						<form class="data-form" autocomplete="off">
							<div class="data-form-group">
								<input type="email" name="email" placeholder="Email Address" required>
								<input type="submit" value="Submit">
							</div>
						</form>
					</div>

					<?php if (!empty($social)) : ?>
						<ul class="data-1-social">
							<?php if (!empty($social['instagram'])) : ?>
								<li class="data-1-social-item">
									<a href="<?php echo $social['instagram']['url']; ?>" target="_blank">
										<i class="fa-brands fa-instagram"></i>
									</a>
								</li>
							<?php endif; ?>
							<?php if (!empty($social['youtube'])) : ?>
								<li class="data-1-social-item">
									<a href="<?php echo $social['youtube']['url']; ?>" target="_blank">
										<i class="fa-brands fa-youtube"></i>
									</a>
								</li>
							<?php endif; ?>
							<?php if (!empty($social['tiktok'])) : ?>
								<li class="data-1-social-item">
									<a href="<?php echo $social['tiktok']['url']; ?>" target="_blank">
										<i class="fa-brands fa-tiktok"></i>
									</a>
								</li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<div class="data-2">
		<div class="data-container wcl-container">
			<div class="data-2-inner">
				<?php the_date('Y'); ?> Chriselle Lim. All Rights Reserved |
				<a href="https://chloedigital.com/contact#studio" target="_blank">
					Powered by chloédigital
				</a>
			</div>
		</div>
	</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>

</html>