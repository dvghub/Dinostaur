<?php

class Doc {
    protected $_model;
    protected $_database;

    public function __construct($model, $database) {
        $this->_model = $model;
        $this->_database = $database;
    }

    private function beginDoc() {
        echo '<!DOCTYPE html><html>';
    }

    private function beginHead() {
        echo '<head>';
    }

    protected function headContent() {}

    private function endHead() {
        echo '</head>';
    }

    private function beginBody() {
        echo "<body class='col-12 col-md-10 col-lg-8 px-0 mx-md-auto pb-5 text-dark'>";
    }

    protected function bodyContent() {}

    private function endBody() {
        echo '</body>';
    }

    private function endDoc() {
        echo '</html>';
    }

    public function show() {
        $this->beginDoc();
        $this->beginHead();
        $this->headContent();
        $this->endHead();
        $this->beginBody();
        $this->bodyContent();
        $this->endBody();
        $this->endDoc();
    }
}