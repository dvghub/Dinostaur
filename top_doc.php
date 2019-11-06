<?php
require_once 'Basic_Doc.php';

class Top_Doc extends Basic_Doc {
    public function __construct($model) {
        parent::__construct($model);
    }

    protected function content() {
        echo "
        <div class='container-fluid float-left clearfix'>
        <strong class='float-left''>Top 5 items sold this week: </strong>
        <ol class='float-left pl-3 col-6' style='clear:left;'>";
        $products = $this->_model->getDb()->getTop(5);
        foreach ($products as $product) {
            echo "<li class='col-12'><a class='d-block float-left text-decoration-none text-dark' href='index.php?page=details&product_id=".$product['product_id']."&product_name=".$product['name']."'>".$product['name']."</a><span class='d-block float-right text-right'>".$product['total']."</span></li>";
        }
        echo '</ol></div>';
    }
}