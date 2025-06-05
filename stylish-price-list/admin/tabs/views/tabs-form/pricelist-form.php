<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
wp_enqueue_style( 'wp-color-picker' );
// wp_enqueue_script( 'spl-bootstrap-min' );
wp_enqueue_script( 'spl-pricelist-admin-core' );
wp_enqueue_script( 'spl-sortablejs' );
wp_enqueue_script( 'spl-pricelist-admin' );
wp_enqueue_script( 'spl-pricelist-colorpicker' );
wp_enqueue_style( 'spl-bootstrap-min' );
wp_enqueue_style( 'spl-list-style' );
wp_enqueue_style( 'spl-admin-style' );
wp_enqueue_style( 'spl-admin-fonts' );
wp_enqueue_style( 'spl-jquery-ui', SPL_URL . 'assets/css/jquery-ui.css', array(), '1.1' );
wp_localize_script(
	'spl-pricelist-admin',
	'SPL_item_thumb',
	array(
		'security' => wp_create_nonce( 'spl_upload_ser_img' ),
	)
);



$id = '';
// phpcs:ignore
if ( isset( $_GET['id'] ) ) {
	// phpcs:ignore
	$id = intval($_GET['id']);
}
$jsonld_currency = 'USD'; // Initialize with default value
?>
<!--Include library sortable-->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script> -->
<?php
$list_count               = df_spl_get_tabs_count();
$opt                      = df_spl_get_options();

// $google_fonts_preview_out = $opt['google_fonts_preview_out'];
$opt = apply_filters( 'post-spricelist-form', $opt );
$opt['html_out']          = 'select_html';
$html_out                 = $opt['html_out'];
$opt['get_fonts_options'] = 'get_fonts_options';
$get_fonts_options        = $opt['get_fonts_options'];
$max_cat_count            = $opt['max_cat_count'];
$max_service_count        = $opt['max_service_count'];
$max_list_count           = $opt['max_list_count'];
$update_state             = $opt[hex2bin('6c6963656e7365')];
$current_max_input_var    = ini_get( 'max_input_vars' );
if ( $list_count >= $max_list_count && empty( $id ) ) {
	echo df_spl_want_more_lists();
	return;
};
// $df_spl_want_more_lists=$opt['df_spl_want_more_lists'];
?>
<?php
$cats_data     = array();
$_init_service = array(
	'service_name'             => '',
	'service_regular_price'    => '',
	'service_price'            => '',
	'service_desc'             => '',
	'service_button'           => '',
	'service_button_url'       => '',
	'service_image'            => '',
	'service_long_description' => '',
	//      'service_url'  => ''
);
$init_cat                  = array(
	'name' => '',
	0      => $_init_service,
);
$cats_data['category'][1]  = array(
	'name' => '',
	1      => $_init_service,
);

$spl_screen = get_current_screen();
$spl_screen = ( isset( $spl_screen->id ) ) ? $spl_screen->id : '';
$predefined_pricelist_name = ( $spl_screen === 'admin_page_spl-tabs-new' && isset( $_GET['listname'] ) ) ? sanitize_text_field( $_GET['listname'] ) : '';
$list_name                 = $predefined_pricelist_name;
$list_type                 = isset( $_GET['list-type'] ) ? sanitize_text_field( $_GET['list-type'] ) : 'price_list';
$hover_color               = '';
$title_color               = '';
$title_color_top           = '';
$price_color               = '';
$service_description_color = '';
$tab_description_color     = '';
$service_color             = '';
$list_name_font            = '';
$title_font                = '';
$price_font                = '';
$service_description_font  = '';
$tab_description_font      = '';
$desc_font                 = '';
$optionArr                 = array(
	'Thin'        => 100,
	'Extra_Light' => 200,
	'Light'       => 300,
	'Normal'      => 400,
	'Medium'      => 500,
	'Semi_Bold'   => 600,
	'Bold'        => 700,
	'Extra_Bold'  => 800,
	'Ultra_Bold'  => 900,
);

