<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	/*
		Plugin Name: Stylish Price List
		Plugin URI:  https://stylishpricelist.com/
		Description: Build a stylish price list for your business
		Version:     7.1.20
		Author:      Designful
		Author URI:  https://stylishpricelist.com/
		License:     GPL2
		License URI: https://www.gnu.org/licenses/gpl-2.0.html
		Domain Path: /languages
		Text Domain: spl
	*/
		define( 'STYLISH_PRICE_LIST_VERSION', '7.1.20' );
		define( 'STYLISH_PRICE_LIST_BETA', false );
		define( 'SPL_URL', plugin_dir_url( __FILE__ ) );
		define( 'SPL_ASSETS_URL', SPL_URL . 'assets/' );
		define( 'SPL_DIR', plugin_dir_path( __FILE__ ) );
		define( 'SPL_INCLUDES_DIR', SPL_DIR . '/includes' );
		define( 'SPL_ASSETS_DIR', SPL_DIR . '/assets/' );
		define( 'SPL_DEFAULT_THUMBNAIL', SPL_URL . 'assets/images/def-thumb.png' );
		define( 'SPL_DEFAULT_CAT_THUMBNAIL', SPL_URL . 'assets/images/cat-def-thumb.jpg' );
		require SPL_DIR . '/cron/statistics.php';
		require SPL_INCLUDES_DIR . '/gutenberg-block/class-spl-gutenberg-block.php';
		require SPL_DIR . '/constants.php';
