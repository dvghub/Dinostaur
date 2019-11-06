<?php 
function loginUser($email, $isAdmin) {
    $_SESSION['email'] = $email;
    $_SESSION['admin'] = $isAdmin;
}

function isUserLogged() {
    return array_key_exists('email', $_SESSION);
}

function getLoggedEmail() {
    return $_SESSION['email'];
}

function isUserAdmin() {
    return (array_key_exists('admin', $_SESSION) && $_SESSION['admin']);
}

function logoutUser() {
    session_unset();
    session_destroy();
}

function cartExists() {
    return array_key_exists('cart', $_SESSION);
}

function createCart() {
    $_SESSION['cart'] = array();
}

function addToCart($id, $amount) {
    if (array_key_exists($id, $_SESSION['cart'])) {
        $_SESSION['cart'][$id] += $amount;
    } else {
        $_SESSION['cart'][$id] = $amount;
    }
}

function removeFromCart($id) {
    unset($_SESSION['cart'][$id]);
}

function getCart() {
    return $_SESSION['cart'];
}

function getAmountInCart() {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item;
    }
    return $total;
}

function removeFromSession($id) {
    unset($_SESSION[$id]);
};
