<?php


$cta = get_field('cta', 'option');
?>
<?php if (!empty($cta)) : ?>
	<?php
	$button      = $cta['button'];
	$link_url    = $button['url'];
	$link_title  = $button['title'];
	$link_target = $button['target'] ?: '_self';
	?>
	<div class="wcl-bar-two">
		<div class="data-container wcl-container">
			<div class="data-button">
				<a href="<?php echo $link_url; ?>" class="wcl-cmp-button" target="<?php echo $link_target; ?>">
					<?php echo $link_title; ?>
					<i class="fa-fw fas fa-angle-double-right"></i>
				</a>
			</div>
		</div>
	</div>
<?php endif; ?>