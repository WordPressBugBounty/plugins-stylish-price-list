<?php
$currency_symbol = false;
$enable_qr_code = false;

function license_page_script() {
?>
<script>
    const handleLicenseBtn = async ($this, evt) => {
		evt.preventDefault();

		const action = $this.getAttribute('data-action');
		const form = document.querySelector('.license-right-form');
		const licenseInputValue = document.getElementById('license_input').value.trim();

		const formData = new FormData();
		formData.append('action', 'spl_handle_license');
		formData.append('_action', action);
		formData.append('_nonce', form.querySelector('[name="_nonce"]').value);
		formData.append('license_key', licenseInputValue);

		const response = await fetch(ajaxurl, {
			method: 'POST',
			body: formData,
		});

		const result = await response.json();

		if (result.success) {
			document.getElementById('spl_license_message').innerHTML = result.data.message;
		} else {
			document.getElementById('spl_license_message').innerHTML = result.data.message;
		}
};
</script>
<?php
}

$stylishpl_license_key = get_option( 'stylishpl_license_key' );
$license               = ['status' => 'activate', 'expiry_days' => 301];
$opt                   = get_option( 'spllk_opt' ); 
$action = empty( $opt ) || ( isset( $opt['license'] ) && $opt['license'] !== 'valid' ) ? 'active' : 'deactivate';
license_page_script();

$cats_data = df_spl_get_option( $id, 'editor' );
?>
<?php
if ( ! function_exists( 'spl_settings_select' ) ) {
	function spl_settings_select( $name, $options = array(), $current_value = '' ) {
		ob_start();
		?>
		<select name="<?php echo esc_attr($name); ?>" class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all">
				<?php foreach ( $options as $value => $label ) : ?>
					<?php
					$selected = '';
					if ( $current_value == $value ) {
						$selected = ' selected="selected"';
					}
					if ( $current_value == '' ) {
						if ( $label == 'Open Sans' ) {
							$selected = ' selected="selected"';
						}
					}
					?>
				<option value="<?php echo esc_attr($value); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_attr($label); ?></option>
			<?php endforeach ?>
		</select>
		<?php
		$html = ob_get_clean();
		return $html;
	}
}

