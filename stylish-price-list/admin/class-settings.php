<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Stylish_Price_List_Settings {
	private $license_return;
	public function __construct() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 90 );
		$this->license_return = get_option( 'spl_license_return' );
	}
	function admin_init() {
		register_setting( 'stylishpl_options', 'stylishpl_license_key', array( $this, 'process_key' ) );
		register_setting( 'stylishpl_extra_settings', 'spl_extra_settings', array( $this, 'process_settings' ) );
		// register_setting('stylishpl_options','stylishpl_license_key');
	}
	function process_key( $key ) {
		// phpcs:ignore
		if ( isset( $_REQUEST['df-spl-activate'] ) ) {
			$license_return = $this->activate( $key );
			// phpcs:ignore
		} elseif ( isset( $_REQUEST['df-spl-deactivate'] ) ) {
			$license_return = $this->deactivate( $key );
		}
		update_option( 'spl_license_return', $license_return );
		return $key;
	}
	function process_settings() {
		// phpcs:ignore
		$extraSettings = array( 'load-style-all-pages' => isset( $_POST['load-style-all-pages'] ) ? 'on' : null );
		return $extraSettings;
	}
	function checkbox( $name, $options = array(), $current_value_arr = array() ) {
		ob_start();
		?>
		<div class="checkbox">
			<?php
			foreach ( $options as $value => $label ) :
				$checked = '';
				if ( in_array( $value, $current_value_arr ) != false ) {//find the value
					$checked = ' checked="checked"';
				}
				?>
		<label>
			<input name="<?php echo esc_attr($name) . '[]'; ?>" type="checkbox" value="<?php echo esc_attr($value); ?>" <?php echo esc_attr($checked); ?>>
				<?php echo esc_attr($label); ?>
		</label>
	<?php endforeach ?>
</div>
		<?php
		$html = ob_get_clean();
		return $html;
	}
	function select( $name, $options = array(), $current_value = '' ) {
		ob_start();
		?>
	<select name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" class="form-control">
		<?php
		foreach ( $options as $value => $label ) :
			$selected = '';
			if ( $current_value == $value ) {
				$selected = ' selected="selected"';
			}
			?>
			<option value="<?php echo esc_attr($value); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_attr($label); ?></option>
		<?php endforeach ?>
	</select>
		<?php
		$html = ob_get_clean();
		return $html;
	}
	function option_page() {
		// ob_start();
		echo '<div class="price_wrapper">';
		include_once SPL_DIR . '/admin/tabs/views/tabs-form/logo-header.php';
		echo '</div>';
		$stylishpl_license_key = get_option( 'stylishpl_license_key' );
		$icon_class            = 'dashicons-no';
		$icon_style            = 'color:red;';
		$opt                   = get_option( 'spllk_opt' );
		if ( ! empty( $opt ) && $opt['result'] == 'success' ) {
			$icon_class = 'dashicons-yes';
			$icon_style = 'color:green;';
		}
		// phpcs:ignore
		if ( isset( $_GET['settings-updated'] ) && ! empty( $opt ) ) {
			?>
		<div id="message" class="updated">
			<p><strong><?php esc_html_e( 'Settings saved.' ); ?></strong></p>
		</div>
		<?php } ?>
	<script>
		function handleLicenseActivation(event, $form) {
			const devEnvWarningText = `please remember to deactivate the license (and backup your Price List) before migrating to another domain.`;
			event.preventDefault();
			let domain = window.location.host;
			let detectLocalDevEnv = (domain) => {
				if (domain.match('.test') || domain.match('localhost') || domain.match('127.0.0.1')) {
					return true;
				}
				return false;
			}
			function doSubmitLicense() {
				const XHR = new XMLHttpRequest();
				if (event.submitter) {
					XHR.open( "POST", "<?php echo esc_url(admin_url( 'options.php' )); ?>" );
					let licFormData = new FormData($form);
					licFormData.append(event.submitter.name, event.submitter.value);
					XHR.addEventListener( 'load', function( event ) {
						window.location.reload();
					} );
					document.body.style.cursor='wait';
					XHR.send( licFormData );
				}
			}
			if (detectLocalDevEnv(domain) && event.submitter.value == "Activate") {
				Swal.fire({
						title: 'Development Website Detected',
						text: devEnvWarningText,
						icon: 'warning',
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'Okay!'
					}).then(result => {
						if (result.isConfirmed) {
							doSubmitLicense();
						}
					});
			} else {
				doSubmitLicense();
			}
		}
	</script>
	<style>
		body{font-family: 'Lato', sans-serif;font-weight: 400;-webkit-font-smoothing: antialiased;text-rendering: optimizeLegibility;}
	</style>
  <h3 style="text-decoration: underline;padding: 15px 5px 15px 5px;font-size: 26px;font-weight: 900;margin: 50px 0px 10px;border-radius: 5px;color: #5bb3a7;">Advance Settings</h3>
  <div class="wrap">
	  <form action="options.php" method="post">
			<?php
			$settings = get_option(
				'spl_extra_settings',
				array(
					'load-style-all-pages' => false,
				)
			);
			settings_fields( 'stylishpl_extra_settings' );
			?>
		<input type="checkbox" name="load-style-all-pages" id="load-style-all-pages" 
		<?php
		if ( $settings['load-style-all-pages'] == 'on' ) {
			echo 'checked';}
		?>
		 style="vertical-align: bottom;">
		<label for="load-style-all-pages">Load CSS on all pages</label>
		<p>
		<input type="submit" style="height:30px;width:100px;border-radius: 6px;border: 0;color: #fff;font-size: 14px;font-weight: 600;text-decoration: none;cursor: pointer;margin-right: 10px;outline: none;-webkit-transition: all 0.3s ease;transition: all 0.3s ease;-webkit-box-shadow: 0 0 0 rgba(0, 0, 0, 0.16);box-shadow: 0 0 0 rgba(0, 0, 0, 0.16);" value="Save" class="spl_btn_primary button button-primary">
		</p>
	  </form>
  </div>
		<?php
		// $html_1 = ob_get_clean();
		// // phpcs:ignore
		// echo $html_1;
	}
	function include_license_settings() {
		$license_settings = SPL_DIR . '/license-settings.php';
		if ( file_exists( $license_settings ) ) {
			require_once $license_settings;
			return true;
		} else {
			return 'cannot find the license-settings.php file in folder ' . SPL_DIR;
		}
	}
	function update_opt( $opt ) {
		update_option( 'spllk_opt', $opt );
	}
	function activate( $key ) {
		ob_start();
		if ( ! empty( $key ) ) {
			$license_data = $this->get_license_data( $key, 'slm_activate' );
			// if ( isset( $license_data->result ) ) {
			// 	if ( $license_data->result == 'success' ) {//Success was returned for the license activation
			// 		// update_option('sample_license_key', '');
			// 		$opt = get_object_vars( $license_data );
			// 		// ob_start();
			// 		// print_r($opt);
			// 		// $data=ob_get_clean();
			// 		// file_put_contents(dirname(__FILE__) . '/opt.log',$data,FILE_APPEND);
			// 		$this->update_opt( $opt );
			// 		return true;
			// 	}
			// 	if ( $license_data->result == 'error' ) {
			// 		$message = "Your license has reached the maximum amount of domains. Please note, this error message might appear by accident if you pressed the enter button twice, in this case you can just ignore this error message. If there's a green check-mark beside your serial that means your pro version has been activated. If you're moving domains, then just de-activate your license on your first domain before activating SPL on another domain.";
			// 		//Uncomment the followng line to see the message that returned from the license server
			// 		// return $license_data->message;
			// 		//return '<p style="color:red;"> Error: '.$license_data->message . '</p>';
			// 		return '<p style="color:red;"> Error: ' . $message . '</p>';
			// 	}
			// } else {
			// 	return $license_data;
			// }
			if ( isset( $license_data->license ) ) {
				if ( $license_data->license == 'valid' ) {//Success was returned for the license activation
					// update_option('sample_license_key', '');
					$opt = get_object_vars( $license_data );
					$opt['result']                   = 'success';
					$opt['google_fonts_preview_out'] = 'google_fonts_preview';
					$opt['html_out']                 = 'select_html';
					$opt['get_fonts_options']        = 'get_fonts_options';
					$opt['max_list_count']           = 999;
					$opt['max_cat_count']            = 999;
					$opt['max_service_count']        = 999;
					// ob_start();
					// print_r($opt);
					// $data=ob_get_clean();
					// file_put_contents(dirname(__FILE__) . '/opt.log',$data,FILE_APPEND);
					$this->update_opt( $opt );
					// require SPL_DIR . '/cron/statistics.php';
					SPL_Cron::schedule_cron_event();
					return true;
				}
				if ( $license_data->license !== 'valid' ) {
					// $message = "Your license has reached the maximum amount of domains. Please note, this error message might appear by accident if you pressed the enter button twice, in this case you can just ignore this error message. If there's a green check-mark beside your serial that means your pro version has been activated. If you're moving domains, then just de-activate your license on your first domain before activating SPL on another domain.";
					$message = '';
					$this->update_opt( '' );
					//Uncomment the followng line to see the message that returned from the license server
					// return $license_data->message;
					//return '<p style="color:red;"> Error: '.$license_data->message . '</p>';
					return '<p style="color:red;"> Error: ' . $message . '</p>';
				}
			} else {
				return $license_data;
			}
		} else {
			$this->update_opt( '' );
			return 'The license key is empty';
		}
	}
	function deactivate( $key ) {
		if ( ! empty( $key ) ) {
			$license_data = $this->get_license_data( $key, 'slm_deactivate' );
			// if ( isset( $license_data->result ) ) {
			// 	if ( $license_data->result == 'success' ) {//Success was returned for the license activation
			// 		// update_option('sample_license_key', '');
			// 		$this->update_opt( '' );
			// 		return true;
			// 	} else {
			// 		//Uncomment the followng line to see the message that returned from the license server
			// 		// return $license_data->message;
			// 		return '<p style="color:red;"> Error: ' . $license_data->message . '</p>';
			// 	}
			// } else {
			// 	return $license_data;
			// }
			if ( isset( $license_data->license ) ) {
				if ( $license_data->license == 'deactivated' ) {//Success was returned for the license activation
					// update_option('sample_license_key', '');
					$this->update_opt( '' );
					return true;
				} else {
					//Uncomment the followng line to see the message that returned from the license server
					// return $license_data->message;
					return '<p style="color:red;"> Error: ' . $license_data->message . '</p>';
				}
			} else {
				return $license_data;
			}
		} else {
			$this->update_opt( '' );
			return 'The license key is empty';
		}
	}
	function get_license_data( $key, $action ) {
		$include_license = $this->include_license_settings();
		if ( $include_license !== true ) {
			return $include_license;
		}
		// API query parameters
		$api_params = array(
			'slm_action'        => $action,
			'secret_key'        => SPL_SPECIAL_SECRET_KEY,
			'license_key'       => $key,
			'registered_domain' => $_SERVER['SERVER_NAME'],
			'item_reference'    => urlencode( SPL_ITEM_REFERENCE ),
		);
		$new_api_params = array(
			'edd_action'      => $action == 'slm_activate' ? 'activate_license' : 'deactivate_license',
			'license'         => $key,
			'item_id'         => df_spl_get_item_id_by_license_key( $key ),
			'url'             => home_url(),
		);
		// Send query to the license manager server
		$query    = esc_url_raw( add_query_arg( $new_api_params, SPL_LICENSE_SERVER_URL ) );
		$response = wp_remote_get(
			$query,
			array(
				'timeout'   => 20,
				'sslverify' => false,
			)
		);
		// Check for error in the response
		if ( is_wp_error( $response ) ) {
			update_option( 'act_ser_conn_refused', 'connection refused' );
			return 'Unexpected Error! The query returned with an error.';
		}
		//var_dump($response);//uncomment it if you want to look at the full response
		// License data.
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		return $license_data;
	}
	//Add Help Content //
	function help_page() {
		// wp_enqueue_script( 'spl-bootstrap-min' );
		?>
	<div class="price_wrapper">
		<?php
		include_once SPL_DIR . '/admin/tabs/views/tabs-form/logo-header.php';
		?>
	</div>
	<style>
	 .panel-group .panel {
	  border: 2px black;
	  border-radius: 10px!important;
	  background-color: #F8F8F8;
	  padding: 10px;
	  margin-left: 25px;
	  margin-bottom: 20px!important;
	  max-width: 700px;
	  box-shadow: 1px 1px 5px gray;
  }
</style>
<h1 style="margin-top:100px;background:#f9f9f9;padding-left:25px;padding-bottom:25px;padding-top:25px;font-weight:600px;font-size:35px;font-weight: bold;">Help &amp; F.A.Q's</h1>
<div class="foot-url" style="font-size:24px;margin-top:20px">
	<span class="col-me"><a href="https://designful.freshdesk.com/en/support/solutions/folders/48000670844" target="_blank" style="text-decoration: none!important;">User Guides</a></span>
	<span> | </span>
	<span class="col-me" ><a style="text-decoration: none!important;" href="https://designful.freshdesk.com/en/support/solutions/folders/48000670795" target="_blank">FAQs</a></span>
	<span> | </span>
	<span><a href="https://stylishpricelist.com/support/" target="_blank" style="text-decoration: none!important;">Contact Support</a></span>
</div>
<!-- Question end -->
</div>
</div>
		<?php
	}
	// End Help Content
	// Start Video Content
	function video_page() {
		echo '<div class="price_wrapper">';
		include_once SPL_DIR . '/admin/tabs/views/tabs-form/logo-header.php';
		?>
	</div>
	<h1 style="padding-left:25px;padding-bottom:50px;padding-top:30px;font-weight:800px;">Video Tutorials </h1>
	<div class="youtube_video" style="padding-left:10px;">
	 <iframe width="920" height="520" loading="lazy" src="https://www.youtube.com/embed/tq8SE1HC7g0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
 </div><br><Br>
 <div class="youtube_video" style="padding-left:10px;">
	 <iframe width="920" loading="lazy" height="520" src="https://www.youtube.com/embed/dwICOx4Jhv4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br><br>
 </div><br><Br>
 <div class="youtube_video" style="padding-left:10px;">
	 <iframe width="920" loading="lazy" height="520" src="https://www.youtube.com/embed/zB6kz2nKxoI/?rel=0" frameborder="0" allowfullscreen></iframe>
 </div>
		<?php
	}
	function admin_menu() {
		// add_management_page('Stylish Price List','Stylish Price List', 'manage_options', 'stylish_price_list_settings', array($this,'option_page'));
		add_submenu_page( 'spl-tabs', __( 'Help', 'stylishpl' ), __( 'Help', 'stylishpl' ), 'manage_options', 'stylish_price_list_help', array( $this, 'help_page' ) );
		add_submenu_page( 'spl-tabs', __( 'Video Tutorials', 'stylishpl' ), __( 'Video Tutorials', 'stylishpl' ), 'manage_options', 'stylish_price_list_video', array( $this, 'video_page' ) );
		add_submenu_page( 'spl-tabs', __( 'Settings', 'stylishpl' ), __( 'Settings', 'stylishpl' ), 'manage_options', 'stylish_price_list_settings', array( $this, 'option_page' ) );
		add_submenu_page( 'spl-tabs', __( 'License', 'stylishpl' ), __( 'License', 'stylishpl' ), 'manage_options', 'stylish_price_list_license', array( new SPL_LicensePage(), 'page' ) );
	}
}
$stylish_price_list_settings = new Stylish_Price_List_Settings();
?>
