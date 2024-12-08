<?php

$tables_field = get_field('tables_field', 'option');
$count_fields_big_buys        = $tables_field['big_buys'] ?? 10;
$count_fields_big_buys_mobile = $tables_field['big_buys_mobile'] ?? 7;

$fields_data = '';

if (is_local_dev_site()) {
	$fields_data = get_option('big_buys_data');
} else {
	$fields_data = getTableData('big_buys', $count_fields_big_buys);
}
?>
<!-- sct-1-featured-fields mod-big-buys -->
<div class="sct-1-featured-fields mod-big-buys">
	<div class="data-container wcl-container">
		<div class="data-circles">
			<div class="data-circles-item"></div>
			<div class="data-circles-item"></div>
			<div class="data-circles-item"></div>
			<div class="data-circles-item"></div>
			<div class="data-circles-item"></div>
			<div class="data-circles-item"></div>
		</div>

		<div class="data-b3 mod-mobile">
			<div class="data-b1">
				<div class="data-title">
					BIG BUYS
				</div>

				<div class="data-b1-icon">
					<img src="<?php echo get_stylesheet_directory_uri() . '/img/play.svg'; ?>" alt="img">
				</div>
			</div>

			<div class="data-b2-table mod-mobile-table">
				<?php if (! empty($fields_data)): ?>
					<?php foreach ($fields_data as $key => $row): ?>
						<?php
						if ($key + 1 > $count_fields_big_buys_mobile) {
							break;
						}

						$dataOptimizer = new DataOptimizer($row);
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

									<div class="data-b2-item-sol mod-flex-center">
										<img src="<?php echo get_stylesheet_directory_uri() . '/img/solana-sol-logo.svg'; ?>" alt="img">
										<?php echo $dataOptimizer->formatSolAmount(true); ?>
									</div>

									<?php echo $dataOptimizer->getMarketCapBigBuys(); ?>
								</div>

								<div class="data-b3-col">
									<div class="data-b2-item-holders mod-flex-center">
										<img src="<?php echo get_stylesheet_directory_uri() . '/img/profile.svg'; ?>" alt="img">
										<?php echo esc_html($dataOptimizer->get('holders_count')); ?>
									</div>

									<div class="data-b2-item-launch mod-flex-center">
										<img src="<?php echo get_stylesheet_directory_uri() . '/img/chat.svg'; ?>" alt="img">
										<?php echo esc_html($dataOptimizer->get('reply_count')); ?>
									</div>

									<div class="data-b2-item-launch">
										<?php
										echo formatTimeAgo($dataOptimizer->get('created_timestamp'));
										?>
									</div>
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
				BIG BUYS
			</div>

			<div class="data-b1-icon">
				<img src="<?php echo get_stylesheet_directory_uri() . '/img/play.svg'; ?>" alt="img">
			</div>
		</div>

		<div class="data-b2">
			<table class="data-b2-table mod-desktop-table">
				<thead>
					<tr class="data-b2-head-row">
						<th>Image</th>
						<th>Name</th>
						<th>$SYMBOL</th>
						<th class="data-b2-head-usd">usd
							<span class="data-b2-head-usd-out">
								<span class="data-b2-head-usd-sign">(?)
								</span>
								<div class="data-b2-note">
									Buy Amount
								</div>
							</span>
						</th>
						<th class="data-b2-head-usd">SOL
							<span class="data-b2-head-usd-out">
								<span class="data-b2-head-usd-sign">(?)
								</span>
								<div class="data-b2-note">
									Buy Amount
								</div>
							</span>
						</th>
						<th>CA</th>
						<th>Social</th>
						<th>Marketcap</th>
						<th>Holders</th>
						<th>Replies</th>
						<th>Launch</th>
						<th>buy links</th>
					</tr>
				</thead>


				<tbody>
					<?php if (! empty($fields_data)): ?>
						<?php foreach ($fields_data as $key => $row): ?>
							<?php
							if ($key + 1 > $count_fields_big_buys) {
								break;
							}

							$dataOptimizer = new DataOptimizer($row);
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
									<div class="data-b2-item-usd mod-flex-center">
										<img src="<?php echo get_stylesheet_directory_uri() . '/img/dollar-money-sign.svg'; ?>" alt="img">
										<?php echo $dataOptimizer->formatUsdSolAmountBigBuys(); ?>
										<?php ///echo $dataOptimizer->formatUsdMarketCap(); 
										?>
									</div>
								</td>

								<td>
									<div class="data-b2-item-sol mod-flex-center">
										<img src="<?php echo get_stylesheet_directory_uri() . '/img/solana-sol-logo.svg'; ?>" alt="img">
										<?php echo $dataOptimizer->formatSolAmount(); ?>
									</div>
								</td>

								<td>
									<?php echo $dataOptimizer->getCaHtml(); ?>
								</td>

								<td>
									<?php echo $dataOptimizer->getSocialLinksHtml(); ?>
								</td>

								<td>
									<?php echo $dataOptimizer->getMarketCapBigBuys(); ?>
								</td>

								<td>
									<div class="data-b2-item-holders mod-flex-center">
										<img src="<?php echo get_stylesheet_directory_uri() . '/img/profile.svg'; ?>" alt="img">
										<?php echo $dataOptimizer->get('holders_count'); ?>
									</div>
								</td>

								<td>
									<div class="data-b2-item-launch mod-flex-center">
										<img src="<?php echo get_stylesheet_directory_uri() . '/img/chat.svg'; ?>" alt="img">
										<?php echo $dataOptimizer->get('reply_count'); ?>
									</div>
								</td>

								<td>
									<div class="data-b2-item-launch">
										<?php
										echo formatTimeAgo($dataOptimizer->get('created_timestamp'));
										?>
									</div>
								</td>

								<td>
									<?php echo $dataOptimizer->getBuyLinksHtml(); ?>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>