if ( ! function_exists( 'spl_settings_color_out' ) ) {
	function spl_settings_color_out( $id, $value = '', $title = '' ) {
		ob_start();
		?>
		<input hidden type="text" name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($value); ?>" title="<?php echo esc_attr($title); ?>">
	    <toolcool-color-picker button-width="5rem" button-height="2.5rem" data-target="<?php echo esc_attr($id); ?>" color="<?php echo esc_attr($value); ?>"></toolcool-color-picker>
        <?php
		$html = ob_get_clean();
		return $html;
	}
}
?>
<!-- Settings Modal -->
<div id="settingsModal" class="modalsupport">
    <div class="scc-modal-content-support">
        <div class="flex items-center justify-between spl_border_b spl_border_zinc_100  flex-shrink-0">
			<h2 class="spl_text_2xl font-bold text-zinc-900">Price List Settings</h2>
			<span class="closesupport"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x w-6 h-6 text-zinc-500" aria-hidden="true">
					<path d="M18 6 6 18"></path>
					<path d="m6 6 12 12"></path>
				</svg></span>
		</div>
        <div class="spl-settings w-48 flex-shrink-0  pr-4 space-y-1 spl_overflowY custom-scrollbar">
	    <div class="settings-left spl_border_r spl_border_zinc_2 spl_pt_1">
	    <ul class="spl-ul-settings">
		<li>
		<button class="spl-button-settings hover:spl_bg_zinc_50 hover:spl_txt_zinc_900 spl_checked" id="settingsGeneral">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard w-4 h-4" aria-hidden="true">
		<rect width="7" height="9" x="3" y="3" rx="1"></rect>
		<rect width="7" height="5" x="14" y="3" rx="1"></rect>
		<rect width="7" height="9" x="14" y="12" rx="1"></rect>
		<rect width="7" height="5" x="3" y="16" rx="1"></rect></svg>
		<span style="padding-top: 2px;">General</span>
	    </button>
        </li>
		
		<li>
		<button class="spl-button-settings hover:spl_bg_zinc_50 hover:spl_txt_zinc_900" id="settingsLayout">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-columns2 lucide-columns-2 w-4 h-4" aria-hidden="true">
		<rect width="18" height="18" x="3" y="3" rx="2"></rect>
		<path d="M12 3v18"></path></svg>
		<span style="padding-top: 2px;">Layout</span>
	    </button>
        </li>
		<li>
		<button class="spl-button-settings hover:spl_bg_zinc_50 hover:spl_txt_zinc_900" id="settingsCategories">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-tree w-4 h-4" aria-hidden="true">
		<path d="M20 10a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1h-2.5a1 1 0 0 1-.8-.4l-.9-1.2A1 1 0 0 0 15 3h-2a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1Z"></path>
		<path d="M20 21a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-2.9a1 1 0 0 1-.88-.55l-.42-.85a1 1 0 0 0-.92-.6H13a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1Z"></path><path d="M3 5a2 2 0 0 0 2 2h3"></path>
		<path d="M3 3v13a2 2 0 0 0 2 2h3"></path>
	    </svg>
		<span style="padding-top: 2px;">Categories</span>
	    </button>
        </li>
		<li>
		<button class="spl-button-settings hover:spl_bg_zinc_50 hover:spl_txt_zinc_900" id="settingsFeatures">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles w-4 h-4" aria-hidden="true"><path d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z"></path><path d="M20 2v4"></path><path d="M22 4h-4"></path><circle cx="4" cy="20" r="2"></circle>
	    </svg><span style="padding-top: 2px;">Features</span>
        </button>
        </li>
		<?php if ($enable_qr_code ) { ?>
		<li>
		<button class="spl-button-settings hover:spl_bg_zinc_50 hover:spl_txt_zinc_900" id="settingsQrCode">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-qr-code w-4 h-4" aria-hidden="true"><rect width="5" height="5" x="3" y="3" rx="1"></rect>
		<rect width="5" height="5" x="16" y="3" rx="1"></rect>
		<rect width="5" height="5" x="3" y="16" rx="1"></rect>
		<path d="M21 16h-3a2 2 0 0 0-2 2v3"></path>
		<path d="M21 21v.01"></path>
		<path d="M12 7v3a2 2 0 0 1-2 2H7"></path><path d="M3 12h.01"></path>
		
		<path d="M12 3h.01"></path><path d="M12 16v.01"></path>
		<path d="M16 12h1"></path><path d="M21 12v.01"></path>
		<path d="M12 21v-1"></path></svg>
		<span style="padding-top: 2px;">QR Code</span>
	     </button>

		</li>
		<?php } ?>
		<li>
		<button class="spl-button-settings hover:spl_bg_zinc_50 hover:spl_txt_zinc_900" id="settingsSEO">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-4 h-4" aria-hidden="true">
				<path d="m21 21-4.34-4.34"></path><circle cx="11" cy="11" r="8"></circle></svg>
				<span style="padding-top: 2px;">SEO</span>
		</button>

		</li><li>
		<button class="spl-button-settings hover:spl_bg_zinc_50 hover:spl_txt_zinc_900" id="settingsFonts">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-type w-4 h-4" aria-hidden="true">
				<path d="M12 4v16"></path>
				<path d="M4 7V5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2"></path>
				<path d="M9 20h6"></path>
		</svg>
		<span style="padding-top: 2px;">Fonts</span></button>

		</li><li>
		<button class="spl-button-settings hover:spl_bg_zinc_50 hover:spl_txt_zinc_900" id="settingsBackup">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-database w-4 h-4" aria-hidden="true"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M3 5V19A9 3 0 0 0 21 19V5"></path><path d="M3 12A9 3 0 0 0 21 12"></path>
		</svg>
		<span style="padding-top: 2px;">Backup/Restore</span>
	</button>

		</li><li>
		<button class="spl-button-settings hover:spl_bg_zinc_50 hover:spl_txt_zinc_900" id="settingsGlobal">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings2 lucide-settings-2 w-4 h-4" aria-hidden="true">
				<path d="M14 17H5"></path>
				<path d="M19 7h-9"></path>
				<circle cx="17" cy="17" r="3"></circle>
				<circle cx="7" cy="7" r="3"></circle></svg>
				<span style="padding-top: 2px;">Global Settings</span>
		</button>
		
		</li><li>
		<button class="spl-button-settings hover:spl_bg_zinc_50 hover:spl_txt_zinc_900" id="settingsLicense">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-key w-4 h-4" aria-hidden="true">
				<path d="m15.5 7.5 2.3 2.3a1 1 0 0 0 1.4 0l2.1-2.1a1 1 0 0 0 0-1.4L19 4"></path>
				<path d="m21 2-9.6 9.6"></path>
			    <circle cx="7.5" cy="15.5" r="5.5"></circle>
		    </svg>
		    <span style="padding-top: 2px;">License</span>
	    </button>
        </li>
        </ul>
        </div>

		<div class="settings-right">
		    <?php include 'settings-general.php'; ?>
            <?php include 'settings-layout.php';  ?>
            <?php include 'settings-categories.php';  ?>
			<?php include 'settings-features.php';  ?>
			<?php if ( $enable_qr_code ) { include 'settings-qrcode.php';  } ?>
			<?php include 'settings-seo.php';  ?>
			<?php include 'settings-fonts.php';  ?>
			<?php include 'settings-backup.php';  ?>
			<?php include 'settings-global.php';  ?>
			<?php include 'settings-license.php';  ?>
		
	    <input type="hidden" name="field_id" class="form-control" value="<?php  esc_html_e( $id, 'text_domain' ); ?>">
		<?php wp_nonce_field( 'spl_nonce' ); ?>
		<input type="hidden" name="spl_nonce" value="<?php echo wp_create_nonce( 'spl_nonce' ); ?>">
        <input type="submit" name="submit_tabs" id="submit_tabs" class="button button-primary" value="💾 Save" style="display: none;">
	    </div> 
    </div>

	<div class="spl-settings-modal-footer spl_p_8 spl_border_t spl_border_zinc_200 spl_bg_zinc_50 flex-shrink-0">
		<div class="flex align-items-center justify-between spl_gap_3">
			<div class="flex align-items-center spl_gap_2">
				<div class="spl_w_8 spl_h_8 spl_bg_zinc_9 spl_rounded flex align-items-center justify-center text-white font-bold spl_text_logo">S</div>
				<span class="spl_text_xl spl_font_semibold spl_txt_zinc_900">STYLISH PRICE LIST</span>
			</div>
			<div class="spl-settings-modal-footer-actions">
				<div class="spl_text_xs spl_txt_zinc_500">© 2026 Stylish Price List. All rights reserved.</div>
				<button type="button" class="btn-save spl_rounded_lg spl-settings-save-btn" onclick="javascript:return splHandleFormSubmit(this, event)">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-save w-4 h-4" aria-hidden="true"><path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"></path><path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7"></path><path d="M7 3v4a1 1 0 0 0 1 1h7"></path></svg>
					<span><?php echo esc_html( isset( $Save ) ? $Save : 'Save' ); ?></span>
				</button>
			</div>
		</div>
	</div>
    </div>
</div>
