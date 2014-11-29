<?php
/*
Plugin Name: Cloud_logs
Plugin URI: https://github.com/Diftraku/yourls_cloudflare/
Description: Fixes incoming IPs to use the client IP in headers 
Version: 2.0
Author: Diftraku
Author URI: http://derpy.me/
*/

// Block direct access to the plugin
if( !defined( 'YOURLS_ABSPATH' ) ) die();

// Add a filter to get_IP for the real IP instead of the CDN reverse proxy
yourls_add_filter( 'get_IP', 'cloudflare_get_ip');
function cloudflare_get_ip( $ip ) {
	if ( isset( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) {
		$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
	} elseif ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	return yourls_sanitize_ip( $ip );
}
