<?php


$title = get_field('title');
?>
<!-- Acf Block #10 – About & Contact Us Page - Hero Section -->
<div class="wcl-acf-block-10">
	<div class="data-container">
		<?php if (!empty($title)) : ?>
			<div class="data-title">
				<?php echo $title; ?>
			</div>
		<?php endif; ?>
	</div>
</div>