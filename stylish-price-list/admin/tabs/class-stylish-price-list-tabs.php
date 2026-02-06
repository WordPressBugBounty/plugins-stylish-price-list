<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
* Kick-in the class
*/
class Stylish_Price_List_Tabs {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_ajax_df_spl_feedback_manage', array( $this, 'feedback_manage' ) );
		add_action( 'wp_ajax_stylish-price-list-submit-uninstall-reason', array( $this, 'uninstall_reason' ) );
		add_action( 'wp_ajax_spl_setup_wizard', array( $this, 'spl_setup_wizard' ) );
    add_action('admin_init', array($this, 'handle_delete_action'));
		// spl_setup_wizard
	}
	public function spl_setup_wizard() {
		check_ajax_referer( 'spl-add-new-page', 'nonce' );
		if ( ! current_user_can( 'edit_posts' ) ) {
			wp_send_json_error( array( 'message' => __( 'Permission denied.', 'spl' ) ), 403 );
		}
		$input_args              = file_get_contents( 'php://input' );
    	$args                    = json_decode( $input_args, true );
    	$this->spl_send_wizard_quiz_data( $args );
		wp_send_json_success();
	}
    private function spl_send_wizard_quiz_data( $data ) {
        $telemetry_url = SPL_TELEMETRY_ENDPOINT . '/api/public/collect';
        $telemetry_url = add_query_arg( 'app', 'spl', $telemetry_url );

        $headers      = [
            'user-agent'    => 'SPL/' . STYLISH_PRICE_LIST_VERSION . ';',
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
            'X-App-Version' => STYLISH_PRICE_LIST_VERSION,
            'X-Site-Url'    => get_site_url(),
        ];

        $response     = wp_remote_post(
            $telemetry_url,
            [
                'method'      => 'POST',
                'timeout'     => 5,
                'redirection' => 5,
                'httpversion' => '1.1',
                'headers'     => $headers,
                'body'        => wp_json_encode( $data ),
                'cookies'     => [],
            ]
        );

        // wp_send_json_success( ['done' => true] );
        return;
    }
    public function generate_tutorial_pdf_from_wizard( $title, $recipient_name, $website_name, $template_collection ){
        // $message_body = $this->email_suggestion_template_builder( $template_collection );
        $message_body = '';
        $data = '<!doctype html>
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        
        <head>
          <title>
          </title>
          <!--[if !mso]><!-->
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <!--<![endif]-->
          <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <style type="text/css">
            #outlook a {
              padding: 0;
            }
        
            body {
              margin: 0;
              padding: 0;
              -webkit-text-size-adjust: 100%;
              -ms-text-size-adjust: 100%;
            }
        
            table,
            td {
              border-collapse: collapse;
              mso-table-lspace: 0pt;
              mso-table-rspace: 0pt;
            }
        
            img {
              border: 0;
              height: auto;
              line-height: 100%;
              outline: none;
              text-decoration: none;
              -ms-interpolation-mode: bicubic;
            }
        
            p {
              display: block;
              margin: 13px 0;
            }
          </style>
          <!--[if mso]>
                <noscript>
                <xml>
                <o:OfficeDocumentSettings>
                  <o:AllowPNG/>
                  <o:PixelsPerInch>96</o:PixelsPerInch>
                </o:OfficeDocumentSettings>
                </xml>
                </noscript>
                <![endif]-->
          <!--[if lte mso 11]>
                <style type="text/css">
                  .mj-outlook-group-fix { width:100% !important; }
                </style>
                <![endif]-->
          <!--[if !mso]><!-->
          <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,500,700" rel="stylesheet" type="text/css">
          <style type="text/css">
            @import url(https://fonts.googleapis.com/css?family=Nunito:300,400,500,700);
          </style>
          <!--<![endif]-->
          <style type="text/css">
            @media only screen and (min-width:480px) {
              .mj-column-per-100 {
                width: 100% !important;
                max-width: 100%;
              }
            }
          </style>
          <style media="screen and (min-width:480px)">
            .moz-text-html .mj-column-per-100 {
              width: 100% !important;
              max-width: 100%;
            }
          </style>
          <style type="text/css">
            @media only screen and (max-width:480px) {
              table.mj-full-width-mobile {
                width: 100% !important;
              }
        
              td.mj-full-width-mobile {
                width: auto !important;
              }
            }
          </style>
        </head>
        
        <body style="word-spacing:normal;">
        <div style="page-break-inside: avoid;">
            <!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]-->
            <div style="margin:0px auto;max-width:600px;">
              <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                <tbody>
                  <tr>
                    <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
                      <!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]-->
                      <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                          <tbody>
                            <tr>
                              <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                  <tbody>
                                    <tr>
                                      <td style="width:200px;">
                                        <img height="auto" src="https://stylishcostcalculator.com/wp-content/uploads/2020/04/scc-logo209-721.png" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="200" />
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                            <tr>
                              <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                <div style="font-family:Nunito,BlinkMacSystemFont,-apple-system,Arial,sans-serif;font-size:36px;line-height:1;text-align:left;color:#000000;">
                                    <p>Your Tailored Setup Guide - <b>Curated Just for You</b></p>
                                </div>
                                <div style="font-family:Nunito,BlinkMacSystemFont,-apple-system,Arial,sans-serif;font-size:20px;line-height:1;text-align:left;color:#000000;">
                                    <p>Finish Your Setup, Unleash Lead Generation!</p>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td align="left" style="font-size:0px;padding:25px 25px 0px 25px;word-break:break-word;">
                                <div style="font-family:Nunito,BlinkMacSystemFont,-apple-system,Arial,sans-serif;font-size:16px;line-height:1;text-align:left;color:#000000;">
                                    <p>Hi ' . ucwords( $recipient_name ) . ',</p>
                                    <p>Here are your customized setup instructions, specially for <strong>' . $website_name . '</strong>.</p>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td align="left" style="font-size:0px;padding:0px 25px 40px 25px;word-break:break-word;">
                                <div style="font-family:Nunito,BlinkMacSystemFont,-apple-system,Arial,sans-serif;font-size:16px;line-height:1;text-align:left;color:#000000;">Follow the steps in this email to complete your calculator form setup. Get ready to elevate user engagement and conversions.</div>
                              </td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <p style="border-top:dashed 1px lightgrey;font-size:1px;margin:0px auto;width:100%;">
                                    </p>
                                    <!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" style="border-top:dashed 1px lightgrey;font-size:1px;margin:0px auto;width:550px;" role="presentation" width="550px" ><tr><td style="height:0;line-height:0;"> &nbsp;
            </td></tr></table><![endif]-->
                                </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <!--[if mso | IE]></td></tr></table><![endif]-->
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!--[if mso | IE]></td></tr></table><![endif]-->
            ' . $message_body . '
          </div>
        </body>
        
        </html>';
        $options = new Options();
        $options->set( 'defaultFont', 'freesans' );
        $font_directory       = SCC_DIR . '/lib/dompdf/vendor/dompdf/dompdf/lib/fonts/';
        $font_cache_directory = SCC_DIR . '/lib/dompdf/vendor/dompdf/dompdf/lib/fonts_cache/';
        //if cache directory does not exist, create it
        if ( ! is_dir( $font_cache_directory ) ) {
            if ( ! mkdir( $font_cache_directory, 0777, true ) ) {
                die( 'Could not create font cache' );
            }
        }
        $options->set( 'fontDir', $font_cache_directory );
        $options->set( 'fontCache', $font_directory );
        $options->set( 'isHtml5ParserEnabled', true );
        $options->set( 'isRemoteEnabled', true );
        $dompdf = new Dompdf( $options );
        $dompdf->setPaper(array(0, 0, 595.28, 841.89*4), 'portrait'); // A4 height * 20
        $dompdf->loadHtml( $data );
        $dompdf->render();
        $pdf_data = $dompdf->output();
        $base_64_pdf = base64_encode($pdf_data);

        return $base_64_pdf;
    }
	/**
	 * Add menu items
	 *
	 * @return void
	 */
	public function admin_menu() {
		$icon_url = SPL_URL . 'assets/images/spl_icon.png';
		/** Top Menu **/
		add_menu_page( __( 'Stylish Price List', 'spl' ), __( 'Stylish Price List', 'spl' ), 'manage_options', 'spl-tabs', array( $this, 'plugin_page' ), $icon_url, 99 );
		add_submenu_page( 'spl-tabs', __( 'All Lists', 'spl' ), __( 'All Lists', 'spl' ), 'manage_options', 'spl-tabs', array( $this, 'plugin_page' ) );
		add_submenu_page( 'options.php', __('New Price List', 'spl'), '', 'manage_options', 'spl-tabs-new', array( $this, 'plugin_page_new' ) );
		add_submenu_page( 'spl-tabs', __( 'Add New List', 'spl' ), __( 'Add New List', 'spl' ), 'manage_options', 'spl-assisted-new', array( $this, 'plugin_page_assisted_new' ) );
		// spl-assisted-new
		add_submenu_page( 'spl-tabs', __( 'SPL Diagnostic', 'spl' ), __( 'SPL Diagnostic', 'spl' ), 'manage_options', 'spl-tabs-diagnostic', array( $this, 'plugin_page_diagnostic' ) );
	}
	public function plugin_page_new() {
		wp_enqueue_style( 'spl-bootstrap-min' );
		wp_enqueue_style( 'spl-list-style' );
		wp_enqueue_style( 'spl-admin-style' );
		$template = dirname( __FILE__ ) . '/views/tabs-new.php';
		if ( file_exists( $template ) ) {
			include $template;
		}
	}
	public function plugin_page_assisted_new() {
		wp_enqueue_style( 'spl-add-new-page' );
		wp_enqueue_script( 'spl-add-new-page' );
		wp_enqueue_style( 'spl-tomselect' );
		wp_enqueue_script( 'spl-tomselect' );
		// wp_enqueue_style( 'spl-bootstrap-min' );
		wp_enqueue_style( 'spl-list-style' );
		wp_enqueue_style( 'spl-admin-style' );
		$template = dirname( __FILE__ ) . '/views/tabs-assisted-new.php';
		if ( file_exists( $template ) ) {
			include $template;
		}
	}
	public function plugin_page_diagnostic() {
		$template = dirname( __FILE__ ) . '/views/spl-diagnostic.php';
		if ( file_exists( $template ) ) {
			include $template;
		}
	}


  public function handle_delete_action() {
    if (!isset($_REQUEST['action']) || $_REQUEST['action'] !== 'delete' || !isset($_REQUEST['page']) || $_REQUEST['page'] !== 'spl-tabs') {
        return;
    }

    // Verify nonce
    $block = true;

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( esc_html__( 'Sorry, you are not allowed to do that.', 'spl' ) );
    }

    $nonce = isset( $_GET['nonce'] ) ? sanitize_text_field( wp_unslash( $_GET['nonce'] ) ) : '';
    if ( empty( $nonce ) ) {
        wp_die( esc_html__( 'The page you are trying to access is not available.', 'spl' ) );
    }
    $block = !wp_verify_nonce($nonce, 'price_lists_page_nonce');

    // Check if access is blocked
    if ($block) {
        wp_die(esc_html__('The page you are trying to access is not available.', 'spl'));
        return;
    }

    // Handle deletion of multiple IDs
    if (isset($_REQUEST['ids']) && is_array($_REQUEST['ids'])) {
        $ids = array_map('absint', $_REQUEST['ids']);
        foreach ($ids as $item_id) {
            if ($item_id > 0) {
                df_spl_delete_tabs_by_id($item_id);
            }
        }
    } 
    // Handle single ID deletion
    elseif (isset($_REQUEST['id'])) {
        $id = absint($_REQUEST['id']);
        if ($id > 0) {
            df_spl_delete_tabs_by_id($id);
        }
    }

    wp_redirect(admin_url('admin.php?page=spl-tabs'));
    exit;
}

