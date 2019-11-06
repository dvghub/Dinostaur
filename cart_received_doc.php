<?php
require_once 'Basic_Doc.php';

class Cart_Received_Doc extends Basic_Doc {
    public function __construct($data) {
        parent::__construct($data);
    }

    protected function content() {
        if ($this->_data['order_id']) {
        echo "<p class='col-12'>Thank you for your order! Your order id is <strong>ORD".$this->_data['order_id']."</strong></p>";
    } else {
            showMessage('Something went wrong. Please try again.');
        }
    }
}