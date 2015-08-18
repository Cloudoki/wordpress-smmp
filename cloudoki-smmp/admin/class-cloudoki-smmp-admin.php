<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wordpress.org/plugins/cloudoki-smmp/
 * @since      1.0.0
 *
 * @package    SMMP
 * @subpackage SMMP/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    SMMP
 * @subpackage SMMP/admin
 * @author     Koen Betsens
 */

if ( ! class_exists( 'SMMP_List_Post' ) ) {
	require_once( ABSPATH . 'wp-content/plugins/cloudoki-smmp/includes/class-smmp-post-list.php' );
}

class SMMP_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $cloudoki_smmp    The ID of this plugin.
	 */
	private $cloudoki_smmp;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	
	private $table_name;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $cloudoki_smmp       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $cloudoki_smmp, $version ) {

		global $wpdb;
	
		$this->cloudoki_smmp = $cloudoki_smmp;
		$this->version = $version;
		
		$this->table_name = $wpdb->prefix . "smmp";

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in SMMP_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The SMMP_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->cloudoki_smmp, plugin_dir_url( __FILE__ ) . 'css/cloudoki-smmp-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in SMMP_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The SMMP_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->cloudoki_smmp, plugin_dir_url( __FILE__ ) . 'js/cloudoki-smmp-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Navigation injection into the admin area.
	 *
	 * @since    1.0.0
	 */
	public function plugin_menu ()
	{

		add_menu_page( 'Cloudoki SMMP', 'SMMP', 'manage_options', 'smmp', array( $this, 'admin_page_list' ), 'dashicons-heart', 28 );
		
		add_submenu_page( 'smmp', 'SMMP Publications', 'All Publications', 'manage_options', 'smmp-list', array( $this, 'admin_page_list' ));
		add_submenu_page( 'smmp', 'SMMP Social Accounts', 'Social Accounts', 'manage_options', 'smmp-accounts', array( $this, 'admin_page_accounts' ));
		add_submenu_page( 'smmp', 'SMMP Settings', 'SMMP Settings', 'manage_options', 'smmp-settings', array( $this, 'admin_page_settings' ));
		
		remove_submenu_page('smmp', 'smmp');
	}
	
	/**
	 * Plugin widget injection into the admin dashboard.
	 *
	 * @since    1.0.0
	 */
	public function admin_dashboard ()
	{
		wp_add_dashboard_widget( 'smmp-widget', 'Social Publications', array( $this, 'admin_dashboard_widget' ));
	}
	
	/**
	 * Metabox injection into the admin edit post page.
	 *
	 * @since    1.0.0
	 */
	public function admin_post()
	{
		add_meta_box( 'smmp-edit-post', 'Social Publishing', array( $this, 'admin_post_metabox' ), null, 'advanced');
	}
	
	/**
	 * Metabox display.
	 *
	 * @since    1.0.0
	 */
	public function admin_post_metabox ()
	{
		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/smmp-admin-post-metabox.php';
	}
	
	/**
	 * Buttons injection into the admin edit post submitbox.
	 *
	 * @since    1.0.0
	 */
	public function admin_post_submitbox ($post_id)
	{	
		// update this to dynamic
		$tempdata = array(
			'facebook' => array( 'status' => 'pending', 'type' => 'facebook' ),
			'twitter' => array( 'status' => '', 'type' => 'twitter' )
		);

		$post_status = get_post_status($post_id);
		$status_class = $post_status == 'future'? 'pending': $post_status;

		$fb_active = in_array($tempdata['facebook']['status'], array('pending', 'published'));
		$fb_active_class = $fb_active? 'active': '';
		$fb_checked = $fb_active? 'checked': '';

		$twt_active = in_array($tempdata['twitter']['status'], array('pending', 'published'));
		$twt_active_class = $twt_active? 'active': '';
		$twt_checked = $twt_active? 'checked': '';

		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/smmp-admin-post-submitbox.php';
	}

	/**
	 * Reads the submibox's toggles on submit - remake in a dynamic way
	 *
	 * @since    1.0.0
	 */
	public function admin_post_submitbox_submit ($post_id) {

		$types = $this->available_types();
		$posts = $this->get_smmp_posts($post_id, $types);
		$toggled = [];

		// Get toggled status
		foreach($types as $type) {
			if (array_key_exists('smmp-share-'.$type, $_POST)) {
				$toggled[] = $type;
			}
		}

		// Mark as deleted
		foreach($posts as $post) {
			if (!in_array($post['type'], $toggled)) {
				// set the delete status
			} else {
				// update
			}
		}

		// Add unexisting
		//$this->queue_smmp_posts($post_id, $toggled);

		foreach($types as $type) {
			
		}

		if ($_POST['smmp-share-facebook']) $this->queue_smmp_post($post_id, 'facebook');
		if ($_POST['smmp-share-twitter']) $this->queue_smmp_post($post_id, 'twitter');
	}
	
	/**
	 * SMMP Publication List - admin page content.
	 *
	 * @since    1.0.0
	 */
	public function admin_page_list ()
	{
		$title = get_admin_page_title();
		//$shares = get_smmp_posts();
		$posts = query_posts(array('post__in' => array(2754)));
		// merge posts with smmp entries
		//wp_die(print_r($posts));
		$smmp_posts = new SMMP_Post_List($this);

		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/smmp-admin-display-list.php';
	}
	
	/**
	 * SMMP Social Accounts - admin page content.
	 *
	 * @since    1.0.0
	 */
	public function admin_page_accounts ()
	{
		
		if ($_GET['update'])
		{
			update_option ('smmp_url_facebook', $_GET['smmp_url_facebook']);
			update_option ('smmp_url_twitter', $_GET['smmp_url_twitter']);
			update_option ('smmp_url_instagram', $_GET['smmp_url_instagram']);
			update_option ('smmp_url_pinterest', $_GET['smmp_url_pinterest']);
			update_option ('smmp_url_googleplus', $_GET['smmp_url_googleplus']);
			update_option ('smmp_url_linkedin', $_GET['smmp_url_linkedin']);
		}
		
		$page = $_GET['page'];
		$title = get_admin_page_title();
		
		$options = [
			'smmp_url_facebook'=> get_option ('smmp_url_facebook'),
			'smmp_url_twitter'=> get_option ('smmp_url_twitter'),
			'smmp_url_instagram'=> get_option ('smmp_url_instagram'),
			'smmp_url_pinterest'=> get_option ('smmp_url_pinterest'),
			'smmp_url_googleplus'=> get_option ('smmp_url_googleplus'),
			'smmp_url_linkedin'=> get_option ('smmp_url_linkedin')
		];

		
		// Facebook settings
		$facebook = $this->facebook_settings();
		$facebook_path = plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/smmp-admin-display-accounts-facebook.php';
		
		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/smmp-admin-display-accounts.php';
	}
	
	/**
	 * SMMP Social Accounts - Facebook settings.
	 *
	 * @since    1.0.0
	 */
	public function facebook_settings ()
	{
		$facebook = json_decode (get_option ('smmp_facebook')?: "{}");
		
		// Facebook update
		if($_GET['admin-update'])
		{
			if( isset ($_GET['facebook-profile']))	$facebook->profile = $_GET['facebook-profile'];
			if( isset ($_GET['facebook-id']))		$facebook->id = $_GET['facebook-id'];
			if( isset ($_GET['facebook-primary']))	$facebook->primary = $_GET['facebook-primary'];
		
			// Facebook pages
			$pages = [];
			foreach($_GET as $key => $token)
			{
				if(substr($key, 0, 3) == 'fb-')
				
					$pages[$key] = strlen($token) < 12? $facebook->pages->{$key}: 
					(object)[
						'name'=> ucwords (implode (' ', array_slice (explode ('-', $key), 1))),
						'access_token'=> $token,
						'slug'=> $key
					];
			}
			
			// Prevent primary orphan
			if ($facebook->primary && !isset ($pages[$facebook->primary]))
				$facebook->primary = null;
			
			// Update
			$facebook->pages = (object) $pages;
			update_option ('smmp_facebook', json_encode($facebook));
		}
		
		return $facebook;
	}
	
	/**
	 * SMMP Settings - admin page content.
	 *
	 * @since    1.0.0
	 */
	public function admin_page_settings ()
	{
		$title = get_admin_page_title();

		if ($_GET['update'])
		{
			update_option ('smmp_view_sidebar', isset ($_GET['smmp_view_sidebar'])? 1: '');
			update_option ('smmp_view_footer', isset ($_GET['smmp_view_footer'])? 1: '');
			update_option ('smmp_view_dashboard', isset ($_GET['smmp_view_dashboard'])? 1: '');
			update_option ('smmp_view_submitbox', isset ($_GET['smmp_view_submitbox'])? 1: '');
		}
		
		$page = $_GET['page'];
		
		$options = [
			'smmp_view_sidebar'=> get_option ('smmp_view_sidebar'),
			'smmp_view_footer'=> get_option ('smmp_view_footer'),
			'smmp_view_dashboard'=> get_option ('smmp_view_dashboard'),
			'smmp_view_submitbox'=> get_option ('smmp_view_submitbox')
		];
		
		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/smmp-admin-display-settings.php';
	}
	
	/**
	 * SMMP Widget - admin dashboard content.
	 *
	 * @since    1.0.0
	 */
	public function admin_dashboard_widget ()
	{
		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/smmp-admin-dashboard-widget.php';
	}
	
	/**
	 * SMMP Posts.
	 *
	 * Get, Queue or delete SMMP posts, based on WP posts.
	 * Caution: the paramaters are strictly typed.
	 *
	 * @since    1.0.0
	 */
	 
	/**
	 *	Get available types
	 *
	 *	@return	object
	 */
	public function available_types ()
	{
		$facebook = json_decode (get_option ('smmp_facebook'));
		$twitter = json_decode (get_option ('smmp_twitter'));
		
		$list = [];
		
		// Check Facebook
		if (count ($facebook))
		{
			$list[] = 'facebook';
			foreach ($facebook->pages as $page)
			
				$list[] = sprintf ("facebook-%s", sanitize_title ($page->name)); 
		}
		
		// Check twitter
		if (count ($twitter)) $list[] = 'twitter';
		
		// result
		return $list;
	}
	
	/**
	 *	Get smmp record, on id
	 *
	 *	@param	int		$smmp_id	id of smmp record
	 *	@return	object
	 */
	public function get_smmp_post ($smmp_id)
	{
		global $wpdb;
		
		return $wpdb->get_row(sprintf( "SELECT * FROM %s WHERE id = %d", $this->table_name, $smmp_id));
	}
	
	/**
	 *	Get smmp all records
	 *
	 *	@param	array	$stata		array of smmp post statusses
	 *	@param	int		$offset		start from offset count
	 *	@param	int		$amount		limitation on response list
	  *	@return	array
	 */
	public function get_all_smmp_posts ($stata=[], $offset=null, $amount=null, $array=false)
	{
		global $wpdb;
		$limit_query = "";
		
		// get stata
		$status_query = $stata && count($stata)? sprintf( " WHERE status IN('%s')", implode("','", $stata)): "";
		
		// get limits
		if ($offset || $amount)
		
			$limit_query = $offset?
				sprintf (" LIMIT %d,%d", $offset, $amount?: 1000000000):
				sprintf (" LIMIT %d", $amount);
				
		return $wpdb->get_results(sprintf( "SELECT * FROM %s%s%s", $this->table_name, $status_query, $limit_query), $array? 'ARRAY_A': 'OBJECT');
	}
	
	/**
	 *	Get smmp records
	 *
	 *	@param	int		$post_id	id of wp post record
	 *	@param	array	$types		list of types
	 *	@param	string	$status		smmp record status
	  *	@return	object
	 */
	public function get_smmp_posts ($post_id, $types = null, $status = null)
	{
		global $wpdb;
		
		$types_query = $types? sprintf( " AND type IN('%s')", implode("','", $types)): "";
		$status_query = $status? sprintf( " AND status = '%s'", $status): "";
		
		return $wpdb->get_results(sprintf( "SELECT * FROM %s WHERE post_id = %d%s%s", $this->table_name, $post_id, $types_query, $status_query));
	}
	 
	/**
	 *	Queue smmp publication
	 *
	 *	@param	int		$post_id	id of wp post record
	 *	@param	string	$type		type of smmp record	
	 */
	public function queue_smmp_post ($post_id, $type)
	{
		global $wpdb;

		return $wpdb->insert( $this->table_name, 
		[ 
			'post_id' => (int) $post_id, 
			'type' => $type,
			'status' => 'pending'
		]);
	}
	
	/**
	 *	Queue smmp multiple publications
	 */
	public function queue_smmp_posts ($post_id, $typelist)
	{
		foreach ($typelist as $type)
		
			$this->queue_smmp_post ($post_id, $type);
	}
	
	/**
	 *	Update smmp post record
	 *	
	 *	@param	mixed	$identifier	smmp record id or tuple (array) with post id and smmp record type
	 *	@param	array	$contents	the fields to be updated
	 */
	public function update_smmp_post ($identifier, $status, $alteration, $publish_date)
	{
		global $wpdb;
		
		// define 
		
		$wpdb->update( $this->table_name, 
			$data, 
			$where, 
			$format = null, 
			$where_format = null
		);
	}
	
	/**
	 *	Update smmp post records
	 */
	public function update_smmp_posts ($post_id, $typelist)
	{
		foreach ($typelist as $type)
		
			$this->queue_smmp_post ($post_id, $type);
	}
	
	
	/**
	 *	Delete one or more smmp publications
	 */
	public function delete_smmp_post ($post_id, $type = null)
	{
		global $wpdb;
		
		// if no type is given, all records should be flagged deleted.
	}
	
	/**
	 * SMMP Social Accounts - validate.
	 *
	 * Social Accounts should be labeled if authentication is expired.
	 * User action is required: re-connect or remove
	 *
	 * @since    1.0.0
	 */
	public function validate_accounts ()
	{
		return null;
	}
	
	/**
	 * SMMP Notices - account.
	 *
	 * A notice about expired Social Accounts should be displayed
	 *
	 * @since    1.0.0
	 */
	public function notice_accounts ()
	{
		echo "<div class='update-nag'><strong>Cloudoki SMMP - </strong> One or more Social Account connections have expired. Please update.</div>\n";
	}
}