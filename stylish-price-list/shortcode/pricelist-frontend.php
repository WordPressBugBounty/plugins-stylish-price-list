<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$cats                     = array();
$fonts                    = array();
$list_name_font           = '';
$title_font               = '';
$price_font               = '';
$desc_font                = '';
$service_description_font = '';
$default_tab_size         = '';


if ( ! empty( $id ) ) {
	$shortcode_id = isset( $id ) ? $id : '';
	$cats_data    = df_spl_get_option( $id );
	$style_cat_tab_btn                           = isset( $cats_data['style_cat_tab_btn'] ) ? $cats_data['style_cat_tab_btn'] : '';
	$all_tab                                     = isset( $cats_data['all_tab'] ) ? $cats_data['all_tab'] : '';
	$style                                       = isset( $cats_data['tab_style'] ) ? $cats_data['tab_style'] : '';
	$style5_category                             = isset( $cats_data['style5_category'] ) ? $cats_data['style5_category'] : '';
	$default                                     = isset( $cats_data['default_tab'] ) ? $cats_data['default_tab'] : '';
	$select_column                               = isset( $cats_data['select_column'] ) ? $cats_data['select_column'] : '';
	$list_name                                   = df_spl_remove_slash_quotes( $cats_data['list_name'] );
	$list_description                            = df_spl_remove_slash_quotes( trim( $cats_data['price_list_desc'] ) );
	$list_type                                   = isset( $cats_data['list_type'] ) ? $cats_data['list_type'] : '';
	$spl_remove_title                            = isset( $cats_data['spl_remove_title'] ) ? $cats_data['spl_remove_title'] : '';
	$hover_color                                 = isset( $cats_data['hover_color'] ) ? $cats_data['hover_color'] : '';
	$title_color                                 = isset( $cats_data['title_color'] ) ? $cats_data['title_color'] : '';
	$title_color_top                             = isset( $cats_data['title_color_top'] ) ? $cats_data['title_color_top'] : '';
	$price_color                                 = isset( $cats_data['price_color'] ) ? $cats_data['price_color'] : '';
	$title_size                                  = isset( $cats_data['title_font_size'] ) ? $cats_data['title_font_size'] : '';
	$font_source                                 = isset( $cats_data['font_source'] ) ? $cats_data['font_source'] : 'use-googlefont';
	$tab_size                                    = isset( $cats_data['tab_font_size'] ) ? $cats_data['tab_font_size'] : '';
	$is_buy_btn_newtab_enabled                   = isset( $cats_data['style_buy_btn_newtab'] ) ? $cats_data['style_buy_btn_newtab'] : 0;
	$tab_description_color                       = isset( $cats_data['tab_description_color'] ) ? $cats_data['tab_description_color'] : '';
	$tab_description_font_size                   = isset( $cats_data['tab_description_font_size'] ) ? $cats_data['tab_description_font_size'] : '';
	$tab_description_font                        = isset( $cats_data['tab_description_font'] ) ? $cats_data['tab_description_font'] : '';
	$service_size                                = isset( $cats_data['service_font_size'] ) ? $cats_data['service_font_size'] : '';
	$spl_container_max_width                     = isset( $cats_data['spl_container_max_width'] ) ? $cats_data['spl_container_max_width'] : '';
	$service_description_font_size               = isset( $cats_data['service_description_font_size'] ) ? $cats_data['service_description_font_size'] : '';
	$default_tab_size                            = isset( $cats_data['default_tab_font_size'] ) ? $cats_data['default_tab_font_size'] : '';
	$default_tab_description_font_size           = isset( $cats_data['default_tab_description_font_size'] ) ? $cats_data['default_tab_description_font_size'] : '';
	$service_color                               = isset( $cats_data['service_color'] ) ? $cats_data['service_color'] : '';
	$service_description_color                   = isset( $cats_data['service_description_color'] ) ? $cats_data['service_description_color'] : '';
	$style4_divider_style                        = isset( $cats_data['style4_divider_style'] ) ? intval( $cats_data['style4_divider_style'] ) : 0;
	$style4_divider_border_style                 = $style4_divider_style === 0 ? 'solid' : 'dashed';
	$select_price                                = isset( $cats_data['service_price_font_size'] ) ? $cats_data['service_price_font_size'] : '';
	$list_name_font                              = isset( $cats_data['list_name_font'] ) ? $cats_data['list_name_font'] : '';
	$title_font                                  = isset( $cats_data['title_font'] ) ? $cats_data['title_font'] : '';
	$price_font                                  = isset( $cats_data['price_font'] ) ? $cats_data['price_font'] : '';
	$desc_font                                   = isset( $cats_data['desc_font'] ) ? $cats_data['desc_font'] : '';
	$service_description_font                    = isset( $cats_data['service_description_font'] ) ? $cats_data['service_description_font'] : '';
	$toggle                                      = isset( $cats_data['toggle'] ) ? $cats_data['toggle'] : '';
	$show_dropdown                               = isset( $cats_data['show_dropdown'] ) ? $cats_data['show_dropdown'] : '0';
	$dropdown_mobile_no_keyboard                 = isset( $cats_data['dropdown_mobile_no_keyboard'] ) ? $cats_data['dropdown_mobile_no_keyboard'] : 0;
	$category_select_scrolling                   = isset( $cats_data['category_select_scrolling'] ) ? $cats_data['category_select_scrolling'] : 1;
	$cats_dropdown_width                         = isset( $cats_data['spl_cats_dropdown_width'] ) ? $cats_data['spl_cats_dropdown_width'] : '300px';
	$toggle_all_tab                              = isset( $cats_data['toggle_all_tab'] ) ? $cats_data['toggle_all_tab'] : '';
	$price_list_desc                             = isset( $cats_data['price_list_desc'] ) ? $cats_data['price_list_desc'] : '';
	$enable_searchbar                            = isset( $cats_data['enable_searchbar'] ) ? absint( $cats_data['enable_searchbar'] ) : 0;
	$enable_price_range_slider                   = isset( $cats_data['enable_price_range_slider'] ) ? absint( $cats_data['enable_price_range_slider'] ) : 0;
	$brack_title_desktop                         = isset( $cats_data['brack_title_desktop'] ) ? $cats_data['brack_title_desktop'] : '';
	$brack_title_tablets                         = isset( $cats_data['brack_title_tablets'] ) ? $cats_data['brack_title_tablets'] : '';
	$fonts['list_name_font']['family']           = $list_name_font;
	$fonts['title_font']['family']               = $title_font;
	$fonts['price_font']['family']               = $price_font;
	$fonts['desc_font']['family']                = $desc_font;
	$fonts['service_description_font']['family'] = $service_description_font;
	$fonts['tab_description_font']['family']     = $tab_description_font;
	//convert family like 'Dancing-Script' to DancingScript
	$list_name_font           = str_replace( '-', ' ', $list_name_font );
	$title_font               = str_replace( '-', ' ', $title_font );
	$price_font               = str_replace( '-', ' ', $price_font );
	$desc_font                = str_replace( '-', ' ', $desc_font );
	$service_description_font = str_replace( '-', ' ', $service_description_font );
	$tab_description_font     = str_replace( '-', ' ', $tab_description_font );
	// get font weight dynamically
	$title_font_weight           = isset( $cats_data['title_font-weight'] ) ? $cats_data['title_font-weight'] : '';
	$tab_font_weight             = isset( $cats_data['tab_font-weight'] ) ? $cats_data['tab_font-weight'] : '';
	$category_image_overlay_percent      = isset( $cats_data['category_image_overlay_percent'] ) ? intval( $cats_data['category_image_overlay_percent'] ) : 31;
	$category_desc_embed_to_cover_image_s10 = isset( $cats_data['category_desc_embed_to_cover_image_s10'] ) ? $cats_data['category_desc_embed_to_cover_image_s10'] : 1;
	if ( ! $category_desc_embed_to_cover_image_s10 ) {
		$category_image_overlay_percent = 0;
	}
	$category_image_overlay_value        = 'hsl(0deg 0% 0% / ' . $category_image_overlay_percent . '%)';
	$service_font_weight         = isset( $cats_data['service_font-weight'] ) ? $cats_data['service_font-weight'] : '';
	$service_price_font_weight   = isset( $cats_data['service_price_font-weight'] ) ? $cats_data['service_price_font-weight'] : '';
	$tab_description_font_weight = isset( $cats_data['tab_description_font-weight'] ) ? $cats_data['tab_description_font-weight'] : '';
	$description_font_weight     = isset( $cats_data['description_font-weight'] ) ? $cats_data['description_font-weight'] : '';
	$opt_cats                    = $cats_data['category'];
	$jsonld_currency		     = isset( $cats_data['jsonld_currency'] ) ? $cats_data['jsonld_currency'] : 'USD';
	$enable_seo_jsonld           = isset( $cats_data['enable_seo_jsonld'] ) ? $cats_data['enable_seo_jsonld'] : 0;
	$spl_data_values             = $opt_cats;

     
	foreach ( $opt_cats as $cat_id => $cat ) {
		$cat_name = df_spl_remove_slash_quotes( $cat['name'] );
		unset( $cat['name'] ); //remove the name items, so, we can use foreach to process
		$cat_description = df_spl_remove_slash_quotes( isset( $cat['description'] ) ? $cat['description'] : '' );
		$cat_background_color = df_spl_remove_slash_quotes( isset( $cat['background_color'] ) ? $cat['background_color'] : '#ADADAC' );
		$cat_text_color = df_spl_remove_slash_quotes( isset( $cat['text_color'] ) ? $cat['text_color'] : '#ffffff' );
		$cat_action_text = df_spl_remove_slash_quotes( isset( $cat['action_text'] ) ? $cat['action_text'] : '' );
		$cat_action_link = df_spl_remove_slash_quotes( isset( $cat['action_link'] ) ? $cat['action_link'] : '' );
		$cat_cover_image = df_spl_remove_slash_quotes( isset( $cat['cover-image'] ) ? $cat['cover-image'] : '' );
		$cat_price = df_spl_remove_slash_quotes( isset( $cat['price'] ) ? $cat['price'] : '' );
		unset( $cat['description'] ); //remove the name items, so, we can use foreach to process
		unset( $cat['cover-image'] ); //remove the cover image value, so, we can use foreach to process
		unset( $cat['color'] ); //remove the color value, so, we can use foreach to process
		unset( $cat['action_text'] ); //remove the action text value, so, we can use foreach to process
		unset( $cat['action_link'] ); //remove the action link value, so, we can use foreach to process
		unset( $cat['price'] ); //remove the price value, so, we can use foreach to process
		$services = array();
		foreach ( $cat as $service_id => $service ) {
			$service = wp_parse_args( $service, array (
				'service_name' => '',
				'service_regular_price' => '',
				'service_long_description' => '',
				'service_price' => '',
				'service_desc' => '',
				'service_image' => '',
				'settings_compare_at' => '',
				'service_button' => '',
				'service_button_url' => '',
				'service_url' => '',
				'settings_tooltip_title' => '',
				'settings_tooltip_description' => '',
				'settings_tooltip_image' => '',
				'is_popular' => '',
				'popular_text' => '',
			) );
			// run all values in $service through df_spl_remove_slash_quotes
			$service = array_map( 'df_spl_remove_slash_quotes', $service );

			$services[ $service_id ] = wp_parse_args( $service, array(
				'name' => $service['service_name'],
				'regular_price' => $service['service_regular_price'],
				'price' => $service['service_price'],
				'desc' => $service['service_desc'],
				'service_button' => $service['service_button'],
				'settings_compare_at' => $service['settings_compare_at'],
				'service_button' => $service['service_button'],
				'service_button_url' => $service['service_button_url'],
				'service_url' => $service['service_url'],
				'service_image' => $service['service_image'],
				'service_long_description' => $service['service_long_description'],
				'settings_tooltip_title' => $service['settings_tooltip_title'],
				'settings_tooltip_description' => $service['settings_tooltip_description'],
				'settings_tooltip_image' => $service['settings_tooltip_image'],
				'is_popular' => $service['is_popular'],
				'popular_text' => $service['popular_text'],
			) );
			$services[ $service_id ]['tooltip_config'] = [
				'data-tooltip-title' => $services[ $service_id ]['settings_tooltip_title'],
				'data-tooltip-description' => wp_kses_post( $services[ $service_id ]['settings_tooltip_description'] ),
				'data-tooltip-image' => $services[ $service_id ]['settings_tooltip_image']
			];
		}
		$cats[ $cat_id ]['name']        = df_spl_remove_slash_quotes( $cat_name );
		$cats[ $cat_id ]['description'] = df_spl_remove_slash_quotes( $cat_description );
		$cats[ $cat_id ]['cover-image'] = $cat_cover_image;
		$cats[ $cat_id ]['price'] = $cat_price;
		$cats[ $cat_id ]['action_text'] = $cat_action_text;
		$cats[ $cat_id ]['action_link'] = $cat_action_link;
		$cats[ $cat_id ]['background_color'] = $cat_background_color;
		$cats[ $cat_id ]['text_color'] = $cat_text_color;
		$cats[ $cat_id ]['services']    = $services;
	}
	
	$pricelist_config = array(
		'category_select_scrolling' => $category_select_scrolling
	);
	
	$opt                      = get_option( 'spllk_opt' );
	$df_number_of_cats        = ( empty( $opt ) || ( isset( $opt[ 'license' ] ) && $opt[ 'license' ] !== 'valid') ) ? 4 : 0;
	$show_dropdown            = empty( $df_number_of_cats ) ? $show_dropdown : '0';
}
if ( empty( $id ) ) {
	return 'Price List does not exist';
}
if ( $show_dropdown ) {
	wp_enqueue_style( 'spl-tomselect' );
	wp_enqueue_script( 'spl-tomselect' );
}
if ( $enable_price_range_slider ) {
	wp_enqueue_style( 'spl-no-ui-slider' );
	wp_enqueue_script( 'spl-no-ui-slider' );
}
if ( $font_source == 'use-pagefont' ) {
	$list_name_font           = 'inherit';
	$title_font               = 'inherit';
	$price_font               = 'inherit';
	$desc_font                = 'inherit';
	$service_description_font = 'inherit';
	$tab_description_font     = 'inherit';
}

if ( ! function_exists( 'splPrintFontName' ) ) {
	function splPrintFontName( $arg ) {
		return $arg !== 'inherit' ? "\"$arg\"" : $arg;
	}
}
global $spl_googlefonts_var;
$spl_googlefonts_var->enqueue_fonts_style( $fonts, $id ); //load google fonts css
/* output_service_style2 Style2 Style 2 Style-2 */
if ( ! function_exists( 'output_service_style2' ) ) {
	function output_service_style2( $service, $is_buy_btn_newtab_enabled ) {
		extract( $service );
		$price = "<span data-price=$price>" . esc_attr( $price ) . '</span>';
		$price = empty($settings_compare_at) ? $price : '<s>'.$settings_compare_at.'</s>'. ' ' . $price;
		if ( empty( $name ) ) {
			return;
		}
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		ob_start();
		?>
		<!-- Style 2 with BUY NOW Button -->
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 name-price-desc spl-item-root" <?php foreach ($tooltip_config as $key => $value) {
			if ( empty( $value ) ) continue;
    		echo esc_attr($key) . '="' . esc_attr($value) . '" ';
		} ?> style="padding:0 10px 0 0">
			<?php if ( ! empty( $service['service_button'] ) ) { ?>
				<div class="df-spl-row name-price spl_cstm_style2">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 spl_cstm_style_2_book-full">
						<div class="df-spl-row">
							<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 spl_cstm_style_2_book" style="padding-left:0px;padding-top: 5px">
								<?php if ( ! empty( $service['service_url'] ) ) { ?>
									<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
								<?php } else { ?>
									<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
								<?php } ?>
								<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
							</div>
							<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 right-style-2" style="padding: 5px 10px 0 0;">
								<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
								<a href="<?php echo esc_attr($service['service_button_url']); ?>" <?php echo isset( $newTabOpen ) ? esc_attr($newTabOpen) : ''; ?> class="btn btn-book-now spl_book_now_btn_style_1"><?php echo esc_attr($service['service_button']); ?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="spl-two-bottom">
				</div>
				<!--Style 2 with Book WITHOUT BUY NOW Button -->
			<?php } else { ?>
				<div class="df-spl-row name-price">
					<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding:5px 10px 0 0">
						<?php if ( ! empty( $service['service_url'] ) ) { ?>
							<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
						<?php } else { ?>
							<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
						<?php } ?>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
					</div>
				</div>
				<div class="df-spl-row desc">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 5px 10px 0 0;">
						<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
					</div>
				</div>
				<div class="spl-two-bottom">
				</div>
			<?php } ?>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_service()
}
/* output_service_style2 */
/** Start of output service style 2 beta */
if ( ! function_exists( 'output_service_style2_beta' ) ) {
	function output_service_style2_beta( $service, $is_buy_btn_newtab_enabled ) {
		extract( $service );
		$price = "<span data-price=$price>" . esc_attr( $price ) . '</span>';
		$price = empty($settings_compare_at) ? $price : '<s>'.$settings_compare_at.'</s>'. ' ' . $price;
		if ( empty( $name ) ) {
			return;
		}
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		ob_start();
		?>
			<div class="name-price-desc spl-item-root" <?php foreach ($tooltip_config as $key => $value) {
				if ( empty( $value ) ) continue;
    				echo esc_attr($key) . '="' . esc_attr($value) . '" ';
				} ?>>
				<?php if ( ! empty( $service['service_button'] ) ) { ?>
				<div class="df-spl-row name-price spl_cstm_style2">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 spl_cstm_style_2_book-full">
						<div class="df-spl-row">
							<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 spl_cstm_style_2_book">
								<?php if ( ! empty( $service['service_url'] ) ) { ?>
									<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
								<?php } else { ?>
									<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
								<?php } ?>
								<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
							</div>
							<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 right-style-2">
								<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
								<a href="<?php echo esc_attr($service['service_button_url']); ?>" <?php echo isset( $newTabOpen ) ? esc_attr($newTabOpen) : ''; ?> class="btn btn-book-now spl_book_now_btn_style_1"><?php echo esc_attr($service['service_button']); ?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="spl-two-bottom">
				</div>
				<!--Style 2 with Book WITHOUT BUY NOW Button -->
			<?php } else { ?>
				<div class="df-spl-row name-price">
					<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 pl-0">
						<?php if ( ! empty( $service['service_url'] ) ) { ?>
							<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
						<?php } else { ?>
							<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
						<?php } ?>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
					</div>
				</div>
				<div class="df-spl-row desc">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pl-0">
						<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
					</div>
				</div>
				<div class="spl-two-bottom">
				</div>
			<?php } ?>
					</div>
		<?php
		$html = ob_get_clean();
		return $html;
	}
}

