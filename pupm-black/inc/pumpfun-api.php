<?php

// Define the API URL template and retry parameters
define('MAX_RETRIES', 3);
define('RETRY_DELAY', 2); // Delay in seconds between retries

// Function to fetch token details using a proxy
function getTokenDetails($mint) {

    $url = 'https://frontend-api.pump.fun/coins/' . $mint;
    $proxyPool = loadProxiesFromFile(); // Function that loads proxies from file
    
    for ($attempt = 1; $attempt <= MAX_RETRIES; $attempt++) {
        $proxy = $proxyPool[array_rand($proxyPool)]; // Select a random proxy from the pool

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_PROXY, $proxy); // Use proxy for the request
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Timeout for the request

        // Execute the request
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get HTTP status code
        $curlError = curl_error($ch);

        curl_close($ch);

        // Handle response
        if ($httpCode == 200) {
            // Parse and return the JSON response
            return json_decode($response, true);
        } elseif ($httpCode == 500) {
            // Server error, retry after delay
            error_log("Attempt $attempt/" . MAX_RETRIES . " - Server error with proxy $proxy. Retrying in " . MAX_RETRIES . " seconds...");
            sleep(MAX_RETRIES);
        } else {
            // Log any other HTTP error
            error_log("HTTP error occurred with proxy $proxy: HTTP Status $httpCode");
            break; // Break on non-server error
        }

        if (!empty($curlError)) {
            // Log cURL errors and exit the loop
            error_log("Request failed for $mint with proxy $proxy: $curlError");
            break;
        }
    }

    // Return null if all attempts fail
    return null;
}
