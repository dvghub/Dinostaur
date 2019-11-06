<?php
require_once 'Basic_Doc.php';

class Dinostaur_Doc extends Basic_Doc {
    public function __construct($model, $database) {
        parent::__construct($model, $database);
    }

    protected function content() {
        $products = getProducts($this->_database, $this->_model->getCategory());
        $categories = getCategories($this->_database);
        $this->showCategories($categories);

        if ($products) {
            $this->showProducts($products);
        }
    }

    private function showCategories($categories) {
        echo "<form>
                  <input type='hidden' name='page' value='dinostaur'>
                  <span class='col-12 d-block mb-2'>Show: 
                  <select name='category' onchange='this.form.submit()'>";
        foreach ($categories as $category) {
            echo "<option value='".$category."' ".($category == 'all' ? 'selected' : '')."><span class='text-capitalize'>".$category."</span></option>";
        }
        echo "</select></span></form>";
    }

    private function showProducts($products) {
        echo "<div class='col-12 d-flex flex-wrap'>";
        foreach ($products as $product) {
            echo "<article class='col-12 col-sm-6 col-md-4 col-lg-3 float-left p-2 tile d-flex flex-wrap'>
                  <img class='col-12 mb-auto p-0' src='".$product['image']."'>
                  <span class='mt-auto col-12 d-flex flex-wrap p-0'>
                      <span class='float-left clear-left font-weight-bold col-12'>" .$product['name']. "</span>
                      <span class='float-left clear-left col-6'>&euro;" .$product['price']."</span>
                      <form action='index.php' method='post' class='col-6'>
                          <input type='hidden' name='product_id' value='" . $product['id'] . "'>
                          <input type='hidden' name='product_name' value='" . $product['name'] . "'>
                          <input type='hidden' name='page' value='details'>
                          <input type='submit' value='ORDER' class='tile-order float-right clear-right col-12 bg-cornflower text-decoration-none text-white border-0'>
                      </form></span></article>";
        }
        echo "</div>";
    }
}