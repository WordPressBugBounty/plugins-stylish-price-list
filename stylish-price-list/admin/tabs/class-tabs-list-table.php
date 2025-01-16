<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}
/**
* List table class
*/
class Stylish_Price_List_Tabs_List extends \WP_List_Table {
	private $nonce;
	private $page_status;
	function __construct( $nonce ) {
		parent::__construct(
			array(
				'singular' => 'List',
				'plural'   => 'Lists',
				'ajax'     => false,
			)
		);
		$this->nonce = $nonce;
	}
	function get_table_classes() {
		return array( 'widefat', 'fixed', 'striped', $this->_args['plural'] );
	}
	/**
	 Message to show if no designation found

	 @return void
*/
	function no_items() {
		esc_html_e( 'No Lists Found', 'spl' );
	}
	/**
	 Default column values if no callback found

	 @param  object  $item
	 @param  string  $column_name

	 @return string
*/
	function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'id':
				return $item->id;
			case 'list_name':
				return $item->list_name;
			case 'shortcode':
				return $item->shortcode;
			default:
				return isset( $item->$column_name ) ? $item->$column_name : '';
		}
	}
	/**
	 Get the column names

	 @return array
*/
	function get_columns() {
		$columns = array(
			'cb'        => '<input type="checkbox" />',
			'id'        => __( 'List Name', 'spl' ),
			// 'list_name'      => __( 'List Name', 'spl' ),
			'shortcode' => __( 'Shortcode', 'spl' ),
		);
		return $columns;
	}
	/**
	 Render the designation name column

	 @param  object  $item

	 @return string
*/
	function column_id( $item ) {
		$actions              = array();
		$actions['edit']      = sprintf( '<a href="%s" data-id="%d" title="%s">%s</a>', admin_url( 'admin.php?page=spl-tabs&action=edit&id=' . $item->id ), $item->id, __( 'Edit this item', 'spl' ), __( 'Edit', 'spl' ) );
		$actions['duplicate'] = sprintf( '<a href="%s" data-id="%d" title="%s">%s</a>', admin_url( 'admin.php?page=spl-tabs&action=duplicate&id=' . $item->id . '&nonce=' . $this->nonce ), $item->id, __( 'Duplicate this item', 'spl' ), __( 'Duplicate', 'spl' ) );
		$actions['delete']    = sprintf( '<a href="%s" class="submitdelete" data-id="%d" title="%s">%s</a>', admin_url( 'admin.php?page=spl-tabs&action=delete&id=' . $item->id . '&nonce=' . $this->nonce ), $item->id, __( 'Delete this item', 'spl' ), __( 'Delete', 'spl' ) );
		return sprintf( '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url( 'admin.php?page=spl-tabs&action=edit&id=' . $item->id ), $item->list_name, $this->row_actions( $actions ) );
	}
	function column_refer( $item ) {
		return sprintf( '<a href="%s" data-id="%d" title="%s">%s</a>', admin_url( 'admin.php?page=spl-tabs&action=readonly&id=' . $item->id ), $item->id, __( '#' . $item->id, 'c9s' ), __( '#' . $item->id, 'c9s' ) );
	}
	/**
	 Get sortable columns

	 @return array
*/
	function get_sortable_columns() {
		$sortable_columns = array(
			'name' => array( 'name', true ),
		);
		return $sortable_columns;
	}
	/**
	 Set the bulk actions

	 @return array
*/
	function get_bulk_actions() {
		$actions = array(
			'delete' => __( 'Delete Selected Items', 'spl' ),
		);
		return $actions;
	}
	/**
	 Render the checkbox column

	 @param  object  $item

	 @return string
*/
	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="ids[]" value="%d" />',
			$item->id
		);
	}
	/**
	 Set the views

	 @return array
*/
	public function get_views_() {
		$status_links = array();
		$base_link    = admin_url( 'admin.php?page=sample-page' );
		foreach ( $this->counts as $key => $value ) {
			$class                = ( $key == $this->page_status ) ? 'current' : 'status-' . $key;
			$status_links[ $key ] = sprintf( '<a href="%s" class="%s">%s <span class="count">(%s)</span></a>', add_query_arg( array( 'status' => $key ), $base_link ), $class, $value['label'], $value['count'] );
		}
		return $status_links;
	}
	/**
	 Prepare the class items

	 @return void
*/
	function prepare_items() {
		$columns               = $this->get_columns();
		$hidden                = array();
		$sortable              = $this->get_sortable_columns();
		$this->_column_headers = array( $columns, $hidden, $sortable );
		$per_page              = 20;
		$current_page          = $this->get_pagenum();
		$offset                = ( $current_page - 1 ) * $per_page;
		// phpcs:ignore
		$this->page_status     = isset( $_GET['status'] ) ? sanitize_text_field( $_GET['status'] ) : '2';
		// phpcs:ignore
		$search                = isset( $_REQUEST['s'] ) ? sanitize_text_field( $_REQUEST['s'] ) : '';
		// only ncessary because we have sample data
		$args = array(
			'offset' => $offset,
			'number' => $per_page,
			'search' => '*' . $search . '*',
		);
		// phpcs:ignore
		if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
			// phpcs:ignore
			$args['orderby'] = sanitize_text_field($_REQUEST['orderby']);
			// phpcs:ignore
			$args['order']   = sanitize_text_field($_REQUEST['order']);
		}
		$this->items = df_spl_get_all_tabs( $args );
		$this->set_pagination_args(
			array(
				'total_items' => df_spl_get_tabs_count(),
				'per_page'    => $per_page,
			)
		);
	}
}
