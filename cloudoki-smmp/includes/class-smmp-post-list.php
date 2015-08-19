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
	private $total_posts;

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

	/**
	 * Generates a view link widget
	 *
	 * @param string 	$type 		The type of filtering (all, scheduled, pending)
	 * @param int 		$value 		Number of results
	 * @param string 	$current 	The current type selected (null for all)
	 */
	public function generate_view($type, $value, $current) {

		$all_inner_html = sprintf(
			_nx( ucfirst($type).' <span class="count">(%s)</span>',
				ucfirst($type).' <span class="count">(%s)</span>', $value, 'posts' ),
			number_format_i18n($value)
		);
		$q_string = $type == 'all'? '': '&type='.$type;
		$class = '';

		if ($type == 'all' && !$current)	$class = ' class="current"';
		else if ($type == $current)			$class = ' class="current"';

		return "<a href='admin.php?page=smmp-list$q_string'$class>" . $all_inner_html . '</a>';
	}

	/**
	 * Renders the all / pending / published links
	 *
	 * @return array
	 */
	public function get_views() {

		$published = $this->admin->count_smmp_posts([], ['published']);
		$pending = $this->admin->count_smmp_posts([], ['pending']);
		$all = $this->total_posts;

		$current = array_key_exists('type', $_REQUEST)? $_REQUEST['type']: null;
		$status_links = array();

		$status_links['all'] = $this->generate_view('all', $all, $current);
		$status_links['published'] = $this->generate_view('published', $published, $current);
		$status_links['pending'] = $this->generate_view('pending', $pending, $current);

		return $status_links;
	}

	/**
	 * Empty text
	 *
	 */
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
	 * Render the social icon
	 *
	 * @param array $item
	 *
	 * @return string
	 */
	public function column_social( $item ) {
	  return sprintf(
	    '<span class="dashicons dashicons-%s"></span>', $item['type']
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
	    'social' => __('Social network'),
	    'content' => __('Content'),
	    'status' => __('Status'),
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
	    'social' => __('Social network'),
	    'content' => __('Content'),
	    'status' => __('Status'),
	    'publish_date' => __('Date')
	  );

	  return $sortable_columns;
	}

	/**
	 * Default format for columns
	 *
	 * @return array
	 */
	public function column_default( $item, $column_name ) {

	    return $item[ $column_name ];
	}

	/**
	 * Handles data query and filter, sorting, and pagination.
	 *
	 */
	public function prepare_items() {

	  	$columns = $this->get_columns();
  		$hidden = array();
  		$sortable = $this->get_sortable_columns();
  		$type = array_key_exists('type', $_REQUEST)? $_REQUEST['type']: null;

  		/** Process headers */
  		$this->_column_headers = array($columns, $hidden, $sortable);

  		/** Process bulk action */
  		$this->process_bulk_action();

  		/** Pagination */
  		$per_page     	= $this->per_page;
  		$types 			= $type? array($type): [];

        $current_page 	= $this->get_pagenum();
        $offset 		= ($current_page - 1)*$per_page;
  		$this->total_posts = $this->admin->count_smmp_posts();

  		$this->set_pagination_args( [
    		'total_items' => $this->total_posts, 
    		'per_page'    => $per_page 			
  		]);
  		
  		/* Get & format posts */
  		$smmps = $this->admin->get_all_smmp_posts($types, $offset, $per_page, 'ARRAY_A');
  		$smmps = $this->add_posts_content($smmps);

  	  	$this->items = (array)$smmps;
	}

	/**
	 * Append content to smmp posts list
	 *
	 * @param array $smmps List of smmp entries
	 *
	 * @return aray $posts List of smmp merged with the original posts
	 */
	public function add_posts_content($smmps) {

		$posts = $smmps;

		foreach($smmps as $i => $smmp) {
			$post = get_post($smmp['post_id']);
			$posts[$i]['content'] = $smmp['alteration'] ?: 
									$post->post_excerpt ?: 
									substr($post->post_title.' '. strip_tags($post->post_content), 0, 114).'...';

		}

		return $posts;
	}
}
?>