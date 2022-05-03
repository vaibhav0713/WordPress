<?php

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function contact_form_data(){

    if(isset($_POST['contact_form_submit'])){
        
        $data = array(
            'Full_Name' => $_POST['your_name'],
            'Email_Address' => $_POST['email_address'],
            'Mobile_Number' => $_POST['mobile_number'],
            'Message_Data' => $_POST['your_message']
        );

        $form_table_name = 'wp_contact_form_data';

        global $wpdb;
        
        $result = $wpdb -> insert($form_table_name, $data, $format = NULL);

        if($result == 1){
            echo "<script>alert('done');</script>";
        }

        else{
            echo "<script>alert('not done');</script>";
        }

    }
    // Email Notification after table entry
    if(isset($_POST['contact_form_submit'])){
        
        $name = sanitize_text_field($_POST['your_name']);
        $email = sanitize_text_field($_POST['email_address']);
        $mobile = sanitize_text_field($_POST['mobile_number']);
        $message = sanitize_text_field($_POST['your_message']);

        $headers = "Content-Type: text/html; charset=UTF-8\r\n";
        $to = 'vaibhav.panchal.lvits@gmail.com';
        $subject = "custom contact form data";
        $messages = "<strong>Name:</strong>" . "$name" . "<br>" ."<strong>Email:</strong>" . "$email" . "<br>" . "<strong>Mobile Number:</strong>" . "$mobile" . "<br>" . "<strong>Message Body:</strong>" . "$message";

        wp_mail($to, $subject, $messages, $headers);
    }
}

add_action('wp_head', 'contact_form_data');