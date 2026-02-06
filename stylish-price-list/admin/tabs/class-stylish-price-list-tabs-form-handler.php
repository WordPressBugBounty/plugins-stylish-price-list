<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Handle the form submissions
 *
 * @package Package
 * @subpackage Sub Package
 */
/**
* Hook 'em all
*/
class Stylish_Price_List_Tabs_Form_Handler {
	public function __construct() {
		add_action( 'admin_init', array( $this, 'handle_form' ) );
		// add_action( 'load-toplevel_page_spl-tabs-new', array( $this, 'handle_form' ) );
	}
	/**
	 Handle the tabs new and edit form

	 @return void
*/
	public function handle_form() {
		if ( ! isset( $_POST['submit_tabs'] ) ) {
			return;
		}
		if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ), 'spl_nonce' ) ) {
			die( __( 'Error: WP Verify Nonce error. Try to log out of WP and log back in, clear your cache. Try to disable Word Fence or any security pluigin. If the problem persist, please contact support at https://stylishpricelist.com/support/', 'spl' ) );
		}
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'Error: Permission Denied! Current user cannot manage options.', 'spl' ) );
		}
		$errors   = array();
		$field_id = isset( $_POST['field_id'] ) ? intval( $_POST['field_id'] ) : '';
		$page_url = admin_url( 'admin.php?page=spl-tabs&action=edit&id=' . $field_id );
		if ( $errors ) {
			$first_error = reset( $errors );
			$redirect_to = add_query_arg( array( 'error' => urlencode( $first_error ) ), $page_url );
			wp_safe_redirect( $redirect_to );
			exit;
		}
		if ( isset( $_POST['category'] ) && is_array( $_POST['category'] ) ) {
			unset( $_POST['category'][0] );
		}
		unset( $_POST['_wpnonce'] );
		unset( $_POST['_wp_http_referer'] );
		$fields     = df_spl_clean( $_POST );
		$save_count = get_option( 'spl_save_count' );
		if ( ! $save_count ) {
			update_option( 'spl_save_count', 1 );
		} else {
			update_option( 'spl_save_count', $save_count + 1 );
		}
		if ( ! $field_id ) {
			$insert_id = df_spl_insert_tabs( $fields );
			$page_url  = admin_url( 'admin.php?page=spl-tabs&action=edit&id=' . $insert_id );
		} else {
			$fields['id'] = $field_id;
			$insert_id    = df_spl_insert_tabs( $fields );
		}
		if ( is_wp_error( $insert_id ) ) {
			$redirect_to = add_query_arg(
				array( 'error' => urlencode( $insert_id->get_error_message() ) ),
				$page_url
			);
		} else {
			$redirect_to = add_query_arg(
				array( 'success' => urlencode( __( 'Succesfully saved!', 'spl' ) ) ),
				$page_url
			);
		}
		wp_safe_redirect( $redirect_to );
		exit;
	}
}
new Stylish_Price_List_Tabs_Form_Handler();
// add_action('wp_ajax_nopriv_spl_upload_ser_img', 'spl_upload_ser_img');
add_action( 'wp_ajax_spl_upload_ser_img', 'df_spl_upload_ser_img' );
function df_spl_upload_ser_img() {
	$file = $_FILES['file'];
	if ( ! file_is_valid_image( $file['tmp_name'] ) ) {
		return;
	};
	check_ajax_referer( 'spl_upload_ser_img', 'security' );
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error();
	}
	require_once ABSPATH . 'wp-admin/includes/file.php';
	$file_return = wp_handle_upload( $file, array( 'test_form' => false ) );
	$filename    = $file_return['url'];
	echo esc_url( trim( $filename ) );
	exit;
}
