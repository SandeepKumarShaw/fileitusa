<?php

/**
 * Fired during plugin activation
 *
 * @link       rrr
 * @since      1.0.0
 *
 * @package    Rs
 * @subpackage Rs/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Rs
 * @subpackage Rs/includes
 * @author     rrrrrrrrr <r@gmail.com>
 */
class Rs_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
		public static function activate() {
		global $wpdb;

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );


	 $table_name = $wpdb->prefix . 'services';
	 $sql = "CREATE TABLE $table_name (
	 id int(10)  NOT NULL AUTO_INCREMENT,
	 name varchar(200) NOT NULL,
	 created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	 updated_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	 status ENUM('0','1') default '1' NOT NULL,
	 PRIMARY KEY  (id)
	 );";
	 dbDelta( $sql );


	 $table_name = $wpdb->prefix . 'product_addon';
	 $sql = "CREATE TABLE $table_name (
	 id int(10)  NOT NULL AUTO_INCREMENT,
	 title varchar(200) NOT NULL,
	 description text NOT NULL,
	 image varchar(200) NOT NULL,
	 service_id varchar(200) NOT NULL,
	 product_price text NOT NULL,
	 created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	 updated_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	 PRIMARY KEY  (id)
	 );";	 
	 dbDelta( $sql );

	 $table_name = $wpdb->prefix . 'ratesheet';
	 $sql = "CREATE TABLE $table_name (
	 rs_id int(10)  NOT NULL AUTO_INCREMENT,
	 rs_serviceid int(10) NOT NULL,
	 rs_state varchar(2) NOT NULL,
	 rs_price DECIMAL(10,2) default '0.00' NOT NULL,
	 created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	 updated_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	 PRIMARY KEY  (rs_id)
	 );";	 
	 dbDelta( $sql );


	 $table_name = $wpdb->prefix . 'expedite';
	 $sql = "CREATE TABLE $table_name (
	 ex_id int(10)  NOT NULL AUTO_INCREMENT,
	 ex_serviceid int(10) NOT NULL,
	 ex_state varchar(2) NOT NULL,
	 ex_time varchar(200) NOT NULL,
	 ex_price DECIMAL(10,2) default '0.00' NOT NULL,
	 created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	 updated_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
	 PRIMARY KEY  (ex_id)
	 );";
	 dbDelta( $sql );
	  update_option( 'plugin_error',  ob_get_contents() );
	}

	 

}
