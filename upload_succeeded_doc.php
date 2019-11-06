<?php
require_once 'Basic_Doc.php';

class Upload_Succeeded_Doc extends Basic_Doc {
    public function __construct($model) {
        parent::__construct($model);
    }

    protected function content() {
        echo "<span>Upload succeeded.</span>";
    }
}