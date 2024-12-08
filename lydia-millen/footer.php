<?php

$logo        = get_field('logo', 'option');
$logo        = wp_get_attachment_image($logo, 'full');
$ft_logo     = get_field('ft_logo', 'option');
$ft_logo     = wp_get_attachment_image($ft_logo, 'full');
$social      = get_field('social', 'option');
$powered_by  = get_field('powered_by', 'option');
$branding_by = get_field('branding_by', 'option');
?>

<?php
get_template_part('template-parts/instagram');
?>

<!-- FOOTER -->
<footer class="wcl-footer">
	<div class="data-container wcl-container">
		<div class="data-row">
			<div class="data-a data-col">
				<div class="data-a-logo">
					<a href="<?php echo site_url('/'); ?>">
						<?php if (!empty($logo)) : ?>
							<?php echo $logo; ?>
						<?php else :
							echo get_bloginfo('name');
						endif; ?>
					</a>
				</div>

				<?php
				get_template_part('template-parts/footer-form');
				?>
			</div>

			<div class="data-b data-col">
				<?php if (!empty($ft_logo)) : ?>
					<div class="data-b-logo">
						<?php echo $ft_logo; ?>
					</div>
				<?php endif; ?>

			</div>

			<div class="data-c data-col">
				<div class="data-c-row">
					<div class="data-c-col">
						<div class="data-c-title">
							About
						</div>

						<?php wp_nav_menu(
							array(
								'container'      => '',
								'items_wrap'     => '<ul class="data-c-menu">%3$s</ul>',
								'theme_location' => 'footer-about',
								'depth'          => 1,
								'fallback_cb'    => '__return_empty_string',
							)
						); ?>
					</div>
					<div class="data-c-col">
						<div class="data-c-title">
							Topics
						</div>

						<?php wp_nav_menu(
							array(
								'container'      => '',
								'items_wrap'     => '<ul class="data-c-menu">%3$s</ul>',
								'theme_location' => 'footer-topics',
								'depth'          => 1,
								'fallback_cb'    => '__return_empty_string',
							)
						); ?>
					</div>
					<div class="data-c-col">
						<div class="data-c-title">
							Social
						</div>

						<?php if (!empty($social)) : ?>
							<ul class="data-c-menu">
								<?php if (!empty($social['instagram'])) : ?>
									<li class="data-social-item">
										<a href="<?php echo $social['instagram']['url']; ?>" target="_blank">
											<?php echo $social['instagram']['title']; ?>
										</a>
									</li>
								<?php endif; ?>
								<?php if (!empty($social['youtube'])) : ?>
									<li class="data-social-item">
										<a href="<?php echo $social['youtube']['url']; ?>" target="_blank">
											<?php echo $social['youtube']['title']; ?>
										</a>
									</li>
								<?php endif; ?>
								<?php if (!empty($social['facebook'])) : ?>
									<li class="data-social-item">
										<a href="<?php echo $social['facebook']['url']; ?>" target="_blank">
											<?php echo $social['facebook']['title']; ?>
										</a>
									</li>
								<?php endif; ?>
								<?php if (!empty($social['twitter'])) : ?>
									<li class="data-social-item">
										<a href="<?php echo $social['twitter']['url']; ?>" target="_blank">
											<?php echo $social['twitter']['title']; ?>
										</a>
									</li>
								<?php endif; ?>
								<?php if (!empty($social['pinterest'])) : ?>
									<li class="data-social-item">
										<a href="<?php echo $social['pinterest']['url']; ?>" target="_blank">
											<?php echo $social['pinterest']['title']; ?>
										</a>
									</li>
								<?php endif; ?>
								<?php if (!empty($social['tiktok'])) : ?>
									<li class="data-social-item">
										<a href="<?php echo $social['tiktok']['url']; ?>" target="_blank">
											<?php echo $social['tiktok']['title']; ?>
										</a>
									</li>
								<?php endif; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>

		<ul class="data-d">
			<?php if (!empty($powered_by)) : ?>
				<?php
				$link_url    = $powered_by['url'];
				$link_title  = $powered_by['title'];
				$link_target = $powered_by['target'] ?: '_self';
				?>
				<li class="data-d-item">
					Powered <span>by</span>
					<a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>">
						<?php echo $link_title; ?>
					</a>
				</li>
			<?php endif; ?>

			<?php if (!empty($branding_by)) : ?>
				<?php
				$link_url    = $branding_by['url'];
				$link_title  = $branding_by['title'];
				$link_target = $branding_by['target'] ?: '_self';
				?>
				<li class="data-d-item">
					Branding <span>by</span>
					<a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>">
						<?php echo $link_title; ?>
					</a>
				</li>
			<?php endif; ?>
		</ul>
	</div>
</footer> <!-- #wcl-main-footer -->


</div> <!-- .wcl-body-inner -->


<?php wp_footer(); ?>


</body>

</html>