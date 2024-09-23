<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="price_wrapper">
<?php
require_once SPL_DIR . '/admin/tabs/views/tabs-form/logo-header.php';
?>
</div>
<style>
	#border1 {
		border: 2px black;
		-moz-box-shadow: inset 1px 1px 10px #F0F0F0;
		border-radius: 10px;
		background-color: #F8F8F8;
		padding: 15px;
		margin-left: 25px;
		margin-bottom: 15px;
		box-shadow: 0px 0px;
		max-width: 300px;
		box-shadow: 1px 1px 5px gray;
	}
	.green_dot {
		height: 16px;
		width: 16px;
		background-color: green;
		border-radius: 50%;
		display: inline-block;
		margin-left:10px;
		margin-right:20px;
	}
	.red_dot {
		height: 16px;
		width: 16px;
		background-color: red;
		border-radius: 50%;
		display: inline-block;
		margin-left:10px;
		margin-right:20px;
	}
	.yellow_dot{
		height: 16px;
		width: 16px;
		background-color: orange;
		border-radius: 50%;
		display: inline-block;
		margin-left:10px;
		margin-right:20px;
	}
</style>
<?php
global $wp_version;
$test_char   = '' . DB_CHARSET;
$php_version = phpversion();
ob_start();
phpinfo( INFO_MODULES );
$contents              = ob_get_clean();
$moduleAvailable       = strpos( $contents, 'mod_security' ) !== false;
$plugin_conflicted     = 0;
$theme_conflicted      = 0;
$plugins_detected      = '';
$wordfence_detected    = '';
$theme                 = wp_get_theme();
$spl_license_return    = get_option( 'act_ser_conn_refused' );
$license_key_activated = get_option( 'spl_license_return' );
$site_url              = site_url();
echo '<h1 style="padding-left:25px;padding-bottom:5px;padding-top:30px;font-weight:800px;"> Diagnostic </h1>';
echo '<p style="padding-left:25px;font-weight:400px;"> Please action any items in red by emailing your admin or hosting company support. You may also try emailing us a screenshot by visiting https://stylishpricelist.com/support</h1>';
echo '<h1 style="padding-left:25px;padding-bottom:5px;padding-top:30px;font-weight:800px;">SPL diagnostic for ' . $site_url . '</h1>';
$plugin_data = get_plugin_data( SPL_DIR . '/stylish-price-list.php' );
$spl_version = $plugin_data['Version'];
// SPL Version
if ( $plugin_data['Version'] ) {
	echo '<div id="border1"><span class="green_dot"></span>  <span style="font-size:1em;font-weight:bold;">SPL Version:</span>';
	echo "  $spl_version <br></div>";
}
// WP URL
if ( $site_url ) {
	echo '<div id="border1"><span class="green_dot"></span>  <span style="font-size:1em;font-weight:bold;">WP URL:</span>';
	echo "  $site_url <br></div>";
}
// Mysql version
global $wpdb;
$mysqlVersion = $wpdb->db_version();
if ( $mysqlVersion ) {
	echo '<div id="border1"><span class="green_dot"></span>  <span style="font-size:1em;font-weight:bold;">MySQL Version:</span>';
	echo "  $mysqlVersion <br></div>";
}
// curl present check
if ( in_array( 'curl', get_loaded_extensions() ) ) {
	$curl_present = 'Yes';
} else {
	$curl_present = 'No';
}
if ( $curl_present ) {
	echo '<div id="border1"><span class="green_dot"></span>  <span style="font-size:1em;font-weight:bold;">CURL Library Present:</span>';
	echo "  $curl_present <br></div>";
}
// PHP VERSION HIGHER THAN 5.0
if ( version_compare( $php_version, '7.2', '>=' ) ) {
	echo '<div id="border1"><span class="green_dot"></span>  <span style="font-size:1em;font-weight:bold;">PHP Version:</span>';
	echo "  $php_version <br></div>";
} else {
	echo '<div id="border1"><span class="red_dot"></span>  <span style="font-size:1em;font-weight:bold;">PHP Version:</span>';
	echo "  $php_version <br><BR>";
	echo 'Change your PHP level in your cPanel, or ask your hosting company to do so. <br></div>';
}
// WP VERSION HIGHER THAN 5.0
if ( version_compare( $wp_version, '5.6', '>=' ) ) {
	// WordPress version is greater than 4.3
	echo '<div id="border1"><span class="green_dot"></span> <span style="font-size:1em;font-weight:bold;">WordPress Version:</span>';
	echo "  $wp_version</div>";
} else {
	echo '<div id="border1"><span class="red_dot"></span> <span style="font-size:1em;font-weight:bold;">WordPress Version:</span>';
	echo "  $wp_version <br><br>  ";
	echo 'Please upgrade your core WP version to the latest version. Remember to always <b>BACK-UP</b> first!<br></div>';
}
// MOD SECURITY IS OFF
if ( $moduleAvailable == null ) {
	echo '<div id="border1"><span class="green_dot"></span> <span style="font-size:1em;font-weight:bold;">MOD Security:</span> Off </div> ';
} else {
	echo '<div id="border1"><span class="red_dot"></span> <span style="font-size:1em;font-weight:bold;">MOD Security:</span>';
	echo "  $moduleAvailable <br> </div>";
}
// Check if any plugins are conflicted
if ( is_plugin_active( 'siteorigin-panels/siteorigin-panels.php' ) ) {
	$plugin_conflicted = $plugin_conflicted + 1;
	$plugins_detected  = 'Page Builder by SiteOrigin';
}
// Check If beacer page builder Activated
if ( is_plugin_active( 'beaver-builder-lite-version/fl-builder.php' ) ) {
	$plugin_conflicted = $plugin_conflicted + 1;
	$plugins_detected  = 'WordPress Page Builder � Beaver Builder';
}
// Check If wordfence Activated
if ( is_plugin_active( 'wordfence/wordfence.php' ) ) {
	$plugin_conflicted  = $plugin_conflicted + 1;
	$wordfence_detected = 'Wordfence Security';
}
if ( $plugin_conflicted == null ) {
	echo '<div id="border1"><span class="green_dot"></span> <span style="font-size:1em;font-weight:bold;">Conflicted Plugins:</span> None </div>';
} else {
	if ( $wordfence_detected == 'Wordfence Security' && ( $plugins_detected == 'Page Builder by SiteOrigin' || $plugins_detected == 'WordPress Page Builder � Beaver Builder' ) ) {
		echo '<div id="border1"><span class="yellow_dot"></span> <span style="font-size:1em;font-weight:bold;">Conflicted Plugins:</span>';
		echo " $plugin_conflicted<br><br>";
		echo 'Warning: You�re using a page builder. Please make sure you�re using the correct container size and widget to add our shortcode to.</br>';
		echo 'Warning: Detected WordFence plugin. This does not usually cause a problem with Stylish Price List, but could be a problem. If you are having issues, try disabling WordFence to see if it fixes the issue.<br>';
		echo '</div>';
	} elseif ( $wordfence_detected == 'Wordfence Security' && $plugins_detected == null ) {
		echo '<div id="border1"><span class="yellow_dot"></span> <span style="font-size:1em;font-weight:bold;">Conflicted Plugins:</span>';
		echo " $plugin_conflicted<br><Br>";
		echo 'Warning: Detected WordFence plugin. This does not usually cause a problem with Stylish Price List, but could be a problem. If you are having issues, try disabling WordFence to see if it fixes the issue.<br>';
		echo '</div>';
	} else {
		echo '<div id="border1"><span class="yellow_dot"></span> <span style="font-size:1em;font-weight:bold;">Conflicted Plugins:</span>';
		echo " $plugin_conflicted<br>";
		echo 'Warning: You�re using a page builder. Please make sure you�re using the correct container size and widget to add our shortcode to.';
		echo '</div>';
	}
}
if ( $spl_license_return == 'connection refused' && $license_key_activated != 1 ) {
	echo '<div id="border1"><span class="red_dot"></span> <span style="font-size:1em;font-weight:bold;">Pingback to server:</span>';
	echo 'Cannot ping our activation server. Ask hosting company to add our I.P to the whitelist. IP = 172.67.182.34 and IP = 104.21.32.13';
	echo '</div>';
} else {
	echo '<div id="border1"><span class="green_dot"></span> <span style="font-size:1em;font-weight:bold;">Pingback to server:</span> Successful';
	echo '</div>';
}
if ( $test_char == 'utf8mb4' ) {
	echo '<div id="border1"><span class="green_dot"></span> <span style="font-size:1em;font-weight:bold;">Charset:</span>';
	echo " $test_char";
	echo '</div>';
} elseif ( $test_char == 'utf8' ) {
	echo '<div id="border1"><span class="yellow_dot"></span> <span style="font-size:1em;font-weight:bold;">Charset:</span>';
	echo " $test_char";
	echo '<br><Br>Suggestion: You should edit the DB_CHARSET variable in your wp_config.php file to utf8mb4';
	echo '</div>';
} else {
	echo '<div id="border1"><span class="red_dot"></span> <span style="font-size:1em;font-weight:bold;">Charset:</span>';
	echo " $test_char";
	echo '<br><Br>Warning: You should edit the DB_CHARSET variable in your wp_config.php file to utf8mb4';
	echo '</div>';
}
if ( ini_get( 'max_input_vars' ) < 2000 ) {
	echo '<div id="border1"><span class="yellow_dot"></span> <span style="font-size:1em;font-weight:bold;">Max Input Variable:</span>';
	echo " $test_char";
	echo '<br><Br>Warning: If you have large lists of items, consider raising the <a target="_blank" href="https://www.a2hosting.com/kb/developer-corner/php/using-php.ini-directives/php-max-input-vars-directive"><b>maximum number of input variables</b></a>';
	echo '</div>';
}
//if($theme == 'Divi'){
 //   $theme_conflicted = $theme_conflicted + 1;
//}
// Check if any themes are conflicted
 // if ($theme_conflicted== NULL){
	//  echo '<div id="border1"><span class="green_dot"></span> <span style="font-size:1em;font-weight:bold;">Conflicted Theme:</span> None </div>';
	//}else{
	//  echo '<div id="border1"><span class="red_dot"></span> <span style="font-size:1em;font-weight:bold;">Conflicted Theme:</span> '. $theme. '<br></div>';
	 //   echo "The theme you have that might conflict are: $theme";
//  }
?>
<?php
require_once SPL_DIR . '/admin/tabs/views/tabs-form/logo-footer.php';
?>
