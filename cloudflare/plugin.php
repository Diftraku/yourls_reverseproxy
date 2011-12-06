<?php
/*
Plugin Name: CloudFlare
Plugin URI: http://cloudflare.com/
Description: Fixes incoming IPs to use the CloudFlare CF-Connecting-IP instead of CDN IP
Version: 0.1
Author: Diftraku
Author URI: http://project-moocow.net/
*/

// No direct call
if( !defined( 'YOURLS_ABSPATH' ) ) die();

// Simple fix to get the correct source IP
yourls_add_filter( 'get_IP', 'cloudflare_get_IP');
function cloudflare_get_IP($ip) {
	if ( !empty( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) {
		$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
	}
	return yourls_sanitize_ip( $ip );
}
