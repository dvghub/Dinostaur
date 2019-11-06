<?php 

function showContactContent($data) {
    $name = $data['name'];
    $email = $data['email'];
    $message = $data['message'];
    $error_name = '';
    $error_email = '';
    $error_message = '';
    
    if ($data['type'] == 'POST') {
        $error_name = $name == '' ? 'Please enter your name.' : '';
        $error_email = $email == '' ? 'Please enter an email address.' : '';
        $error_message = $message == '' ? 'Please enter your message.' : '';
    }
    
    if ($name != '' && $email != '' && $message != '') {
        showReceived($name, $email, $message);
    } else {
        showFormStart($data['page']);
        showFormInput('name', 'Name', 'input', 'text', $name, '[A-Za-z]{}', true, $error_name);
        showFormInput('email', 'Email', 'input', 'email', $email, '(?:[a-z0-9!#$%&\'+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])', false, $error_email);
        showFormInput('message', 'Message', 'textarea', 'text', $message, '[A-Za-z0-9]{}', false, $error_message);
        showFormEnd();
    }
}

function showReceived($name, $email, $message) {
    echo '
        Information received!<br>
        Name: '.$name.'<br>
        Email: '.$email.'<br>
        Message: '.$message;
}
