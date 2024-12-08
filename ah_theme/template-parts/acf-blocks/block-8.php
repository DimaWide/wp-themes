<?php

$content = get_field('content');
?>
<!-- Acf Block #8 – Individual Blog Post – Call Out -->
<?php if (!empty($content)) : ?>
	<div class="wcl-acf-block-8 ">
		<div class="data-container">
			<div class="data-content">
				<?php echo $content; ?>
			</div>
		</div>
	</div>
<?php endif; ?>