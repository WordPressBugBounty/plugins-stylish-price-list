<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$spl_default_thumbnail = ''
?>
<div class="spl-wrap">
	<?php require dirname( __FILE__ ) . '/tabs-form/pricelist-form.php';
		if ( is_admin() ) {
			add_action('admin_footer', function() {
				?>
				<div class="price_wrapper action-button floating-dock-switcher df-spl-d-none">
					<div id="dock-to-bottom" title="Dock the preview pane to the bottom" data-dock-mode="bottom" role="button" onclick="handlePreviewDockMode(this, 'bottom', event)" class="use-tooltip m-0 btn" data-bs-original-title="Dock the preview pane to the bottom" aria-label="Dock the preview pane to the bottom"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-200v120h560v-120H200Zm0-80h560v-360H200v360Zm0 80v120-120Z" fill="currentColor"></path></svg></div>
					<div id="dock-to-right" title="Dock the preview pane to the right" data-dock-mode="right" role="button" onclick="handlePreviewDockMode(this, 'right', event)" class="use-tooltip m-0 btn btn-primary" data-bs-original-title="Dock the preview pane to the right" aria-label="Dock the preview pane to the right"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm440-80h120v-560H640v560Zm-80 0v-560H200v560h360Zm80 0h120-120Z" fill="currentColor"></path></svg></div>
				</div>
				<?php
			});
		}
	?>
</div>
