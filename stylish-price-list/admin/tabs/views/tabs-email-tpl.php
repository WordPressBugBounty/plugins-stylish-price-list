<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="wrap">
	<h2><?php esc_html_e( 'Tabs', 'spl' ); ?></h2>
	<?php $item = spl_get_tabs( $id ); ?>
</div>

