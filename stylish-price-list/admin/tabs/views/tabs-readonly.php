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
	<?php
	$refer = array();
	if ( isset( $item->refer ) ) {
		$raw_refer = $item->refer;
		if ( is_array( $raw_refer ) ) {
			$refer = $raw_refer;
		} elseif ( is_string( $raw_refer ) && $raw_refer !== '' ) {
			$json = json_decode( $raw_refer, true );
			if ( json_last_error() === JSON_ERROR_NONE && is_array( $json ) ) {
				$refer = $json;
			} elseif ( function_exists( 'is_serialized' ) && is_serialized( $raw_refer ) ) {
				$unserialized = @unserialize( $raw_refer, array( 'allowed_classes' => false ) );
				if ( is_array( $unserialized ) ) {
					$refer = $unserialized;
				}
			}
		}
	}
	?>
	<table>
		<tbody>
			<?php foreach ( (array) $refer as $key => $value ) : ?>
				<?php echo df_spl_row( $key, $value ); ?>
			<?php endforeach ?>
		 </tbody>
	</table>
</div>
