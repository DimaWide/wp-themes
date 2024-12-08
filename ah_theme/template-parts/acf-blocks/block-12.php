<?php


$group_1  = get_field('group_1');
$title    = $group_1['title'];
$subtitle = $group_1['subtitle'];

$group_2 = get_field('group_2');
$email   = $group_2['email'];
$office  = $group_2['office'];
?>
<!-- Acf Block #12 – Contact Us -->
<div class="wcl-acf-block-12">
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
					<div class="data-info">
						<?php if (!empty($email)) : ?>
							<div class="data-info-item">
								<div class="data-info-item-label">
									Email
								</div>

								<div class="data-info-item-value">
									<a href="mailto:<?php echo $email; ?>">
										<?php echo $email; ?>
									</a>
								</div>
							</div>
						<?php endif; ?>

						<?php if (!empty($office)) : ?>
							<div class="data-info-item">
								<div class="data-info-item-label">
									Office
								</div>

								<div class="data-info-item-value">
									<address>
										<?php echo $office; ?>
									</address>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>