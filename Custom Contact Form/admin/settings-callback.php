<?php

// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// callback: validate options
function ccf_callback_validate_options( $input ) {
	return $input;
}

// callback: login section
function ccf_callback_section_form() {
	echo '<p>Copy the shortcode and place it where you want to display your custom form.</p>';
}

// callback: admin section
function ccf_callback_section_table() {
	echo '<p>Copy the shortcode and place it where you want to display your custom form entries in table.</p>';
}

// callback: text field
function ccf_callback_field_form( $args ) {
	echo '[custom-contact-form]';
}

// callback: text field
function ccf_callback_field_table( $args ) {
	echo '[display-form-data]';
}