if ( ! empty( $id ) ) {
	$cats_data = df_spl_get_option( $id );
	
	$list_name         = isset( $cats_data['list_name'] ) ? $cats_data['list_name'] : ''; //$cats_data['list_name']
	$list_type         = isset( $cats_data['list_type'] ) ? $cats_data['list_type'] : ''; //$cats_data['list_type']
	$all_tab           = isset( $cats_data['all_tab'] ) ? $cats_data['all_tab'] : ''; //$cats_data['all_tab']
	$style_cat_tab_btn = isset( $cats_data['style_cat_tab_btn'] ) ? $cats_data['style_cat_tab_btn'] : ''; //$cats_data['style_cat_tab_btn']
	$spl_remove_title  = isset( $cats_data['spl_remove_title'] ) ? $cats_data['spl_remove_title'] : '';
	$style             = isset( $cats_data['tab_style'] ) ? $cats_data['tab_style'] : '';
	
	$style5_category   = isset( $cats_data['style5_category'] ) ? $cats_data['style5_category'] : '';
	 //$cats_data['tab_style']
	$hover_color               = isset( $cats_data['hover_color'] ) ? $cats_data['hover_color'] : ''; //$cats_data['hover_color']
	$service_color             = isset( $cats_data['service_color'] ) ? $cats_data['service_color'] : ''; //$cats_data['service_color']
	$title_color               = isset( $cats_data['title_color'] ) ? $cats_data['title_color'] : ''; //$cats_data['title_color']
	$price_color               = isset( $cats_data['price_color'] ) ? $cats_data['price_color'] : ''; //$cats_data['price_color']
	$service_description_color = isset( $cats_data['service_description_color'] ) ? $cats_data['service_description_color'] : ''; //$cats_data['service_description_color']
	$tab_description_color     = isset( $cats_data['tab_description_color'] ) ? $cats_data['tab_description_color'] : ''; //$cats_data['service_description_color']
	$title_size                = isset( $cats_data['title_font_size'] ) ? $cats_data['title_font_size'] : ''; //$cats_data['title_font_size']
	$title_color_top           = isset( $cats_data['title_color_top'] ) ? $cats_data['title_color_top'] : ''; //$cats_data['title_color_top']
	$select_price              = isset( $cats_data['service_price_font_size'] ) ? $cats_data['service_price_font_size'] : ''; //$cats_data['service_price_font_size']
	$list_name_font            = isset( $cats_data['list_name_font'] ) ? $cats_data['list_name_font'] : ''; //$cats_data['list_name_font']
	$title_font                = isset( $cats_data['title_font'] ) ? $cats_data['title_font'] : ''; //$cats_data['title_font']
	$price_font                = isset( $cats_data['price_font'] ) ? $cats_data['price_font'] : ''; //$cats_data['price_font']
	$service_description_font  = isset( $cats_data['service_description_font'] ) ? $cats_data['service_description_font'] : ''; //$cats_data['service_description_font']
	$tab_description_font      = isset( $cats_data['tab_description_font'] ) ? $cats_data['tab_description_font'] : ''; //$cats_data['service_description_font']
	$desc_font                 = isset( $cats_data['desc_font'] ) ? $cats_data['desc_font'] : ''; //$cats_data['desc_font']
	$toggle                    = isset( $cats_data['toggle'] ) ? $cats_data['toggle'] : ''; //$cats_data['toggle']
	$toggle_all_tab            = isset( $cats_data['toggle_all_tab'] ) ? $cats_data['toggle_all_tab'] : ''; //$cats_data['toggle_all_tab']
	$price_list_desc           = isset( $cats_data['price_list_desc'] ) ? $cats_data['price_list_desc'] : ''; //$cats_data['price_list_desc']
	$brack_title_desktop       = isset( $cats_data['brack_title_desktop'] ) ? $cats_data['brack_title_desktop'] : ''; //$cats_data['brack_title_desktop']
	$brack_title_tablets       = isset( $cats_data['brack_title_tablets'] ) ? $cats_data['brack_title_tablets'] : ''; //$cats_data['brack_title_tablets']
	$jsonld_currency		   = isset( $cats_data['jsonld_currency'] ) ? $cats_data['jsonld_currency'] : 'USD'; //$cats_data['jsonld_currency']
	$enable_seo_jsonld		   = isset( $cats_data['enable_seo_jsonld'] ) ? $cats_data['enable_seo_jsonld'] : 0;
}
// phpcs:ignore
$id         = isset( $_GET['id'] ) ? intval($_GET['id']) : '';
$cats_data1 = df_spl_get_option( $id );
//echo '<pre>'; print_r($cats_data1); echo '</pre>';
$lang_obj = new df_spl_convert_lang();
// phpcs:ignore
if ( isset( $_REQUEST['lang'] ) ) {
	// phpcs:ignore
	$language_choice = sanitize_text_field( $_REQUEST['lang'] );
	$Select_Language                       = $lang_obj->convert_lang_function( $language_choice, 'Select_Language' );
	$Select_Column                         = $lang_obj->convert_lang_function( $language_choice, 'Select_Column' );
	$Max_Width                             = $lang_obj->convert_lang_function( $language_choice, 'Max_Width' );
	$Save                                  = $lang_obj->convert_lang_function( $language_choice, 'Save' );
	$Price_List_Name                       = $lang_obj->convert_lang_function( $language_choice, 'Price_List_Name' );
	$Select_Style                          = $lang_obj->convert_lang_function( $language_choice, 'Select_Style' );
	$More_Settings                         = $lang_obj->convert_lang_function( $language_choice, 'More_Settings' );
	$Default_Tab                           = $lang_obj->convert_lang_function( $language_choice, 'Default_Tab' );
	$Change_All_word_for_Categories        = $lang_obj->convert_lang_function( $language_choice, 'Change_All_word_for_Categories' );
	$different_languages                   = $lang_obj->convert_lang_function( $language_choice, 'different_languages' );
	$Remove_title                          = $lang_obj->convert_lang_function( $language_choice, 'Remove_title' );
	$Display_the_All_word                  = $lang_obj->convert_lang_function( $language_choice, 'Display_the_All_word' );
	$Style4_Divider_Style                  = $lang_obj->convert_lang_function( $language_choice, 'Style4_Divider_Style' );
	$Category_Image_Overlay_Percent        = $lang_obj->convert_lang_function( $language_choice, 'Category_Image_Overlay_Percent' );
	$Category_Desc_Embed_To_Cover_Image_S10       = $lang_obj->convert_lang_function( $language_choice, 'Category_Desc_Embed_To_Cover_Image_S10' );
	$Category_Separator_Symbol             = $lang_obj->convert_lang_function( $language_choice, 'Category_Separator_Symbol' );
	$Arrange_Categories_In_Dropdown        = $lang_obj->convert_lang_function( $language_choice, 'Arrange_Categories_In_Dropdown' );
	$Categories_In_Dropdown_Prevent_Keyboard_Popup = $lang_obj->convert_lang_function( $language_choice, 'Categories_In_Dropdown_Prevent_Keyboard_Popup' );
	$category_select_scroll_effect_label_text = $lang_obj->convert_lang_function( $language_choice, 'category_select_scroll_effect_label_text' );
	$Category_Dropdown_Width               = $lang_obj->convert_lang_function( $language_choice, 'Category_Dropdown_Width' );
	$Stylish_Category_Tabs_Buttons         = $lang_obj->convert_lang_function( $language_choice, 'Stylish_Category_Tabs_Buttons' );
	$Open_Buy_Btn_Link_In_New_Tab          = $lang_obj->convert_lang_function( $language_choice, 'Open_Buy_Btn_Link_In_New_Tab' );
	$Add_Search_Bar                        = $lang_obj->convert_lang_function( $language_choice, 'Add_Search_Bar' );
	$price_range_slider                    = $lang_obj->convert_lang_function( $language_choice, 'Price_Range_Slider' );
	$Break_title_of_Service                = $lang_obj->convert_lang_function( $language_choice, 'Break_title_of_Service' );
	$Break_line_of_categories_on_Desktop   = $lang_obj->convert_lang_function( $language_choice, 'Break_line_of_categories_on_Desktop' );
	$Break_line_of_categories_on_Tablets   = $lang_obj->convert_lang_function( $language_choice, 'Break_line_of_categories_on_Tablets' );
	$Price_List_Description                = $lang_obj->convert_lang_function( $language_choice, 'Price_List_Description' );
	$items_price_currency                  = $lang_obj->convert_lang_function( $language_choice, 'Items_Price_Currency' );
	$enable_product_seo_schema             = $lang_obj->convert_lang_function( $language_choice, 'Enable_Product_Seo_Schema' );
	$Title                                 = $lang_obj->convert_lang_function( $language_choice, 'Title' );
	$Category_Tabs                         = $lang_obj->convert_lang_function( $language_choice, 'Category_Tabs' );
	$Category_description_Tabs             = $lang_obj->convert_lang_function( $language_choice, 'Category_description_Tabs' );
	$Service_Name                          = $lang_obj->convert_lang_function( $language_choice, 'Service_Name' );
	$Service_Price                         = $lang_obj->convert_lang_function( $language_choice, 'Service_Price' );
	$Service_Description                   = $lang_obj->convert_lang_function( $language_choice, 'Service_Description' );
	$Category_description_Tabs             = $lang_obj->convert_lang_function( $language_choice, 'Category_description_Tabs' );
	$Font_Size                             = $lang_obj->convert_lang_function( $language_choice, 'Font_Size' );
	$Font_Color                            = $lang_obj->convert_lang_function( $language_choice, 'Font_Color' );
	$Font_Style                            = $lang_obj->convert_lang_function( $language_choice, 'Font_Style' );
	$Font_Weight                           = $lang_obj->convert_lang_function( $language_choice, 'Font_Weight' );
	$Hover_Color                           = $lang_obj->convert_lang_function( $language_choice, 'Hover_Color' );
	$GLOBALS['Category_Name']              = $lang_obj->convert_lang_function( $language_choice, 'Category_Name' );
	$GLOBALS['Category_Description']       = $lang_obj->convert_lang_function( $language_choice, 'Category_Description' );
	$GLOBALS['Category_Background_Color']  = $lang_obj->convert_lang_function( $language_choice, 'Category_Background_Color' );
	$GLOBALS['Category_Text_Color']        = $lang_obj->convert_lang_function( $language_choice, 'Category_Text_Color' );
	$GLOBALS['Category_Action_Text']       = $lang_obj->convert_lang_function( $language_choice, 'Category_Action_Text' );
	$GLOBALS['Category_Action_Link']       = $lang_obj->convert_lang_function( $language_choice, 'Category_Action_Link' );
	$GLOBALS['Category_Price']             = $lang_obj->convert_lang_function( $language_choice, 'Category_Price' );
	$GLOBALS['Category_Image']             = $lang_obj->convert_lang_function( $language_choice, 'Category_Image' );
	$GLOBALS['Service_Name']               = $lang_obj->convert_lang_function( $language_choice, 'Service_Name' );
	$GLOBALS['Service_Regular_Price']      = $lang_obj->convert_lang_function( $language_choice, 'Service_Regular_Price' );
	$GLOBALS['Service_Long_Description']   = $lang_obj->convert_lang_function( $language_choice, 'Service_Long_Description' );
	$GLOBALS['Service_Price']              = $lang_obj->convert_lang_function( $language_choice, 'Service_Price' );
	$GLOBALS['Service_Description_Length'] = $lang_obj->convert_lang_function( $language_choice, 'Service_Description_Length' );
	$GLOBALS['Service_Button']             = $lang_obj->convert_lang_function( $language_choice, 'Service_Button' );
	$GLOBALS['Service_Button_URL']         = $lang_obj->convert_lang_function( $language_choice, 'Service_Button_URL' );
	$GLOBALS['Service_Image']              = $lang_obj->convert_lang_function( $language_choice, 'Service_Image' );
		// $GLOBALS['Service_URL'] = $lang_obj->convert_lang_function($language_choice,'Service_URL');
	$GLOBALS['Remove_Service']  = $lang_obj->convert_lang_function( $language_choice, 'Remove_Service' );
	$GLOBALS['Add_Service']     = $lang_obj->convert_lang_function( $language_choice, 'Add_Service' );
	$GLOBALS['Add_Category']    = $lang_obj->convert_lang_function( $language_choice, 'Add_Category' );
	$GLOBALS['Remove_Category'] = $lang_obj->convert_lang_function( $language_choice, 'Remove_Category' );
	$Restore                    = $lang_obj->convert_lang_function( $language_choice, 'Restore' );
	$Backup                     = $lang_obj->convert_lang_function( $language_choice, 'Backup' );
	$Preview_List               = $lang_obj->convert_lang_function( $language_choice, 'Preview_List' );
	$FONT_SETTINGS              = $lang_obj->convert_lang_function( $language_choice, 'FONT_SETTINGS' );
	$ADD_TO_WEBPAGE             = $lang_obj->convert_lang_function( $language_choice, 'ADD_TO_WEBPAGE' );
	$GLOBALS['CATEGORY']        = $lang_obj->convert_lang_function( $language_choice, 'CATEGORY' );
} else {
	if ( isset( $cats_data1['select_lang'] ) && $cats_data1['select_lang'] != '' ) {
		$Select_Language                       = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Select_Language' );
		$Select_Column                         = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Select_Column' );
		$Max_Width                             = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Max_Width' );
		$Save                                  = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Save' );
		$Price_List_Name                       = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Price_List_Name' );
		$Select_Style                          = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Select_Style' );
		$More_Settings                         = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'More_Settings' );
		$Default_Tab                           = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Default_Tab' );
		$Change_All_word_for_Categories        = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Change_All_word_for_Categories' );
		$different_languages                   = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'different_languages' );
		$Remove_title                          = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Remove_title' );
		$Display_the_All_word                  = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Display_the_All_word' );
		$Style4_Divider_Style                  = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Style4_Divider_Style' );
		$Category_Image_Overlay_Percent        = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Category_Image_Overlay_Percent' );
		$Category_Desc_Embed_To_Cover_Image_S10       = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Category_Desc_Embed_To_Cover_Image_S10' );
		$Category_Separator_Symbol             = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Category_Separator_Symbol' );
		$Arrange_Categories_In_Dropdown        = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Arrange_Categories_In_Dropdown' );
		$Categories_In_Dropdown_Prevent_Keyboard_Popup = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Categories_In_Dropdown_Prevent_Keyboard_Popup' );
		$category_select_scroll_effect_label_text = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'category_select_scroll_effect_label_text' );
		$Category_Dropdown_Width               = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Category_Dropdown_Width' );
		$Stylish_Category_Tabs_Buttons         = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Stylish_Category_Tabs_Buttons' );
		$Open_Buy_Btn_Link_In_New_Tab          = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Open_Buy_Btn_Link_In_New_Tab' );
		$Add_Search_Bar                        = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Add_Search_Bar' );
		$price_range_slider                    = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Price_Range_Slider' );
		$Break_title_of_Service                = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Break_title_of_Service' );
		$Break_line_of_categories_on_Desktop   = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Break_line_of_categories_on_Desktop' );
		$Break_line_of_categories_on_Tablets   = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Break_line_of_categories_on_Tablets' );
		$Price_List_Description                = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Price_List_Description' );
		$items_price_currency				   = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Items_Price_Currency' );
		$enable_product_seo_schema             = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Enable_Product_Seo_Schema' );
		$Title                                 = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Title' );
		$Category_Tabs                         = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Category_Tabs' );
		$Service_Name                          = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Service_Name' );
		$Service_Price                         = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Service_Price' );
		$Service_Description                   = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Service_Description' );
		$Category_description_Tabs             = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Category_description_Tabs' );
		$Font_Size                             = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Font_Size' );
		$Font_Color                            = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Font_Color' );
		$Font_Style                            = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Font_Style' );
		$Font_Weight                           = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Font_Weight' );
		$Hover_Color                           = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Hover_Color' );
		$GLOBALS['Category_Name']              = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Category_Name' );
		$GLOBALS['Category_Description']       = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Category_Description' );
		$GLOBALS['Category_Background_Color']  = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Category_Background_Color' );
		$GLOBALS['Category_Text_Color']        = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Category_Text_Color' );
		$GLOBALS['Category_Image']             = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Category_Image' );
		$GLOBALS['Category_Action_Text']       = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Category_Action_Text' );
		$GLOBALS['Category_Action_Link']       = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Category_Action_Link' );
		$GLOBALS['Category_Price']             = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Category_Price' );
		$GLOBALS['Service_Name']               = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Service_Name' );
		$GLOBALS['Service_Regular_Price']      = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Service_Regular_Price' );
		$GLOBALS['Service_Long_Description']   = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Service_Long_Description' );
		$GLOBALS['Service_Price']              = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Service_Price' );
		$GLOBALS['Service_Description_Length'] = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Service_Description_Length' );
		$GLOBALS['Service_Button']             = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Service_Button' );
		$GLOBALS['Service_Button_URL']         = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Service_Button_URL' );
		$GLOBALS['Service_Image']              = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Service_Image' );
		// $GLOBALS['Service_URL'] = $lang_obj->convert_lang_function($cats_data1['select_lang'],'Service_URL');
		$GLOBALS['Remove_Service']  = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Remove_Service' );
		$GLOBALS['Add_Service']     = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Add_Service' );
		$GLOBALS['Add_Category']    = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Add_Category' );
		$GLOBALS['Remove_Category'] = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Remove_Category' );
		$Restore                    = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Restore' );
		$Backup                     = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Backup' );
		$Preview_List               = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'Preview_List' );
		$FONT_SETTINGS              = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'FONT_SETTINGS' );
		$ADD_TO_WEBPAGE             = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'ADD_TO_WEBPAGE' );
		$GLOBALS['CATEGORY']        = $lang_obj->convert_lang_function( $cats_data1['select_lang'], 'CATEGORY' );
	} else {
		$Select_Language                       = $lang_obj->convert_lang_function( 'EN', 'Select_Language' );
		$Select_Column                         = $lang_obj->convert_lang_function( 'EN', 'Select_Column' );
		$Max_Width                             = $lang_obj->convert_lang_function( 'EN', 'Max_Width' );
		$Save                                  = $lang_obj->convert_lang_function( 'EN', 'Save' );
		$Price_List_Name                       = $lang_obj->convert_lang_function( 'EN', 'Price_List_Name' );
		$Select_Style                          = $lang_obj->convert_lang_function( 'EN', 'Select_Style' );
		$More_Settings                         = $lang_obj->convert_lang_function( 'EN', 'More_Settings' );
		$Default_Tab                           = $lang_obj->convert_lang_function( 'EN', 'Default_Tab' );
		$Change_All_word_for_Categories        = $lang_obj->convert_lang_function( 'EN', 'Change_All_word_for_Categories' );
		$different_languages                   = $lang_obj->convert_lang_function( 'EN', 'different_languages' );
		$Remove_title                          = $lang_obj->convert_lang_function( 'EN', 'Remove_title' );
		$Display_the_All_word                  = $lang_obj->convert_lang_function( 'EN', 'Display_the_All_word' );
		$Style4_Divider_Style                  = $lang_obj->convert_lang_function( 'EN', 'Style4_Divider_Style' );
		$Category_Image_Overlay_Percent        = $lang_obj->convert_lang_function( 'EN', 'Category_Image_Overlay_Percent' );
		$Category_Desc_Embed_To_Cover_Image_S10       = $lang_obj->convert_lang_function( 'EN', 'Category_Desc_Embed_To_Cover_Image_S10' );
		$Category_Separator_Symbol             = $lang_obj->convert_lang_function( 'EN', 'Category_Separator_Symbol' );
		$Arrange_Categories_In_Dropdown        = $lang_obj->convert_lang_function( 'EN', 'Arrange_Categories_In_Dropdown' );
		$Categories_In_Dropdown_Prevent_Keyboard_Popup = $lang_obj->convert_lang_function( 'EN', 'Categories_In_Dropdown_Prevent_Keyboard_Popup' );
		$category_select_scroll_effect_label_text = $lang_obj->convert_lang_function( 'EN', 'category_select_scroll_effect_label_text' );
		$Category_Dropdown_Width               = $lang_obj->convert_lang_function( 'EN', 'Category_Dropdown_Width' );
		$Stylish_Category_Tabs_Buttons         = $lang_obj->convert_lang_function( 'EN', 'Stylish_Category_Tabs_Buttons' );
		$Open_Buy_Btn_Link_In_New_Tab          = $lang_obj->convert_lang_function( 'EN', 'Open_Buy_Btn_Link_In_New_Tab' );
		$Add_Search_Bar                        = $lang_obj->convert_lang_function( 'EN', 'Add_Search_Bar' );
		$price_range_slider                    = $lang_obj->convert_lang_function( 'EN', 'Price_Range_Slider' );
		$Break_title_of_Service                = $lang_obj->convert_lang_function( 'EN', 'Break_title_of_Service' );
		$Break_line_of_categories_on_Desktop   = $lang_obj->convert_lang_function( 'EN', 'Break_line_of_categories_on_Desktop' );
		$Break_line_of_categories_on_Tablets   = $lang_obj->convert_lang_function( 'EN', 'Break_line_of_categories_on_Tablets' );
		$Price_List_Description                = $lang_obj->convert_lang_function( 'EN', 'Price_List_Description' );
		$items_price_currency				   = $lang_obj->convert_lang_function( 'EN', 'Items_Price_Currency' );
		$enable_product_seo_schema             = $lang_obj->convert_lang_function( 'EN', 'Enable_Product_Seo_Schema' );
		$Title                                 = $lang_obj->convert_lang_function( 'EN', 'Title' );
		$Category_Tabs                         = $lang_obj->convert_lang_function( 'EN', 'Category_Tabs' );
		$Service_Name                          = $lang_obj->convert_lang_function( 'EN', 'Service_Name' );
		$Service_Price                         = $lang_obj->convert_lang_function( 'EN', 'Service_Price' );
		$Service_Description                   = $lang_obj->convert_lang_function( 'EN', 'Service_Description' );
		$Category_description_Tabs             = $lang_obj->convert_lang_function( 'EN', 'Category_description_Tabs' );
		$Font_Size                             = $lang_obj->convert_lang_function( 'EN', 'Font_Size' );
		$Font_Color                            = $lang_obj->convert_lang_function( 'EN', 'Font_Color' );
		$Font_Style                            = $lang_obj->convert_lang_function( 'EN', 'Font_Style' );
		$Font_Weight                           = $lang_obj->convert_lang_function( 'EN', 'Font_Weight' );
		$Hover_Color                           = $lang_obj->convert_lang_function( 'EN', 'Hover_Color' );
		$GLOBALS['Category_Name']              = $lang_obj->convert_lang_function( 'EN', 'Category_Name' );
		$GLOBALS['Category_Description']       = $lang_obj->convert_lang_function( 'EN', 'Category_Description' );
		$GLOBALS['Category_Action_Text']       = $lang_obj->convert_lang_function( 'EN', 'Category_Action_Text' );
		$GLOBALS['Category_Action_Link']       = $lang_obj->convert_lang_function( 'EN', 'Category_Action_Link' );
		$GLOBALS['Category_Price']             = $lang_obj->convert_lang_function( 'EN', 'Category_Price' );
		$GLOBALS['Category_Background_Color']  = $lang_obj->convert_lang_function( 'EN', 'Category_Background_Color' );
		$GLOBALS['Category_Text_Color']        = $lang_obj->convert_lang_function( 'EN', 'Category_Text_Color' );
		$GLOBALS['Category_Image']             = $lang_obj->convert_lang_function( 'EN', 'Category_Image' );
		$GLOBALS['Service_Name']               = $lang_obj->convert_lang_function( 'EN', 'Service_Name' );
		$GLOBALS['Service_Regular_Price']      = $lang_obj->convert_lang_function( 'EN', 'Service_Regular_Price' );
		$GLOBALS['Service_Long_Description']   = $lang_obj->convert_lang_function( 'EN', 'Service_Long_Description' );
		$GLOBALS['Service_Price']              = $lang_obj->convert_lang_function( 'EN', 'Service_Price' );
		$GLOBALS['Service_Description_Length'] = $lang_obj->convert_lang_function( 'EN', 'Service_Description_Length' );
		$GLOBALS['Service_Button']             = $lang_obj->convert_lang_function( 'EN', 'Service_Button' );
		$GLOBALS['Service_Button_URL']         = $lang_obj->convert_lang_function( 'EN', 'Service_Button_URL' );
		$GLOBALS['Service_Image']              = $lang_obj->convert_lang_function( 'EN', 'Service_Image' );
		// $GLOBALS['Service_URL'] = $lang_obj->convert_lang_function('EN','Service_URL');
		$GLOBALS['Remove_Service']  = $lang_obj->convert_lang_function( 'EN', 'Remove_Service' );
		$GLOBALS['Add_Service']     = $lang_obj->convert_lang_function( 'EN', 'Add_Service' );
		$GLOBALS['Add_Category']    = $lang_obj->convert_lang_function( 'EN', 'Add_Category' );
		$GLOBALS['Remove_Category'] = $lang_obj->convert_lang_function( 'EN', 'Remove_Category' );
		$Restore                    = $lang_obj->convert_lang_function( 'EN', 'Restore' );
		$Backup                     = $lang_obj->convert_lang_function( 'EN', 'Backup' );
		$Preview_List               = $lang_obj->convert_lang_function( 'EN', 'Preview_List' );
		$FONT_SETTINGS              = $lang_obj->convert_lang_function( 'EN', 'FONT_SETTINGS' );
		$ADD_TO_WEBPAGE             = $lang_obj->convert_lang_function( 'EN', 'ADD_TO_WEBPAGE' );
		$GLOBALS['CATEGORY']        = $lang_obj->convert_lang_function( 'EN', 'CATEGORY' );
	}
}
/*function global_lang(){
	return 'hello';
}*/
function df_spl_want_more_lists() {
	ob_start();
	include_once dirname( __FILE__ ) . '/logo-header.php';
	?>
	<div class="body-inner container-fluid" style="max-width:900px;margin-left:0px;">
		<div class="df-spl-row cats-row">
			You're using the free version of this plugin, you can only use a maximum of 2 lists, 3 categories and 4 services. You can purchase a license to add unlimited lists and services. and categories. <a href="https://stylishpricelist.com/"> Purchase Here</a>
		</div>
	</div>
	<?php
	$html = ob_get_clean();
	return $html;
}//end df_spl_want_more_lists()
if ( ! function_exists( 'df_spl_color_out' ) ) {
	function df_spl_color_out( $id, $value = '', $title = '' ) {
		ob_start();
		?>
		<div class="field-wrapper">
			<?php if ( $title ) { ?>
				<label for="<?php echo esc_attr($id); ?>"><?php echo esc_attr($title); ?></label>
			<?php } ?>
				<input hidden type="text" name="<?php echo esc_attr($id); ?>" id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($value); ?>" title="<?php echo esc_attr($title); ?>">
				<toolcool-color-picker button-width="5rem" button-height="2.5rem" data-target="<?php echo esc_attr($id); ?>" color="<?php echo esc_attr($value); ?>"></toolcool-color-picker>
		</div> <!-- <?php echo esc_attr($title); ?> -->
		<?php
		$html = ob_get_clean();
		return $html;
	}//end df_spl_color_out()
}//end if !function_exists('df_spl_color_out')
if ( ! function_exists( 'df_spl_how_to_get_google_fonts' ) ) {
	function df_spl_how_to_get_google_fonts() {
		ob_start();
		?>
		<div class="df-spl-row cats-row font_setting_container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				Enter your <b>license key</b> to get Google fonts,
				how Google fonts look like? check <a href="https://fonts.google.com/">Google fonts preview</a>
			</div>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	}//end df_spl_how_to_get_google_fonts()
}//end if !function_exists('df_spl_how_to_get_google_fonts')
if ( ! function_exists( 'google_fonts_preview' ) ) {
	function google_fonts_preview() {
		ob_start();
		?>
		<?php
		$html = ob_get_clean();
		return $html;
	}//end google_fonts_preview()
}//end if !function_exists('google_fonts_preview')
if ( ! function_exists( 'html_out' ) ) {
	function html_out( $name, $options = array(), $current_value = '', $title = '' ) {
		$html_out = 'hidden_html';//
		ob_start();
		?>
		<div class="df-spl-row cats-row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 lbl">
				<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<?php echo $html_out( $name, $options, $current_value ); ?>
			</div>
		</div> <!-- List Name Font -->
		<?php
		$html = ob_get_clean();
		return $html;
	}//end html_out()
}//end if !function_exists('html_out')
if ( ! function_exists( 'hidden_html' ) ) {
	function hidden_html( $name, $options = array(), $current_value = '', $title = '' ) {
		ob_start();
		?>
		<input type="hidden" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" class="form-control" value="<?php echo esc_attr($current_value); ?>">
		<?php
		$html = ob_get_clean();
		return $html;
	}
}//end if !function_exists('hidden_html')
?>
<?php
if ( ! function_exists( 'select_html' ) ) {
	function select_html( $name, $options = array(), $current_value = '', $title = '' ) {
		ob_start();
		?>
		<div class="field-wrapper" style="margin-bottom:0;">
				<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				<select name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" class="form-control" style="box-shadow: 2px 2px 0px #888;">
					<?php foreach ( $options as $value => $label ) : ?>
						<?php
						$selected = '';
						if ( $current_value == $value ) {
							$selected = ' selected="selected"';
						}
						if ( $current_value == '' ) {
							if ( $label == 'Open Sans' ) {
								$selected = ' selected="selected"';
							}
						}
						?>
					<option value="<?php echo esc_attr($value); ?>"<?php echo esc_attr($selected); ?>><?php echo esc_attr($label); ?></option>
				<?php endforeach ?>
			</select>
	</div> <!-- <?php echo esc_attr($title); ?> -->
		<?php
		$html = ob_get_clean();
		return $html;
	}
}//end if !function_exists('select_html')
?>
<?php
if ( ! function_exists( 'service_items_html' ) ) {
	function service_items_html( $cat_id = 0, $service_id = 0, $service = null ) {
		ob_start();
		$items = array(
			array(
				'title' => $GLOBALS['Service_Name'],
				'id'    => 'service_name',
			),
			array(
				'title' => $GLOBALS['Service_Long_Description'],
				'id'    => 'service_long_description',
			),
			array(
				'title' => $GLOBALS['Service_Price'],
				'id'    => 'service_price',
			),
			array(
				'title' => $GLOBALS['Service_Description_Length'],
				'id'    => 'service_desc',
			)
		);

		foreach ( $items as $key => $item ) {
			$item['cat_id']     = $cat_id;
			$item['service_id'] = $service_id;
			$item['value']      = isset( $service[ $item['id'] ] ) && $service[ $item['id'] ] ? $service[ $item['id'] ] : false;
			echo service_item( $item );
		}
		$html = ob_get_clean();
		return $html;
	}//end service_items_html()
}//end if !function_exists('service_items_html')
if ( ! function_exists( 'add_remove_service' ) ) {
	function add_remove_service( $max_service_count ) {
		ob_start();
		?>
		<div class="df-spl-row add-remove-service custom-mobile">
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 remove-service">
				<a href="javascript:void(0);" onclick="remove_service(this)" class="remove-service add-remove-service"><?php echo esc_attr($GLOBALS['Remove_Service']); ?> [-] </a>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 add-service">
				<a href="javascript:void(0);" onclick="add_service(this)" class="add-service add-remove-service"><?php echo esc_attr($GLOBALS['Add_Service']); ?> [+] </a>
			</div>
		</div>
		<?php
		$html = ob_get_clean();
		return $html;
	}//end add_remove_service()
}//end if !function_exists('add_remove_service')
if ( ! function_exists( 'service_item' ) ) {
	function service_item( $item ) {
		/*
		$item=array(
			'cat_id'=>0,
			'service_id'=>0,
			'title'=>'Item Name',
			'id'=>'service_name',
		);
		*/
		ob_start();
		extract( $item );
		$name    = "category[{$cat_id}][{$service_id}][{$id}]";
		$html_id = "category_{$cat_id}_{$service_id}_{$id}";
		//$title=remove_slash_quotes($title);
    $value = df_spl_remove_slash_quotes( $value );
		?> 
		<?php
		$image_name = basename($value);
		?> 
		<div class="df-spl-row service-price-length 
		<?php
		if ( $id == 'service_regular_price' || $id == 'service_image' ) {
			echo 'spl_service_image_element'; }
		?>
		">
			<div class="col-xs-6 col-sm-5 col-md-5 col-lg-5 lbl">
				<label for="<?php echo esc_attr($html_id); ?>"><?php echo esc_attr($title); ?></label>
			</div>
			<div class="col-xs-6 col-sm-7 col-md-7 col-lg-7">
				<?php if ( $id == 'service_button' ) { ?>
					<div class="col-md-2 col-xs-4 padding_zero_spl">
						<div class="custom-control custom-checkbox <?php echo intval($id); ?>">
						   <?php if ( $value != '' ) { ?>
							  <input type="checkbox" data-id="<?php echo esc_attr("category_{$cat_id}_{$service_id}"); ?>" name="<?php echo esc_attr("category[{$cat_id}][{$service_id}][service_button_enable]"); ?>" class="custom-control-input spl_service_button_enable" checked="checked">
						  <?php } else { ?>
							<input type="checkbox" data-id="<?php echo esc_attr("category_{$cat_id}_{$service_id}"); ?>" name="<?php echo esc_attr("category[{$cat_id}][{$service_id}][service_button_enable]"); ?>" class="custom-control-input spl_service_button_enable">
						<?php } ?>
					</div>
				</div>
				<div class="col-md-10 col-xs-8 padding_zero_spl">
					<input type="text" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($html_id); ?>" class="form-control <?php echo esc_attr($id) . " " . esc_attr($html_id); ?>" value="<?php echo esc_attr($value); ?>" placeholder="Button Title" title="">
				</div>
			<?php } elseif ( $id == 'service_button_url' ) { ?>
				<input type="text" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($html_id); ?>" class="form-control <?php echo esc_attr($id); ?> <?php echo esc_attr("category_{$cat_id}_{$service_id}_service_button_url"); ?>" value="<?php echo esc_attr($value); ?>" title="">
			<?php } elseif ( $id == 'service_image' ) { ?>
				<img src="<?php echo empty( $value ) ? SPL_DEFAULT_THUMBNAIL : $value; ?>" width="45px;" height="45px;" />
				<?php if (!empty($image_name)) : ?>
			<div class="spl-container-test" >
				<div class="spl-container-icon" ><?php echo $image_name; ?>
					<i  class='delete-icon'>
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#dae2e1" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
					</i>
				</div>
			</div>
			<input style="display:none;" type="file" name="<?php echo esc_attr($name); ?>" class="form-control <?php echo esc_attr($id); ?> spl-include-close" value="<?php echo esc_attr($value); ?>" title="" id="<?php echo esc_attr($html_id); ?>">
			<input style="display:none;" type="hidden" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($html_id); ?>" class="form-control <?php echo esc_attr($id); ?>" value="<?php echo esc_attr($value); ?>" title="">
		<?php else : ?>
			<input type="file" name="<?php echo esc_attr($name); ?>" class="form-control <?php echo esc_attr($id); ?>" value="<?php echo esc_attr($value); ?>" title="" id="<?php echo esc_attr($html_id); ?>">
			<input type="hidden" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($html_id); ?>" class="form-control <?php echo esc_attr($id); ?>" value="<?php echo esc_attr($value); ?>" title="">
		<?php endif; ?>
		<?php } elseif ( $id == 'service_long_description' ) { ?>
				<textarea name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($html_id); ?>" class="form-control <?php echo esc_attr($id); ?>" rows="5" cols="33"><?php echo esc_attr($value); ?></textarea>
			<?php } else { ?>
				<input type="text" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($html_id); ?>" class="form-control <?php echo esc_attr($id); ?>" value="<?php echo esc_attr($value); ?>" title="">
			<?php } ?>
		</div>
		</div>  <?php echo '<!-- ' . $title . ' -->'; ?>
		<?php
		$html = ob_get_clean();
		return $html;
	}//end service_item()
}//end if !function_exists('service_item')
if ( ! function_exists( 'category_name_row' ) ) {
	function category_name_row( $cat_id, $cat_name = '', $cat_description = '', $cat_cover_image = '', $cat_background_color = '', $cat_text_color = '', $cat_action_text = '', $cat_action_link = '', $cat_price = '' ) {
		// check if $cat_cover_image is a valid URL, if not set it to null
		?>
		<?php
		$image_name = basename($cat_cover_image);
		?> 
		<?php
		if ( ! filter_var( $cat_cover_image, FILTER_VALIDATE_URL ) ) {
			$cat_cover_image = null;
		}
		$cat_name = df_spl_remove_slash_quotes( $cat_name );

		ob_start();
		?>
		<div class="categor-sec-first" style="background: none;">
			<div class="heading-catag">
				<div class="title"><?php echo esc_attr($GLOBALS['CATEGORY']); ?></div>
				<div class="action-btn">
				<i class="far fa-trash-alt remove-category spl-custom-color"></i>
				<i class="fas fa-arrows-alt spl-custom-color"></i>
				</div>
			</div>
			<div class="spl-container-col-2">
				<div class="df-spl-row category-name-row">
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 lbl">
						<label for="category_<?php echo esc_attr($cat_id); ?>_name"><?php echo esc_attr($GLOBALS['Category_Name']); ?></label>
					</div>
					<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 ini ">
						<input type="text" name="category[<?php echo esc_attr($cat_id); ?>][name]" id="category_<?php echo esc_attr($cat_id); ?>_name" class="form-control category_name" value="<?php echo esc_attr($cat_name); ?>">
					</div>
				</div> <!-- Category Name -->
				<!--Category Description-->
				<div class="df-spl-row category-description-row">
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 lbl">
						<label for="category_<?php echo esc_attr($cat_id); ?>_description"><?php echo esc_attr($GLOBALS['Category_Description']); ?></label>
					</div>
					<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 ini">
						<textarea name="category[<?php echo esc_attr($cat_id); ?>][description]" id="category_<?php echo esc_attr($cat_id); ?>_description" class="form-control category_description" rows="2" cols="50"><?php echo df_spl_remove_slash_quotes( $cat_description ); ?></textarea>
					</div>
				</div>
				<!--End Category Description-->

				<!--Category Background Color-->
				<div class="df-spl-row category-background-color-row spl-pricing-table-row df-spl-d-none">
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 lbl">
						<label for="category_<?php echo esc_attr($cat_id); ?>_background_color"><?php echo esc_attr($GLOBALS['Category_Background_Color']); ?></label>
					</div>
					<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 ini">
						<?php 
						echo df_spl_color_out(
							"category[" . esc_attr($cat_id) . "][background_color]", 
							df_spl_remove_slash_quotes($cat_background_color),
							''
						); 
						?>
					</div>
				</div>
				<!--End Category Color-->

				<!--Category Text Color-->
				<div class="df-spl-row category-text-color-row spl-pricing-table-row df-spl-d-none">
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 lbl">
						<label for="category_<?php echo esc_attr($cat_id); ?>_color"><?php echo esc_attr($GLOBALS['Category_Text_Color']); ?></label>
					</div>
					<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 ini">
						<?php 
						echo df_spl_color_out(
							"category[" . esc_attr($cat_id) . "][text_color]", 
							df_spl_remove_slash_quotes($cat_text_color),
							''
						); 
						?>
					</div>
				</div>
				<!--End Category Text Color-->

				<!--Category Action Text-->
				<div class="df-spl-row category-action-text-row spl-pricing-table-row df-spl-d-none">
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 lbl">
						<label for="category_<?php echo esc_attr($cat_id); ?>_action_text"><?php echo esc_attr($GLOBALS['Category_Action_Text']); ?></label>
					</div>
					<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 ini">
						<input type="text" name="category[<?php echo esc_attr($cat_id); ?>][action_text]" id="category_<?php echo esc_attr($cat_id); ?>_action_text" class="form-control category_action_text" value="<?php echo esc_attr($cat_action_text); ?>">
					</div>
				</div>

				<!--End Category Action Text-->
				<!--Category Action Link-->
				<div class="df-spl-row category-action-link-row spl-pricing-table-row df-spl-d-none">
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 lbl">
						<label for="category_<?php echo esc_attr($cat_id); ?>_action_link"><?php echo esc_attr($GLOBALS['Category_Action_Link']); ?></label>
					</div>
					<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 ini">
						<input type="text" name="category[<?php echo esc_attr($cat_id); ?>][action_link]" id="category_<?php echo esc_attr($cat_id); ?>_action_link" class="form-control category_action_link" value="<?php echo esc_attr($cat_action_link); ?>" >
					</div>
				</div>
				<!--End Category Action Link-->
				<!--Category Price-->
				<div class="df-spl-row category-price-row spl-pricing-table-row df-spl-d-none">
					<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 lbl">
						<label for="category_<?php echo esc_attr($cat_id); ?>_price"><?php echo esc_attr($GLOBALS['Category_Price']); ?></label>
					</div>
					<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 ini">
						<input type="text" name="category[<?php echo esc_attr($cat_id); ?>][price]" id="category_<?php echo esc_attr($cat_id); ?>_price" class="form-control category_price" value="<?php echo esc_attr($cat_price); ?>" placeholder="E.g: $50">
					</div>
				</div>
				<!--End Category Price-->
			</div>
			
			


		<!--Category Cover Image-->
		<div class="df-spl-row category-cover-image-row">
			<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 lbl">
				<label for="category_<?php echo esc_attr($cat_id); ?>_cover-image"><?php echo esc_attr($GLOBALS['Category_Image']); ?></label>
				<i class="fa fa-info-circle" title="Set an image with wider aspect ratio. For example 16:9, 16:10"></i>
			</div>
			<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 category-image-wrapper ini" title="Please chose an image with a wider aspect ratio. Save and observe if the image has fit into the category background.">
				<img src="<?php echo empty( $cat_cover_image ) ? SPL_DEFAULT_THUMBNAIL : $cat_cover_image; ?>" width="45px;" height="45px;" />
		<?php if (!empty($image_name)) : ?>
			<input style="display:none;" type="file"  id="spl-file-input"  name="category[<?php echo esc_attr($cat_id); ?>][cover-image]" class="file-input  form-control category_image" value="<?php echo esc_attr($cat_cover_image); ?>" title="" id="category_<?php echo esc_attr($cat_id); ?>_cover-image">
			<input style="display:none;" type="hidden" name="category[<?php echo esc_attr($cat_id); ?>][cover-image]" id="category_<?php echo esc_attr($cat_id); ?>_cover-image" class="form-control category_image" value="<?php echo esc_attr($cat_cover_image); ?>" title="">
			<div class="spl-container">
				<div class="spl-container-icon"><?php echo $image_name; ?> 
					<i class="spl-icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#dae2e1" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"></path></svg>
					</i>
				</div>
			</div>
		<?php else : ?>
			<input type="file"  name="category[<?php echo esc_attr($cat_id); ?>][cover-image]" class="form-control category_image" value="<?php echo esc_attr($cat_cover_image); ?>" title="" id="category_<?php echo esc_attr($cat_id); ?>_cover-image">
			<input type="hidden" name="category[<?php echo esc_attr($cat_id); ?>][cover-image]" id="category_<?php echo esc_attr($cat_id); ?>_cover-image" class="form-control category_image" value="<?php echo esc_attr($cat_cover_image); ?>" title=""> 
		<?php endif; ?>
			</div>
		</div>
		<!--End Category Cover Image-->

	</div>
		<?php
		$html = ob_get_clean();
		return $html;
	}//end category_name_row()
}//end if !function_exists('category_name_row')
if ( ! function_exists( 'category_row' ) ) {
	function category_row( $cat_id, $cat = null, $max_service_count = 3 ) {
		//echo esc_attr($cat_id);
		ob_start();
		$cat_name = '';
		if ( ! is_null( $cat ) ) {
			$cat_name = $cat['name'];
			unset( $cat['name'] );//remove the name items, so, we can use foreach to process
		}
		$cat_description = '';
		$cat_cover_image = '';
		$cat_background_color = '';
		$cat_text_color = '';
		$cat_action_text = '';
		$cat_action_link = '';
		if ( ! is_null( $cat ) ) {
			//$cat_description=$cat['description'];
			$cat_description = isset( $cat['description'] ) ? $cat['description'] : '';
			$cat_cover_image = isset( $cat['cover-image'] ) ? $cat['cover-image'] : '';
			unset( $cat['description'] );//remove the name items, so, we can use foreach to process
			unset( $cat['cover-image'] );//remove the cover image, so, we can use foreach to process

			$cat_background_color = isset( $cat['background_color'] ) ? $cat['background_color'] : '#ADADAC';
			$cat_text_color = isset( $cat['text_color'] ) ? $cat['text_color'] : '#ffffff';
			$cat_action_text = isset( $cat['action_text'] ) ? $cat['action_text'] : '';
			$cat_action_link = isset( $cat['action_link'] ) ? $cat['action_link'] : '';
			$cat_price = isset( $cat['price'] ) ? $cat['price'] : '';
			unset( $cat['background_color'] );//remove the color items, so, we can use foreach to process
			unset( $cat['text_color'] );//remove the text color items, so, we can use foreach to process
			unset( $cat['action_text'] );//remove the action text items, so, we can use foreach to process
			unset( $cat['action_link'] );//remove the action link items, so, we can use foreach to process
			unset( $cat['price'] );//remove the price items, so, we can use foreach to process
		}
		?>
		<div id="sortable" class="df-spl-row category-row ui-widget-content" style="margin:0;padding:0;margin-top:20px">
			<?php echo category_name_row( $cat_id, $cat_name, $cat_description, $cat_cover_image, $cat_background_color, $cat_text_color, $cat_action_text, $cat_action_link, $cat_price ); ?>
				<div class="spl-separator">
					<div class="spl-separator-background">

					</div>
				</div>
			<div class="service-container">
				<?php
				foreach ( $cat as $service_id => $service ) : 
					$service_image = isset($service['service_image']) ? $service['service_image'] : '';
					$settings_compare_at = isset($service['settings_compare_at']) ? $service['settings_compare_at'] : '';
					$service_button_enable = isset($service['settings_button_text_checkbox']) ? 'checked' : '';
					$service_button = isset($service['service_button']) ? $service['service_button'] : '';
					$service_button_url = isset($service['service_button_url']) ? $service['service_button_url'] : '';
					$settings_tooltip_title = isset($service['settings_tooltip_title']) ? $service['settings_tooltip_title'] : '';
					$settings_tooltip_description = isset($service['settings_tooltip_description']) ? $service['settings_tooltip_description'] : '';
					$settings_tooltip_image = isset($service['settings_tooltip_image']) ? $service['settings_tooltip_image'] : '';
					$is_popular = isset($service['is_popular']) ? $service['is_popular'] : '';
					$popular_text = isset($service['popular_text']) ? $service['popular_text'] : '';

				?>
					<!-- echo category_row($cat_id,$service_id,$cat_name); -->
					<div class="service">
						<div class="service-price-length-rows-wrapper">
							<div class="spl_ser_sec_ico">
							<i class="far fa-copy spl-custom-color " onclick="copy_service(this)" aria-hidden="true" ></i>
							<i class="fas fa-arrows-alt spl-custom-color " aria-hidden="true"></i>
							<div><i class="far fa-trash-alt spl-custom-color " onclick="remove_service(this)" aria-hidden="true"></i></div>

							</div>
							<?php echo service_items_html( $cat_id, $service_id, $service ); ?>
							<div class="toggle-advanced-options">
								<i id="spl-icon" class="fas fa-chevron-circle-down"></i>
								<h3 class="text-icon-spl">More Settings</h3>
							</div>
						</div> <!-- service-price-length-rows-wrapper -->
						<div class="service-advance-settings">
							<div class="spl_service_image_element df-spl-row service-price-length">
								<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3 lbl">
									<label for="category_<?php echo $cat_id . "_" . $service_id; ?>_service_image">Image</label>
								</div>
								<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 spl_service_image_element">
									<img class="preview" src="<?php echo empty( $service_image ) ? SPL_DEFAULT_THUMBNAIL : $service_image; ?>" width="45px;" height="45px;" />
								</div>
								<div class="col-xs-6 col-sm-7 col-md-7 col-lg-7 stylish-upload-btn">
									<input type="file" id="category_<?php echo $cat_id . "_" . $service_id; ?>_service_image" class="form-control service_image">
									<input type="hidden" name="category[<?php echo $cat_id . "][" . $service_id; ?>][service_image]" value="<?php echo esc_attr($service_image); ?>">
									<div class='upload-btn'><i class="fas fa-cloud-upload-alt"></i> Click  to upload</div>
									<?php if ( ! empty( $service_image ) ) { ?>
									<div class="spl-container-test" >
										<div class="spl-container-icon" ><?php echo esc_attr( basename( $service_image ) ); ?>
											<i  class='delete-icon'>
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#dae2e1" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
											</i>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
							<div class="spl-one-bottom"></div>
							<div class="df-spl-row service-price-length">
								<div class="col-xs-6 col-sm-5 col-md-5 col-lg-5 lbl">
									<label data-tooltip-image-key="compare-at" for="category_<?php echo $cat_id . "_" . $service_id; ?>_settings_compare_at">Compare at</label>
								</div>
								<div class="col-xs-6 col-sm-7 col-md-7 col-lg-7">
									<div class="d-flex align-items-center justify-content-between gap-10">
										<input type="text" value="<?php echo $settings_compare_at; ?>" class="form-control service-compare-at-price" placeholder="Set here comparison price" name="category[<?php echo $cat_id . "][" . $service_id; ?>][settings_compare_at]" id="category_<?php echo $cat_id . "_" . $service_id; ?>_settings_compare_at">
									</div>
								</div>
							</div>
							<div class="spl-one-bottom"></div>
							<div class="df-spl-row service-price-length">
								<div class="col-xs-6 col-sm-5 col-md-5 col-lg-5 lbl">
									<label data-tooltip-image-key="button" for="category_<?php echo $cat_id . "_" . $service_id; ?>_service_button">Button Text</label>
								</div>
								<div class="col-xs-6 col-sm-7 col-md-7 col-lg-7">
									<div class="d-flex align-items-center justify-content-between gap-10">
										<input type="text" class="form-control service_button" value="<?php echo $service_button; ?>" name="category[<?php echo $cat_id . "][" . $service_id; ?>][service_button]" id="category_<?php echo $cat_id . "_" . $service_id; ?>_service_button">
									</div>
								</div>
							</div>
							<div class="df-spl-row service-price-length">
								<div class="col-xs-6 col-sm-5 col-md-5 col-lg-5 lbl">
									<label data-tooltip-image-key="button" for="category_<?php echo $cat_id . "_" . $service_id; ?>_service_button_url">Button URL</label>
								</div>
								<div class="col-xs-6 col-sm-7 col-md-7 col-lg-7">
									<input type="text" class="form-control service_button_url" value="<?php echo $service_button_url; ?>" name="category[<?php echo $cat_id . "][" . $service_id; ?>][service_button_url]" id="category_<?php echo $cat_id . "_" . $service_id; ?>_service_button_url">
								</div>
							</div>
							<div class="spl-one-bottom"></div>
							<div class="df-spl-row service-price-length field-container-set-as-popular">
								<div class="col-xs-6 col-sm-5 col-md-5 col-lg-5 lbl">
									<label for="category_<?php echo $cat_id . "_" . $service_id; ?>_is_popular">Set As Popular Item</label>
								</div>
								<div class="col-xs-6 col-sm-7 col-md-7 col-lg-7">
									<div class="custom_radio_btn">
										<input type="checkbox" class="form-control is_popular" name="category[<?php echo $cat_id . "][" . $service_id; ?>][is_popular]" id="category_<?php echo $cat_id . "_" . $service_id; ?>_is_popular" <?php echo isset($is_popular) && $is_popular ? 'checked' : ''; ?>>
										<label class="radio-inline"><span></span></label>
									</div>
								</div>
							</div>
							<div class="df-spl-row service-price-length field-container-set-as-popular">
								<div class="col-xs-6 col-sm-5 col-md-5 col-lg-5 lbl">
									<label for="category_<?php echo $cat_id . "_" . $service_id; ?>_popular_text">Popular Item Text</label>
								</div>
								<div class="col-xs-6 col-sm-7 col-md-7 col-lg-7">
									<input type="text" class="form-control popular_text" name="category[<?php echo $cat_id . "][" . $service_id; ?>][popular_text]" id="category_<?php echo $cat_id . "_" . $service_id; ?>_popular_text" value="<?php echo isset($popular_text) ? $popular_text : 'Popular'; ?>">
								</div>
							</div>
							<div class="spl-one-bottom"></div>
							<div class="df-spl-row service-price-length">
								<div class="col-sm-12 font-weight-bold">Tooltip option</div>
							</div>
							<div class="df-spl-row service-price-length">
								<div class="col-xs-6 col-sm-5 col-md-5 col-lg-5 lbl">
									<label data-tooltip-image-key="tooltip" for="category_<?php echo $cat_id . "_" . $service_id; ?>_settings_tooltip_title">Tooltip title</label>
								</div>
								<div class="col-xs-6 col-sm-7 col-md-7 col-lg-7">
									<input type="text" class="form-control service-tooltip-title" value="<?php echo $settings_tooltip_title; ?>" name="category[<?php echo $cat_id . "][" . $service_id; ?>][settings_tooltip_title]" id="category_<?php echo $cat_id . "_" . $service_id; ?>_settings_tooltip_title">
								</div>
							</div>
							<div class="df-spl-row service-price-length">
								<div class="col-xs-6 col-sm-5 col-md-5 col-lg-5 lbl">
									<label data-tooltip-image-key="tooltip" for="category_<?php echo $cat_id . "_" . $service_id; ?>_settings_tooltip_description">Tooltip Description</label>
								</div>
								<div class="col-xs-6 col-sm-7 col-md-7 col-lg-7">
									<input type="text" class="form-control service-tooltip-description" value="<?php echo $settings_tooltip_description; ?>" name="category[<?php echo $cat_id . "][" . $service_id; ?>][settings_tooltip_description]" id="category_<?php echo $cat_id . "_" . $service_id; ?>_settings_tooltip_description">
								</div>
							</div>
							<div class="df-spl-row service-price-length">
								<div class="col-xs-4 col-sm-3 col-md-3 col-lg-3 lbl">
									<label data-tooltip-image-key="image" for="category_<?php echo $cat_id . "_" . $service_id; ?>_settings_tooltip_image">Image</label>
								</div>
								<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
									<img class="preview service-tooltip-image" src="<?php echo empty( $settings_tooltip_image ) ? SPL_DEFAULT_THUMBNAIL : $settings_tooltip_image; ?>" width="45px;" height="45px;" />
								</div>
								<div class="col-xs-6 col-sm-7 col-md-7 col-lg-7 stylish-upload-btn">
									<input type="file" id="category_<?php echo $cat_id . "_" . $service_id; ?>_settings_tooltip_image" class="form-control service_image">
									<input class="form-control service-tooltip-image-url" type="hidden" name="category[<?php echo $cat_id . "][" . $service_id; ?>][settings_tooltip_image]" value="<?php echo esc_attr($settings_tooltip_image); ?>">
									<div class='upload-btn'><i class="fas fa-cloud-upload-alt"></i> Click  to upload</div>
									<?php if ( ! empty( $settings_tooltip_image ) ) { ?>
									<div class="spl-container-test" >
										<div class="spl-container-icon" ><?php echo esc_attr( basename( $settings_tooltip_image ) ); ?>
											<i  class='delete-icon'>
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#dae2e1" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
											</i>
										</div>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="action-button">
				<a href="javascript:void(0);" class="add-service-btn" onclick="add_service(this)">
					<i class="fas fa-plus-circle" style="margin-right: 2px;"></i>
					Add Service
				</a>
			</div>

		</div> <!-- category-row -->
		<?php
		$html = ob_get_clean();
		return $html;
	}//end category_row()
}//end if !function_exists('category_row')
?>
<?php 
// phpcs:ignore
if ( array_key_exists( 'error', $_GET ) ) : ?>
	<div class="notice notice-error"><p><?php 
	 // phpcs:ignore
	 esc_html_e( $_GET['error'], 'text_domain' ); ?></p></div>
<?php endif; ?>
<?php 
// phpcs:ignore
if ( array_key_exists( 'success', $_GET ) ) : ?>
	<div class="notice notice-success"><p><?php 
	// phpcs:ignore
	esc_html_e( $_GET['success'], 'text_domain' ); ?></p></div>
<?php endif; ?>
<div class="container-fluid spl-editing-page-header">
	<?php
	require_once dirname( __FILE__ ) . '/logo-header.php';
	?>
</div>
<?php
global $spl_googlefonts_var;
$google_fonts = $spl_googlefonts_var->$get_fonts_options();
?>
<style id='spl-hide-menubar' type='text/css'>
		#adminmenumain, #wpfooter {
			display: none !important
		}
		#wpcontent {
			margin-left: 0 !important;
		}
    </style>
