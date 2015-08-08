<?php

/**
 * Fired during plugin activation
 *
 * @link       https://wordpress.org/plugins/cloudoki-smmp/
 * @since      1.0.0
 *
 * @package    SMMP
 * @subpackage SMMP/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    SMMP
 * @subpackage SMMP/includes
 * @author     Koen Betsens
 */
class SMMP_Activator {

	/**
	 * Add SMMP core functionalities.
	 *
	 * Activator adds A SMMP records table and basic option defaults.
	 *
	 * @since    1.0.0
	 */
	public static function activate ()
	{

	}
	
	/**
	 *	Add The SMMP Wordpress Table
	 */
	public static function generate_table ()
	{
		global $wpdb;

		$table_name = $wpdb->prefix . "smmp";
	}

}
