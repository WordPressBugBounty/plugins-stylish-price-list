<?php
$settings = get_option(
    'spl_extra_settings',
    array(
        'load-style-all-pages' => false,
    )
);
$checked = ( $settings['load-style-all-pages'] == 'on' ) ? 'checked' : '';
?>
<div class="spl-settings-container hide-settings" id="settings-global">
<div class="spl_flex_1 spl_overflowY custom-scrollbar">
    <div class="spl_padding_8">
        <div>
            <div class="spl_space_1">
                <h3 class="spl-text-sm spl_font_semibold spl_txt_zinc_900 uppercase spl_tracking_wider">Advance Settings</h3>
                <div>
                    <div class="flex spl_items_center justify-between spl_p_y_1">
                        <label class="spl-text-sm text-zinc-700">Load CSS on all pages</label>
                         <button class="settings-checkbox-btn">
                            <div class="settingsCheckbox loadStyle <?php echo $checked;?>" data-name="load-style-all-pages"></div>
                        </button> 
                        <div style="display: none;"><input type="checkbox" name="load-style-all-pages" <?php echo $checked;?> /></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

 
