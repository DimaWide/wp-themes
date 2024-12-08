<?php

$tables_field = get_field('tables_field', 'option');
$count_fields_dex_paid        = $tables_field['dex_paid'] ?? 5;
$count_fields_dex_paid_mobile = $tables_field['dex_paid_mobile'] ?? 4;

$sound_status = get_sound_status('dex_paid');
$fields_data  = '';

if (is_local_dev_site()) {
	$fields_data = get_option('big_buys_data');
} else {
	$fields_data = getTableData('dex_paid', $count_fields);
}
?>
<!-- sct-1-featured-fields mod-dex-paid -->
<div class="sct-1-featured-fields mod-dex-paid dex_paid">
	<div class="data-container wcl-container">
		<div class="data-b3 mod-mobile">
			<div class="data-b1">
				<div class="data-title">
					DEX PAID
				</div>

				<div class="data-b1-icon <?php echo $sound_status; ?>">
					<?php if ($sound_status == 'mod-enable'): ?>
						<img src="<?php echo get_stylesheet_directory_uri() . '/img/volume-up.svg'; ?>" alt="img">
					<?php else: ?>
						<img src="<?php echo get_stylesheet_directory_uri() . '/img/volume-off.svg'; ?>" alt="img">
					<?php endif; ?>
				</div>
			</div>

			<div class="data-b2-table mod-mobile-table">
				<?php if (! empty($fields_data)): ?>
					<?php foreach ($fields_data as $key => $row): ?>
						<?php
						if ($key + 1 > $count_fields_dex_paid_mobile) {
							break;
						}

						$dataOptimizer = new DataOptimizer($row, 'DexPaid');
						?>
						<div class="data-b2-item">
							<div class="data-b3-row">
								<div class="data-b3-col">
									<div class="data-b2-item-image">
										<?php if (checkImageUrl($dataOptimizer->get('image_uri'))): ?>
											<img src="<?php echo $dataOptimizer->get('image_uri'); ?>" alt="img">
										<?php endif; ?>
									</div>
								</div>

								<div class="data-b3-col">
									<div class="data-b2-item-name">
										<?php echo esc_html($dataOptimizer->get('name')); ?>
									</div>

									<div class="data-b2-item-name">
										<?php echo $dataOptimizer->get('symbol'); ?>
									</div>

									<div class="data-b2-item-marketcap">
										<?php echo $dataOptimizer->formatMarketCap(); ?>
									</div>
								</div>

								<div class="data-b3-col">
									<?php echo $dataOptimizer->getCaHtml(); ?>
								</div>
							</div>

							<div class="data-b3-row">
								<div class="data-b3-col">
									<?php echo $dataOptimizer->getSocialLinksHtml(); ?>
								</div>

								<div class="data-b3-col">
									<?php echo $dataOptimizer->getBuyLinksHtml(); ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>

		<div class="data-b1">
			<div class="data-title">
				DEX PAID
			</div>

			<div class="data-b1-icon <?php echo $sound_status; ?>">
				<?php if ($sound_status == 'mod-enable'): ?>
					<img src="<?php echo get_stylesheet_directory_uri() . '/img/volume-up.svg'; ?>" alt="img">
				<?php else: ?>
					<img src="<?php echo get_stylesheet_directory_uri() . '/img/volume-off.svg'; ?>" alt="img">
				<?php endif; ?>
			</div>
		</div>

		<div class="data-b2">
			<table class="data-b2-table mod-desktop-table">
				<thead>
					<tr class="data-b2-head-row">
						<th>Image</th>
						<th>Name</th>
						<th>$SYMBOL</th>
						<th>CA</th>
						<th>Social</th>
						<th>Marketcap</th>
						<th>buy links</th>
					</tr>
				</thead>

				<tbody>
					<?php if (! empty($fields_data)): ?>
						<?php foreach ($fields_data as $key => $row): ?>
							<?php
							if ($key + 1 > $count_fields_dex_paid) {
								break;
							}

							$dataOptimizer = new DataOptimizer($row, 'DexPaid');
							?>
							<tr class="data-b2-item">
								<td>
									<div class="data-b2-item-image">
										<?php if (checkImageUrl($dataOptimizer->get('image_uri'))): ?>
											<img src="<?php echo $dataOptimizer->get('image_uri'); ?>" alt="img">
										<?php endif; ?>
									</div>
								</td>

								<td>
									<div class="data-b2-item-name">
										<?php echo $dataOptimizer->get('name'); ?>
									</div>
								</td>

								<td>
									<div class="data-b2-item-name">
										<?php echo $dataOptimizer->get('symbol'); ?>
									</div>
								</td>

								<td>
									<?php echo $dataOptimizer->getCaHtml(); ?>
								</td>

								<td>
									<div class="data-b2-item-social">
										<?php echo $dataOptimizer->getSocialLinksHtml(); ?>
									</div>
								</td>

								<td>
									<div class="data-b2-item-marketcap">
										<?php echo $dataOptimizer->formatMarketCap(); ?>
									</div>
								</td>

								<td>
									<div class="data-b2-item-buy-links">
										<?php echo $dataOptimizer->getBuyLinksHtml(); ?>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>