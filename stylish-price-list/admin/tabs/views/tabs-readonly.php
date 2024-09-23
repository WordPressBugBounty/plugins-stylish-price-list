<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
function df_spl_row( $key, $value ) {
	ob_start();
	?>
	<tr class="row-<?php echo esc_attr($key); ?>">
		<th scope="row" style="text-align: right">
			<label for="<?php echo esc_attr($key); ?>"><?php echo esc_attr($key); ?></label>
		</th>
		<td style="padding-left: 10px;">
			<?php echo esc_attr($value); ?>
		</td>
	</tr>
	<?php
	$html = ob_get_clean();
	return $html;
}
?>
<div class="wrap">
	<h2><?php esc_html_e( 'Refer', 'c9s' ); ?></h2>
	<?php // $item = df_spl_get_tabs_by_id( $id ); ?>
	<?php $refer = unserialize( $item->refer ); ?>
	<table>
		<tbody>
			<?php foreach ( $refer as $key => $value ) : ?>
				<?php echo df_spl_row( $key, $value ); ?>
			<?php endforeach ?>
		 </tbody>
	</table>
</div>
