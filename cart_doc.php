<?php
require_once 'Form_Doc.php';

class Cart_Doc extends Form_Doc {
    public function __construct($model) {
        parent::__construct($model);
    }

    protected function content() {
        $total = 0;

        if (cartExists()) {
            $items = getCart();

            $this->showFormStart($this->_model->getPage(), '', 8);
            foreach ($items as $id=>$amount) {
                if (!empty($this->_model->getAmounts())) {
                    $quantity = $this->_model->getAmounts()[$id];
                } else {
                    $quantity = $amount;
                }
                $product = $this->_model->getDb()->getProduct($id);
                $total += $quantity * $product['price'];
                $this->showProduct($product, $quantity, $id);
            }
            echo "<span class='float-right clear-right d-block font-larger font-weight-bolder mt-3'>Your total: &euro;".$total."</span>";
            $this->showFormEnd('float-left clear-left d-block col-6 col-md-5 col-xl-3 bg-dark text-white border-0 mt-3 mx-auto', 'UPDATE PRICES');
            $this->showOrder('order received', $items, $total, $this->_model->getDb()->userByEmail(getLoggedEmail())['id']);
        } else {
            $this->showMessage('Please add items to your cart.');
        }
    }

    private function showProduct($product, $amount, $id) {
        echo "<span class='col-12 px-0 d-block float-left clear-left'>
              <input class='float-left d-block border-0 col-2' value='".$amount."' type='number' name='amounts[".$id."]' min='0'/>
              <span class='float-left d-block col-8'><span class='font-weight-bold'>".$product['name']."</span> / &euro;".$product['price']."</span>
              <span class='float-right text-right d-block col-2'>&euro;".$product['price']*$amount."</span>
          </span>";
    }

    private function showOrder($page, $items, $total, $customer_id) {
        $this->showFormStart($page);
        foreach ($items as $id=>$amount) {
            echo "<input type='hidden' name='products[".$id."]' value='".$amount."'>";
        }
        echo "    <input type='hidden' name='total' value='".$total."'>
              <input type='hidden' name='customer_id' value='".$customer_id."'>";
        $this->showFormEnd('height-50 float-right clear-right col-3 bg-cornflower text-white border-0', 'ORDER');
    }
}