<div class="body-inner price_wrapper" style="padding-right: 15px">
	<!---// INNER FORM IN ONE ROW --->
	<div class="form-save-and-restore">
		<form action="" id="main_form" method="POST" enctype="multipart/form-data" role="form">
			<div style="">
				<nav class="navbar navbar-secondary df-spl-edit-nav"> <!-- Start of Price List Title, Style, Save Button-->
					<div class="container-fluid">
						<div class="d-flex justify-content-between spl-header-wrapper-v2">
							<div class="spl-header-logo-editing-page">
		<div class="spl-container-header">
		<a href="https://stylishpricelist.com/" class="spl-header">
			<img src="<?php echo SPL_URL . '/assets/images/Stylish-Price-List-Logo-418x134.png'; ?>" class="img-responsive1" alt="Image" style="max-height: 40px;">
		</a>
		<?php
		$opt = get_option( 'spllk_opt' );
		if ( empty( $opt ) ) {
			?>
			<span class="spl_plug_ver">Demo</span>
			<?php
		}
		if ( ! empty( $opt ) ) {
			?>
			<span class="spl_plug_ver">Premium</span>
		<?php } ?>
		</div>
	</div>

							<div class="price-list-name-and-style-wrapper d-flex align-items-center">								
							<?php $list_name = df_spl_remove_slash_quotes( $list_name ); ?>
							<input type="text" name="list_name" id="list_name" class="form-control list_name" placeholder="<?php echo esc_attr($Price_List_Name); ?>" required="" value="<?php echo esc_attr($list_name); ?>" title="">
							<?php $list_type = isset($list_type) && (strpos($list_type, 'table') !== false) ? 'pricing_table' : 'price_list'; ?>
								<div class="col-md-8 mode-select">
									<select class="form-control sel1 spl-list-type-selector" name="list_type" style="max-width:140px !important;height:40px;">
										<option value="">Select List Type</option>
										<option class="form-control default_tab" value="price_list" <?php echo isset( $list_type ) && $list_type == 'price_list' ? 'selected' : ''; ?> >Price List</option>
										<option class="form-control default_tab" value="pricing_table" <?php echo isset( $list_type ) && $list_type == 'pricing_table' ? 'selected' : ''; ?>>Pricing Table</option>
									</select>
									<div class="select-right-icon">
										<span class="df-spl-eui-FormControlLayoutCustomIcon">
											<img src="<?php echo SPL_URL . '/assets/images/cicle-icon.svg'; ?>" aria-hidden="true">
										</span>
									</div>
								</div>
								<div class="col-md-8 pl-0">
									<select class="form-control sel1" name="tab_style" style="max-width:100% !important;height:40px;">
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
									<div class="select-right-icon">
										<span class="df-spl-eui-FormControlLayoutCustomIcon">
											<img src="<?php echo SPL_URL . '/assets/images/cicle-icon.svg'; ?>" aria-hidden="true">
										</span>
									</div>
							  </div>
							</div>
						<ul class="settings-actions-wrapper d-flex align-items-center">
						<li style="margin-right:10px;">
							<a name="add_to_webpage" value="" class="add_to_webpage" data-tooltip="<?php echo esc_attr($ADD_TO_WEBPAGE); ?>">
								<img class="w-690" src="<?php echo SPL_URL . '/assets/images/Group.svg'; ?>" aria-hidden="true">
							</a>
						</li>
					<li style="margin-right:10px;">
						<a name="load_template" value="" class="advance_setting" data-tooltip="<?php echo esc_attr($More_Settings); ?>">
						<img class="w-690" src="<?php echo SPL_URL . '/assets/images/icon.svg'; ?>" aria-hidden="true" >
					</a>
					</li>
					<li style="margin-right:10px;">
						<a name="font_settitng" value="" class="font_settitng" data-tooltip="<?php echo esc_attr($FONT_SETTINGS); ?>">
						<img class="w-690" src="<?php echo SPL_URL . '/assets/images/ri_font-size-2.svg'; ?>" aria-hidden="true">
						</a>
				  </li>
							<li style="margin-right:10px;"><span class="main-save spl_btn_primary" >
								<p class="submit">
									<span class="btn btn-primary" onclick="javascript:splHandleFormSubmit(this)">Save</span>
								</p>
						   </span></li>
						   <li>
							<!-- A vertical line -->
							<div class="vertical-line"></div>
						   </li>
						   <li style="margin-right:10px;">
						   		<button class="btn-close" onclick="javascript:historyGoBack(this)">
									<i class="fas fa-chevron-left"></i>
								</button>
						   </li>
					   </ul>
					   </button>
				   </div>
			   </div>
		   </nav><!--End of Nav 2 --- Price List Title, Style, Save Button-->
		   <div id="style5_category_container" style="display:none">
			<div class="form-group" style="padding: 10px;border-radius: 5px;">
				<label for="exampleInputEmail1" style="padding-bottom:10px;">Nav-Bar Style  | Category Tabs</label>
				<select class="form-control" id="style5_category" name="style5_category" style="max-width:200px!important;margin-top:5px">
					<option class="form-control default_tab" value="style5_category_1" <?php echo isset( $style5_category ) && $style5_category == 'style5_category_1' ? 'selected' : ''; ?> >Style 1 | Right Side</option>
					<option class="form-control default_tab" value="style5_category_2" <?php echo isset( $style5_category ) && $style5_category == 'style5_category_2' ? 'selected' : ''; ?> >Style 2 | Thicker</option>
				</select>
			</div>
		</div>
		<!--Section for Change Style -->
		<!-- End Section for Change Style-->
		<div class="show_hide_shortcode clearfix" style="display:none;">
		  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding: 30px;border-radius: 10px;">
			  <div style="font-size:30px;font-weight:400">Shortcode</div>
			  <div style="font-size:20px;padding-top:15px;"><b>[pricelist id="<?php  esc_html_e( $id, 'text_domain' ); ?>"]</b></div><br><br>
			  <span style=""><a href="https://designful.freshdesk.com/en/support/solutions/articles/48001081305-important-adding-the-price-list-to-your-web-page-shortcode-" target="_blank">Important tutorial for adding the shortcode</a></span>
		  </div>
	  </div>
