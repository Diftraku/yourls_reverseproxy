<?php
/*
Plugin Name: CloudFlare
Plugin URI: https://github.com/Diftraku/yourls_cloudflare/
Description: Fixes incoming IPs to use the CloudFlare CF-Connecting-IP instead of CDN server IP
Version: 1.0
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
	}
	return yourls_sanitize_ip( $ip );
}
