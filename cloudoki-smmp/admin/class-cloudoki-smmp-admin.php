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

}
