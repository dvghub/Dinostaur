<?php

class View {
    protected $_model;
    protected $_database;

    public function __construct($_model, $_database) {
        $this->_model = $_model;
        $this->_database = $_database;
    }

    public function showPage() {
        switch ($this->_model->getPage()) {
            case 'home':
                include_once "home_doc.php";
                $doc = new Home_Doc($this->_model);
                $doc->show();
                break;
            case 'top':
                include 'top_doc.php';
                $doc = new Top_Doc($this->_model);
                $doc->show();
                break;
            case 'dinostaur':
                include 'dinostaur_doc.php';
                $doc = new Dinostaur_Doc($this->_model);
                $doc->show();
                break;
            case 'details':
                include 'details_doc.php';
                $doc = new Details_Doc($this->_model);
                $doc->show();
                break;
            case 'about':
                include 'about_doc.php';
                $doc = new About_Doc($this->_model);
                $doc->show();
                break;
            case 'contact':
                include 'contact_doc.php';
                $doc = new Contact_Doc($this->_model);
                $doc->show();
                break;
            case 'contact received':
                include 'contact_received_doc.php';
                $doc = new Contact_Received_Doc($this->_model);
                $doc->show();
                break;
            case 'login':
                include 'login_doc.php';
                $doc = new Login_Doc($this->_model);
                $doc->show();
                break;
            case 'register':
                include 'register_doc.php';
                $doc = new Register_Doc($this->_model);
                $doc->show();
                break;
            case 'upload':
                include 'upload_doc.php';
                $doc = new Upload_Doc($this->_model);
                $doc->show();
                break;
            case 'upload succeeded':
                include 'upload_succeeded_doc.php';
                $doc = new Upload_Succeeded_Doc($this->_model);
                $doc->show();
                break;
            case 'cart':
                include 'cart_doc.php';
                $doc = new Cart_Doc($this->_model);
                $doc->show();
                break;
            case 'order received':
                include 'cart_received_doc.php';
                $doc = new Cart_Received_Doc($this->_model);
                $doc->show();
                break;
            default:
                include 'error_doc.php';
                $doc = new Error_Doc($this->_model);
                $doc->show();
                break;
        }
    }
}
