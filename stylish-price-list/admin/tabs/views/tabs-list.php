<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="price_wrapper">
<?php
require_once SPL_DIR . '/admin/tabs/views/tabs-form/logo-header.php';
$price_lists_page_nonce = wp_create_nonce( 'price_lists_page_nonce' );
?>
</div>
<style>
	.free_version {
		font-weight: bold;
		font-size: 17px;
	}
	.free_version span.highlighted {
		color: #5bb3a7;
	}
	span.highlighted a {
		color: #5bb3a7;
	}
</style>
<div class="wrap">
	<h2><?php esc_html_e( 'Lists', 'spl' ); ?> <a href="<?php echo esc_url(admin_url( 'admin.php?page=spl-assisted-new' )); ?>" class="add-new-h2"><?php esc_html_e( 'Add New', 'spl' ); ?></a></h2>
	<?php 
		// phpcs:ignore
		if ( array_key_exists( 'error', $_GET ) ) : ?>
		<div class="notice notice-error"><p><?php 
		 // phpcs:ignore
		 esc_html_e( $_GET['error'], 'text_domain' ); ?></p></div>
	<?php endif; ?>
	<?php 
		// phpcs:ignore
		if ( array_key_exists( 'success', $_GET ) ) : ?>
		<div class="notice notice-success"><p><?php 
		 // phpcs:ignore
		 esc_html_e( $_GET['success'], 'text_domain' ); ?></p></div>
	<?php endif; ?>
			 <form method="post">
			<input type="hidden" name="page" value="ttest_list_table">
			<?php
			$list_table = new Stylish_Price_List_Tabs_List( $price_lists_page_nonce );
			$list_table->prepare_items();
			// $list_table->search_box( 'search', 's' );
			$list_table->display();
			?>
		</form>
	</div>
	<?php
	require_once SPL_DIR . '/admin/tabs/views/tabs-form/logo-footer.php';
	?>
