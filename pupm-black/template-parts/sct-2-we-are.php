<?php


$who_we_are = get_field('who_we_are');

$content = $who_we_are['content'];
$images  = $who_we_are['images'];
?>
<!-- sct-2-we-are -->
<div class="sct-2-we-are">
	<div class="data-container wcl-container">
		<div class="data-circles">
			<div class="data-circles-item"></div>
			<div class="data-circles-item"></div>
			<div class="data-circles-item"></div>
			<div class="data-circles-item"></div>
		</div>

		<div class="data-row">
			<div class="data-col">
				<div class="data-info">
					<?php if (! empty($content)): ?>
						<?php echo $content; ?>
					<?php endif; ?>
				</div>
			</div>

			<div class="data-col">
				<?php if (!empty($images)) : ?>
					<div class="data-b1">
						<?php foreach ($images as $image_id) : ?>
							<?php
							$image = wp_get_attachment_image($image_id, 'full');
							?>
							<?php if (! empty($image)): ?>
								<div class="data-b1-col">
									<div class="data-b1-item">
										<div class="data-b1-item-inner">
											<?php echo $image; ?>
										</div>
									</div>
								</div>
							<?php endif; ?>
						<?php endforeach ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>