<?php
require_once 'Basic_Doc.php';

class Upload_Succeeded_Doc extends Basic_Doc {
    public function __construct($data) {
        parent::__construct($data);
    }

    protected function content() {
        echo "<span>Upload succeeded.</span>";
    }
}