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

include_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

/*
Useless, it's an exact copy
if ( ! class_exists( 'SMMP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-content/plugins/cloudoki-smmp/includes/class-smmp-list-table.php' );
}
*/

/*
Useless, you're inside the class

if ( ! class_exists( 'SMMP_Admin' ) ) {
	require_once( ABSPATH . 'wp-content/plugins/cloudoki-smmp/class-cloudoki-smmp-admin' );
}*/

class SMMP_Post_List extends WP_List_Table /*SMMP_List_Table*/ {
	
	
	/**
	 * The admin class, for smmp functions.
	 *
	 * @access   private
	 * @var      class    $admin
	 */
	private $admin;
	private $per_page = 25;

	public function __construct($admin_class) {

		$this->admin = $admin_class;
		
		$this->_args = [
			'singular' => sanitize_key(__( 'Post', 'sp' )),
			'plural'   => sanitize_key(__( 'Posts', 'sp' )),
			'ajax' => false
		];

		$this->screen = convert_to_screen(null);

		add_filter( "manage_{$this->screen->id}_columns", array( $this, 'get_columns' ), 0 );

		$this->modes = array(
			'list'    => __( 'List View' ),
			'excerpt' => __( 'Excerpt View' )
		);
	}

	// get/delete/sort methods

	/** Text displayed when no customer data is available */
	public function no_items() {
	  _e( 'No posts avaliable.');
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
	    '<input type="checkbox" name="bulk-select[]" value="%s" />', $item['id']
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
	    'type' => __('Social network'),
	    'status' => __('Status'),
	    'alteration' => __('Alteration'),
	    'publish_date' => __('Date')
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
	    'type' => __('Social network'),
	    'status' => __('Status'),
	    'publish_date' => __('Date')
	  );

	  return $sortable_columns;
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
  		
  		/** Process headers */
  		$this->_column_headers = array($columns, $hidden, $sortable);

  		/** Process bulk action */
  		$this->process_bulk_action();

  		/** Pagination */
  		$per_page     	= $this->per_page;
        $current_page 	= $this->get_pagenum();
        $offset 		= ($current_page - 1)*$per_page;
  		$total_items  	= $this->admin->count_smmp_posts();

  		$this->set_pagination_args( [
    		'total_items' => $total_items, 	//WE have to calculate the total number of items
    		'per_page'    => $per_page 		//WE have to determine how many items to show on a page
  		]);
  		
  		$posts = $this->admin->get_all_smmp_posts([], $offset, $per_page, 'ARRAY_A');
  		//wp_die(print_r($posts));
  	  	$this->items = (array)$posts;
	}
}
?>