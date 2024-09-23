<?php

class SPL_LicensePage {

	private $error;
	private $success;
	private $option_key;
	private $spl_icons;

	public function __construct() {
		$a          = join(
			'',
			array_map(
				function ( $d ) {
					return hex2bin( $d );
				},
				array( '6f', '70', '74', '69', '6f', '6e', '5f', '6b', '65', '79' )
			)
		);
		$b          = join(
			'',
			array_map(
				function ( $d ) {
					return hex2bin( $d );
				},
				array( '6f', '70', '74', '69', '6f', '6e', '32' )
			)
		);
		$c          = join(
			'',
			array_map(
				function ( $d ) {
					return hex2bin( $d );
				},
				array( '6f', '70', '74', '69', '6f', '6e', '33' )
			)
		);
		$this->a2   = join(
			'',
			array_map(
				function ( $d ) {
					return hex2bin( $d );
				},
				array( '6c', '69', '63', '65', '6e', '73', '65' )
			)
		);
		$this->{$a} = join(
			'',
			array_map(
				function ( $d ) {
					return hex2bin( $d );
				},
				array( '61', '70', '70', '73', '65', '72', '6f', '5f', '39', '35', '62', '33', '65', '34', '61', '32', '34', '34', '34', '39', '35', '61', '62', '32', '63', '61', '66', '38', '38', '31', '66', '37', '62', '35', '62', '32', '66', '30', '33', '61', '5f', '6d', '61', '6e', '61', '67', '65', '5f', '6c', '69', '63', '65', '6e', '73', '65' )
			)
		);
		$this->{$b} = join(
			'',
			array_map(
				function ( $d ) {
					return hex2bin( $d );
				},
				array( '64', '66', '5f', '73', '63', '63', '6c', '6b', '5f', '6f', '70', '74' )
			)
		);
		$this->{$c} = join(
			'',
			array_map(
				function ( $d ) {
					return hex2bin( $d );
				},
				array( '64', '66', '5f', '73', '63', '63', '5f', '6c', '69', '63', '65', '6e', '73', '65', '64' )
			)
		);
		// $this->spl_icons = require SCC_DIR . '/assets/spl_icons/icon_rsrc.php';
		// $this->page();
		// $this->page_style();
		// $this->page_script();
	}

	private static function get_action_url() {
		$url = add_query_arg(
			$_GET,
			admin_url( basename( $_SERVER['SCRIPT_NAME'] ) )
		);

		echo esc_url( $url );
	}

	private function get_lic_status() {
		return get_option( 'stylishpl_license_key', '' );
	}

