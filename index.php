<?php 
require 'begin_html.php';
require 'head.php';
require 'body.php';
require 'end_html.php';

$data = getRequestData();
showRequestedPage($data);

function getRequestData() {
    $request_type = $_SERVER['REQUEST_METHOD'];
    if ($request_type == 'POST') {
        $requested_page = getPostVar('page', 'home');
    } else {
        $requested_page = getUrlVar('page', 'home');
    }
    return array('page'=>$requested_page, 'type'=>$request_type);
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



    
