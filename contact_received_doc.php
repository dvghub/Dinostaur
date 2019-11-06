<?php
require_once 'Basic_Doc.php';
class Contact_Received_Doc extends Basic_Doc {
    public function __construct($model, $database) {
        parent::__construct($model, $database);
    }

    protected function content() {
        echo '<p>
        Information received!<br>
        Name: '.$this->_model->getName().'<br>
        Email: '.$this->_model->getEmail().'<br>
        Message: '.$this->_model->getMessage().'</p>';
    }
}