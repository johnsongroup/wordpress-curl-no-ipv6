<?php
/**
 * @package curl-no-ipv6
 * @version 1.0
 * @since 1.0
 */
/*
Plugin Name: cURL no IPv6
Plugin URI: https:
Description: On systems where cURL is compiled with IPv6, Requests to Wordpress Update API will timeout since cURL tries it about 15s. Since the timeout defined by WordPress is 3s/5s/10s this will breake the Updater. This Plugin simply forces cURL to use IPv4 only.
Author: GOLDERWEB – Jonathan Golder
Version: 1.0
Author URI: http://golderweb.de/
*/

// Safety first
defined( 'ABSPATH' ) OR die();

/**
 * Sets CURLOPT_IPRESOLVE to CURL_IPRESOLVE_V4 for cURL-Handle provided as parameter
 *
 * @param resource $handle A cURL handle returned by curl_init()
 * @return resource $handle A cURL handle returned by curl_init() with CURLOPT_IPRESOLVE set to CURL_IPRESOLVE_V4
 *
 */
function gw_curl_setopt_ipresolve( $handle ){
        curl_setopt( $handle, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        return $handle;
}
// Add function to hook 'http_api_curl' with priority 10 and expecting 1 parameter.
if( function_exists( 'gw_curl_setopt_ipresolve' ) ){
        add_action( 'http_api_curl', 'gw_curl_setopt_ipresolve', 10, 1);
}
