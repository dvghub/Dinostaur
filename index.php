<?php 
session_start();

include 'session_manager.php';
include_once 'view.php';
include_once 'crud.php';
include_once 'user_crud.php';
include_once 'store_crud.php';
include_once 'model.php';
include_once 'user_model.php';
include_once 'store_model.php';
include_once 'controller.php';
include_once 'user_controller.php';
include_once 'store_controller.php';

$database = new Crud();
try {
    $database->connect();
} catch (Exception $e) {
    echo 'Standard Crud connection failed: '.$e->getMessage();
}

$model = new Model($database);
$model->setModel();
switch ($model->getPage()) {
    default:
        $controller = new Controller($model);
        break;
    case 'contact':
    case 'login':
    case 'register':
    case 'logout':
        $database = new User_Crud();
        try {
           $database->connect();
        } catch (Exception $e) {
            echo 'User Crud connection failed: '.$e->getMessage();
        }
        $model = new User_Model($database);
        $model->setModel();
        $controller = new User_Controller($model);
        $controller->process();
        break;
    case 'top':
    case 'dinostaur':
    case 'details':
    case 'cart':
    case 'order':
    case 'order received':
    case 'upload':
    case 'edit':
        $database = new Store_Crud();
        try {
            $database->connect();
        } catch (Exception $e) {
            echo 'Store Crud connection failed: '.$e->getMessage();
        }
        $model = new Store_Model($database);
        $model->setModel();
        $controller = new Store_Controller($model);
        $controller->process();
        break;
}
$view = new View($model, $database);
$view->showPage();
