<?php
require_once 'Basic_Doc.php';

class Home_Doc extends Basic_Doc {
    public function __construct($data) {
        parent::__construct($data);
    }

    protected function content() {
        echo "<p>This is my homepage</p>";
    }
}