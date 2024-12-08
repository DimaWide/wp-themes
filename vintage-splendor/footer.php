<?php




$logo = get_field('logo', 'option');
$logo = wp_get_attachment_image($logo, 'full');

$splendor_collective = get_field('pages', 'option');
$splendor_collective = $splendor_collective['the_splendor_collective'];
?>
<footer class="wcl-footer" id="wcl-main-footer">

	<?php get_template_part('template-parts/instagram'); ?>

	<div class="data-container wcl-container">
		<div class="data-row">
			<div class="data-col">
				<div class="data-text">
					© <?php echo date('Y'); ?> A Vintage Splendor
				</div>
			</div>

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
			</div>

			<div class="data-col">
				<div class="data-text">
					Powered by
					<a href="#">chloédigital</a>
				</div>
			</div>
		</div>
	</div>

	<div class="data-a">
		<div class="data-a-container wcl-container">
			<div class="data-a-row">
				<div class="data-a-col">
					<div class="data-b swiper">
						<div class="data-b-inner swiper-wrapper">
							<div class="data-b-item swiper-slide">
								<div class="data-a-btn wcl-t6-link">
									<div class="t6-inner">
										<a href="<?php echo get_permalink($splendor_collective); ?>" class="t6-inner-b wcl-link mod-gradient">
											<div class="t6-text">
												<span class="mod-1">Splendor Collective</span>
												<span class="mod-2">Learn more</span>
											</div>
											<?php echo file_get_contents(get_stylesheet_directory_uri() . '/img/link_arrow.svg', false); ?>
										</a>
									</div>
								</div>
							</div>

							<div class="data-b-item swiper-slide">
								<?php wp_nav_menu(
									array(
										'container'      => '',
										'items_wrap'     => '<ul class="data-a-menu">%3$s</ul>',
										'theme_location' => 'footer-menu',
										'depth'          => 1,
										'fallback_cb'    => '',
									)
								); ?>
							</div>
						</div>
					</div>
				</div>

				<div class="data-a-col">
					<?php get_template_part('template-parts/search-form'); ?>
				</div>
			</div>
		</div>
	</div>
</footer>


<?php get_template_part('template-parts/popup-type-1'); ?>

<?php get_template_part('template-parts/popup-type-2'); ?>

<?php get_template_part('template-parts/popup-type-3'); ?>


</div> <!-- .wcl-body-inner -->


<?php wp_footer(); ?>


</body>

</html>