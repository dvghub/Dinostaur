<?php
//  include_once "home_doc.php";
//
//  $data = array ( 'page' => 'home' );
//  $view = new Home_Doc($data);
//  $view->show();
include 'model.php';
include 'controller.php';
include 'view.php';

$model = new Model();
$controller = new Controller($model);
$view = new View($controller, $model);

if (isset($_GET['action']) && !empty($_GET['action'])) {
    $controller->{$_GET['action']}();
}

echo $view->output();