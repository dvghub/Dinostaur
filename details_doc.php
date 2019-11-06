<?php
require_once 'Form_Doc.php';

class Details_Doc extends Form_Doc {
    public function __construct($model, $database) {
        parent::__construct($model, $database);
    }

    protected function content() {
        $product = getProduct($this->_database, $this->_model->getProductId());
        $tags = '';

        echo "<img class='float-left float-md-right col-12 col-md-6' src='".$product['image']."'>
                  <span class='text-justify float-left clear-left col-12 col-md-6'>" .$product['description']. "</span>";
        foreach (explode(',', $product['tags']) as $id => $tag) {
            $id == 0 ? $tags = '#' . $tag : $tags .= ', #' . $tag;
        }
        echo "<span class='float-left clear-left font-weight-light col-12 col-md-6 font-italic text-black-50'>".$tags."</span>
                  <span class='float-left clear-left font-weight-bold  col-12 col-md-6'>&euro;" .$product['price']. "</span>";
        if (isUserLogged()) {
            echo "<form method='post' class='float-left clear-left col-12 col-md-6 mt-2'>
                      <input type='hidden' name='page' value='order'>";
//                $this->showFormStart('order', 'mt-2 float-left clear-left', '6');

            $this->showFormInput('product_id', '', 'input', 'hidden', $product['id'], '', false, '', false);
            $this->showFormInput('product_name', '', 'input', 'hidden', $product['name'], '', false, '', false);
            echo "<input type='number' name='amount' min='1' value='1' class='float-left clear-left border-cornflower col-3' style='height: 40px;'>
                      <input type='submit' class='col-9 col-md-3 p-2 bg-cornflower text-decoration-none text-white border-0 float-left' value='ORDER'>
                      </form>";
        } else {
            echo "<span class='text-justify float-left clear-left col-12 col-md-6'>Please log in to purchase.</span>";
        }
        if (isUserAdmin()) {
            $this->showFormStart('edit');
            $this->showFormInput('product_id', '', 'input', 'hidden', $product['id'], '', false, '', false);
            $this->showFormEnd('col-4 col-md-2 bg-cornflower border-0 text-white height-50 float-right clear-right', 'EDIT', 12);
        }
    }
}