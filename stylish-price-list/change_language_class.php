<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class df_spl_convert_lang {
	public function convert_lang_function( $lang, $keyword ) {
		$language                          = array();
		$language['EN']['Remove_title']    = df_spl_remove_slash_quotes( 'Remove Price List Title' );
		$language['EN']['Select_Language'] = df_spl_remove_slash_quotes( 'Select Dashboard Language' );
		$language['EN']['Select_Column']   = df_spl_remove_slash_quotes( 'Columns' );
		$language['EN']['Max_Width']       = df_spl_remove_slash_quotes( 'Price List Max-Width' );
		$language['EN']['Save']            = df_spl_remove_slash_quotes( 'Save' );
		$language['EN']['Price_List_Name'] = df_spl_remove_slash_quotes( 'Price List Name' );
		$language['EN']['Select_Style']    = df_spl_remove_slash_quotes( 'Select Style' );
		$language['EN']['More_Settings']   = df_spl_remove_slash_quotes( 'More Settings' );
		$language['EN']['Default_Tab']     = df_spl_remove_slash_quotes( 'Default Tab' );
		$language['EN']['Change_All_word_for_Categories']      = df_spl_remove_slash_quotes( 'Change "All" Word for Category Tab' );
		$language['EN']['different_languages']                 = df_spl_remove_slash_quotes( 'different languages' );
		$language['EN']['Display_the_All_word']                = df_spl_remove_slash_quotes( 'Display the "All" Category Tab?' );
		$language['EN']['Style4_Divider_Style']                = df_spl_remove_slash_quotes( 'Divider Style (available in Style4)' );
		$language['EN']['Category_Separator_Symbol']           = df_spl_remove_slash_quotes( 'Category Separator Symbol' );
		$language['EN']['Arrange_Categories_In_Dropdown']      = df_spl_remove_slash_quotes( 'Dropdown Menu for Categories' );
		$language['EN']['Categories_In_Dropdown_Prevent_Keyboard_Popup']      = df_spl_remove_slash_quotes( 'Prevent Keyboard Popup on Mobile Devices While Using Dropdown Menu for Categories' );
		$language['EN']['category_select_scroll_effect_label_text'] = df_spl_remove_slash_quotes( 'Enable Category Selection Scroll Effect' );
		$language['EN']['Category_Dropdown_Width']             = df_spl_remove_slash_quotes( 'Dropdown Width' );
		$language['EN']['Stylish_Category_Tabs_Buttons']       = df_spl_remove_slash_quotes( 'Stylish Category Tabs' );
		$language['EN']['Open_Buy_Btn_Link_In_New_Tab']        = df_spl_remove_slash_quotes( 'Open Buy Button Links in New Tab' );
		$language['EN']['Add_Search_Bar']                      = df_spl_remove_slash_quotes( 'Enable Filter & Search Box' );
		$language['EN']['Price_Range_Slider']                  = df_spl_remove_slash_quotes( 'Enable Price Range Slider' );
		$language['EN']['Break_title_of_Service']              = df_spl_remove_slash_quotes( 'Break Title of Service' );
		$language['EN']['Break_line_of_categories_on_Desktop'] = df_spl_remove_slash_quotes( 'Break Line of Categories on Desktops' );
		$language['EN']['Break_line_of_categories_on_Tablets'] = df_spl_remove_slash_quotes( 'Break Line of Categories on Tablets' );
		$language['EN']['Price_List_Description']              = df_spl_remove_slash_quotes( 'Price List Description' );
		$language['EN']['Items_Price_Currency']                = df_spl_remove_slash_quotes( 'Select Price Currency (for SEO JSON-LD)' );
		$language['EN']['Enable_Product_Seo_Schema']           = df_spl_remove_slash_quotes( 'Enable Product SEO Schema (JSON-LD)' );
		$language['EN']['Title']                               = df_spl_remove_slash_quotes( 'Title' );
		$language['EN']['Category_Tabs']                       = df_spl_remove_slash_quotes( 'Category (Tabs)' );
		$language['EN']['Category_description_Tabs']           = df_spl_remove_slash_quotes( 'Category Description' );
		$language['EN']['Service_Name']                        = df_spl_remove_slash_quotes( 'Item Name' );
		$language['EN']['Service_Regular_Price']               = df_spl_remove_slash_quotes( 'Regular Price' );
		$language['EN']['Service_Long_Description']            = df_spl_remove_slash_quotes( 'Long Description' );
		$language['EN']['Service_Price']                       = df_spl_remove_slash_quotes( 'Price' );
		$language['EN']['Service_Description']                 = df_spl_remove_slash_quotes( 'Description' );
		$language['EN']['Font_Size']                           = df_spl_remove_slash_quotes( 'Font Size' );
		$language['EN']['Font_Color']                          = df_spl_remove_slash_quotes( 'Font Color' );
		$language['EN']['Font_Style']                          = df_spl_remove_slash_quotes( 'Font Style' );
		$language['EN']['Font_Weight']                         = df_spl_remove_slash_quotes( 'Font Weight' );
		$language['EN']['Hover_Color']                         = df_spl_remove_slash_quotes( 'Hover Color' );
		$language['EN']['Category_Name']                       = df_spl_remove_slash_quotes( 'Category Name' );
		$language['EN']['Category_Description']                = df_spl_remove_slash_quotes( 'Category Description' );
		$language['EN']['Category_Background_Color']           = df_spl_remove_slash_quotes( 'Category Background Color' );
		$language['EN']['Category_Text_Color']                  = df_spl_remove_slash_quotes( 'Category Text Color' );
		$language['EN']['Category_Action_Text']                 = df_spl_remove_slash_quotes( 'Category Action Text' );
		$language['EN']['Category_Action_Link']                 = df_spl_remove_slash_quotes( 'Category Action Link' );
		$language['EN']['Category_Price']                	   = df_spl_remove_slash_quotes( 'Category Price' );
		$language['EN']['Category_Image']                	   = df_spl_remove_slash_quotes( 'Category Cover Image' );
		$language['EN']['Category_Image_Overlay_Percent']      = df_spl_remove_slash_quotes( 'Category Cover Image Dark Overlay (%)' );
		$language['EN']['Category_Desc_Embed_To_Cover_Image_S10']      = df_spl_remove_slash_quotes( 'Embed Category Title To the Cover Image (Style 10)' );
		$language['EN']['Service_Name']                        = df_spl_remove_slash_quotes( 'Item Name' );
		$language['EN']['Service_Price']                       = df_spl_remove_slash_quotes( 'Price' );
		$language['EN']['Service_Description']                 = df_spl_remove_slash_quotes( 'Description' );
		$language['EN']['Service_Description_Length']          = df_spl_remove_slash_quotes( 'Description' );
		$language['EN']['Service_Button']                      = df_spl_remove_slash_quotes( 'Button Text' );
		$language['EN']['Service_Button_URL']                  = df_spl_remove_slash_quotes( 'Button URL' );
		$language['EN']['Service_URL']                         = df_spl_remove_slash_quotes( 'Service URL' );
		$language['EN']['Remove_Service']                      = df_spl_remove_slash_quotes( 'Remove Service' );
		$language['EN']['Add_Service']                         = df_spl_remove_slash_quotes( 'Add Service' );
		$language['EN']['Add_Category']                        = df_spl_remove_slash_quotes( 'Add Category' );
		$language['EN']['Remove_Category']                     = df_spl_remove_slash_quotes( 'Remove Category' );
		$language['EN']['Restore']                             = df_spl_remove_slash_quotes( 'Restore' );
		$language['EN']['Backup']                              = df_spl_remove_slash_quotes( 'Backup' );
		$language['EN']['Preview_List']                        = df_spl_remove_slash_quotes( 'Preview List' );
		$language['EN']['CATEGORY']                            = df_spl_remove_slash_quotes( 'CATEGORY' );
		$language['EN']['FONT_SETTINGS']                       = df_spl_remove_slash_quotes( 'FONT SETTINGS' );
		$language['EN']['ADD_TO_WEBPAGE']                      = df_spl_remove_slash_quotes( 'ADD TO WEBPAGE' );
		$language['EN']['Service_Image']                       = df_spl_remove_slash_quotes( 'Product/Service Image' );
		//Spanish
		$language['SP']['Remove_title']                        = df_spl_remove_slash_quotes( 'Eliminar título' );
		$language['SP']['Select_Language']                     = df_spl_remove_slash_quotes( 'Seleccione el idioma' );
		$language['SP']['Select_Column']                       = df_spl_remove_slash_quotes( 'Seleccionar columna' );
		$language['SP']['Max_Width']                           = df_spl_remove_slash_quotes( 'Anchura máxima' );
		$language['SP']['Save']                                = df_spl_remove_slash_quotes( 'Salvar' );
		$language['SP']['Price_List_Name']                     = df_spl_remove_slash_quotes( 'Nombre de lista de precios' );
		$language['SP']['Select_Style']                        = df_spl_remove_slash_quotes( 'Seleccionar estilo' );
		$language['SP']['More_Settings']                       = df_spl_remove_slash_quotes( 'Más ajustes' );
		$language['SP']['Default_Tab']                         = df_spl_remove_slash_quotes( 'Ficha predeterminada' );
		$language['SP']['Change_All_word_for_Categories']      = df_spl_remove_slash_quotes( 'Cambiar la palabra "Todos" por Categorías' );
		$language['SP']['different_languages']                 = df_spl_remove_slash_quotes( 'idiomas diferentes' );
		$language['SP']['Display_the_All_word']                = df_spl_remove_slash_quotes( 'Mostrar la palabra "Todos"?' );
		$language['SP']['Style4_Divider_Style']                = df_spl_remove_slash_quotes( 'Estilo divisor (disponible en Style4)' );
		$language['SP']['Category_Separator_Symbol']           = df_spl_remove_slash_quotes( 'Categoría Símbolo de separador' );
		$language['SP']['Arrange_Categories_In_Dropdown']      = df_spl_remove_slash_quotes( 'Arrange Categories In a Dropdown Choice' );

		$language['SP']['Categories_In_Dropdown_Prevent_Keyboard_Popup']      = df_spl_remove_slash_quotes( 'Prevent Keyboard Popup on Mobile Devices While Using Dropdown Menu for Categories' );
		$language['SP']['category_select_scroll_effect_label_text'] = df_spl_remove_slash_quotes( 'Enable Category Selection Scroll Effect' );
		$language['SP']['Category_Dropdown_Width']             = df_spl_remove_slash_quotes( 'Dropdown Width' );
		$language['SP']['Stylish_Category_Tabs_Buttons']       = df_spl_remove_slash_quotes( 'Elegantes lengüetas de categoría botones' );
		$language['SP']['Open_Buy_Btn_Link_In_New_Tab']        = df_spl_remove_slash_quotes( 'Open Buy Button Links in New Tab' );
		$language['SP']['Add_Search_Bar']                      = df_spl_remove_slash_quotes( 'Enable Search Box' );
		$language['SP']['Price_Range_Slider']                  = df_spl_remove_slash_quotes( 'Habilitar control deslizante de rango de precios' );
		$language['SP']['Break_title_of_Service']              = df_spl_remove_slash_quotes( 'Título de rotura del servicio' );
		$language['SP']['Break_line_of_categories_on_Desktop'] = df_spl_remove_slash_quotes( 'Romper la línea de categorías en el escritorio' );
		$language['SP']['Break_line_of_categories_on_Tablets'] = df_spl_remove_slash_quotes( 'Romper la línea de categorías en Tabletas' );
		$language['SP']['Price_List_Description']              = df_spl_remove_slash_quotes( 'Descripción de la lista de precios' );
		$language['SP']['Items_Price_Currency']                = df_spl_remove_slash_quotes( 'Seleccione la moneda del precio (para SEO JSON-LD)' );
		$language['SP']['Enable_Product_Seo_Schema']           = df_spl_remove_slash_quotes( 'Habilitar esquema de SEO de producto (JSON-LD)' );
		$language['SP']['Title']                               = df_spl_remove_slash_quotes( 'Título' );
		$language['SP']['Category_Tabs']                       = df_spl_remove_slash_quotes( 'Categoría (pestañas)' );
		$language['SP']['Category_description_Tabs']           = df_spl_remove_slash_quotes( 'Descripción de categorías (pestañas)' );
		$language['SP']['Service_Name']                        = df_spl_remove_slash_quotes( 'Nombre del Servicio' );
		$language['SP']['Service_Price']                       = df_spl_remove_slash_quotes( 'Precio' );
		$language['SP']['Service_Description']                 = df_spl_remove_slash_quotes( 'Descripción' );
		$language['SP']['Font_Size']                           = df_spl_remove_slash_quotes( 'Tamaño de fuente' );
		$language['SP']['Font_Color']                          = df_spl_remove_slash_quotes( 'Color de fuente' );
		$language['SP']['Font_Style']                          = df_spl_remove_slash_quotes( 'Estilo de fuente' );
		$language['SP']['Font_Weight']                         = df_spl_remove_slash_quotes( 'Peso de fuente' );
		$language['SP']['Hover_Color']                         = df_spl_remove_slash_quotes( 'Color de libración' );
		$language['SP']['Category_Name']                       = df_spl_remove_slash_quotes( 'nombre de la categoría' );
		$language['SP']['Category_Description']                = df_spl_remove_slash_quotes( 'Descripción de categoría' );
		$language['SP']['Category_Background_Color']           = df_spl_remove_slash_quotes( 'Color de fondo de categoría' );
		$language['SP']['Category_Text_Color']                 = df_spl_remove_slash_quotes( 'Color de texto de categoría' );
		$language['SP']['Category_Action_Text']                 = df_spl_remove_slash_quotes( 'Texto de acción de categoría' );
		$language['SP']['Category_Action_Link']                 = df_spl_remove_slash_quotes( 'Enlace de acción de categoría' );
		$language['SP']['Category_Price']                	   = df_spl_remove_slash_quotes( 'Precio de categoría' );
		$language['SP']['Category_Image']                	   = df_spl_remove_slash_quotes( 'Imagen de portada de categoría' );
		$language['SP']['Category_Image_Overlay_Percent']      = df_spl_remove_slash_quotes( 'Categoría Imagen de portada Superposición oscura (%)' );
		$language['SP']['Category_Desc_Embed_To_Cover_Image_S10']      = df_spl_remove_slash_quotes( 'Incrustar título de categoría en la imagen de portada (estilo 10)' );
		$language['SP']['Service_Name']                        = df_spl_remove_slash_quotes( 'Nombre del Servicio' );
		$language['SP']['Service_Regular_Price']               = df_spl_remove_slash_quotes( 'Precio regular' );
		$language['SP']['Service_Long_Description']            = df_spl_remove_slash_quotes( 'Long Description' );
		$language['SP']['Service_Price']                       = df_spl_remove_slash_quotes( 'Precio' );
		$language['SP']['Service_Description_Length']          = df_spl_remove_slash_quotes( 'Descripción' );
		$language['SP']['Service_Button']                      = df_spl_remove_slash_quotes( 'Botón de texto' );
		$language['SP']['Service_Button_URL']                  = df_spl_remove_slash_quotes( 'URL del botón' );
		$language['SP']['Service_URL']                         = df_spl_remove_slash_quotes( 'URL de servicio' );
		$language['SP']['Remove_Service']                      = df_spl_remove_slash_quotes( 'Eliminar servicio' );
		$language['SP']['Add_Service']                         = df_spl_remove_slash_quotes( 'Añadir servicio' );
		$language['SP']['Add_Category']                        = df_spl_remove_slash_quotes( 'añadir categoría' );
		$language['SP']['Remove_Category']                     = df_spl_remove_slash_quotes( 'Eliminar categoría' );
		$language['SP']['Restore']                             = df_spl_remove_slash_quotes( 'Restaurar' );
		$language['SP']['Backup']                              = df_spl_remove_slash_quotes( 'Apoyo' );
		$language['SP']['Preview_List']                        = df_spl_remove_slash_quotes( 'Lista de vista previa' );
		$language['SP']['CATEGORY']                            = df_spl_remove_slash_quotes( 'CATEGORÍA' );
		$language['SP']['FONT_SETTINGS']                       = df_spl_remove_slash_quotes( 'AJUSTES DE FUENTE' );
		$language['SP']['ADD_TO_WEBPAGE']                      = df_spl_remove_slash_quotes( 'AÑADIR A LA PAGINA WEB' );
		$language['SP']['Service_Image']                       = df_spl_remove_slash_quotes( 'Imagen de servicio' );
		//Franch
		$language['FR']['Remove_title']                        = df_spl_remove_slash_quotes( 'Supprimer le titre' );
		$language['FR']['Select_Language']                     = df_spl_remove_slash_quotes( 'Choisir la langue' );
		$language['FR']['Select_Column']                       = df_spl_remove_slash_quotes( 'Sélectionner une colonne' );
		$language['FR']['Max_Width']                           = df_spl_remove_slash_quotes( 'Largeur maximale' );
		$language['FR']['Save']                                = df_spl_remove_slash_quotes( 'sauvegarder' );
		$language['FR']['Price_List_Name']                     = df_spl_remove_slash_quotes( 'Nom de la liste de prix' );
		$language['FR']['Select_Style']                        = df_spl_remove_slash_quotes( 'Sélectionnez le style' );
		$language['FR']['More_Settings']                       = df_spl_remove_slash_quotes( 'Plus de réglages' );
		$language['FR']['Default_Tab']                         = df_spl_remove_slash_quotes( 'Onglet par défaut' );
		$language['FR']['Change_All_word_for_Categories']      = df_spl_remove_slash_quotes( 'Changer le mot "All" pour les catégories' );
		$language['FR']['different_languages']                 = df_spl_remove_slash_quotes( 'différentes langues' );
		$language['FR']['Display_the_All_word']                = df_spl_remove_slash_quotes( 'Afficher le mot "All"?' );
		$language['FR']['Style4_Divider_Style']                = df_spl_remove_slash_quotes( 'Style de séparateur (disponible dans Style4)' );
		$language['FR']['Category_Separator_Symbol']           = df_spl_remove_slash_quotes( 'Symbole de séparation de catégorie' );
		$language['FR']['Arrange_Categories_In_Dropdown']      = df_spl_remove_slash_quotes( 'Arrange Categories In a Dropdown Choice' );
		$language['FR']['Categories_In_Dropdown_Prevent_Keyboard_Popup']      = df_spl_remove_slash_quotes( 'Prevent Keyboard Popup on Mobile Devices While Using Dropdown Menu for Categories' );
		$language['FR']['category_select_scroll_effect_label_text'] = df_spl_remove_slash_quotes( 'Enable Category Selection Scroll Effect' );
		$language['FR']['Category_Dropdown_Width']             = df_spl_remove_slash_quotes( 'Dropdown Width' );
		$language['FR']['Stylish_Category_Tabs_Buttons']       = df_spl_remove_slash_quotes( 'Boutons élégants de catégorie' );
		$language['FR']['Open_Buy_Btn_Link_In_New_Tab']        = df_spl_remove_slash_quotes( 'Open Buy Button Links in New Tab' );
		$language['FR']['Add_Search_Bar']                      = df_spl_remove_slash_quotes( 'Enable Search Box' );
		$language['FR']['Price_Range_Slider']                  = df_spl_remove_slash_quotes( 'Activer le curseur de fourchette de prix' );
		$language['FR']['Break_title_of_Service']              = df_spl_remove_slash_quotes( 'Casser le titre du service' );
		$language['FR']['Break_line_of_categories_on_Desktop'] = df_spl_remove_slash_quotes( 'Briser la ligne de catégories sur le bureau' );
		$language['FR']['Break_line_of_categories_on_Tablets'] = df_spl_remove_slash_quotes( 'Briser la ligne de catégories sur les tablettes' );
		$language['FR']['Price_List_Description']              = df_spl_remove_slash_quotes( 'Description de la liste de prix' );
		$language['FR']['Items_Price_Currency']                = df_spl_remove_slash_quotes( 'Sélectionnez la devise du prix (pour SEO JSON-LD)' );
		$language['FR']['Enable_Product_Seo_Schema']           = df_spl_remove_slash_quotes( 'Activer le schéma SEO du produit (JSON-LD)' );
		$language['FR']['Title']                               = df_spl_remove_slash_quotes( 'Titre' );
		$language['FR']['Category_Tabs']                       = df_spl_remove_slash_quotes( 'Catégorie (onglets)' );
		$language['FR']['Category_description_Tabs']           = df_spl_remove_slash_quotes( 'Description de la Catégorie (onglets)' );
		$language['FR']['Service_Name']                        = df_spl_remove_slash_quotes( 'Nom du service' );
		$language['FR']['Service_Regular_Price']               = df_spl_remove_slash_quotes( 'Prix régulier' );
		$language['FR']['Service_Long_Description']            = df_spl_remove_slash_quotes( 'Long Description' );
		$language['FR']['Service_Price']                       = df_spl_remove_slash_quotes( 'Prix' );
		$language['FR']['Service_Description']                 = df_spl_remove_slash_quotes( 'La description' );
		$language['FR']['Font_Size']                           = df_spl_remove_slash_quotes( 'Taille de police' );
		$language['FR']['Font_Color']                          = df_spl_remove_slash_quotes( 'Couleur de la police' );
		$language['FR']['Font_Style']                          = df_spl_remove_slash_quotes( 'Le style de police' );
		$language['FR']['Font_Weight']                         = df_spl_remove_slash_quotes( 'Poids de la police' );
		$language['FR']['Hover_Color']                         = df_spl_remove_slash_quotes( 'Couleur de vol stationnaire' );
		$language['FR']['Category_Name']                       = df_spl_remove_slash_quotes( 'Nom de catégorie' );
		$language['FR']['Category_Description']                = df_spl_remove_slash_quotes( 'description de la catégorie' );
		$language['FR']['Category_Background_Color']           = df_spl_remove_slash_quotes( 'Couleur de fond de catégorie' );
		$language['FR']['Category_Text_Color']                 = df_spl_remove_slash_quotes( 'Couleur de texte de catégorie' );
		$language['FR']['Category_Action_Text']                 = df_spl_remove_slash_quotes( 'Texto de acción de categoría' );
		$language['FR']['Category_Action_Link']                 = df_spl_remove_slash_quotes( 'Enlace de acción de categoría' );
		$language['FR']['Category_Image']                	   = df_spl_remove_slash_quotes( 'Image de couverture de la catégorie' );
		$language['FR']['Category_Price']                	   = df_spl_remove_slash_quotes( 'Prix de la catégorie' );
		$language['FR']['Category_Image_Overlay_Percent']      = df_spl_remove_slash_quotes( 'Catégorie Image de couverture Superposition sombre (%)' );
		$language['FR']['Category_Desc_Embed_To_Cover_Image_S10']      = df_spl_remove_slash_quotes( 'Incorporer le titre de la catégorie à l’image de couverture (style 10)' );
		$language['FR']['Service_Name']                        = df_spl_remove_slash_quotes( 'Nom du service' );
		$language['FR']['Service_Price']                       = df_spl_remove_slash_quotes( 'Prix' );
		$language['FR']['Service_Description_Length']          = df_spl_remove_slash_quotes( 'La description' );
		$language['FR']['Service_Button']                      = df_spl_remove_slash_quotes( 'Texte du bouton' );
		$language['FR']['Service_Button_URL']                  = df_spl_remove_slash_quotes( 'URL du bouton' );
		$language['FR']['Service_URL']                         = df_spl_remove_slash_quotes( 'URL du service' );
		$language['FR']['Remove_Service']                      = df_spl_remove_slash_quotes( 'Supprimer le service' );
		$language['FR']['Add_Service']                         = df_spl_remove_slash_quotes( 'Ajouter un service' );
		$language['FR']['Add_Category']                        = df_spl_remove_slash_quotes( 'ajouter une catégorie' );
		$language['FR']['Remove_Category']                     = df_spl_remove_slash_quotes( 'Supprimer la catégorie' );
		$language['FR']['Restore']                             = df_spl_remove_slash_quotes( 'Restaurer' );
		$language['FR']['Backup']                              = df_spl_remove_slash_quotes( 'Sauvegarde' );
		$language['FR']['Preview_List']                        = df_spl_remove_slash_quotes( 'Liste de prévisualisation' );
		$language['FR']['CATEGORY']                            = df_spl_remove_slash_quotes( 'CATÉGORIE' );
		$language['FR']['FONT_SETTINGS']                       = df_spl_remove_slash_quotes( 'PARAMÈTRES DE POLICE' );
		$language['FR']['ADD_TO_WEBPAGE']                      = df_spl_remove_slash_quotes( 'AJOUTER À LA PAGE WEB' );
		$language['FR']['Service_Image']                       = df_spl_remove_slash_quotes( 'Image de service' );
		//dutch
		$language['DE']['Remove_title']                        = df_spl_remove_slash_quotes( 'Titel verwijderen' );
		$language['DE']['Select_Language']                     = df_spl_remove_slash_quotes( 'Selecteer taal' );
		$language['DE']['Select_Column']                       = df_spl_remove_slash_quotes( 'Selecteer Kolom' );
		$language['DE']['Max_Width']                           = df_spl_remove_slash_quotes( 'Maximale wijdte' );
		$language['DE']['Save']                                = df_spl_remove_slash_quotes( 'Opslaan' );
		$language['DE']['Price_List_Name']                     = df_spl_remove_slash_quotes( 'Prijslijst naam' );
		$language['DE']['Select_Style']                        = df_spl_remove_slash_quotes( 'Selecteer stijl' );
		$language['DE']['More_Settings']                       = df_spl_remove_slash_quotes( 'Meer instellingen' );
		$language['DE']['Default_Tab']                         = df_spl_remove_slash_quotes( 'Standaard tabblad' );
		$language['DE']['Change_All_word_for_Categories']      = df_spl_remove_slash_quotes( 'Wijzig het woord "Alles" voor Categorieën' );
		$language['DE']['different_languages']                 = df_spl_remove_slash_quotes( 'verschillende talen' );
		$language['DE']['Display_the_All_word']                = df_spl_remove_slash_quotes( 'Toont het woord "Alles"?' );
		$language['DE']['Style4_Divider_Style']                = df_spl_remove_slash_quotes( 'Verdeelstijl (beschikbaar in Stijl4)' );
		$language['DE']['Category_Separator_Symbol']           = df_spl_remove_slash_quotes( 'Categorie scheidingsteken symbool' );
		$language['DE']['Arrange_Categories_In_Dropdown']      = df_spl_remove_slash_quotes( 'Arrange Categories In a Dropdown Choice' );
		$language['DE']['Categories_In_Dropdown_Prevent_Keyboard_Popup']      = df_spl_remove_slash_quotes( 'Prevent Keyboard Popup on Mobile Devices While Using Dropdown Menu for Categories' );
		$language['DE']['category_select_scroll_effect_label_text'] = df_spl_remove_slash_quotes( 'Enable Category Selection Scroll Effect' );
		$language['DE']['Category_Dropdown_Width']             = df_spl_remove_slash_quotes( 'Dropdown Width' );
		$language['DE']['Stylish_Category_Tabs_Buttons']       = df_spl_remove_slash_quotes( 'Stijlvolle knoppen voor categorietabs' );
		$language['DE']['Open_Buy_Btn_Link_In_New_Tab']        = df_spl_remove_slash_quotes( 'Open Buy Button Links in New Tab' );
		$language['DE']['Add_Search_Bar']                      = df_spl_remove_slash_quotes( 'Enable Search Box' );
		$language['DE']['Price_Range_Slider']                  = df_spl_remove_slash_quotes( 'Preisbereichsregler aktivieren' );
		$language['DE']['Break_title_of_Service']              = df_spl_remove_slash_quotes( 'Breek de titel van de service' );
		$language['DE']['Break_line_of_categories_on_Desktop'] = df_spl_remove_slash_quotes( 'Breek lijn van categorieën op Desktop' );
		$language['DE']['Break_line_of_categories_on_Tablets'] = df_spl_remove_slash_quotes( 'Breek lijn van categorieën op tablets' );
		$language['DE']['Price_List_Description']              = df_spl_remove_slash_quotes( 'Prijslijst beschrijving' );
		$language['DE']['Items_Price_Currency']                = df_spl_remove_slash_quotes( 'Preiswährung auswählen (für SEO JSON-LD)' );
		$language['DE']['Enable_Product_Seo_Schema']           = df_spl_remove_slash_quotes( 'Produkt-SEO-Schema aktivieren (JSON-LD)' );
		$language['DE']['Title']                               = df_spl_remove_slash_quotes( 'Titel' );
		$language['DE']['Category_Tabs']                       = df_spl_remove_slash_quotes( 'Categorie (tabbladen)' );
		$language['DE']['Category_description_Tabs']           = df_spl_remove_slash_quotes( 'beschrijving Categorie (tabbladen)' );
		$language['DE']['Service_Name']                        = df_spl_remove_slash_quotes( 'Servicenaam' );
		$language['DE']['Service_Regular_Price']               = df_spl_remove_slash_quotes( 'Normale prijs' );
		$language['DE']['Service_Long_Description']            = df_spl_remove_slash_quotes( 'Long Description' );
		$language['DE']['Service_Price']                       = df_spl_remove_slash_quotes( 'Prijs' );
		$language['DE']['Service_Description']                 = df_spl_remove_slash_quotes( 'Beschrijving' );
		$language['DE']['Font_Size']                           = df_spl_remove_slash_quotes( 'Lettertypegrootte' );
		$language['DE']['Font_Color']                          = df_spl_remove_slash_quotes( 'Letterkleur' );
		$language['DE']['Font_Style']                          = df_spl_remove_slash_quotes( 'Lettertype' );
		$language['DE']['Font_Weight']                         = df_spl_remove_slash_quotes( 'Lettertype dikte' );
		$language['DE']['Hover_Color']                         = df_spl_remove_slash_quotes( 'Kleur zweven' );
		$language['DE']['Category_Name']                       = df_spl_remove_slash_quotes( 'categorie naam' );
		$language['DE']['Category_Description']                = df_spl_remove_slash_quotes( 'categorie beschrijving' );
		$language['DE']['Category_Background_Color']           = df_spl_remove_slash_quotes( 'Categorie kleur' );
		$language['DE']['Category_Text_Color']                 = df_spl_remove_slash_quotes( 'Categorie tekst kleur' );
		$language['DE']['Category_Action_Text']                 = df_spl_remove_slash_quotes( 'Categorie actietekst' );
		$language['DE']['Category_Action_Link']                 = df_spl_remove_slash_quotes( 'Categorie actie link' );
		$language['DE']['Category_Price']                	   = df_spl_remove_slash_quotes( 'Categorie prijs' );
		$language['DE']['Category_Image']                	   = df_spl_remove_slash_quotes( 'Omslagafbeelding categorie' );
		$language['DE']['Category_Image_Overlay_Percent']      = df_spl_remove_slash_quotes( 'Categorie Omslagafbeelding Donkere overlay (%)' );
		$language['DE']['Category_Desc_Embed_To_Cover_Image_S10']      = df_spl_remove_slash_quotes( 'Categorietitel insluiten in de omslagafbeelding (stijl 10)' );
		$language['DE']['Service_Name']                        = df_spl_remove_slash_quotes( 'Servicenaam' );
		$language['DE']['Service_Price']                       = df_spl_remove_slash_quotes( 'Prijs' );
		$language['DE']['Service_Description_Length']          = df_spl_remove_slash_quotes( 'Beschrijving' );
		$language['DE']['Service_Button']                      = df_spl_remove_slash_quotes( 'Knop tekst' );
		$language['DE']['Service_Button_URL']                  = df_spl_remove_slash_quotes( 'Knop URL' );
		$language['DE']['Service_URL']                         = df_spl_remove_slash_quotes( 'Service URL' );
		$language['DE']['Remove_Service']                      = df_spl_remove_slash_quotes( 'Service verwijderen' );
		$language['DE']['Add_Service']                         = df_spl_remove_slash_quotes( 'Service toevoegen' );
		$language['DE']['Add_Category']                        = df_spl_remove_slash_quotes( 'categorie toevoegen' );
		$language['DE']['Remove_Category']                     = df_spl_remove_slash_quotes( 'Verwijder Categorie' );
		$language['DE']['Restore']                             = df_spl_remove_slash_quotes( 'Restaurer' );
		$language['DE']['Backup']                              = df_spl_remove_slash_quotes( 'Sauvegarde' );
		$language['DE']['Preview_List']                        = df_spl_remove_slash_quotes( 'Liste de prévisualisation' );
		$language['DE']['CATEGORY']                            = df_spl_remove_slash_quotes( 'CATEGORIE' );
		$language['DE']['FONT_SETTINGS']                       = df_spl_remove_slash_quotes( 'INSTELLINGEN VAN DE FONT' );
		$language['DE']['ADD_TO_WEBPAGE']                      = df_spl_remove_slash_quotes( 'VOEG TOE AAN WEBPAGE' );
		$language['DE']['Service_Image']                       = df_spl_remove_slash_quotes( 'Service afbeelding' );
		// return output
		return $language[ $lang ][ $keyword ];
	}
}

