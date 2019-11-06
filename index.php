<?php 
session_start();

require 'html.php';
require 'body.php';
require 'manager_manager.php';

$data = getRequestData();
showRequestedPage($data);

function getRequestData() {
    $request_type = $_SERVER['REQUEST_METHOD'];
    $name = '';
    $username = '';
    $email = '';
    $message = '';
    $password = '';
    $password2 = '';
    if ($request_type == 'POST') {
        $requested_page = testInput(getPostVar('page', 'home'));
        $name = testInput(getPostVar('name', ''));
        $username = testInput(getPostVar('username', ''));
        $email = testInput(getPostVar('email', ''));
        $message = testInput(getPostVar('message', ''));
        $password = testInput(getPostVar('password', ''));
        $password2 = testInput(getPostVar('password2', ''));
    } else {
        $requested_page = testInput(getUrlVar('page', 'home'));
    }
    return array('page'=>$requested_page, 'type'=>$request_type, 'name'=>$name, 'username'=>$username, 'email'=>$email, 'message'=>$message, 'password'=>$password, 'password2'=>$password2);
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
