<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//create shortcode

add_shortcode( 'pricelist', 'spl_shortcode_pricelist' );

function spl_shortcode_pricelist( $atts, $content = null ) {
	extract(
		shortcode_atts(
			array(
				'id' => '',

			),
			$atts
		)
	);

	/* you can use following enqueue in a shortcode to load as required */

	wp_enqueue_style( 'spl-list-style' );
	wp_enqueue_style( 'spl-bootstrap-min' );
	wp_enqueue_script( 'spl-pricelist-tabs' );
	wp_enqueue_script( 'spl-pricelist-jquery-wookmark' );

	add_action( 'wp_footer', function() use ( $id ) {
		?>
			<div class="df-spl-tooltip-container" data-price-list-id=<?php echo esc_attr( $id ); ?>></div>
		<?php
	} );
	add_action( 'admin_footer', function() use ( $id ) {
		?>
			<div class="df-spl-tooltip-container" data-price-list-id=<?php echo esc_attr( $id ); ?>></div>
			<div class="df-spl-admin-tooltip-container"></div>
		<?php
	} );

	wp_add_inline_script( 'spl-pricelist-tabs', "document.addEventListener('DOMContentLoaded', function() {dfSPLHandleTooltips($id)});" );

	wp_enqueue_style( 'font-awwsone' );
	ob_start();
	include dirname( __FILE__ ) . '/pricelist-frontend.php';
	return ob_get_clean();

}



function spl_js_css_enqueue_scripts( $hook ) {
	$assets_url = SPL_URL . 'assets';
	$assets_path = SPL_DIR . '/assets';

	wp_register_script( 'spl-pricelist-admin-core', $assets_url . '/js/pricelist-admin-core.js', array( 'jquery' ), df_spl_get_file_version( $assets_path . '/js/pricelist-admin-core.js' ), true );
	wp_register_script( 'spl-pricelist-jquery-wookmark', $assets_url . '/js/jquery.wookmark.js', array( 'jquery' ), df_spl_get_file_version( $assets_path . '/js/jquery.wookmark.js' ), true );
	wp_register_script( 'spl-pricelist-admin', $assets_url . '/js/pricelist-admin.js', array( 'jquery', 'wp-color-picker' ), df_spl_get_file_version( $assets_path . '/js/pricelist-admin.js' ), true );
	wp_register_script( 'spl-pricelist-colorpicker', $assets_url . '/js/toolcool-color-picker.min.js', array( 'jquery', 'wp-color-picker' ), df_spl_get_file_version( $assets_path . '/js/toolcool-color-picker.min.js' ), true );
	wp_register_style( 'spl-bootstrap-min', $assets_url . '/lib/bootstrap-3.3.5/dist/css/stylish-price-list-style.min.css', array(), df_spl_get_file_version( $assets_path . '/lib/bootstrap-3.3.5/dist/css/stylish-price-list-style.min.css' ) );
	wp_register_style( 'spl-list-style', $assets_url . '/css/frontend-style.css', array(), df_spl_get_file_version( $assets_path . '/css/frontend-style.css' ) );
	wp_register_style( 'spl-style-table-1', $assets_url . '/css/spl-style-table1.css', array(), df_spl_get_file_version( $assets_path . '/css/spl-style-table1.css' ) );
	wp_register_style( 'spl-style-table-2', $assets_url . '/css/spl-style-table2.css', array(), df_spl_get_file_version( $assets_path . '/css/spl-style-table2.css' ) );
	wp_register_style( 'spl-style-10', $assets_url . '/css/spl-style10.css', array(), df_spl_get_file_version( $assets_path . '/css/spl-style10.css' ) );
	wp_register_style( 'spl-style-6', $assets_url . '/css/spl-style6.css', array(), df_spl_get_file_version( $assets_path . '/css/spl-style6.css' ) );
	wp_register_style( 'font-awwsone', $assets_url . '/font-awesome/css/font-awesome.min.css', array(), df_spl_get_file_version( $assets_path . '/font-awesome/css/font-awesome.min.css' ) );
	wp_register_script( 'spl-pricelist-tabs', $assets_url . '/js/tabs.js', array( 'jquery' ), df_spl_get_file_version( $assets_path . '/js/tabs.js' ), true );
	wp_register_style( 'spl-tomselect', SPL_URL . '/assets/css/tom-select.bootstrap4.min.css', array(), df_spl_get_file_version( SPL_DIR . '/assets/css/tom-select.bootstrap4.min.css' ) );
	wp_register_script( 'spl-tomselect', SPL_URL . '/assets/js/tom-select.base.min.js', array(), df_spl_get_file_version( SPL_DIR . '/assets/js/tom-select.base.min.js' ), true );
	wp_register_script( 'spl-no-ui-slider', SPL_URL . 'assets/js/nouislider.min.js', array(), df_spl_get_file_version( SPL_DIR . '/assets/js/nouislider.min.js' ), true );
	wp_register_style( 'spl-no-ui-slider', SPL_URL . 'assets/css/nouislider.css', array(), df_spl_get_file_version( SPL_DIR . 'assets/css/nouislider.css' ) );

	// get advanced settings
	$advancedSettings = get_option(
		'spl_extra_settings',
		array(
			'load-style-all-pages' => false,
		)
	);
	if ( $advancedSettings['load-style-all-pages'] == 'on' && ! is_admin() ) {
		wp_enqueue_style( 'spl-list-style' );
		wp_enqueue_style( 'spl-bootstrap-min' );
		// wp_enqueue_script( 'spl-bootstrap-min' );
		wp_enqueue_script( 'spl-pricelist-tabs' );

		wp_enqueue_style( 'font-awwsone' );
	}
}



