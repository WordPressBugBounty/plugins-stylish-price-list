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
	const MAX_INPUT_VARS_BUFFER = 25;

	/**
	 * Normalize price-like text after generic cleaning so currency symbols remain intact.
	 *
	 * @param mixed $value Raw cleaned field value.
	 * @return string
	 */
	private function normalize_price_field( $value ) {
		if ( ! is_scalar( $value ) ) {
			return '';
		}

		return html_entity_decode( wp_unslash( (string) $value ), ENT_QUOTES | ENT_HTML5, 'UTF-8' );
	}

	/**
	 * Safely trim text even when the mbstring extension is unavailable.
	 *
	 * @param mixed $value Raw field value.
	 * @param int   $length Maximum character length.
	 * @return string
	 */
	private function limit_text_field( $value, $length ) {
		if ( ! is_scalar( $value ) ) {
			return '';
		}

		$value = (string) $value;

		if ( function_exists( 'mb_substr' ) ) {
			return mb_substr( $value, 0, $length );
		}

		return substr( $value, 0, $length );
	}

	/**
	 * Count posted input variables recursively to avoid saving truncated large forms.
	 *
	 * @param mixed $value Posted value.
	 * @return int
	 */
	private function count_input_vars( $value ) {
		if ( ! is_array( $value ) ) {
			return 1;
		}

		$count = 0;
		foreach ( $value as $child_value ) {
			$count += $this->count_input_vars( $child_value );
		}

		return $count;
	}

	/**
	 * Determine whether the submitted POST is close enough to max_input_vars to risk truncation.
	 *
	 * @return bool
	 */
	private function is_max_input_vars_limit_reached() {
		$max_input_vars = absint( ini_get( 'max_input_vars' ) );

		if ( ! $max_input_vars ) {
			return false;
		}

		$posted_vars = $this->count_input_vars( $_POST );
		$threshold   = max( 1, $max_input_vars - self::MAX_INPUT_VARS_BUFFER );

		return $posted_vars >= $threshold;
	}

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
			wp_die(
				esc_html__(
					'Error: This editor page has expired or was served from cache. Please reload the editor and try saving again. If this keeps happening, exclude Stylish Price List admin pages from Wordfence or other page caching/security plugins.',
					'spl'
				)
			);
		}
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'Error: Permission Denied! Current user cannot manage options.', 'spl' ) );
		}
		$errors   = array();
		$field_id = isset( $_POST['field_id'] ) ? intval( $_POST['field_id'] ) : '';
		$page_url = admin_url( 'admin.php?page=spl-tabs&action=edit&id=' . $field_id );
		if ( $this->is_max_input_vars_limit_reached() ) {
			$errors[] = __( 'Your price list is too large for the current PHP max_input_vars setting. Increase max_input_vars before saving to prevent data loss.', 'spl' );
		}
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
			unset( $_POST['spl_nonce'] );
			unset( $_POST['submit_tabs'] );
			$fields     = df_spl_clean( $_POST );
			if ( ! isset( $fields['list_name'] ) ) {
				$fields['list_name'] = '';
			}
			$fields['list_name'] = $this->limit_text_field( $fields['list_name'], 100 );
			if ( isset( $fields['category'] ) && is_array( $fields['category'] ) ) {
				foreach ( $fields['category'] as $cat_id => $cat_data ) {
					if ( isset( $cat_data['name'] ) ) {
						$fields['category'][ $cat_id ]['name'] = $this->limit_text_field( $cat_data['name'], 60 );
					}
					if ( isset( $cat_data['description'] ) ) {
						$fields['category'][ $cat_id ]['description'] = $this->limit_text_field( $cat_data['description'], 500 );
					}
					if ( isset( $cat_data['price'] ) ) {
						$fields['category'][ $cat_id ]['price'] = $this->limit_text_field( $this->normalize_price_field( $cat_data['price'] ), 30 );
					}
					foreach ( $cat_data as $service_id => $service_data ) {
						if ( ! is_array( $service_data ) ) {
							continue; // skip category-level properties
						}
						foreach ( $service_data as $service_key => $service_value ) {
							if ( ! is_scalar( $service_value ) ) {
								continue;
							}
							// Limit user input on the server side
							if ( in_array( $service_key, array( 'service_price', 'service_regular_price', 'settings_compare_at' ), true ) ) {
								$fields['category'][ $cat_id ][ $service_id ][ $service_key ] = $this->limit_text_field( $this->normalize_price_field( $service_value ), 30 );
							} elseif ( $service_key === 'service_desc' ) {
								$fields['category'][ $cat_id ][ $service_id ][ $service_key ] = $this->limit_text_field( $service_value, 1000 );
							} elseif ( $service_key === 'service_long_description' ) {
								continue; // intentionally unlimited to match UI
							} else {
								$fields['category'][ $cat_id ][ $service_id ][ $service_key ] = $this->limit_text_field( $service_value, 100 );
							}
						}
					}
				}
			}
			$save_count = get_option( 'spl_save_count' );
		if ( ! $save_count ) {
			update_option( 'spl_save_count', 1 );
		} else {
			update_option( 'spl_save_count', $save_count + 1 );
		}
		
		// Manually process and save the extra settings since this is a custom form handler
	    // Ensure 'load-style-all-pages' is updated properly from the form POST data
		$extraSettings['load-style-all-pages'] = (isset( $_POST['load-style-all-pages'] )) ? 'on' : null;
		update_option( 'spl_extra_settings', $extraSettings );
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
