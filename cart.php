<?php

function showCartContent($data) {
    include 'form.php';
    $total = 0;

//    echo '<pre>';
//    print_r($data);
//    echo '</pre>';

    if (cartExists()) {
        $items = getCart();

        showFormStart($data['page']);
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
        echo "<span id='cart-total'>Your total: &euro;".$total."</span>";

        showFormEnd('update-prices', 'UPDATE PRICES');

        showOrder('order received', $items, $total, getUserByEmail(getLoggedEmail())['id']);
    } else {
        showMessage('Please add items to your cart.');
    }
}

function showProduct($product, $amount, $id) {
    echo "  <span class='cart-item'>
            <input class='cart-amount' value='".$amount."' type='number' name='amounts[".$id."]' min='0'/>
            <span class='cart-name'>".$product['name']." / &euro;".$product['price']."</span>
            <span class='cart-price'>&euro;".$product['price']*$amount."</span>
            </span>";
}

function showOrder($page, $items, $total, $customer_id) {
    showFormStart($page);
    foreach ($items as $id=>$amount) {
        echo "<input type='hidden' name='products[".$id."]' value='".$amount."'>";
    }
    echo "    <input type='hidden' name='total' value='".$total."'>
              <input type='hidden' name='customer_id' value='".$customer_id."'>";
    showFormEnd('cart-order', 'ORDER');
}

function showOrderReceived($data) {
//    echo '<pre>';
//    print_r($data);
//    echo '</pre>';
    if ($data['order_id']) {
        echo 'Thank you for your order! Your order id is <strong>ORD'.$data['order_id'].'</strong>';
    } else {
        showMessage('Something went wrong. Please try again.');
    }
}