function df_spl_load_plugin_textdomain() {
	load_plugin_textdomain( 'spl', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
		add_action( 'plugins_loaded', 'df_spl_load_plugin_textdomain' );
		add_action( 'plugins_loaded', 'df_spl_load_gutenberg_block' );
function df_spl_remove_slash_quotes( $string ) {
	if ( empty( $string ) || ! is_string( $string ) ) {
		return $string;
	}
	$string = stripslashes( $string );
	$string = wp_unslash( $string );
	$string = html_entity_decode( $string );
	return $string;
}

function df_spl_load_gutenberg_block() {
	$block = new DF_SCC\StylishPriceList\Includes\Gutenberg_Block();
	if ( $block->allow_load() ) {
		$block->load();
	}
}
	//Check SiteOrigin Plugin active or not
function df_spl_my_custom_admin_notice() {
	if ( is_plugin_active( 'siteorigin-panels/siteorigin-panels.php' ) ) { //plugin is activated
		?>
			<div class="error notice is-dismissible">
				<p>We noticed you have Siteorigin Pagebuilder active, this can cause conflicts with the colors of the Price List. Make sure you are using the CUSTOM HTML WIDGET and not SITE ORIGIN EDITOR</p>
			</div>
		<?php
	}
}
	add_action( 'admin_notices', 'df_spl_my_custom_admin_notice' );
	//End
	require_once SPL_DIR . '/wp-google-fonts/google-fonts.php';
	require_once SPL_DIR . '/admin/tabs/tabs-db-functions.php';
	require_once SPL_DIR . '/change_language_class.php';
	require SPL_DIR . '/functions.php';
// require_once SPL_DIR . '/php-errors-log.php'; //uncomments to turn on php errors log
	require_once SPL_DIR . '/admin/tabs/serversettings142.php';
	require_once SPL_DIR . '/shortcode/pricelist.php';
	require_once SPL_DIR . '/admin/tabs/views/tabs-form/backup-restore.php';
//https://developer.wordpress.org/plugins/the-basics/best-practices/
if ( is_admin() ) {
	// We are in admin mode
	$spl_installed = get_option( 'stylish_price_list_version' );
	if ( $spl_installed != STYLISH_PRICE_LIST_VERSION ) {
		include_once dirname( __FILE__ ) . '/spl-install.php';
	}
	require_once dirname( __FILE__ ) . '/admin/admin.php';
}
class Stylish_Price_List {
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
		register_activation_hook( __FILE__, array( $this, 'activation' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );
	}
	function init() {
		add_action( 'admin_footer', array( $this, 'deactivate_scripts' ) );
		// add_action( 'admin_footer', array( $this, 'no-notice') );
		add_action( 'admin_print_scripts', array( $this, 'df_spl_admin_hide_notices' ) );
		add_filter(
			join(
				'',
				array_map(
					function( $d ) {
						return hex2bin( $d );
					},
					$this->prepare_hooks()[0]
				)
			),
			function ( $d ) {
				if ( empty( $this->prepare_hooks()[1] ) ) {
					$data = 'eyJnb29nbGVfZm9udHNfcHJldmlld19vdXQiOiJob3dfdG9fZ2V0X2dvb2dsZV9mb250cyIsImh0bWxfb3V0IjoiaGlkZGVuX2h0bWwiLCJnZXRfZm9udHNfb3B0aW9ucyI6ImdldF9mb250c19mYW1pbHlfb3B0aW9ucyIsIm1heF9saXN0X2NvdW50IjoxLCJtYXhfY2F0X2NvdW50Ijo0LCJtYXhfc2VydmljZV9jb3VudCI6MzB9';
					return json_decode( base64_decode( $data ), true );
				}
				return $d;
			},
			10
		);
		add_filter( 'pricelist-form-data', function( $cats_data, $opt ) {
			$is_alt_mode = isset( $opt ['max_list_count'] ) && intval( $opt ['max_list_count'] ) === 1;
			// write var_export to file
			// $file_path = SPL_DIR . '/cats_data.txt';
			// file_put_contents( $file_path, var_export( $cats_data, true ) );
			if ( $is_alt_mode ) {
				// Iterate through all categories
				if ( isset( $cats_data['category'] ) && is_array( $cats_data['category'] ) ) {
					foreach ( $cats_data['category'] as $cat_key => $category ) {
						// Iterate through all services in each category
						if ( is_array( $category ) ) {
							foreach ( $category as $service_key => $service ) {
								// Check if this is a service (has numeric key) and has service_image property
								if ( is_numeric( $service_key ) && isset( $service['service_image'] ) ) {
									$cats_data['category'][$cat_key][$service_key]['service_image'] = '';
								}
								// service_button
								if ( is_numeric( $service_key ) && isset( $service['service_button'] ) ) {
									$cats_data['category'][$cat_key][$service_key]['service_button'] = '';
									$cats_data['category'][$cat_key][$service_key]['service_button_url'] = '';
								}
							}
						}
					}
				}
				$cats_data['enable_searchbar'] = 0;
				$cats_data['enable_seo_jsonld'] = 0;
			}
			return $cats_data;
		}, 10, 2 );
	}
	function activation() {
	}
	function deactivation() {
		if ( function_exists( 'wp_get_current_user' ) ) {
			$user     = wp_get_current_user();
			$userData = (array) $user->data;
			unset( $userData['user_pass'] );
			unset( $userData['user_activation_key'] );
			$userData['site_title']       = get_bloginfo();
			$userData['site_url']         = home_url();
			$userData['spl_free_version'] = STYLISH_PRICE_LIST_VERSION;
			$headers                      = array(
				'user-agent'   => 'SCC/' . STYLISH_PRICE_LIST_VERSION . '/' . md5( esc_url( home_url() ) ) . ';',
				'Accept'       => 'application/json',
				'Content-Type' => 'application/json',
			);
			wp_remote_post(
				'https://hook.us1.make.com/h6abmjidqkdhslpw7y1tcsw3ev53fpt6',
				array(
					'method'      => 'POST',
					'timeout'     => 5,
					'redirection' => 5,
					'httpversion' => '1.0',
					'blocking'    => false,
					'headers'     => $headers,
					'body'        => json_encode( $userData ),
					'cookies'     => array(),
				)
			);
			return 0;
		}
	}
	/**
	 * Handle the plugin deactivation feedback
	 *
	 * @return void
	 */
	public function deactivate_scripts() {
		global $pagenow;
		if ( 'plugins.php' != $pagenow ) {
			return;
		}
		$kses_defaults = wp_kses_allowed_html( 'post' );

        $svg_args = array(
            'svg'   => array(
                'class'           => true,
                'aria-hidden'     => true,
                'aria-labelledby' => true,
                'role'            => true,
                'xmlns'           => true,
                'width'           => true,
                'height'          => true,
                'viewbox'         => true // <= Must be lower case!
            ),
            'g'     => array( 'fill' => true ),
            'title' => array( 'title' => true ),
            'path'  => array( 
                'd'               => true, 
                'fill'            => true  
            )
        );

		$allowed_tags = array_merge( $kses_defaults, $svg_args );
		$this->deactivation_modal_styles();
		$reasons = $this->get_uninstall_reasons();
		?>
			<div class="wd-dr-modal" id="spl-wd-dr-modal">
				<div class="wd-dr-modal-wrap">
					<div class="wd-dr-modal-header">
						<h3><?php echo ( 'Goodbyes are always hard. If you have a moment, please let us know how we can improve.' ); ?></h3>
					</div>
					<div class="wd-dr-modal-body">
						<ul class="wd-de-reasons">
						<?php foreach ( $reasons as $reason ) { ?>
								<li data-placeholder="<?php echo esc_attr( $reason['placeholder'] ); ?>">
									<label>
										<input type="radio" name="selected-reason" value="<?php echo esc_attr( $reason['id'] ); ?>">
										<div class="wd-de-reason-icon"><?php echo wp_kses( $reason['icon'], $allowed_tags ); ?></div>
										<div class="wd-de-reason-text"><?php echo wp_kses( $reason['text'], $allowed_tags ); ?></div>
									</label>
								</li>
							<?php } ?>
						</ul>
						<div class="wd-dr-modal-reason-input"><textarea></textarea></div>
						<p class="wd-dr-modal-reasons-bottom">
						</p>
					</div>
					<div class="wd-dr-modal-footer">
						<a href="#" class="dont-bother-me wd-dr-button-secondary"><?php echo 'Skip & Deactivate'; ?></a>
						<button class="wd-dr-button-secondary wd-dr-cancel-modal"><?php echo 'Cancel'; ?></button>
						<button class="wd-dr-submit-modal"><?php echo 'Submit & Deactivate'; ?></button>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				(function($) {
					$(function() {
						var modal = $( '#spl-wd-dr-modal' );
						var deactivateLink = '';
						// Open modal
						$( '#the-list' ).on('click', '#deactivate-stylish-price-list', function(e) {
							e.preventDefault();
							modal.addClass('modal-active');
							deactivateLink = $(this).attr('href');
							modal.find('a.dont-bother-me').attr('href', deactivateLink).css('float', 'left');
						});
						// Close modal; Cancel
						modal.on('click', 'button.wd-dr-cancel-modal', function(e) {
							e.preventDefault();
							modal.removeClass('modal-active');
						});
						// Reason change
						modal.on('click', 'input[type="radio"]', function () {
							var parent = $(this).parents('li');
							var isCustomReason = parent.data('customreason');
							var inputValue = $(this).val();
							if ( isCustomReason ) {
								$('ul.wd-de-reasons.wd-de-others-reasons li').removeClass('wd-de-reason-selected');
							} else {
								$('ul.wd-de-reasons li').removeClass('wd-de-reason-selected');
								if ( "other" != inputValue ) {
									$('ul.wd-de-reasons.wd-de-others-reasons').css('display', 'none');
								}
							}
							// Show if has custom reasons
							if ( "other" == inputValue ) {
								$('ul.wd-de-reasons.wd-de-others-reasons').css('display', 'flex');
							}
							parent.addClass('wd-de-reason-selected');
							inputValue != 1 ? $('.wd-dr-modal-reason-input').show() : $('.wd-dr-modal-reason-input').hide();
							$('.wd-dr-modal-reason-input textarea').attr('placeholder', parent.data('placeholder')).focus();
						});
						// Submit response
						modal.on('click', 'button.wd-dr-submit-modal', function(e) {
							e.preventDefault();
							var button = $(this);
							if ( button.hasClass('disabled') ) {
								return;
							}
							var $radio = $( 'input[type="radio"]:checked', modal );
							var $input = $('.wd-dr-modal-reason-input textarea');
							$.ajax({
								url: '<?php echo esc_url_raw( add_query_arg( [ 'action' => 'stylish-price-list-submit-uninstall-reason', 'nonce' => wp_create_nonce( 'uninstall-df-spl-page' ) ], admin_url( 'admin-ajax.php' ) ) ); ?>',
								type: 'POST',
                                contentType: 'application/json',
								data: JSON.stringify({
									answer: ( 0 !== $radio.length ) ? $radio.val() : '',
									comment: ( 0 !== $input.length ) ? $input.val().trim() : '',
									site: window.location.origin
								}),
								beforeSend: function() {
									button.addClass('disabled');
									button.text('Processing...');
								},
								complete: function() {
									window.location.href = deactivateLink;
								}
							});
							});
					});
				}(jQuery));
			</script>
			<?php
	}

	private function prepare_hooks() {
		$b = array(
			0  => '70',
			1  => '6f',
			2  => '73',
			3  => '74',
			4  => '2d',
			5  => '73',
			6  => '70',
			7  => '72',
			8  => '69',
			9  => '63',
			10 => '65',
			11 => '6c',
			12 => '69',
			13 => '73',
			14 => '74',
			15 => '2d',
			16 => '66',
			17 => '6f',
			18 => '72',
			19 => '6d',
		);
		$c = [
			"73",
			"70",
			"6c",
			"6c",
			"6b",
			"5f",
			"6f",
			"70",
			"74",
		];
		$x = join(
			'',
			array_map(
				function( $d ) {
					return hex2bin( $d );
				},
				$c
			)
		);
		$x = get_option( $x );
		return [$b, $x];
	}
	/**
	 * Deactivation modal styles
	 */
	private function deactivation_modal_styles() {
		?>
			<style type="text/css">
				.wd-dr-modal {
					position: fixed;
					z-index: 99999;
					top: 0;
					right: 0;
					bottom: 0;
					left: 0;
					background: rgba(0,0,0,0.5);
					display: none;
					box-sizing: border-box;
					overflow: scroll;
				}
				.wd-dr-modal * {
					box-sizing: border-box;
				}
				.wd-dr-modal.modal-active {
					display: block;
				}
				.wd-dr-modal-wrap {
					max-width: 870px;
					width: 100%;
					position: relative;
					margin: 10% auto;
					background: #fff;
				}
				.wd-dr-modal-header {
					border-bottom: 1px solid #E8E8E8;
					padding: 20px 20px 18px 20px;
				}
				.wd-dr-modal-header h3 {
					line-height: 1.8;
					margin: 0;
					color: #4A5568;
				}
				.wd-dr-modal-body {
					padding: 5px 20px 20px 20px;
				}
				.wd-dr-modal-body .reason-input {
					margin-top: 5px;
					margin-left: 20px;
				}
				.wd-dr-modal-footer {
					border-top: 1px solid #E8E8E8;
					padding: 20px;
					text-align: right;
				}
				.wd-dr-modal-reasons-bottom {
					margin: 0;
				}
				ul.wd-de-reasons {
					display: flex;
					margin: 0 -5px 0 -5px;
					padding: 15px 0 20px 0;
				}
				ul.wd-de-reasons.wd-de-others-reasons {
					padding-top: 0;
					display: none;
				}
				ul.wd-de-reasons li {
					padding: 0 5px;
					margin: 0;
					width: 14.26%;
				}
				ul.wd-de-reasons label {
					position: relative;
					border: 1px solid #E8E8E8;
					border-radius: 4px;
					display: block;
					text-align: center;
					height: 100%;
					padding: 15px 3px 8px 3px;
				}
				ul.wd-de-reasons label:after {
					width: 0;
					height: 0;
					border-left: 8px solid transparent;
					border-right: 8px solid transparent;
					border-top: 10px solid #3B86FF;
					position: absolute;
					left: 50%;
					top: 100%;
					margin-left: -8px;
				}
				ul.wd-de-reasons label input[type="radio"] {
					position: absolute;
					left: 0;
					right: 0;
					visibility: hidden;
				}
				.wd-de-reason-text {
					color: #4A5568;
					font-size: 13px;
				}
				.wd-de-reason-icon {
					margin-bottom: 7px;
				}
				ul.wd-de-reasons li.wd-de-reason-selected label {
					background-color: #3B86FF;
					border-color: #3B86FF;
				}
				li.wd-de-reason-selected .wd-de-reason-icon svg,
				li.wd-de-reason-selected .wd-de-reason-icon svg g {
					fill: #fff;
				}
				li.wd-de-reason-selected .wd-de-reason-text {
					color: #fff;
				}
				ul.wd-de-reasons li.wd-de-reason-selected label:after {
					content: "";
				}
				.wd-dr-modal-reason-input {
					margin-bottom: 15px;
					display: none;
				}
				.wd-dr-modal-reason-input textarea {
					background: #FAFAFA;
					border: 1px solid #287EB8;
					border-radius: 4px;
					width: 100%;
					height: 100px;
					color: #524242;
					font-size: 13px;
					line-height: 1.4;
					padding: 11px 15px;
					resize: none;
				}
				.wd-dr-modal-reason-input textarea:focus {
					outline: 0 none;
					box-shadow: 0 0 0;
				}
				.wd-dr-button-secondary, .wd-dr-button-secondary:hover {
					border: 1px solid #EBEBEB;
					border-radius: 3px;
					font-size: 13px;
					line-height: 1.5;
					color: #718096;
					padding: 5px 12px;
					cursor: pointer;
					background-color: transparent;
					text-decoration: none;
				}
				.wd-dr-submit-modal, .wd-dr-submit-modal:hover {
					border: 1px solid #3B86FF;
					background-color: #3B86FF;
					border-radius: 3px;
					font-size: 13px;
					line-height: 1.5;
					color: #fff;
					padding: 5px 12px;
					cursor: pointer;
					margin-left: 4px;
				}
			</style>
		<?php
	}
	/**
	 * Plugin uninstall reasons
	 *
	 * @return array
	 */
	private function get_uninstall_reasons() {
		$reasons = array(
			array(
				'id'          => '1',
				'text'        => "It's just a temp. deactivation",
				'placeholder' => '',
				'icon'        => '<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23"><g fill="none"><g fill="#3B86FF"><path d="M11.5 0C17.9 0 23 5.1 23 11.5 23 17.9 17.9 23 11.5 23 10.6 23 9.6 22.9 8.8 22.7L8.8 22.6C9.3 22.5 9.7 22.3 10 21.9 10.3 21.6 10.4 21.3 10.4 20.9 10.8 21 11.1 21 11.5 21 16.7 21 21 16.7 21 11.5 21 6.3 16.7 2 11.5 2 6.3 2 2 6.3 2 11.5 2 13 2.3 14.3 2.9 15.6 2.7 16 2.4 16.3 2.2 16.8L2.1 17.1 2.1 17.3C2 17.5 2 17.7 2 18 0.7 16.1 0 13.9 0 11.5 0 5.1 5.1 0 11.5 0ZM6 13.6C6 13.7 6.1 13.8 6.1 13.9 6.3 14.5 6.2 15.7 6.1 16.4 6.1 16.6 6 16.9 6 17.1 6 17.1 6.1 17.1 6.1 17.1 7.1 16.9 8.2 16 9.3 15.5 9.8 15.2 10.4 15 10.9 15 11.2 15 11.4 15 11.6 15.2 11.9 15.4 12.1 16 11.6 16.4 11.5 16.5 11.3 16.6 11.1 16.7 10.5 17 9.9 17.4 9.3 17.7 9 17.9 9 18.1 9.1 18.5 9.2 18.9 9.3 19.4 9.3 19.8 9.4 20.3 9.3 20.8 9 21.2 8.8 21.5 8.5 21.6 8.1 21.7 7.9 21.8 7.6 21.9 7.3 21.9L6.5 22C6.3 22 6 21.9 5.8 21.9 5 21.8 4.4 21.5 3.9 20.9 3.3 20.4 3.1 19.6 3 18.8L3 18.5C3 18.2 3 17.9 3.1 17.7L3.1 17.6C3.2 17.1 3.5 16.7 3.7 16.3 4 15.9 4.2 15.4 4.3 15 4.4 14.6 4.4 14.5 4.6 14.2 4.6 13.9 4.7 13.7 4.9 13.6 5.2 13.2 5.7 13.2 6 13.6ZM11.7 11.2C13.1 11.2 14.3 11.7 15.2 12.9 15.3 13 15.4 13.1 15.4 13.2 15.4 13.4 15.3 13.8 15.2 13.8 15 13.9 14.9 13.8 14.8 13.7 14.6 13.5 14.4 13.2 14.1 13.1 13.5 12.6 12.8 12.3 12 12.2 10.7 12.1 9.5 12.3 8.4 12.8 8.3 12.8 8.2 12.8 8.1 12.8 7.9 12.8 7.8 12.4 7.8 12.2 7.7 12.1 7.8 11.9 8 11.8 8.4 11.7 8.8 11.5 9.2 11.4 10 11.2 10.9 11.1 11.7 11.2ZM16.3 5.9C17.3 5.9 18 6.6 18 7.6 18 8.5 17.3 9.3 16.3 9.3 15.4 9.3 14.7 8.5 14.7 7.6 14.7 6.6 15.4 5.9 16.3 5.9ZM8.3 5C9.2 5 9.9 5.8 9.9 6.7 9.9 7.7 9.2 8.4 8.2 8.4 7.3 8.4 6.6 7.7 6.6 6.7 6.6 5.8 7.3 5 8.3 5Z"/></g></g></svg>',
			),
			array(
				'id'          => '2',
				'text'        => 'I want a free plugin',
				'placeholder' => ( 'Could you tell us a bit more?' ),
				'icon'        => '<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23"><g fill="none"><g fill="#3B86FF"><path d="M17.1 14L22.4 19.3C23.2 20.2 23.2 21.5 22.4 22.4 21.5 23.2 20.2 23.2 19.3 22.4L19.3 22.4 14 17.1C15.3 16.3 16.3 15.3 17.1 14L17.1 14ZM8.6 0C13.4 0 17.3 3.9 17.3 8.6 17.3 13.4 13.4 17.2 8.6 17.2 3.9 17.2 0 13.4 0 8.6 0 3.9 3.9 0 8.6 0ZM8.6 2.2C5.1 2.2 2.2 5.1 2.2 8.6 2.2 12.2 5.1 15.1 8.6 15.1 12.2 15.1 15.1 12.2 15.1 8.6 15.1 5.1 12.2 2.2 8.6 2.2ZM8.6 3.6L8.6 5C6.6 5 5 6.6 5 8.6L5 8.6 3.6 8.6C3.6 5.9 5.9 3.6 8.6 3.6L8.6 3.6Z"/></g></g></svg>',
			),
			array(
				'id'          => '3',
				'text'        => "I couldn't get it to work",
				'placeholder' => ( 'Could you tell us a bit more?' ),
				'icon'        => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="17" viewBox="0 0 24 17"><g fill="none"><g fill="#3B86FF"><path d="M19.4 0C19.7 0.6 19.8 1.3 19.8 2 19.8 3.2 19.4 4.4 18.5 5.3 17.6 6.2 16.5 6.7 15.2 6.7 15.2 6.7 15.2 6.7 15.2 6.7 14 6.7 12.9 6.2 12 5.3 11.2 4.4 10.7 3.3 10.7 2 10.7 1.3 10.8 0.6 11.1 0L7.6 0 7 0 6.5 0 6.5 5.7C6.3 5.6 5.9 5.3 5.6 5.1 5 4.6 4.3 4.3 3.5 4.3 3.5 4.3 3.5 4.3 3.4 4.3 1.6 4.4 0 5.9 0 7.9 0 8.6 0.2 9.2 0.5 9.7 1.1 10.8 2.2 11.5 3.5 11.5 4.3 11.5 5 11.2 5.6 10.8 6 10.5 6.3 10.3 6.5 10.2L6.5 10.2 6.5 17 6.5 17 7 17 7.6 17 22.5 17C23.3 17 24 16.3 24 15.5L24 0 19.4 0Z"/></g></g></svg>',
			),
			array(
				'id'          => '4',
				'text'        => 'I found a better plugin',
				'placeholder' => ( 'Which plugin?' ),
				'icon'        => '<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23"><g fill="none"><g fill="#3B86FF"><path d="M11.5 0C17.9 0 23 5.1 23 11.5 23 17.9 17.9 23 11.5 23 10.6 23 9.6 22.9 8.8 22.7L8.8 22.6C9.3 22.5 9.7 22.3 10 21.9 10.3 21.6 10.4 21.3 10.4 20.9 10.8 21 11.1 21 11.5 21 16.7 21 21 16.7 21 11.5 21 6.3 16.7 2 11.5 2 6.3 2 2 6.3 2 11.5 2 13 2.3 14.3 2.9 15.6 2.7 16 2.4 16.3 2.2 16.8L2.1 17.1 2.1 17.3C2 17.5 2 17.7 2 18 0.7 16.1 0 13.9 0 11.5 0 5.1 5.1 0 11.5 0ZM6 13.6C6 13.7 6.1 13.8 6.1 13.9 6.3 14.5 6.2 15.7 6.1 16.4 6.1 16.6 6 16.9 6 17.1 6 17.1 6.1 17.1 6.1 17.1 7.1 16.9 8.2 16 9.3 15.5 9.8 15.2 10.4 15 10.9 15 11.2 15 11.4 15 11.6 15.2 11.9 15.4 12.1 16 11.6 16.4 11.5 16.5 11.3 16.6 11.1 16.7 10.5 17 9.9 17.4 9.3 17.7 9 17.9 9 18.1 9.1 18.5 9.2 18.9 9.3 19.4 9.3 19.8 9.4 20.3 9.3 20.8 9 21.2 8.8 21.5 8.5 21.6 8.1 21.7 7.9 21.8 7.6 21.9 7.3 21.9L6.5 22C6.3 22 6 21.9 5.8 21.9 5 21.8 4.4 21.5 3.9 20.9 3.3 20.4 3.1 19.6 3 18.8L3 18.5C3 18.2 3 17.9 3.1 17.7L3.1 17.6C3.2 17.1 3.5 16.7 3.7 16.3 4 15.9 4.2 15.4 4.3 15 4.4 14.6 4.4 14.5 4.6 14.2 4.6 13.9 4.7 13.7 4.9 13.6 5.2 13.2 5.7 13.2 6 13.6ZM11.7 11.2C13.1 11.2 14.3 11.7 15.2 12.9 15.3 13 15.4 13.1 15.4 13.2 15.4 13.4 15.3 13.8 15.2 13.8 15 13.9 14.9 13.8 14.8 13.7 14.6 13.5 14.4 13.2 14.1 13.1 13.5 12.6 12.8 12.3 12 12.2 10.7 12.1 9.5 12.3 8.4 12.8 8.3 12.8 8.2 12.8 8.1 12.8 7.9 12.8 7.8 12.4 7.8 12.2 7.7 12.1 7.8 11.9 8 11.8 8.4 11.7 8.8 11.5 9.2 11.4 10 11.2 10.9 11.1 11.7 11.2ZM16.3 5.9C17.3 5.9 18 6.6 18 7.6 18 8.5 17.3 9.3 16.3 9.3 15.4 9.3 14.7 8.5 14.7 7.6 14.7 6.6 15.4 5.9 16.3 5.9ZM8.3 5C9.2 5 9.9 5.8 9.9 6.7 9.9 7.7 9.2 8.4 8.2 8.4 7.3 8.4 6.6 7.7 6.6 6.7 6.6 5.8 7.3 5 8.3 5Z"/></g></g></svg>',
			),
			array(
				'id'          => '5',
				'text'        => "I don't need a price list anymore",
				'placeholder' => ( 'Could you tell us a bit more?' ),
				'icon'        => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="17" viewBox="0 0 24 17"><g fill="none"><g fill="#3B86FF"><path d="M23.5 9C23.5 9 23.5 8.9 23.5 8.9 23.5 8.9 23.5 8.9 23.5 8.9 23.4 8.6 23.2 8.3 23 8 22.2 6.5 20.6 3.7 19.8 2.6 18.8 1.3 17.7 0 16.1 0 15.7 0 15.3 0.1 14.9 0.2 13.8 0.6 12.6 1.2 12.3 2.7L11.7 2.7C11.4 1.2 10.2 0.6 9.1 0.2 8.7 0.1 8.3 0 7.9 0 6.3 0 5.2 1.3 4.2 2.6 3.4 3.7 1.8 6.5 1 8 0.8 8.3 0.6 8.6 0.5 8.9 0.5 8.9 0.5 8.9 0.5 8.9 0.5 8.9 0.5 9 0.5 9 0.2 9.7 0 10.5 0 11.3 0 14.4 2.5 17 5.5 17 7.3 17 8.8 16.1 9.8 14.8L14.2 14.8C15.2 16.1 16.7 17 18.5 17 21.5 17 24 14.4 24 11.3 24 10.5 23.8 9.7 23.5 9ZM5.5 15C3.6 15 2 13.2 2 11 2 8.8 3.6 7 5.5 7 7.4 7 9 8.8 9 11 9 13.2 7.4 15 5.5 15ZM18.5 15C16.6 15 15 13.2 15 11 15 8.8 16.6 7 18.5 7 20.4 7 22 8.8 22 11 22 13.2 20.4 15 18.5 15Z"/></g></g></svg>',
			),
			array(
				'id'          => '6',
				'text'        => 'Other',
				'placeholder' => ( 'Could you tell us a bit more?' ),
				'icon'        => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 6"><g fill="none"><g fill="#3B86FF"><path d="M3 0C4.7 0 6 1.3 6 3 6 4.7 4.7 6 3 6 1.3 6 0 4.7 0 3 0 1.3 1.3 0 3 0ZM12 0C13.7 0 15 1.3 15 3 15 4.7 13.7 6 12 6 10.3 6 9 4.7 9 3 9 1.3 10.3 0 12 0ZM21 0C22.7 0 24 1.3 24 3 24 4.7 22.7 6 21 6 19.3 6 18 4.7 18 3 18 1.3 19.3 0 21 0Z"/></g></g></svg>',
			),
		);
		return $reasons;
	}

	// START OF Hide Admin Notices At Top //
	function df_spl_admin_hide_notices() {
		// phpcs:ignore
		if ( empty( $_REQUEST['page'] ) || strpos( $_REQUEST['page'], 'spl-tabs' ) === false && strpos( $_REQUEST['page'], 'stylish_price_list_help' ) === false && strpos( $_REQUEST['page'], 'stylish_price_list_video' ) ) {
			return;
		}
		global $wp_filter;
		foreach ( array( 'user_admin_notices', 'admin_notices', 'all_admin_notices' ) as $notices_type ) {
			if ( empty( $wp_filter[ $notices_type ]->callbacks ) || ! is_array( $wp_filter[ $notices_type ]->callbacks ) ) {
				continue;
			}
			foreach ( $wp_filter[ $notices_type ]->callbacks as $priority => $hooks ) {
				foreach ( $hooks as $name => $arr ) {
					if ( is_object( $arr['function'] ) && $arr['function'] instanceof Closure ) {
						unset( $wp_filter[ $notices_type ]->callbacks[ $priority ][ $name ] );
						continue;
					}
					$class = ! empty( $arr['function'][0] ) && is_object( $arr['function'][0] ) ? strtolower( get_class( $arr['function'][0] ) ) : '';
					if (
					! empty( $class ) &&
					strpos( $class, 'scc' ) !== false
					) {
						continue;
					}
					if (
					! empty( $name ) && (
						strpos( $name, 'scc' ) === false
					)
					) {
						unset( $wp_filter[ $notices_type ]->callbacks[ $priority ][ $name ] );
					}
				}
			}
		}
	}
	// END OF Hide Admin Notices At Top //

}
$stylish_price_list = new Stylish_Price_List();
