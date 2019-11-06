<?php
include 'sql_manager.php';

function save($email, $name, $password) {
    try {
        return saveUser($email, $name, $password);
    } catch (Exception $e) {
        showMessage("Couldn't connect to database. Please check your network connection.");
        //Pseudo log($e->getMessage())
        return false;
    }
}

function userByEmail($email) {
    try {
        return getUserByEmail($email);
    } catch (Exception $e) {
        showMessage("Couldn't connect to database. Please check your network connection.");
        //Pseudo log($e->getMessage())
        return false;
    }
}

function authUser($email, $password) {
    try {
        $info = userByEmail($email);
        if (!$info) {
            return array('status' => 'user_unknown');
        } else {
            if ($info['password'] != $password) {
                return array('status' => 'password_incorrect');
            } else {
                return array('status' => 'all_good', 'name' => $info['name']);
            }
        }
    } catch (Exception $e) {
        showMessage("Couldn't connect to database. Please check your network connection.");
        //Pseudo log($e->getMessage())
        return array('status' => null);
    }
};

function getProducts($category) {
    try {
        return getProductByCat($category);
    } catch (Exception $e) {
        showMessage("Couldn't connect to database. Please check your network connection.");
        //Pseudo log($e->getMessage())
        return false;
    }
}

function getProduct($id) {
    try {
        return getProductByID($id);
    } catch (Exception $e) {
        showMessage("Couldn't connect to database. Please check your network connection.");
        //Pseudo log($e->getMessage())
        return false;
    }
}

function getTop($howmany) {
    return getMostSold($howmany);
}

function saveOrder($total, $products, $customer_id) {
    return saveOrdered($total, $products, $customer_id);
}