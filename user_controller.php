<?php
require_once 'controller.php';

class User_Controller extends Controller {

    public function process() {
        switch ($this->_model->getPage()) {
            case 'contact':
                $this->_model->validateContact();
                break;
            case 'login':
                $this->_model->validateLogin();
                break;
            case 'register':
                $this->_model->validateRegistration();
                break;
            case 'logout':
                $this->_model->logout();
                break;
        }
    }
}