<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
define( 'SPL_SPECIAL_SECRET_KEY', '5e907e39675696.20483738' );
define( 'SPL_LICENSE_SERVER_URL', 'https://members.stylishpricelist.com' );
define( 'SPL_ITEM_REFERENCE', 'stylish-price-list' );
define( 'SPL_ITEM_LEGACY_ID', '10' );
define( 'SPL_ITEM_ID', '2081' );
define( 'SPL_ITEM_V2_ID', '2489' );

if ( ! function_exists( 'df_spl_get_item_id_by_license_key' ) ) {
	function df_spl_get_item_id_by_license_key( $key ) {
		$item_id = SPL_ITEM_LEGACY_ID;
		switch ( $key ) {
			case ( strlen( $key ) == 13 ):
				$item_id = SPL_ITEM_LEGACY_ID;
				break;
			case ( strlen( $key ) > 13 && strpos( $key, 'spl-b-' ) !== 0 ):
				$item_id = SPL_ITEM_ID;
				break;
			case ( strlen( $key ) > 13 && strpos( $key, 'spl-b-' ) === 0 ):
				$item_id = SPL_ITEM_V2_ID;
				break;
			default:
				$item_id = SPL_ITEM_LEGACY_ID;
				break;
		}
		return $item_id;
	}
}
