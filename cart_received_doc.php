<?php
require_once 'Basic_Doc.php';

class Cart_Received_Doc extends Basic_Doc {
    public function __construct($model) {
        parent::__construct($model);
    }

    protected function content() {
        echo "<p class='col-12'>Thank you for your order! Your order id is <strong>ORD".$this->_model->getOrderId()."</strong></p>";
    }
}