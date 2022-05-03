<?php

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function contact_form_plugin(){
    $content = '';
    $content .= '<h2>Custom Contact Us Form</h2>';
    $content .= '<form method="POST">';
    $content .= '<input type="text" name="your_name" placeholder="Full Name" /><br />';
    $content .= '<input type="text" name="email_address" placeholder="Email Address" /><br />';
    $content .= '<input type="text" name="mobile_number" placeholder="Mobile Number" /><br />';
    $content .= '<textarea name="your_message" placeholder="Message Area"></textarea><br />';
    $content .= '<input type="submit" name="contact_form_submit" value="Submit Your Form" />';
    $content .= '</form>';
    return $content;
}

add_shortcode('custom-contact-form', 'contact_form_plugin');