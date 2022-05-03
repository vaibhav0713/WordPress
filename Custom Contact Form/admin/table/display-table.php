<?php

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function display_form_data(){
    global $wpdb;
    $db_result = $wpdb -> get_results("select * from wp_contact_form_data");
    ?>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($db_result as $data) { ?>
                <tr>
                    <td><?php echo $data -> Full_Name; ?></td>
                    <td><?php echo $data -> Email_Address; ?></td>
                    <td><?php echo $data -> Mobile_Number; ?></td>
                    <td><?php echo $data -> Message_Data; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php
}

add_shortcode('display-form-data', 'display_form_data');