<?php
require_once 'Basic_Doc.php';

class Upload_Succeeded_Doc extends Basic_Doc {
    public function __construct($model, $database) {
        parent::__construct($model, $database);
    }

    protected function content() {
        echo "<span>Upload succeeded.</span>";
    }
}