<div id="more-settings-wrapper">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 cats-row more_setting" style="background-color:#f8faf9;padding:20px;border-radius:5px;margin-top:10px;"><!-- START of Left Price List Settings-->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><!-- START of Dashboard Settings Category-->
		<div class="df-spl-pl-settings-title">Dashboard Settings</div>
		<hr class="df-spl-pl-settings-hr">
		<div class="df-spl-row cats-row more_setting" style="clear:both;"><!-- Add Select Language-->
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
				<label for="select_lang"><?php echo esc_attr($Select_Language); ?></label>
				<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image"  title="Choose a language for this dashboard"/>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 no-pa mw-400">
				<select class="form-control" id="select_lang" name="select_lang">
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
			<div class="select-right-icon">
				<span class="df-spl-eui-FormControlLayoutCustomIcon">
					<img src="<?php echo SPL_URL . '/assets/images/cicle-icon.svg'; ?>" aria-hidden="true">
				</span>
			</div>
		</div>
	</div><!--End Select language-->
</div><!-- End of Dashboard Settings Category-->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><!-- START of Columns Settings Category-->
	<div class="df-spl-pl-settings-title">Columns Settings</div>
	<hr class="df-spl-pl-settings-hr">
	<!-- START Select Column Count -->
	<div class="df-spl-row cats-row more_setting">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
			<label for="select_lang"><?php echo esc_attr($Select_Column); ?></label>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title='Set the number of columns'/>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/one-two-columns.png'); ?>"/>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 no-pa mw-400">
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
			<div class="select-right-icon">
				<span class="df-spl-eui-FormControlLayoutCustomIcon">
					<img src="<?php echo SPL_URL . '/assets/images/cicle-icon.svg'; ?>" aria-hidden="true">
				</span>
			</div>
		</div>
	</div>
	<!-- End Select Column Count -->
	<!-- START Max Width Box -->
	<div class="df-spl-row cats-row more_setting">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
			<label for="select_lang"><?php echo esc_attr($Max_Width); ?></label>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title='Set the maximum width of the price-list container'/>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 no-pa mw-400">
			<input type="text" name="spl_container_max_width" placeholder="Example : 1200px" value="<?php echo isset( $cats_data['spl_container_max_width'] ) ? $cats_data['spl_container_max_width'] : ''; ?>" id="spl_container_max_width" class="form-control spl_container_max_width" />
		</div>
	</div>
	<!-- END Max Width Box -->
</div><!-- START of Columns Settings Category-->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><!-- START of Category (Tab) Settings Category-->
	<div class="df-spl-pl-settings-title">Category (Tab) Settings</div>
	<hr class="df-spl-pl-settings-hr">
	<!--Change All Tab name-->
	<div class="df-spl-row cats-row more_setting">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
			<label for="all_tab"><?php echo esc_attr($Change_All_word_for_Categories); ?> <span class="all_tab_span">(<?php echo esc_attr($different_languages); ?>)</span></label>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title='Choose the word to show on the tab named "All"''/>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/all-wording.png'); ?>"/>
		</div>
		<?php
		$all_tab = isset( $cats_data['all_tab'] ) ? $cats_data['all_tab'] : '';
		if ( $all_tab != '' && isset( $all_tab ) ) {
			$all_tab = $all_tab;
		} else {
			$all_tab = 'All';}
		?>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 no-pa mw-400">
			<input type="text" name="all_tab" id="all_tab" class="form-control all_tab" value="<?php echo esc_attr($all_tab); ?>" title="">
		</div>
	</div>
	<!--End Change All Tab name-->
	<!-- Start of Change DEFAULT Tab name-->
	<div class="df-spl-row more_setting">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
			<label for="default_tab"><?php echo esc_attr($Default_Tab); ?></label>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="You can setup the default selected tab of the price-list here" />
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 no-pa mw-400">
			<select style="max-width:400px" class="form-control sel1" name="default_tab">
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
			 <div class="select-right-icon">
				<span class="df-spl-eui-FormControlLayoutCustomIcon">
					<img src="<?php echo SPL_URL . '/assets/images/cicle-icon.svg'; ?>" aria-hidden="true">
				</span>
			</div>
		 </div>
	 </div>
	 <!-- END of Change DEFAULT Tab name-->
	 <!--Start Hide All Tab-->
	 <div class="df-spl-row cats-row more_setting">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
			<label for="default_tab"><?php echo esc_attr($Display_the_All_word); ?> <span class="all_tab_span" style="color:red"></span></label>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title='Choose if the category tab called "All" should be shown/hidden.'/>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/remove-all-tab.png'); ?>"/>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
		  <?php
			$toggle_all_tab = isset( $cats_data['toggle_all_tab'] ) ? $cats_data['toggle_all_tab'] : '';
			$checked        = 'checked';
			$unchecked      = '';
			?>
		  <div class="custom_radio_btn"><input type="radio" name="toggle_all_tab" class="toggle_all_tab" required="" value="0" 
		  <?php
			if ( $toggle_all_tab == 0 ) {
				echo esc_attr($checked);
			} else {
				echo esc_attr($unchecked); }
			?>
			>Off<label class="radio-inline"><span></span></label></div>
		  <div class="custom_radio_btn"><input type="radio" name="toggle_all_tab" class="toggle_all_tab" required="" value="1" 
		  <?php
			if ( $toggle_all_tab == 1 || $toggle_all_tab == '' ) {
				echo esc_attr($checked);
			} else {
				echo esc_attr($unchecked); }
			?>
			>On<label class="radio-inline"><span></span></label></div>
	  </div>
  </div>
	 <div class="df-spl-row cats-row more_setting">
	 	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
			<label><?php echo esc_attr($Style4_Divider_Style); ?> <span class="all_tab_span" style="color:red"></span></label>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 no-pa mw-400">
		  <?php
			$style4_divider_style = isset( $cats_data['style4_divider_style'] ) ? $cats_data['style4_divider_style'] : 0;
			?>
			<select style="max-width:400px" class="form-control" name="style4_divider_style">
				<option style="max-width:400px;" class="form-control default_tab" <?php echo selected( $style4_divider_style, '0' )  ?> value="0">Line Divider</option>
				<option style="max-width:400px;" class="form-control default_tab" <?php echo selected( $style4_divider_style, '1' )  ?> value="1">Dotted Divider</option>
			</select>
			<div class="select-right-icon">
				<span class="df-spl-eui-FormControlLayoutCustomIcon">
					<img src="<?php echo SPL_URL . '/assets/images/cicle-icon.svg'; ?>" aria-hidden="true">
				</span>
			</div>
		</div>
  </div>