/** End of output service style 2 beta */
/* output_service_style2 single column Style 2, Style2 Style-2 */
if ( ! function_exists( 'output_service_style2_single_column' ) ) {
	function output_service_style2_single_column( $service, $is_buy_btn_newtab_enabled ) {
		extract( $service );
		$price = "<span data-price=$price>" . esc_attr( $price ) . '</span>';
		$price = empty($settings_compare_at) ? $price : '<s>'.$settings_compare_at.'</s>'. ' ' . $price;
		if ( empty( $name ) ) {
			return;
		}
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		ob_start();
		?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 name-price-desc spl-item-root" <?php foreach ($tooltip_config as $key => $value) {
			if ( empty( $value ) ) continue;
				echo esc_attr($key) . '="' . esc_attr($value) . '" ';
			} ?>>
			<?php if ( ! empty( $service['service_button'] ) ) { ?>
				<div class="df-spl-row name-price spl_cstm_style2 style-2-single-column-padding-book">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 spl_cstm_style_2_book-full">
						<div class="df-spl-row">
							<div class="col-xs-6 col-sm-6 col-md-8 col-lg-8 spl_cstm_style_2_book padding-left-no">
								<?php if ( ! empty( $service['service_url'] ) ) { ?>
									<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
								<?php } else { ?>
									<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
								<?php } ?>
								<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 right-style-2 padding-right-no">
								<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
								<a href="<?php echo esc_attr($service['service_button_url']); ?>" <?php echo isset( $newTabOpen ) ? esc_attr($newTabOpen) : ''; ?> class="btn btn-book-now spl_book_now_btn_style_1"><?php echo esc_attr($service['service_button']); ?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="df-spl-row liner spl-five-bottom">
				</div>
			<?php } else { ?>
				<div class="df-spl-row name-price">
					<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
						<?php if ( ! empty( $service['service_url'] ) ) { ?>
							<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
						<?php } else { ?>
							<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
						<?php } ?>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 padding-right-no">
						<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
					</div>
				</div>
				<div class="df-spl-row desc">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
					</div>
				</div>
				<div class="df-spl-row liner spl-five-bottom">
				</div>
			<?php } ?>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_service()
}
/* output_service_style2 single column */
/* output_service_col1 starts for Style 1, Style-1, Style1*/
if ( ! function_exists( 'output_service_col1' ) ) {
	function output_service_col1( $service, $is_buy_btn_newtab_enabled ) {
		extract( $service );
		$price = "<span data-price=$price>" . esc_attr( $price ) . '</span>';
		$price = empty($settings_compare_at) ? $price : '<s>'.$settings_compare_at.'</s>'. ' ' . $price;
		if ( empty( $name ) ) {
			return;
		}
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		ob_start();
		?>
		<!--Style 1 With BUY NOW -->
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 name-price-desc spl-item-root" <?php foreach ($tooltip_config as $key => $value) {
			if ( empty( $value ) ) continue;
				echo esc_attr($key) . '="' . esc_attr($value) . '" ';
			} ?> style="
		<?php
		if ( ! empty( $service['service_image'] ) ) {
			echo esc_attr( 'display: flex;' );}
		?>
		">
			
		<?php if ( ! empty( $service['service_image'] ) ) : ?>
							<div class="spl-image-container" width="20%">
								<img src="<?php echo esc_url( $service['service_image'] ); ?>"/>
							</div>
						<?php endif; ?>
			<?php if ( ! empty( $service['service_button'] ) ) { ?>
				<!---Style 1 - Book now  -->
				<div class="df-spl-row name-price spl_cstm_style1 
				<?php
				if ( ! empty( $service['service_image'] ) ) {
					echo 'spl-w-80';}
				?>
				">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 spl_cstm_style_1_book-full" style="padding:0 0 0 0">
						<?php if ( ! empty( $service['service_image'] ) ) : ?>
						<div class="df-spl-row">
						<?php endif; ?>
							<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 padding-left-no spl_cstm_style_1_book ">
								<div class="spl-title-desc">
									<?php if ( ! empty( $service['service_url'] ) ) { ?>
										<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
									<?php } else { ?>
										<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
									<?php } ?>
									<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
								</div>
							</div>
							<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 padding-left-no padding-right-no">
								<div class="df-spl-level style-1">
									<div class="df-spl-level-right style-1">
										<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
										<a href="<?php echo esc_attr($service['service_button_url']); ?>" <?php echo isset( $newTabOpen ) ? esc_attr($newTabOpen) : ''; ?> class="btn btn-book-now spl_book_now_btn_style_1"><?php echo esc_attr($service['service_button']); ?></a>
									</div>
								</div>
							</div>
						</div>
					<?php if ( ! empty( $service['service_image'] ) ) : ?>
					</div>
					<?php endif; ?>
				</div>
			<?php } else { ?>
				<!-- Style 1 - Without Book Now-->
				<div class="spl-title-desc-wrapper 
				<?php
				if ( ! empty( $service['service_image'] ) ) {
					echo 'spl-w-80';}
				?>
				">
					<div class="df-spl-row name-price">
						<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 style1" style="padding:0 10px 0 0">
							<div class="spl-title-desc">
								<?php if ( ! empty( $service['service_url'] ) ) { ?>
									<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
								<?php } else { ?>
									<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
								<?php } ?>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
						</div>
					</div>
					<div class="df-spl-row desc">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0 10px 0 0; display: flex;">
							<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
							<!-- <div style="width: 17%;"></div>
							<div style="width: 83%;">
								<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
							</div> -->
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_service()
}
/* output_service_col1 ends */
// output_service_style6 starts
if ( ! function_exists( 'output_service_style6' ) ) {
	function output_service_style6( $service, $is_buy_btn_newtab_enabled, $title_color_top ) {
		if ( empty( $service ) ) {
			return;
		}
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		ob_start();
		?>
		<style>
			.padd_0 {
				padding: 0px !important;
			}

			.padd_0 table tr td:last-child {
				text-align: right !important;
			}

			.padd_0 table {
				margin-bottom: 0px !important;
			}

			.spl_cstm_style_6 table.table tr td {
				padding: 8px;
				text-align: left;
			}

			.spl_cstm_style_6 {
				margin: 10px 0px 0px 0px;
			}

			.spl_cstm_style_6 .table table td {
				border-top: 0px solid #e5e5e5;
			}

			.spl_cstm_style_6 table td {
				border-bottom: 0px solid #e5e5e5;
			}

			.spl_cstm_style_6 td {
				border-bottom: 0px solid #e5e5e5;
			}

			.spl_cstm_style_6 table tbody {
				border-left: 0px solid #e5e5e5;
				border-right: 0px solid #e5e5e5;
			}

			.spl_cstm_style_6 table {
				border-bottom: 0px !important;
			}

			input.spl-mysearch:focus {
				border: 1px solid <?php echo esc_attr($title_color_top); ?> !important;
				outline: none;
				box-shadow: 1px 1px 1px <?php echo esc_attr($title_color_top); ?> !important;
			}
		</style>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 name-price-desc">
			<div class="df-spl-row name-price spl_cstm_style_6">
				<div class="table-responsive">
					<table class="table ">
						<tbody>
							<tr>
								<td class="spl_prd_img_td"><img src="<?php echo esc_attr($service['service_image']); ?>" /></td>
								<td class="padd_0">
									<table style="width:100%;">
										<tr>
											<td><?php echo df_spl_output_a_tag( $service['name'], '', 'name a-tag' ); ?></td>
											<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
											<td><del><?php echo esc_attr($service['regular_price']); ?></del></td>
										</tr>
										<tr>
											<td colspan="2"><?php echo df_spl_output_a_tag( $service['desc'], '', 'desc a-tag' ); ?></td>
											<td>
												<?php echo df_spl_output_a_tag( $service['price'], '', 'spl-price a-tag' ); ?>
												<?php if ( ! empty( $service['service_button'] ) ) : ?>
													<div>
														<a href="<?php echo esc_attr($service['service_button_url']); ?>" <?php echo isset( $newTabOpen ) ? esc_attr($newTabOpen) : ''; ?> class="btn btn-book-now spl_book_now_btn_style_6"><?php echo esc_attr($service['service_button']); ?></a>
													</div>
												<?php endif; ?>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="df-spl-row liner spl-five-bottom">
			</div>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_service()
}
// output_service_style6 ends
// output service for style 6 two columns
if ( ! function_exists( 'output_service_style6_item' ) ) {
	function output_service_style6_item( $service, $is_buy_btn_newtab_enabled ) {
		if ( ! ! ! $service ) {
			return;
		}
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		$price = $service['price'];
		$settings_compare_at = $service['settings_compare_at'];
		$price = "<span data-price=$price>" . esc_attr( $price ) . '</span>';
		$price = empty($settings_compare_at) ? $price : '<s>'.$settings_compare_at.'</s>'. ' ' . $price;
		ob_start();
		?>
		<div class="style-6-two-column spl-item-root" <?php foreach ($service['tooltip_config'] as $key => $value) {
			if ( empty( $value ) ) continue;
				echo esc_attr($key) . '="' . esc_attr($value) . '" ';
			} ?>>
			<?php echo ! empty( $service['service_image'] ) ? '<img alt="" class="style-6-two-image" width="80" src="' . $service['service_image'] . '">' : '<div class="style-6-two-image"></div>'; ?>
			<div class="style-6-section spl-position-relative">
				<div class="spl-position_absolute spl-height-3 spl-width-full spl-bottom-2 scc-2-dotted-grey"></div>
				<h4 class="style-6-2-desc"><strong data-price-list-fragment="item_name" class="name a-tag"><?php echo spl_esc_output( $service['name'] ); ?></strong></h4>
				<h4 class="style-6-2-price"><strong data-price-list-fragment="price" class="spl-price a-tag"><?php echo spl_esc_output( $price ); ?></strong></h4>
			</div>
			<div class="style-6-height-10"></div>
			<div class="style-6-2-section name-price-desc">
				<p class="st-6-fl-l desc a-tag"><?php echo spl_esc_output($service['desc']); ?></p>
				<?php
				if ( $service['service_button'] !== '' ) {
					echo '<a href="' . $service['service_button_url'] . '" ' . ( isset( $newTabOpen ) ? esc_attr($newTabOpen) : '' ) . ' class="style-6-2-btn">' . $service['service_button'] . '</a>';
				}
				?>
			</div>
		</div>
		<div class="style-6-2-spacing"></div>
		<?php
		$html = ob_get_clean();
		return $html;
	}
}
// Style 1, Style-1, Style1 - BOOK NOW
if ( ! function_exists( 'output_service' ) ) {
	function output_service( $service, $is_buy_btn_newtab_enabled ) {
		extract( $service );
		if ( empty( $name ) ) {
			return;
		}
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		$price = "<span data-price=$price>" . esc_attr( $price ) . '</span>';
		$price = empty($settings_compare_at) ? $price : '<s>'.$settings_compare_at.'</s>'. ' ' . $price;
		ob_start();
		?>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 name-price-desc spl-item-root" <?php foreach ($tooltip_config as $key => $value) {
			if ( empty( $value ) ) continue;
				echo esc_attr($key) . '="' . esc_attr($value) . '" ';
			} ?> style="
		<?php
		if ( ! empty( $service['service_image'] ) ) {
			echo esc_attr( 'display: flex;' );}
		?>
		">
			
		<?php if ( ! empty( $service['service_image'] ) ) : ?>
							<div class="spl-image-container" width="20%">
								<img src="<?php echo esc_url( $service['service_image'] ); ?>"/>
							</div>
						<?php endif; ?>
			<?php if ( ! empty( $service['service_button'] ) ) { ?>
				<!---Style 1 - Book now  -->
				<div class="df-spl-row name-price spl_cstm_style1 
				<?php
				if ( ! empty( $service['service_image'] ) ) {
					echo 'spl-w-80';}
				?>
				">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 spl_cstm_style_1_book-full" style="padding:0 0 0 0">
						<?php if ( ! empty( $service['service_image'] ) ) : ?>
						<div class="df-spl-row">
						<?php endif; ?>
							<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 padding-left-no spl_cstm_style_1_book ">
								<div class="spl-title-desc">
									<?php if ( ! empty( $service['service_url'] ) ) { ?>
										<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
									<?php } else { ?>
										<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text'] ); ?>
									<?php } ?>
									<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
								</div>
							</div>
							<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 padding-left-no padding-right-no">
								<div class="df-spl-level style-1">
									<div class="df-spl-level-right style-1">
										<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
										<a href="<?php echo esc_attr($service['service_button_url']); ?>" <?php echo isset( $newTabOpen ) ? esc_attr($newTabOpen) : ''; ?> class="btn btn-book-now spl_book_now_btn_style_1"><?php echo esc_attr($service['service_button']); ?></a>
									</div>
								</div>
							</div>
						</div>
					<?php if ( ! empty( $service['service_image'] ) ) : ?>
					</div>
					<?php endif; ?>
				</div>
			<?php } else { ?>
				<!-- Style 1 - Without Book Now-->
				<div class="spl-title-desc-wrapper 
				<?php
				if ( ! empty( $service['service_image'] ) ) {
					echo 'spl-w-80';}
				?>
				">
					<div class="df-spl-row name-price">
						<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 style1" style="padding:0 10px 0 0">
							<div class="spl-title-desc">
								<?php if ( ! empty( $service['service_url'] ) ) { ?>
									<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
								<?php } else { ?>
									<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
								<?php } ?>
							</div>
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
							<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
						</div>
					</div>
					<div class="df-spl-row desc">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0 10px 0 0; display: flex;">
							<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
							<!-- <div style="width: 17%;"></div>
							<div style="width: 83%;">
								<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
							</div> -->
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_service()
} //end if !function_exists('output_service')
//break sercive col 1
if ( ! function_exists( 'output_service_break_col1' ) ) {
	function output_service_break_col1( $service, $is_buy_btn_newtab_enabled ) {
		extract( $service );
		$price = "<span data-price=$price>" . esc_attr( $price ) . '</span>';
		$price = empty($settings_compare_at) ? $price : '<s>'.$settings_compare_at.'</s>'. ' ' . $price;
		if ( empty( $name ) ) {
			return;
		}
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		ob_start();
		?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 name-price-desc spl-item-root" <?php foreach ($tooltip_config as $key => $value) {
			if ( empty( $value ) ) continue;
				echo esc_attr($key) . '="' . esc_attr($value) . '" ';
			} ?>>
			<div class="df-spl-row name-price">
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 custom_line">
					<?php if ( ! empty( $service['service_url'] ) ) { ?>
						<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
					<?php } else { ?>
						<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
					<?php } ?>
					<span class="style-4-border style-4-width break_service"></span>
				</div>
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 style4_break_price">
					<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
				</div>
			</div>
			<div class="df-spl-row desc">
				<?php if ( ! empty( $service['service_button'] ) ) { ?>
					<div class="col-xs-8 col-sm-10 col-md-10 col-lg-10 pad-left-0">
						<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
					</div>
					<div class="col-xs-4 col-sm-2 col-md-2 col-lg-2 spl_category_brak_style4">
						<a href="<?php echo esc_attr($service['service_button_url']); ?>" <?php echo isset( $newTabOpen ) ? esc_attr($newTabOpen) : ''; ?> class="btn btn-book-now spl_book_now_btn_style_4"><?php echo esc_attr($service['service_button']); ?></a>
					</div>
				<?php } else { ?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pad-left-0">
						<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
					</div>
				<?php } ?>
			</div>
			<div class="df-spl-row liner spl-five-bottom">
			</div>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_service()
} //end if !function_exists('output_service')
//End break Service col 1
//break sercive
if ( ! function_exists( 'output_service_break' ) ) {
	function output_service_break( $service, $is_buy_btn_newtab_enabled ) {
		extract( $service );
		$price = "<span data-price=$price>" . esc_attr( $price ) . '</span>';
		$price = empty($settings_compare_at) ? $price : '<s>'.$settings_compare_at.'</s>'. ' ' . $price;
		if ( empty( $name ) ) {
			return;
		}
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		ob_start();
		?>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 name-price-desc spl-item-root" <?php foreach ($tooltip_config as $key => $value) {
				if ( empty( $value ) ) continue;
    				echo esc_attr($key) . '="' . esc_attr($value) . '" ';
				} ?>>
			<div class="df-spl-row name-price">
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 custom_line">
					<?php if ( ! empty( $service['service_url'] ) ) { ?>
						<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
					<?php } else { ?>
						<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
					<?php } ?>
					<span class="style-4-border style-4-width break_service"></span>
				</div>
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 style4_break_price">
					<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
				</div>
			</div>
			<div class="df-spl-row desc">
				<?php if ( ! empty( $service['service_button'] ) ) { ?>
					<div class="col-xs-8 col-sm-10 col-md-10 col-lg-10 pad-left-0">
						<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
					</div>
					<div class="col-xs-4 col-sm-2 col-md-2 col-lg-2 spl_category_brak_style4">
						<a href="<?php echo esc_attr($service['service_button_url']); ?>" <?php echo isset( $newTabOpen ) ? esc_attr($newTabOpen) : ''; ?> class="btn btn-book-now spl_book_now_btn_style_4"><?php echo esc_attr($service['service_button']); ?></a>
					</div>
				<?php } else { ?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pad-left-0">
						<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
					</div>
				<?php } ?>
			</div>
			<div class="df-spl-row liner spl-five-bottom">
			</div>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_service()
} //end if !function_exists('output_service')
//End break Service
//Start output service for style-3 style 3 style3
if ( ! function_exists( 'output_service_style3' ) ) {
	function output_service_style3( $service, $is_buy_btn_newtab_enabled ) {
		extract( $service );
		$price = "<span data-price=$price>" . esc_attr( $price ) . '</span>';
		$price = empty($settings_compare_at) ? $price : '<s>'.$settings_compare_at.'</s>'. ' ' . $price;
		if ( empty( $name ) ) {
			return;
		}
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		ob_start();
		?>
		<div class="internal-box spl-item-root" <?php foreach ($tooltip_config as $key => $value) {
				if ( empty( $value ) ) continue;
    				echo esc_attr($key) . '="' . esc_attr($value) . '" ';
				} ?>>
			<div class="df-spl-row name-price" style="padding:20px;">
				<?php if ( ! empty( $service['service_button'] ) ) { ?>
					<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding:0;">
						<?php if ( ! empty( $service['service_url'] ) ) { ?>
							<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
						<?php } else { ?>
							<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
							<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag df-spl-d-ib' ); ?>
						<?php } ?>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding:0;">
						<div class="df-spl-level">
							<div class="df-spl-level-left" style="display: block">
								<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
								<a href="<?php echo esc_attr($service['service_button_url']); ?>" <?php echo isset( $newTabOpen ) ? esc_attr($newTabOpen) : ''; ?> class="txt-button-style3"><?php echo esc_attr($service['service_button']); ?></a>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="padding:0;">
						<?php if ( ! empty( $service['service_url'] ) ) { ?>
							<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
						<?php } else { ?>
							<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
							<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag df-spl-d-ib' ); ?>
						<?php } ?>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="padding:0;">
						<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
					</div>
				<?php } ?>
			</div>
			<div class="df-spl-row liner spl-three-bottom">
			</div>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_service_style3()
}
//Function for style4 col1 //
if ( ! function_exists( 'output_service_style4_col1' ) ) {
	function output_service_style4_col1( $service, $is_buy_btn_newtab_enabled ) {
		extract( $service );
		$price = "<span data-price=$price>" . esc_attr( $price ) . '</span>';
		$price = empty($settings_compare_at) ? $price : '<s>'.$settings_compare_at.'</s>'. ' ' . $price;
		if ( empty( $name ) ) {
			return;
		}
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		ob_start();
		?>
		<div class="internal-box clearfix spl-item-root" <?php foreach ($tooltip_config as $key => $value) {
				if ( empty( $value ) ) continue;
    				echo esc_attr($key) . '="' . esc_attr($value) . '" ';
				} ?> style="padding:0px">
			<?php if ( ! empty( $service['service_button'] ) ) { ?>
				<div class="content-section name-price clearfix"><span class="style-4-productName style-4-width">
				<?php
				if ( ! empty( $service['service_url'] ) ) {
					?>
					<a href="<?php echo esc_attr($service['service_url']); ?>"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
					<?php
				} else {
					?>
					<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?><?php } ?></span> <span class="style-4-border"></span><span class="style-4-productPrice style-4-width"> <?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?></span></div><span class="df-spl-row desc spl_cstm_btn_style4"><?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?><a href="<?php echo esc_attr($service['service_button_url']); ?>" <?php echo isset( $newTabOpen ) ? esc_attr($newTabOpen) : ''; ?> class="btn btn-book-now spl_book_now_btn_style_4"><?php echo esc_attr($service['service_button']); ?></a></span>
			<?php } else { ?>
				<div class="content-section name-price clearfix"><span class="style-4-productName style-4-width">
				<?php
				if ( ! empty( $service['service_url'] ) ) {
					?>
					<a href="<?php echo esc_attr($service['service_url']); ?>"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
					<?php
				} else {
					?>
					<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?><?php } ?></span> <span class="style-4-border"></span><span class="style-4-productPrice style-4-width"> <?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?></span></div><span class="df-spl-row desc"><?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?></span>
			<?php } ?>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_service_style4()
}
//End function for style4 col1 //
//Function for style4 //
if ( ! function_exists( 'output_service_style4' ) ) {
	function output_service_style4( $service, $is_buy_btn_newtab_enabled ) {
		extract( $service );
		$price = "<span data-price=$price>" . esc_attr( $price ) . '</span>';
		$price = empty($settings_compare_at) ? $price : '<s>'.$settings_compare_at.'</s>'. ' ' . $price;
		if ( empty( $name ) ) {
			return;
		}
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		ob_start();
		?>
		<div class="internal-box clearfix spl-item-root" <?php foreach ($tooltip_config as $key => $value) {
				if ( empty( $value ) ) continue;
    				echo esc_attr($key) . '="' . esc_attr($value) . '" ';
				} ?> style="padding:0px;">
			<?php if ( ! empty( $service['service_button'] ) ) { ?>
				<div class="content-section name-price clearfix"><span class="style-4-productName style-4-width">
				<?php
				if ( ! empty( $service['service_url'] ) ) {
					?>
					<a href="<?php echo esc_attr($service['service_url']); ?>"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
					<?php
				} else {
					?>
					<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?><?php } ?></span> <span class="style-4-border"></span><span class="style-4-productPrice style-4-width"> <?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?></span></div><span class="df-spl-row desc spl_cstm_btn_style4"><?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?><a href="<?php echo esc_attr($service['service_button_url']); ?>" <?php echo isset( $newTabOpen ) ? esc_attr($newTabOpen) : ''; ?> class="btn btn-book-now spl_book_now_btn_style_4"><?php echo esc_attr($service['service_button']); ?></a></span>
			<?php } else { ?>
				<div class="content-section name-price clearfix"><span class="style-4-productName style-4-width">
				<?php
				if ( ! empty( $service['service_url'] ) ) {
					?>
					<a href="<?php echo esc_attr($service['service_url']); ?>"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
					<?php
				} else {
					?>
					<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?><?php } ?></span> <span class="style-4-border"></span><span class="style-4-productPrice style-4-width"> <?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?></span></div><span class="df-spl-row desc"><?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?></span>
			<?php } ?>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_service_style4()
}
//End function for style4//
//Start output service for style 5, style-5, style5
if ( ! function_exists( 'output_service_style5' ) ) {
	function output_service_style5( $service, $is_buy_btn_newtab_enabled ) {
		if ( empty( $service ) ) {
			return;
		}
		extract( $service );
		$price = "<span data-price=$price>" . esc_attr( $price ) . '</span>';
		$price = empty($settings_compare_at) ? $price : '<s>'.$settings_compare_at.'</s>'. ' ' . $price;
		if ( empty( $name ) ) {
			return;
		}
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		ob_start();
		?>
		<div class="style-five spl-item-root" <?php foreach ($tooltip_config as $key => $value) {
			if ( empty( $value ) ) continue;
    		echo esc_attr($key) . '="' . esc_attr($value) . '" ';
		} ?>>
			<div class="name-price-desc spl-style-5">
				<?php if ( ! empty( $service['service_button'] ) ) { ?>
					<div class="">
						<div class="col-md-9 col-sm-9 col-xs-9 padding-left-no spl-mr-0">
							<?php if ( ! empty( $service['service_url'] ) ) { ?>
								<a href="<?php echo esc_attr($service['service_url']); ?>"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
							<?php } else { ?>
								<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
								<?php
							}
							echo df_spl_output_a_tag( $desc, '', 'desc a-tag' );
							?>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3 padding-left-no padding-right-no" data-price-list-fragment="price">
							<div class="spl-style5-price"><?php echo df_spl_output_a_tag_style5( $price, '', 'spl-price a-tag' ); ?><a href="<?php echo esc_attr($service['service_button_url']); ?>" <?php echo isset( $newTabOpen ) ? esc_attr($newTabOpen) : ''; ?> class="btn btn-book-now spl_book_now_btn_style_5"><?php echo esc_attr($service['service_button']); ?></a></div>
						</div>
					</div>
					<div class="df-spl-row liner spl-five-bottom">
					</div>
				<?php } else { ?>
					<div class="">
						<div class="col-md-9 col-sm-9 col-xs-9 padding-left-no">
							<?php if ( ! empty( $service['service_url'] ) ) { ?>
								<a href="<?php echo esc_attr($service['service_url']); ?>"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
							<?php } else { ?>
								<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
								<?php
							}
							echo df_spl_output_a_tag( $desc, '', 'desc a-tag' );
							?>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3 padding-left-no" data-price-list-fragment="price" style="margin-top:0px">
							<div class="spl-style5-price"><?php echo df_spl_output_a_tag_style5( $price, '', 'spl-price a-tag' ); ?></div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_service_style5()
}
// Style 5 column 1 starts
if ( ! function_exists( 'output_tab_contents_style5_col1' ) ) {
	function output_tab_contents_style5_col1( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ) {
		ob_start();
		?>
		<?php
		$all_services = array();
		foreach ( $cats as $key => $cat ) {
			$services = $cat['services'];
			foreach ( $services as $key => $service ) {
				$name           = $service['name'];
				$all_services[] = $service;
			}
		}
		?>
		<div class="tab <?php echo ( $default ) ? '' : 'active'; ?>" id="all_<?php echo esc_attr($shortcode_id); ?>" style="<?php echo ( $default ) ? 'display:none' : 'display:block'; ?>">
			<div class="left-side-style5 col-one-style5">
				<?php
				$i = 0;
				?>
				<?php
				foreach ( $all_services as $key => $service ) {
					echo output_service_style5( isset( $all_services[ $i ] ) ? $all_services[ $i ] : null, $is_buy_btn_newtab_enabled ); //$all_services[$i]
					$i++;
				}
				?>
			</div>
		</div>
		<?php foreach ( $cats as $key => $cat ) : ?>
			<?php
			$name     = spl_esc_output( $cat['name'] );
			$id       = get_id_name( spl_esc_output( $name ) );
			$services = $cat['services'];
			if ( $default == $key ) {
				$act_tab   = 'active';
				$style_act = 'display:block';
			} else {
				$act_tab   = '';
				$style_act = 'display:none';
			}
			?>
			<div class="tab <?php echo esc_attr($act_tab); ?>" id="<?php echo esc_attr($key) . '_' . $shortcode_id; ?>" style="<?php echo esc_attr($style_act); ?>">
				<?php
				if ( $cat['description'] != '' ) {
					?>
					<div class="df-spl-row">
						<div class="col-sm-12 custom-description-section">
							<?php echo spl_esc_output( nl2br( $cat['description'] ) ); ?>
						</div>
					</div>
				<?php } ?>
				<div class="df-spl-row">
					<div class="left-side-style5 col-one-style5">
						<?php
						$k = 1;
						foreach ( $services as $key => $service ) {
							echo output_service_style5( isset( $services[ $k ] ) ? $services[ $k ] : null, $is_buy_btn_newtab_enabled ); //$services[$k]
							$k++;
						}
						?>
					</div>
					<?php
					$l = 1;
					?>
					<?php
					foreach ( $all_services as $key => $service ) {
						$class_cont_content = 'hide-right';
						if ( isset( $all_services[ $l ] ) && ! empty( $all_services[ $l ] ) ) {
							$cont_content = count( $all_services[ $l ] );
							//echo $cont_content;
							if ( $cont_content >= 0 ) {
								$class_cont_content = '';
							}
						}
					}
					?>
				</div>
			</div>
		<?php endforeach ?>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_tab_contents()
}
// Style 5 column 1 ends
if ( ! function_exists( 'output_tab_contents_style5' ) ) {
	function output_tab_contents_style5( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ) {
		ob_start();
		?>
		<?php
		$all_services = array();
		foreach ( $cats as $key => $cat ) {
			$services = $cat['services'];
			foreach ( $services as $key => $service ) {
				$name           = $service['name'];
				$all_services[] = $service;
			}
		}
		?>
		<div class="tab <?php echo ( $default ) ? '' : 'active'; ?>" id="all_<?php echo esc_attr($shortcode_id); ?>" style="<?php echo ( $default ) ? 'display:none' : 'display:block'; ?>">
			<div class="left-side-style5">
				<?php
				$i = 0;
				?>
				<?php
				foreach ( $all_services as $key => $service ) {
					echo output_service_style5( isset( $all_services[ $i ] ) ? $all_services[ $i ] : null, $is_buy_btn_newtab_enabled ); //$all_services[$i]
					$i = $i + 2;
				}
				?>
			</div>
			<?php
			$j = 1;
			?>
			<?php
			foreach ( $all_services as $key => $service ) {
				$class_cont_content = 'hide-right';
				if ( isset( $all_services[ $j ] ) && ! empty( $all_services[ $j ] ) ) {
					$cont_content = count( $all_services[ $j ] );
					if ( $cont_content >= 0 ) {
						$class_cont_content = '';
					}
				}
			}
			?>
			<div class="right-side-style5 <?php echo ' ' . $class_cont_content; ?>">
				<?php
				$j = 1;
				?>
				<?php
				foreach ( $all_services as $key => $service ) {
					echo output_service_style5( isset( $all_services[ $j ] ) ? $all_services[ $j ] : null, $is_buy_btn_newtab_enabled ); //$all_services[$j]
					$j = $j + 2;
				}
				?>
			</div>
		</div>
		<?php foreach ( $cats as $key => $cat ) : ?>
			<?php
			$name     = spl_esc_output( $cat['name'] );
			$id       = get_id_name( spl_esc_output( $name ) );
			$services = $cat['services'];
			if ( $default == $key ) {
				$act_tab   = 'active';
				$style_act = 'display:block';
			} else {
				$act_tab   = '';
				$style_act = 'display:none';
			}
			?>
			<div class="tab <?php echo esc_attr($act_tab); ?>" id="<?php echo esc_attr($key) . '_' . $shortcode_id; ?>" style="<?php echo esc_attr($style_act); ?>">
				<?php
				if ( $cat['description'] != '' ) {
					?>
					<div class="df-spl-row">
						<div class="col-sm-12 custom-description-section">
							<?php echo spl_esc_output( nl2br( $cat['description'] ) ); ?>
						</div>
					</div>
				<?php } ?>
				<div class="df-spl-row">
					<div class="left-side-style5">
						<?php
						$k = 1;
						foreach ( $services as $key => $service ) {
							echo output_service_style5( isset( $services[ $k ] ) ? $services[ $k ] : null, $is_buy_btn_newtab_enabled ); //$services[$k]
							$k = $k + 2;
						}
						?>
					</div>
					<?php
					$l = 2;
					?>
					<?php
					foreach ( $all_services as $key => $service ) {
						$class_cont_content = 'hide-right';
						if ( isset( $all_services[ $l ] ) && ! empty( $all_services[ $l ] ) ) {
							$cont_content = count( $all_services[ $l ] );
							//echo $cont_content;
							if ( $cont_content >= 0 ) {
								$class_cont_content = '';
							}
						}
					}
					?>
					<?php
					if ( ! empty( $cont_content ) ) {
						?>
						<div class="right-side-style5 <?php echo ' ' . $class_cont_content; ?>">
							<?php
							$l = 2;
							?>
							<?php
							foreach ( $services as $key => $service ) {
								echo output_service_style5( isset( $services[ $l ] ) ? $services[ $l ] : null, $is_buy_btn_newtab_enabled ); //$services[$l]
								$l = $l + 2;
							}
							?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php endforeach ?>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_tab_contents()
} //end if !function_exists('output_tab_contents_style5')
if ( ! function_exists( 'output_tabs_style5' ) ) {
	function output_tabs_style5( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ) {
		ob_start();
		?>
		<?php foreach ( $cats as $key => $cat ) : ?>
			<?php
			$name        = $cat['name'];
			$description = $cat['description'];
			$id          = get_id_name( spl_esc_output( $name ) );
			$name1       = spl_esc_output( $cat['name'] );
			$id1         = get_id_name( spl_esc_output( $name1 ) );
			if ( $default == $key ) {
				$act_tab = 'active default';
			} else {
				$act_tab = '';
			}
			if ( strtolower( $default ) == strtolower( $name ) ) {
				$act = 'active';
			} else {
				$act = '';
			}
			?>
			<li class="
			<?php
			echo esc_attr($act_tab);
			if ( $name == '' ) {
				echo ' hidden';
			}
			?>
						">
				<a href="javascript:void(0)" data-href="#<?php echo esc_attr($key) . '_' . $shortcode_id; ?>"><?php echo spl_esc_output( $name ); ?></a>
			</li>
		<?php endforeach ?>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_tabs()
} //end if !function_exists('output_tabs')
if ( ! function_exists( 'output_dropdown_choices' ) ) {
	function output_dropdown_choices( $cats, $id, $showAllChoice, $default = 0, $all_tab = 'All' ) {
		$defaultOption = "<option value=\"#all_$id\">$all_tab</option>";
		$opts          = array_map(
			function ( $cat, $index ) use ( $id, $default ) {
				$target = $index . '_' . $id;
				$selected_string = $index == $default ? 'selected="selected"' : '';
				return "<option data-target-cat-key=\"$index\" value=\"#$target\" $selected_string>" . $cat['name'] . '</option>';
			},
			$cats,
			array_keys( $cats )
		);
		if ( $showAllChoice ) {
			array_unshift( $opts, $defaultOption );
		}

		return join( "\n", $opts );
	}
}
if ( ! function_exists( 'output_tab_contents_style7b' ) ) {
	function output_tab_contents_style7b( $cats, $default, $shortcode_id, $select_column, $is_buy_btn_newtab_enabled ) {
		ob_start();
		?>
		<?php
		$all_services = array();
		foreach ( $cats as $key => $cat ) {
			$services = $cat['services'];
			foreach ( $services as $key => $service ) {
				$name           = $service['name'];
				$all_services[] = $service;
			}
		}
		?>
		<div class="tab <?php echo ( $default ) ? '' : 'active'; ?>" id="all_<?php echo esc_attr($shortcode_id); ?>" style="<?php echo ( $default ) ? 'display:none' : 'display:block'; ?>">
			<?php
			$i = 0;
			?>
			<?php
			foreach ( $all_services as $key => $service ) {
				echo ( $select_column === 'One' ) ? output_service_style7_single_col( $service, $is_buy_btn_newtab_enabled ) : output_service_style7b( $service, $is_buy_btn_newtab_enabled ); //$all_services[$i]
				$i = $i + 2;
			}
			?>
			<?php
			$j = 1;
			?>
			<?php
			foreach ( $all_services as $key => $service ) {
				$class_cont_content = 'hide-right';
				if ( isset( $all_services[ $j ] ) && ! empty( $all_services[ $j ] ) ) {
					$cont_content = count( $all_services[ $j ] );
					if ( $cont_content >= 0 ) {
						$class_cont_content = '';
					}
				}
			}
			?>
		</div>
		<?php foreach ( $cats as $key => $cat ) : ?>
			<?php
			$name     = spl_esc_output( $cat['name'] );
			$id       = get_id_name( spl_esc_output( $name ) );
			$services = $cat['services'];
			if ( $default == $key ) {
				$act_tab   = 'active';
				$style_act = '';
			} else {
				$act_tab   = '';
				$style_act = 'display:none';
			}
			?>
			<div class="tab <?php echo esc_attr($act_tab); ?>" id="<?php echo esc_attr($key) . '_' . $shortcode_id; ?>" style="<?php echo esc_attr($style_act); ?>">
				<?php
				if ( $cat['description'] != '' ) {
					?>
					<div class="df-spl-row">
						<div class="col-md-12 custom-description-section">
							<?php echo spl_esc_output( nl2br( $cat['description'] ) ); ?>
						</div>
					</div>
				<?php } ?>
				<div class="df-spl-row">
					<?php
					$k = 1;
					foreach ( $services as $key => $service ) {
						echo ( $select_column === 'One' ) ? output_service_style7_single_col( $service, $is_buy_btn_newtab_enabled ) : output_service_style7b( $service, $is_buy_btn_newtab_enabled ); //$services[$k]
						$k = $k + 2;
					}
					?>
					<?php
					$l = 2;
					?>
					<?php
					foreach ( $all_services as $key => $service ) {
						$class_cont_content = 'hide-right';
						if ( $service ) {
							$cont_content = count( $service );
							//echo $cont_content;
							if ( $cont_content >= 0 ) {
								$class_cont_content = '';
							}
						}
					}
					?>
				</div>
			</div>
		<?php endforeach ?>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_tab_contents()
} //end if !function_exists('output_tab_contents_style7')
if ( ! function_exists( 'output_tab_contents_style8' ) ) {
	function output_tab_contents_style8( $cats, $default, $shortcode_id, $select_column, $is_buy_btn_newtab_enabled, $df_number_of_cats ) {
		ob_start();
		?>
		<?php
		$all_services = array();
		if ( $df_number_of_cats ) {
			$cats = array_slice( $cats, 0, $df_number_of_cats, true );
		}
		foreach ( $cats as $key => $cat ) {
			$services = $cat['services'];
			foreach ( $services as $key => $service ) {
				$name           = $service['name'];
				$all_services[] = $service;
			}
		}
		?>
		<?php
		$i         = 0;
		$act_tab   = $default ? 'active' : '';
		$style_act = empty( $default ) ? '' : 'display:none';
		?>
		<div class="tab style-8-cards 
		<?php
		if ( $select_column == 'Two' ) {
			echo 'is-two-column ';}
										echo esc_attr($act_tab);
		?>
										" id="<?php echo 'all_' . $shortcode_id; ?>" style="<?php echo esc_attr($style_act); ?>">
			<?php
			foreach ( $all_services as $key => $service ) {
				echo output_service_style8( $service, $is_buy_btn_newtab_enabled ); //$all_services[$i]
				$i = $i + 2;
			}
			?>
			<?php
			$j = 1;
			?>
			<?php
			foreach ( $all_services as $key => $service ) {
				$class_cont_content = 'hide-right';
				if ( isset( $all_services[ $j ] ) && ! empty( $all_services[ $j ] ) ) {
					$cont_content = count( $all_services[ $j ] );
					if ( $cont_content >= 0 ) {
						$class_cont_content = '';
					}
				}
			}
			?>
		</div>
		<?php foreach ( $cats as $key => $cat ) : ?>
			<?php
			$name     = spl_esc_output( $cat['name'] );
			$id       = get_id_name( spl_esc_output( $name ) );
			$services = $cat['services'];
			if ( $default == $key ) {
				$act_tab   = 'active';
				$style_act = '';
			} else {
				$act_tab   = '';
				$style_act = 'display:none';
			}
			?>
			<div class="tab style-8-cards 
			<?php
			if ( $select_column == 'Two' ) {
				echo 'is-two-column ';}
											echo esc_attr($act_tab);
			?>
											" id="<?php echo esc_attr($key) . '_' . $shortcode_id; ?>" style="<?php echo esc_attr($style_act); ?>">
				<?php
				if ( $cat['description'] != '' ) {
					?>
					<div class="custom-description-section">
						<?php echo spl_esc_output( nl2br( $cat['description'] ) ); ?>
					</div>
				<?php } ?>

				<?php
				$k = 1;
				foreach ( $services as $key => $service ) {
					echo output_service_style8( $service, $is_buy_btn_newtab_enabled ); //$services[$k]
					$k = $k + 2;
				}
				?>
				<?php
				$l = 2;
				?>
				<?php
				foreach ( $all_services as $key => $service ) {
					$class_cont_content = 'hide-right';
					if ( $service ) {
						$cont_content = count( $service );
						//echo $cont_content;
						if ( $cont_content >= 0 ) {
							$class_cont_content = '';
						}
					}
				}
				?>
			</div>
		<?php endforeach ?>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_tab_contents()
} //end if !function_exists('output_tab_contents_style7')
if ( ! function_exists( 'output_tabs_style7' ) ) {
	function output_tabs_style7( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled, $df_number_of_cats ) {
		ob_start();
		if ( $df_number_of_cats ) {
			$cats = array_slice( $cats, 0, $df_number_of_cats, true );
		}
		?>
		<?php foreach ( $cats as $key => $cat ) : ?>
			<?php
			$name        = $cat['name'];
			$description = $cat['description'];
			$id          = get_id_name( spl_esc_output( $name ) );
			$name1       = spl_esc_output( $cat['name'] );
			$id1         = get_id_name( spl_esc_output( $name1 ) );
			if ( $default == $key ) {
				$act_tab = 'active default';
			} else {
				$act_tab = '';
			}
			if ( strtolower( $default ) == strtolower( $name ) ) {
				$act = 'active';
			} else {
				$act = '';
			}
			?>
			<li class="
			<?php
			echo esc_attr($act_tab);
			if ( $name == '' ) {
				echo ' hidden';
			}
			?>
						">
				<a href="javascript:void(0)" data-href="#<?php echo esc_attr($key) . '_' . $shortcode_id; ?>"><?php echo spl_esc_output( $name ); ?></a>
			</li>
		<?php endforeach ?>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_tabs()
} //end if !function_exists('output_tabs')
if ( ! function_exists( 'df_spl_output_a_tag' ) ) {
	function df_spl_output_a_tag( $text, $id = '', $class = '', $is_popular = false, $popular_text = 'Popular' ) {
		ob_start();
		?>
		<div data-price-list-fragment="item_name" class="<?php echo esc_attr($class); ?>">
			<span><?php echo spl_esc_output($text); ?></span>
			<?php if ( $class === 'name a-tag' && $is_popular ) { ?>
				<span class="spl-item-popular">
					⭐ <?php echo esc_attr($popular_text); ?>
				</span>
			<?php } ?>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end df_spl_output_a_tag()
} //end if !function_exists('df_spl_output_a_tag')
if ( ! function_exists( 'df_spl_output_a_tag_style5' ) ) {
	function df_spl_output_a_tag_style5( $text, $id = '', $class = '' ) {
		ob_start();
		?>
		<div class="<?php echo esc_attr($class); ?>">
			<p><?php echo spl_esc_output($text); ?></p>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end df_spl_output_a_tag_style5()
} //end if !function_exists('df_spl_output_a_tag_style5')
// style 1 (style1 style-1) col 1 starts here
if ( ! function_exists( 'output_tab_contents_col1' ) ) {
	function output_tab_contents_col1( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ) {
		ob_start();
		?>
		<?php
		$all_services = array();
		foreach ( $cats as $key => $cat ) {
			$services = $cat['services'];
			foreach ( $services as $key => $service ) {
				$name           = $service['name'];
				$all_services[] = $service;
			}
		}
		?>
		<div class="tab <?php echo ( $default ) ? '' : 'active'; ?>" id="all_<?php echo esc_attr($shortcode_id); ?>" style="<?php echo ( $default ) ? 'display:none' : ''; ?>">
			<?php
			foreach ( $all_services as $key => $service ) {
				echo output_service_col1( $service, $is_buy_btn_newtab_enabled );
			}
			?>
		</div>
		<?php foreach ( $cats as $key => $cat ) : ?>
			<?php
			$name     = spl_esc_output( $cat['name'] );
			$id       = get_id_name( spl_esc_output( $name ) );
			$services = $cat['services'];
			if ( $default == $key ) {
				$act_tab   = 'active';
				$style_act = 'display:block';
			} else {
				$act_tab   = '';
				$style_act = 'display:none';
			}
			?>
			<div class="tab <?php echo esc_attr($act_tab); ?>" id="<?php echo esc_attr($key) . '_' . $shortcode_id; ?>" style="<?php echo esc_attr($style_act); ?>">
				<?php
				if ( $cat['description'] != '' ) {
					?>
					<div class="df-spl-row">
						<div class="col-sm-8 col-sm-offset-2 custom-description-section">
							<?php echo spl_esc_output( nl2br( $cat['description'] ) ); ?>
						</div>
					</div>
				<?php } ?>
				<div class="df-spl-row">
					<?php
					foreach ( $services as $key => $service ) {
						echo output_service_col1( $service, $is_buy_btn_newtab_enabled );
					}
					?>
				</div>
			</div>
		<?php endforeach ?>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_tab_contents()
}
// style 1 col 1 ends
// style 6 single and two column start
if ( ! function_exists( 'output_tab_contents_style6' ) ) {
	function output_tab_contents_style6( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled = 0, $is_single_column = false ) {
		// dump($cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled);
		$all_services = array();
		$columns      = $is_single_column ? 'col-md-12' : 'col-md-6';
		foreach ( $cats as $key => $cat ) {
			$services = $cat['services'];
			foreach ( $services as $key => $service ) {
				$name           = $service['name'];
				$all_services[] = $service;
			}
		}
		ob_start();
		?>
		<div class="tab <?php echo ( $default ) ? '' : 'active'; ?>" id="all_<?php echo esc_attr($shortcode_id); ?>" style="<?php echo ( $default ) ? 'display:none' : 'display:block'; ?>">
			<div class="df-spl-row">
				<div class="<?php echo esc_attr( $columns ); ?>">
					<?php
					$i = 0;
					?>
					<?php
					foreach ( $all_services as $key => $service ) {
						if ( array_key_exists( $i, $all_services ) ) { 
							echo output_service_style6_item( $all_services[ $i ], $is_buy_btn_newtab_enabled ); 
						}
						$i = $i + ( $is_single_column ? 1 : 2 );
					}
					?>
				</div>
				<?php if ( ! $is_single_column ) { ?>
				<div class="<?php echo esc_attr( $columns ); ?>">
					<?php
					$j = 1;
					?>
					<?php
					foreach ( $all_services as $key => $service ) {
						echo array_key_exists( $j, $all_services ) ? output_service_style6_item( $all_services[ $j ], $is_buy_btn_newtab_enabled ) : false;
						$j = $j + 2;
					}
					?>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php foreach ( $cats as $key => $cat ) : ?>
			<?php
			$name     = spl_esc_output( $cat['name'] );
			$id       = get_id_name( spl_esc_output( $name ) );
			$services = array_values( $cat['services'] );
			if ( $default == $key ) {
				$act_tab   = 'active';
				$style_act = 'display:block';
			} else {
				$act_tab   = '';
				$style_act = 'display:none';
			}
			?>
			<div class="tab <?php echo esc_attr($act_tab); ?>" id="<?php echo esc_attr($key) . '_' . $shortcode_id; ?>" style="<?php echo esc_attr($style_act); ?>">
				<?php
				if ( $cat['description'] != '' ) {
					?>
					<div class="df-spl-row">
						<div class="col-sm-8 col-sm-offset-2 custom-description-section">
							<?php echo spl_esc_output( nl2br( $cat['description'] ) ); ?>
						</div>
					</div>
				<?php } ?>
				<div class="df-spl-row">
					<div class="<?php echo esc_attr( $columns ); ?>">
						<?php
						$i = 0;
						?>
						<?php
						foreach ( $services as $key => $service ) {
							echo array_key_exists( $i, $services ) ? output_service_style6_item( $services[ $i ], $is_buy_btn_newtab_enabled ) : false;
							$i = $i + ( $is_single_column ? 1 : 2 );
						}
						?>
					</div>
					<?php if ( ! $is_single_column ) { ?>
					<div class="<?php echo esc_attr( $columns ); ?>">
						<?php
						$j = 1;
						?>
						<?php
						foreach ( $services as $key => $service ) {
							echo array_key_exists( $j, $services ) ? output_service_style6_item( $services[ $j ], $is_buy_btn_newtab_enabled ) : false;
							$j = $j + 2;
						}
						?>
					</div>
					<?php } ?>
				</div>
			</div>
		<?php endforeach ?>
		<?php
		$html = ob_get_clean();
		return $html;
	}
} // style 6 two column end
// Start of Style 7, Style7, Style-7
if ( ! function_exists( 'output_service_style7' ) ) {
	function output_service_style7( $service, $is_buy_btn_newtab_enabled ) {
		isset( $service ) ? extract( $service ) : false;
		if ( empty( $name ) ) {
			return;
		}
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		ob_start();
		?>
		<div class="style-seven">
			<div class="spl-style-7">
				<?php if ( ! empty( $service['service_button'] ) ) { ?>
					<div class="spl-seven-bottom">
						<div class="col-md-6 col-sm-6 col-xs-6">
							<?php if ( ! empty( $service['service_url'] ) ) { ?>
								<a href="<?php echo esc_attr($service['service_url']); ?>"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
							<?php } else { ?>
								<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text'] ); ?>
								<?php
							}
							echo df_spl_output_a_tag( $desc, '', 'desc a-tag' );
							?>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6 padding-left-no">
							<div class="spl-style7-price"><?php echo df_spl_output_a_tag_style5( $price, '', 'spl-price a-tag' ); ?><a href="<?php echo esc_attr($service['service_button_url']); ?>" <?php echo isset( $newTabOpen ) ? esc_attr($newTabOpen) : ''; ?> class="btn btn-book-now spl_book_now_btn_style_7"><?php echo esc_attr($service['service_button']); ?></a></div>
						</div>
					</div>
				<?php } else { ?>
					<div class="spl-seven-bottom">
						<div class="col-md-9 col-sm-9 col-xs-9">
							<?php if ( ! empty( $service['service_url'] ) ) { ?>
								<a href="<?php echo esc_attr($service['service_url']); ?>"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
							<?php } else { ?>
								<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text'] ); ?>
								<?php
							}
							echo df_spl_output_a_tag( $desc, '', 'desc a-tag' );
							?>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3 padding-left-no" style="margin-top:0px">
							<div class="spl-style7-price"><?php echo df_spl_output_a_tag_style5( $price, '', 'spl-price a-tag' ); ?></div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_service_style4()
}
//End function for style4//
// Continue of Style 7, Style7, Style-7
if ( ! function_exists( 'output_service_style7b' ) ) {
	function output_service_style7b( $service, $is_buy_btn_newtab_enabled ) {
		if ( ! empty( $service ) ) {
			extract( $service );
		}
		if ( empty( $name ) ) {
			return;
		}
		$price = "<span data-price=$price>" . esc_attr( $price ) . '</span>';
		$price = empty($settings_compare_at) ? $price : '<s>'.$settings_compare_at.'</s>'. ' ' . $price;
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		ob_start();
		?>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 name-price-desc spl-item-root" <?php foreach ($tooltip_config as $key => $value) {
			if ( empty( $value ) ) continue;
    		echo esc_attr($key) . '="' . esc_attr($value) . '" ';
		} ?>>
			<?php if ( ! empty( $service['service_button'] ) ) { ?>
				<div class="df-spl-row name-price style-7 spl_cstm_style2">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 spl_cstm_style_2_book-full">
						<div class="spl-d-flex spl-s7-content">
							<div class="s7-left-content">
								<?php if ( ! empty( $service['service_url'] ) ) { ?>
									<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank" class="btn btn-book-now spl_book_now_btn_style_7"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
								<?php } else { ?>
									<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text'] ); ?>
								<?php } ?>
								<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
							</div>
							<div class="s7-right-content">
								<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag spl-style-7-price' ); ?>
								<a href="<?php echo esc_attr($service['service_button_url']); ?>" <?php echo isset( $newTabOpen ) ? esc_attr($newTabOpen) : ''; ?> class="btn btn-book-now spl_book_now_btn_style_7"><?php echo esc_attr($service['service_button']); ?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="spl-seven-bottom">
				</div>
			<?php } else { ?>
				<div class="spl-d-flex spl-s7-content">
					<div class="s7-left-content">
						<?php if ( ! empty( $service['service_url'] ) ) { ?>
							<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank" class="btn btn-book-now spl_book_now_btn_style_1"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
						<?php } else { ?>
							<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
						<?php } ?>
					</div>
					<div class="s7-left-content" style="padding:0px">
						<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
					</div>
				</div>
				<div class="df-spl-row desc">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 spl-p-0">
						<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
					</div>
				</div>
				<div class="spl-seven-bottom">
				</div>
			<?php } ?>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_service()
}
if ( ! function_exists( 'output_service_style8' ) ) {
	function output_service_style8( $service, $is_buy_btn_newtab_enabled ) {
		if ( ! empty( $service ) ) {
			extract( $service );
		}
		if ( empty( $name ) ) {
			return;
		}
		$price = "<span data-price=$price>" . esc_attr( $price ) . '</span>';
		$price = empty($settings_compare_at) ? $price : '<s>'.$settings_compare_at.'</s>'. ' ' . $price;
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		ob_start();
		?>
		<div class="style-8-card clearfix spl-item-root <?php echo $service['service_image'] ? 'style8-has-images' : ''; ?>" <?php foreach ($tooltip_config as $key => $value) {
			if ( empty( $value ) ) continue;
    		echo esc_attr($key) . '="' . esc_attr($value) . '" ';
		} ?>>
			<?php if ( $service['service_image'] ) { ?>
				<div class="style8-desc-with-image">
					<div class="spl-style8-img-container df-spl-pull-left">
						<img src="<?php echo esc_attr($service['service_image']); ?>">
					</div>
					<div class="style-8-card-content">
						<div class="style-8-title-with-pricetag">
							<div class="style-8-title-container">
								<h3 data-price-list-fragment="item_name">
									<span><?php echo esc_attr($name); ?></span>
									<?php if ( $service['is_popular'] === true ) { ?>
										<span class="spl-item-popular">
											⭐ <?php echo esc_attr($service['popular_text']); ?>
										</span>
									<?php } ?>
								</h3>
								<small><?php echo esc_attr($desc); ?></small>
							</div>
						</div>
						<p class="style-8-description"><?php echo esc_attr($service_long_description); ?></p>
					</div>
				</div>
				<div class="style-8-pricetag-container">
					<div class="pricetag">
						<span data-price-list-fragment="price"><?php echo spl_esc_output($price); ?></span>
					</div>
				</div>
			<?php } else { ?>
			<div class="style-8-card-content">
				<div class="style-8-title-with-pricetag">
					<div class="style-8-title-container">
						<h3 data-price-list-fragment="item_name">
							<span><?php echo esc_attr($name); ?></span>
							<?php if ( $service['is_popular'] === 'on' ) { ?>
								<span class="spl-item-popular">
									⭐ <?php echo esc_attr($service['popular_text']); ?>
								</span>
							<?php } ?>
						</h3>
						<small><?php echo esc_attr($desc); ?></small>
					</div>
					<div class="style-8-pricetag-container">
						<div class="pricetag">
							<span data-price-list-fragment="price"><?php echo spl_esc_output($price); ?></span>
						</div>
					</div>
				</div>
				<p class="style-8-description"><?php echo esc_attr($service_long_description); ?></p>
			</div>
			<?php } ?>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_service()
}
if ( ! function_exists( 'output_service_style7_single_col' ) ) {
	function output_service_style7_single_col( $service, $is_buy_btn_newtab_enabled ) {
		if ( ! empty( $service ) ) {
			extract( $service );
		}
		if ( empty( $name ) ) {
			return;
		}
		$price = "<span data-price=$price>" . esc_attr( $price ) . '</span>';
		$price = empty($settings_compare_at) ? $price : '<s>'.$settings_compare_at.'</s>'. ' ' . $price;
		if ( isset( $is_buy_btn_newtab_enabled ) && $is_buy_btn_newtab_enabled == '1' ) {
			$newTabOpen = 'target="_blank"';
		}
		ob_start();
		?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 name-price-desc spl-item-root" <?php foreach ($tooltip_config as $key => $value) {
			if ( empty( $value ) ) continue;
    		echo esc_attr($key) . '="' . esc_attr($value) . '" ';
		} ?>>
			<?php if ( ! empty( $service['service_button'] ) ) { ?>
				<div class="df-spl-row name-price style-7 spl_cstm_style2">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 spl_cstm_style_2_book-full">
						<div class="df-spl-row">
							<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 spl_cstm_style_2_book">
								<?php if ( ! empty( $service['service_url'] ) ) { ?>
									<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank" class="btn btn-book-now spl_book_now_btn_style_7"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
								<?php } else { ?>
									<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
								<?php } ?>
								<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
							</div>
							<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 right-style-2">
								<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag spl-style-7-price' ); ?>
								<a href="<?php echo esc_attr($service['service_button_url']); ?>" <?php echo isset( $newTabOpen ) ? esc_attr($newTabOpen) : ''; ?> class="btn btn-book-now spl_book_now_btn_style_7"><?php echo esc_attr($service['service_button']); ?></a>
							</div>
						</div>
					</div>
				</div>
				<div class="spl-seven-bottom">
				</div>
			<?php } else { ?>
				<div class="df-spl-row name-price">
					<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
						<?php if ( ! empty( $service['service_url'] ) ) { ?>
							<a href="<?php echo esc_attr($service['service_url']); ?>" target="_blank" class="btn btn-book-now spl_book_now_btn_style_1"><?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?></a>
						<?php } else { ?>
							<?php echo df_spl_output_a_tag( $name, '', 'name a-tag', $service['is_popular'] === 'on', $service['popular_text']); ?>
						<?php } ?>
					</div>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<?php echo df_spl_output_a_tag( $price, '', 'spl-price a-tag' ); ?>
					</div>
				</div>
				<div class="df-spl-row desc">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 spl-p-0">
						<?php echo df_spl_output_a_tag( $desc, '', 'desc a-tag' ); ?>
					</div>
				</div>
				<div class="spl-seven-bottom">
				</div>
			<?php } ?>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_service()
}
if ( ! function_exists( 'output_tab_contents' ) ) {
	function output_tab_contents( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ) {
		ob_start();
		?>
		<?php
		$all_services = array();
		foreach ( $cats as $key => $cat ) {
			$services = $cat['services'];
			foreach ( $services as $key => $service ) {
				$name = $service['name'];
				// $id=get_id_name($name);
				// $all_services[$id]=$service;
				$all_services[] = $service;
			}
		}
		?>
		<div class="tab <?php echo ( $default ) ? '' : 'active'; ?>" id="all_<?php echo esc_attr($shortcode_id); ?>" style="<?php echo ( $default ) ? 'display:none' : ''; ?>">
			<?php
			foreach ( $all_services as $key => $service ) {
				echo output_service( $service, $is_buy_btn_newtab_enabled );
			}
			?>
		</div>
		<?php foreach ( $cats as $key => $cat ) : ?>
			<?php
			$name     = spl_esc_output( $cat['name'] );
			$id       = get_id_name( spl_esc_output( $name ) );
			$services = $cat['services'];
			// if(!empty($services)){
			//echo get_id_name($default);
			// }
			if ( $default == $key ) {
				$act_tab   = 'active';
				$style_act = 'display:block';
			} else {
				$act_tab   = '';
				$style_act = 'display:none';
			}
			?>
			<div class="tab <?php echo esc_attr($act_tab); ?>" id="<?php echo esc_attr($key) . '_' . $shortcode_id; ?>" style="<?php echo esc_attr($style_act); ?>">
			<?php
				if ( $cat['description'] != '' ) {
					?>
					<div class="df-spl-row">
						<div class="col-sm-8 col-sm-offset-2 custom-description-section">
							<?php echo spl_esc_output( nl2br( $cat['description'] ) ); ?>
						</div>
					</div>
				<?php } ?>
				<div class="df-spl-row">
					<?php
					foreach ( $services as $key => $service ) {
						echo output_service( $service, $is_buy_btn_newtab_enabled );
					}
					?>
				</div>
			</div>
		<?php endforeach ?>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_tab_contents()
} //end if !function_exists('output_tab_contents')
if ( ! function_exists( 'output_tabs' ) ) {
	function output_tabs( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ) {
		ob_start();
		?>
		<?php foreach ( $cats as $key => $cat ) : ?>
			<?php
			$name        = $cat['name'];
			$description = $cat['description'];
			$id          = get_id_name( spl_esc_output( $name ) );
			$name1       = spl_esc_output( $cat['name'] );
			$id1         = get_id_name( spl_esc_output( $name1 ) );
			if ( $default == $key ) {
				$act_tab = 'active default';
			} else {
				$act_tab = '';
			}
			if ( strtolower( $default ) == strtolower( $name ) ) {
				$act = 'active';
			} else {
				$act = '';
			}
			?>
			<li class="
			<?php
			echo esc_attr($act_tab);
			if ( $name == '' ) {
				echo ' hidden';
			}
			?>
						">
				<a href="javascript:void(0)" data-target-cat-key="<?php echo esc_attr( $key ); ?>" data-href="#<?php echo esc_attr($key) . '_' . $shortcode_id; ?>"><?php echo wp_kses_post( spl_esc_output( $name ) ); ?></a>
			</li>
		<?php endforeach ?>
		<?php
		$html = ob_get_clean();
		return $html;
	} //end output_tabs()
} //end if !function_exists('output_tabs')
if ( ! function_exists( 'get_id_name' ) ) {
	function get_id_name( $in ) {
		$in  = strtolower( trim( $in ) );
		$out = preg_replace( '/[^\w]+/', '-', $in );
		return $out;
	} //end get_id_name()
} //end if !function_exists('get_id_name')
/**********Function for second style************/
if ( ! function_exists( 'output_tab_contents_second_style' ) ) {
	function output_tab_contents_second_style( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ) {
		foreach ( $cats as $key => $cat ) {
			$services = $cat['services'];
			?>
			<span class="head-title tab-links_spl spl_cat_title_style_2"><?php echo spl_esc_output( $cat['name'] ); ?></span>
			<?php if ( $cat['description'] ) { ?>
				<div class="cat_descreption row clearfix" style="padding:0;">
					<div class="col-sm-12" style="padding:0;"><?php echo spl_esc_output( $cat['description'] ); ?></div>
				</div>
			<?php } ?>
			<div class="df-spl-grid two-column style-2-row">
				<?php
				foreach ( $services as $key => $service ) {
					echo output_service_style2_beta( $service, $is_buy_btn_newtab_enabled );
					// echo output_service_style2( $service, $is_buy_btn_newtab_enabled );
				}
				?>
			</div>
			<?php
		}
		?>
		<?php
	} //end get_id_name()
}
/**********End Function for second style************/
/**********Function for second style single column************/
if ( ! function_exists( 'output_tab_contents_second_style_single_column' ) ) {
	function output_tab_contents_second_style_single_column( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ) {
		foreach ( $cats as $key => $cat ) {
			$services = $cat['services'];
			?>
			<span class="head-title tab-links_spl spl_cat_title_style_2"><?php echo spl_esc_output( $cat['name'] ); ?></span>
			<?php if ( $cat['description'] ) { ?>
				<div class="cat_descreption row" style="padding:0;">
					<div class="col-sm-12" syle="padding:0"><?php echo spl_esc_output( $cat['description'] ); ?></div>
				</div>
			<?php } ?>
			<div class="df-spl-row style-2-row">
				<?php
				foreach ( $services as $key => $service ) {
					echo output_service_style2_single_column( $service, $is_buy_btn_newtab_enabled );
				}
				?>
			</div>
			<?php
		}
		?>
		<?php
	} //end get_id_name()
}
/**********End Function for second style single column************/
/**********Start Function for Style-3 Style3 Style 3 Third style*****************/
if ( ! function_exists( 'output_tab_contents_third_style' ) ) {
	function output_tab_contents_third_style( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ) {
		?>
		<!---df-spl-row masonry -->
		<div class="masonary-section" id="main_<?php echo esc_attr($shortcode_id); ?>" role="main">
			<div id="tiles_<?php echo esc_attr($shortcode_id); ?>">
				<?php
				foreach ( $cats as $key => $cat ) {
					$services = $cat['services'];
					?>
					<!-- These are our grid blocks -->
					<div class="grid-sizer col-sm-4" style="padding:5px">
						<div class="grid-item-content">
							<div class="name-price-desc for-style-3">
								<span class="head-title tab-links_spl head_title_style_3 spl_cat_title_style_3"><?php echo spl_esc_output( $cat['name'] ); ?></span>
								<?php if ( $cat['description'] ) { ?>
									<div class="cat_descreption row" style="padding-top:5px;">
										<div class="style3_cat_desc" style="padding:0"><?php echo spl_esc_output( $cat['description'] ); ?></div>
									</div>
								<?php } ?>
								<?php
								foreach ( $services as $key => $service ) {
									echo output_service_style3( $service, $is_buy_btn_newtab_enabled );
								}
								?>
							</div>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	} //end get_id_name()
}
// Style 3 col 2
if ( ! function_exists( 'output_tab_contents_third_style_col2' ) ) {
	function output_tab_contents_third_style_col2( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ) {
		?>
		<!---df-spl-row masonry -->
		<div class="masonary-section" id="main_<?php echo esc_attr($shortcode_id); ?>" role="main">
			<div id="tiles_<?php echo esc_attr($shortcode_id); ?>">
				<?php
				foreach ( $cats as $key => $cat ) {
					$services = $cat['services'];
					?>
					<!-- These are our grid blocks -->
					<div class="grid-sizer col-sm-6">
						<div class="grid-item-content">
							<div class="name-price-desc for-style-3">
								<span class="head-title tab-links_spl head_title_style_3 spl_cat_title_style_3"><?php echo spl_esc_output( $cat['name'] ); ?></span>
								<?php if ( $cat['description'] ) { ?>
									<div class="cat_descreption row" style="padding-top:5px;">
										<div class="style3_cat_desc" style="padding:0;"><?php echo spl_esc_output( $cat['description'] ); ?></div>
									</div>
								<?php } ?>
								<?php
								foreach ( $services as $key => $service ) {
									echo output_service_style3( $service, $is_buy_btn_newtab_enabled );
								}
								?>
							</div>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	} //end get_id_name()
}
// Style 3 col 1
if ( ! function_exists( 'output_tab_contents_third_style_col1' ) ) {
	function output_tab_contents_third_style_col1( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ) {
		?>
		<!---df-spl-row masonry -->
		<div class="masonary-section" id="main_<?php echo esc_attr($shortcode_id); ?>" data-style="style-3" role="main">
			<div id="tiles_<?php echo esc_attr($shortcode_id); ?>">
				<?php
				foreach ( $cats as $key => $cat ) {
					$services = $cat['services'];
					?>
					<!-- These are our grid blocks -->
					<div class="grid-sizer col-sm-12">
						<div class="grid-item-content">
							<div class="name-price-desc for-style-3">
								<span class="head-title tab-links_spl head_title_style_3 spl_cat_title_style_3"><?php echo spl_esc_output( $cat['name'] ); ?></span>
								<?php if ( $cat['description'] ) { ?>
									<div class="cat_descreption row" style="padding-top:5px;">
										<div class="style3_cat_desc" style="padding:0;"><?php echo spl_esc_output( $cat['description'] ); ?></div>
									</div>
								<?php } ?>
								<?php
								foreach ( $services as $key => $service ) {
									echo output_service_style3( $service, $is_buy_btn_newtab_enabled );
								}
								?>
							</div>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	} //end get_id_name()
}
/**********End Function for Third style*****************/
/**********Start Function For 4 style col 1*******************/
if ( ! function_exists( 'output_tab_contents_fourth_style_col1' ) ) {
	function output_tab_contents_fourth_style_col1( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ) {
		?>
		<!---df-spl-row masonry -->
		<ul id="tiles">
			<?php
			foreach ( $cats as $key => $cat ) {
				$services = $cat['services'];
				?>
				<!-- These are our grid blocks -->
				<li>
					<div class="name-price-desc for-style-4 style-4-half"><span class="head-title tab-links_spl spl_cat_heading_style_4"><?php echo spl_esc_output( $cat['name'] ); ?></span>
																																									   <?php
																																										if ( $cat['description'] ) {
																																											?>
						<div class="cat_descreption row">
								<div class="style4_cat_desc"><?php echo spl_esc_output( $cat['description'] ); ?></div>
							</div>
							<?php } ?>
									<?php
									foreach ( $services as $key => $service ) {
											echo output_service_style4_col1( $service, $is_buy_btn_newtab_enabled );
									}
									?>
										</div>
				</li><?php } ?>
		</ul>
		<?php
	} //end get_id_name()
}
/**********End Function For 4 style col 1*********************/
/**********Start Function For 4 style*******************/
if ( ! function_exists( 'output_tab_contents_fourth_style' ) ) {
	function output_tab_contents_fourth_style( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ) {
		?>
		<!---df-spl-row masonry -->
		<ul id="tiles">
			<?php
			foreach ( $cats as $key => $cat ) {
				$services = $cat['services'];
				?>
				<!-- These are our grid blocks -->
				<li>
					<div class="name-price-desc for-style-4 style-4-half"><span class="head-title tab-links_spl spl_cat_heading_style_4"><?php echo spl_esc_output( $cat['name'] ); ?></span>
																																									   <?php
																																										if ( $cat['description'] ) {
																																											?>
						<div class="cat_descreption row">
								<div class="style4_cat_desc"><?php echo spl_esc_output( $cat['description'] ); ?></div>
							</div>
							<?php } ?>
									<?php
									foreach ( $services as $key => $service ) {
											echo output_service_style4( $service, $is_buy_btn_newtab_enabled );
									}
									?>
										</div>
				</li><?php } ?>
		</ul>
		<?php
	} //end get_id_name()
}
/**********End Function For 4 style*********************/
/**********Function for 4 style break service col 1************/
if ( ! function_exists( 'output_tab_contents_4_style_break_col1' ) ) {
	function output_tab_contents_4_style_break_col1( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ) {
		foreach ( $cats as $key => $cat ) {
			$services = $cat['services'];
			?>
			<span class="head-title tab-links_spl"><?php echo spl_esc_output( $cat['name'] ); ?></span>
			<?php if ( $cat['description'] ) { ?>
				<div class="cat_descreption row">
					<div class="col-sm-6"><?php echo spl_esc_output( $cat['description'] ); ?></div>
				</div>
			<?php } ?>
			<div class="df-spl-row">
				<?php
				foreach ( $services as $key => $service ) {
					echo output_service_break_col1( $service, $is_buy_btn_newtab_enabled );
				}
				?>
			</div>
			<?php
		}
		?>
		<?php
	} //end get_id_name()
}
/**********End Function for 4 style break service col 1************/
/**********Function for 4 style break service************/
if ( ! function_exists( 'output_tab_contents_4_style_break' ) ) {
	function output_tab_contents_4_style_break( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ) {
		foreach ( $cats as $key => $cat ) {
			$services = $cat['services'];
			?>
			<span class="head-title tab-links_spl"><?php echo spl_esc_output( $cat['name'] ); ?></span>
			<?php if ( $cat['description'] ) { ?>
				<div class="cat_descreption row" style="padding:0;">
					<div class="col-sm-6"><?php echo spl_esc_output( $cat['description'] ); ?></div>
				</div>
			<?php } ?>
			<div class="df-spl-row">
				<?php
				foreach ( $services as $key => $service ) {
					echo output_service_break( $service, $is_buy_btn_newtab_enabled );
				}
				?>
			</div>
			<?php
		}
		?>
		<?php
	} //end get_id_name()
}
/**********End Function for 4 style break service************/
?>
<?php
if ( $style == 'style_6' ) {
	$max_width = '1200px';
}
if ( $style == 'with_tab' ) {
	$max_width = '1200px';
}
if ( $style == 'with_tab' || $style == '' ) {
	if ( $df_number_of_cats ) {
		$cats = array_slice( $cats, 0, $df_number_of_cats, true );
	}
	?>
	<div class="body-inner container-fluid price_wrapper with_tab df-spl-pull-left col-md-12 spl_main_content_box" data-config=<?php echo esc_js( json_encode( $pricelist_config ) ); ?> id="spl_<?php echo esc_attr($id); ?>" data-style="<?php echo esc_attr($style); ?>" style="max-width:<?php echo isset( $max_width ) ? esc_attr($max_width) : ''; ?>;margin-left:auto;margin-right:auto; ">
		<?php if ( ! empty( $service['service_button'] ) ) { ?>
			<div class="head-title">
				<span class="with_tab_style1">
				<?php
				if ( $spl_remove_title != 1 ) {
													echo esc_attr($list_name);
				}
				?>
												</span>
			</div>
			<nav class="searchbar-and-price-range-wrapper clearfix <?php echo $enable_price_range_slider ? 'has-price-range' : ''; ?>">
			<?php if ( $enable_price_range_slider ) : ?>
					<div id="spl-slider-handles" data-target="spl_<?php echo esc_attr($shortcode_id); ?>"></div>
			<?php endif; ?>
			<?php if ( $enable_searchbar ) : ?>
				<nav class="pricelist-searchbar clearfix">
					<input type="text" name="search" class="spl-mysearch" data-target="spl_<?php echo esc_attr($shortcode_id); ?>">
					<div class="spl-searchbar-icon" style="background-color: <?php echo esc_attr($title_color_top); ?>"><span class="spl-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" height="14px" viewBox="0 0 24 24" width="14px" fill="#fff">
								<path d="M0 0h24v24H0V0z" fill="none" />
								<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
							</svg></span>
					</div>
				</nav>
			<?php endif; ?>
			</nav>
			<?php if ( $price_list_desc != '' ) { ?>
				<div class="col-sm-8 col-sm-offset-2 desc_price_list"><?php echo spl_esc_output( preg_replace( '/[\n\r]/', '<br />', str_replace( '\"', '"', str_replace( "\'", "'", stripslashes( $price_list_desc ) ) ) ) ); ?></div>
			<?php } ?>
			<div class="tabs_spl">
				<?php if ( $show_dropdown ) : ?>
					<select class="cats-dd" autocomplete="off" <?php if ($dropdown_mobile_no_keyboard == '1') echo 'data-no-keyboard-popup=1' ?>>
						<?php echo output_dropdown_choices( $cats, $id, $toggle_all_tab == 1, $default, $all_tab ); ?>
					</select>
					<?php
				endif;
				if ( ! $show_dropdown ) :
					?>
					<!-- Nav tabs -->
					<ul class="tab-links_spl with_tab_tablink_style1" style="margin-left:0px;">
						<?php
						if ( $all_tab != '' && $toggle_all_tab == 1 ) {
							?>
							<li class="<?php echo ( $default ) ? '' : 'active'; ?>">
								<a data-href="#<?php echo 'all_' . esc_attr( $id ); ?>" href="javascript:void(0)"><?php echo esc_attr($all_tab); ?></a>
							</li>
							<?php
						}
						if ( $all_tab == '' && $toggle_all_tab == '' ) {
							?>
							<li class="<?php echo ( $default ) ? '' : 'active'; ?>">
								<a href="#all_<?php echo esc_attr($id); ?>">All</a>
							</li>
							<?php
						}
						echo output_tabs( $cats, $default, $id, $is_buy_btn_newtab_enabled );
						?>
					</ul>
				<?php endif; ?>
				<!-- Tab panes -->
				<div class="tab-content1 <?php echo esc_attr($select_column); ?>">
					<?php
					if ( $select_column == 'One' ) {
						if ( $style == 'style_6' ) {
							echo output_tab_contents_style6( $cats, $default, $id, $is_buy_btn_newtab_enabled, $title_color_top );
						} else {
							echo output_tab_contents_col1( $cats, $default, $id, $is_buy_btn_newtab_enabled );
						}
					} else {
						if ( $style == 'style_6' ) {
							echo output_tab_contents_style6( $cats, $default, $id, $is_buy_btn_newtab_enabled, true );
						} else {
							echo output_tab_contents( $cats, $default, $id, $is_buy_btn_newtab_enabled );
						}
					}
					?>
				</div>
			</div>
		<?php } else { ?>
			<div class="head-title">
				<span>
				<?php
				if ( $spl_remove_title != 1 ) {
							echo esc_attr($list_name);
				}
				?>
						</span>
			</div>
			<nav class="searchbar-and-price-range-wrapper clearfix <?php echo $enable_price_range_slider ? 'has-price-range' : ''; ?>">
			<?php if ( $enable_price_range_slider ) : ?>
					<div id="spl-slider-handles" data-target="spl_<?php echo esc_attr($shortcode_id); ?>"></div>
			<?php endif; ?>
			<?php if ( $enable_searchbar ) : ?>
				<nav class="pricelist-searchbar clearfix">
					<input type="text" name="search" class="spl-mysearch" data-target="spl_<?php echo esc_attr($shortcode_id); ?>">
					<div class="spl-searchbar-icon" style="background-color: <?php echo esc_attr($title_color_top); ?>"><span class="spl-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" height="14px" viewBox="0 0 24 24" width="14px" fill="#fff">
								<path d="M0 0h24v24H0V0z" fill="none" />
								<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
							</svg></span>
					</div>
				</nav>
			<?php endif; ?>
			</nav>
			<?php if ( $price_list_desc != '' ) { ?>
				<div class="col-sm-8 col-sm-offset-2 desc_price_list"><?php echo spl_esc_output( preg_replace( '/[\n\r]/', '<br />', str_replace( '\"', '"', str_replace( "\'", "'", stripslashes( $price_list_desc ) ) ) ) ); ?></div>
			<?php } ?>
			<div class="tabs_spl">
				<?php if ( $show_dropdown ) : ?>
					<select class="cats-dd" autocomplete="off" <?php if ($dropdown_mobile_no_keyboard == '1') echo 'data-no-keyboard-popup=1' ?>>
						<?php echo output_dropdown_choices( $cats, $id, $toggle_all_tab == 1, $default, $all_tab ); ?>
					</select>
					<?php
				endif;
				if ( ! $show_dropdown ) :
					?>
					<!-- Nav tabs -->
					<ul class="tab-links_spl">
						<?php
						if ( $all_tab != '' && $toggle_all_tab == 1 ) {
							?>
							<li class="<?php echo ( $default ) ? '' : 'active'; ?>">
								<a href="javascript:void(0)" data-href="#all_<?php echo esc_attr($id); ?>"><?php echo esc_attr($all_tab); ?></a>
							</li>
							<?php
						}
						if ( $all_tab == '' && $toggle_all_tab == '' ) {
							?>
							<li class="<?php echo ( $default ) ? '' : 'active'; ?>">
								<a href="javascript:void(0)" data-href="#all_<?php echo esc_attr($id); ?>">All</a>
							</li>
							<?php
						}
						echo output_tabs( $cats, $default, $id, $is_buy_btn_newtab_enabled );
						?>
					</ul>
				<?php endif; ?>
				<!-- style6, style-6 style 6 initiation -->
				<!-- Tab panes -->
				<div class="tab-content1">
					<?php
					if ( $select_column == 'One' ) {
						if ( $style == 'style_6' ) {
							echo output_tab_contents_style6( $cats, $default, $id, $is_buy_btn_newtab_enabled, true );
						} else {
							echo output_tab_contents_col1( $cats, $default, $id, $is_buy_btn_newtab_enabled );
						}
					} else {
						if ( $style == 'style_6' ) {
							if ( $select_column == 'Two' ) {
								echo output_tab_contents_style6( $cats, $default, $id, $is_buy_btn_newtab_enabled );
							} else {
								echo output_tab_contents_style6( $cats, $default, $id, $is_buy_btn_newtab_enabled, true );
							}
						} else {
							echo output_tab_contents( $cats, $default, $id, $is_buy_btn_newtab_enabled );
						}
					}
					?>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php
}

if ( $style == 'without_tab' ) {
	?>
	<div class="body-inner container-fluid price_wrapper without_tab spl_main_content_box" id="spl_<?php echo esc_attr($id); ?>" data-config=<?php echo esc_js( json_encode( $pricelist_config ) ); ?> data-style="<?php echo esc_attr($style); ?>" style="max-width:1200px;margin-left:auto;margin-right:auto;">
		<div class="head-title clearfix">
			<span class="spl_without_tab_style2">
			<?php
			if ( $df_number_of_cats ) {
				$cats = array_slice( $cats, 0, $df_number_of_cats, true );
			}
			if ( $spl_remove_title != 1 ) {
														echo esc_attr($list_name);
			}
			?>
													</span>
			<div class="col-sm-8 col-sm-offset-2 desc_price_list"><?php echo spl_esc_output( preg_replace( '/[\n\r]/', '<br />', str_replace( '\"', '"', str_replace( "\'", "'", stripslashes( $price_list_desc ) ) ) ) ); ?></div>
		</div>
		<nav class="searchbar-and-price-range-wrapper clearfix <?php echo $enable_price_range_slider ? 'has-price-range' : ''; ?>">
			<?php if ( $enable_price_range_slider ) : ?>
					<div id="spl-slider-handles" data-target="spl_<?php echo esc_attr($shortcode_id); ?>"></div>
			<?php endif; ?>
			<?php if ( $enable_searchbar ) : ?>
				<nav class="pricelist-searchbar clearfix">
					<input type="text" name="search" class="spl-mysearch" data-target="spl_<?php echo esc_attr($shortcode_id); ?>">
					<div class="spl-searchbar-icon" style="background-color: <?php echo esc_attr($title_color_top); ?>"><span class="spl-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" height="14px" viewBox="0 0 24 24" width="14px" fill="#fff">
								<path d="M0 0h24v24H0V0z" fill="none" />
								<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
							</svg></span>
					</div>
				</nav>
			<?php endif; ?>
		</nav>
		<?php echo output_tab_contents_second_style( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ); ?>
	</div>
	<?php
}
// Start style 2(single column)
if ( $style == 'without_tab_single_column' ) {
	?>
	<div class="body-inner container-fluid price_wrapper without_tab spl_main_content_box" id="spl_<?php echo esc_attr($id); ?>" data-config=<?php echo esc_js( json_encode( $pricelist_config ) ); ?> data-style="<?php echo esc_attr($style); ?>" style="max-width:1200px;margin-left:auto;margin-right:auto;">
		<div class="head-title clearfix">
			<span class="spl_without_tab_style2">
			<?php
			if ( $df_number_of_cats ) {
				$cats = array_slice( $cats, 0, $df_number_of_cats, true );
			}
			if ( $spl_remove_title != 1 ) {
														echo esc_attr($list_name);
			}
			?>
													</span>
			<nav class="searchbar-and-price-range-wrapper clearfix <?php echo $enable_price_range_slider ? 'has-price-range' : ''; ?>">
				<?php if ( $enable_price_range_slider ) : ?>
						<div id="spl-slider-handles" data-target="spl_<?php echo esc_attr($shortcode_id); ?>"></div>
				<?php endif; ?>
				<?php if ( $enable_searchbar ) : ?>
					<nav class="pricelist-searchbar clearfix">
						<input type="text" name="search" class="spl-mysearch" data-target="spl_<?php echo esc_attr($shortcode_id); ?>">
						<div class="spl-searchbar-icon" style="background-color: <?php echo esc_attr($title_color_top); ?>"><span class="spl-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" height="14px" viewBox="0 0 24 24" width="14px" fill="#fff">
									<path d="M0 0h24v24H0V0z" fill="none" />
									<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
								</svg></span>
						</div>
					</nav>
				<?php endif; ?>
			</nav>
			<div class="col-sm-8 col-sm-offset-2 desc_price_list"><?php echo spl_esc_output( preg_replace( '/[\n\r]/', '<br />', str_replace( '\"', '"', str_replace( "\'", "'", stripslashes( $price_list_desc ) ) ) ) ); ?></div>
		</div>
		<?php echo output_tab_contents_second_style_single_column( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled ); ?>
	</div>
	<?php
}
// End style 2(single column)
// Start style 3 design////
if ( $style == 'style_3' ) {
	?>
	<div class="body-inner container-fluid price_wrapper spl_main_content_box" id="spl_<?php echo esc_attr($id); ?>" data-config=<?php echo esc_js( json_encode( $pricelist_config ) ); ?> data-style="<?php echo esc_attr($style); ?>" style="max-width:1200px;margin-left:auto;margin-right:auto;">
		<div class="head-title">
			<span>
			<?php
			if ( $df_number_of_cats ) {
				$cats = array_slice( $cats, 0, $df_number_of_cats, true );
			}
			if ( $spl_remove_title != 1 ) {
						echo esc_attr($list_name);
			}
			?>
					</span>
		</div>
		<nav class="searchbar-and-price-range-wrapper clearfix <?php echo $enable_price_range_slider ? 'has-price-range' : ''; ?>">
			<?php if ( $enable_price_range_slider ) : ?>
					<div id="spl-slider-handles" data-target="spl_<?php echo esc_attr($shortcode_id); ?>"></div>
			<?php endif; ?>
			<?php if ( $enable_searchbar ) : ?>
				<nav class="pricelist-searchbar clearfix">
					<input type="text" name="search" class="spl-mysearch" data-target="spl_<?php echo esc_attr($shortcode_id); ?>">
					<div class="spl-searchbar-icon" style="background-color: <?php echo esc_attr($title_color_top); ?>"><span class="spl-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" height="14px" viewBox="0 0 24 24" width="14px" fill="#fff">
								<path d="M0 0h24v24H0V0z" fill="none" />
								<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
							</svg></span>
					</div>
				</nav>
			<?php endif; ?>
		</nav>
		<?php if ( $price_list_desc != '' ) { ?>
			<div class="col-sm-8 col-sm-offset-2 desc_price_list"><?php echo spl_esc_output( preg_replace( '/[\n\r]/', '<br />', str_replace( '\"', '"', str_replace( "\'", "'", stripslashes( $price_list_desc ) ) ) ) ); ?></div>
		<?php } ?>
		<?php
		if ( $select_column == 'Two' ) {
			echo output_tab_contents_third_style_col2( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled );
		} elseif ( $select_column == 'One' ) {
			echo output_tab_contents_third_style_col1( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled );
		} else {
			echo output_tab_contents_third_style( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled );
		}
		?>
	</div>
	<?php
}
// End style 3 design////
//Start style 4 design////
if ( $style == 'style_4' ) {
	if ( $select_column == 'One' ) {
		$style_4_col1 = 'style_4_col_1';
	}
	?>
	<div class="body-inner container-fluid price_wrapper spl_main_content_box custom-style-4 <?php echo isset( $style_4_col1 ) ? esc_attr($style_4_col1) : ''; ?>" id="spl_<?php echo esc_attr($id); ?>" data-config=<?php echo esc_js( json_encode( $pricelist_config ) ); ?> data-style="<?php echo esc_attr($style); ?>" style="max-width:1200px;margin-left:auto;margin-right:auto;">
		<div class="head-title">
			<span>
			<?php
			if ( $spl_remove_title != 1 ) {
						echo esc_attr($list_name);
			}
			?>
					</span>
		</div>
		<nav class="searchbar-and-price-range-wrapper clearfix <?php echo $enable_price_range_slider ? 'has-price-range' : ''; ?>">
			<?php if ( $enable_price_range_slider ) : ?>
					<div id="spl-slider-handles" data-target="spl_<?php echo esc_attr($shortcode_id); ?>"></div>
			<?php endif; ?>
			<?php if ( $enable_searchbar ) : ?>
				<nav class="pricelist-searchbar clearfix">
					<input type="text" name="search" class="spl-mysearch" data-target="spl_<?php echo esc_attr($shortcode_id); ?>">
					<div class="spl-searchbar-icon" style="background-color: <?php echo esc_attr($title_color_top); ?>"><span class="spl-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" height="14px" viewBox="0 0 24 24" width="14px" fill="#fff">
								<path d="M0 0h24v24H0V0z" fill="none" />
								<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
							</svg></span>
					</div>
				</nav>
			<?php endif; ?>
		</nav>
		<?php if ( $price_list_desc != '' ) { ?>
			<div class="col-sm-12 desc_price_list"><?php echo spl_esc_output( preg_replace( '/[\n\r]/', '<br />', str_replace( '\"', '"', str_replace( "\'", "'", stripslashes( $price_list_desc ) ) ) ) ); ?></div>
		<?php } ?>
		<?php
		if ( $brack_title_desktop == '' && $brack_title_tablets == '' ) {
			if ( $select_column == 'One' ) {
				echo output_tab_contents_fourth_style_col1( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled );
			} else {
				echo output_tab_contents_fourth_style( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled );
			}
		}
		if ( $brack_title_desktop == 1 && $brack_title_tablets == 1 ) {
			if ( $select_column == 'One' ) {
				echo output_tab_contents_4_style_break_col1( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled );
			} else {
				echo output_tab_contents_4_style_break( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled );
			}
		}
		if ( $brack_title_desktop == 1 && $brack_title_tablets == '' ) {
			?>
			<div class="brack_title_desktop">
			<?php
			if ( $select_column == 'One' ) {
				echo output_tab_contents_4_style_break_col1( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled );
			} else {
				echo output_tab_contents_4_style_break( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled );
			}
			?>
												</div>
			<div class="brack_title_tablets">
			<?php
			if ( $select_column == 'One' ) {
				echo output_tab_contents_fourth_style_col1( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled );
			} else {
				echo output_tab_contents_fourth_style( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled );
			}
			?>
												</div>
			<?php
		}
		if ( $brack_title_desktop == '' && $brack_title_tablets == 1 ) {
			?>
			<div class="brack_title_desktop">
			<?php
			if ( $select_column == 'One' ) {
				echo output_tab_contents_4_style_break_col1( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled );
			} else {
				echo output_tab_contents_4_style_break( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled );
			}
			?>
												</div>
			<div class="brack_title_tablets">
			<?php
			if ( $select_column == 'One' ) {
				echo output_tab_contents_fourth_style_col1( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled );
			} else {
				echo output_tab_contents_fourth_style( $cats, $default, $shortcode_id, $is_buy_btn_newtab_enabled );
			}
			?>
												</div>
			<?php
		}
		?>
	</div>
	<!----/// MAIN CONTAINER SECTION END --->
	<?php
}
if ( $style == 'style_5' ) {
	if ( $df_number_of_cats ) {
		$cats = array_slice( $cats, 0, $df_number_of_cats, true );
	}
	?>
	<div class="body-inner container-fluid price_wrapper df-spl-pull-left col-md-12 spl_main_content_box" id="spl_<?php echo esc_attr($id); ?>" data-config=<?php echo esc_js( json_encode( $pricelist_config ) ); ?> data-style="<?php echo esc_attr($style); ?>" style="max-width:1200px;margin-left:auto;margin-right:auto; ">
		<div class="df-spl-row style-five-head">
			<?php if ( $style5_category === 'style5_category_2' ) { ?>
				<div class="col-md-12 col-lg-12">
					<div class="head-title" style="margin:auto">
						<span>
						<?php
						if ( $spl_remove_title != 1 ) {
									echo esc_attr($list_name);
						}
						?>
								</span>
					</div>
					<nav class="searchbar-and-price-range-wrapper clearfix <?php echo $enable_price_range_slider ? 'has-price-range' : ''; ?>">
					<?php if ( $enable_price_range_slider ) : ?>
							<div id="spl-slider-handles" data-target="spl_<?php echo esc_attr($shortcode_id); ?>"></div>
					<?php endif; ?>
					<?php if ( $enable_searchbar ) : ?>
						<nav class="pricelist-searchbar clearfix">
							<input type="text" name="search" class="spl-mysearch" data-target="spl_<?php echo esc_attr($shortcode_id); ?>">
							<div class="spl-searchbar-icon" style="background-color: <?php echo esc_attr($title_color_top); ?>"><span class="spl-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" height="14px" viewBox="0 0 24 24" width="14px" fill="#fff">
										<path d="M0 0h24v24H0V0z" fill="none" />
										<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
									</svg></span>
							</div>
						</nav>
					<?php endif; ?>
					</nav>
					<?php if ( $price_list_desc != '' ) { ?>
						<div class="col-sm-12 desc_price_list"><?php echo spl_esc_output( preg_replace( '/[\n\r]/', '<br />', str_replace( '\"', '"', str_replace( "\'", "'", stripslashes( $price_list_desc ) ) ) ) ); ?></div>
					<?php } ?>
				</div>
				<div class="col-md-12 col-lg-12 style5_cat_tab_2 tabs_spl">
					<?php if ( $show_dropdown ) : ?>
						<select class="cats-dd" autocomplete="off" <?php if ($dropdown_mobile_no_keyboard == '1') echo 'data-no-keyboard-popup=1' ?>>
							<?php echo output_dropdown_choices( $cats, $id, $toggle_all_tab == 1, $default, $all_tab ); ?>
						</select>
						<?php
					endif;
					if ( ! $show_dropdown ) :
						?>
						<!-- Nav tabs -->
						<ul class="tab-links_spl" style="margin:auto; text-align:center !important; margin-bottom: 30px;">
							<?php
							if ( $all_tab != '' && $toggle_all_tab == 1 ) {
								?>
								<li class="<?php echo ( $default ) ? '' : 'active'; ?>">
									<a href="#all_<?php echo esc_attr($id); ?>"><?php echo esc_attr($all_tab); ?></a>
								</li>
								<?php
							}
							if ( $all_tab == '' && $toggle_all_tab == '' ) {
								?>
								<li class="<?php echo ( $default ) ? '' : 'active'; ?>">
									<a href="#all_<?php echo esc_attr($id); ?>">All</a>
								</li>
								<?php
							}
							echo output_tabs_style5( $cats, $default, $id, $is_buy_btn_newtab_enabled );
							?>
						</ul>
					<?php endif; ?>
				</div>
		</div>
	<?php } else { ?>
		<div class="col-md-8">
			<div class="head-title">
				<span class="style5">
				<?php
				if ( $spl_remove_title != 1 ) {
							echo esc_attr($list_name);
				}
				?>
						</span>
			</div>
				<?php if ( $price_list_desc != '' ) { ?>
				<div class="col-sm-12 desc_price_list"><?php echo spl_esc_output( preg_replace( '/[\n\r]/', '<br />', str_replace( '\"', '"', str_replace( "\'", "'", stripslashes( $price_list_desc ) ) ) ) ); ?></div>
			<?php } ?>
		</div>
		<nav class="searchbar-and-price-range-wrapper clearfix <?php echo $enable_price_range_slider ? 'has-price-range' : ''; ?>">
			<?php if ( $enable_price_range_slider ) : ?>
					<div id="spl-slider-handles" data-target="spl_<?php echo esc_attr($shortcode_id); ?>"></div>
			<?php endif; ?>
			<?php if ( $enable_searchbar ) : ?>
				<nav class="pricelist-searchbar clearfix">
					<input type="text" name="search" class="spl-mysearch" data-target="spl_<?php echo esc_attr($shortcode_id); ?>">
					<div class="spl-searchbar-icon" style="background-color: <?php echo esc_attr($title_color_top); ?>"><span class="spl-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" height="14px" viewBox="0 0 24 24" width="14px" fill="#fff">
								<path d="M0 0h24v24H0V0z" fill="none" />
								<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
							</svg></span>
					</div>
				</nav>
			<?php endif; ?>
		</nav>
		<div class="col-md-9 col-lg-9 style5_cat_tab tabs_spl">
				<?php if ( $show_dropdown ) : ?>
				<select class="cats-dd" autocomplete="off" <?php if ($dropdown_mobile_no_keyboard == '1') echo 'data-no-keyboard-popup=1' ?>>
					<?php echo output_dropdown_choices( $cats, $id, $toggle_all_tab == 1, $default, $all_tab ); ?>
				</select>
					<?php
			endif;
				if ( ! $show_dropdown ) :
					?>
				<!-- Nav tabs -->
				<ul class="tab-links_spl">
					<?php
					if ( $all_tab != '' && $toggle_all_tab == 1 ) {
						?>
						<li class="<?php echo ( $default ) ? '' : 'active'; ?>">
							<a href="javascript:void(0)" data-href="#all_<?php echo esc_attr($id); ?>"><?php echo esc_attr($all_tab); ?></a>
						</li>
						<?php
					}
					if ( $all_tab == '' && $toggle_all_tab == '' ) {
						?>
						<li class="<?php echo ( $default ) ? '' : 'active'; ?>">
							<a href="javascript:void(0)" data-href="#all_<?php echo esc_attr($id); ?>">All</a>
						</li>
						<?php
					}
					echo output_tabs_style5( $cats, $default, $id, $is_buy_btn_newtab_enabled );
					?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
<?php } ?>
<div class="df-spl-row">
	<div class="col-md-12 col-lg-12 style5_cat_tab tabs_spl">
		<!-- Tab panes -->
		<div class="tab-content1">
			<?php
			if ( $select_column == 'One' ) {
				echo output_tab_contents_style5_col1( $cats, $default, $id, $is_buy_btn_newtab_enabled );
			} else {
				echo output_tab_contents_style5( $cats, $default, $id, $is_buy_btn_newtab_enabled );
			}
			?>
		</div>
	</div>
</div>
</div>
	<?php
}
if ( $style == 'style_7' ) {
	?>
	<div class="body-inner container-fluid price_wrapper df-spl-pull-left col-md-12 spl_main_content_box" id="spl_<?php echo esc_attr($id); ?>" data-config=<?php echo esc_js( json_encode( $pricelist_config ) ); ?> data-style="7" style="max-width:1200px;margin-left:auto;margin-right:auto; ">
		<div class="head-title">
			<span class="style-7-title">
			<?php
			if ( $spl_remove_title != 1 ) {
						echo esc_attr($list_name);
			}
			?>
					</span>
		</div>
		<?php if ( $price_list_desc != '' ) { ?>
			<div class="custom-description-section pt-0"><?php echo spl_esc_output( preg_replace( '/[\n\r]/', '<br />', str_replace( '\"', '"', str_replace( "\'", "'", stripslashes( $price_list_desc ) ) ) ) ); ?></div>
		<?php } ?>
		<div class="df-spl-row df-spl-style-seven-head">
			<?php if ( ! $show_dropdown ) : ?>
				<div class="df-spl-style7_cat_tab-container tabs_spl">
					<!-- Nav tabs -->
					<ul>
						<?php
						if ( $all_tab != '' && $toggle_all_tab == 1 ) {
							?>
							<li class="<?php echo ( $default ) ? '' : 'active'; ?>">
								<a href="javascript:void(0)" data-href="#all_<?php echo esc_attr($id); ?>"><?php echo esc_attr($all_tab); ?></a>
							</li>
							<?php
						}
						if ( $all_tab == '' && $toggle_all_tab == '' ) {
							?>
							<li class="<?php echo ( $default ) ? '' : 'active'; ?>">
								<a href="javascript:void(0)" data-href="#all_<?php echo esc_attr($id); ?>">All</a>
							</li>
							<?php
						}
						echo output_tabs_style7( $cats, $default, $id, $is_buy_btn_newtab_enabled, $df_number_of_cats );
						?>
					</ul>
				</div>
			<?php endif; ?>
		</div>
		<nav class="searchbar-and-price-range-wrapper clearfix <?php echo $enable_price_range_slider ? 'has-price-range' : ''; ?>">
			<?php if ( $enable_price_range_slider ) : ?>
					<div id="spl-slider-handles" data-target="spl_<?php echo esc_attr($shortcode_id); ?>"></div>
			<?php endif; ?>
			<?php if ( $enable_searchbar ) : ?>
				<nav class="pricelist-searchbar clearfix">
					<input type="text" name="search" class="spl-mysearch" data-target="spl_<?php echo esc_attr($shortcode_id); ?>">
					<div class="spl-searchbar-icon" style="background-color: <?php echo esc_attr($title_color_top); ?>"><span class="spl-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" height="14px" viewBox="0 0 24 24" width="14px" fill="#fff">
								<path d="M0 0h24v24H0V0z" fill="none" />
								<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
							</svg></span>
					</div>
				</nav>
			<?php endif; ?>
		</nav>
		<div class="df-spl-row">
			<div class="col-md-12 col-lg-12 df-spl-style7_cat_tab tabs_spl">
				<?php if ( $show_dropdown ) : ?>
					<select class="cats-dd" autocomplete="off" <?php if ($dropdown_mobile_no_keyboard == '1') echo 'data-no-keyboard-popup=1' ?>>
						<?php echo output_dropdown_choices( $cats, $id, $toggle_all_tab == 1, $default, $all_tab ); ?>
					</select>
				<?php endif; ?>
				<!-- Tab panes -->
				<div class="tab-content1">
					<?php
					echo output_tab_contents_style7b( $cats, $default, $id, $select_column, $is_buy_btn_newtab_enabled );
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
if ( $style == 'style_8' ) :
	?>
	<div class="body-inner container-fluid price_wrapper spl_main_content_box" id="spl_<?php echo esc_attr($id); ?>" data-config=<?php echo esc_js( json_encode( $pricelist_config ) ); ?> data-style="<?php echo esc_attr($style); ?>" style="max-width:1200px;margin-left:auto;margin-right:auto;">
		<div class="style-8-container">
			<div class="head-title">
				<span>
				<?php
				if ( $spl_remove_title != 1 ) {
							echo esc_attr($list_name);
				}
				?>
						</span>
			</div>
			<nav class="searchbar-and-price-range-wrapper clearfix <?php echo $enable_price_range_slider ? 'has-price-range' : ''; ?>">
			<?php if ( $enable_price_range_slider ) : ?>
					<div id="spl-slider-handles" data-target="spl_<?php echo esc_attr($shortcode_id); ?>"></div>
			<?php endif; ?>
			<?php if ( $enable_searchbar ) : ?>
				<nav class="pricelist-searchbar clearfix">
					<input type="text" name="search" class="spl-mysearch" data-target="spl_<?php echo esc_attr($shortcode_id); ?>">
					<div class="spl-searchbar-icon" style="background-color: <?php echo esc_attr($title_color_top); ?>"><span class="spl-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" height="14px" viewBox="0 0 24 24" width="14px" fill="#fff">
								<path d="M0 0h24v24H0V0z" fill="none" />
								<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
							</svg></span>
					</div>
				</nav>
			<?php endif; ?>
			</nav>
			<?php if ( $show_dropdown ) : ?>
				<select class="cats-dd-style-8" autocomplete="off" <?php if ($dropdown_mobile_no_keyboard == '1') echo 'data-no-keyboard-popup=1' ?>>
					<?php echo output_dropdown_choices( $cats, $id, $toggle_all_tab == 1, $default, $all_tab ); ?>
				</select>
				<?php
			endif;
			if ( ! $show_dropdown ) :
				?>
				<nav class="df-spl-style8_cat_tab-container clearfix">
					<!-- Nav tabs -->
					<ul>
						<?php
						if ( $all_tab != '' && $toggle_all_tab == 1 ) {
							?>
							<li class="<?php echo ( $default ) ? '' : 'active'; ?>">
								<a href="javascript:void(0)" data-href="#all_<?php echo esc_attr($id); ?>"><?php echo esc_attr($all_tab); ?></a>
							</li>
							<?php
						}
						if ( $all_tab == '' && $toggle_all_tab == '' ) {
							?>
							<li class="<?php echo ( $default ) ? '' : 'active'; ?>">
								<a href="javascript:void(0)" data-href="#all_<?php echo esc_attr($id); ?>">All</a>
							</li>
							<?php
						}
						echo output_tabs_style7( $cats, $default, $id, $is_buy_btn_newtab_enabled, $df_number_of_cats );
						?>
					</ul>
				</nav>
			<?php endif; ?>
			<?php echo output_tab_contents_style8( $cats, $default, $id, $select_column, $is_buy_btn_newtab_enabled, $df_number_of_cats ); ?>
		</div>
	</div>
<?php endif; ?>
<?php if ( $style == 'style_9a' ) :
	?>
	<script type="application/json">
		<?php echo json_encode([
		'id' => $id,
		'style' => $style,
		$spl_remove_title,
		$list_name,
		$enable_searchbar,
		$show_dropdown,
		$dropdown_mobile_no_keyboard,
		'dd-choices' => [$cats, $id, $toggle_all_tab == 1, $default, $all_tab],
		$show_dropdown,
		$all_tab,
		$toggle_all_tab,
		$default,
		'output' => [$cats, $default, $id, $is_buy_btn_newtab_enabled],
		'output_v2' => [$cats, $default, $id, $select_column, $is_buy_btn_newtab_enabled],
		]); ?>
	</script>
<?php endif; ?>
<?php if ( $style == 'style_9b' ) :
	?>
	<script type="application/json">
		<?php echo json_encode([
		'id' => $id,
		'style' => $style,
		$spl_remove_title,
		$list_name,
		$enable_searchbar,
		$show_dropdown,
		$dropdown_mobile_no_keyboard,
		'dd-choices' => [$cats, $id, $toggle_all_tab == 1, $default, $all_tab],
		$show_dropdown,
		$all_tab,
		$toggle_all_tab,
		$default,
		'output' => [$cats, $default, $id, $is_buy_btn_newtab_enabled],
		'output_v2' => [$cats, $default, $id, $select_column, $is_buy_btn_newtab_enabled],
		]); ?>
	</script>
<?php endif; ?>
<?php if ( $style == 'style_10' ) :
	wp_enqueue_style( 'spl-style-10' );
	$number_of_cols = ( $cats_data['select_column'] === 'Two' ) ? 'two' : 'one';
	if ( $df_number_of_cats ) {
		$cats = array_slice( $cats, 0, $df_number_of_cats, true );
	}
	?>
	<script id="style10_<?php echo esc_attr($id); ?>" type="text/javascript">
		addEventListener('DOMContentLoaded', (event) => {
			style10SpyScrolling();
			const navbar = document.querySelector('.spl-style-10-footer-bottom'); // replace with your navbar selector
			const menuItems = navbar.querySelectorAll('a'); // replace with your menu item selector

			let totalWidth = 0;
			menuItems.forEach(item => {
				totalWidth += item.getBoundingClientRect().width;
			});

			if (totalWidth > navbar.getBoundingClientRect().width) {
				navbar.querySelector('.spl-style-10-footer-wrapper').style.justifyContent = 'flex-start';
			}
			// Scroll the navbar to the far left
			navbar.scrollLeft = 0;
		});
	</script>
	<div class="style-10 spl_main_content_box" data-list-columns=<?php echo esc_attr( $number_of_cols ); ?> id="spl_<?php echo esc_attr($id); ?>">
		<?php if ( intval( $cats_data['spl_remove_title'] ) !== 0 ) { ?>
		<div class="spl-s10-title-wrapper">
			<div class="spl-s10-title"><?php echo esc_attr($list_name); ?></div>
		</div>
		<?php } ?>
		<?php foreach ($cats as $cat_key => $current_cat) {
			$current_cats_items = $current_cat['services'];
			if ( ! $category_desc_embed_to_cover_image_s10 ) {
			 ?>
			<div class="spl-s10-title-wrapper">
				<div class="spl-s10-top-cat-title"><?php echo sanitize_text_field($current_cat['name']); ?></div>
				<div class="spl-s10-top-cat-desc"><?php echo sanitize_text_field($current_cat['description']); ?></div>
			</div>
			<?php } ?>
			<div class="spl-s10-cat-wrapper" id="<?php echo esc_attr( $cat_key.'_'.$id ); ?>">
				<div class="spl-s10-cat-cover-image" style="background-image: <?php echo empty( $current_cat['cover-image'] ) ? 'none' : 'url(\'' . esc_url( $current_cat['cover-image'] ) . '\')'; ?>">
					<?php if ( $category_desc_embed_to_cover_image_s10 ) { ?>
					<div class="spl-s10-cat-manifest">
						<h5 class="spl-s10-cat-name"><?php echo sanitize_text_field($current_cat['name']); ?></h5>
						<p class="spl-s10-cat-desc"><?php echo sanitize_text_field($current_cat['description']); ?></p>
					</div>
					<?php } ?>
				</div>
				<ul class="spl-s10-list-wrapper <?php echo $number_of_cols === 'two' ? 'spl-s10-two-cols' : ''; ?>">
					<?php foreach ($current_cats_items as $cat_item_key => $item_data) {
							// check if $key is non numeric, cause somehow it's 'background_color' and 'text_color' are being added to the array
							if ( ! is_numeric( $cat_item_key ) ) {
								continue;
							}
							$item_data['price'] = empty($item_data['settings_compare_at']) ? $item_data['price'] : '<s>'.$item_data['settings_compare_at'].'</s>'. ' ' . $item_data['price'];
						?>	
						<li class="spl-s10-list-item spl-item-root" <?php foreach ($item_data['tooltip_config'] as $key => $value) {
							if ( empty( $value ) ) continue;
							echo esc_attr($key) . '="' . esc_attr($value) . '" ';
						} ?>>
							<div class="item-title-desc-wrapper">
								<p data-price-list-fragment="item_name" class="spl-s10-bold">
									<span><?php echo sanitize_text_field($item_data['name']); ?></span>
									<?php if ( $item_data['is_popular'] === 'on' ) { ?>
										<span class="spl-item-popular">
											⭐ <?php echo esc_attr($item_data['popular_text']); ?>
										</span>
									<?php } ?>
								</p>
								<p class="spl-s10-muted"><?php echo sanitize_text_field($item_data['desc']); ?></p>
							</div>
							<?php if (! ( empty( $item_data['price'] ) && empty( $item_data['service_button_url'] ) && empty( $item_data['service_button'] ) ) ) : ?>
								<div class="item-btn-wrapper">
									<div>
										<p data-price-list-fragment="price" class="spl-s10-price-text"><?php echo spl_esc_output($item_data['price']); ?></p>
										<?php if ( ! empty( $item_data['service_button_url'] ) ) : ?>
											<a href="<?php echo esc_url($item_data['service_button_url']); ?>"><?php echo esc_attr( $item_data['service_button'] ); ?></a>
										<?php endif; ?>
									</div>
								</div>
							<?php endif; ?>
						</li>
					<?php } ?>
				</ul>
			</div>
		<?php 
	} ?>
	</div>
	<?php
	$footer_content = function () use($id, $cats) {
		?>
		<div class="spl-style-10-footer-bottom" id="spl10_<?php echo esc_attr($id); ?>">
			<div class="spl-style-10-footer-wrapper">
				<?php foreach ($cats as $cat_key => $current_cat) {
					?>
					<a href="javascript:void(0)" data-href="<?php echo esc_attr( '#'.$cat_key.'_'.$id ); ?>" class="spl-style-10-nav"><?php echo esc_attr( $current_cat['name'] ); ?></a>
					<?php
				} ?>
			</div>
		</div>
		<?php
	};
	if ( ! is_admin() ) {
		add_action('wp_footer', $footer_content);
	}
	if ( is_admin() ) {
		add_action('admin_footer', $footer_content);
	}
	?>
<?php endif; ?>
<?php if ($style == 'style_10'): ?>
	<style type="text/css">
		#spl_<?php echo esc_attr($id) ?>,
		#spl10_<?php echo esc_attr($id) ?> {
			--spl-s10-title-color: <?php echo esc_attr($title_color_top); ?>;
			--spl-s10-title-font-size: <?php echo esc_attr($title_size); ?>;
			--spl-s10-title-font-style: <?php echo esc_attr($list_name_font); ?>;
			--spl-s10-title-font-weight: <?php echo esc_attr($title_font_weight); ?>;
			
			--spl-s10-category-font-size: <?php echo esc_attr($tab_size); ?>;
			--spl-s10-category-color: <?php echo esc_attr($title_color); ?>;
			--spl-s10-category-font-style: <?php echo esc_attr($title_font); ?>;
			--spl-s10-category-font-weight: <?php echo esc_attr($tab_font_weight); ?>;
			--spl-s10-category-cover-image-overlay-color: <?php echo esc_attr($category_image_overlay_value); ?>;

			--spl-s10-price-font-size: <?php echo esc_attr($select_price); ?>;
			--spl-s10-price-color: <?php echo esc_attr($price_color); ?>;
			--spl-s10-price-font-style: <?php echo esc_attr($price_font); ?>;
			--spl-s10-price-font-weight: <?php echo esc_attr($service_price_font_weight); ?>;

			--spl-s10-item-name-font-size: <?php echo esc_attr($service_size); ?>;
			--spl-s10-item-name-color: <?php echo esc_attr($service_color); ?>;
			--spl-s10-item-name-font-style: <?php echo esc_attr($desc_font); ?>;
			--spl-s10-item-name-hover-color: <?php echo esc_attr($hover_color); ?>;
			--spl-s10-item-name-font-weight: <?php echo esc_attr($service_font_weight); ?>;

			--spl-s10-desc-font-size: <?php echo esc_attr($service_description_font_size); ?>;
			--spl-s10-desc-color: <?php echo esc_attr($service_description_color); ?>;
			--spl-s10-desc-font-style: <?php echo esc_attr($service_description_font); ?>;
			--spl-s10-desc-font-weight: <?php echo esc_attr($description_font_weight); ?>;

			--spl-s10-cat-desc-font-size: <?php echo ! empty( $tab_description_font_size ) ? esc_attr($tab_description_font_size) : 'inherit'; ?>;
			--spl-s10-cat-desc-color: <?php echo isset( $tab_description_color ) ? esc_attr($tab_description_color) : '#999'; ?>;
			--spl-s10-cat-desc-font-style: <?php echo esc_attr($tab_description_font); ?>;
			--spl-s10-cat-desc-font-weight: <?php echo esc_attr($tab_description_font_weight); ?>;
			--spl-s10-item-name-font-size: 18px;
		}
	</style>
<?php endif; ?>
<?php if ($style == 'style_6'): ?>
	<style type="text/css">
		#spl_<?php echo esc_attr($id) ?>,
		#spl6_<?php echo esc_attr($id) ?> {
			--spl-s6-title-color: <?php echo esc_attr($title_color_top); ?>;
			--spl-s6-title-font-size: <?php echo esc_attr($title_size); ?>;
			--spl-s6-title-font-style: <?php echo esc_attr($list_name_font); ?>;
			--spl-s6-title-font-weight: <?php echo esc_attr($title_font_weight); ?>;
			
			--spl-s6-category-font-size: <?php echo esc_attr($tab_size); ?>;
			--spl-s6-category-color: <?php echo esc_attr($title_color); ?>;
			--spl-s6-category-font-style: <?php echo esc_attr($title_font); ?>;
			--spl-s6-category-font-weight: <?php echo esc_attr($tab_font_weight); ?>;
			--spl-s6-category-cover-image-overlay-color: <?php echo esc_attr($category_image_overlay_value); ?>;

			--spl-s6-price-font-size: <?php echo esc_attr($select_price); ?>;
			--spl-s6-price-color: <?php echo esc_attr($price_color); ?>;
			--spl-s6-price-font-style: <?php echo esc_attr($price_font); ?>;
			--spl-s6-price-font-weight: <?php echo esc_attr($service_price_font_weight); ?>;

			--spl-s6-item-name-font-size: <?php echo esc_attr($service_size); ?>;
			--spl-s6-item-name-color: <?php echo esc_attr($service_color); ?>;
			--spl-s6-item-name-font-style: <?php echo esc_attr($desc_font); ?>;
			--spl-s6-item-name-hover-color: <?php echo esc_attr($hover_color); ?>;
			--spl-s6-item-name-font-weight: <?php echo esc_attr($service_font_weight); ?>;

			--spl-s6-desc-font-size: <?php echo esc_attr($service_description_font_size); ?>;
			--spl-s6-desc-color: <?php echo esc_attr($service_description_color); ?>;
			--spl-s6-desc-font-style: <?php echo esc_attr($service_description_font); ?>;
			--spl-s6-desc-font-weight: <?php echo esc_attr($description_font_weight); ?>;

			--spl-s6-cat-desc-font-size: <?php echo ! empty( $tab_description_font_size ) ? esc_attr($tab_description_font_size) : 'inherit'; ?>;
			--spl-s6-cat-desc-color: <?php echo isset( $tab_description_color ) ? esc_attr($tab_description_color) : '#999'; ?>;
			--spl-s6-cat-desc-font-style: <?php echo esc_attr($tab_description_font); ?>;
			--spl-s6-cat-desc-font-weight: <?php echo esc_attr($tab_description_font_weight); ?>;
			--spl-s6-item-name-font-size: 18px;
		}
	</style>
<?php endif; ?>
<!-- Pricing table 1 -->
<?php if ( $style == 'style_table_1' ) :
	wp_enqueue_style( 'spl-style-table-1' );
	$number_of_cols = ( $cats_data['select_column'] === 'Two' ) ? 'two' : 'one';
	if ( $df_number_of_cats ) {
		$cats = array_slice( $cats, 0, $df_number_of_cats, true );
	}
	?>
	<div class="style-table-1 spl_main_content_box" data-list-columns=<?php echo esc_attr( $number_of_cols ); ?> id="spl_<?php echo esc_attr($id); ?>">
		<?php if ( intval( $cats_data['spl_remove_title'] ) !== 0 ) { ?>
		<div class="spl-st1-title-wrapper">
			<div class="spl-st1-title"><?php echo esc_attr($list_name); ?></div>
		</div>
		<?php } ?>
		<div class="spl-st1-cat-wrapper-container">
		<?php 
		$cat_count = 0;
		foreach ($cats as $cat_key => $current_cat) {
			$current_cats_items = $current_cat['services'];
			if ( ! $category_desc_embed_to_cover_image_s10 ) {
			 ?>
			<div class="spl-st1-title-wrapper">
				<div class="spl-st1-top-cat-title"><?php echo sanitize_text_field($current_cat['name']); ?></div>
				<div class="spl-st1-top-cat-desc"><?php echo sanitize_text_field($current_cat['description']); ?></div>
			</div>
			<?php } ?>
			<div class="spl-st1-cat-wrapper" id="<?php echo esc_attr( $cat_key.'_'.$id ); ?>" style="background-color: <?php echo esc_attr( ( isset( $current_cat['background_color'] ) && ! empty( $current_cat['background_color'] ) ) ? $current_cat['background_color'] : '#fff' ); ?>; color: <?php echo esc_attr( ( isset( $current_cat['text_color'] ) && ! empty( $current_cat['text_color'] ) ) ? $current_cat['text_color'] : '#000' ); ?>;">
				<div class="spl-st1-cat-cover-image" style="background-image: <?php echo empty( $current_cat['cover-image'] ) ? 'none' : 'url(\'' . esc_url( $current_cat['cover-image'] ) . '\')'; ?>">
					<?php if ( $category_desc_embed_to_cover_image_s10 ) { ?>
					<div class="spl-st1-cat-manifest">
						<h5 class="spl-st1-cat-name" style="color: <?php echo esc_attr( $current_cat['text_color'] ); ?>;"><?php echo sanitize_text_field($current_cat['name']); ?></h5>
						<div class="spl-st1-cat-price">
							<p class="spl-st1-cat-price-text">
								<?php echo spl_esc_output( $current_cat['price'] ); ?>
							</p>
						</div>
						<p class="spl-st1-cat-desc"><?php echo sanitize_text_field($current_cat['description']); ?></p>
						<hr>
					</div>
					<?php } ?>
				</div>
				<ul class="spl-st1-list-wrapper <?php echo $number_of_cols === 'two' ? 'spl-st1-two-cols' : ''; ?>">
					<?php foreach ($current_cats_items as $cat_item_key => $item_data) {
							$item_data['price'] = empty($item_data['settings_compare_at']) ? $item_data['price'] : '<s>'.$item_data['settings_compare_at'].'</s>'. ' ' . $item_data['price'];
						?>	
						<?php if( !empty($item_data['name']) || !empty($item_data['desc'])){ ?>
						<li class="spl-st1-list-item spl-item-root" <?php foreach ($item_data['tooltip_config'] as $key => $value) {
							if ( empty( $value ) ) continue;
							echo esc_attr($key) . '="' . esc_attr($value) . '" ';
						} ?>>
							<div class="item-title-desc-wrapper">
								<span data-price-list-fragment="item_name" class="spl-st1-bold"><?php echo sanitize_text_field($item_data['name']); ?></span>
								<span class="spl-st1-muted"><?php echo sanitize_text_field($item_data['desc']); ?></span>
							</div>
							
						</li>
						<?php } ?>
					<?php } ?>
				</ul>
				<?php if ( ! empty( $current_cat['action_text'] ) && ! empty( $current_cat['action_link'] ) ) : ?>
				<div class="spl-st1-cat-footer">
					<a href="<?php echo esc_url( $current_cat['action_link'] ); ?>" class="spl-st1-cat-button"><?php echo esc_attr( $current_cat['action_text'] ); ?></a>
				</div>
				<?php endif; ?>
			</div>
		<?php 
		$cat_count++;
	} ?>
	</div>
	</div>

<?php endif; ?>
<?php if ($style == 'style_table_1'): 

	if(isset($category_background_color)){
		$category_background_color = '#fff';
	}
	?>
	<style type="text/css">
		#spl_<?php echo esc_attr($id) ?>,
		#spl11_<?php echo esc_attr($id) ?> {
			--spl-st1-title-color: <?php echo esc_attr($title_color_top); ?>;
			--spl-st1-title-font-size: <?php echo esc_attr($title_size); ?>;
			--spl-st1-title-font-style: <?php echo esc_attr($list_name_font); ?>;
			--spl-st1-title-font-weight: <?php echo esc_attr($title_font_weight); ?>;
			
			--spl-st1-category-font-size: <?php echo esc_attr($tab_size); ?>;
			--spl-st1-category-color: <?php echo esc_attr($title_color); ?>;
			--spl-st1-category-font-style: <?php echo esc_attr($title_font); ?>;
			--spl-st1-category-font-weight: <?php echo esc_attr($tab_font_weight); ?>;
			--spl-st1-category-cover-image-overlay-color: <?php echo esc_attr($category_image_overlay_value); ?>;
			--spl-st1-category-background-color: <?php echo esc_attr($category_background_color); ?>;

			--spl-st1-price-font-size: <?php echo esc_attr($select_price); ?>;
			--spl-st1-price-color: <?php echo esc_attr($price_color); ?>;
			--spl-st1-price-font-style: <?php echo esc_attr($price_font); ?>;
			--spl-st1-price-font-weight: <?php echo esc_attr($service_price_font_weight); ?>;

			--spl-st1-item-name-font-size: <?php echo esc_attr($service_size); ?>;
			--spl-st1-item-name-color: <?php echo esc_attr($service_color); ?>;
			--spl-st1-item-name-font-style: <?php echo esc_attr($desc_font); ?>;
			--spl-st1-item-name-hover-color: <?php echo esc_attr($hover_color); ?>;
			--spl-st1-item-name-font-weight: <?php echo esc_attr($service_font_weight); ?>;

			--spl-st1-desc-font-size: <?php echo esc_attr($service_description_font_size); ?>;
			--spl-st1-desc-color: <?php echo esc_attr($service_description_color); ?>;
			--spl-st1-desc-font-style: <?php echo esc_attr($service_description_font); ?>;
			--spl-st1-desc-font-weight: <?php echo esc_attr($description_font_weight); ?>;

			--spl-st1-cat-desc-font-size: <?php echo ! empty( $tab_description_font_size ) ? esc_attr($tab_description_font_size) : 'inherit'; ?>;
			--spl-st1-cat-desc-color: <?php echo isset( $tab_description_color ) ? esc_attr($tab_description_color) : '#999'; ?>;
			--spl-st1-cat-desc-font-style: <?php echo esc_attr($tab_description_font); ?>;
			--spl-st1-cat-desc-font-weight: <?php echo esc_attr($tab_description_font_weight); ?>;

		}

	</style>
<?php endif; ?>

<!-- Pricing table 2 -->
<?php if ( $style == 'style_table_2' ) :
	wp_enqueue_style( 'spl-style-table-2' );
	$number_of_cols = ( $cats_data['select_column'] === 'Two' ) ? 'two' : 'one';
	if ( $df_number_of_cats ) {
		$cats = array_slice( $cats, 0, $df_number_of_cats, true );
	}
	?>
	<div class="style-table-2 spl_main_content_box" data-list-columns=<?php echo esc_attr( $number_of_cols ); ?> id="spl_<?php echo esc_attr($id); ?>">
		<?php if ( intval( $cats_data['spl_remove_title'] ) !== 0 ) { ?>
		<div class="spl-st2-title-wrapper">
			<div class="spl-st2-title"><?php echo esc_attr($list_name); ?></div>
		</div>
		<?php } ?>
		<div class="spl-st2-cat-wrapper-container">
		<?php 
		$cat_count = 0;
		foreach ($cats as $cat_key => $current_cat) {
			$current_cats_items = $current_cat['services'];
			if ( ! $category_desc_embed_to_cover_image_s10 ) {
			 ?>
			<div class="spl-st1-title-wrapper">
				<div class="spl-st1-top-cat-title"><?php echo sanitize_text_field($current_cat['name']); ?></div>
				<div class="spl-st1-top-cat-desc"><?php echo sanitize_text_field($current_cat['description']); ?></div>
			</div>
			<?php } ?>
			<div class="spl-st2-cat-wrapper" id="<?php echo esc_attr( $cat_key.'_'.$id ); ?>">
				<?php if ( $category_desc_embed_to_cover_image_s10 ) { ?>
					<div class="spl-st2-cat-manifest">
						<div class="spl-st2-cat-manifest-header" style="background-color: <?php echo esc_attr( $current_cat['background_color'] ); ?>;">
							<h5 class="spl-st2-cat-name" style="color: <?php echo esc_attr( $current_cat['text_color'] ); ?>;"><?php echo sanitize_text_field($current_cat['name']); ?></h5>
							<p class="spl-st2-cat-desc" style="color: <?php echo esc_attr( $current_cat['text_color'] ); ?>;"><?php echo sanitize_text_field($current_cat['description']); ?></p>
						</div>
						

						<div class="spl-st2-cat-price">
							<p class="spl-st2-cat-price-text">
								<?php echo spl_esc_output( $current_cat['price'] ); ?>
							</p>
						</div>
						

					</div>
					<?php } ?>
				<ul class="spl-st2-list-wrapper <?php echo $number_of_cols === 'two' ? 'spl-st2-two-cols' : ''; ?>">
					<?php foreach ($current_cats_items as $cat_item_key => $item_data) {
							$item_data['price'] = empty($item_data['settings_compare_at']) ? $item_data['price'] : '<s>'.$item_data['settings_compare_at'].'</s>'. ' ' . $item_data['price'];
						?>	
						<?php if( !empty($item_data['name']) || !empty($item_data['desc'])){ ?>
						<li class="spl-st2-list-item spl-item-root" <?php foreach ($item_data['tooltip_config'] as $key => $value) {
							if ( empty( $value ) ) continue;
							echo esc_attr($key) . '="' . esc_attr($value) . '" ';
						} ?>>
							<div class="item-title-desc-wrapper">
								<span data-price-list-fragment="item_name" class="spl-st2-bold"><?php echo sanitize_text_field($item_data['name']); ?></span>
								<span class="spl-st2-muted"><?php echo sanitize_text_field($item_data['desc']); ?></span>
							</div>
							
						</li>
						<?php } ?>
					<?php } ?>
				</ul>
				<?php if ( ! empty( $current_cat['action_text'] ) && ! empty( $current_cat['action_link'] ) ) : ?>
				<div class="spl-st2-cat-footer">
					<a href="<?php echo esc_url( $current_cat['action_link'] ); ?>" class="spl-st2-cat-button"
					style="background-color: <?php echo esc_attr( $current_cat['background_color'] ); ?>; color: <?php echo esc_attr( $current_cat['text_color'] ); ?>;"
					><?php echo esc_attr( $current_cat['action_text'] ); ?></a>
				</div>
				<?php endif; ?>
			</div>
		<?php 
		$cat_count++;
	} ?>
	</div>
	</div>

<?php endif; ?>
<?php if ($style == 'style_table_2'): 

	if(isset($category_background_color)){
		$category_background_color = '#fff';
	}
	?>
	<style type="text/css">
		#spl_<?php echo esc_attr($id) ?>,
		#spl11_<?php echo esc_attr($id) ?> {
			--spl-st2-title-color: <?php echo esc_attr($title_color_top); ?>;
			--spl-st2-title-font-size: <?php echo esc_attr($title_size); ?>;
			--spl-st2-title-font-style: <?php echo esc_attr($list_name_font); ?>;
			--spl-st2-title-font-weight: <?php echo esc_attr($title_font_weight); ?>;
			
			--spl-st2-category-font-size: <?php echo esc_attr($tab_size); ?>;
			--spl-st2-category-color: <?php echo esc_attr($title_color); ?>;
			--spl-st2-category-font-style: <?php echo esc_attr($title_font); ?>;
			--spl-st2-category-font-weight: <?php echo esc_attr($tab_font_weight); ?>;
			--spl-st2-category-cover-image-overlay-color: <?php echo esc_attr($category_image_overlay_value); ?>;
			--spl-st2-category-background-color: <?php echo esc_attr($category_background_color); ?>;

			--spl-st2-price-font-size: <?php echo esc_attr($select_price); ?>;
			--spl-st2-price-color: <?php echo esc_attr($price_color); ?>;
			--spl-st2-price-font-style: <?php echo esc_attr($price_font); ?>;
			--spl-st2-price-font-weight: <?php echo esc_attr($service_price_font_weight); ?>;

			--spl-st2-item-name-font-size: <?php echo esc_attr($service_size); ?>;
			--spl-st2-item-name-color: <?php echo esc_attr($service_color); ?>;
			--spl-st2-item-name-font-style: <?php echo esc_attr($desc_font); ?>;
			--spl-st2-item-name-hover-color: <?php echo esc_attr($hover_color); ?>;
			--spl-st2-item-name-font-weight: <?php echo esc_attr($service_font_weight); ?>;

			--spl-st2-desc-font-size: <?php echo esc_attr($service_description_font_size); ?>;
			--spl-st2-desc-color: <?php echo esc_attr($service_description_color); ?>;
			--spl-st2-desc-font-style: <?php echo esc_attr($service_description_font); ?>;
			--spl-st2-desc-font-weight: <?php echo esc_attr($description_font_weight); ?>;

			--spl-st2-cat-desc-font-size: <?php echo ! empty( $tab_description_font_size ) ? esc_attr($tab_description_font_size) : 'inherit'; ?>;
			--spl-st2-cat-desc-color: <?php echo isset( $tab_description_color ) ? esc_attr($tab_description_color) : '#999'; ?>;
			--spl-st2-cat-desc-font-style: <?php echo esc_attr($tab_description_font); ?>;
			--spl-st2-cat-desc-font-weight: <?php echo esc_attr($tab_description_font_weight); ?>;

		}

	</style>
<?php endif; ?>



<?php
if ( $style == 'style_6' ) {
	wp_enqueue_style( 'spl-style-6' );
	$number_of_cols = ( $cats_data['select_column'] === 'Two' ) ? 'two' : 'one';
	if ( $df_number_of_cats ) {
		$cats = array_slice( $cats, 0, $df_number_of_cats, true );
	}
	?>
	<script id="style6_<?php echo esc_attr($id); ?>" type="text/javascript">
		addEventListener('DOMContentLoaded', (event) => {
			const pricelistRoot = document.querySelector('#spl_<?php echo esc_attr($id); ?>');
			const navTargets = pricelistRoot.querySelectorAll('.tab-links_spl li a');
			navTargets.forEach((navTarget) => {
				navTarget.addEventListener('click', (event) => {
					const navTargetParent = navTarget.parentElement;
					const navTargetSiblings = navTargetParent.parentElement.querySelectorAll('li');
					navTargetSiblings.forEach((navTargetSibling) => {
						navTargetSibling.classList.remove('active');
					});
					navTargetParent.classList.add('active');
					const targetItemCategoryKey = navTarget.getAttribute('data-target-cat-key');
					const targetItemCategoryDescKey = targetItemCategoryKey;
					const excludedItemsDesc = pricelistRoot.querySelectorAll(`.style-6-custom-description-section:not([data-target-cat-desc-key="${targetItemCategoryDescKey}"])`);
					const priceItemNodes = pricelistRoot.querySelectorAll('.service-item');
					const targetItems = pricelistRoot.querySelectorAll(`.service-item[data-cat-key="${targetItemCategoryKey}"]`);
					if ( ! targetItemCategoryKey ) {
						priceItemNodes.forEach((priceItemNode) => {
							priceItemNode.classList.remove('spl-hidden');
						});
						excludedItemsDesc.forEach((excludedItemDesc) => {
							excludedItemDesc.classList.add('spl-hidden');
						});
						return;
					}
					const excludedItems = pricelistRoot.querySelectorAll(`.service-item:not([data-cat-key="${targetItemCategoryKey}"])`);
					priceItemNodes.forEach((priceItemNode) => {
						priceItemNode.classList.add('spl-hidden');
					});
					targetItems.forEach((targetItem) => {
						targetItem.classList.remove('spl-hidden');
					});
					const targetItemsDesc = pricelistRoot.querySelectorAll(`.style-6-custom-description-section[data-target-cat-desc-key="${targetItemCategoryDescKey}"]`);
					excludedItemsDesc.forEach((excludedItemDesc) => {
						excludedItemDesc.classList.add('spl-hidden');
					});
					targetItemsDesc.forEach((targetItemDesc) => {
						targetItemDesc.classList.remove('spl-hidden');
					});
				});
				if ( navTarget.parentElement.classList.contains('default') ) {
					navTarget.click();
				}
			});
		});
	</script>
	<div class="style-6 spl_main_content_box price_wrapper body-inner" style="max-width:<?php echo isset( $max_width ) ? esc_attr($max_width) : ''; ?>;margin-left:auto;margin-right:auto; " data-style="style_6" data-list-columns=<?php echo esc_attr( $number_of_cols ); ?> id="spl_<?php echo esc_attr($id); ?>">
		<?php if ( intval( $cats_data['spl_remove_title'] ) === 0 ) { ?>
		<div class="spl-s6-title-wrapper">
			<div class="spl-s6-title"><?php echo esc_attr($list_name); ?></div>
			<div class="spl-s6-title-desc"><?php echo esc_attr($list_description); ?></div>
		</div>
		<?php } ?>
		<div class="spl-s6-nav-wrapper">
		<?php if ( $show_dropdown ) : ?>
				<select class="cats-dd-style6" autocomplete="off" <?php if ($dropdown_mobile_no_keyboard == '1') echo 'data-no-keyboard-popup=1' ?>>
					<?php echo output_dropdown_choices( $cats, $id, $toggle_all_tab == 1, $default, $all_tab ); ?>
				</select>
				<?php
			endif;
			if ( ! $show_dropdown ) : ?>
			<!-- Nav tabs -->
			<ul class="tab-links_spl style-6">
				<?php
				if ( $all_tab != '' && $toggle_all_tab == 1 ) {
					?>
					<li class="<?php echo ( $default ) ? '' : 'active'; ?>">
						<a href="javascript:void(0)" data-href="#all_<?php echo esc_attr($id); ?>"><?php echo esc_attr($all_tab); ?></a>
					</li>
					<?php
				}
				if ( $all_tab == '' && $toggle_all_tab == '' ) {
					?>
					<li class="<?php echo ( $default ) ? '' : 'active'; ?>">
						<a href="javascript:void(0)" data-href="#all_<?php echo esc_attr($id); ?>">All</a>
					</li>
					<?php
				}
				echo output_tabs( $cats, $default, $id, $is_buy_btn_newtab_enabled );
				?>
			</ul>
		<?php endif; ?>	
		<?php if ( $enable_searchbar ) : ?>
			<nav class="pricelist-searchbar clearfix">
				<input type="text" name="search" class="spl-mysearch" data-target="spl_<?php echo esc_attr($shortcode_id); ?>">
				<div class="spl-searchbar-icon" style="background-color: <?php echo esc_attr($title_color_top); ?>"><span class="spl-icon-wrapper"><svg xmlns="http://www.w3.org/2000/svg" height="14px" viewBox="0 0 24 24" width="14px" fill="#fff">
							<path d="M0 0h24v24H0V0z" fill="none" />
							<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
						</svg></span>
				</div>
			</nav>
		<?php endif; ?>
		</div>
		<div class="spl-s6-title-desc-wrapper">
		<?php foreach ($cats as $cat_key => $cat) {
			if ( ! empty( $cat['description'] ) ) {
				?>
				<div class="style-6-custom-description-section spl-hidden" data-target-cat-desc-key="<?php echo esc_attr($cat_key); ?>">
					<?php echo spl_esc_output( nl2br( trim( $cat['description'] ) ) ); ?>
				</div>
			<?php } ?>
		<?php } ?>
		</div>
		<?php
		$all_services = array();
		$columns      = 'col-md-6';
		foreach ( $cats as $cat_key => $cat ) {
			$services = $cat['services'];
			foreach ( $services as $key => $service ) {
				// check if $key is non numeric, cause somehow it's 'background_color' and 'text_color' are being added to the array
				if ( is_numeric( $key ) ) {
					$name               = $service['name'];
					$service['cat_key'] = $cat_key;
					$all_services[]     = $service;
				}
			}
		}
		?>
		<div class="spl-s6-cat-wrapper clearfix <?php echo ( $default ) ? '' : 'active'; ?>" id="<?php echo esc_attr( $cat_key.'_'.$id ); ?>">
			<ul class="spl-s6-list-wrapper <?php echo $number_of_cols === 'two' ? 'spl-s6-two-cols' : ''; ?>">
				<?php foreach ($all_services as $cat_item_key => $item_data) {
						$item_data['price'] = empty($item_data['settings_compare_at']) ? $item_data['price'] : '<s>'.$item_data['settings_compare_at'].'</s>'. ' ' . $item_data['price'];
						$long_description = trim( empty( trim( $item_data['service_long_description'] ) ) ? $item_data['desc'] : $item_data['service_long_description'] );
					?>
					<div class="service-item" data-cat-key="<?php echo esc_attr( $item_data['cat_key'] ); ?>">
						<?php if ( ! empty( $item_data['service_image'] ) ) { ?>
							<img src="<?php echo esc_url($item_data['service_image']); ?>">
						<?php } ?>
						<div>
							<h3>
								<span><?php echo sanitize_text_field($item_data['name']); ?></span>
								<?php if ( $item_data['is_popular'] === 'on' ) { ?>
									<span class="spl-item-popular">
										⭐ <?php echo esc_attr($item_data['popular_text']); ?>
									</span>
								<?php } ?>
							</h3>
							<p class="spl-s6-muted"><?php echo sanitize_text_field($long_description); ?></p>	
							<?php if (! ( empty( $item_data['price'] ) && empty( $item_data['service_button_url'] ) && empty( $item_data['service_button'] ) ) ) : ?>
								<div class="price">
									<div class="original-price"><?php echo html_entity_decode($item_data['price']); ?></div>
									<!-- <button class="buy-now"><?php echo esc_attr( $item_data['service_button'] ); ?></button> -->
									<?php if ( ! empty( $item_data['service_button_url'] ) ) : ?>
										<a class="buy-now" href="<?php echo esc_url($item_data['service_button_url']); ?>"><?php echo esc_attr( $item_data['service_button'] ); ?></a>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php } ?>
			</ul>
		</div>
	</div>
	<?php
}
?>

<!--AK Style -->
<style type="text/css">
	<?php
	if ( ( isset( $select_column ) ) && ( $select_column == 'Select Column' ) ) {
		?>
	#spl_<?php echo esc_attr($id); ?>.grid-sizer:nth-child(3n+1) {
		clear: both;
	}

		<?php
	}
	if ( ( isset( $select_column ) ) && ( $select_column == 'One' ) ) {
		?>
	#spl_<?php echo esc_attr($id); ?>.grid-sizer:nth-child(2n+1) {
		clear: both;
	}

		<?php
	}
	if ( ( isset( $select_column ) ) && ( $select_column == 'Two' ) ) {
		?>
	#spl_<?php echo esc_attr($id); ?>.grid-sizer:nth-child(2n+1) {
		clear: both;
	}

		<?php
	}
	?>
	<?php
	if ( ! empty( $spl_container_max_width ) ) :
		?>
		.spl_main_content_box {
		max-width: <?php echo esc_attr($spl_container_max_width); ?> !important;
		width: 100%;
		margin: 0px auto;
		display: block;
	}

	<?php endif; ?>
				 <?php
					if ( ! empty( $service_size ) ) :
						?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .name.a-tag,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-8-title-container h3 {
		font-size: <?php echo esc_attr($service_size); ?> !important;
	}

						<?php
	endif; //end !empty($tab_size)
					?>
	<?php
	if ( ! empty( $tab_size ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper ul.tab-links_spl,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper h3.tab-links_spl {
		font-size: <?php echo esc_attr($tab_size); ?> !important;
	}

		<?php
	endif; //end !empty($tab_size)
	?>
	<?php
	if ( ! empty( $tab_size ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper ul.tab-links_spl:not(.style-6) li a,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper h3.tab-links_spl {
		font-size: <?php echo esc_attr($tab_size); ?> !important;
		padding-right: 5px !important;
		padding-left: 5px !important;
		text-transform: none !important;
		letter-spacing: .15em;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .tabs_spl ul.tab-links_spl:not(.style-6) li:before {
		font-size: <?php echo esc_attr($tab_size); ?> !important;
	}

		<?php
	endif; //end !empty($tab_size)
	?>
	<?php
	if ( ! empty( $title_size ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .head-title span {
		font-size: <?php echo esc_attr($title_size); ?> !important;
		font-weight: <?php echo esc_attr($title_font_weight); ?>;
	}

	.head-title span.spl_without_tab_style2 {
		font-size: <?php echo esc_attr($title_size); ?> !important;
		font-weight: <?php echo esc_attr($title_font_weight); ?>;
	}

		<?php
		if ( $style == 'style_6' ) {
			?>
			ul.tab-links_spl.with_tab_tablink_style1 {
		padding: 0 !important;
	}

		<?php } ?>
			<?php
	endif; //end !empty($title_size)
	?>
				<?php
				if ( $style == 'style_8' ) {
					?>
					#spl_<?php echo esc_attr($id); ?>.price_wrapper {
						--df-spl-style8-pricetag-bg: <?php echo esc_attr($price_color); ?>;
						--df-spl-style8-active-tab-bg: <?php echo esc_attr($hover_color); ?>;
						--df-spl-style8-tab-font-size: <?php echo esc_attr($tab_size); ?>;
					}
	<?php } ?>
	
					#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-item-popular,
					#spl_<?php echo esc_attr($id); ?>.style-10 .spl-item-popular {
						background-color: <?php echo esc_attr($price_color); ?>;
					}
			<?php
			if ( ! empty( $title_font ) ) :
				?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .head-title span,
		{
		font-family: <?php echo splPrintFontName( $list_name_font ); ?>;
		font-weight: <?php echo esc_attr($title_font_weight); ?>;
	}

	.head-title span.spl_without_tab_style2 {
		font-family: <?php echo splPrintFontName( $list_name_font ); ?>;
		font-weight: <?php echo esc_attr($title_font_weight); ?>;
	}

				<?php
	endif; //end !empty($list_name_font)
			?>
	<?php
	if ( ! empty( $title_font ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .tabs_spl .tab-links_spl li a,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style5_cat_tab .tabs_spl .tab-links_spl li a,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .name-price-desc .spl-price.a-tag,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .df-spl-style7_cat_tab-container ul li a,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .df-spl-style8_cat_tab-container ul li a,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-8-pricetag-container .pricetag span,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-6-2-price .spl-price.a-tag {
		font-family: <?php echo splPrintFontName( $title_font ); ?>;
		/* padding-top: 5px; Test to remove Style 4 */
	}

		<?php
	endif; //end !empty($title_font)
	?>

	/* start font weight css */
	<?php
	if ( ! empty( $tab_font_weight ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .tabs_spl .tab-links_spl li a,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style5_cat_tab .tabs_spl .tab-links_spl li a,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .name-price-desc .spl-price.a-tag,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .df-spl-style7_cat_tab-container ul li a,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-6-2-price .spl-price.a-tag {
		font-weight: <?php echo esc_attr($tab_font_weight); ?>;
	}

	<?php endif; ?>

	/* end font weight css */
	<?php
	if ( ! empty( $price_font ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .name-price-desc .spl-price.a-tag,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-6-2-price .spl-price.a-tag,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-style-5 .spl-five-bottom .spl-style5-price .spl-price p,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-style-7 .spl-price p {
		font-family: <?php echo splPrintFontName( $price_font ); ?>;
	}

		<?php
	endif; //end !empty($price_font)
	?>
	<?php if ( ! empty( $desc_font ) ) : ?>

	/*#spl_
		<?php
		//echo esc_attr($id);
		?>
			.price_wrapper .name-price-desc .desc.a-tag{
  font-family: "
		<?php
		//echo $desc_font;
		?>
				" !important;
  font-size: 95%;
  font-weight: 400;
}*/
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-style-5 .spl-five-bottom .name,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-style-7 .name {
		font-family: <?php echo splPrintFontName( $desc_font ); ?>;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .name-price-desc .name.a-tag,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-8-title-container h3,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-6-2-desc .name.a-tag,
	[data-price-list-id="<?php echo esc_attr($id); ?>"] h5 {
		font-family: <?php echo splPrintFontName( $desc_font ); ?>;
		font-weight: 500;
	}

		<?php
	endif; //end !empty($title_font)
	?>
	/** start of dropdown width */
	<?php if ( $show_dropdown ) : ?>
		#spl_<?php echo esc_attr($id); ?> .ts-wrapper {
			width: <?php echo esc_attr($cats_dropdown_width); ?>;
			margin-left: auto;
			margin-right: auto;
		}
		#spl_<?php echo esc_attr($id); ?> .ts-wrapper.single .ts-control:after {
			border-color: <?php echo esc_attr($title_color_top) . ' transparent transparent transparent'; ?>;
		}
	<?php endif ?>
	/** end of dropdown width */

	/* start category dynamic font weight setting style 3 */
	<?php
	if ( ! empty( $tab_font_weight ) ) :
		?>
		span.head-title.tab-links_spl,
	span.head-title.tab-links_spl.head_title_style_3 {
		font-weight: <?php echo esc_attr($tab_font_weight); ?> !important;
	}

	<?php endif; ?>

	/* end category dynamic font weight setting style 3*/
	/* start service dynamic font weight style 2*/
	<?php
	if ( ! empty( $service_font_weight ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .name-price-desc .name.a-tag,
		[data-price-list-id="<?php echo esc_attr($id); ?>"] h5 {
		font-weight: <?php echo esc_attr($service_font_weight); ?>;
	}

	<?php endif; ?>

	/* end service dynamic font weight style 2*/
	/* start service dynamic font weight */
	<?php
	if ( ! empty( $service_font_weight ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-style-5 .name,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-style-7 .name {
		font-weight: <?php echo esc_attr($service_font_weight); ?> !important;
	}

	<?php endif; ?>

	/* end service dynamic font weight */
	<?php
	if ( ! empty( $service_description_font ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .name-price-desc .desc.a-tag,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-style-5 .spl-five-bottom .desc,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-8-title-container small,
	#spl_<?php echo esc_attr($id); ?> .ts-control .item,
	#spl_<?php echo esc_attr($id); ?> .ts-dropdown-content .option,
	[data-price-list-id="<?php echo esc_attr($id); ?>"] p {
		font-family: <?php echo splPrintFontName( $service_description_font ); ?>;
		font-size: <?php echo esc_attr($service_description_font_size); ?>;
		color: <?php echo esc_attr($service_description_color); ?>;
		font-weight: 400;
	}


	#spl_<?php echo esc_attr($id); ?>.price_wrapper .cat_descreption .col-sm-12,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-style-7 .desc,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style3_cat_desc,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style4_cat_desc {
		font-family: <?php echo splPrintFontName( $tab_description_font ); ?>;
		font-size: <?php echo esc_attr($tab_description_font_size); ?>;
		color: <?php echo esc_attr($tab_description_color); ?>;
		font-weight: 400;
	}

	#spl_<?php echo esc_attr($id); ?> .focus .ts-control {
		border-color: <?php echo esc_attr($service_description_color); ?>;
		box-shadow: 0 0 0 0.2rem <?php echo esc_attr($service_description_color) . '6b'; ?>;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-6-2-btn {
		font-family: <?php echo splPrintFontName( $service_description_font ); ?>;
		font-size: 11px;
	}

	#spl_<?php echo esc_attr($id); ?> .style-4-border {
		border: 1px <?php echo $style4_divider_border_style . ' ' . esc_attr($service_description_color); ?>;
	}

		<?php
	endif; //end !empty($title_font)
	?>

	/* start service description dynamic font weight */
	<?php
	if ( ! empty( $description_font_weight ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .name-price-desc .desc.a-tag,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-style-5 .desc,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-style-7 .desc,
	[data-price-list-id="<?php echo esc_attr($id); ?>"] p {
		font-weight: <?php echo esc_attr($description_font_weight); ?> !important;
	}

	<?php endif; ?>

	/* end service description dynamic font weight */
	/*start category dynamic font size style 2*/
	<?php
	if ( ! empty( $tab_size ) ) :
		if ( $style == 'without_tab' || $style == 'without_tab_single_column' ) :

			?>
		#spl_<?php echo esc_attr($id); ?>span.head-title.tab-links_spl.spl_cat_title_style_2 {
		font-size: <?php echo esc_attr($tab_size); ?> !important;
	}

			<?php
	endif;
	endif;
	?>

	/* end category dynamic font size style 2 */
	/* start category dynamic font weight style 2 */
	<?php
	if ( ! empty( $tab_font_weight ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper span.tab-links_spl.spl_cat_title_style_2 {
		font-weight: <?php echo esc_attr($tab_font_weight); ?> !important;
		font-size: <?php echo esc_attr($tab_size); ?> !important;
	}

	<?php endif; ?>

	/* end category dynamic font weight style 2 */
	<?php
	if ( ! empty( $title_color ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .tabs_spl .tab-links_spl li a,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper span.tab-links_spl {
		<?php
		if ( $style == 'without_tab' || $style == 'style_4' || $style == 'without_tab_single_column' || $style == 'style_6' ) {
			?>
			color: <?php echo esc_attr($title_color); ?> !important;
		font-family: <?php echo splPrintFontName( $title_font ); ?>;
			<?php
		}
		if ( ( $style == 'with_tab' || $style == '' ) && $style_cat_tab_btn == 1 ) {
			?>
		color: #fff !important;
			<?php
		}
		if ( ( $style == 'with_tab' || $style == '' ) && $style_cat_tab_btn == 0 ) {
			?>
		/* If Stylish Buttton is off */
		color: <?php echo esc_attr($title_color); ?> !important;
			<?php
		}
		if ( $style == 'style_3' ) {

			?>
		color: #fff !important;
		font-size: <?php echo esc_attr($tab_size); ?> !important;
			<?php
		}
		if ( $style === 'style_4' ) {
			?>
			font-size: <?php echo esc_attr($tab_size); ?> !important;
			<?php
		}
		?>
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .name-price-desc .spl-price.a-tag {
		<?php
		if ( $style == 'without_tab' || $style == 'style_4' ) {
			?>
	
		font-family: <?php echo splPrintFontName( $price_font ); ?>;
			<?php
		}
		if ( ( $style == 'with_tab' || $style == '' ) && $style_cat_tab_btn == 1 ) {
			?>
		color: #fff !important;
			<?php
		}
		if ( ( $style == 'with_tab' || $style == '' ) && $style_cat_tab_btn == 0 ) {
			?>
		/* If Stylish Buttton is off */
		color: <?php echo esc_attr($title_color); ?> !important;
			<?php
		}
		if ( $style == 'style_3' ) {

			?>
			
		font-size: <?php echo esc_attr($select_price); ?> !important;
			<?php
		}
		?>
	}

		<?php
	endif; //end !empty($title_color)
	?>
	<?php
	if ( ! empty( $service_color ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .name-price-desc .name.a-tag,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .name.a-tag,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-8-title-container h3,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-8-description {
		color: <?php echo esc_attr($service_color); ?> !important;
	}

		<?php
	endif; //end !empty($service_color)
	?>
	<?php
	if ( ! empty( $price_color ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .name-price-desc .spl-price.a-tag,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-seven .spl-price.a-tag,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-6-2-price .spl-price.a-tag {
		color: <?php echo esc_attr($price_color); ?> !important;
	}

	/*style 2 book now button color*/
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl_book_now_btn_style_1 {
		color: <?php echo esc_attr($price_color); ?> !important;
		border: 1px solid <?php echo esc_attr($price_color); ?> !important;
		
	}
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl_book_now_btn_style_1:hover {
		border: 1px solid  <?php echo esc_attr( $hover_color ); ?>;
		background:<?php echo esc_attr( $hover_color ); ?>;
		border: 1px solid <?php echo esc_attr( $hover_color ); ?>;
	}

	/*style 2 book now button color*/
	/*style 6 book now button color start*/
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl_book_now_btn_style_6 {
		color: <?php echo esc_attr($price_color); ?>;
		border: 1px solid <?php echo esc_attr($price_color); ?>;
	}

	/*style 6 book now button color end*/
	/*style 4 book now button color*/
	#spl_<?php echo esc_attr($id); ?> .spl_cstm_btn_style4 .spl_book_now_btn_style_4 {
		color: <?php echo esc_attr($price_color); ?>;
	}

	#spl_<?php echo esc_attr($id); ?> .spl_category_brak_style4 .spl_book_now_btn_style_4 {
		color: <?php echo esc_attr($price_color); ?>;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-style-5 .spl-price p {
		background-color: <?php echo esc_attr($price_color); ?> !important;
	}

	/* style 5 book now button */
	#spl_<?php echo esc_attr($id); ?>.spl_book_now_btn_style_5,
	/* style 5 book now button */
	#spl_<?php echo esc_attr($id); ?>.spl_book_now_btn_style_7 {
		color: <?php echo esc_attr($price_color); ?> !important;
	}

		<?php
	endif; //end !empty($price_color)
	?>
	<?php
	if ( ! empty( $hover_color ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .tabs_spl .tab-links_spl li a:hover {
		color: <?php echo esc_attr($hover_color); ?>;
		border-bottom: 1px solid <?php echo esc_attr($hover_color); ?>;
		text-decoration: none;
		padding-bottom: 7px;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-five-head .tabs_spl .tab-links_spl li a:hover {
		color: #fff !important;
		text-decoration: none !important;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-five-head .head-title span:hover {
		color: <?php echo esc_attr($hover_color); ?> !important;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style5_cat_tab ul.tab-links_spl li:hover {
		background-color: <?php echo esc_attr($hover_color); ?> !important;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .tabs_spl ul.tab-links_spl li:before {
		color: <?php echo esc_attr($hover_color); ?> !important;
	}


	#spl_<?php echo esc_attr($id); ?>.price_wrapper ul.tab-links_spl li.active a {
		border-bottom: 1px solid <?php echo esc_attr($hover_color); ?> !important;
		color: <?php echo esc_attr($hover_color); ?> !important;
		padding-bottom: 5px;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style5_cat_tab ul.tab-links_spl li.active {
		background-color: <?php echo esc_attr($hover_color); ?> !important;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style5_cat_tab ul.tab-links_spl li.active a {
		color: #fff !important;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .df-spl-style7_cat_tab-container ul li.active,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .noUi-connect {
		background-color: <?php echo esc_attr($hover_color); ?>;
	}
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl_book_now_btn_style_7 {
		background-color: <?php echo esc_attr($hover_color); ?>;
		color: white;
    	text-align: center;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .df-spl-style7_cat_tab-container ul li.active a {
		color: #fff;
	}

		<?php
	endif; //end !empty($hover_color)
	?>
	<?php
	if ( ! empty( $default_tab_size ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .tabs_spl .tab-links_spl li.active.default {
		line-height: <?php echo esc_attr($default_tab_size); ?> !important;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .tabs_spl .tab-links_spl li.default a {
		line-height: <?php echo esc_attr($default_tab_size); ?> !important;
		font-size: <?php echo esc_attr($default_tab_size); ?> !important;
	}

		<?php
	endif; //end !empty($default)
	?>
	<?php if ( ! empty( $service_color ) ) : ?>

	/*.price_wrapper .desc.a-tag {
	color: <?php echo esc_attr($service_color); ?> !important;
}*/
		<?php
	endif; // end !empty($service_color)
	?>
	<?php
	if ( ! empty( $title_color_top ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .head-title span {
		color: <?php echo esc_attr($title_color_top); ?> !important;
	}

	.head-title span.spl_without_tab_style2 {
		color: <?php echo esc_attr($title_color_top); ?> !important;
	}

		<?php
	endif; // end !empty($title_color_top)
	?>
	<?php
	if ( ! empty( $select_price ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-price.a-tag,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-style-5 .spl-price p,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-style-7 .spl-price p,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-8-pricetag-container .pricetag span {
		font-size: <?php echo esc_attr($select_price); ?> !important;
	}

		<?php
	endif; //!empty($title_color_top)
	?>

	/* start service price dynmaic font weight setting */
	<?php
	if ( ! empty( $service_price_font_weight ) ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-price.a-tag,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-style-5 .spl-price p,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .spl-style-7 .spl-price p,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style-8-pricetag-container .pricetag span {
		font-weight: <?php echo esc_attr($service_price_font_weight); ?> !important;
	}

	<?php endif; ?>

	/* end service price dynamic font weight setting */
	<?php
	if ( $toggle == 1 ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .tabs_spl ul.tab-links_spl li:before {
			font-weight: normal !important;
			font-style: normal !important;
			display: inline-block !important;
			text-decoration: inherit !important;
			content: "";
			width: 1.25em;
			background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="%235f6368"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>');
			height: 1em;
	}

		<?php
	endif; //($toggle==1)
	?>
	<?php
	if ( $toggle == 0 || $toggle = '' ) :
		?>
		#spl_<?php echo esc_attr($id); ?>.price_wrapper .tabs_spl ul.tab-links_spl li:before {
		font-family: FontAwesome !important;
		font-weight: normal !important;
		font-style: normal !important;
		display: inline-block !important;
		text-decoration: inherit !important;
		/*content: "\F105" !important;*/
		position: absolute !important;
		left: 0 !important;
	}

		<?php
	endif; //($toggle==1)
	?>
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .tabs_spl .tab-links_spl li.active a {
		<?php
		if ( ( $style == 'with_tab' ) && $style_cat_tab_btn == 1 ) {
			?>
			font-weight: bold !important;
		color: #fff !important;
		<?php } ?>
	}

	#spl_<?php echo esc_attr($id); ?> .custom-description-section {
		text-align: center;
		color: <?php echo isset( $tab_description_color ) ? esc_attr($tab_description_color) : '#999'; ?>;
		font-family: <?php echo esc_attr($tab_description_font); ?>;
		font-size: <?php echo ! empty( $tab_description_font_size ) ? esc_attr($tab_description_font_size) : 'inherit'; ?>;
		font-weight: <?php echo esc_attr($tab_description_font_weight); ?>;
	}

	.without_tab {
		clear: both;
		padding-top: 20px;
	}

	h3.head-title {
		margin: 15px 0px;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper ul.tab-links_spl li {
		padding: 2px 5px !important;
	}

	/******************* IF STYLE=1 and Stylish Button = On ********/
	#spl_<?php echo esc_attr($id); ?>.price_wrapper ul.tab-links_spl li a {
		<?php
		if ( ( $style === 'with_tab' ) && $style_cat_tab_btn == 1 ) {
			?>
			background-color: <?php echo esc_attr($title_color); ?> !important;
		padding: 3px 15px !important;
		font-size: 16px;
		border-radius: 5px !important;
		<?php } ?>
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style5_cat_tab ul.tab-links_spl li {
		background-color: <?php echo esc_attr($title_color); ?> !important;
		padding: 8px 22px !important;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .style5_cat_tab ul.tab-links_spl li:before {
		display: none !important;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .df-spl-style7_cat_tab-container ul li:not(.active) a,
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .df-spl-style8_cat_tab-container ul li:not(.active) a {
		color: <?php echo esc_attr($title_color); ?>;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .df-spl-style7_cat_tab-container ul li:before {
		display: none !important;
	}

	#spl_<?php echo esc_attr($id); ?>.price_wrapper .for-style-3 span.head_title_style_3 {
		<?php
		if ( $style == 'style_3' ) {
			?>
		background-color: <?php echo esc_attr($title_color_top); ?> !important;
		color: #fff;
		border-radius: 8px 11px 0px 0px !important;
		padding: 12px !important;
		margin-top: 0px !important;
		text-align: center;
		display: block;
		font-family: <?php echo splPrintFontName( $title_font ); ?>;
		font-weight: <?php echo esc_attr($tab_font_weight); ?>;
		<?php } ?>
	}
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .txt-button-style3:hover {
		background-color: #fff !important;
		color: <?php echo esc_attr($title_color_top); ?>;
		font-family: <?php echo splPrintFontName( $title_font ); ?>;
		border: 1px solid  <?php echo esc_attr($title_color_top); ?>;
		transition: all 0.3s ease;
	}
	#spl_<?php echo esc_attr($id); ?>.price_wrapper .txt-button-style3 {
		font-family: <?php echo splPrintFontName( $title_font ); ?>;
		border: 1px solid  <?php echo esc_attr($title_color_top); ?>;
	}

	/*Book now button style 3*/
	#spl_<?php echo esc_attr($id); ?>.txt-button-style3,
	#spl_<?php echo esc_attr($id); ?>.style-6-2-btn {
		background-color: <?php echo esc_attr($price_color); ?> !important;
		color: #ffffff !important;
	}

	<?php
	if ( $style == 'style_4' ) {
		?>
		ul#tiles_<?php echo esc_attr($id); ?> {
		height: inherit !important;
	}

	<?php } ?>

	/*
Style
*/
	#tiles_<?php echo esc_attr($id); ?> {
		list-style-type: none;
		position: relative;
		margin: 0;
	}

	#tiles_<?php echo esc_attr($id); ?>li {
		width: 350px;
		-moz-border-radius: 2px;
		-webkit-border-radius: 2px;
		border-radius: 2px;
		cursor: pointer;
		padding: 4px;
	}

	#tiles_<?php echo esc_attr($id); ?>ali:nth-child(3n) {
		height: 175px;
	}

	#tiles_<?php echo esc_attr($id); ?>ali:nth-child(4n-3) {
		padding-bottom: 30px;
	}

	#tiles_<?php echo esc_attr($id); ?>ali:nth-child(5n) {
		height: 250px;
	}

	#main_<?php echo esc_attr($id); ?> {
		padding: 30px 0 30px 0;
	}

	#main_<?php echo esc_attr($id); ?> {
		padding: 30px 0 30px 0;
	}

	.masonary-section ul {
		padding-left: 0px !important;
	}

	.masonary-section ul {
		margin: 0px !important;
	}

	#tiles_<?php echo esc_attr($id); ?>li {
		margin: 0 auto !important;
		left: list;
		list-style-type: none;
	}
	.spl_book_now_btn_style_1 {
		width:76px;
		height:28px;
		background:white;
		border-radius:5px !important;
		text-decoration:none;
		color:#E6A900 !important;
		fon-size:12px;

	}
	.spl_book_now_btn_style_1:hover {
		width:76px;
		height:28px;
		border-radius:5px !important;
		text-decoration:none;
		color:white !important;
	}
	.df-spl-level .style-1{
		color:#E6A900;
	}
	.right-style-2{
		color:#E6A900;
	}
	.txt-button-style3{
		background: <?php echo esc_attr($title_color_top); ?>;
		color: #fff;
		border: 1px solid <?php echo esc_attr($title_color_top); ?>;
		float: right;
		font-size:12px;
		line-height: 15px;
		border-radius:20px;
		padding: 6px 14px;
		text-decoration:none;
	}
	
	@media screen and (max-width: 600px) {
		.masonry {
			-moz-column-count: 1;
			-webkit-column-count: 1;
			column-count: 1;
		}

		#tiles_<?php echo esc_attr($id); ?>li {
			left: -26px !important;
		}
	}
</style>
<!-- Include the plug-in -->
<?php 
$url = plugins_url();
add_action('wp_footer', function() use ( $spl_data_values, $jsonld_currency, $enable_seo_jsonld ) {
	if ( intval( $enable_seo_jsonld ) ) {
		spl_generate_schema_markup( $spl_data_values, $jsonld_currency );
	}
});
?>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		function splWhenPluginAvailable(name, callback) {
			var interval = 10; // ms
			window.setTimeout(function () {
				if (jQuery()[name]) {
					callback();
				} else {
					splWhenPluginAvailable(name, callback);
				}
			}, interval)
		};
		var width = jQuery(window).width();
		if (width > 1024) {
			jQuery('.brack_title_tablets').remove();
		} else {
			jQuery('.brack_title_desktop').remove();
		}
		if (width > 1024) {
			jQuery('.brack_title_tablets_tab').remove();
		} else {
			jQuery('.brack_title_desktop_tab').remove();
		}
		/// Resize
		var shortcodeid = "_<?php echo esc_attr($id); ?>";
		
		splWhenPluginAvailable('wookmark', function() {
			jQuery('#tiles' + shortcodeid + ' li').wookmark({
				autoResize: true,
				container: jQuery('#tiles' + shortcodeid),
				offset: 2,
				itemWidth: 360,
				flexibleWidth: '50%'
			});
		});
		jQuery(window).trigger('resize');
	});
</script>
<!--AK Style -->

