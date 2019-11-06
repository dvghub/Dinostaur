<?php 

function showRegisterContent($data) {
    $page = $data['page'];
    $username = $data['username'];
    $email = $data['email'];
    $password = $data['password'];
    $password2 = $data['password2'];
    $error_username = '';
    $error_email = '';
    $error_password = '';
    $error_password2 = '';
    
    if ($data['type'] == 'POST') {
        $error_username = $username == '' ? 'Please enter your name.' : '';
        $error_email = $email == '' ? 'Please enter an email address.' : '';
        $error_password = $password == '' ? 'Please enter a password.' : '';
        $error_password2 = $password2 == '' ? 'Please repeat your password.' : '';
    }
    
    if ($username != '' && $email != '' && $password != '' && $password2 != '') {
        
        if (!emailOnFile($email)){
            
            if ($password == $password2) {
                
                if (saveUser($email, $username, $password)) {
                    echo "<script language='javascript'>window.location.href ='index.php?page=login'</script>";
                } else {
                    $error_username = 'Something went wrong, please try again.';
                    showRegistrationForm($page, $username, $email, $error_username, $error_email, $error_password, $error_password2);
                }
            } else {
                $error_password2 = 'Passwords do not match.';
                showRegistrationForm($page, $username, $email, $error_username, $error_email, $error_password, $error_password2);
            }
        } else {
            $error_email = 'This email address is already in our database.';
            showRegistrationForm($page, $username, $email, $error_username, $error_email, $error_password, $error_password2);
        }
    } else {
        showRegistrationForm($page, $username, $email, $error_username, $error_email, $error_password, $error_password2);
    }
}

function showRegistrationForm($page, $username, $email, $error_username, $error_email, $error_password, $error_password2) {
    showFormStart($page);
    showFormInput('username', 'Name', 'input', 'text', $username, '[A-Za-z]{}', true, $error_username);
    showFormInput('email', 'Email', 'input', 'email', $email, '(?:[a-z0-9!#$%&\'+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])', false, $error_email);
    showFormInput('password', 'Password', 'input', 'password', '', '[A-Za-z0-9]{}', false, $error_password);
    showFormInput('password2', 'Repeat password', 'input', 'password', '', '[A-Za-z0-9]{}', false, $error_password2);
    showFormEnd();
}