<!-- Start of Style 10 Cover Image settings -->
<div class="df-spl-row cats-row more_setting">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
	<label><?php echo esc_attr( $Category_Desc_Embed_To_Cover_Image_S10 ); ?> <span class="all_tab_span" style="color:red"></span></label>
	<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Enable scrolling into view of the price list while switching between categories"/>

	</div>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	  <?php
		$category_desc_embed_to_cover_image_s10 = isset( $cats_data['category_desc_embed_to_cover_image_s10'] ) ? $cats_data['category_desc_embed_to_cover_image_s10'] : 1;
		if ( get_current_screen()->base == 'stylish-price-list_page_spl-tabs-new' ) {
			$category_desc_embed_to_cover_image_s10 = 1;
		}
		$checked       = 'checked';
		$unchecked     = '';
		?>
	  <div class="custom_radio_btn"><input type="radio" name="category_desc_embed_to_cover_image_s10" required="" value="0" 
	  <?php
		if ( $category_desc_embed_to_cover_image_s10 == 0 || $category_desc_embed_to_cover_image_s10 == '' ) {
			echo esc_attr($checked);}
		?>
		 >Off<label class="radio-inline"><span></span></label></div>
	  <div class="custom_radio_btn"><input type="radio" name="category_desc_embed_to_cover_image_s10" required="" value="1" 
	  <?php
		if ( $category_desc_embed_to_cover_image_s10 == 1 ) {
			echo esc_attr($checked); }
		?>
		 >On<label class="radio-inline"><span></span></label></div>
  </div>
</div>
	 <!-- End of Style 10 Cover Image settings -->
  <div data-dependency-settings="category_desc_embed_to_cover_image_s10" class="df-spl-row cats-row more_setting <?php echo $category_desc_embed_to_cover_image_s10 ? '' : 'd-none' ?>">
	 	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
			<label><?php echo esc_attr($Category_Image_Overlay_Percent); ?> <span class="all_tab_span" style="color:red"></span></label>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 no-pa mw-400">
		  <?php
			$category_image_overlay_percent = isset( $cats_data['category_image_overlay_percent'] ) ? $cats_data['category_image_overlay_percent'] : 31;
			?>
			<input style="max-width:400px;" type="number" name="category_image_overlay_percent" placeholder="%" value=<?php echo intval( $category_image_overlay_percent ) ?> class="form-control">
		</div>
			</div>
  <!--End Hide All Tab-->
  <!-- Start of Stylish Category Tab Button-->
  <div class="df-spl-row cats-row more_setting">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
		<label for="category_tab_button"><?php echo esc_attr($Stylish_Category_Tabs_Buttons); ?><span class="category_tab_button" style="color:red"></span></label>
		<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Adds more style to Style 1 category tabs"/>
		<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/styled-category.png'); ?>"/>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 no-pa">
	  <?php
		$style_cat_tab_btn = isset( $cats_data['style_cat_tab_btn'] ) ? $cats_data['style_cat_tab_btn'] : '';
		$checked           = 'checked';
		$unchecked         = '';
		?>
	  <div class="custom_radio_btn"><input type="radio" name="style_cat_tab_btn" class="style_cat_tab_btn" required="" value="0" 
	  <?php
		if ( $style_cat_tab_btn == 0 || $toggle_all_tab == '' ) {
			echo esc_attr($checked);
		} else {
			echo esc_attr($unchecked); }
		?>
		>Off<label class="radio-inline"><span></span></label></div>
	  <div class="custom_radio_btn"><input type="radio" name="style_cat_tab_btn" class="style_cat_tab_btn" required="" value="1" 
	  <?php
		if ( $style_cat_tab_btn == 1 ) {
			echo esc_attr($checked);
		} else {
			echo esc_attr($unchecked); }
		?>
		>On<label class="radio-inline"><span></span></label></div>
  </div>
</div>
<!--End of Stylish Category Tab Button-->
<!--Start of Category Separator setting-->
<div class="df-spl-row cats-row more_setting">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
		<label for="default_tab"><?php echo esc_attr($Category_Separator_Symbol); ?><span class="category_separator_symbol" style="color:red"></span></label>
		<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Choose if you want to show a separator between the categories. Only available in Style 1"/>
		<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/category-separator.png'); ?>"/>

	</div>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	  <?php
		$toggle    = isset( $cats_data['toggle'] ) ? $cats_data['toggle'] : '';
		$checked   = 'checked';
		$unchecked = '';
		?>
	  <div class="custom_radio_btn"><input type="radio" name="toggle" class="toggle" required="" value="0" 
	  <?php
		if ( $toggle == '0' || $toggle == '' ) {
			echo esc_attr($checked);}
		?>
		 >Off<label class="radio-inline"><span></span></label></div>
	  <div class="custom_radio_btn"><input type="radio" name="toggle" class="toggle" required="" value="1" 
	  <?php
		if ( $toggle == '1' ) {
			echo esc_attr($checked); }
		?>
		 >On<label class="radio-inline"><span></span></label></div>
  </div>
</div>
<!--End of Category Separator setting-->
<!-- Start of category in a dropdown choice settings -->
<div class="df-spl-row cats-row more_setting">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
		<label for="default_tab"><?php echo esc_attr($Arrange_Categories_In_Dropdown); ?><span class="category_separator_symbol" style="color:red"></span></label>
		<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Choose if you want to have the catergories show up in a dropdown choice"/>
		<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/dropdown-categories.png'); ?>"/>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	  <?php
		$show_dropdown = isset( $cats_data['show_dropdown'] ) ? $cats_data['show_dropdown'] : '';
		$checked       = 'checked';
		$unchecked     = '';
		?>
	  <div class="custom_radio_btn"><input type="radio" name="show_dropdown" class="show_dropdown" required="" value="0" 
	  <?php
		if ( $show_dropdown == '0' || $show_dropdown == '' ) {
			echo esc_attr($checked);}
		?>
		 >Off<label class="radio-inline"><span></span></label></div>
	  <div class="custom_radio_btn"><input type="radio" name="show_dropdown" class="show_dropdown" required="" value="1" 
	  <?php
		if ( $show_dropdown == '1' ) {
			echo esc_attr($checked); }
		?>
		 >On<label class="radio-inline"><span></span></label></div>
  </div>
</div>
<!-- End of category in a dropdown choice settings -->
<!-- Start of category in a dropdown choice settings -->
<div class="df-spl-row cats-row more_setting">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
		<label for="default_tab"><?php echo esc_attr($Categories_In_Dropdown_Prevent_Keyboard_Popup); ?><span class="category_separator_symbol" style="color:red"></span></label>
		<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Choose if you want to have the catergories show up in a dropdown choice"/>
		<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/dropdown-categories.png'); ?>"/>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	  <?php
		$dropdown_mobile_no_keyboard = isset( $cats_data['dropdown_mobile_no_keyboard'] ) ? $cats_data['dropdown_mobile_no_keyboard'] : '';
		if ( get_current_screen()->base == 'stylish-price-list_page_spl-tabs-new' ) {
			$dropdown_mobile_no_keyboard = 1;
		}
		$checked       = 'checked';
		$unchecked     = '';
		?>
	  <div class="custom_radio_btn"><input type="radio" name="dropdown_mobile_no_keyboard" required="" value="0" 
	  <?php
		if ( $dropdown_mobile_no_keyboard == 0 || $dropdown_mobile_no_keyboard == '' ) {
			echo esc_attr($checked);}
		?>
		 >Off<label class="radio-inline"><span></span></label></div>
	  <div class="custom_radio_btn"><input type="radio" name="dropdown_mobile_no_keyboard" required="" value="1" 
	  <?php
		if ( $dropdown_mobile_no_keyboard == 1 ) {
			echo esc_attr($checked); }
		?>
		 >On<label class="radio-inline"><span></span></label></div>
  </div>
</div>
<!-- End of category in a dropdown choice settings -->
<!-- Start of category in a dropdown choice settings -->
<div class="df-spl-row cats-row more_setting">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
		<label for="default_tab"><?php echo esc_attr( $category_select_scroll_effect_label_text ); ?><span class="category_separator_symbol" style="color:red"></span></label>
		<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Enable scrolling into view of the price list while switching between categories"/>	
	</div>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	  <?php
		$category_select_scrolling = isset( $cats_data['category_select_scrolling'] ) ? $cats_data['category_select_scrolling'] : '';
		if ( get_current_screen()->base == 'stylish-price-list_page_spl-tabs-new' ) {
			$category_select_scrolling = 1;
		}
		$checked       = 'checked';
		$unchecked     = '';
		?>
	  <div class="custom_radio_btn"><input type="radio" name="category_select_scrolling" required="" value="0" 
	  <?php
		if ( $category_select_scrolling == 0 || $category_select_scrolling == '' ) {
			echo esc_attr($checked);}
		?>
		 >Off<label class="radio-inline"><span></span></label></div>
	  <div class="custom_radio_btn"><input type="radio" name="category_select_scrolling" required="" value="1" 
	  <?php
		if ( $category_select_scrolling == 1 ) {
			echo esc_attr($checked); }
		?>
		 >On<label class="radio-inline"><span></span></label></div>
  </div>
</div>
<!-- End of category in a dropdown choice settings -->
<!-- Start of category dropdown width settings -->
<div class="df-spl-row cats-row more_setting">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
		<label for="default_tab"><?php echo esc_attr($Category_Dropdown_Width); ?><span class="category_separator_symbol" style="color:red"></span></label>
		<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Choose if you want to have the catergories show up in a dropdown choice"/>
		<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/dropdown-categories.png'); ?>"/>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 no-pa mw-400">
		<input style="max-width:400px;" type="text" name="spl_cats_dropdown_width" placeholder="Example : 100%" value="<?php echo isset( $cats_data['spl_cats_dropdown_width'] ) ? $cats_data['spl_cats_dropdown_width'] : '300px'; ?>" id="spl_cats_dropdown_width" class="form-control spl_cats_dropdown_width" />
	</div>
</div>
<!-- End of category dropdown width settings -->
</div><!-- End of Category (Tab) Settings Category-->
</div><!-- END of Left Price List Settings-->
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 cats-row more_setting" style="background-color:#f8faf9;padding:20px;border-radius:5px;margin-top:10px;"><!-- START of Right Price List Settings-->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><!-- START of Title Settings Category-->
		<div class="df-spl-pl-settings-title">Title Settings</div>
		<hr class="df-spl-pl-settings-hr">
		<!--START remove title-->
		<div class="df-spl-row cats-row more_setting">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
				<label for="remove_title_tab"><?php echo esc_attr($Remove_title); ?> ? </label>
				<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Enabling this option makes the title at the top of the price-list go away."/>
				<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/title-switch.png'); ?>"/>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<?php
				$spl_remove_title = isset( $cats_data['spl_remove_title'] ) ? $cats_data['spl_remove_title'] : '';
				$checked          = 'checked';
				$unchecked        = '';
				?>
				<div class="custom_radio_btn"><input type="radio" name="spl_remove_title" class="spl_remove_title" required="" value="0" 
				<?php
				if ( empty( $spl_remove_title ) ) {
					echo esc_attr($checked);
				} else {
					echo esc_attr($unchecked); }
				?>
				 >Off<label class="radio-inline"><span></span></label></div>
				<div class="custom_radio_btn"><input type="radio" name="spl_remove_title" class="spl_remove_title" required="" value="1" 
				<?php
				if ( ! empty( $spl_remove_title ) ) {
					echo esc_attr($checked);
				} else {
					echo esc_attr($unchecked); }
				?>
				 >On<label class="radio-inline"><span></span></label></div>
			</div>
		</div><!--END remove title-->
		<!--Start Break Title of Item Name-->
		<div class="df-spl-row cats-row more_setting">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
				<label for="category_tab_button"><?php echo esc_attr($Break_title_of_Service); ?></label>
				<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Enabling this adds padding to the items under the 
				list category titles. It helps break the title from the items.
				Works on Style 4 only."/>
				<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/break-line.png'); ?>"/>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<?php
				$brack_title_desktop = isset( $cats_data['brack_title_desktop'] ) ? $cats_data['brack_title_desktop'] : '';
				$brack_title_tablets = isset( $cats_data['brack_title_tablets'] ) ? $cats_data['brack_title_tablets'] : '';
				if ( $brack_title_desktop != '' && $brack_title_desktop == 1 ) {
					$desktop_check = 'checked="checked"';
				} else {
					$desktop_check = '';
				}
				if ( $brack_title_tablets != '' && $brack_title_tablets == 1 ) {
					$tab_check = 'checked="checked"';
				} else {
					$tab_check = '';
				}
				?>
			   <div class="checkbox">
				  <input class="df-spl-d-none" name="brack_title_desktop" id="brack_title_desktop" type="checkbox" value="1" <?php echo esc_attr($desktop_check); ?> >
				  <label for="brack_title_desktop" class="radio-inline"><span></span></label><label for="brack_title_desktop"><?php echo esc_attr($Break_line_of_categories_on_Desktop); ?></label>
			  </div>
			  <div class="checkbox">
				  <input class="df-spl-d-none" name="brack_title_tablets" id="brack_title_tablets" type="checkbox" value="1" <?php echo esc_attr($tab_check); ?> >
				  <label for="brack_title_tablets" class="radio-inline"><span></span></label><label for="brack_title_tablets"><?php echo esc_attr($Break_line_of_categories_on_Tablets); ?></label>
			  </div>
		  </div>
	  </div>
	  <!--End of Break Title of Service-->
  </div><!-- End of Title Settings Category-->
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><!-- START of Buy Buttons Settings Category-->
	<div class="df-spl-pl-settings-title">Buy Button Settings</div>
	<hr class="df-spl-pl-settings-hr">
	<!--Open Buy now links in new tab-->
	<div class="df-spl-row cats-row more_setting">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
			<label for="category_tab_button"><?php echo esc_attr($Open_Buy_Btn_Link_In_New_Tab); ?><span class="category_tab_button" style="color:red"></span></label>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Enabling this option will make the links under the price open in a new tab."/>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
		  <?php
			$style_buy_btn_newtab = isset( $cats_data['style_buy_btn_newtab'] ) ? $cats_data['style_buy_btn_newtab'] : 0;
			$checked              = 'checked';
			$unchecked            = '';
			?>
		  <div class="custom_radio_btn"><input type="radio" name="style_buy_btn_newtab" class="style_buy_btn_newtab" required="" value="0" 
		  <?php
			if ( $style_buy_btn_newtab == 0 || $toggle_all_tab == '' ) {
				echo esc_attr($checked);
			} else {
				echo esc_attr($unchecked); }
			?>
			>Off<label class="radio-inline"><span></span></label></div>
		  <div class="custom_radio_btn"><input type="radio" name="style_buy_btn_newtab" class="style_buy_btn_newtab" required="" value="1" 
		  <?php
			if ( $style_buy_btn_newtab == 1 ) {
				echo esc_attr($checked);
			} else {
				echo esc_attr($unchecked); }
			?>
			>On<label class="radio-inline"><span></span></label></div>
	  </div>
  </div>
  <!--End Open Buy now links in new tab-->
</div><!-- End  of Buy Buttons Settings Category-->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><!-- START of Search & Filter Settings Category-->
	<div class="df-spl-pl-settings-title">Search & Filter Feature</div>
	<hr class="df-spl-pl-settings-hr">
	<!-- Start of Search & Filter Settings -->
	<div class="df-spl-row cats-row more_setting">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
			<label for="category_tab_button"><?php echo esc_attr($Add_Search_Bar); ?><span class="category_tab_button" style="color:red"></span></label>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Enabling it will add a search box at the to right side of the price-list."/>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/majesticons_eye-line.svg'; ?>" data-image-tooltip="<?php echo esc_url(SPL_URL . 'assets/images/tooltip-images/search-box.png'); ?>"/>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
		  <?php
			$enable_searchbar = isset( $cats_data['enable_searchbar'] ) ? $cats_data['enable_searchbar'] : '';
			$checked          = 'checked';
			$unchecked        = '';
			?>
		  <div class="custom_radio_btn"><input type="radio" name="enable_searchbar" class="enable_searchbar" required="" value="0" 
		  <?php
			if ( empty( $enable_searchbar ) ) {
				echo esc_attr($checked);
			} else {
				echo esc_attr($unchecked); }
			?>
			>Off<label class="radio-inline"><span></span></label></div>
		  <div class="custom_radio_btn"><input type="radio" name="enable_searchbar" class="enable_searchbar" required="" value="1" 
		  <?php
			if ( ! empty( $enable_searchbar ) ) {
				echo esc_attr($checked);
			} else {
				echo esc_attr($unchecked); }
			?>
			>On<label class="radio-inline"><span></span></label></div>
	  </div>
  </div>
  <!-- End of Search & Filter Settings -->
