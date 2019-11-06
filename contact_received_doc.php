<?php
require_once 'Basic_Doc.php';
class Contact_Received_Doc extends Basic_Doc {
    public function __construct($data) {
        parent::__construct($data);
    }

    protected function content() {
        echo '<p>
        Information received!<br>
        Name: '.$this->_data['name'].'<br>
        Email: '.$this->_data['email'].'<br>
        Message: '.$this->_data['message'].'</p>';
    }
}