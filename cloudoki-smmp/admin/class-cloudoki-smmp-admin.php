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

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $cloudoki_smmp       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $cloudoki_smmp, $version ) {

		$this->cloudoki_smmp = $cloudoki_smmp;
		$this->version = $version;

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
	public function admin_post_submitbox ()
	{
		$tempdata = array(
			'facebook' => array( 'status' => 'scheduled', 'type' => 'facebook' ),
			'twitter' => array( 'status' => 'unscheduled', 'type' => 'twitter' )
		);

		$status_class = 'published';

		$fb_active = $tempdata['facebook']['status'] == 'scheduled' || $tempdata['facebook']['status'] == 'published'? true: false;
		$twt_active = $tempdata['twitter']['status'] == 'scheduled' || $tempdata['twitter']['status'] == 'published'? true: false;

		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/smmp-admin-post-submitbox.php';
	}
	
	/**
	 * SMMP Publication List - admin page content.
	 *
	 * @since    1.0.0
	 */
	public function admin_page_list ()
	{
		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/smmp-admin-display-list.php';
	}
	
	/**
	 * SMMP Social Accounts - admin page content.
	 *
	 * @since    1.0.0
	 */
	public function admin_page_accounts ()
	{
		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/smmp-admin-display-accounts.php';
	}
	
	/**
	 * SMMP Settings - admin page content.
	 *
	 * @since    1.0.0
	 */
	public function admin_page_settings ()
	{
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