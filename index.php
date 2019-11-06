<?php 
session_start();

include 'manager_manager.php';
include 'session_manager.php';
include_once 'database.php';
include_once 'view.php';
include_once 'model.php';
include_once 'user_model.php';
include_once 'store_model.php';
include_once 'controller.php';
include_once 'user_controller.php';
include_once 'store_controller.php';

$database = new Database();
try {
    $database->connect();
} catch (Exception $e) {
    //Log failure to connect
}

$model = new Model($database);
$model->setModel();
switch ($model->getPage()) {
    case 'home':
    case 'about':
    default:
        $controller = new Controller($model);
        break;
    case 'contact':
    case 'login':
    case 'register':
    case 'logout':
        $model = new User_Model($database);
        $model->setModel();
        $controller = new User_Controller($model);
        $controller->process();
        break;
    case 'cart':
    case 'order':
    case 'order received':
    case 'upload':
    case 'edit':
        $model = new Store_Model($database);
        $model->setModel();
        $controller = new Store_Controller($model);
        $controller->process();
        break;
}
$view = new View($model, $database);
$view->showPage();
