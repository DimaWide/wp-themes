<?php


$group_1  = get_field('group_1');
$title    = $group_1['title'];
$subtitle = $group_1['subtitle'];

$group_2     = get_field('group_2');
$description = $group_2['description'];
?>
<!-- Acf Block #11 – About Section -->
<div class="wcl-acf-block-11">
	<div class="data-container">
		<div class="data-inner">
			<div class="data-row">
				<div class="data-col">
					<?php if (!empty($title)) : ?>
						<div class="data-title">
							<?php echo $title; ?>
						</div>
					<?php endif; ?>

					<?php if (!empty($subtitle)) : ?>
						<div class="data-subtitle">
							<?php echo $subtitle; ?>
						</div>
					<?php endif; ?>
				</div>

				<div class="data-col">
					<?php if (!empty($description)) : ?>
						<div class="data-desc">
							<?php echo $description; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>