function spl_js_css_enqueue_scripts_admin( $hook ) {
	$assets_url = SPL_URL . 'assets';
	$assets_path = SPL_DIR . '/assets';
	wp_register_script( 'spl-pricelist-admin-core', $assets_url . '/js/pricelist-admin-core.js', array( 'jquery' ), df_spl_get_file_version( $assets_path . '/js/pricelist-admin-core.js' ), true );
	wp_register_script( 'spl-pricelist-jquery-wookmark', $assets_url . '/js/jquery.wookmark.js', array( 'jquery' ), df_spl_get_file_version( $assets_path . '/js/jquery.wookmark.js' ), true );
	wp_register_script( 'spl-pricelist-admin', $assets_url . '/js/pricelist-admin.js', array( 'jquery', 'wp-color-picker' ), df_spl_get_file_version( $assets_path . '/js/pricelist-admin.js' ), true );
	wp_register_script( 'spl-pricelist-colorpicker', $assets_url . '/js/toolcool-color-picker.min.js', array( 'jquery' ), df_spl_get_file_version( $assets_path . '/js/toolcool-color-picker.min.js' ), true );
	wp_register_style( 'font-awwsone', $assets_url . '/font-awesome/css/font-awesome.min.css', array(), df_spl_get_file_version( $assets_path . '/font-awesome/css/font-awesome.min.css' ) );
	wp_register_style( 'spl-style-10', $assets_url . '/css/spl-style10.css', array(), df_spl_get_file_version( $assets_path . '/css/spl-style10.css' ) );
	wp_register_style( 'spl-style-6', $assets_url . '/css/spl-style6.css', array(), df_spl_get_file_version( $assets_path . '/css/spl-style6.css' ) );
	wp_register_style( 'spl-style-table-1', $assets_url . '/css/spl-style-table1.css', array(), df_spl_get_file_version( $assets_path . '/css/spl-style-table1.css' ) );
	wp_register_style( 'spl-style-table-2', $assets_url . '/css/spl-style-table2.css', array(), df_spl_get_file_version( $assets_path . '/css/spl-style-table2.css' ) );
	wp_register_script( 'spl-pricelist-tabs', $assets_url . '/js/tabs.js', array( 'jquery' ), df_spl_get_file_version( $assets_path . '/js/tabs.js' ), true );
	wp_register_script( 'spl-sortablejs', $assets_url . '/js/Sortable.min.js', array(), df_spl_get_file_version( $assets_path . '/js/Sortable.min.js' ), true );	
	wp_register_style( 'spl-tomselect', SPL_URL . 'assets/css/tom-select.bootstrap4.min.css', array(), df_spl_get_file_version( SPL_DIR . '/assets/css/tom-select.bootstrap4.min.css' ) );
	wp_register_script( 'spl-tomselect', SPL_URL . 'assets/js/tom-select.base.min.js', array(), df_spl_get_file_version( SPL_DIR . '/assets/js/tom-select.base.min.js' ), true );
	wp_register_script( 'spl-add-new-page', SPL_URL . 'assets/js/add-new-page.js', array(), df_spl_get_file_version( SPL_DIR . '/assets/js/add-new-page.js' ), true );
	wp_register_style( 'spl-add-new-page', SPL_URL . 'assets/css/add-new-page.css', array(), df_spl_get_file_version( SPL_DIR . 'assets/css/add-new-page.css' ) );
	wp_register_script( 'spl-no-ui-slider', SPL_URL . 'assets/js/nouislider.min.js', array(), df_spl_get_file_version( SPL_DIR . '/assets/js/nouislider.min.js' ), true );
	wp_register_style( 'spl-no-ui-slider', SPL_URL . 'assets/css/nouislider.css', array(), df_spl_get_file_version( SPL_DIR . 'assets/css/nouislider.css' ) );
	wp_enqueue_style( 'spl-tomselect' );
	wp_enqueue_script( 'spl-tomselect' );
	wp_localize_script(
		'spl-pricelist-admin',
		'SPL_admin_url',
		array( 'url' => admin_url())
	);
	
	wp_enqueue_media();
}

