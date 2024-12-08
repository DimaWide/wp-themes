<?php




// Load proxies from file
function loadProxiesFromFile($filePath = '') {

    if (!$filePath) {
        $filePath = get_template_directory() . '/proxies.txt';
    }

    $proxies = [];
    $file = fopen($filePath, 'r');
    if ($file) {
        while (($line = fgets($file)) !== false) {
            $line = trim($line);
            if (!empty($line)) {
                list($ip, $port, $user, $password) = explode(':', $line);
                $formattedProxy = "$user:$password@$ip:$port";
                $proxies[] = $formattedProxy;
            }
        }
        fclose($file);
    }
    return $proxies;
}






// Function to check if the image exists using proxies
function checkMintStatus($mint, $proxy, $retries = 3) {
    $url = "https://dd.dexscreener.com/ds-data/tokens/solana/$mint/header.png";

    for ($attempt = 0; $attempt < $retries; $attempt++) {
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_PROXY, $proxy); // Using the proxy
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Timeout for the request
        curl_setopt($ch, CURLOPT_NOBODY, true); // We don't need the content, just the header

        // Execute request
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get HTTP status code
        $curl_error = curl_error($ch);

        // Close cURL
        curl_close($ch);

        if ($http_code == 200) {
            return ["status" => true, "error" => null]; // Image exists
        } elseif (!empty($curl_error)) {
            if ($attempt == $retries - 1) {
                return ["status" => false, "error" => "Connection error: $curl_error"];
            }
        }
    }

    return ["status" => false, "error" => "Image not found or request failed"];
}





// Main logic to check multiple mints
function checkDexPaid($mint) {

    $proxies = loadProxiesFromFile(); // Load proxies from file

    $randomProxy = $proxies[array_rand($proxies)]; // Randomly select a proxy for each request
    $result = checkMintStatus($mint, $randomProxy);

    if ($result['status']) {
        return true;
    } else {
        return false;
    }
}





