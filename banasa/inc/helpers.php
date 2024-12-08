<?php




function wcl_debug_arr( $arr ) {
	echo '<pre>';
	print_r( $arr );
	echo '</pre>';
}


function wcl_clean_phone_number( $phone_number ) {
	$phone_number = preg_replace( '/\s+/', '', $phone_number );
	$phone_number = preg_replace( '/\(|\)|\-|\\+/', '', $phone_number );

	return $phone_number;
}


function wcl_send_error_message_to_admin( $subject, $message ) {
	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: ' . SITE_NAME . ' <' . EMAIL_SENDER . '>'
	);

	return wp_mail( CONTACT_ERROR_EMAIL, $subject, $message, $headers );
}


function wcl_curl_get( $url ) {
	$request = wp_remote_get( $url, array(
		'timeout' => 60,
		'sslverify' => false,
		'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:108.0) Gecko/20100101 Firefox/108.0',
	) );

	if ( is_array( $request ) && ! is_wp_error( $request ) ) {
		return $request['body'];
	}

	return false;
}


function wcl_captcha_validation( $action ) {
	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
	$recaptcha_secret = RECAPTCHA_SECRET_KEY;
	$recaptcha_response = sanitize_text_field( $_REQUEST['token'] );

	$recaptcha = wcl_curl_get( $recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response );
	$recaptcha = json_decode( $recaptcha );

	return( $recaptcha->success == true && $recaptcha->score >= 0.5 && $recaptcha->action == $action );
}


function wcl_curl_multi_get( $urls ) {
	$requests = Requests::request_multiple( $urls, array(
		'timeout' => 60,
		'verify' => false,
		'verifyname' => false,
		'data_format' => 'body',
		'useragent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:108.0) Gecko/20100101 Firefox/108.0',
	) );

	return $requests;
}


function wcl_curl_post( $url, $body = array(), $headers = array() ) {
	$request = wp_remote_post( $url, array(
		'body' => $body,
		'headers' => $headers,
		'timeout' => 60,
		'sslverify' => false,
		'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:108.0) Gecko/20100101 Firefox/108.0',
	) );

	if ( is_array( $request ) && ! is_wp_error( $request ) ) {
		return $request['body'];
	}

	return false;
}