add_action( 'wp_enqueue_scripts', 'spl_js_css_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'spl_js_css_enqueue_scripts_admin' );

function add_stylesheet_admin_spl( $hook ) {
	$spl_pages = array(
		'stylish-price-list_page_stylish_price_list_video',
		'stylish-price-list_page_stylish_price_list_settings',
		'stylish-price-list_page_stylish_price_list_help',
		'stylish-price-list_page_spl-tabs-diagnostic',
		'admin_page_spl-tabs-new',
		'stylish-price-list_page_spl-assisted-new',
		'toplevel_page_spl-tabs',
		'stylish-price-list_page_stylish_price_list_license',
	);
	// call spl style to spl pages only
	if ( in_array( $hook, $spl_pages ) ) {
		$assets_url = SPL_URL . 'assets';
		$assets_path = SPL_DIR . '/assets';

		wp_enqueue_style( 'spl-bootstrap-min', $assets_url . '/lib/bootstrap-3.3.5/dist/css/stylish-price-list-style.min.css', array(), df_spl_get_file_version( $assets_path . '/lib/bootstrap-3.3.5/dist/css/stylish-price-list-style.min.css' ) );
		wp_enqueue_style( 'spl-list-style', $assets_url . '/css/frontend-style.css', array(), df_spl_get_file_version( $assets_path . '/css/frontend-style.css' ) );
		wp_enqueue_style( 'spl-admin-style', $assets_url . '/css/admin-style.css', array(), df_spl_get_file_version( $assets_path . '/css/admin-style.css' ) );
		wp_enqueue_style( 'spl-sweetalert', $assets_url . '/css/sweetalert2.min.css', array(), df_spl_get_file_version( $assets_path . '/css/sweetalert2.min.css' ) );
		wp_enqueue_script( 'spl-sweetalert', $assets_url . '/js/sweetalert2.all.js', array(), df_spl_get_file_version( $assets_path . '/js/sweetalert2.all.js' ) );
		wp_enqueue_style( 'spl-admin-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap' );

		// wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_script( 'jquery-ui-tooltip' );
		wp_enqueue_style( 'font-awwsone' );
	}
	if ( $hook == 'stylish-price-list_page_spl-assisted-new' ) {
		wp_enqueue_style( 'spl-admin-bs5', $assets_url . '/css/bootstrap.min.css', array(), df_spl_get_file_version( $assets_path . '/css/bootstrap.min.css' ) );
		wp_enqueue_script( 'spl-admin-bs5', $assets_url . '/js/bootstrap.bundle.min.js', array(), df_spl_get_file_version( $assets_path . '/js/bootstrap.bundle.min.js' ) );
	}
}
add_action( 'admin_enqueue_scripts', 'add_stylesheet_admin_spl' );
