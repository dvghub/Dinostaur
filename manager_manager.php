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

function isAdmin($email) {
    return userByEmail($email)['admin'];
}

function authUser($email, $password) {
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
}

function uploadProduct($data) {
    try {
        $tags = '';
        foreach ($data['categories'] as $category) {
            $tags .= ",".$category;
        }
        return upload($data['upload_name'], $data['upload_image'], $data['upload_price'], $data['upload_description'], $tags);
    } catch (Exception $e) {
        showMessage("Couldn't connect to database. Please check your network connection.");
        //Pseudo log($e->getMessage())
        return false;
    }
}

function editProduct($data) {
    try {
        $tags = '';
        foreach ($data['categories'] as $category) {
            $tags .= ",".$category;
        }
        return edit($data['product_id'], $data['upload_name'], $data['upload_image'], $data['upload_price'], $data['upload_description'], $tags, date('Y-m-d H:i:s'));
    } catch (Exception $e) {
        showMessage("Couldn't connect to database. Please check your network connection.");
        //Pseudo log($e->getMessage())
        return false;
    }
}

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

function getInfo($name) {
    return getInfoByName($name);
}

function getCategories() {
    try {
        return categories();
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
