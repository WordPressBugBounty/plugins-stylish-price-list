<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class SPLBackupRestore {
	public function __construct() {
		add_action( 'admin_post_spl_generate_backup', array( $this, 'handle_backup' ) );
		add_action( 'admin_post_spl_restore_backup', array( $this, 'handle_restore' ) );
	}

	// create a file pointer connected to the output stream
	private function ExportCSVFile( $records ) {
		$fh      = fopen( 'php://output', 'w' );
		$heading = false;
		if ( ! empty( $records ) ) {
			foreach ( $records as $row ) {
				if ( ! $heading ) {
					// output the column headings
					fputcsv( $fh, array_keys( $row ) );
					$heading = true;
				}
				$v = array_values( $row );
				// loop over the rows, outputting them
				fputcsv( $fh, $v );
			}
		}
		fclose( $fh );
		ob_end_flush();
		die();
	}

	public function handle_backup() {
		check_ajax_referer( 'spl_backup_nonce' );
		$id        = absint( $_POST['list_id'] );
		$cats_data = df_spl_get_option( $id );
		$data      = array(
			'0' => array(
				'List Name'                     => $cats_data['list_name'],
				'Tab Style'                     => $cats_data['tab_style'],
				'Default Tab'                   => $cats_data['default_tab'],
				'All Tab'                       => $cats_data['all_tab'],
				'Toggle All Tab'                => $cats_data['toggle_all_tab'],
				'Toggle'                        => $cats_data['toggle'],
				'Style Cat Tab Btn'             => $cats_data['style_cat_tab_btn'],
				'Price List Desc'               => $cats_data['price_list_desc'],
				'Title Font Size'               => $cats_data['title_font_size'],
				'Title Color Top'               => $cats_data['title_color_top'],
				'List Name Font'                => $cats_data['list_name_font'],
				'Tab Font Size'                 => $cats_data['tab_font_size'],
				'Title Color'                   => $cats_data['title_color'],
				'Title Font'                    => $cats_data['title_font'],
				'Service Font Size'             => $cats_data['service_font_size'],
				'Service Color'                 => $cats_data['service_color'],
				'Desc Font'                     => $cats_data['desc_font'],
				'Hover Color'                   => $cats_data['hover_color'],
				'Service Price Font Size'       => $cats_data['service_price_font_size'],
				'Price Color'                   => $cats_data['price_color'],
				'Price Font'                    => $cats_data['price_font'],
				'category'                      => json_encode( $cats_data['category'] ),
				'Title Font Weight'             => $cats_data['title_font-weight'],
				//'Title Font Weight'=>$cats_data['font-weight'],
				'Tab Font Weight'               => $cats_data['tab_font-weight'],
				'Service Font Weight'           => $cats_data['service_font-weight'],
				'Service Price Font Weight'     => $cats_data['service_price_font-weight'],
				'Service Description Font Size' => $cats_data['service_description_font_size'],
				'Service Description Color'     => $cats_data['service_description_color'],
				'Service Description Font'      => $cats_data['service_description_font'],
				'Description Font Weight'       => $cats_data['description_font-weight'],
				'Tab Description Font Size'     => $cats_data['tab_description_font_size'],
				'Tab Description Color'         => $cats_data['tab_description_color'],
				'Tab Description Font'          => $cats_data['tab_description_font'],
				'Tab Description Font Weight'   => $cats_data['tab_description_font-weight'],
				'Field Id'                      => $cats_data['field_id'],
				'ID'                            => $cats_data['id'],
				'Font Source'                   => $cats_data['font_source'],
			),
		);
		/***export data***/
		$filename = sanitize_text_field( $_POST['backup'] ) . '.csv';
		header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
		header( 'Content-type: text/csv' );
		header( "Content-Disposition: attachment; filename=\"$filename\"" );
		$this->ExportCSVFile( $data );
	}

	public function handle_restore() {
		check_ajax_referer( 'spl_restore_nonce' );
		$dir          = plugin_dir_path( __FILE__ );
		$allowed      = array( 'csv' );
		$filename     = spl_stripDotsFromFilename( $_FILES['importtocsv']['name'] );
		$tmp_filename = $_FILES['importtocsv']['tmp_name'];
		$ext          = pathinfo( $filename, PATHINFO_EXTENSION );
		if ( ! in_array( $ext, $allowed ) ) {
			// show error message
			$message = 'Invalid file type, please use .CSV file!';
		} else {
			// move_uploaded_file( $tmp_filename, $dir . 'upload-csv/' . $filename );
			// $file = $dir . 'upload-csv/' . $filename;
			// skipped moving the file to WordPress installation directory for better security
			$file = $tmp_filename;
			$file = fopen( $file, 'r' );
			// echo $randnum = rand(1000000000,9999999999);
			$file_data = array();
			while ( ( $emapData = fgetcsv( $file, 10000, ',' ) ) !== false ) {
				$file_data[] = $emapData;
				//
				/*$sql = "INSERT into tableName(name,email,address) values('$emapData[0]','$emapData[1]','$emapData[2]')";
				mysql_query($sql);*/
			}
			$catdata = json_decode( $file_data[1][21], 1 );
			//echo "<pre>"; print_r($catdata);
			$rand_num = rand( (int) 1000000000, (int) 9999999999 );
			$data     = array(
				'list_name'                     => ( $file_data[1][0] ) . ' restored',
				'tab_style'                     => $file_data[1][1],
				'default_tab'                   => $file_data[1][2],
				'all_tab'                       => $file_data[1][3],
				'toggle_all_tab'                => $file_data[1][4],
				'toggle'                        => $file_data[1][5],
				'style_cat_tab_btn'             => $file_data[1][6],
				'price_list_desc'               => $file_data[1][7],
				'title_font_size'               => $file_data[1][8],
				'title_color_top'               => $file_data[1][9],
				'list_name_font'                => $file_data[1][10],
				'tab_font_size'                 => $file_data[1][11],
				'title_color'                   => $file_data[1][12],
				'title_font'                    => $file_data[1][13],
				'service_font_size'             => $file_data[1][14],
				'service_color'                 => $file_data[1][15],
				'desc_font'                     => $file_data[1][16],
				'hover_color'                   => $file_data[1][17],
				'service_price_font_size'       => $file_data[1][18],
				'price_color'                   => $file_data[1][19],
				'price_font'                    => $file_data[1][20],
				'category'                      => $catdata,
				'title_font-weight'             => $file_data[1][22],
				'tab_font-weight'               => $file_data[1][23],
				'service_font-weight'           => $file_data[1][24],
				'service_price_font-weight'     => $file_data[1][25],
				'service_description_font_size' => $file_data[1][26],
				'service_description_color'     => $file_data[1][27],
				'service_description_font'      => $file_data[1][28],
				'description_font-weight'       => $file_data[1][29],
				'tab_description_font_size'     => $file_data[1][30],
				'tab_description_color'         => $file_data[1][31],
				'tab_description_font'          => $file_data[1][32],
				'tab_description_font-weight'   => $file_data[1][33],
				'font_source'                   => $file_data[1][36],
				'field_id'                      => $rand_num,
				'id'                            => $rand_num,
			);
			update_option( 'spl_cats_' . $rand_num, $data );
			$url = admin_url() . '/admin.php?page=spl-tabs&action=edit&id=' . $rand_num;
			fclose( $file );
			header( 'Location: ' . $url );
			exit;
		}
	}
}

new SPLBackupRestore();

/****Import data****/
function spl_stripDotsFromFilename( $string ) {
	$lastDot = strrpos( $string, '.' );
	$string  = str_replace( '.', '', substr( $string, 0, $lastDot ) ) . substr( $string, $lastDot );
	return sanitize_file_name( $string );
}

