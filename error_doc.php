<?php
require_once 'Basic_Doc.php';

class Error_Doc extends Basic_Doc {
    public function __construct($model, $database) {
        parent::__construct($model, $database);
    }

    protected function content() {
        echo '<p>Page ['.$this->_model->getPage().'] not found.</p>';
    }
}