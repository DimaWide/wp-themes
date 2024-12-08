<?php

/*
* plug for vs
*/
if (false) {
    function get_field() {
    }
    function acf_add_options_page() {
    }
    function get_sub_field() {
    }
    function have_rows() {
    }
    function the_row() {
    }
    function get_row_layout() {
    }
    function wc_get_product() {
    }
}

/*
* Page Slug Body Class
*/
function add_slug_body_class($classes) {
    global $post;
    if (isset($post)) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    }
    return $classes;
}
add_filter('body_class', 'add_slug_body_class');

/*
* YS_Mail
*/
class YS_Mail {

    public function YS_Mail() {
    }

    public function enviar($e) {

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "X-Mailer: PHP \r\n";
        $headers .= 'From: ' . $e['from_name']  . " <" . $e['from_mail'] . ">\r\n";

        if (isset($e['attachment'])) {
            $allowed =  array('gif', 'png', 'jpg', 'doc', 'docx', 'odt', 'pdf', 'zip', 'rar', '7zip');
            $ext = pathinfo($e['attachment']['name'], PATHINFO_EXTENSION);
            if (in_array($ext, $allowed)) {
                move_uploaded_file($e['attachment']['tmp_name'], WP_CONTENT_DIR . '/uploads/' . basename($e['attachment']['name']));
                $anexo = WP_CONTENT_DIR . '/uploads/' . basename($e['attachment']['name']);
                $return = wp_mail($e['to_mail'], $e['subject'], $e['message'], $headers, $anexo);
                unlink($anexo);
            } else {
                $return = false;
            }
        } else {
            $return = wp_mail($e['to_mail'], $e['subject'], $e['message'], $headers);
        }

        return $return;
    }
}


function form_a_handle() {
    $file = '';
    $field_name = $_POST['field_name'];
    $field_email = $_POST['field_email'];
    $field_phone = $_POST['field_phone'];
    $field_type_job = $_POST['field_type_job'];
    $field_link = $_POST['field_link'];
    $field_message = $_POST['field_message'];
    $data_out = [];
    $ysmail = new YS_Mail();

    if (isset($_POST['field_recaptha'])) {
        $captcha = $_POST['field_recaptha'];
        $recaptcha = get_field('recaptcha', 'option');
    } else {
        $captcha = false;
    }

    if (!$captcha) {
        //Do something with error
    } else {
        $secret   = $recaptcha['secret_key'];
        $response = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']
        );
        // use json_decode to extract json response
        $response = json_decode($response);

        if ($response->success === false) {
            //Do something with error
        }
    }

    if ($response->success == true && $response->score >= 0.5) {
        $sender       = get_option('blogname');
        $sender_email = get_field('from_email', 'option');
        $to           = get_field('admin_email', 'option');
        $message = 'Name: ' . $field_name . "<br>";
        $message .= 'Email: ' . $field_email . "<br>";
        $message .= 'Phone: ' . $field_phone . "<br>";
        $message .= 'Type Job: ' . $field_type_job . "<br>";
        $message .= 'Link: ' . $field_link . "<br>";
        $message .= 'Message: ' . $field_message . "<br>";

        $ys_data = array(
            'from_name' => $sender,
            'from_mail' => $sender_email,
            'to_mail' => $to,
            'subject' => 'Form Submit',
            'message' => $message,
            'attachment' => $_FILES['field_file']
        );

        if ($ysmail->enviar($ys_data)) {
            $data_out['note'] = 'Thank you for your message. It has been sent.';
            $data_out['success'] = true;
        } else {
            $data_out['note'] = 'Message was not sent.';
        }
    } else {
        $data_out['note'] = 'Validation failed';
    }

    echo json_encode($data_out);
    wp_die();
}

add_action('wp_ajax_form_a_handle', 'form_a_handle');
add_action('wp_ajax_nopriv_form_a_handle', 'form_a_handle');

