<?php 

function showReceived($data) {
    echo '<p>
        Information received!<br>
        Name: '.$data['name'].'<br>
        Email: '.$data['email'].'<br>
        Message: '.$data['message'].'</p>';
}

function showContactForm($data) {
    include 'form.php';
    showFormStart($data['page']);
    showFormInput('name', 'Name', 'input', 'text', $data['name'], '[A-Za-z ]{}', true, $data['error_name']);
    showFormInput('email', 'Email', 'input', 'email', $data['email'], '(?:[a-z0-9!#$%&\'+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])', false, $data['error_email']);
    showFormInput('message', 'Message', 'textarea', 'text', $data['message'], '[A-Za-z0-9 ]{}', false, $data['error_message']);
    showFormEnd('height-50 float-right clear-right col-3 bg-cornflower text-white border-0', 'SEND');
}