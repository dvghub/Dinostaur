<?php
require_once 'controller.php';

class Store_Controller extends Controller {

    public function process() {
        switch ($this->_model->getPage()) {
            case 'cart':
                $this->_model->adjustCart();
                break;
            case 'order':
                $this->_model->addOrder();
                break;
            case 'order received':
                $this->_model->processOrder();
                break;
            case 'upload':
                $this->_model->processUpload();
                break;
            case 'edit':
                $this->_model->prepareEdit();
                break;
            default:
                break;
        }
    }
}