/*
* form_b_handle
*/
function form_b_handle() {
    $field_name = $_POST['field_name'];
    $field_company_url = $_POST['field_company_url'];
    $field_way_contact = $_POST['field_way_contact'];
    $field_phone = $_POST['field_phone'];
    $field_telegram_name = $_POST['field_telegram_name'];
    $field_email = $_POST['field_email'];
    $field_message = $_POST['field_message'];
    $data = [];

    if (isset($_POST['field_recaptha'])) {
        $captcha = $_POST['field_recaptha'];
        $recaptcha = get_field('recaptcha', 'option');
    } else {
        $captcha = false;
    }

    if (!$captcha) {
        //Do something with error
    } else {
        $secret   = $recaptcha['secret_key'];
        $response = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']
        );
        // use json_decode to extract json response
        $response = json_decode($response);

        if ($response->success === false) {
            //Do something with error
        }
    }

    if ($response->success == true && $response->score >= 0.5) {
        $sender       = get_option('blogname');
        $sender_email = get_field('from_email', 'option');
        $to           = get_field('admin_email', 'option');
        $subject      = 'Form Submit';
        $message = 'Name: ' . $field_name . "<br>";
        $message .= 'Company URL: ' . $field_company_url . "<br>";
        $message .= 'Best way to contact you?: ' . $field_way_contact . "<br>";
        $message .= 'Phone: ' . $field_phone . "<br>";
        $message .= 'Telegram username: ' . $field_telegram_name . "<br>";
        $message .= 'Email: ' . $field_email . "<br>";
        $message .= 'Message: ' . $field_message . "<br>";

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "X-Mailer: PHP \r\n";
        $headers .= 'From: ' . $sender  . " <" . $sender_email . ">\r\n";

        $mail = wp_mail($to, $subject, $message, $headers);

        if ($mail) {
            $data['note'] = 'Thank you for your message. It has been sent.';
            $data['success'] = true;
        } else {
            $data['note'] = 'Message was not sent.';
        }
    } else {
        $data['note'] = 'Validation failed';
    }

    echo json_encode($data);
    wp_die();
}
add_action('wp_ajax_form_b_handle', 'form_b_handle');
add_action('wp_ajax_nopriv_form_b_handle', 'form_b_handle');



/*
* form_c_handle
*/
function form_c_handle() {
    $field_email = $_POST['field_email'];
    $field_message = $_POST['field_message'];
    $data = [];

    if (isset($_POST['field_recaptha'])) {
        $captcha = $_POST['field_recaptha'];
        $recaptcha = get_field('recaptcha', 'option');
    } else {
        $captcha = false;
    }

    if (!$captcha) {
        //Do something with error
    } else {
        $secret   = $recaptcha['secret_key'];
        $response = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']
        );
        // use json_decode to extract json response
        $response = json_decode($response);

        if ($response->success === false) {
            //Do something with error
        }
    }

    //... The Captcha is valid you can continue with the rest of your code
    //... Add code to filter access using $response . score
    if ($response->success == true && $response->score >= 0.5) {
        $sender       = get_option('blogname');
        $sender_email = get_field('from_email', 'option');
        $to           = get_field('admin_email', 'option');
        $subject = 'Form Submit';
        $message = 'Email: ' . $field_email . "<br>";
        $message .= 'Message: ' . $field_message . "<br>";

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "X-Mailer: PHP \r\n";
        $headers .= 'From: ' . $sender  . " <" . $sender_email . ">\r\n";

        $mail = wp_mail($to, $subject, $message, $headers);

        if ($mail) {
            $data['note'] = 'Thank you for your message. It has been sent.';
            $data['success'] = true;
        } else {
            $data['note'] = 'Message was not sent.';
        }
    } else {
        $data['note'] = 'Validation failed';
    }

    echo json_encode($data);
    wp_die();
}
add_action('wp_ajax_form_c_handle', 'form_c_handle');
add_action('wp_ajax_nopriv_form_c_handle', 'form_c_handle');
