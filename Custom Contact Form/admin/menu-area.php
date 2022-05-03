<?php

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function ccf_add_sublevel_menu() {
	
	add_submenu_page(
		'options-general.php',
		'Custom Form Settings',
		'Custom Form',
		'manage_options',
		'Custom Form',
		'ccf_display_settings_page'
	);
	
}
add_action( 'admin_menu', 'ccf_add_sublevel_menu' );
