<?php


$image = get_the_post_thumbnail($post->ID, 'image-size-5');
$terms = ordered_categories();
?>
<!-- Acf Block #7 – Individual Blog Post – Heading -->
<div class="wcl-acf-block-7">
	<div class="data-container wcl-container">
		<div class="data-row">
			<div class="data-col">
				<div class="data-info">
					<?php if (!empty($terms)) : ?>
						<div class="data-cats js-cats-post">
							<?php foreach ($terms as $term_id => $count) : ?>
								<?php
								$term = get_category($term_id);
								?>
								<div class="data-cats-item">
									<?php echo $term->name; ?>
								</div>
							<?php endforeach ?>
						</div>
					<?php endif; ?>

					<h1 class="data-title">
						<?php echo get_the_title(); ?>
					</h1>

					<?php
					$excerpt = get_post_field('post_excerpt', $post->ID);
					?>
					<?php if (!empty($excerpt)) : ?>
						<div class="data-subtitle">
							<?php echo $excerpt; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="data-col">
				<div class="data-img">
					<?php if (!empty($image)) : ?>
						<?php echo $image; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>