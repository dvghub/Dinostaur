<?php
require_once 'Basic_Doc.php';

class Home_Doc extends Basic_Doc {
    public function __construct($model) {
        parent::__construct($model);
    }

    protected function content() {
        echo "<p>Hello hello homepage</p>";
    }
}