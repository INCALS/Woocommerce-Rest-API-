WooCommerce REST API PHP Client Library
=======================================

## About

A PHP wrapper for the WooCommerce REST API. Easily interact with the WooCommerce REST API using this library.

Feedback and bug reports are appreciated.

## Requirements

PHP 5.2.x
cURL
WooCommerce 2.2 at least on the store

## Getting started

Generate API credentials (Consumer Key & Consumer Secret) under WP Admin > Your Profile.

## Setup the library

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

### Options

* `debug` (default `false`) - set to `true` to add request/response information to the returned data. This is particularly useful for troubleshooting errors.

* `return_as_array` (default `false`) - all methods return data as a `stdClass` by default, but you can set this option to `true` to return data as an associative array instead.

* `validate_url` (default `false`) - set this to `true` to verify that the URL provided has a valid, parseable WC API index, and optionally force SSL when supported.

* `timeout` (default `30`) - set this to control the HTTP timeout for requests.

* `ssl_verify` (default `true`) - set this to `false` if you don't want to perform SSL peer verification for every request.


### Error handling
Exceptions are thrown when errors are encountered, most will be instances of `WC_API_Client_HTTP_Exception` which has two additional methods, `get_request()` and `get_response()` -- these return the request and response objects to help with debugging.


## Methods

### Index

* `$client->index->get()` - get the API index

### Orders

* `$client->orders->get()` - get a list of orders
* `$client->orders->get( null, array( 'status' => 'completed' ) )` - get a list of completed orders
* `$client->orders->get( $order_id )` - get a single order


## Credit

Copyright (c) 2013-2014 - [Gerhard Potgieter](http://gerhardpotgieter.com/), [Max Rice](http://maxrice.com) and other contributors

## License
Released under the [GPL3 license](http://www.gnu.org/licenses/gpl-3.0.html)
