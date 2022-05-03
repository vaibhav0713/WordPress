<?php // ccf - Register Settings



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// register plugin settings
function ccf_register_settings() {


	register_setting(
		'ccf_options',
		'ccf_options',
		'ccf_callback_validate_options'
	);

	add_settings_section(
		'ccf_section_form',
		'Custom Contact Form Shortcode',
		'ccf_callback_section_form',
		'Custom Form'
	);

	add_settings_section(
		'ccf_section_table',
		'Table Display Shortcode',
		'ccf_callback_section_table',
		'Custom Form'
	);

// =======================================================================================================

	add_settings_field(
		'form_shortcode',
		'Form ShortCode',
		'ccf_callback_field_form',
		'Custom Form',
		'ccf_section_form',
		[ 'id' => 'form_shortcode', 'label' => 'Form ShortCode' ]
	);

    
	add_settings_field(
		'table_shortcode',
		'Table ShortCode',
		'ccf_callback_field_table',
		'Custom Form',
		'ccf_section_table',
		[ 'id' => 'table_shortcode', 'label' => 'Table ShortCode' ]
	);

}
add_action( 'admin_init', 'ccf_register_settings' );

