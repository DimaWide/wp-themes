<?php


$logo      = get_field('logo_dark', 'option');
$logo      = wp_get_attachment_image($logo, 'full');
$phone     = get_field('phone', 'option');
$email     = get_field('email', 'option');
$address   = get_field('address', 'option');
$copyright = get_field('copyright', 'option');
?>
<!-- FOOTER -->
<footer class="wcl-footer" id="wcl-main-footer">
	<div class="data-container wcl-container">
		<div class="data-b1">
			<div class="data-row">
				<div class="data-col">
					<?php
					footer_menu();
					?>
				</div>

				<div class="data-col">
					<?php if (!empty($logo)) : ?>
						<div class="data-logo">
							<a href="<?php echo site_url(); ?>">
								<?php echo $logo; ?>
							</a>
						</div>
					<?php endif; ?>
				</div>

				<div class="data-col">
					<div class="data-b2">
						<div class="data-b2-col">
							<?php if (! empty($address)): ?>
								<?php
								$part_1 = $address['part_1'];
								$part_2 = $address['part_2'];
								?>
								<div class="data-b2-address">
									<div class="data-b2-item"><?php echo $part_1; ?></div>
									<div class="data-b2-item"><?php echo $part_2; ?></div>
								</div>
							<?php endif; ?>
						</div>

						<div class="data-b2-col">
							<?php if (!empty($phone)) : ?>
								<?php
								$phone_clean = preg_replace('/[^\d+]/', '', $phone);
								?>
								<div class="data-b2-item data-phone ">
									<a href="tel:<?php echo $phone_clean; ?>">
										<?php echo $phone; ?>
									</a>
								</div>
							<?php endif; ?>

							<?php if (! empty($email)): ?>
								<div class="data-b2-item data-email">
									<a href="mailto:<?php echo $email; ?>">
										<?php echo $email; ?>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="data-b3">
			<div class="data-b3-row">
				<div class="data-copyright">
					© <?php echo date('Y'); ?> RMA Development LLC. All Rights Reserved.
				</div>

				<?php wp_nav_menu(array(
					'theme_location' => 'footer-second-menu',
					'container'      => 'false',
					'menu_class'     => 'data-menu-2',
					'depth'          => 1,
				)); ?>
			</div>

			<?php if (! empty($copyright)): ?>
				<?php
				$copyright = preg_replace(
					'/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})/',
					'<a href="mailto:$1">$1</a>',
					$copyright
				);
				?>
				<div class="data-b3-text">
					<?php echo $copyright; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</footer> <!-- #wcl-main-footer -->





</div> <!-- .wcl-body-inner -->


<?php wp_footer(); ?>


</body>

</html>