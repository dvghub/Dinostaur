<?php
require_once 'Basic_Doc.php';

class Home_Doc extends Basic_Doc {
    public function __construct($model, $database) {
        parent::__construct($model, $database);
    }

    protected function content() {
        echo "<p>This is my homepage</p>";
    }
}