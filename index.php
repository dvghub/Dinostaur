<?php 
session_start();

include 'html.php';
include 'body.php';
include 'validation.php';
include 'manager_manager.php';

$data = getRequestData();
$pdata = process($data);
showRequestedPage($pdata);

function getRequestData() {
    $request_type = $_SERVER['REQUEST_METHOD'];
    
    if ($request_type == 'POST') {
        $requested_page = testInput(getPostVar('page', 'home'));
        $name = testInput(getPostVar('name', ''));
        $email = testInput(getPostVar('email', ''));
        $message = testInput(getPostVar('message', ''));
        $password = testInput(getPostVar('password', ''));
        $password2 = testInput(getPostVar('password2', ''));
    } else {
        $requested_page = testInput(getUrlVar('page', 'home'));
        $name = '';
        $email = '';
        $message = '';
        $password = '';
        $password2 = '';
    }
    return array('page'=>$requested_page, 'type'=>$request_type, 'name'=>$name, 'email'=>$email, 'message'=>$message, 'password'=>$password, 'password2'=>$password2);
}

function process($data) {
    switch ($data['page']) {
        case 'home':
        case 'about': 
            return $data;
            break;
        case 'contact':
            $data = validateContact($data);
            if (array_key_exists('valid', $data)) $data['page'] = 'received';
            return $data;
            break;
        case 'login': 
            $data = validateLogin($data);
            if (array_key_exists('valid', $data)) {
                loginUser($data['email']);
                $data['page'] = 'home';
            }
            return $data;
            break;
        case 'register':
            $data = validateRegistration($data);
            if (array_key_exists('valid', $data) && $data['valid']) {
                $data['error_email'] = '';
                $data['error_password'] = '';
                $data['page'] = 'login';
            }
            return $data;
            break;
        case 'logout':
            logoutUser();
            $data['page'] = 'home';
            return $data;
            break;
        default:
            return $data;
            break;
    }
}

function showRequestedPage($data) {
    beginDocument();
    showHeadSection();
    showBodySection($data);
    endDocument();
}

function getPostVar($key, $default='') {
    $value = filter_input(INPUT_POST, $key);
    return isset($value) ? $value : $default;
}

function getUrlVar($key, $default='') {
    $value = filter_input(INPUT_GET, $key);
    return isset($value) ? $value : $default;
}

function testInput($data) {
  $data = trim($data);
  $data = addslashes($data);
  $data = htmlentities($data);
  return $data;
}