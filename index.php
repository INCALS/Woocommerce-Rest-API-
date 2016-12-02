<?php
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'http://babaplant.com',  // your website url here.
    'ck_4accfc7######################6842bd42548', // your consumer key.
    'cs_7b0f307######################f61344deaa4', // your consumer Secret.
    [
        'wp_api' => true,
        'version' => 'wc/v1',
		'query_string_auth' => true,
		'verify_ssl' => false,
    ]
);

use Automattic\WooCommerce\HttpClient\HttpClientException;

try {
    // Array of response results.
    $results = $woocommerce->get('products');
    // Example: ['products' => [[ 'id' => 8, 'created_at' => '2015-05-06T17:43:51Z', 'email' => ...
    
	
	$json_string = json_encode($results, JSON_PRETTY_PRINT); //1
	//here we get disturbed JSON & some of Character are needed to escaped 
    //we are working on it.stay calm stay connected we will post it earliest.	
	\print_r($json_string); //2
	// all we need is 1 & 2 for JSON print
	
	
	
	
	// Last request data.
    $lastRequest = $woocommerce->http->getRequest();
    $lastRequest->getUrl(); // Requested URL (string).
    $lastRequest->getMethod(); // Request method (string).
    $lastRequest->getParameters(); // Request parameters (array).
    $lastRequest->getHeaders(); // Request headers (array).
    $lastRequest->getBody(); // Request body (JSON).

    // Last response data.
    $lastResponse = $woocommerce->http->getResponse();
    $lastResponse->getCode(); // Response code (int).
    $lastResponse->getHeaders(); // Response headers (array).
    $lastResponse->getBody(); // Response body (JSON).

} catch (HttpClientException $e) {
    $e->getMessage(); // Error message.
    $e->getRequest(); // Last request data.
    $e->getResponse(); // Last response data.
}

?>

