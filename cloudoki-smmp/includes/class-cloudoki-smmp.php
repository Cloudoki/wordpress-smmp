<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://wordpress.org/plugins/cloudoki-smmp/
 * @since      1.0.0
 *
 * @package    SMMP
 * @subpackage SMMP/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    SMMP
 * @subpackage SMMP/includes
 * @author     Koen Betsens
 */
class SMMP {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      SMMP_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $cloudoki_smmp    The string used to uniquely identify this plugin.
	 */
	protected $cloudoki_smmp;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	static $version = "1.0.0";
	
	/**
	 * The current version of the plugin db.
	 *
	 * @since    1.0.0
	 * @access   static
	 * @var      string    $db_version    The current version of the plugin db.
	 */
	static $db_version = "1.0.0";

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->cloudoki_smmp = 'cloudoki-smmp';

		$this->load_dependencies();
		
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - SMMP_Loader. Orchestrates the hooks of the plugin.
	 * - SMMP_i18n. Defines internationalization functionality.
	 * - SMMP_Admin. Defines all hooks for the admin area.
	 * - SMMP_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		$plugin_path = plugin_dir_path( dirname( __FILE__ ) );
		
		
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once $plugin_path . 'includes/class-cloudoki-smmp-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once $plugin_path . 'includes/class-cloudoki-smmp-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once $plugin_path . 'admin/class-cloudoki-smmp-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once $plugin_path . 'public/class-cloudoki-smmp-public.php';

		$this->loader = new SMMP_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the SMMP_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new SMMP_i18n();
		$plugin_i18n->set_domain( $this->get_cloudoki_smmp() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new SMMP_Admin( $this->get_cloudoki_smmp(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		// Load Menu injection
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'plugin_menu' );
		
		// Load Dashboard widget
		$this->loader->add_action( 'wp_dashboard_setup', $plugin_admin, 'admin_dashboard' );
		
		// Load Edit Post additions
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'admin_post' );
		$this->loader->add_action( 'post_submitbox_misc_actions', $plugin_admin, 'admin_post_submitbox' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'admin_post_submitbox_submit');
		
		
		// Load Expired Account notice
		try { $plugin_admin->validate_accounts (); }
		catch (Exception $e)
		{
			$this->loader->add_action( 'admin_notices', $plugin_admin, 'notice_accounts' );
		}
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{
		$plugin_public = new SMMP_Public( $this->get_cloudoki_smmp(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_cloudoki_smmp()
	{
		return $this->cloudoki_smmp;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    SMMP_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return self::$version;
	}

}