<!-- Start of Search & Filter Settings -->
<div class="df-spl-row cats-row more_setting">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
		<label for="category_tab_button"><?php echo esc_attr($price_range_slider); ?><span class="category_tab_button" style="color:red"></span></label>
		<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Enabling it will add a price range filter slider at the top of the price-list."/>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
		<?php
		$enable_price_range_slider = isset( $cats_data['enable_price_range_slider'] ) ? $cats_data['enable_price_range_slider'] : '';
		$checked                   = 'checked';
		$unchecked                 = '';
		?>
		<div class="custom_radio_btn"><input type="radio" name="enable_price_range_slider" class="enable_price_range_slider" required="" value="0" 
		<?php
		if ( empty( $enable_price_range_slider ) ) {
			echo esc_attr($checked);
		} else {
			echo esc_attr($unchecked); }
		?>
		>Off<label class="radio-inline"><span></span></label></div>
		<div class="custom_radio_btn"><input type="radio" name="enable_price_range_slider" class="enable_price_range_slider" required="" value="1" 
		<?php
		if ( ! empty( $enable_price_range_slider ) ) {
			echo esc_attr($checked);
		} else {
			echo esc_attr($unchecked); }
		?>
		>On<label class="radio-inline"><span></span></label></div>
	</div>
</div>
<!-- End of Search & Filter Settings -->
</div><!-- End of Search & Filter Settings Category-->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><!-- START of Misc Settings Category-->
	<div class="df-spl-pl-settings-title">Misc Settings</div>
	<hr class="df-spl-pl-settings-hr">
	<!--Add Textarea for price list description-->
	<div class="df-spl-row cats-row more_setting">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
			<label for="all_tab"><?php echo stripslashes( $Price_List_Description ); ?></label>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Define the price-list description here."/>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<textarea name="price_list_desc" id="price_list_desc" class="form-control price_list_desc" rows="2" cols="50">
			<?php
			if ( isset( $price_list_desc ) ) {
				echo str_replace( '\"', '"', str_replace( "\'", "'", stripslashes( $price_list_desc ) ) ); }
			?>
			</textarea>
		</div>
	</div><!--End of Add Textarea for price list description-->
	<div class="df-spl-row cats-row more_setting">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
			<label for="all_tab"><?php echo stripslashes( $items_price_currency ); ?></label>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 no-pa mw-400">
			<select class="form-control jsonld-currency" id="jsonld_currency" name="jsonld_currency">
				<?php foreach ( DF_SPL_CURRENCIES as $key => $value ) {
					?>
					<option style="max-width:400px;" class="form-control" <?php echo selected( $jsonld_currency , $value['code'] )  ?> value="<?php echo $value['code']; ?>"><?php echo $value['currency']; ?></option>
					<?php
				} ?>
			</select>
			<div class="select-right-icon">
				<span class="df-spl-eui-FormControlLayoutCustomIcon">
					<img src="<?php echo SPL_URL . '/assets/images/cicle-icon.svg'; ?>" aria-hidden="true">
				</span>
			</div>
		</div>
	</div>
	<div class="df-spl-row cats-row more_setting">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 lbl">
			<label for="category_tab_button"><?php echo esc_attr($enable_product_seo_schema); ?><span class="category_tab_button" style="color:red"></span></label>
			<img class="spl-icon-info" src="<?php echo SPL_URL . '/assets/images/info.svg'; ?>" alt="some image" title="Activating this feature will create product-specific SEO code, helping search engines understand your products better and rank them higher in search results."/>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<?php
			$enable_seo_jsonld = isset( $cats_data['enable_seo_jsonld'] ) ? $cats_data['enable_seo_jsonld'] : '';
			$checked                   = 'checked';
			$unchecked                 = '';
			?>
			<div class="custom_radio_btn"><input type="radio" name="enable_seo_jsonld" class="enable_seo_jsonld" required="" value="0" 
			<?php
			if ( empty( $enable_seo_jsonld ) ) {
				echo esc_attr($checked);
			} else {
				echo esc_attr($unchecked); }
			?>
			>Off<label class="radio-inline"><span></span></label></div>
			<div class="custom_radio_btn"><input type="radio" name="enable_seo_jsonld" class="enable_seo_jsonld" required="" value="1" 
			<?php
			if ( ! empty( $enable_seo_jsonld ) ) {
				echo esc_attr($checked);
			} else {
				echo esc_attr($unchecked); }
			?>
			>On<label class="radio-inline"><span></span></label></div>
		</div>
	</div>
