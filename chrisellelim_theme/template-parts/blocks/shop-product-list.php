<?php

/**
 * Block Name: Product List
 */
?>


<div class="wcl-section-16 mod-old-site">
	<div class="data-list swiper">
		<div class="data-inner swiper-wrapper">
			<?php if (have_rows('block_shop_list_products')) : ?>
				<?php while (have_rows('block_shop_list_products')) : the_row(); ?>
					<?php
					$title = get_sub_field('name');
					$link  = get_sub_field('link');
					$brand = get_sub_field('brand');
					$brand = !empty($brand) ? $brand : 'Brand';
					$image = get_sub_field('image');
					$image = wp_get_attachment_image($image,  'image-i', false, ['class' => 'notpin2']);
					?>
					<div class="data-a wcl-thing data-item swiper-slide">
						<a href="<?php echo $link; ?>" class="d6-inner" target="_blank">
							<?php if (!empty($image)) : ?>
								<div class="d6-img">
									<?php echo $image; ?>
								</div>
							<?php endif; ?>

							<div class="d6-info">
								<?php if (!empty($title)) : ?>
									<div class="d6-title">
										<?php echo $title; ?>
									</div>
								<?php endif; ?>

								<?php if (!empty($brand)) : ?>
									<div class="d6-brand">
										<?php echo $brand; ?>
									</div>
								<?php endif; ?>
							</div>
						</a>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</div>