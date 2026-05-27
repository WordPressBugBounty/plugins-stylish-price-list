<div class="spl-settings-container hide-settings" id="settings-layout">

<div class="spl_flex_1 spl_overflowY custom-scrollbar">
    <div class="spl_padding_8"><div>
        <div class="spl_space_1">
            <h3 class="spl-text-sm spl_font_semibold spl_txt_zinc_900 uppercase spl_tracking_wider">Columns Settings</h3>
            <div>
                <div class="spl_space_0375">
                    <label for="select_lang"><?php echo esc_attr($Select_Column); ?></label>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title='Set the number of columns'/>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/one-two-columns.png'); ?>"/>
                    <select class="form-control" id="select_column" name="select_column">
                        <option><?php echo ( isset( $style ) && $style === 'style_3' ) ? "Three" : esc_attr($Select_Column); ?></option>
                        <option  value="One" 
                        <?php
                        if ( isset( $cats_data1['select_column'] ) && $cats_data1['select_column'] == 'One' ) {
                            echo 'selected'; }
                        ?>
                        >One</option>
                        <option  value="Two" 
                        <?php
                        if ( isset( $cats_data1['select_column'] ) && $cats_data1['select_column'] == 'Two' ) {
                            echo 'selected'; }
                        ?>
                        >Two</option>
                    </select>
                </div>
                <div class="spl_space_0375 ">
                    <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"><?php echo esc_attr($Max_Width); ?></label>
                    <input class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900 spl_transition_all" type="text" name="spl_container_max_width" placeholder="Example : 1200px" value="<?php echo isset( $cats_data['spl_container_max_width'] ) ? $cats_data['spl_container_max_width'] : ''; ?>" id="spl_container_max_width">
                </div>
            </div>
        </div>
        <div class="spl_space_1">
            <h3 class="spl_m_h3 spl-text-sm spl_font_semibold spl_txt_zinc_900 uppercase spl_tracking_wider">Title Settings</h3>
        <div>
            <div class="flex spl_items_center justify-between spl_p_y_1">
                <div><label for="remove_title_tab"><?php echo esc_attr($Remove_title); ?> ? </label>
				<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Enabling this option makes the title at the top of the price-list go away."/>
				<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/title-switch.png'); ?>"/>
                </div> 
                <button class="settings-checkbox-btn">
                <?php $spl_remove_title = isset( $cats_data['spl_remove_title'] ) ? $cats_data['spl_remove_title'] : ''; 
                $checked = ($spl_remove_title == 1) ? 'checked' : '';
                ?>    
                    <div data-name="spl_remove_title" class="settingsCheckbox <?php echo $checked;?>" data-checked="NO" data-unchecked="YES"></div>
                </button>
                
                <input type="hidden" name="spl_remove_title" value="<?php echo $spl_remove_title;?>" />
            </div>
            <div class="spl_space_0375"> 
                <h3 class="spl_m_h3 spl-text-sm spl_font_semibold spl_txt_zinc_900 uppercase spl_tracking_wider">Break Title of Service
                <img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Enabling this adds padding to the items under the 
				list category titles. It helps break the title from the items.
				Works on Style 4 only."/>
				<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/break-line.png'); ?>"/>
                </h3>
                <?php
				$brack_title_desktop = isset( $cats_data['brack_title_desktop'] ) ? $cats_data['brack_title_desktop'] : 0;
				$checked = ($brack_title_desktop != '' && $brack_title_desktop == 1) ? 'checked' : '';
                ?>

                <div class="flex spl_items_center justify-between spl_p_y_1">
                <label for="remove_title_tab"><?php echo esc_attr($Break_line_of_categories_on_Desktop); ?></label>
                    <button class="settings-checkbox-btn">
                    <div class="settingsCheckbox <?php echo $checked;?>" data-name="brack_title_desktop"></div>
                </button>
                <input type="hidden" name="brack_title_desktop" value="<?php echo $brack_title_desktop;?>" />
                </div>

                <?php
                $brack_title_tablets = isset( $cats_data['brack_title_tablets'] ) ? $cats_data['brack_title_tablets'] : 0;
                $checked = ($brack_title_tablets != '' && $brack_title_tablets == 1) ? 'checked' : '';
                ?>

                <div class="flex spl_items_center justify-between spl_p_y_1">
                    <label for="remove_title_tab"><?php echo esc_attr($Break_line_of_categories_on_Tablets); ?></label>
                        <button class="settings-checkbox-btn">
                        <div class="settingsCheckbox <?php echo $checked;?>" data-name="brack_title_tablets"></div>
                    </button>
                    <input type="hidden" name="brack_title_tablets" value="<?php echo $brack_title_tablets;?>" />
                </div>
             </div>
        </div>
    </div>
                </div>
            </div>
        </div>


</div>
