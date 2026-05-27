<div class="spl-settings-container hide-settings" id="settings-categories">
<div class="spl_flex_1 spl_overflowY custom-scrollbar">
    <div class="spl_padding_8">
        <div>
            <div class="spl_space_1">
                <h3 class="spl-text-sm spl_font_semibold spl_txt_zinc_900 uppercase spl_tracking_wider">Category (Tab) Settings</h3>
                <div>
                    <div class="spl_space_0375 ">
                        <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"><?php echo esc_attr($Change_All_word_for_Categories); ?><br /><span class="all_tab_span">(<?php echo esc_attr($different_languages); ?>)</span>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title='Choose the word to show on the tab named "All"''/>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/all-wording.png'); ?>"/>
                   </label> 
                    <?php
                    $all_tab = isset( $cats_data['all_tab'] ) ? $cats_data['all_tab'] : '';
                    if ( $all_tab != '' && isset( $all_tab ) ) {
                        $all_tab = $all_tab;
                    } else {
                        $all_tab = 'All';
                    }
                    ?>
                        <input placeholder="" class="spl_mt_2 spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900 spl_transition_all" name="all_tab" type="text" value="<?php echo esc_attr($all_tab); ?>">
                    </div>
                    <div class="spl_space_0375">
                        <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"><?php echo esc_attr($Default_Tab); ?>
			            <img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="You can setup the default selected tab of the price-list here" /></label>
                        <select name="default_tab" class="spl_mt_2 spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900 spl_transition_all">
                       <?php
                        if ( isset( $all_tab ) && $all_tab != '' ) {
                            $all = $all_tab;
                        } else {
                            $all = 'All';
                        }
                        ?>
                        <option style="max-width:400px;" class="" value=""><?php echo esc_attr($all); ?></option>
                        <?php
                        if ( isset( $cats_data1 ) && is_array( $cats_data1 ) ) {
                            foreach ( $cats_data1['category'] as $key => $cats_datas['category'] ) {
                                if ( isset( $cats_data['default_tab'] ) && ( strtolower( $key ) == strtolower( $cats_data['default_tab'] ) ) ) {
                                    $sel = 'Selected';
                                } else {
                                    $sel = '';}
                                ?>
                            <option class="form-control default_tab 
                                <?php
                                if ( $cats_datas['category']['name'] == '' ) {
                                    echo ' hidden';}
                                ?>
                                " value="<?php echo esc_attr($key); ?>" <?php echo esc_attr($sel); ?>><?php echo esc_attr($cate_name = $cats_datas['category']['name']); ?></option>
                                <?php
                            }
                        }
                        ?>
                </select>
                    </div>
                    <?php
                        $toggle_all_tab = isset( $cats_data['toggle_all_tab'] ) ? $cats_data['toggle_all_tab'] : '';
                        $checked = ($toggle_all_tab == 1) ? 'checked' : '';
			        ?>
                    <div class="flex spl_items_center justify-between spl_p_y_1">
                        <label for="category_tab_button"><?php echo esc_attr($Display_the_All_word); ?>
                        <span class="all_tab_span" style="color:red"></span> 
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title='Choose if the category tab called "All" should be shown/hidden.'/>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/remove-all-tab.png'); ?>"/>
                        </label>
                        <button class="settings-checkbox-btn">
                            <div class="settingsCheckbox <?php echo $checked;?>" data-name="toggle_all_tab"></div>
                        </button>
                        <input type="hidden" name="toggle_all_tab" value="<?php echo $toggle_all_tab;?>" />
                    </div>
                    <br />
                    <div class="spl_space_0375">
                        <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"><?php echo esc_attr($Style4_Divider_Style); ?></label>
                        <?php
                        $style4_divider_style = isset( $cats_data['style4_divider_style'] ) ? $cats_data['style4_divider_style'] : 0;
                        ?>
                        <select style="max-width:400px" class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900 spl_transition_all" name="style4_divider_style">
                            <option style="max-width:400px;" class="form-control default_tab" <?php echo selected( $style4_divider_style, '0' )  ?> value="0">Line Divider</option>
                            <option style="max-width:400px;" class="form-control default_tab" <?php echo selected( $style4_divider_style, '1' )  ?> value="1">Dotted Divider</option>
                        </select>
                    
                    </div>
                     <?php
                            $category_desc_embed_to_cover_image_s10 = isset( $cats_data['category_desc_embed_to_cover_image_s10'] ) ? $cats_data['category_desc_embed_to_cover_image_s10'] : 1;
		                    if ( get_current_screen()->base == 'stylish-price-list_page_spl-tabs-new' ) {
			                    $category_desc_embed_to_cover_image_s10 = 1;
		                    }
                            $checked = ($category_desc_embed_to_cover_image_s10 == 1) ? 'checked' : '';
                            ?>
                            <div class="flex spl_items_center justify-between spl_p_y_1">
                                <label class="spl-text-sm spl_text_7"><?php echo esc_attr($Category_Separator_Symbol); ?><span class="category_separator_symbol" style="color:red"></span> 
		                            <img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Choose if you want to show a separator between the categories. Only available in Style 1"/>
		                            <img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/category-separator.png'); ?>"/>
                                </label>
                                <button class="settings-checkbox-btn">
                                    <div class="settingsCheckbox <?php echo $checked;?>" data-name="category_desc_embed_to_cover_image_s10"></div>
                                </button>
                                <input type="hidden" name="category_desc_embed_to_cover_image_s10" value="<?php echo $category_desc_embed_to_cover_image_s10;?>">
                            </div>
                        <br />
                        <div class="spl_space_0375 ">
                            <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"><?php echo esc_attr($Category_Image_Overlay_Percent); ?></label>

                             <?php
			$category_image_overlay_percent = isset( $cats_data['category_image_overlay_percent'] ) ? $cats_data['category_image_overlay_percent'] : 31;
			?>
			<input  type="number" name="category_image_overlay_percent" placeholder="%" value=<?php echo intval( $category_image_overlay_percent ) ?> class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all">

                       </div>
                           <?php
                            $toggle    = isset( $cats_data['toggle'] ) ? $cats_data['toggle'] : '';
		                    $checked   = ($toggle) ? 'checked' : '';
		                    ?>
                            <div class="flex spl_items_center justify-between spl_p_y_1">
                               <label for="default_tab"><?php echo esc_attr($Category_Separator_Symbol); ?><span class="category_separator_symbol" style="color:red"></span>
		                            <img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Choose if you want to show a separator between the categories. Only available in Style 1"/>
		                            <img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/category-separator.png'); ?>"/>
                                </label>
                                <button class="settings-checkbox-btn">
                                    <div class="settingsCheckbox <?php echo $checked;?>" data-name="toggle"></div>
                                </button>
                                <input type="hidden" name="toggle" value="<?php echo $toggle;?>">   
                            </div>
                            <div class="flex spl_items_center justify-between spl_p_y_1">
                                <label for="default_tab"><?php echo esc_attr($Arrange_Categories_In_Dropdown); ?><span class="category_separator_symbol" style="color:red"></span>
		                            <img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Choose if you want to have the catergories show up in a dropdown choice"/>
		                            <img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/dropdown-categories.png'); ?>"/>
                                </label>
                            <?php
                            $show_dropdown = isset( $cats_data['show_dropdown'] ) ? $cats_data['show_dropdown'] : '';
                            $checked       = ($show_dropdown == 1) ? 'checked' : '';
                            ?>    
                                <button class="settings-checkbox-btn">
                                    <div class="settingsCheckbox <?php echo $checked;?>" data-name="show_dropdown"></div>
                                </button>
                                <input type="hidden" name="show_dropdown" value="<?php echo $show_dropdown;?>">
                            </div>
                            <?php
                            $dropdown_mobile_no_keyboard = isset( $cats_data['dropdown_mobile_no_keyboard'] ) ? $cats_data['dropdown_mobile_no_keyboard'] : '';
                            if ( get_current_screen()->base == 'stylish-price-list_page_spl-tabs-new' ) {
                                $dropdown_mobile_no_keyboard = 1;
                            }
                            $checked       = ($dropdown_mobile_no_keyboard == 1) ? 'checked' : '';
                            ?>
                            <div class="flex spl_items_center justify-between spl_p_y_1">
                                <label for="default_tab"><?php echo esc_attr($Categories_In_Dropdown_Prevent_Keyboard_Popup); ?><span class="category_separator_symbol" style="color:red"></span>
		                            <img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Choose if you want to have the catergories show up in a dropdown choice"/>
		                            <img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/dropdown-categories.png'); ?>"/>
                                </label>
                                <button class="settings-checkbox-btn">
                                    <div class="settingsCheckbox <?php echo $checked;?>" data-name="dropdown_mobile_no_keyboard"></div>
                                </button>
                                <input type="hidden" name="dropdown_mobile_no_keyboard" value="<?php echo $dropdown_mobile_no_keyboard;?>">
                            </div>
                            <div class="flex spl_items_center justify-between spl_p_y_1">
                            <?php
                            $category_select_scrolling = isset( $cats_data['category_select_scrolling'] ) ? $cats_data['category_select_scrolling'] : '';
                            if ( get_current_screen()->base == 'stylish-price-list_page_spl-tabs-new' ) {
                                $category_select_scrolling = 1;
                            }
                            $checked       = ( $category_select_scrolling == 1 ) ? 'checked' : '';
                            ?>
                                <label class="spl-text-sm spl_text_7"><?php echo esc_attr( $category_select_scroll_effect_label_text ); ?><span class="category_separator_symbol" style="color:red"></span>
		                            <img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Enable scrolling into view of the price list while switching between categories"/></label>	
                                <button class="settings-checkbox-btn">
                                    <div class="settingsCheckbox <?php echo $checked;?>" data-name="category_select_scrolling"></div>
                                </button>
                                <input type="hidden" name="category_select_scrolling" value="<?php echo $category_select_scrolling;?>">
                            </div>
                            <div class="spl_space_0375 "><br />
                                <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"><?php echo esc_attr( $Category_Dropdown_Width ); ?></label>
                                <input name="spl_cats_dropdown_width" placeholder="Example : 100%" class="spl_mt_2 spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all" type="text" value="<?php echo isset( $cats_data['spl_cats_dropdown_width'] ) ? $cats_data['spl_cats_dropdown_width'] : '300px'; ?>">

                             </div>
                        </div>
                    </div></div></div></div>
</div>
