<?php



$sound_status = '';

if (isset($_COOKIE['dex_paid_page_sound'])) {
	$sound_status = $_COOKIE['dex_paid_page_sound'] === 'true' ? 'mod-enable' : 'mod-disable';
}
?>
<!-- sct-3-form -->
<div class="sct-3-form js-dex-paid-page" id="check-dexscreener-paid-status">
	<div class="data-container wcl-container">
		<div class="data-inner">
			<div class="data-row">
				<div class="data-col">
					<div class="data-imgs">
						<img src="<?php echo get_stylesheet_directory_uri() . '/img/sct3-surr-no-comments 1.png'; ?>" alt="img">
						<img src="<?php echo get_stylesheet_directory_uri() . '/img/sct3-surr-no-comments 2.png'; ?>" alt="img">
					</div>
				</div>

				<div class="data-col">
					<form class="data-form" action="<?php echo site_url('/') . 'dex-paid'; ?>" method="GET">
						<div class="data-head">
							<div class="data-title">
								CHECK DEXSCREENER PAID STATUS
							</div>

							<div class="data-b1">
								<div class="data-b1-icon <?php echo $sound_status; ?>">
									<?php if ($sound_status == 'mod-enable'): ?>
										<img src="<?php echo get_stylesheet_directory_uri() . '/img/volume-up.svg'; ?>" alt="img">
									<?php else: ?>
										<img src="<?php echo get_stylesheet_directory_uri() . '/img/volume-off.svg'; ?>" alt="img">
									<?php endif; ?>
								</div>
							</div>
						</div>

						<div class="data-form-out">
							<div class="data-form-inner">
								<div class="data-form-field">
									<input type="text" name="mint" placeholder="Enter Contract Address" required>
								</div>

								<div class="data-form-submit">
									<input type="submit" value="CHECK">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>