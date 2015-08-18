<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wordpress.org/plugins/cloudoki-smmp/
 * @since      1.0.0
 *
 * @package    SMMP
 * @subpackage SMMP/admin/partials
 */

if ( ! class_exists( 'SMMP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-content/plugins/cloudoki-smmp/includes/class-smmp-list-table.php' );
}

if ( ! class_exists( 'SMMP_Admin' ) ) {
	require_once( ABSPATH . 'wp-content/plugins/cloudoki-smmp/class-cloudoki-smmp-admin' );
}

class SMMP_Post_List extends SMMP_List_Table {

	/** Class constructor */
	public function __construct() {

		parent::__construct( [
			'singular' => __( 'Post', 'sp' ), //singular name of the listed records
			'plural'   => __( 'Posts', 'sp' ), //plural name of the listed records
			'ajax'     => false //should this table support ajax?
		] );
	}

	// get/delete/sort methods

	/** Text displayed when no customer data is available */
	public function no_items() {
	  _e( 'No posts avaliable.', 'sp' );
	}

	/**
	 * Render the bulk edit checkbox
	 *
	 * @param array $item
	 *
	 * @return string
	 */
	public function column_cb( $item ) {
	  return sprintf(
	    '<input type="checkbox" name="bulk-select[]" value="%s" />', $item['ID']
	  );
	}

	/**
	 *  Associative array of columns
	 *
	 * @return array
	 */
	public function get_columns() {
	  $columns = [
	    'cb' => '<input type="checkbox" />',
	    'type' => __( 'Social network' ),
	    'post_content' => __( 'Content' ),
	    //'tags' => __( 'Tags' ),
	    //'related' => __( 'Related' ),
	    'publish_date' => __( 'Date' )
	  ];

	  return $columns;
	}

	/**
	 * Columns to make sortable.
	 *
	 * @return array
	 */
	public function get_sortable_columns() {
	  $sortable_columns = array(
	    'type' => __( 'Social network' ),
	    'post_content' => __( 'Content' ),
	    //'tags' => __( 'Tags' ),
	    //'related' => __( 'Related' ),
	    'publish_date' => __( 'Date' )
	  );

	  return $sortable_columns;
	}

	/*
	 * Temporary help function 
	 */
	public static function get_posts( $per_page = 25, $page_number = 1 ) {

	  	global $wpdb;

	  	$posts_table = 'wp_posts';
	  	$smmp_table = 'wp_smmp';
	  	$sql = "SELECT * FROM %s AS p INNER JOIN %s as s WHERE p.id = s.post_id";
		
		return $wpdb->get_results(sprintf( $sql, $posts_table, $smmp_table), 'ARRAY_A');
	}

	public function column_default( $item, $column_name ) {

	    return $item[ $column_name ];
	 }

	/**
	 * Handles data query and filter, sorting, and pagination.
	 */
	public function prepare_items() {

	  	$columns = $this->get_columns();
  		$hidden = array();
  		$sortable = array();
  		$this->_column_headers = array($columns, $hidden, $sortable);
  		//$admin = new SMMP_Admin('cloudoki-smmp', '1.0.0');

  	  	//$posts = $admin->get_smmp_posts();
  	  	$posts = self::get_posts();
  	  	//wp_die(print_r($posts));
  	  	$this->items = $posts;
	}
}
?>