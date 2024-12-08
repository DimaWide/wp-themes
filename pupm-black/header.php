<!DOCTYPE html>
<html <?php echo get_language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo wp_get_document_title(); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<meta name="cryptomus" content="2a6f6c30" />

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>


	<!-- 
	====================================================================
		DEVELOPED BY WebComplete (webcomplete.io)
	====================================================================
	 -->



	<?php
	// var_dump(np_get_orders_by_order_id('66f46deb3fa28'));

	// $odrer_data = np_get_orders_by_order_id('66f66eaccfada');

	// $payload_to_email = array(
	// 	'order_id'       => '66f66eaccfada',
	// 	'user_id'        => $odrer_data['user_id'],
	// 	'package'        => $odrer_data['package'],
	// 	'price_amount'   => $odrer_data['amount'],
	// 	'price_currency' => 'sol',
	// 	'status'         => 'Finished',
	// );

	// send_order_confirmation_email($payload_to_email);

	// function getSolPrice() {
	// 	$url = "https://frontend-api.pump.fun/sol-price";
	
	// 	// Initialize cURL session
	// 	$ch = curl_init();
		
	// 	// Set cURL options
	// 	curl_setopt($ch, CURLOPT_URL, $url);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, [
	// 		'accept: */*'
	// 	]);
	
	// 	// Execute the request
	// 	$response = curl_exec($ch);
		
	// 	// Check for cURL errors
	// 	if (curl_errno($ch)) {
	// 		echo 'cURL Error: ' . curl_error($ch) . "\n";
	// 	}
		
	// 	// Close cURL session
	// 	curl_close($ch);
		
	// 	// Debugging: Output the raw response
	// 	echo "API Response: $response\n";
	
	// 	// Decode the JSON response
	// 	$data = json_decode($response, true);
	
	// 	// Check if the response contains the price
	// 	if (isset($data['data']['price'])) {
	// 		return $data['data']['price'];
	// 	} else {
	// 		return null; // Handle error case
	// 	}
	// }
	
	// // Example usage
	// $solPrice = getSolPrice();
	// if ($solPrice !== null) {
	// 	echo "Current SOL Price: $solPrice USD\n";
	// 	$solAmount = 10; // Example SOL amount
	// 	$usdValue = $solAmount * $solPrice;
	// 	echo "USD Value: $usdValue\n";
	// } else {
	// 	echo "Could not fetch SOL price.\n";
	// }
	
	$telegram_link = get_field('telegram_link', 'option');
	?>
	<?php if (! is_front_page()): ?>
		<div id="tsparticles" class="wcl-tsparticles"></div>
	<?php endif; ?>

	<div class="wcl-body-inner">
		<div class="sct-decoration">
			<div class="data-container wcl-container">
				<div class="data-circles mod-1">
					<div class="data-circles-item"></div>
					<div class="data-circles-item"></div>
					<div class="data-circles-item"></div>
				</div>

				<div class="data-circles mod-2">
					<div class="data-circles-item"></div>
					<div class="data-circles-item"></div>
					<div class="data-circles-item"></div>
				</div>
			</div>

			<div class="data-b1" style="display: none;">
				<div class="data-b1-item">
					<img src="<?php echo get_stylesheet_directory_uri() . '/img/1-2-left.png'; ?>" alt="img">
				</div>

				<div class="data-b1-item">
					<img src="<?php echo get_stylesheet_directory_uri() . '/img/1-1-right.png'; ?>" alt="img">
				</div>
			</div>
		</div>

		<div class="sct-header">
			<div class="data-container wcl-container">
				<div class="data-row">
					<div class="data-col">
						<div class="data-logo">
							<a href="<?php echo site_url(); ?>">
								<img src="<?php echo get_stylesheet_directory_uri() . '/img/logo.svg'; ?>" alt="img">
							</a>
						</div>
					</div>

					<div class="data-col">
						<div class="data-btns">
							<div class="data-btns-item">
								<?php if (! empty($telegram_link)): ?>
									<a href="<?php echo esc_url($telegram_link); ?>" target="_blank" rel="noopener noreferrer">
										Сontact
									</a>
								<?php endif; ?>
							</div>

							<div class="data-btns-item">
								<a href="<?php echo site_url('/') . 'order'; ?>">
									Advertise
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>