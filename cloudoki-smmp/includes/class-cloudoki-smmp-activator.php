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
	 *	SMMP Table injection
	 */
	static $table_sql = "CREATE TABLE %s (
		id int(11) NOT NULL AUTO_INCREMENT,
		post_id int(11) NOT NULL,
		parent_id int(11) NOT NULL,
		type varchar(32) DEFAULT '' NOT NULL,
		alteration text NOT NULL,
		publish_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		status varchar(32) DEFAULT '' NOT NULL,
		
		UNIQUE KEY id (id)
	) %s;";
	
	
	/**
	 * Add SMMP core functionalities.
	 *
	 * Activator adds A SMMP records table and basic option defaults.
	 *
	 * @since    1.0.0
	 */
	public static function activate ()
	{
		// Create or update db table
		self::generate_table ();
		
		// Create or update options
		self::generate_options ();
	}
	
	/**
	 *	Add The SMMP Wordpress Table
	 */
	public static function generate_table ()
	{
		global $wpdb;
		
		$table_name = $wpdb->prefix . "smmp";
		$charset_collate = $wpdb->get_charset_collate();
		
		require_once (ABSPATH . 'wp-admin/includes/upgrade.php' );
		
		dbDelta (sprintf ( self::$table_sql, $table_name, $charset_collate ));
	}
	
	/**
	 *	Add The SMMP Wordpress Options
	 */
	public static function generate_options ()
	{
		// Record db version
		add_option( "smmp_db_version", SMMP::$db_version );
		
		// View options
		add_option("smmp_view_sidebar", '1');
		add_option("smmp_view_footer", '1');
		add_option("smmp_view_dashboard", '1');
		add_option("smmp_view_submitbox", '1');
		
		// Short url for customised links
		add_option( "smmp_short_url", '' );
		
		// Facebook collection
		add_option( "smmp_facebook", '[]' );
		
		// Twitter collection
		add_option( "smmp_twitter", '[]' );
		
		// Facebook Account URL
		add_option( "smmp_url_facebook", '' );
		
		// Twitter Account URL
		add_option( "smmp_url_twitter", '' );
		
		// Instagram Account URL
		add_option( "smmp_url_instagram", '' );
		
		// Pinterest Account URL
		add_option( "smmp_url_pinterest", '' );
		
		// Google+ Account URL
		add_option( "smmp_url_googleplus", '' );
		
		// LinkedIn Account URL
		add_option( "smmp_url_linkedin", '' );
	}
}
