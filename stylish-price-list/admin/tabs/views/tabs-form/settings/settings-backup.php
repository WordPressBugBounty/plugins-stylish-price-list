<div class="spl-settings-container hide-settings" id="settings-backup">
<div class="spl_flex_1 spl_overflowY custom-scrollbar">
    <div class="spl_padding_8">
        <div>
            <div class="spl_space_1">
                <h3 class="spl-text-sm spl_font_semibold spl_txt_zinc_900 uppercase spl_tracking_wider">Backup &amp; Restore</h3>
                <div>
                    <div class="spl_space_1">
                        <button style="cursor: pointer;" class="backup spl_w_full spl_py_2 spl_px_4 spl_bg_zinc_9 text-white spl_rounded_lg spl-text-sm spl_font_medium transition-colors"
                        id="splButtom" type="button" name="backup" value=""
						 	data-action="<?php echo esc_url( admin_url( 'admin-post.php' ) . '?action=spl_generate_backup' ); ?>"
							data-list-id="<?php echo htmlentities( $id ); ?>"
							data-list-name="<?php echo urlencode( htmlspecialchars( $list_name ) ); ?>"
							data-nonce="<?php echo wp_create_nonce( 'spl_backup_nonce' ); ?>"
                        ><i class="fa fa-file" aria-hidden="true" style="font-size:18px;margin-right:5px;color:#6B6B6B"></i><?php echo esc_attr($Backup); ?></button>
                        <div class="relative">
                            <input accept=".json" class="opacity-0" type="file" style="position: absolute;">
                            <button style="cursor: pointer;" class="restore spl_m_1 spl_w_full spl_py_2 spl_px_4 spl_bg_white spl_border spl_border_zinc_300 text-zinc-700 spl_rounded_lg spl-text-sm spl_font_medium transition-colors" id="splButtomRest" type="button" name="restore">
                                <img src="<?php echo SPL_URL . '/assets/images/ICON22.svg'; ?>" aria-hidden="true" style="font-size:20px; vertical-align:middle;"> 
                                <?php echo esc_attr($Restore); ?></button>
                        </div>
                    </div>
                </div>
            </div>

			<div class="df-spl-row restore_content" style="display:none">
			<div class="col-md-12 backup-btn-wrapper">
				<div class="back-up">
						<input type="file" name="importtocsv" id="fileupload" class="spl_restore_fileupload" accept=".csv" form="spl_restore_backup_form">
						<div class="spl_restore_progress" aria-live="polite" style="display:none;">
							<i class="gg-spinner" aria-hidden="true"></i>
							<span><?php echo esc_html__( 'Restoring backup. Please wait...', 'spl' ); ?></span>
						</div>
				</div>
			</div>
		
		</div>

        </div>
    </div>
</div>
</div>

 
