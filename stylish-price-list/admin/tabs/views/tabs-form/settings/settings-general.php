<div class="spl-settings-container" id="settings-general">
<div class="spl_flex_1 spl_overflowY custom-scrollbar">
    <div class="spl_padding_8">
        <div>
            <div>
                <h3 class="spl-text-sm spl_font_semibold spl_txt_zinc_900 uppercase spl_tracking_wider">Dashboard Settings</h3>
                <div>
                    <div class="spl_space_0375 ">
                        <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"><?php echo esc_attr($Price_List_Name); ?></label>
                        <input class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all" type="text" name="list_name" id="list_name" maxlength="100" placeholder="<?php echo esc_attr($Price_List_Name); ?>" required="" value="<?php echo esc_attr($list_name); ?>">
                    </div>
					<?php if ($currency_symbol) { ?>
					<div class="spl_space_0375 ">
                        <label class="spl_text_xs spl_font_medium spl_txt_zinc_500">Currency Symbol</label>
                        <input placeholder="" class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all" type="text" value="$">
                    </div>
					<?php } ?>
                    <div class="spl_space_0375">
                        <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"><?php echo esc_attr($Select_Language); ?></label>
                        <select id="select_lang" name="select_lang" class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all">
                            <?php 
					// phpcs:ignore
					if ( isset( $_REQUEST['lang'] ) ) { ?>
					  <option  value="EN" 
						<?php
						// phpcs:ignore
						$language_choice = sanitize_text_field( $_REQUEST['lang'] );
						if ( $language_choice == 'EN' ) {
							echo 'selected'; }
						?>
						 >EN</option>
					  <option  value="SP" 
						<?php
						if ( $language_choice == 'SP' ) {
							echo 'selected'; }
						?>
						 >SP</option>
					  <option  value="FR" 
						<?php
						if ( $language_choice == 'FR' ) {
							echo 'selected'; }
						?>
						 >FR</option>
					  <option  value="DE" 
						<?php
						if ( $language_choice == 'DE' ) {
							echo 'selected'; }
						?>
						 >DE</option>
						<?php
					} else {
						?>
					<option  value="EN" 
						<?php
						if ( isset( $cats_data1['select_lang'] ) && $cats_data1['select_lang'] == 'EN' ) {
							echo 'selected'; }
						?>
					 >EN</option>
					<option  value="SP" 
						<?php
						if ( isset( $cats_data1['select_lang'] ) && $cats_data1['select_lang'] == 'SP' ) {
							echo 'selected'; }
						?>
					 >SP</option>
					<option  value="FR" 
						<?php
						if ( isset( $cats_data1['select_lang'] ) && $cats_data1['select_lang'] == 'FR' ) {
							echo 'selected'; }
						?>
					 >FR</option>
					<option  value="DE" 
						<?php
						if ( isset( $cats_data1['select_lang'] ) && $cats_data1['select_lang'] == 'DE' ) {
							echo 'selected'; }
						?>
					 >DE</option>
						<?php
					}
					?>
                        </select>
                    </div>
                    <!--<div class="spl_space_0375">
                        <label class="spl_text_xs spl_font_medium spl_txt_zinc_500">Template Skin</label>
                        <select name="tab_style" class="sel1 spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all">
                            <option class="form-control default_tab" value="">Select Style</option>
                                <option class="form-control default_tab spl-list-option <?php echo isset($list_type) && ($list_type == 'price_list' || $list_type == '') ? '' : 'df-spl-d-none'; ?>" value="with_tab" <?php echo isset( $style ) && $style == 'with_tab' ? 'selected' : ''; ?> >Style #1 (Supports Images)</option>
                                <option class="form-control default_tab spl-list-option <?php echo isset($list_type) && ($list_type == 'price_list' || $list_type == '') ? '' : 'df-spl-d-none'; ?>" value="without_tab" <?php echo isset( $style ) && $style == 'without_tab' ? 'selected' : ''; ?>>Style #2</option>
                                <option class="form-control default_tab spl-list-option <?php echo isset($list_type) && ($list_type == 'price_list' || $list_type == '') ? '' : 'df-spl-d-none'; ?>" value="without_tab_single_column" <?php echo isset( $style ) && $style == 'without_tab_single_column' ? 'selected' : ''; ?>>Style #2 (Single Column)</option>
                                <option class="form-control default_tab spl-list-option <?php echo isset($list_type) && ($list_type == 'price_list' || $list_type == '') ? '' : 'df-spl-d-none'; ?>" value="style_3" <?php echo isset( $style ) && $style == 'style_3' ? 'selected' : ''; ?>>Style #3</option>
                                <option class="form-control default_tab spl-list-option <?php echo isset($list_type) && ($list_type == 'price_list' || $list_type == '') ? '' : 'df-spl-d-none'; ?>" value="style_4" <?php echo isset( $style ) && $style == 'style_4' ? 'selected' : ''; ?>>Style #4</option>
                                <option class="form-control default_tab spl-list-option <?php echo isset($list_type) && ($list_type == 'price_list' || $list_type == '') ? '' : 'df-spl-d-none'; ?>" value="style_5" <?php echo isset( $style ) && $style == 'style_5' ? 'selected' : ''; ?>>Style #5</option>
                                <option class="form-control default_tab spl-list-option <?php echo isset($list_type) && ($list_type == 'price_list' || $list_type == '') ? '' : 'df-spl-d-none'; ?>" value="style_6" <?php echo isset( $style ) && $style == 'style_6' ? 'selected' : ''; ?>>Style #6 (Supports Images)</option>
                                <option class="form-control default_tab spl-list-option <?php echo isset($list_type) && ($list_type == 'price_list' || $list_type == '') ? '' : 'df-spl-d-none'; ?>" value="style_7" <?php echo isset( $style ) && $style == 'style_7' ? 'selected' : ''; ?>>Style #7</option>
                                <option class="form-control default_tab spl-list-option <?php echo isset($list_type) && ($list_type == 'price_list' || $list_type == '') ? '' : 'df-spl-d-none'; ?>" value="style_8" <?php echo isset( $style ) && $style == 'style_8' ? 'selected' : ''; ?>>Style #8 (Supports Images)</option>
                                <option class="form-control default_tab spl-list-option <?php echo isset($list_type) && ($list_type == 'price_list' || $list_type == '') ? '' : 'df-spl-d-none'; ?>" value="style_10" <?php echo isset( $style ) && $style == 'style_10' ? 'selected' : ''; ?>>Style #10</option>
                                <option class="form-control default_tab spl-table-option <?php echo isset($list_type) && ($list_type == 'pricing_table') ? '' : 'df-spl-d-none'; ?>" value="style_table_1" <?php echo ((isset( $style ) && $style == 'style_table_1') || ($list_type == 'pricing_table' && ! isset( $style ))) ? 'selected' : ''; ?>>Table Style #1</option>
                                <option class="form-control default_tab spl-table-option <?php echo isset($list_type) && ($list_type == 'pricing_table') ? '' : 'df-spl-d-none'; ?>" value="style_table_2" <?php echo isset( $style ) && $style == 'style_table_2' ? 'selected' : ''; ?>>Table Style #2</option>
									
                        </select>
                    </div>-->
                </div>
            </div>
            <div class="spl_space_1">
                <h3 class="spl_m_h3 spl-text-sm spl_font_semibold spl_txt_zinc_900 uppercase spl_tracking_wider">Misc Settings</h3>
                <div><div class="spl_space_0375">
                    <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"><?php echo stripslashes( $Price_List_Description ); ?>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Define the price-list description here."/></label>
                    <textarea rows="2" name="price_list_desc" cols="50" class="spl_mt_2 spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all min-h-[100px]"><?php
			if ( isset( $price_list_desc ) ) {
				echo str_replace( '\"', '"', str_replace( "\'", "'", stripslashes( $price_list_desc ) ) ); }
			?></textarea>
                </div>
                <div class="spl_space_0375">
                    

					<label for="all_tab"><?php echo stripslashes( $items_price_currency ); ?></label>

					<select class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all" id="jsonld_currency" name="jsonld_currency">
				<?php foreach ( DF_SPL_CURRENCIES as $key => $value ) {
					?>
					<option style="max-width:400px;" class="form-control" <?php echo selected( $jsonld_currency , $value['code'] )  ?> value="<?php echo $value['code']; ?>"><?php echo $value['currency']; ?></option>
					<?php
				} ?>
			</select>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
