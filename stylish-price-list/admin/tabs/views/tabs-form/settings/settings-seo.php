<?php
$enable_seo_jsonld = isset( $cats_data['enable_seo_jsonld'] ) ? $cats_data['enable_seo_jsonld'] : '';
$checked           = ($enable_seo_jsonld == 1) ? 'checked' : '';
?>
<div class="spl-settings-container hide-settings" id="settings-seo">
<div class="spl_flex_1 spl_overflowY custom-scrollbar">
    <div class="spl_padding_8">
        <div>
            <div class="spl_space_1">
                <h3 class="spl-text-sm spl_font_semibold spl_txt_zinc_900 uppercase spl_tracking_wider">SEO Settings</h3>
                <div>
                    <div class="flex spl_items_center justify-between spl_p_y_1">
                        <label class="spl-text-sm spl_text_7"><?php echo esc_attr($enable_product_seo_schema); ?><span class="category_tab_button" style="color:red"></span>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="info icon" title="Activating this feature will create product-specific SEO code, helping search engines understand your products better and rank them higher in search results."/>
                        </label>
                         <button class="settings-checkbox-btn">
                            <div class="settingsCheckbox <?php echo $checked;?>" data-name="enable_seo_jsonld"></div>
                        </button>
                         <input type="hidden" name="enable_seo_jsonld" value="<?php echo $enable_seo_jsonld;?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

 