public function plugin_page() {
    // Initialize variables with default values
    $action = 'list';
    $id = 0;
    $template = '';

    // Validate and sanitize action
    if (isset($_REQUEST['action'])) {
        $action = sanitize_text_field($_REQUEST['action']);
    }

    // Validate and sanitize ID
    if (isset($_REQUEST['id'])) {
        $id = absint($_REQUEST['id']);
    }

    // Handle other actions
    switch ($action) {
        case 'view':
            $template = dirname(__FILE__) . '/views/tabs-single.php';
            break;

        case 'edit':
            $template = dirname(__FILE__) . '/views/tabs-edit.php';
            break;

        case 'new':
            $template = dirname(__FILE__) . '/views/tabs-new.php';
            break;

        case 'readonly':
            $template = dirname(__FILE__) . '/views/tabs-readonly.php';
            break;

        case 'duplicate':
            $template = dirname(__FILE__) . '/views/duplication-process.php';
            break;

        default:
            $template = dirname(__FILE__) . '/views/tabs-list.php';
            break;
    }

    // Validate and include template
    if (!empty($template) && file_exists($template)) {
        include $template;
    } else {
        wp_die(esc_html__('Template file not found.', 'spl'));
    }
}
	/**
	* Response to ajax calls
	*
	* @return void
	*/
	public function feedback_manage() {
		check_ajax_referer('spl-feedback-modal');
		if ( ! current_user_can( 'edit_posts' ) ) {
			wp_send_json_error( array( 'message' => __( 'Permission denied.', 'spl' ) ), 403 );
		}
		$args = isset( $_POST['btn-type'] ) ? sanitize_text_field( $_POST['btn-type'] ) : false;

        if ( $args ) {
            $data = $this->feedback_invokation( $args );
            wp_send_json(array('ok' => $data));
        }
        $data = json_decode( file_get_contents( 'php://input' ), true );
		$user = wp_get_current_user();
        $data = wp_parse_args( $data, [
            'rating'        => 0,
            'text'          => '',
            'optedForEmail' => false,
        ] );
		$base_url         = apply_filters( 'df_spl_api_endpoint', 'https://telemetry.stylishpricelist.com' );
        $survey_store_url = $base_url . '/api/public/user-survey';
        $headers          = [
            'user-agent'        => 'SPL/' . STYLISH_PRICE_LIST_VERSION . ';',
            'Accept'            => 'application/json',
            'Content-Type'      => 'application/json',
            'X-App-Version'     => STYLISH_PRICE_LIST_VERSION,
            'X-Site-Url'        => md5( get_site_url() ),
            'X-Release-Channel' => 'demo',
        ];
        $resp = wp_remote_post( $survey_store_url, [
            'method'      => 'POST',
            'timeout'     => 5,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => false,
            'headers'     => $headers,
            'body'        => wp_json_encode( $data ),
            'cookies'     => [],
        ] );
        $this->feedback_invokation( 'comment_and_rating' );
        wp_send_json( [ 'ok' => $data ] );
	}
	public function uninstall_reason () {
		check_ajax_referer( 'uninstall-df-spl-page', 'nonce' );
		if ( ! current_user_can( 'activate_plugins' ) ) {
			wp_send_json_error( array( 'message' => __( 'Permission denied.', 'spl' ) ), 403 );
		}
		$base_url            = apply_filters( 'df_spl_api_endpoint', 'https://telemetry.stylishpricelist.com' );


		$data = json_decode( file_get_contents( 'php://input' ), true );
        $data = wp_parse_args( $data, [
            'answer'           => 0,
            'comment'          => '',
            'site'             => '',
        ] );
        $data['site']     = md5( get_site_url() );
        $survey_store_url = $base_url . '/api/public/uninstall-survey';
        $headers          = [
            'user-agent'        => 'SPL/' . STYLISH_PRICE_LIST_VERSION . ';',
            'Accept'            => 'application/json',
            'Content-Type'      => 'application/json',
            'X-App-Version'     => STYLISH_PRICE_LIST_VERSION,
            'X-Site-Url'        => md5( get_site_url() ),
            'X-Release-Channel' => 'demo',
        ];
        $response = wp_remote_post( $survey_store_url, [
            'method'      => 'POST',
            'timeout'     => 5,
            'redirection' => 5,
            'httpversion' => '1.1',
            'headers'     => $headers,
			// 'blocking'    => true,
            'body'        => wp_json_encode( $data ),
            'cookies'     => [],
        ] );
		$response = wp_remote_retrieve_body( $response );
		if ( is_wp_error( $response ) ) {
			wp_send_json_error( $response );
		}
        wp_send_json( [ 'ok' => $data ] );
	}
	/**
	* Sets feedback modal invokation to compare against 'spl_save_count' option
	*
	* @return integer
	*/
	public function feedback_invokation( $args ) {
		$save_count         = get_option( 'spl_save_count' );
		$current_invokation = get_option( 'spl_feedback_invoke' );
		$invoke_at          = 0;
		switch ( $args ) {
			case 'skip':
				$invoke_at = $save_count + 5;
				if ( get_option( 'spl_feedback_invoke' ) !== 'disabled' ) {
					update_option( 'spl_feedback_invoke', $invoke_at );
				}
				break;
			case 'yes':
			case 'comment_and_rating':
			case 'no':
				update_option( 'spl_feedback_invoke', 'disabled' );
				break;
			default:
				if ( $current_invokation && $current_invokation != 'disabled' ) {
					$invoke_at = $current_invokation;
				} elseif ( $current_invokation == 'disabled' ) {
					$invoke_at = 0;
				} else {
					$invoke_at = 9;
				};
				break;
		}
		return (int) $invoke_at;
	}
}
new Stylish_Price_List_Tabs();
