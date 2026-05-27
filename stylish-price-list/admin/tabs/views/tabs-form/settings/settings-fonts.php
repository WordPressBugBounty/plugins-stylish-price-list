<div class="spl-settings-container hide-settings" id="settings-fonts">
<div class="spl_flex_1 spl_overflowY custom-scrollbar">
    <div class="spl_padding_8">
        <div class="spl_space_0375">
			<h3 class="spl-text-sm spl_font_semibold spl_txt_zinc_900 uppercase spl_tracking_wider">Font Source
			<i class="fa fa-info-circle" title="if page font is selected, stylish price list will use font used in the parent div containing it."></i>
		 </h3>
		 
			<select class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all" name="font_source" id="font_source">
				<option value="use-googlefont" <?php selected( isset( $cats_data['font_source'] ) && $cats_data['font_source'] == 'use-googlefont' ); ?>>Use Google Fonts</option>
				<option value="use-pagefont" <?php selected( isset( $cats_data['font_source'] ) && $cats_data['font_source'] == 'use-pagefont' ); ?>>Use page fonts</option>
			</select>
		</div>
	    <div>
            <br />
            <div class="spl_space_1">
                <h3 class="spl-text-sm spl_font_semibold spl_txt_zinc_900 uppercase spl_tracking_wider">Font Settings</h3>
                <div>
                    <div class="space-y-6">
                        <div class="grid spl_grid_cls_5 spl_gap_4 spl_text_xs spl_font_semibold spl_txt_zinc_500 uppercase spl_tracking_wider pb-2 spl_mb_2 spl_mt_4">
                            <div class="spl_col_span_1">Element</div>
                            <div class="spl_col_span_1">Size</div>
                            <div class="spl_col_span_1">Color</div>
                            <div class="spl_col_span_1">Style</div>
                            <div class="spl_col_span_1">Weight</div>
                        </div>
                        <div class="grid spl_grid_cls_5 spl_gap_4 spl_items_center">
                            <label class="spl-text-sm spl_font_medium spl_text_7"><?php echo esc_attr($Title); ?></label>
                            <div class="spl_space_0375 ">
                                <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                              
                                
                                <select class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all" name="title_font_size">
					  <option value=""><?php echo esc_attr($Font_Size); ?></option>
					  <?php
						for ( $i = 1; $i <= 100; $i++ ) {
							if ( $cats_data && array_key_exists( 'title_font_size', $cats_data ) ) {
								if ( $i . 'px' == $cats_data['title_font_size'] ) {
									$select_ser = 'selected';
								} else {
									$select_ser = '';
								}
							} else {
								$select_ser = '';
							}
							?>
						<option class="form-control title_font_size" value="<?php echo esc_attr($i); ?>px" <?php echo isset( $select_ser ) ? $select_ser : ''; ?>><?php echo esc_attr($i); ?>px</option>
							<?php
						}
						?>
				</select>
                            
                            
                </div>
                    <div class="spl_space_0375 "><label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                    <?php
                    if ( $title_color_top == '' ) {
                        echo spl_settings_color_out( 'title_color_top', '#000' ); }
                    ?>
                    <?php
                    if ( $title_color_top != '' ) {
                        echo spl_settings_color_out( 'title_color_top', $title_color_top ); }
                    ?>
                </div>
                <div class="spl_space_0375">
                    <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                    <?php echo spl_settings_select( 'list_name_font', $google_fonts, $list_name_font ); ?>
                </div>
                <div class="spl_space_0375">
                    <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                    <select name="title_font-weight" class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all">
                        <?php
                        foreach ( $optionArr as $key => $value ) {
                            $isSelected = ''; //added this line
                            if ( isset( $cats_data['title_font-weight'] ) && $cats_data['title_font-weight'] == $value ) {
                                $isSelected = 'selected';
                            }
                            echo '<option class="form-control title_font-weight" value="' . $value . '"' . $isSelected . '>' . str_replace( '_', ' ', $key ) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="grid spl_grid_cls_5 spl_gap_4 spl_items_center">
                <label class="spl-text-sm spl_font_medium spl_text_7"><?php echo esc_attr($Category_Tabs); ?></label>
                <div class="spl_space_0375 ">
                    <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                                
                                
                               
				<select name="tab_font_size" class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all" >
					<option class="form-control tab_size" value="">Size</option>
					<?php
					for ( $j = 1; $j <= 100; $j++ ) {
						if ( $cats_data && array_key_exists( 'tab_font_size', $cats_data ) ) {
							if ( $j . 'px' == $cats_data['tab_font_size'] ) {
								$select_ser = 'selected';
							} else {
								$select_ser = '';
							}
						} else {
							$select_ser = '';
						}
						?>
						<option class="form-control tab_font_size" value="<?php echo isset( $j ) ? $j : ''; ?>px" <?php echo isset( $select_ser ) ? $select_ser : ''; ?>><?php echo isset( $j ) ? $j : ''; ?>px</option>
						<?php
					}
					?>
				</select>

                </div><div class="spl_space_0375 ">
                    <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                    <?php
                    if ( $title_color == '' ) {
                        echo spl_settings_color_out( 'title_color', '#000', $Font_Color ); }
                    ?>
                    <?php
                    if ( $title_color != '' ) {
                        echo spl_settings_color_out( 'title_color', $title_color, $Font_Color ); }
                    ?>
                </div>
                <div class="spl_space_0375">
                    <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                    <?php echo spl_settings_select( 'title_font', $google_fonts, $title_font ); ?>
                </div>
                <div class="spl_space_0375">
                    <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                    <select class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all" name="tab_font-weight">
                        <option class="form-control tab_weight" value="">Font Weight</option>
                        <?php
                        foreach ( $optionArr as $key => $value ) {
                            $isSelected = ''; //added this line
                            if ( isset( $cats_data['tab_font-weight'] ) && $cats_data['tab_font-weight'] == $value ) {
                                $isSelected = 'selected';
                            }
                            echo '<option class="form-control tab_font-weight" value="' . $value . '"' . $isSelected . '>' . str_replace( '_', ' ', $key ) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="grid spl_grid_cls_5 spl_gap_4 spl_items_center">
                <label class="spl-text-sm spl_font_medium spl_text_7"><?php echo esc_attr($Category_description_Tabs); ?></label>
                <div class="spl_space_0375 ">
                    <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                <select class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all" name="tab_description_font_size">
                <option class="form-control tab_description_size" value="">Size</option>
                <?php
                for ( $j = 1; $j <= 100; $j++ ) {
                    if ( $cats_data && array_key_exists( 'tab_description_font_size', $cats_data ) ) {
                        if ( $j . 'px' == $cats_data['tab_description_font_size'] ) {
                            $select_ser = 'selected';
                        } else {
                            $select_ser = '';
                        }
                    } else {
                        $select_ser = '';
                    }
                    ?>
                    <option class="form-control tab_description_font_size" value="<?php echo isset( $j ) ? $j : ''; ?>px" <?php echo isset( $select_ser ) ? $select_ser : ''; ?>><?php echo isset( $j ) ? $j : ''; ?>px</option>
                    <?php
                }
                ?>
                </select>


            </div>
            <div class="spl_space_0375 ">
            <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
            <?php
		        if ( $tab_description_color == '' ) {
			        echo spl_settings_color_out( 'tab_description_color', '#000', $Font_Color ); }
		    ?>
		    <?php
		        if ( $tab_description_color != '' ) {
			        echo spl_settings_color_out( 'tab_description_color', $tab_description_color, $Font_Color ); }
		    ?>
            </div>
            <div class="spl_space_0375">
            <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
            <?php echo spl_settings_select( 'tab_description_font', $google_fonts, $tab_description_font ); ?>
            </div>
            <div class="spl_space_0375">
            <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
            <select name="tab_description_font-weight" class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all">
            <option class="form-control tab_weight" value="">Font Weight</option>
			<?php
			foreach ( $optionArr as $key => $value ) {
				   $isSelected = ''; //added this line
				if ( isset( $cats_data['tab_description_font-weight'] ) && ( $cats_data['tab_description_font-weight'] == $value ) ) {
					$isSelected = 'selected';
				}
				 echo '<option class="form-control tab_description_font-weight" value="' . $value . '"' . $isSelected . '>' . str_replace( '_', ' ', $key ) . '</option>';
			}
			?>
		    </select>
                            </div>
                        </div>
                        <div class="grid spl_grid_cls_5 spl_gap_4 spl_items_center">
                            <label class="spl-text-sm spl_font_medium spl_text_7"><?php echo esc_attr($Service_Name); ?></label>
                            <div class="spl_space_0375 ">
                                <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
            <select class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all" name="service_font_size">
                        <option class="form-control service_size" value="">Size</option>
                    <?php
                    for ( $k = 1; $k <= 100; $k++ ) {
                        if ( $cats_data && array_key_exists( 'service_font_size', $cats_data ) ) {
                            if ( $k . 'px' == $cats_data['service_font_size'] ) {
                                $select_ser = 'selected';
                            } else {
                                $select_ser = '';
                            }
                        } else {
                            $select_ser = '';
                        }
                        ?>
                    <option class="form-control service_font_size" value="<?php echo esc_attr($k); ?>px" <?php echo esc_attr($select_ser); ?>><?php echo esc_attr($k); ?>px</option>
                        <?php
                    }
                    ?>
            </select>
                    </div>
                    <div class="spl_space_0375 ">
                    <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                    <?php
                    if ( $service_color == '' ) {
                        echo spl_settings_color_out( 'service_color', '#000', $Font_Color ); }
                    ?>
                    <?php
                    if ( $service_color != '' ) {
                        echo spl_settings_color_out( 'service_color', $service_color, $Font_Color ); }
                    ?>
                    </div>
                    <div class="spl_space_0375">
                        <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                        <?php echo spl_settings_select( 'desc_font', $google_fonts, $desc_font ); ?>

                    </div>
                    <div class="spl_space_0375">
                        <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                        <select class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all" id="service-font-weight" name="service_font-weight">
                <option class="form-control service_weight" value="">Font Weight</option>
					<?php
					foreach ( $optionArr as $key => $value ) {
						$isSelected = ''; //added this line
						if ( isset( $cats_data['service_font-weight'] ) && $cats_data['service_font-weight'] == $value ) {
							$isSelected = 'selected';
						}
						echo '<option class="form-control service_font-weight" value="' . $value . '"' . $isSelected . '>' . str_replace( '_', ' ', $key ) . '</option>';
					}
					?>
		 </select>
                                
                            </div>
                        </div>
                        <div class="spl_mt_2 grid spl_grid_cls_5 spl_gap_4 spl_items_center">
                            <label class="spl-text-sm spl_font_medium spl_text_7">Item <?php echo $Hover_Color; ?></label>
                            <?php
                            if ( $hover_color == '' ) {
                                echo spl_settings_color_out( 'hover_color', '#000' ); }
                            ?>
                            <?php
                            if ( $hover_color != '' ) {
                                echo spl_settings_color_out( 'hover_color', $hover_color ); }
                            ?>

                        </div>
                    <div class="grid spl_grid_cls_5 spl_gap_4 spl_items_center">
                    <label class="spl-text-sm spl_font_medium spl_text_7"><?php echo esc_attr($Service_Price); ?></label>
                    <div class="spl_space_0375 "><label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                        <select class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all" name="service_price_font_size">
                                <option class="form-control service_price_font_size" value="">Size</option>
                                <?php
                                    for ( $n = 1; $n <= 100; $n++ ) {
                                        $change_lang_value = '';
                                        if ( $cats_data && array_key_exists( 'service_price_font_size', $cats_data ) ) {
                                            if ( $n . 'px' == $cats_data['service_price_font_size'] ) {
                                                $select_ser = 'selected';
                                            } else {
                                                $select_ser = '';
                                            }
                                        } else {
                                            $select_ser = '';
                                        }
                                        ?>
                                <option class="form-control service_price_font_size" value="<?php echo esc_attr($n); ?>px" <?php echo esc_attr($select_ser); ?>><?php echo esc_attr($n); ?>px</option>
                                        <?php
                                    }
                                    ?>
                        </select>


                    </div>
                    <div class="spl_space_0375 ">
                        <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                        <?php
                            if ( $price_color == '' ) {
                                echo spl_settings_color_out( 'price_color', '#000' ); }
                            ?>
                            <?php
                            if ( $price_color != '' ) {
                                echo spl_settings_color_out( 'price_color', $price_color ); }
                            ?>
                    </div>
                    <div class="spl_space_0375">
                        <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                        <?php echo spl_settings_select( 'price_font', $google_fonts, $price_font ); ?>
                        
                    </div>
                    <div class="spl_space_0375">
                        <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                        <select class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all" id="srv-price-font-weight" name="service_price_font-weight">
                        <option class="form-control service_price_weight" value="">Font Weight</option>
                        <?php
                        foreach ( $optionArr as $key => $value ) {
                            $isSelected = ''; //added this line
                            if ( isset( $cats_data['service_price_font-weight'] ) && ( $cats_data['service_price_font-weight'] == $value ) ) {
                                $isSelected = 'selected';
                            }
                            echo '<option class="form-control service_price_font-weight" value="' . $value . '"' . $isSelected . '>' . str_replace( '_', ' ', $key ) . '</option>';
                        }
                        ?>
                        </select>
                    </div>
                </div>
                    <div class="grid spl_grid_cls_5 spl_gap_4 spl_items_center">
                    <label class="spl-text-sm spl_font_medium spl_text_7"><?php echo esc_attr($Service_Description); ?></label>
                    <div class="spl_space_0375 "><label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                    <select class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all" name="service_description_font_size">
                    <option class="form-control service_description_font_size" value="">Size</option>
                    <?php
                        for ( $n = 1; $n <= 100; $n++ ) {
                            if ( $cats_data && array_key_exists( 'service_description_font_size', $cats_data ) ) {
                                if ( $n . 'px' == $cats_data['service_description_font_size'] ) {
                                    $select_ser = 'selected';
                                } else {
                                    $select_ser = '';
                                }
                            } else {
                                $select_ser = '';
                            }
                            ?>
                        <option class="form-control service_description_font_size" value="<?php echo esc_attr($n); ?>px" <?php echo esc_attr($select_ser); ?>><?php echo esc_attr($n); ?>px</option>
                            <?php
                        }
                        ?>
		            </select>
                    </div>
                    <div class="spl_space_0375 ">
                        <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                        <?php
                            if ( $service_description_color == '' ) {
                                echo spl_settings_color_out( 'service_description_color', '#000' ); }
                            ?>
                            <?php
                            if ( $service_description_color != '' ) {
                                echo spl_settings_color_out( 'service_description_color', $service_description_color ); }
                            ?>
                    </div>
                    <div class="spl_space_0375">
                        <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                        <?php echo spl_settings_select( 'service_description_font', $google_fonts, $service_description_font ); ?>
                        
                    </div>
                    <div class="spl_space_0375">
                        <label class="spl_text_xs spl_font_medium spl_txt_zinc_500"></label>
                        <select  class="spl_w_full spl_bg_white spl_border spl_border_zinc_200 spl_rounded_lg spl_px_3 spl_py_2 spl-text-sm spl_txt_zinc_900  spl_transition_all" id="description_font-weight" name="description_font-weight">
			<option class="form-control description_weight" value="">Font Weight</option>
			<?php
			foreach ( $optionArr as $key => $value ) {
				   $isSelected = ''; //added this line
				if ( isset( $cats_data['description_font-weight'] ) && ( $cats_data['description_font-weight'] == $value ) ) {
					$isSelected = 'selected';
				}
				 echo '<option class="form-control description_font-weight" value="' . $value . '"' . $isSelected . '>' . str_replace( '_', ' ', $key ) . '</option>';
			}
			?>
		 </select>  
            </div>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
