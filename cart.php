<?php

function showCartContent($data) {
    include 'form.php';
    $total = 0;

    if (cartExists()) {
        $items = getCart();

        showFormStart($data['page'], '', 8);
        foreach ($items as $id=>$amount) {
            if (!empty($data['amounts'])) {
                $quantity = $data['amounts'][$id];
            } else {
                $quantity = $amount;
            }
            $product = getProduct($id);
            $total += $quantity * $product['price'];
            showProduct($product, $quantity, $id);
        }
        echo "<span class='float-right clear-right d-block font-larger font-weight-bolder mt-3'>Your total: &euro;".$total."</span>";

        showFormEnd('float-left clear-left d-block col-6 col-md-5 col-xl-3 bg-dark text-white border-0 mt-3 mx-auto', 'UPDATE PRICES');

        showOrder('order received', $items, $total, getUserByEmail(getLoggedEmail())['id']);
    } else {
        showMessage('Please add items to your cart.');
    }
}

function showProduct($product, $amount, $id) {
    echo "<span class='col-12 px-0 d-block float-left clear-left'>
              <input class='float-left d-block border-0 col-2' value='".$amount."' type='number' name='amounts[".$id."]' min='0'/>
              <span class='float-left d-block col-8'><span class='font-weight-bold'>".$product['name']."</span> / &euro;".$product['price']."</span>
              <span class='float-right text-right d-block col-2'>&euro;".$product['price']*$amount."</span>
          </span>";
}

function showOrder($page, $items, $total, $customer_id) {
    showFormStart($page);
    foreach ($items as $id=>$amount) {
        echo "<input type='hidden' name='products[".$id."]' value='".$amount."'>";
    }
    echo "    <input type='hidden' name='total' value='".$total."'>
              <input type='hidden' name='customer_id' value='".$customer_id."'>";
    showFormEnd('height-50 float-right clear-right col-3 bg-cornflower text-white border-0', 'ORDER');
}

function showOrderReceived($data) {
    if ($data['order_id']) {
        echo "<p class='col-12'>Thank you for your order! Your order id is <strong>ORD".$data['order_id']."</strong></p>";
    } else {
        showMessage('Something went wrong. Please try again.');
    }
}