</div><!-- End of Misc Settings Category-->
</div><!-- END of Right Price List Settings-->
</div>
	<?php
	global $spl_googlefonts_var;
	$google_fonts = $spl_googlefonts_var->$get_fonts_options(); ?>
	<div class="font_setting_container" style="display:none;">
	<div class="font-source-settings clearfix">
		<div class="col-xs-5 col-sm-3 col-md-4 col-lg-4 lbl">
			<label for="font_source">Font Source</label>
			<i class="fa fa-info-circle" title="if page font is selected, stylish price list will use font used in the parent div containing it."></i>
		</div>
		<div class="col-xs-7 col-sm-7 col-md-8  col-lg-8 padl-align">
			<select class="form-control sel1" name="font_source" id="font_source">
				<option value="use-googlefont" <?php selected( isset( $cats_data['font_source'] ) && $cats_data['font_source'] == 'use-googlefont' ); ?>>Use Google Fonts</option>
				<option value="use-pagefont" <?php selected( isset( $cats_data['font_source'] ) && $cats_data['font_source'] == 'use-pagefont' ); ?>>Use page fonts</option>
			</select>
		</div>
	</div>
	<div class="styled-accordion">
		<div class="title">
		  <span class="title-text">Title</span>
          <i class="title-icon fas fa-angle-down"></i>
        </div>
		<div class="content">
			<!-- START of Title Settings -->
			<div class="title-list-style">
			  <div class="df-spl-row cats-row">
				<h4 class="title-font"><b><?php echo esc_attr($Title); ?></b></h4>
			</div>
			<div class="font-settings-body">
			<div class="field-wrapper">
					<label for="title_font_size"><?php echo esc_attr($Font_Size); ?></label>
					<select class="form-control sel1" name="title_font_size" style="box-shadow: 2px 2px 0px #888;">
					  <option class="form-control title_size" value="">Size</option>
					  <?php
						for ( $i = 1; $i <= 100; $i++ ) {
							if ( array_key_exists( 'title_font_size', $cats_data ) ) {
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
		<?php
		if ( $title_color_top == '' ) {
			echo df_spl_color_out( 'title_color_top', '#000', $Font_Color ); }
		?>
		<?php
		if ( $title_color_top != '' ) {
			echo df_spl_color_out( 'title_color_top', $title_color_top, $Font_Color ); }
		?>
		<?php echo $html_out( 'list_name_font', $google_fonts, $list_name_font, $Font_Style ); ?>
		<!--start spl font weight setting for title-->
		<div class="field-wrapper font-weight-row">
				<label for="title_font_weight">Font Weight</label>
				<select class="form-control" id="title_font-weight" name="title_font-weight" style="box-shadow: 2px 2px 0px #888;">
					<option class="form-control title_weight" value="">Font Weight</option>
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
			</div><!-- END of Title Settings -->
		</div>
		<div class="title">
		  <span class="title-text">Category</span>
          <i class="title-icon fas fa-angle-down"></i>
        </div>
		<div class="content">
		
			<!-- START of Category (Tabs) Settings -->
			<div class="title-list-style">
		<div class="df-spl-row cats-row">
			<h4 class="title-font"><b><?php echo esc_attr($Category_Tabs); ?></b></h4>
		</div>
		<div class="font-settings-body">
		<div class="field-wrapper">
				<label for="tab_font_size"><?php echo esc_attr($Font_Size); ?></label>
				<select class="form-control sel1" name="tab_font_size" style="box-shadow: 1px 1px 0px #888;">
					<option class="form-control tab_size" value="">Size</option>
					<?php
					for ( $j = 1; $j <= 100; $j++ ) {
						if ( array_key_exists( 'tab_font_size', $cats_data ) ) {
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
		</div>
		<?php
		if ( $title_color == '' ) {
			echo df_spl_color_out( 'title_color', '#000', $Font_Color ); }
		?>
		<?php
		if ( $title_color != '' ) {
			echo df_spl_color_out( 'title_color', $title_color, $Font_Color ); }
		?>
		<?php echo $html_out( 'title_font', $google_fonts, $title_font, $Font_Style ); ?>
	<script type="text/javascript">
	  function splHandleFormSubmit($this = null) {
		  event.preventDefault();
		  if ( $this ) {
			$this.innerHTML = '<i class="gg-spinner"></i>';
		  }
		  jQuery('#submit_tabs').click();
	  }
  </script>
  <!--start spl font weight setting for category tabs-->
  <div class="field-wrapper font-weight-row">
		<label for="tab_font_weight">Font Weight</label>
		<select class="form-control" id="catrgories-font-weight" name="tab_font-weight" style="box-shadow: 2px 2px 0px #888;">
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
 <!--end spl font weight setting for category tabs-->
</div><!-- END of Category (Tabs) Settings -->	
 <!-- START of Category Description Settings -->
 <div class="title-list-style">
		<div class="df-spl-row cats-row">
			<h4 class="title-font"><b><?php echo esc_attr($Category_description_Tabs); ?></b></h4>
		</div>
		<div class="font-settings-body">
		<div class="field-wrapper">
				<label for="tab_description_font_size"><?php echo esc_attr($Font_Size); ?></label>
				<select class="form-control sel1" name="tab_description_font_size" style="box-shadow: 1px 1px 0px #888;">
					<option class="form-control tab_description_size" value="">Size</option>
					<?php
					for ( $j = 1; $j <= 100; $j++ ) {
						if ( array_key_exists( 'tab_description_font_size', $cats_data ) ) {
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
		<?php
		if ( $tab_description_color == '' ) {
			echo df_spl_color_out( 'tab_description_color', '#000', $Font_Color ); }
		?>
		<?php
		if ( $tab_description_color != '' ) {
			echo df_spl_color_out( 'tab_description_color', $tab_description_color, $Font_Color ); }
		?>
		<?php echo $html_out( 'tab_description_font', $google_fonts, $tab_description_font, $Font_Style ); ?>
<!--start spl font weight setting for category tabs-->
<div class="field-wrapper">
		<label for="tab_font_weight">Font Weight</label>
		<select class="form-control" id="cat-tabs-font-weight" name="tab_description_font-weight" style="box-shadow: 2px 2px 0px #888;">
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
</div><!-- END of Category Description Settings -->
		</div>
		<div class="title">
		  <span class="title-text">Item</span>
          <i class="title-icon fas fa-angle-down"></i>
        </div>
		<div class="content">
			
		<!-- START of Item Name Settings -->
		<div class="title-list-style">
		  <div class="df-spl-row cats-row">
			<h4 class="title-font"><b><?php echo esc_attr($Service_Name); ?></B></h4>
			</div>
			<div class="font-settings-body">
			<div class="field-wrapper">
					<label for="tab_font_size"><?php echo esc_attr($Font_Size); ?></label>
					<select class="form-control sel1" name="service_font_size" style="box-shadow: 2px 2px 0px #888;">
					  <option class="form-control service_size" value="">Size</option>
					  <?php
						for ( $k = 1; $k <= 100; $k++ ) {
							if ( array_key_exists( 'service_font_size', $cats_data ) ) {
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
		<?php
		if ( $service_color == '' ) {
			echo df_spl_color_out( 'service_color', '#000', $Font_Color ); }
		?>
		<?php
		if ( $service_color != '' ) {
			echo df_spl_color_out( 'service_color', $service_color, $Font_Color ); }
		?>
		<?php echo $html_out( 'desc_font', $google_fonts, $desc_font, $Font_Style ); ?>
		<?php
		if ( $hover_color == '' ) {
			echo df_spl_color_out( 'hover_color', '#000', $Hover_Color ); }
		?>
		<?php
		if ( $hover_color != '' ) {
			echo df_spl_color_out( 'hover_color', $hover_color, $Hover_Color ); }
		?>
		<!--start spl font weight setting for services-->
		<div class="field-wrapper">
				<label for="service_font_weight">Font Weight</label>
				<select class="form-control" id="service-font-weight" name="service_font-weight" style="box-shadow: 2px 2px 0px #888;">
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
 <!--end spl font weight setting for services-->
</div><!-- END of Item Name Settings -->
			<!-- START of Price Settings -->
			<div class="title-list-style">
	  <div class="df-spl-row cats-row">
		<h4 class="title-font"><b><?php echo esc_attr($Service_Price); ?></b></h4>
	</div>
	<div class="font-settings-body">
	<div class="field-wrapper">
			<label for="tab_font_size"><?php echo esc_attr($Font_Size); ?></label>
			<select class="form-control sel1" name="service_price_font_size" style="box-shadow: 2px 2px 0px #888;">
			  <option class="form-control service_price_font_size" value="">Size</option>
			  <?php
				for ( $n = 1; $n <= 100; $n++ ) {
					$change_lang_value = '';
					if ( array_key_exists( 'service_price_font_size', $cats_data ) ) {
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
<?php
if ( $price_color == '' ) {
	echo df_spl_color_out( 'price_color', '#000', $Font_Color ); }
?>
<?php
if ( $price_color != '' ) {
	echo df_spl_color_out( 'price_color', $price_color, $Font_Color ); }
?>
<?php echo $html_out( 'price_font', $google_fonts, $price_font, $Font_Style ); ?>
<!--start spl font weight setting for service price-->
<div class="field-wrapper font-weight-row">
		<label for="service_price_font_weight">Font Weight</label>
		<select class="form-control" id="srv-price-font-weight" name="service_price_font-weight" style="box-shadow: 2px 2px 0px #888;">
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
</div><!-- END of Price Settings -->
 <!--end spl font weight setting for service price-->
 <!-- START of Description Settings -->
 <div class="title-list-style">
	  <div class="df-spl-row cats-row">
		<h4 class="title-font"><b><?php echo esc_attr($Service_Description); ?></b></h4>
	</div>
	<div class="font-settings-body">
	<div class="field-wrapper">
			<label for="tab_font_size"><?php echo esc_attr($Font_Size); ?></label>
			<select class="form-control sel1" name="service_description_font_size" style="box-shadow: 2px 2px 0px #888;">
			  <option class="form-control service_description_font_size" value="">Size</option>
			  <?php
				for ( $n = 1; $n <= 100; $n++ ) {
					if ( array_key_exists( 'service_description_font_size', $cats_data ) ) {
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
<?php
if ( $service_description_color == '' ) {
	echo df_spl_color_out( 'service_description_color', '#000', $Font_Color ); }
?>
<?php
if ( $service_description_color != '' ) {
	echo df_spl_color_out( 'service_description_color', $service_description_color, $Font_Color ); }
?>
<?php echo $html_out( 'service_description_font', $google_fonts, $service_description_font, $Font_Style ); ?>
<script type="text/javascript">
  jQuery(function($){
   jQuery('.color-picker').wpColorPicker();
});
</script>
<!--start spl font weight setting for description-->
<div class="field-wrapper font-weight-row">
		<label for="description_font_weight">Font Weight</label>
		<select class="form-control" id="description_font-weight" name="description_font-weight" style="box-shadow: 2px 2px 0px #888;">
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
 <!-- END of Description Settings -->
</div>
		</div>
	</div>
		<div id="category-row-template" style="display:none;float: left;width: 100%;max-width: 900px;">
			<?php
			echo category_row( 0, $init_cat, $max_service_count );
			?>
		</div> <!-- category-row-template -->
			<?php
			$opt = get_option( 'spllk_opt' );
			if ( empty( $opt ) || $opt['license'] !== 'valid' ) {
				echo '<div class="free_version alert alert2 bg-warning">
					<p>You are using the <span class="highlighted">free (demo)</span> version of the plugin. Click <span class="highlighted"><a href="https://stylishpricelist.com?utm_source=inside-plugin&utm_medium=buy-premium-cta-banner">here</a></span> to buy the premium version.</p>
					<p class="text-danger d-none" id="edit-page-alert">Your License key has been expired. Some features might not work properly. Please renew. <a href="'. esc_attr( admin_url('admin.php?page=stylish_price_list_license') ) . '">Go to license manager</a></p>
				</div>';
			}
			?>
		<div id="pricelist-editor-root" class="category-rows-master-cls">
			<div id="category-rows-wrapper">
				<div class="header">
					<div class="title">List Builder</div>
					<div class="des">See how will look your list</div>
				</div>
				
				<div class="categories">
					<?php
					$cats = $cats_data['category'];
					foreach ( $cats as $cat_id => $cat ) {
						// $cat_name=$cat['name'];
						echo category_row( $cat_id, $cat, $max_service_count );
						// unset($cat['name']);//remove the name items, so, we can use foreach to process
						// foreach ($cat as $service_id => $service) {
						//     echo category_row($cat_id,$service_id,$cat_name);
						// }
					}
					?>
				</div>

				<div class="action-button">
					<a href="javascript:void(0);" class="add-category-btn" onclick="add_category(this)">
						<i class="fas fa-plus-circle" style="margin-right: 2px;"></i>
						<?php echo esc_attr($GLOBALS['Add_Category']); ?>
					</a>
				</div>

			</div> <!-- category-rows-wrapper -->
			<div class="spl-preview">
				<div class="header clearfix">
					<div class="preview-info">
						<div class="title">Preview</div>
						<div class="des">See how will look your Price List</div>
					</div>
					<div class="action-button spl-tect">
						<div id="dock-to-bottom" title="Dock the preview pane to the bottom" data-dock-mode="bottom" role="button" onclick="handlePreviewDockMode(this, 'bottom', event)" class="use-tooltip m-0 btn" data-bs-original-title="Dock the preview pane to the bottom" aria-label="Dock the preview pane to the bottom"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-200v120h560v-120H200Zm0-80h560v-360H200v360Zm0 80v120-120Z" fill="currentColor"></path></svg></div>
						<div id="dock-to-right" title="Dock the preview pane to the right" data-dock-mode="right" role="button" onclick="handlePreviewDockMode(this, 'right', event)" class="use-tooltip m-0 btn btn-primary" data-bs-original-title="Dock the preview pane to the right" aria-label="Dock the preview pane to the right"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm440-80h120v-560H640v560Zm-80 0v-560H200v560h360Zm80 0h120-120Z" fill="currentColor"></path></svg></div>
					</div>
				</div>
				<?php
				if ( $id != '' ) {
					?>
					<div id="preview_content" style="padding:0;border-radius: 0;"><?php echo do_shortcode( '[pricelist id="' . absint($_REQUEST['id']) . '"]' ); ?></div>
					<?php
				}
				?>
			</div>
		</div>
		<input type="hidden" name="field_id" class="form-control" value="<?php  esc_html_e( $id, 'text_domain' ); ?>">
		<?php wp_nonce_field( 'spl_nonce' ); ?>
		<input type="hidden" name="spl_nonce" value="<?php echo wp_create_nonce( 'spl_nonce' ); ?>">
		<div class="clearfix df-spl-edit-nav df-spl-edit-nav-bottom">
			<div class="col-md-12"  style="display:flex;align-items: center " >
				<div class="col-md-2"> 
					<div class="bottom-save spl_btn_primary "><!----Start of Save Button (Bottom) ---->
						<?php submit_button( __( $Save, 'spl' ), 'primary', 'submit_tabs' ); ?>
					</div><!----End of Save Button (Bottom) ---->
				</div>
				<!--Start of BackUp Button-->
				<?php
				if ( $id != '' ) {
					if ( ! empty( $opt ) && ( isset( $opt['result'] ) && $opt['result'] == 'success' ) ) {
						$AddClass = '';
						?>
						<div class="col-md-8 navbar-bottom-links">
						<ul class="nav navbar-nav">
							<li><a href="https://stylishcostcalculator.com" target="_blank" id="myBtnSupport">STYLISH COST CALCULATOR</a></li>
							<li><a href="https://designful.freshdesk.com/support/solutions/48000446986" target="_blank" id="myBtnSupport">KNOWLEDGE BASE</a></li>
							<li><a href="https://designful.freshdesk.com/support/solutions/articles/48001184064-basics-explained-how-do-i-use-stylish-price-list-" id="myBtnSupport" target="_blank">VIDEO TUTORIAL</a></li>
							<li><a href="https://stylishpricelist.com/live-preview/" target="_blank">LIVE DEMO</a></li>
							<li><a href="https://stylishpricelist.com/support" target="_blank">CONTACT SUPPORT</a></li>
						</ul>
						</div>
						<div class="col-md-2 spl-button-backup">
						 <button  id="splButtom" type="button" name="backup" value=""
						 	data-action="<?php echo esc_url( admin_url( 'admin-post.php' ) . '?action=spl_generate_backup' ); ?>"
							data-list-id="<?php echo htmlentities( $id ); ?>"
							data-list-name="<?php echo urlencode( htmlspecialchars( $list_name ) ); ?>"
							data-nonce="<?php echo wp_create_nonce( 'spl_backup_nonce' ); ?>"
						 	class="spl_btn_primary button button-primary backup " style="height: 45px;"><i class="fa fa-file" aria-hidden="true" style="font-size:18px;margin-right:15px;color:#6B6B6B"></i><?php echo esc_attr($Backup); ?></button>
						 <?php if ( $id == '' || $id != '' ) {
							if ( ! empty( $opt ) && ( isset( $opt['result'] ) && $opt['result'] == 'success' ) ) { ?>
								<button id="splButtomRest" type="button" name="restore" value="" class="spl_btn_primary button button-primary restore" style="height: 45px;margin-right:15px;">
									<img 	 src="<?php echo SPL_URL . '/assets/images/ICON22.svg'; ?>" aria-hidden="true" style="font-size:20px;vertical-align:middle;">
									<?php echo esc_attr($Restore); ?>
								</button>
								<?php
							}
						} ?>
					 </div>
						<?php
					}
				} else {
				?>
				<div class="col-md-8"></div>
				<div class="col-md-2 spl-button-backup">
					<div class="col-md-8"></div>
					<?php if ( $id == '' || $id != '' ) {
					if ( ! empty( $opt ) && ( isset( $opt['result'] ) && $opt['result'] == 'success' ) ) { ?>
						<button id="splButtomRest" type="button" name="restore" value="" class="spl_btn_primary button button-primary restore" style="height: 45px;margin-right:15px;">
							<img 	 src="<?php echo SPL_URL . '/assets/images/ICON22.svg'; ?>" aria-hidden="true" style="font-size:20px;vertical-align:middle;"> <!-- Aquí se agrega la imagen -->
							<?php echo esc_attr($Restore); ?>
						</button>
						<?php
					}
					} ?>
				</div>
				<?php } ?>
		   <!--End of BackUp Button-->
	   </div>
   </div>
</div>
</form><!----Preview, Restore & Backup Section---->
<!----Preview, Restore & Backup Section---->
<div class="df-spl-row">
</div>
<?php
if ( $id == '' || $id != '' ) {
	if ( ! empty( $opt ) && ( isset( $opt['result'] ) && $opt['result'] == 'success' ) ) {
		?>
		<div class="df-spl-row restore_content" style="display:none">
			<div class="col-md-12 backup-btn-wrapper">
				<div class="back-up">
					<form class="custom-backup-restore" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) . '?action=spl_restore_backup' ); ?>" enctype="multipart/form-data">
						<?php wp_nonce_field( 'spl_restore_nonce' ); ?>
						<input type="hidden" name="list_id" value="<?php  esc_html_e( $id, 'text_domain' ); ?>">
						<input type="file" name="importtocsv" id="fileupload">
						<button type="submit" name="restore" value="restore" class="spl_btn_primary button button-primary" style="width:200px;background:orange!important;"><?php echo esc_attr($Restore); ?> Now</button>
					</form>
				</div>
			</div>
		</div>
		<?php
		//endif;
	}
}
if ( $id != '' ) {
	if ( ! empty( $opt ) && ( isset( $opt['result'] ) && $opt['result'] == 'success' ) ) {
		$AddClass = '';
		?>
		<?php
	}
}
?>
<!--End Preview, Restore & Backup Section-->
<?php
if ( $id != '' ) {
	if ( ! empty( $opt ) && ( isset( $opt['result'] ) && $opt['result'] == 'success' ) ) {
		$AddClass = '';
		?>
		<div class="df-spl-row backup_content" style="display:none;">
			<div class="col-md-12 backup-btn-wrapper">
				<div class="back-up">
					<form class="panel_accordian" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) . '?action=spl_generate_backup' ); ?>">
						<input type="hidden" name="list_id" value="<?php echo htmlentities( $id ); ?>">
						<button type="submit" name="backup" value="<?php echo urlencode( htmlspecialchars( $list_name ) ); ?>" class="spl_btn_primary button button-primary" style="width: 200px;background: orange!important;"><?php echo esc_attr($Backup); ?> Now</button>
					</form>
				</div>
			</div>
		</div>
		<?php
	}
}
?>
</div>
<input type="hidden" class="save_lang" value="<?php echo isset( $cats_data1['select_lang'] ) ? $cats_data1['select_lang'] : 'EN'; ?> ">
<?php
$change_lang_value = '';
if ( array_key_exists( 'lang', $_REQUEST ) ) {
	$change_lang_value =  sanitize_text_field( $_REQUEST['lang'], 'text_domain' );
}
?>
<input type="hidden" class="change_lang" value="<?php echo esc_attr($change_lang_value); ?>">
<!-- user survey modal, initiates if the editing page has been used more than 9 times -->
<div class="modal df-spl-modal fade in" id="user-scc-sv" style="padding-right: 0px; display: none;" role="dialog">
	<div class="df-spl-euiOverlayMask df-spl-euiOverlayMask--aboveHeader">
		<div class="df-spl-euiModal df-spl-euiModal--maxWidth-default df-spl-euiModal--confirmation">
			<button onclick="sccSkipFeedbackModal()" class="df-spl-euiButtonIcon df-spl-euiButtonIcon--text df-spl-euiModal__closeIcon" type="button" data-dismiss="modal" aria-label="Closes this modal window">
				<svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="df-spl-euiIcon df-spl-euiIcon--medium df-spl-euiButtonIcon__icon" focusable="false" role="img" aria-hidden="true">
					<path d="M7.293 8L3.146 3.854a.5.5 0 11.708-.708L8 7.293l4.146-4.147a.5.5 0 01.708.708L8.707 8l4.147 4.146a.5.5 0 01-.708.708L8 8.707l-4.146 4.147a.5.5 0 01-.708-.708L7.293 8z"></path>
				</svg>
			</button>
			<div class="df-spl-euiModal__flex">
				<div class="step1-wrapper">
					<div class="df-spl-euiModalHeader d-block pb-0">
						<div class="df-spl-euiModalHeader__title pt-2">Rate your experience with our product...</div>
					</div>
					<div class="df-spl-euiModalBody">
						<div class="df-spl-euiModalBody__overflow d-flex align-items-center">
								<ul class="pagination pagination-lg me-3 mb-0 ratings-picker">
									<li class="page-item me-2">
										<span class="page-link text-dark" role="button">1</span>
									</li>
									<li class="page-item me-2"><span class="page-link text-dark" role="button">2</span></li>
									<li class="page-item me-2"><span class="page-link text-dark" role="button">3</span></li>
									<li class="page-item me-2"><span class="page-link text-dark" role="button">4</span></li>
									<li class="page-item"><span class="page-link text-dark" role="button">5</span></li>
								</ul>
								<p><i class="fa fa-star text-info"></i>&nbsp;<span>Stars</span></p>
						</div>
					</div>
					<div class="df-spl-euiModalFooter"></div>
				</div>
				<div class="step2-wrapper df-spl-d-none" data-nonce="<?php echo wp_create_nonce( 'spl-feedback-modal' ) ?>">
					<div class="df-spl-euiModalHeader d-block pb-0">
						<div class="pt-2 d-flex align-items-center justify-content-between">
							<div class="df-spl-euiModalHeader__title">Anything that can be improved?</div>
							<p><i class="fa fa-star text-info"></i>&nbsp;<span class="rating-chosen">5</span></p>
						</div>
					</div>
					<div class="df-spl-euiModalBody">
						<div class="df-spl-euiModalBody__overflow d-block align-items-center">
							<div class="">
								<textarea id="comments-text-input" class="form-control" placeholder="Your feedback (optional)" rows="4"></textarea>
							</div>
							<div class="form-group" id="survey-email-input-wrapper">
								<label for="feedback-email-input">Your email address (optional)</label>
								<input id="feedback-email-input" class="form-control" value="<?php echo esc_attr( get_option( 'admin_email' ) ); ?>" >
							</div>
							<div class="scc-form-checkbox">
								<label class="scc-accordion_switch_button" for="feedback-opt-in">
									<input onchange="document.querySelector('#survey-email-input-wrapper').classList.toggle('df-spl-d-none')" checked type="checkbox" id="feedback-opt-in">
									<span class="scc-accordion_toggle_button round"></span>
								</label>
								<span><label for="feedback-opt-in" class="lblExtraSettingsEditCalc">I don't mind receiving a reply by email.</label>
								</span>
							</div>
							<div class="">
								<div id="comments-submit-btn" class="btn">Submit</div>
							</div>
						</div>
					</div>
					<div class="df-spl-euiModalFooter"></div>
				</div>
				<div class="step3-wrapper df-spl-d-none">
					<div class="df-spl-euiModalHeader d-block mb-0">
						<div class="df-spl-euiModalHeader__title">
							<i style="vertical-align: sub;" class="material-icons-outlined bg-info rounded">check</i>
							<span>Thanks for the feedback!</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal df-spl-modal" id="maxvars_warning">
	<div class="df-spl-euiOverlayMask df-spl-euiOverlayMask--aboveHeader">
		<div class="df-spl-euiModal df-spl-euiModal--maxWidth-default df-spl-euiModal--confirmation">
		<button class="df-spl-euiButtonIcon df-spl-euiButtonIcon--text df-spl-euiModal__closeIcon" style="background-color: #fff;" type="button" data-dismiss="modal" aria-label="Closes this modal window"><svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="df-spl-euiIcon df-spl-euiIcon--medium df-spl-euiButtonIcon__icon" focusable="false" role="img" aria-hidden="true"><path d="M7.293 8L3.146 3.854a.5.5 0 11.708-.708L8 7.293l4.146-4.147a.5.5 0 01.708.708L8.707 8l4.147 4.146a.5.5 0 01-.708.708L8 8.707l-4.146 4.147a.5.5 0 01-.708-.708L7.293 8z"></path></svg></button>
			<div class="df-spl-euiModal__flex">
				<div class="df-spl-euiModalHeader" style="background-color: red; color: #fff">
					<div class="df-spl-euiModalHeader__title trn" style="color: #fff">PHP environment has low Max Input Variable</div>
				</div>
				<div class="df-spl-euiModalBody">
					<div class="df-spl-euiModalBody__overflow">
						<div class="df-spl-euiText df-spl-euiText--medium">
							<p>Please consider raising the <a href="https://www.a2hosting.com/kb/developer-corner/php/using-php.ini-directives/php-max-input-vars-directive" target="_blank"> maximum number of input variables</a> to prevent data loss.<br>Current value is <?php echo esc_attr($current_max_input_var); ?></p>
							<p>After raising the MAX_INPUT_VARS parameter, close this dialog and save your work.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.df-spl-pl-settings-title{
		font-size:18px;
		color:#5bb3a7;
		font-weight:bold;
		margin-top:20px;
	}
	.df-spl-pl-settings-hr{
		color:#5bb3a7;
		height:1px;
	}
	a.add-service.add-remove-service {
		color: #5bb3a7;
	}
	a.remove-service.add-remove-service {
		color: grey;
	}
	p.submit input.button {
		padding-right: 30px;
		padding-left: 30px;
	}
	.df-spl-euiOverlayMask {
	  position: fixed;
	  top: 0;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  display: -webkit-flex;
	  display: flex;
	  -webkit-align-items: center;
	  align-items: center;
	  -webkit-justify-content: center;
	  justify-content: center;
	  padding-bottom: 10vh;
	  background: rgba(255,255,255,0.8);
  }
  .df-spl-euiModal--confirmation {
	  min-width: 400px;
  }
  .df-spl-euiModal--maxWidth-default {
	  max-width: 768px;
  }
  .df-spl-euiModal {
	  border: 1px solid #D3DAE6;
	  box-shadow: 0 40px 64px 0 rgba(65,78,101,0.1), 0 24px 32px 0 rgba(65,78,101,0.1), 0 16px 16px 0 rgba(65,78,101,0.1), 0 8px 8px 0 rgba(65,78,101,0.1), 0 4px 4px 0 rgba(65,78,101,0.1), 0 2px 2px 0 rgba(65,78,101,0.1);
	  border-color: #c6cad1;
	  border-top-color: #e3e4e8;
	  border-bottom-color: #aaafba;
	  display: -webkit-flex;
	  display: flex;
	  position: relative;
	  background-color: #fff;
	  border-radius: 4px;
	  z-index: 8000;
	  min-width: 400px;
	  -webkit-animation: euiModal 350ms cubic-bezier(0.34, 1.61, 0.7, 1);
	  animation: euiModal 350ms cubic-bezier(0.34, 1.61, 0.7, 1);
  }
  .df-spl-euiModal__closeIcon {
	  background-color: rgba(255,255,255,0.9);
	  position: absolute;
	  right: 4px;
	  top: 4px;
	  z-index: 3;
  }
  .df-spl-euiModal__closeIcon {
	  background-color: rgba(255,255,255,0.9);
	  position: absolute;
	  right: 4px;
	  top: 4px;
	  z-index: 3;
  }
  .df-spl-euiButtonIcon--text {
	  color: #343741;
  }
  .df-spl-euiButtonIcon {
	  display: inline-block;
	  -webkit-appearance: none;
	  -moz-appearance: none;
	  appearance: none;
	  cursor: pointer;
	  height: 40px;
	  line-height: 40px;
	  text-align: center;
	  white-space: nowrap;
	  max-width: 100%;
	  vertical-align: middle;
	  font-family: "Inter UI",-apple-system,BlinkMacSystemFont,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
	  font-weight: 400;
	  letter-spacing: -.005em;
	  -webkit-text-size-adjust: 100%;
	  -ms-text-size-adjust: 100%;
	  -webkit-font-kerning: normal;
	  font-kerning: normal;
	  font-size: 16px;
	  font-size: 1rem;
	  line-height: 1.5;
	  text-decoration: none;
	  border: solid 1px transparent;
	  transition: all 250ms ease-in-out;
	  border: none;
	  background-color: transparent;
	  box-shadow: none;
	  height: auto;
	  min-height: 24px;
	  min-width: 24px;
	  line-height: 0;
	  padding: 4px;
	  border-radius: 4px;
  }
  .df-spl-euiModal .df-spl-euiModal__flex {
	  -webkit-flex: 1 1 auto;
	  flex: 1 1 auto;
	  display: -webkit-flex;
	  display: flex;
	  -webkit-flex-direction: column;
	  flex-direction: column;
	  max-height: 75vh;
	  overflow: hidden;
  }
  .df-spl-euiModalHeader {
	  display: -webkit-flex;
	  display: flex;
	  -webkit-justify-content: space-between;
	  justify-content: space-between;
	  -webkit-align-items: center;
	  align-items: center;
	  padding: 24px 40px 16px 24px;
	  -webkit-flex-grow: 0;
	  flex-grow: 0;
	  -webkit-flex-shrink: 0;
	  flex-shrink: 0;
  }
  .df-spl-euiModalHeader__title {
	  color: #1a1c21;
	  font-size: 28px;
	  font-size: 1.75rem;
	  line-height: 2.5rem;
	  font-weight: 300;
	  letter-spacing: -.04em;
  }
  .df-spl-euiModalBody {
	  -webkit-flex-grow: 1;
	  flex-grow: 1;
	  overflow: hidden;
	  display: -webkit-flex;
	  display: flex;
	  -webkit-flex-direction: column;
	  flex-direction: column;
  }
  .df-spl-euiModalBody .df-spl-euiModalBody__overflow {
	  scrollbar-width: thin;
	  height: 100%;
	  overflow-y: auto;
	  -webkit-mask-image: linear-gradient(to bottom, rgba(255,0,0,0.1) 0%,red 7.5px,red calc(100% - 7.5px),rgba(255,0,0,0.1) 100%);
	  mask-image: linear-gradient(to bottom, rgba(255,0,0,0.1) 0%,red 7.5px,red calc(100% - 7.5px),rgba(255,0,0,0.1) 100%);
	  padding: 8px 24px;
  }
  .df-spl-euiText {
	  color: #343741;
	  font-weight: 400;
	  font-size: 16px;
	  font-size: 1rem;
	  line-height: 1.5;
	  color: inherit;
	  line-height: 1.5rem;
  }
  .df-spl-euiText p {
	  margin-bottom: 1.5rem;
	  font-size: inherit;
  }
  .df-spl-euiModalFooter {
	  display: -webkit-flex;
	  display: flex;
	  -webkit-justify-content: flex-end;
	  justify-content: flex-end;
	  padding: 16px 24px 24px;
	  -webkit-flex-grow: 0;
	  flex-grow: 0;
	  -webkit-flex-shrink: 0;
	  flex-shrink: 0;
  }
  .df-spl-euiButtonEmpty--primary {
	  color: #006BB4;
  }
  .df-spl-euiButtonEmpty {
	  display: inline-block;
	  -webkit-appearance: none;
	  -moz-appearance: none;
	  appearance: none;
	  cursor: pointer;
	  height: 40px;
	  line-height: 40px;
	  text-align: center;
	  white-space: nowrap;
	  max-width: 100%;
	  vertical-align: middle;
	  font-family: "Inter UI",-apple-system,BlinkMacSystemFont,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
	  font-weight: 400;
	  letter-spacing: -.005em;
	  -webkit-text-size-adjust: 100%;
	  -ms-text-size-adjust: 100%;
	  -webkit-font-kerning: normal;
	  font-kerning: normal;
	  font-size: 16px;
	  font-size: 1rem;
	  line-height: 1.5;
	  text-decoration: none;
	  border: solid 1px transparent;
	  transition: all 250ms ease-in-out;
	  border-color: transparent;
	  background-color: transparent;
	  box-shadow: none;
	  -webkit-transform: none !important;
	  transform: none !important;
	  -webkit-animation: none !important;
	  animation: none !important;
	  transition-timing-function: ease-in;
	  transition-duration: 150ms;
  }
  .df-spl-euiButtonEmpty .df-spl-euiButtonEmpty__content {
	  padding: 0 8px;
  }
  .df-spl-euiButtonContent {
	  height: 100%;
	  width: 100%;
	  vertical-align: middle;
	  display: -webkit-flex;
	  display: flex;
	  -webkit-justify-content: center;
	  justify-content: center;
	  -webkit-align-items: center;
	  align-items: center;
  }
  .df-spl-euiButton .df-spl-euiButton__content {
	padding: 0 12px;
}
.df-spl-euiButtonEmpty .df-spl-euiButtonEmpty__text {
  text-overflow: ellipsis;
  overflow: hidden;
}
.df-spl-euiButton {
  display: inline-block;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  cursor: pointer;
  height: 40px;
  line-height: 40px;
  text-align: center;
  white-space: nowrap;
  max-width: 100%;
  vertical-align: middle;
  font-family: "Inter UI",-apple-system,BlinkMacSystemFont,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
  font-weight: 400;
  letter-spacing: -.005em;
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
  -webkit-font-kerning: normal;
  font-kerning: normal;
  font-size: 16px;
  font-size: 1rem;
  line-height: 1.5;
  text-decoration: none;
  border: solid 1px transparent;
  transition: all 250ms ease-in-out;
  box-shadow: 0 2px 2px -1px rgba(152,162,179,0.3);
  border-radius: 4px;
  min-width: 112px;
}
.df-spl-euiButton--primary:enabled {
  box-shadow: 0 2px 2px -1px rgba(54,97,126,0.3);
}
.df-spl-euiButton--primary.df-spl-euiButton--fill {
  background-color: #006BB4;
  border-color: #006BB4;
  color: #fff;
}
.df-spl-euiButton--primary {
  color: #006BB4;
  border-color: #006BB4;
}
.df-spl-euiModalFooter>*+* {
  margin-left: 16px;
}
.df-spl-euiFormRow+.df-spl-euiFormRow, .df-spl-euiFormRow+.df-spl-euiButton {
  margin-top: 16px;
}
.df-spl-euiFormRow {
  display: -webkit-flex;
  display: flex;
  -webkit-flex-direction: column;
  flex-direction: column;
  max-width: 400px;
}
.df-spl-euiFormControlLayout {
  max-width: 400px;
  width: 100%;
  height: 40px;
}
.df-spl-euiFormControlLayout__childrenWrapper {
  position: relative;
}
.df-spl-euiFieldText {
  max-width: 400px;
  width: 100%;
  height: 40px;
  background-color: #fbfcfd;
  background-repeat: no-repeat;
  background-size: 0% 100%;
  box-shadow: 0 1px 1px -1px rgba(152,162,179,0.2), 0 3px 2px -2px rgba(152,162,179,0.2), inset 0 0 0 1px rgba(15,39,118,0.1);
  transition: box-shadow 150ms ease-in,background-image 150ms ease-in,background-size 150ms ease-in,background-color 150ms ease-in;
  font-family: "Inter UI",-apple-system,BlinkMacSystemFont,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
  font-weight: 400;
  letter-spacing: -.005em;
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
  -webkit-font-kerning: normal;
  font-kerning: normal;
  font-size: 14px;
  color: #343741;
  border: none;
  border-radius: 0;
  padding: 12px;
}
.spl-icon-info {
    margin-bottom: -5px;
    cursor: pointer;
}
.add_to_webpage{
	flex-direction: column !important;
    display: flex;
	text-align:center;
}
.add_to_webpage img {
	height: 21px;
}
.add_to_webpage{
	text-align:center;
}
.advance_setting{
	flex-direction: column !important;
    display: flex;
	text-align:center;
}
.advance_setting img{
	height: 21px;
}
.font_settitng{
	flex-direction: column !important;
    display: flex;
	text-align:center;
}
.font_settitng img{
	height:21px;
}
</style>
<footer id="admin_footer">
	<?php
	require_once dirname( __FILE__ ) . '/logo-footer.php';
	?>
</footer>
<script>
	jQuery(document).ready(function($){
		let ab = document.querySelector('.category-rows-master-cls');
		// INITIATING SORTING CAPABILITY FOR ITEMS IN THE CATEGORIES
		document.querySelectorAll('.df-spl-row.category-row.ui-widget-content .service-container').forEach((categoryWrapper,index) => {
			makeServiceSortable(categoryWrapper);
		});
		jQuery(document).on('click', '.toggle-advanced-options', function () {
			jQuery(this).parent().siblings('.service-advance-settings').slideToggle(500);
		});
		<?php
		$this->feedback_invokation( 'form' );
		if ( ( get_option( 'spl_save_count' ) == $this->feedback_invokation( 'form' ) ) && $this->feedback_invokation( 'form' ) != 0 ) {
			echo "setupSurveyModal(document.querySelector('#user-scc-sv'));" . PHP_EOL;}
		?>
		window.splSettings = JSON.parse(jQuery('#spl_settings').html());
		window.itemFieldTooltipImages = JSON.parse(jQuery('#item_field_tooltip_images').html());
		styleDropdown = jQuery('.sel1');
		styleDropdown.data('prev', styleDropdown.val());
		applyDemoFonts = true;
		jQuery('#userSurvey').on('click.dismiss.bs.modal', function() {
			// jQuery('[data-btn-type="skip"]', '#userSurvey').click()
		})
		if(jQuery('.sel1').val() === "style_5"){
			jQuery('#style5_category_container').css('display', 'block')
		}
		jQuery('#select_lang').change(function(){
			var lang= jQuery(this).val();
			var url= "<?php echo esc_url_raw( $_SERVER['REQUEST_URI'] ) . '&lang='; ?>"+lang;
			window.location.href = url;
		});
		jQuery('body').on('click', '.remove-category', function(){
			jQuery(this).closest('.category-row').remove();
		});

		// check for max_input vars
		window.checkIfMaxVarsReached = function () {
			if (jQuery('#main_form input').length >= <?php echo intval($current_max_input_var); ?>) {
				jQuery('#maxvars_warning').removeClass('fade').show(300).trigger('show.bs.modal');
			}
		}
		checkIfMaxVarsReached();
	});
</script>
<script>
	jQuery(document).ready(function(){
		var spl_styl = jQuery('select[name="tab_style"]') .val();
		if(['style_6', 'with_tab'].some(e => e == spl_styl)){
		   jQuery('.spl_service_image_element').show();
		   jQuery('.df-spl-row.category-cover-image-row').hide();
		   jQuery('.service_long_description').closest('.service-price-length').hide();
	   }else if (spl_styl == 'style_8') {
		jQuery('.spl_service_image_element:even').hide();
		jQuery('.spl_service_image_element').show();
		jQuery('.df-spl-row.category-cover-image-row').hide();
	} else if(spl_styl == 'style_10') {
		jQuery('.df-spl-row.category-cover-image-row').show();
		jQuery('.spl_service_image_element').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
	} else {
		jQuery('.spl_service_image_element').hide();
		jQuery('.df-spl-row.category-cover-image-row').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
	}
});
</script>
<script>
	var isStyleChangeAccepted = true;
	jQuery(".sel1").change(function (e) {
	// check for isNoModal variable sent from trigger events
	var isNoModal = e.noModal ? e.noModal : false
	if (jQuery(this).val() == "with_tab") {
		false == isNoModal && jQuery('#sell1').removeClass('fade').show(300).trigger('show.bs.modal');
		// jQuery('.spl_service_image_element').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "without_tab") {
		!(isNoModal) && jQuery('#sell2').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "without_tab_single_column") {
		!(isNoModal) && jQuery('#sell2').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "style_3") {
		!(isNoModal) && jQuery('#sell3').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "style_4") {
		!(isNoModal) && jQuery('#sell4').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "style_5") {
		!(isNoModal) && jQuery('#sell5').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'block')
	}
	if (jQuery(this).val() == "style_6") {
		!(isNoModal) && jQuery('#sell6').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').show();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "style_7") {
		!(isNoModal) && jQuery('#sell7').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').hide();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "style_8") {
		!(isNoModal) && jQuery('#sell8').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.spl_service_image_element').show();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none')
	}
	if (jQuery(this).val() == "style_10") {
		!(isNoModal) && jQuery('#sell10').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.df-spl-row.category-cover-image-row').show();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none');
	}
	if (jQuery(this).val() !== "style_10") {
		// !(isNoModal) && jQuery('#sell7').modal('show');
		jQuery('.df-spl-row.category-cover-image-row').hide();
	}

	if (jQuery(this).val() == "style_table_1") {
		!(isNoModal) && jQuery('#selt1').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.df-spl-row.category-cover-image-row').show();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none');
	}
	if (jQuery(this).val() == "style_table_2") {
		!(isNoModal) && jQuery('#selt2').removeClass('fade').show(300).trigger('show.bs.modal');
		jQuery('.df-spl-row.category-cover-image-row').show();
		jQuery('.service_long_description').closest('.service-price-length').hide();
		jQuery('#style5_category_container').css('display', 'none');
	}
});
	function handleFeedbackButtons(btn, event) {
	  event.preventDefault();
	  console.log();
	  jQuery.post(ajaxurl, {
		'action': 'df_spl_feedback_manage',
		'btn-type': jQuery(btn).data('btnType'),
		'_ajax_nonce' : jQuery(btn).parent().data('nonce')
	}, function(response) {
		jQuery('#userSurvey').addClass('fade').hide(300).trigger('hide.bs.modal');
		var link = jQuery(btn).attr('href');
		if (link) {
			window.open(link, '_blank');
		}
	});
  }
// Register modals and the buttons inside it functions
var modalTags = ['#sell1', '#sell2', '#sell3', '#sell4', '#sell5', '#sell6', '#sell7', '#sell8', '#sell10', '#selt1', '#selt2'];
;(function(elements) {
	elements.forEach(e => {
		jQuery(e).on('show.bs.modal', function (e) {
			var previousStyleValue = styleDropdown.data('prev');
			jQuery(this).find('.cancel-btn').add('button[data-dismiss="modal"]', this).on('click', ee => {
				isStyleChangeAccepted = false;
				debugger;
				jQuery(this).addClass('fade').hide(300).trigger('hide.bs.modal');
				jQuery(ee.target).unbind();
				// set previous selected style and stop popup from invoking
				styleDropdown.val(previousStyleValue)
				.trigger({
					type: 'change',
					noModal: true
				});
			});
			jQuery(this).find('[data-btnType="keep-current"]').on('click', ee => {
				ee.target.innerHTML = '<i class="gg-spinner"></i>';
				if (styleDropdown.val() == 'style_3') {
					jQuery( 'select[name="select_column"] option:eq(0)' ).text( 'Two' );
					jQuery( 'select[name="select_column"]' ).val( 'Two' );
				} else {
					jQuery( 'select[name="select_column"] option:eq(0)' ).text( 'Columns' );
				}
				jQuery(ee.target).unbind();
				jQuery('#submit_tabs').click();
			});
			jQuery(this).find('[data-btnType="use-demo"]').on('click', ee => {
				ee.target.innerHTML = '<i class="gg-spinner"></i>';
				// sending events so the events function will execute
				styleDropdown.trigger('load-demo-settings');

				if (styleDropdown.val() == 'style_3') {
					jQuery( 'select[name="select_column"] option:eq(0)' ).text( 'Two' );
					jQuery( 'select[name="select_column"]' ).val( 'Two' );
				} else {
					jQuery( 'select[name="select_column"] option:eq(0)' ).text( 'Columns' );
				}
				jQuery(ee.target).unbind();
				jQuery('#submit_tabs').click();
			});
		});
		jQuery(e).on('hide.bs.modal', function (e) {
			isStyleChangeAccepted && styleDropdown.data('prev', styleDropdown.val());
			// reset style change value
			isStyleChangeAccepted = true;
		});
	})
})(modalTags);
jQuery('#dropdown_tips').add('#not_an_image_warning').add('#image_bad_aspect_ratio_warning').on('show.bs.modal', function (e) {
	jQuery(this).find('span[data-dismiss="modal"]', this).on('click', ee => {
		jQuery(this).addClass('fade').hide(300).trigger('hide.bs.modal');
		jQuery(ee.target).unbind();
	});
});
</script>
<!-- JS for Video Tutorials BTN --->
<script>
// Get the modal
var modalvideo = document.getElementById('myModalVideos');
// Get the button that opens the modal
var btnvideo = document.getElementById("myBtnVideos");
// Get the <span> element that closes the modal
var spanvideo = document.getElementsByClassName("closevideo")[0];
// When the user clicks the button, open the modal
// btnvideo?.onclick = function() {
//     modalvideo.style.display = "block";
// }
// When the user clicks on <span> (x), close the modal
spanvideo.onclick = function() {
	modalvideo.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modalvideo) {
		modalvideo.style.display = "none";
	}
}
</script>
<script>
// Get the modal
var modalsupport = document.getElementById('myModalSupport');
// Get the button that opens the modal
var btnsupport = document.getElementById("myBtnSupport");
// Get the <span> element that closes the modal
var spansupport = document.getElementsByClassName("closesupport")[0];
// When the user clicks on <span> (x), close the modal
spansupport.onclick = function() {
	modalsupport.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modalsupport) {
		modalsupport.style.display = "none";
	}
}
</script>
<script>
	jQuery(".service-price-length-rows-wrapper").mouseenter(function() {
		jQuery(this).add(this.nextElementSibling).css('box-shadow','0px 1px 6px rgb(91, 179, 167)');
	}).mouseleave(function() {
		
		jQuery(this).add(this.nextElementSibling).css('box-shadow','none');
	});
	jQuery(".service-advance-settings").mouseenter(function() {
		jQuery(this).add(this.previousElementSibling).css('box-shadow','rgb(91, 179, 167) 0px 5px 6px');
	}).mouseleave(function() {
		jQuery(this).add(this.previousElementSibling).css('box-shadow','none');
	});
</script>
<script>
	jQuery("document").ready(function(){
		jQuery(document).on('change', '.service_image', function() {
			const form_data = new FormData();
			const file_data = jQuery(this).prop('files')[0];
			const upload_btn = jQuery(this);
			form_data.append('file', file_data);
			form_data.append('action', 'spl_upload_ser_img');
			form_data.append('security', SPL_item_thumb.security);
			var adminurl = '<?php echo esc_url(admin_url( 'admin-ajax.php' )); ?>';
			jQuery.ajax({
				url: adminurl,
				type: "POST",
				data: form_data,
				contentType: false,
				cache: false,
				processData:false,
				success: function(data){
					upload_btn.parents('.df-spl-row.service-price-length').find('.preview').attr('src', data);
					upload_btn.siblings('input:hidden').val(data);
				}
			});
		});
	});
</script>
<script type="application/json" id="spl_settings">
	<?php
	echo json_encode(
		array(
			'maxCats'      => $max_cat_count,
			'maxService'   => $max_service_count,
			'update_state' => '$update_state'
		)
	);
	?>
</script>
<script type="application/json" id="item_field_tooltip_images">
	<?php
	echo json_encode(
		array(
			'button' => esc_url( SPL_URL . 'assets/images/item-field-tooltip/infographics-button.png' ),
			'compare-at' => esc_url( SPL_URL . 'assets/images/item-field-tooltip/infographics-compare-at.png' ),
			'image' => esc_url( SPL_URL . 'assets/images/item-field-tooltip/infographics-Image.png' ),
			'tooltip' => esc_url( SPL_URL . 'assets/images/item-field-tooltip/infographics-tooltip.png' )
		)
	);
	?>
</script>
<!--- TIDIO CUTSOM BUTTON CHAT HELP -->
<!---<script>
function chatShow(e) {
tidioChatApi.method('popUpOpen');
}
</script> -->
<!--- TIDIO CHAT HELP -->
<!--- TIDIO CHAT HELP -->
<!----<script src="//code.tidio.co/rjrinwxitmkczxakuxdvtzalnbxi1f1x.js"></script>-->
<!--- END TIDIO CHAT HELP -->
