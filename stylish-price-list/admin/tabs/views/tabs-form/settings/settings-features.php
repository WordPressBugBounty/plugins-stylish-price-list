<div class="spl-settings-container hide-settings" id="settings-features">
<div class="spl_flex_1 spl_overflowY custom-scrollbar">
    <div class="spl_padding_8">
        <div>
            <div class="spl_space_1">
                <h3 class="spl-text-sm spl_font_semibold spl_txt_zinc_900 uppercase spl_tracking_wider">Buy Button Settings</h3>
                <div>
            <?php
			$style_buy_btn_newtab = isset( $cats_data['style_buy_btn_newtab'] ) ? $cats_data['style_buy_btn_newtab'] : 0;
			$checked              = ($style_buy_btn_newtab == 1) ? 'checked' : '';
			?>
                    <div class="flex spl_items_center justify-between spl_p_y_1">
                        <label class="spl-text-sm spl_text_7"><?php echo esc_attr($Open_Buy_Btn_Link_In_New_Tab); ?><span class="category_tab_button" style="color:red"></span>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Enabling this option will make the links under the price open in a new tab."/>
                        </label>
                        <button class="settings-checkbox-btn">
                            <div class="settingsCheckbox <?php echo $checked;?>" data-name="style_buy_btn_newtab"></div>
                        </button>
                        <input type="hidden" name="style_buy_btn_newtab" value="<?php echo $style_buy_btn_newtab;?>" />
                    </div>
                    
                </div>
            </div>
            <div class="spl_space_1">
                <h3 class="spl_m_h3 spl-text-sm spl_font_semibold spl_txt_zinc_900 uppercase spl_tracking_wider">Search &amp; Filter Feature</h3>
                <div>
            <?php
			$enable_searchbar = isset( $cats_data['enable_searchbar'] ) ? $cats_data['enable_searchbar'] : '';
			$checked          = ($enable_searchbar == 1) ? 'checked' : '';
			?>
                    <div class="flex spl_items_center justify-between spl_p_y_1">
                        <label class="spl-text-sm spl_text_7"><?php echo esc_attr($Add_Search_Bar); ?><span class="category_tab_button" style="color:red"></span>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Enabling it will add a search box at the to right side of the price-list."/>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/search-box.png'); ?>"/>
                        </label>
                        <button class="settings-checkbox-btn">
                            <div class="settingsCheckbox <?php echo $checked;?>" data-name="enable_searchbar"></div>
                        </button>
                        <input type="hidden" name="enable_searchbar" value="<?php echo $enable_searchbar;?>" />
                    </div>
                    
            <?php
			$enable_price_range_slider = isset( $cats_data['enable_price_range_slider'] ) ? $cats_data['enable_price_range_slider'] : '';
			$checked                   = ($enable_price_range_slider == 1) ? 'checked' : '';
			?>
                    <div class="flex spl_items_center justify-between spl_p_y_1">
                        <label class="spl-text-sm spl_text_7"><?php echo esc_attr($price_range_slider); ?><span class="category_tab_button" style="color:red"></span>
		<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Enabling it will add a price range filter slider at the top of the price-list."/>
                        </label>
                        <button class="settings-checkbox-btn">
                            <div class="settingsCheckbox <?php echo $checked;?>" data-name="enable_price_range_slider"></div>
                        </button>
                        <input type="hidden" name="enable_price_range_slider" value="<?php echo $enable_price_range_slider;?>" />
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>
