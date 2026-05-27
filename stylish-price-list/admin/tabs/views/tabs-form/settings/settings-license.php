<div class="spl-settings-container hide-settings" id="settings-license">
<div class="spl_flex_1 spl_overflowY custom-scrollbar">
    <div class="spl_padding_8">
        <div>
            <div class="spl_space_1">
                <h3 class="spl-text-sm spl_font_semibold spl_txt_zinc_900 uppercase spl_tracking_wider">License Settings</h3>
                <div>
                    <div class="spl_bg_zinc_50 spl_p_6 spl_rounded_xl spl_border spl_border_zinc_200 spl_space_y_6">
                        <div class="text-center spl_space_y_2">
                           <div class="scc-license-intro-hero w-50 mx-auto">
								<?php if ( $action == 'active' ) { ?>
									
                                    <p>Activate Stylish Price List and start selling faster today!</p>
                                    <h3 class="spl_text_lg spl_font_semibold spl_txt_zinc_900">Do you have a License Key?</h3>
								<?php } ?>
								<?php if ( $action == 'deactivate' ) { ?>
									<h3 class="spl_m_h3 spl_text_lg spl_font_semibold spl_txt_zinc_900">Your License key has been activated</h3>
								<?php } ?>
							</div>
                        </div><div class="flex spl_gap_2">
                            <div class="spl_flex_1 relative">
                                <div class="absolute spl_inset_y_0 spl_left_0 spl_pl_3 flex spl_items_center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-key h-5 w-5 text-zinc-400" aria-hidden="true">
                                        <path d="m15.5 7.5 2.3 2.3a1 1 0 0 0 1.4 0l2.1-2.1a1 1 0 0 0 0-1.4L19 4"></path>
                                        <path d="m21 2-9.6 9.6"></path>
                                        <circle cx="7.5" cy="15.5" r="5.5"></circle>
                                    </svg>
                                </div>
                                
                                <input id="license_input" type="text" class="block spl_w_full spl_pl_10 spl_pr_3 spl_py_2 spl_border spl_border_zinc_3 spl_rounded_lg spl-text-sm"  value="<?php echo esc_attr($stylishpl_license_key); ?>"
									placeholder="<?php echo esc_attr( ( 'Enter your license key to activate' ) ); ?>" 
									<?php echo ( 'deactivate' == $action ) ? 'readonly="readonly"' : ''; ?>>
                            </div>
                            <button style="cursor: pointer;" class="spl_p_x4 spl_py_2 spl_bg_white spl_border spl_border_zinc_3 spl_rounded_lg spl-text-sm spl_font_medium spl_text_7" title="Use this button to sync the license status with the server." name="submit" data-action="refresh" onclick="handleLicenseBtn( this, event )"><span class="dashicons dashicons-update"></span>
							<i class="d-none gg-spinner-alt"></i>
                            Refresh License</button>
                        </div><div class="spl_mt_2" id="spl_license_message"></div>
                        <?php if ( $action == 'active' ): ?>
								<button style="cursor: pointer;" class="spl_button_border_none spl_w_full spl_py_2 spl_p_x4 spl_license_primary_button text-white spl_rounded_lg spl-text-sm spl_font_medium transition-colors" data-action="active" onclick="handleLicenseBtn( this, event )" type="button"><i class="d-none gg-spinner-alt"></i><span>Activate License</span></button>
							<?php endif; ?>
							<?php if ( $action == 'deactivate' ): ?>
								<button style="cursor: pointer;" class="spl_button_border_none spl_w_full spl_py_2 spl_p_x4 spl_license_primary_button text-white spl_rounded_lg spl-text-sm spl_font_medium transition-colors" data-action="deactivate" onclick="handleLicenseBtn( this, event )" type="button"><i class="d-none gg-spinner-alt"></i><span>Deactivate License</span></button>
							<?php endif; ?>
                            <?php if ( $license['status'] !== 'deactivate' ) : ?>
							<?php $show_license_expiry_message = isset( $opt['expires'] ) && $opt['expires'] != 'lifetime'; ?>
							<div class="activation-text">
								<!-- <p class="mb-0">Activations remaining</p> -->
								<?php if ( ! empty( $opt ) && in_array( $opt['license'] , array( 'valid', 'expired' ) ) ): ?>
									<?php if ( $opt['license'] == "expired" ): ?>
										<p class="spl-text-sm spl_txt_zinc_500 text-center" style="color: red;">The license has been expired.</p>
									<?php endif; ?>
									<?php if ( $show_license_expiry_message ) : ?>
										<p class="spl-text-sm spl_txt_zinc_500 text-center">The license expires on <?php echo esc_attr( gmdate( "jS \of F Y" , strtotime( $opt['expires'] ) ) ) ?></p>
									<?php endif; ?>
									<?php if ( isset( $opt['license_limit'] ) && isset( $opt['site_count'] ) ): ?>
										<p class="spl-text-sm spl_txt_zinc_500 text-center">The license key is being used on <?php echo ( intval( $opt['site_count'] ) > 1 ) ? intval( $opt['site_count'] ) . ' sites' : intval( $opt['site_count'] ) . ' site'; ?> out of <?php echo intval( $opt['license_limit'] ); ?> allowed.</p>
									<?php endif; ?>
								<?php endif; ?>
							</div>
							<div class="expiration-text">
							</div>
						<?php endif; ?>
                    </div>
                    <div class="spl_mt_6 spl_bg_zinc_50 spl_p_6 spl_rounded_xl spl_border spl_border_zinc_200 spl_space_1">
                        <h3 class="spl-text-lg spl_font_semibold spl_txt_zinc_900">Are you on a development site / want to use the license key in another website?</h3>
                        <p class="spl-text-sm spl_txt_zinc_600">The license keys can only be used on a limited number of WordPress websites. If you want to use the license key on another website, you have to deactivate it first.</p>
                        <div class="flex flex-col spl_gap_2">
                            <button style="cursor: pointer;" class="spl_button_border_none spl_w_full spl_py_2 spl_p_x4 spl_license_primary_button text-white spl_rounded_lg spl-text-sm spl_font_medium transition-colors flex spl_items_center justify-center spl_gap_2" onClick="window.open('https://designful.freshdesk.com/support/solutions/articles/48001145016-spl-migrating-to-a-new-site-tutorial-transfer-license-to-new-domain-migrate-domains-', '_blank')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard w-4 h-4" aria-hidden="true">
                                    <rect width="7" height="9" x="3" y="3" rx="1"></rect>
                                    <rect width="7" height="5" x="14" y="3" rx="1"></rect>
                                    <rect width="7" height="9" x="14" y="12" rx="1"></rect>
                                    <rect width="7" height="5" x="3" y="16" rx="1"></rect>
                                </svg> License Transfer Guide</button>
                                <button style="cursor: pointer;" class="spl_button_border_none spl_w_full spl_py_2 spl_p_x4 spl_license_primary_button text-white spl_rounded_lg spl-text-sm spl_font_medium transition-colors flex spl_items_center justify-center spl_gap_2" onClick="window.open('https://members.stylishpricelist.com/my-account/', '_blank')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-database w-4 h-4" aria-hidden="true">
                                        <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                                        <path d="M3 5V19A9 3 0 0 0 21 19V5"></path>
                                        <path d="M3 12A9 3 0 0 0 21 12"></path>
                                    </svg> Manage Membership</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
</div>
