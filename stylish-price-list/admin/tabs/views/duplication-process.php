<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// only accessible to admin
if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
	return;
}
// verify nonce for price_lists_page_nonce
// phpcs:ignore
if ( ! isset( $_GET['nonce'] ) || ! wp_verify_nonce( sanitize_text_field($_GET['nonce']), 'price_lists_page_nonce' ) ) {
	wp_die('The page you are trying to access is not available.');
	return;
}
$rand_num = rand( (int) 1000000000, (int) 9999999999 );
// phpcs:ignore
if ( isset( $_GET['id'] ) && intval($_GET['id']) ) {
	$cats_data         = df_spl_get_option( $id );
	$data              = $cats_data;
	$data['list_name'] = $data['list_name'] . ' (copy)';
	$data['field_id']  = $rand_num;
	$data['id']        = $rand_num;
	$updateStatus      = update_option( 'spl_cats_' . $rand_num, $data );
}
if ( $updateStatus ) {
	$url = admin_url() . 'admin.php?page=spl-tabs&action=edit&id=' . $rand_num;
	header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
	?>
	<meta http-equiv ="refresh" content ="2; url = <?php echo esc_url($url); ?>" />
	<div class="wrap">
		<h2 style="text-align: center;">Creating a duplicate. Please wait...</h2>
	</div>
	<?php
} else {
	?>
	<div class="wrap">
		<h2 style="text-align: center;">
			There has been an error. Please try again.
		</h2>
	</div>
	<?php
}
?>
