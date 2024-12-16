<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class SPL_Cron {

	public $option = false;

	public function __construct() {
		add_action( 'spl_stats_event', array( $this, 'update_stats' ) );
		add_filter( 'cron_schedules', array( $this, 'add_three_day_cron_schedule' ) );
		$this->run_schedule();
	}

	private function run_schedule() {
		register_activation_hook( SPL_DIR . '/stylish-price-list.php', array( $this, 'schedule_cron_event' ) );
		register_deactivation_hook( SPL_DIR . '/stylish-price-list.php', array( $this, 'clear_scheduler' ) );
	}

	public function update_stats() {
		$response = $this->verify_lic_status();
	}

	/**
	 * Schedule daily sicense checker event
	 */
	public static function schedule_cron_event() {
		if ( ! wp_next_scheduled( 'spl_stats_event' ) ) {
			wp_schedule_event( time(), 'spl_once_every_three_day_schedule', 'spl_stats_event' );

			wp_schedule_single_event( time() + 20, 'spl_stats_event' );
		}
	}

	/**
	 * Clear any scheduled hook
	 */
	public function clear_scheduler() {
		wp_clear_scheduled_hook( 'spl_stats_event' );
	}

	public function get_option( $cache = true ) {

		if ( $this->option && $cache ) {
			return $this->option;
		}

		$option = get_option( 'df_spl_notifications', array() );

		$this->option = array(
			'update'    => ! empty( $option['update'] ) ? $option['update'] : 0,
			'feed'      => ! empty( $option['feed'] ) ? $option['feed'] : array(),
			'dismissed' => ! empty( $option['dismissed'] ) ? $option['dismissed'] : array(),
		);

		return $this->option;
	}


	private function verify_lic_status() {
		require SPL_DIR . '/license-settings.php';
		$opt      = $this->get_prev_schedule_data();
		if ( empty( $opt ) ) {
			return;
		}
		$key     = get_option( 'stylishpl_license_key' );
		$item_id = df_spl_get_item_id_by_license_key( $key );
		if ( $opt['item_id'] ) {
			$item_id = $opt['item_id'];
		}

		$new_api_params = array(
			'edd_action' => 'check_license',
			'license'    => $key,
			'item_id'    => $item_id,
			'url'        => home_url(),
		);

		// Send query to the license manager server
		$query    = esc_url_raw( add_query_arg( $new_api_params, SPL_LICENSE_SERVER_URL ) );
		$response = wp_remote_get(
			$query,
			array(
				'timeout' => 20,
			)
		);
		if ( is_wp_error( $response ) ) {
			return 0;
		}
		$this->verify( $response );
	}

	public function verify( $response ) {
		$current_license = $this->get_prev_schedule_data();
		$scheduled_action_data = json_decode( wp_remote_retrieve_body( $response ) );
		$log_file = wp_upload_dir()['basedir'] . '/spl-logs/spl-shceduled-action.log';
        // clean up the log file
        spl_limit_log_entries( $log_file, 50 );
		error_log( 'INFO: ' . date( 'Y-m-d H:i:s' ) . ' - ' . $scheduled_action_data->item_id . ' - ' . $scheduled_action_data->license . "\n", 3, $log_file );
		if ( $current_license['license'] !== $scheduled_action_data->license ) {
			if ( $scheduled_action_data->license !== 'valid' ) {
				if ( $scheduled_action_data->license == 'expired' ) {
					$exp   = strtotime( $scheduled_action_data->expires );
					$grace = $exp + DAY_IN_SECONDS;
					// $grace = $exp;
					if ( time() > $grace ) {
						$this->update_scheduled_action_data( $scheduled_action_data );
						return 'not valid';
					}
				} else {
					$this->update_scheduled_action_data( $scheduled_action_data );
				}
			}
			if ( $scheduled_action_data->license == 'valid' ) {
				$this->update_scheduled_action_data( $scheduled_action_data );
			}
		}
		return 'valid';
	}

	public function get_prev_schedule_data() {
		return get_option( 'spllk_opt' );
	}

	public function extra_meta( $validation ) {
		if ( $validation == 'success' ) {
			return array(
				'result'                   => $validation,
				'google_fonts_preview_out' => 'google_fonts_preview',
				'html_out'                 => 'select_html',
				'get_fonts_options'        => 'get_fonts_options',
				'max_list_count'           => 999,
				'max_cat_count'            => 999,
				'max_service_count'        => 999,
			);
		}
		return array(
			'result' => 'failed',
		);
	}

	public function update_scheduled_action_data( $data ) {
		$opt        = get_object_vars( $data );
		$extra_meta = $this->extra_meta( $data->license == 'valid' ? 'success' : 'failed' );
		$opt        = array_merge( $extra_meta, $opt );
		update_option( 'spllk_opt', $opt );
	}

	public function add_three_day_cron_schedule( $schedules ) {

		$schedules['spl_once_every_three_day_schedule'] = array(
			'interval' => 3 * DAY_IN_SECONDS,
			'display'  => esc_html( 'Once every three days' ),
		);

		return $schedules;
	}
}

new SPL_Cron();
