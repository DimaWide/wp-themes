<?php


$ft_text = get_field('ft_text', 'option');
$social = get_field('social', 'option');
$logo = get_field('logo', 'option');
$logo = wp_get_attachment_image($logo, 'full');
$recaptcha = get_field('recaptcha', 'option');
?>
<footer class="wcl-footer">
	<div class="data-container wcl-container">
		<div class="data-row">
			<div class="data-col">
				<div class="data-logo">
					<a href="<?php echo site_url('/'); ?>">
						<?php if (!empty($logo)) : ?>
							<?php echo $logo; ?>
						<?php else :
							echo get_bloginfo('name');
						endif; ?>
					</a>
				</div>

				<?php if (!empty($ft_text)) : ?>
					<div class="data-text">
						<?php echo wpautop($ft_text); ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if (have_rows('ft_nav', 'option')) : ?>
				<?php while (have_rows('ft_nav', 'option')) : the_row(); ?>
					<?php
					$title = get_sub_field('title');
					?>
					<div class="data-col">
						<div class="data-a">
							<?php if (!empty($title)) : ?>
								<h3 class="data-a-title">
									<?php echo $title; ?>
								</h3>
							<?php endif; ?>

							<?php if (have_rows('list')) : ?>
								<ul class="data-a-menu">
									<?php while (have_rows('list')) : the_row(); ?>
										<?php
										$link  = get_sub_field('link');
										?>
										<?php if (!empty($link)) : ?>
											<?php
											$link_url    = $link['url'];
											$link_title  = $link['title'];
											$link_target = $link['target'] ?: '_self';
											?>
											<li class="data-a-menu-item">
												<a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>">
													<?php echo $link_title; ?>
													<img width="16" height="9" src="<?php echo get_stylesheet_directory_uri() . '/img/footer-arrow.svg'; ?>" alt="img">
												</a>
											</li>
										<?php endif; ?>
									<?php endwhile; ?>
								</ul>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>

			<div class="data-col">
				<div class="data-a">
					<h3 class="data-a-title">
						Follow us
					</h3>

					<?php if (!empty($social)) : ?>
						<?php if (!empty($social['twitter'])) : ?>
							<div class="data-a-btn">
								<a href="<?php echo $social['twitter']['url']; ?>" target="_blank">
									<img src="<?php echo get_stylesheet_directory_uri() . '/img/footer-twitter.svg'; ?>" alt="img">
									<?php echo $social['twitter']['title']; ?>
								</a>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="data-b">
			
			<div class="data-b-text">
				<div><?php $date = date("Y"); ?> © Copyright <?php echo $date; ?>, Web3 Recruitment.com. All Rights Reserved</div>
				<div>Powered by <a href="https://webcomplete.io/" target="_blank">WebComplete</a></div>
			</div>

			<?php wp_nav_menu(
				array(
					'container'      => '',
					'items_wrap'     => '<ul class="data-b-menu">%3$s</ul>',
					'theme_location' => 'second-menu',
					'depth'          => 2,
					'fallback_cb'    => '__return_empty_string',
				)
			); ?>
		</div>
	</div>
</footer>

</div> <!-- .wcl-body-inner -->

<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $recaptcha['site_key']; ?>"></script>

<?php wp_footer(); ?>

</body>

</html>