<?php 

function showLoginContent($data) {
    $page = $data['page'];
    $email = $data['email'];
    $password = $data['password'];
    $error_email = '';
    $error_password = '';
    
    if ($data['type'] == 'POST') {
        $error_email = $email == '' ? 'Please enter an email address.' : '';
        $error_password = $password == '' ? 'Please enter a password.' : '';
    }
    
    //Validate login or show form
    if ($email != '' && $password != '') {
        if (emailOnFile($email)) {
            $username = authUser($email, $password);
            switch ($username) {
                case 'password_error':
                    $error_password = 'Incorrect password.';
                    showLoginForm($page, $email, $password, $error_email, $error_password);
                    break;
                case 'unknown_error':
                    $error_email = 'Something went wrong, please try again.';
                    showLoginForm($page, $email, $password, $error_email, $error_password);
                    break;
                default:
                    loginUser($username);
                    echo "<script language='javascript'>window.location.href ='index.php?page=home'</script>";
                    break;
            }
        } else {
            $error_email = 'This email address is not in our database.';
            showLoginForm($page, $email, $password, $error_email, $error_password);
        }
    } else {
        showLoginForm($page, $email, $password, $error_email, $error_password);
    }
}

function showLoginForm($page, $email, $password, $error_email, $error_password) {
    showFormStart($page);
    showFormInput('email', 'Email', 'input', 'email', $email, '(?:[a-z0-9!#$%&\'+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])', false, $error_email);
    showFormInput('password', 'Password', 'input', 'password', '', '[A-Za-z0-9]{}', false, $error_password);
    showFormEnd();
}
