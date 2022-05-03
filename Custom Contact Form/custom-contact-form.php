<?php
/*
Plugin Name: Custom Contact Form
Plugin URI: http://example.com
Description: This is a custom contact form, where admin can get the email as well as table entry. So anytime he/she can use it.
Version: 1.0
Author: Lion Vision Technology
*/

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $jal_db_version;
$jal_db_version = '1.0';

function jal_install() {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . 'contact_form_data';
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id int(5) NOT NULL AUTO_INCREMENT,
		Full_Name varchar(255) NOT NULL,
		Email_Address varchar(255) NOT NULL,
		Mobile_Number varchar(255) NOT NULL,
		Message_Data varchar(255) NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	add_option( 'jal_db_version', $jal_db_version );
}

register_activation_hook( __FILE__, 'jal_install' );

require_once plugin_dir_path( __FILE__ ) . 'admin/menu-area.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/settings-page.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/setting-register.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/settings-callback.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/table/display-table.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/table/table-entry.php';
require_once plugin_dir_path( __FILE__ ) . 'admin/form/create-form.php';