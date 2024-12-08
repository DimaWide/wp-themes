<?php

$form_newsletter = get_field('form_newsletter', 'option');
$form_title = $form_newsletter['title'];
$form_shortcode = $form_newsletter['shortcode'];

$logo_for_light_theme = get_field('logo_for_light_theme', 'option');
$logo_for_light_theme = wp_get_attachment_image($logo_for_light_theme, 'full');
$logo_for_dark_theme = get_field('logo_for_dark_theme', 'option');
$logo_for_dark_theme = wp_get_attachment_image($logo_for_dark_theme, 'full');

?>
<!-- FOOTER -->
<footer class="wcl-footer" id="wcl-main-footer">
	<div class="data-container wcl-container">
		<div class="data-b1">
			<div class="data-row">
				<div class="data-col">
					<?php if (!empty($logo_for_light_theme || $logo_for_dark_theme)) : ?>
						<div class="wcl-logo data-logo">
							<a href="<?php echo site_url('/'); ?>">
								<?php if (!empty($logo_for_light_theme)) : ?>
									<span class="m2-item mod-light">
										<?php echo $logo_for_light_theme; ?>
									</span>
								<?php endif; ?>

								<?php if (!empty($logo_for_dark_theme)) : ?>
									<span class="m2-item mod-dark">
										<?php echo $logo_for_dark_theme; ?>
									</span>
								<?php endif; ?>
							</a>
						</div>
					<?php endif; ?>

					<?php wp_nav_menu(
						array(
							'container'      => '',
							'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
							'theme_location' => 'main-menu',
							'depth'          => 1,
							'fallback_cb'    => '',
							//'link_before' => '<span>', 'link_after' => '</span>'
						)
					); ?>
				</div>

				<div class="data-col">
					<div class="wcl-newsletter mod-footer data-form">
						<div class="m4-form">
							<?php if (!empty($form_title)) : ?>
								<div class="m4-form-title data-sidebar-item-title">
									<?php echo $form_title; ?>
								</div>
							<?php endif; ?>

							<div class="m4-form-model">
								<?php if (!empty($form_shortcode)) : ?>
									<?php echo do_shortcode($form_shortcode); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="data-b2">
			<div class="data-row">
				<div class="data-col">
					<div class="data-b2-text">
						© <?php echo date('Y'); ?> A&H Consulting. All rights reserved.
					</div>
				</div>

				<div class="data-col">
					<?php wp_nav_menu(
						array(
							'container'      => '',
							'items_wrap'     => '<ul class="data-menu">%3$s</ul>',
							'theme_location' => 'footer-copyright-menu',
							'depth'          => 1,
							'fallback_cb'    => '',
						)
					); ?>
				</div>
			</div>
		</div>
	</div>
</footer> <!-- #wcl-main-footer -->





</div> <!-- .wcl-body-inner -->


<?php wp_footer(); ?>


</body>

</html>