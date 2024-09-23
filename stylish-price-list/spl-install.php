<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( is_admin() ) {
	global $wpdb;
	$wp_prefix = $wpdb->prefix;
		// This includes the dbDelta function from WordPress.
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	if ( '0.0' == STYLISH_PRICE_LIST_VERSION ) {
			//we my do some reset job here, like delete the table
	}
	update_option( 'stylish_price_list_version', STYLISH_PRICE_LIST_VERSION );
}
