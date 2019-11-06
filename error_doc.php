<?php
require_once 'Basic_Doc.php';

class Error_Doc extends Basic_Doc {
    public function __construct($data) {
        parent::__construct($data);
    }

    protected function content() {
        showError('Page ['.$this->_data['page'].'] not found.');
    }
}