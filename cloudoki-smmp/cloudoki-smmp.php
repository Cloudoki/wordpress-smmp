<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wordpress.org/plugins/cloudoki-smmp/
 * @since             1.0.0
 * @package           SMMP
 *
 * @wordpress-plugin
 * Plugin Name:       Cloudoki SMMP
 * Plugin URI:        https://wordpress.org/plugins/cloudoki-smmp/
 * Description:       The fully integrated Social Media Management Plugin for Wordpress
 * Version:           0.1
 * Author:            Cloudoki
 * Author URI:        http://cloudoki.com
 * License:           GPL2
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cloudoki-smmp-activator.php
 */
function activate_cloudoki_smmp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cloudoki-smmp-activator.php';
	SMMP_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cloudoki-smmp-deactivator.php
 */
function deactivate_cloudoki_smmp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cloudoki-smmp-deactivator.php';
	SMMP_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cloudoki_smmp' );
register_deactivation_hook( __FILE__, 'deactivate_cloudoki_smmp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cloudoki-smmp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cloudoki_smmp() {

	$plugin = new SMMP();
	$plugin->run();

}
run_cloudoki_smmp();
