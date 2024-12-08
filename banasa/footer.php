<?php


$footer_logo        = get_field('footer_logo', 'option');
$footer_logo        = wp_get_attachment_image($footer_logo, 'full');
$footer_logo_second = get_field('footer_logo_second', 'option');
$footer_logo_second = wp_get_attachment_image($footer_logo_second, 'full');

$contact_form = get_field('contact_form', 'option');
$contact_info = get_field('contact_info', 'option');
?>
<!-- FOOTER -->
<footer class="wcl-footer" id="wcl-main-footer">
	<div class="data-container wcl-container">
		<div class="data-inner">
			<div class="data-line">
				<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/line.svg', false); ?>
			</div>

			<div class="data-row">
				<div class="data-col">
					<?php if (!empty($footer_logo)) : ?>
						<div class="data-logo">
							<a href="<?php echo site_url(); ?>">
								<?php echo $footer_logo; ?>
							</a>
						</div>
					<?php endif; ?>

					<?php if (!empty($footer_logo_second)) : ?>
						<div class="data-logo-2">
							<?php echo $footer_logo_second; ?>
						</div>
					<?php endif; ?>

					<div class="data-copyright">
						<?php
						if (function_exists('icl_t')) {
						?>
							©<?php echo date('Y'); ?> Banasa. <?php echo icl_t('banasa', 'footer_copyright', 'Todos los derechos reservados!'); ?>
						<?php
						} else {
						?>
							©<?php echo date('Y'); ?> Banasa. Todos los derechos reservados!
						<?php
						}
						?>
					</div>
				</div>

				<div class="data-col">
					<?php wp_nav_menu(array(
						'theme_location' => 'main-menu',
						'container'      => 'false',
						'menu_class'     => 'data-menu nav main-menu',
						'depth'          => 1,
					)); ?>

					<?php wp_nav_menu(array(
						'theme_location' => 'additional-pages-menu',
						'container'      => 'false',
						'menu_class'     => 'data-menu-2 nav additional-pages-menu',
						'depth'          => 1,
					)); ?>
				</div>

				<div class="data-col">
					<?php if (!empty($contact_form)) : ?>
						<?php
						$title          = $contact_form['title'];
						$form_shortcode = $contact_form['form_shortcode'];
						?>
						<div class="cmp-2-form data-form">
							<?php if (!empty($title)) : ?>
								<div class="cmp2-head">
									<h3 class="cmp2-title">
										<?php echo $title; ?>
									</h3>

									<div class="cmp2-arrow">
										<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/arrow-long-right.svg', false); ?>
									</div>
								</div>
							<?php endif; ?>

							<div class="cmp2-body">
								<?php echo do_shortcode($form_shortcode); ?>
							</div>
						</div>
					<?php endif; ?>

					<?php if (!empty($contact_info)) : ?>
						<div class="data-contact-info">
							<?php
							$address_1    = $contact_info['address_1'];
							$address_2    = $contact_info['address_2'];
							$phone        = $contact_info['phone'];
							$email        = $contact_info['email'];

							$phone_link = "<a href='tel:" . str_replace(' ', '', $phone) . "'>{$phone}</a>";
							$email_link = "<a href='mailto:{$email}'>{$email}</a>";

							$contact_string = "{$address_1} | {$address_2}<br>{$phone_link} | {$email_link}";

							echo $contact_string;
							?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</footer> <!-- #wcl-main-footer -->





</div> <!-- .wcl-body-inner -->


<?php wp_footer(); ?>


</body>

</html>