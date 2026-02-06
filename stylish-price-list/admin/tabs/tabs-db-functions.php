<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
function df_spl_get_all_tabs( $args ) {
	//https://wordpress.stackexchange.com/questions/236514/uninstalling-a-plugin-delete-all-options-with-specific-prefix
	global $wpdb;
	$prefix       = df_spl_get_option_prefix();
	$offset       = isset( $args['offset'] ) ? absint( $args['offset'] ) : 0;
	$limit        = isset( $args['number'] ) ? absint( $args['number'] ) : 0;
	$like         = $wpdb->esc_like( $prefix ) . '%';
	$query        = $wpdb->prepare(
		"SELECT option_name FROM $wpdb->options WHERE option_name LIKE %s LIMIT %d OFFSET %d",
		$like,
		$limit,
		$offset
	);
	$option_names = $wpdb->get_results( $query );
	$cats_data    = array();
	foreach ( $option_names as $opt ) {
		$id               = df_spl_get_id_from_option_name( $opt->option_name );
		$option           = get_option( $opt->option_name );
		$cat              = new stdClass();
		$cat->id          = $id;
		$cat->shortcode   = '[pricelist id="' . $id . '"]';
		$cat->list_name   = $option['list_name'];
		$cats_data[ $id ] = $cat;
		// delete_option($opt->option_name);
	}
	return $cats_data;
}
function df_spl_get_tabs_count() {
	global $wpdb;
	$listCount = $wpdb->get_var( "SELECT COUNT(option_name) FROM {$wpdb->prefix}options WHERE option_name LIKE 'spl_cats_%'" );
	return $listCount;
}
function df_spl_insert_tabs( $cats_data ) {
	$insert_id = time();
	if ( ! empty( $cats_data['id'] ) ) {
		$insert_id = $cats_data['id'];
	}
	$option_name = df_spl_get_option_name( $insert_id );
	update_option( $option_name, $cats_data );
	return $insert_id;
}
function df_spl_get_option_name( $id ) {
	return df_spl_get_option_prefix() . $id;
}
function df_spl_get_id_from_option_name( $option_name ) {
	$id = str_replace( df_spl_get_option_prefix(), '', $option_name );
	return $id;
}
function df_spl_get_option_prefix() {
	return 'spl_cats_';
}
function df_spl_delete_tabs_by_id( $id ) {
	$option_name = df_spl_get_option_name( $id );
	delete_option( $option_name );
}
function df_spl_get_option( $id, $context = 'frontend' ) {
	$option_name = df_spl_get_option_name( $id );
	$cats_data   = get_option( $option_name );
	if ( $context === 'frontend' ) {
		$opt         = apply_filters( 'post-spricelist-form', df_spl_get_options() );
		$cats_data   = apply_filters( 'pricelist-form-data', $cats_data, $opt );
	}
	return $cats_data;
}
function df_spl_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'df_spl_clean', $var );
	} else {
		return is_scalar( $var ) ? addslashes( htmlentities( wp_kses_post( $var ))) : $var;
	}
}

