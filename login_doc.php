<?php
require_once 'Form_Doc.php';

class Login_Doc extends Form_Doc {
    public function __construct($data) {
        // pass the data on to our parent class (BasicDoc)
        parent::__construct($data);
    }

    protected function content() {
        $this->showFormStart($this->_data['page']);
        $this->showFormInput('email', 'Email', 'input', 'email', $this->_data['email'], '(?:[a-z0-9!#$%&\'+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])', false, $this->_data['error_email']);
        $this->showFormInput('password', 'Password', 'input', 'password', '', '[A-Za-z0-9]{}', false, $this->_data['error_password']);
        $this->showFormEnd('height-50 float-right clear-right col-3 bg-cornflower text-white border-0', 'SEND');
    }
}