	private function get_license_data( $key, $action ) {
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
				'blocking'  => true,
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


	function update_opt( $opt ) {
		update_option( 'spllk_opt', $opt );
	}
	function activate( $form ) {
		$form = wp_parse_args($form, array(
			"license_key" => "",
			"_action" => "active",
			"submit" => "submit",
			"_nonce" => ""
		));
		$key = trim( $form['license_key'] );
		ob_start();
		if ( ! empty( $key ) ) {
			update_option( 'stylishpl_license_key', $key );
			$license_data = $this->get_license_data( $key, 'slm_activate' );
			if ( isset( $license_data->license ) ) {
				if ( $license_data->license == 'valid' ) {//Success was returned for the license activation
					// update_option('sample_license_key', '');
					$opt = get_object_vars( $license_data );
					$opt['result']                   = 'success';
					$opt['google_fonts_preview_out'] = 'google_fonts_preview';
					$opt['html_out']                 = 'select_html';
					$opt['get_fonts_options']        = 'get_fonts_options';
					// $opt['license']                  = $key;
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
					// $this->update_opt( '' );
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
			if ( isset( $license_data->license ) ) {
				if ( $license_data->license == 'deactivated' ) {//Success was returned for the license activation
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

	// private function

	public function page() {

		if ( isset( $_POST['license_key'] ) ) {
			if ( ! wp_verify_nonce( $_POST['_nonce'], 'spl-license' ) ) {
				$this->error = ( "You don't have permission to manage license." );

				return;
			}
			$res = false;

			switch ( $_POST['_action'] ) {
				case 'active':
					$res = $this->active_client_license( $_POST );
					break;

				case 'deactivate':
					$res = $this->deactive_client_license( $_POST );
					break;

				case 'refresh':
					$res = $this->refresh_client_license( $_POST );
					break;
			}
		}
		wp_enqueue_style( 'spl-jquery-ui', SPL_URL . 'assets/css/jquery-ui.css', array(), '1.1' );
		self::page_script();
		self::page_style();
		$stylishpl_license_key = get_option( 'stylishpl_license_key' );
		$opt                   = get_option( 'spllk_opt' );
		$license = ['status' => 'activate', 'expiry_days' => 301];
		$action  = empty( $opt ) || $opt['license'] !== 'valid' ? 'active' : 'deactivate';
		echo '<div class="price_wrapper">';
		include_once SPL_DIR . '/admin/tabs/views/tabs-form/logo-header.php';
		echo '</div>';
		?>
		<div id="license-page-wrapper" class="container-fluid my-5">
			<h1 class="display-6 fw-bold lh-1 mb-3">License Settings</h1>
			<?php
			if ( ! empty( $this->error ) ) {
				?>
				<div class="notice notice-error is-dismissible m-0 bg-white rounded">
					<p><?php echo wp_kses_post( $this->error ); ?></p>
				</div>
				<?php
			}

			if ( ! empty( $this->success ) ) {
				?>
					<div class="notice notice-success is-dismissible m-0">
						<p><?php echo wp_kses_post( $this->success ); ?></p>
					</div>
				<?php
			}
				echo '<br />';
			?>
			<div class="row license-page-wrapper">
				<div class="col-md-8">
					<div class="p-5 bg-white rounded">
						<div class="text-center">
							<div class="scc-license-intro-hero w-50 mx-auto">
								<?php if ( $action == 'active' ) { ?>
									<div class="lead fw-bold">Do you have a License Key</div>
									<p>Activate Stylish Cost Calculator Premium and start selling faster today!</p>
								<?php } ?>
								<?php if ( $action == 'deactivate' ) { ?>
									<div class="lead fw-bold mb-3">Your License key has been activated</div>
								<?php } ?>
							</div>
							<div class="input-group flex-nowrap mb-3 license-input-wrapper">
								<span class="input-group-text scc-icn-wrapper"><i class="fa fa-key"></i></span>
								<input id="license_input" type="text" class="form-control"  value="<?php echo esc_attr($stylishpl_license_key); ?>"
									placeholder="<?php echo esc_attr( ( 'Enter your license key to activate' ) ); ?>" 
									<?php echo ( 'deactivate' == $action ) ? 'readonly="readonly"' : ''; ?>>
								<form method="post" class="license-right-form" novalidate="novalidate" spellcheck="false">
									<input type="hidden" name="_action" value="refresh">
									<input type="hidden" name="_nonce" value="<?php echo wp_create_nonce( 'spl-license' ); ?>">
									<input type="hidden" name="license_key" value="<?php echo get_option( 'stylishpl_license_key', '' ); ?>">
								</form>
								<button title="Use this button to sync the license status with the server." name="submit" data-action="refresh" onclick="handleLicenseBtn( this, event )" class="btn btn-outline-secondary d-flex m-auto">
										<span class="dashicons dashicons-update"></span>
										<i class="d-none gg-spinner-alt"></i>
										Refresh License </button>
							</div>
							<?php if ( $action == 'active' ): ?>
								<button class="btn btn-primary mb-3 d-flex m-auto" data-action="active" onclick="handleLicenseBtn( this, event )" type="button"><i class="d-none gg-spinner-alt"></i><span>Activate License</span></button>
							<?php endif; ?>
							<?php if ( $action == 'deactivate' ): ?>
								<button class="btn btn-primary mb-3 d-flex m-auto" data-action="deactivate" onclick="handleLicenseBtn( this, event )" type="button"><i class="d-none gg-spinner-alt"></i><span>Deactivate License</span></button>
							<?php endif; ?>
						</div>
						<div class="d-flex justify-content-between">
						<?php if ( $license['status'] !== 'deactivate' ) : ?>
							<?php $show_license_expiry_message = isset( $opt['expires'] ) && $opt['expires'] != 'lifetime'; ?>
							<div class="activation-text">
								<!-- <p class="mb-0">Activations remaining</p> -->
								<?php if ( ! empty( $opt ) && in_array( $opt['license'] , array( 'valid', 'expired' ) ) ): ?>
									<?php if ( $opt['license'] == "expired" ): ?>
										<p class="mb-0" style="color: red;">The license has been expired.</p>
									<?php endif; ?>
									<?php if ( $show_license_expiry_message ) : ?>
										<p class="mb-0">The license expires on <?php echo esc_attr( gmdate( "jS \of F Y" , strtotime( $opt['expires'] ) ) ) ?></p>
									<?php endif; ?>
									<?php if ( isset( $opt['license_limit'] ) && isset( $opt['site_count'] ) ): ?>
										<p class="mb-0 <?php echo $show_license_expiry_message ? '' : 'mt-3'; ?>">The license key is being used on <?php echo ( intval( $opt['site_count'] ) > 1 ) ? intval( $opt['site_count'] ) . ' sites' : intval( $opt['site_count'] ) . ' site'; ?> out of <?php echo intval( $opt['license_limit'] ); ?> allowed.</p>
									<?php endif; ?>
								<?php endif; ?>
							</div>
							<div class="expiration-text">
							</div>
						<?php endif; ?>
						</div>
					</div>
				</div>
				<?php echo self::fragment_license_key_management_tips($action == 'deactivate'); ?>
			</div>
		</div>
		<?php
	}
	private static function fragment_license_key_management_tips($is_activated) {
		?>
			<?php if ( $is_activated ): ?>
			<div class="col-md-4">
				<div class="px-3 py-5 bg-white rounded">
					<div class="text-center">
						<div class="lead fw-bold">Are you on a development site / want to use the license key in another website?</div>
					</div>
					<p class="my-4">The license keys can only be used on a limited number of WordPress websites. If you want to use the license key on another website, you have to deactivate it first.</p>
					<ul class="p-0">
						<li data-use-tooltip=1 title="Learn the steps to transfer your license keys to a new device or account." class="mb-4"><a role="button" class="btn btn-primary mb-3 d-flex m-auto" href="https://designful.freshdesk.com/support/solutions/articles/48001145016-spl-migrating-to-a-new-site-tutorial-transfer-license-to-new-domain-migrate-domains-" target="_blank"><span class="mr-3 dashicons dashicons-randomize"></span>License Transfer Guide</a></li>
						<li data-use-tooltip=1 title="Access options to transfer licenses or cancel your subscription."><a role="button" class="btn btn-primary mb-3 d-flex m-auto" href="https://members.stylishpricelist.com/my-account/" target="_blank"><span class="mr-3 dashicons dashicons-admin-site"></span>Manage Membership</a></li>
					</ul>
				</div>
			</div>
			<?php endif; ?>
			<?php if ( !$is_activated ) :  ?>
			<div class="col-md-4">
				<div class="px-3 py-5 bg-white rounded">
					<div class="text-center">
						<div class="lead fw-bold">Trouble with An Existing License?</div>
					</div>
					<p>License keys can only used on one domain.</p>
					<p>You can use the links below to migrate to a new site or deactive on an existing site.</p>
					<ul class="p-0">
						<li data-use-tooltip=1 title="Review and adjust your current license allocations or settings."><a role="button" class="btn btn-primary mb-3 d-flex m-auto" href="https://members.stylishpricelist.com/my-account/"><span class="dashicons dashicons-admin-network mr-3"></span>Manage Existing Licenses</a></li>
						<li data-use-tooltip=1 title="Enter the portal to manage your membership details, licenses, and subscriptions."><a role="button" class="btn btn-primary mb-3 d-flex m-auto" href="https://members.stylishpricelist.com/my-account/"><span class="dashicons dashicons-admin-site mr-3"></span>Access Member's Portal</a></li>
					</ul>
				</div>
			</div>
			<?php endif; ?>
		<?php
	}
	private static function page_style() {
		?>
		<style type="text/css">
			#license-page-wrapper.my-5 {
				margin-top: 3rem;
    			margin-bottom: 3rem;
				max-width: 80%;
			}
			#license-page-wrapper h1.display-6 {
				line-height: 1!important;
				font-weight: 700!important;
				margin-bottom: 1rem!important;
				font-size: 2.5rem;
			}
			#license-page-wrapper .row {
				display: flex;
    			flex-wrap: nowrap;
				margin: 0 -12px;
			}
			#license-page-wrapper .row>* {
				max-width: 100%;
				padding-right: 12px;
				padding-left: 12px;
			}
			#license-page-wrapper .lead {
				font-size: 1.25rem;
				font-weight: 300;
			}
			#license-page-wrapper .fw-bold {
				font-weight: 700!important;
			}
			#license-page-wrapper .row .col-md-8 {
				flex: 0 0 auto;
    			width: 66.66666667%;
				padding: 0 12px;
			}
			#license-page-wrapper .row .col-md-4 {
				flex: 0 0 auto;
    			width: 33.33333333%;
				padding: 0 12px;
			}
			#license-page-wrapper .bg-white {
				background-color: #fff;
			}
			#license-page-wrapper .py-5 {
				padding-top: 3rem!important;
    			padding-bottom: 3rem!important;
			}
			#license-page-wrapper .px-3 {
				padding-right: 1rem!important;
    			padding-left: 1rem!important;
			}
			#license-page-wrapper .p-5 {
				padding: 3rem!important;
			}
			#license-page-wrapper .d-none {
				display: none !important;
			}
			.w-50 {
				width: 50%!important;
			}
			.mx-auto {
				margin-right: auto!important;
    			margin-left: auto!important;
			}
			.text-center {
				text-align: center;
			}
			.justify-content-between {
				justify-content: space-between!important;
			}

			.d-flex {
				display: flex!important;
			}
			.license-page-wrapper p {
				font-size: medium;
			}

			.mb-0 {
				margin-bottom: 0!important;
			}
			.m-0 {
				margin: 0!important;
			}
			.mt-3 {
				margin-top: 18px !important;
			}
			.mr-3 {
				margin-right: 1rem!important;
			}
			.bg-white.rounded {
				border-radius: 10px;
    			box-shadow: 0px 0px 9px 10px rgb(189 189 189 / 05%);
			}
			a[role=button] {
				cursor: pointer;
				text-decoration: none;
			}
			a[role=button]:hover,
			a[role=button]:focus {
				text-decoration: none;
				color: #fff;
			}
			.justify-content-between p {
				margin-top: 0;
			}
			.mb-3 {
				margin-bottom: 1rem!important;
			}

			.flex-nowrap {
				flex-wrap: nowrap!important;
			}
			.input-group {
				position: relative;
				display: flex;
				flex-wrap: wrap;
				align-items: stretch;
				width: 100%;
			}
			.input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3), .input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu) {
				border-top-right-radius: 0;
				border-bottom-right-radius: 0;
			}

			.input-group-text {
				display: flex;
				align-items: center;
				padding: 0.375rem 0.75rem;
				font-size: 1rem;
				font-weight: 400;
				line-height: 1.5;
				color: #212529;
				text-align: center;
				white-space: nowrap;
				background-color: #e9ecef;
				border: 1px solid #ced4da;
				border-radius: 0.25rem;
			}
			.scc-icn-wrapper svg {
				height: 18px;
				width: 18px;
			}
			.input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
				margin-left: -1px;
				border-top-left-radius: 0;
				border-bottom-left-radius: 0;
			}
			.input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3), .input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu) {
				border-top-right-radius: 0;
				border-bottom-right-radius: 0;
			}
			.license-input-wrapper i, .license-input-wrapper input[type="text"] {
				background-color: #F9F9F9 !important;
			}
			.input-group>.form-control, .input-group>.form-select {
				position: relative;
				flex: 1 1 auto;
				width: 1%;
				min-width: 0;
			}
			.form-control:disabled, .form-control[readonly] {
				background-color: #e9ecef;
				opacity: 1;
			}
			[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
				cursor: pointer;
			}

			.btn-primary {
				color: #fff;
				background-color: #314af3;
				border-color: #314af3;
				border-radius: 3px;
			}
			.btn {
				display: inline-block;
				margin-bottom: 0;
				font-weight: normal;
				text-align: center;
				white-space: nowrap;
				vertical-align: middle;
				-ms-touch-action: manipulation;
				touch-action: manipulation;
				cursor: pointer;
				background-image: none;
				border: 1px solid transparent;
				padding: 10px 12px;
				font-size: 14px;
				line-height: 1.42857143;
				border-radius: 4px;
				-webkit-user-select: none;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
				margin: 2px;
			}
			.m-auto {
				margin: auto!important;
			}
			.my-4 {
				margin-top: 1.5rem!important;
				margin-bottom: 1.5rem!important;
			}
			.appsero-license-section {
				width: 100%;
				max-width: 1100px;
				min-height: 1px;
				box-sizing: border-box;
			}

			.appsero-license-settings {
				background-color: #fff;
				box-shadow: 0px 3px 10px rgba(16, 16, 16, 0.05);
			}

			.appsero-license-settings * {
				box-sizing: border-box;
			}

			.appsero-license-title {
				background-color: #F8FAFB;
				border-bottom: 2px solid #EAEAEA;
				display: flex;
				align-items: center;
				padding: 10px 20px;
			}

			.appsero-license-title svg {
				width: 30px;
				height: 30px;
				fill: #0082BF;
			}

			.appsero-license-title span {
				font-size: 17px;
				color: #444444;
				margin-left: 10px;
			}

			.appsero-license-details {
				padding: 20px;
			}

			.appsero-license-details p {
				font-size: 15px;
				margin: 0 0 20px 0;
			}

			.license-input-key {
				position: relative;
				flex: 0 0 72%;
				max-width: 72%;
			}

			.license-input-key input {
				background-color: #f9f9fe;
				padding: 10px 15px 10px 48px;
				border: 1px solid #E8E5E5;
				border-radius: 3px;
				height: 45px;
				font-size: 16px;
				color: #71777D;
				width: 100%;
				box-shadow: 0 0 0 transparent;
			}

			.license-input-key input:focus {
				outline: 0 none;
				border: 1px solid #E8E5E5;
				box-shadow: 0 0 0 transparent;
			}

			.license-input-key svg {
				width: 22px;
				height: 22px;
				fill: #0082BF;
				position: absolute;
				left: 14px;
				top: 13px;
			}

			.license-input-fields {
				display: flex;
				justify-content: space-between;
				margin-bottom: 30px;
				max-width: 850px;
				width: 100%;
			}

			.license-input-fields button {
				color: #fff;
				font-size: 17px;
				padding: 8px;
				height: 46px;
				background-color: #0082BF;
				border-radius: 3px;
				cursor: pointer;
				flex: 0 0 25%;
				max-width: 25%;
				border: 1px solid #0082BF;
			}

			.license-input-fields button.deactive-button {
				background-color: #E40055;
				border-color: #E40055;
			}

			.license-input-fields button:focus {
				outline: 0 none;
			}

			.active-license-info {
				display: flex;
			}

			.single-license-info {
				min-width: 220px;
				flex: 0 0 30%;
			}

			.single-license-info h3 {
				font-size: 18px;
				margin: 0 0 12px 0;
			}

			.single-license-info p {
				margin: 0;
				color: #00C000;
			}

			.single-license-info p.occupied {
				color: #E40055;
			}

			.appsero-license-right-form {
				margin-left: auto;
			}

			.appsero-license-refresh-button {
				padding: 6px 10px 4px 10px;
				border: 1px solid #0082BF;
				border-radius: 3px;
				margin-left: auto;
				background-color: #0082BF;
				color: #fff;
				cursor: pointer;
			}

			.appsero-license-refresh-button .dashicons {
				color: #fff;
				margin-left: 0;
			}
			@keyframes spinneralt {
				0% { transform: rotate(0deg) }
				to { transform: rotate(359deg) }
			}

			.gg-spinner-alt {
				transform: scale(var(--ggs,1))
			}

			.gg-spinner-alt,
			.gg-spinner-alt::before {
				box-sizing: border-box;
				position: relative;
				display: block;
				width: 20px;
				height: 20px
			}

			.gg-spinner-alt::before {
				content: "";
				position: absolute;
				border-radius: 100px;
				animation: spinneralt 1s cubic-bezier(.6,0,.4,1) infinite;
				border: 3px solid transparent;
				border-top-color: currentColor
			}
			.appsero-license-right-form .btn-outline-secondary {
				background-color: #F9F9F9;
				color: #000;
			}
			.appsero-license-right-form .btn-outline-secondary:hover {
				color: #fff;
			}
			.license-input-wrapper i,
			.license-input-wrapper input[type="text"] {
				background-color: #F9F9F9 !important;
			}
			.license-page-wrapper p {
				font-size: medium;
			}
		</style>
		<?php
	}
	private static function page_script() {
		?>
		<script>
			const handleLicenseBtn = ($this, evt) => {
				const action = $this.getAttribute('data-action');
				const form = document.querySelector('.license-right-form');
				const licenseInputValue = document.getElementById('license_input').value.trim();
				// alter the _action value
				form.querySelector('[name="_action"]').value = action;
				form.querySelector('[name="license_key"]').value = licenseInputValue;
				// submit the form
				form.submit();				
			}
			document.addEventListener( 'DOMContentLoaded', () => {
				jQuery( '[data-action]' ).add( '[data-use-tooltip=1]' ).tooltip();
			});
		</script>
		<?php
	}
	private function is_local_server() {
		return 0;
	}
	private function include_license_settings() {
		$license_settings = SPL_DIR . '/license-settings.php';
		if ( file_exists( $license_settings ) ) {
			require_once $license_settings;
			return true;
		} else {
			return 'cannot find the license-settings.php file in folder ' . SPL_DIR;
		}
	}
	private function do_http_ops( $params, $route, $blocking = true ) {
		$this->include_license_settings();
		$url = 'https://members.stylishpricelist.com';

		$headers = array(
			'user-agent' => 'SPL_Updater/' . esc_url( home_url() ) . ';',
			'Accept'     => 'application/json',
		);
		$license_key = $params['license_key']['_action'] == 'active' ? $params['license_key']['license_key'] : $this->get_lic_status();
		$new_api_params = array(
			'edd_action' => $params['license_key']['_action'] == 'active' ? 'activate_license' : 'deactivate_license',
			'license'    => $license_key,
			'item_id'    => df_spl_get_item_id_by_license_key( $license_key ),
			'url'        => trailingslashit( home_url() ),
		);
		if ( $params['license_key']['_action'] == 'refresh' ) {
			$new_api_params['edd_action'] = 'check_license';
		}
		// Send query to the license manager server
		$query    = esc_url_raw( add_query_arg( $new_api_params, $url ) );
		$response = wp_remote_get(
			$query,
			array(
				'timeout' => 20,
				'headers' => $headers,
				'blocking' => $blocking,
			)
		);
		return $response;
	}
	/**
	 * Send common request
	 *
	 * @param $license_key
	 * @param $route
	 *
	 * @return array
	 */
	protected function send_request( $license_key, $route = null ) {
		$params = array(
			'license_key' => $license_key,
			'url'         => trailingslashit( esc_url( home_url() ) ),
			'is_local'    => $this->is_local_server(),
		);

		$response = $this->do_http_ops( $params, $route, true );

		if ( is_wp_error( $response ) ) {
			return array(
				'success' => false,
				'error'   => $response->get_error_message(),
			);
		}

		$response = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( empty( $response ) || isset( $response['exception'] ) ) {
			return array(
				'success' => false,
				'error'   => ( 'Unknown error occurred, Please try again.' ),
			);
		}

		if ( isset( $response['errors'] ) && isset( $response['errors']['license_key'] ) ) {
			$response = array(
				'success' => false,
				'error'   => $response['errors']['license_key'][0],
			);
		}

		return $response;
	}
	 /**
	 * Active a license
	 *
	 * @return bool
	 */
	private function refresh_client_license( $license_key ) {

		$data_response  = $this->send_request( $license_key );
		$data           = get_option( $this->option_key );
		$data['status'] = $this->verify( $data_response ) !== 'valid' ? 'deactivate' : 'activate';

		update_option( $this->option2, $data['status'] == 'activate' ? 1 : '' );
		update_option( $this->option3, $data['status'] == 'activate' ? 1 : 0 );
		$opt        = $data_response;
		$extra_meta = $this->extra_meta( $data_response['license'] == 'valid' ? 'success' : 'failed' );
		$opt        = array_merge( $extra_meta, $opt );
		update_option( 'spllk_opt', $opt );
		$this->success = ( 'License refreshed successfully.' );
		return 0;
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
	public function verify( $data ) {
		$data = (object) $data;
		if ( $data->{$this->a2} == 'valid' ) {
			return 'valid';
		}
		if ( $data->{$this->a2} !== 'valid' ) {
			if ( $data->{$this->a2} == 'expired' ) {
				$exp   = strtotime( $data->expires );
				$grace = $exp + DAY_IN_SECONDS;
				// $grace = $exp;
				if ( time() < $grace ) {
					return 'not valid';
				}
			} else {
				return 'not valid';
			}
		}
		return 'not valid';
	}
		/**
	 * Get input license key
	 *
	 * @param  $action
	 *
	 * @return $license
	 */
	private function get_input_license_value( $action, $license ) {
		if ( 'active' == $action ) {
			return isset( $license['key'] ) ? $license['key'] : '';
		}

		if ( 'deactivate' == $action ) {
			$key_length = strlen( $license['key'] );

			return str_pad(
				substr( $license['key'], 0, $key_length / 2 ),
				$key_length,
				'*'
			);
		}

		return '';
	}
	/**
	 * Show explanation to the error messages
	 */
	private function get_error_message_explanation( $error_code ) {
		$message = $error_code;
		switch ( $error_code ) {

			case 'expired':
				$message = 'Your license key expired on';
				break;

			case 'disabled':
			case 'revoked':
				$message = 'Your license key has been disabled.';
				break;

			case 'missing':
				$message = 'Invalid license.';
				break;

			case 'invalid':
			case 'site_inactive':
				$message = 'Your license is not active for this URL.';
				break;

			case 'item_name_mismatch':
				$message = 'This appears to be an invalid license key for Stylish Cost Calculator Premium.';
				break;

			case 'no_activations_left':
				$message = 'Your license key has reached its activation limit. Please visit the member\'s portal to manage your active sites.';
				break;

			default:
				$message = 'An error occurred, please try again.';
				break;
		}
		return $message;
	}
	/**
	 * Deactive client license
	 */
	private function deactive_client_license( $form ) {
		$form = wp_parse_args($form, array(
				"license_key" => "",
				"_action" => "deactivate",
				"submit" => "submit",
				"_nonce" => ""
		));
		$key = $form['license_key'];
		if ( ! empty( $key ) ) {
			$license_data = $this->get_license_data( $key, 'slm_deactivate' );
			if ( isset( $license_data->license ) ) {
				if ( $license_data->license == 'deactivated' ) {//Success was returned for the license activation
					$this->update_opt( '' );
					$this->success = ( 'License deactivated successfully.' );
					return true;
				} else {
					//Uncomment the followng line to see the message that returned from the license server
					// return $license_data->message;
					$this->error = $license_data->message ?? 'Error deactivating. Please login to your account and deactivate the license.' ;
					return '<p style="color:red;"> Error: ' . $license_data->message . '</p>';
				}
			} else {
				return $license_data;
			}
		} else {
			$this->error = ( 'Error deactivating. Please login to your account and deactivate the license.' );
		}

		$this->success = ( 'License deactivated successfully.' );
		return $this;
	}
	/**
	 * Active client license
	 */
	private function active_client_license( $form ) {
		if ( empty( $form['license_key'] ) ) {
			$this->error = ( 'The license key field is required.' );

			return;
		}

		$form['license_key'] = sanitize_text_field( $form['license_key'] );
		$response            = $this->activate( $form );

		if ( ! $response ) {
			return;
		}
		if ( $response === true ) {
			$this->success = ( 'License activated successfully.' );
		} else {
			$this->error = ( 'Error activating the license key.' );
		}
		return $this;
	}
}

?>
