<?php
include 'database.php';

function connectToDb($database) {
    return $database->connect();
}

function save($db, $email, $name, $password) {
    return $db->saveUser($email, $name, $password);
}

function userByEmail($db, $email) {
    return $db->getUserByEmail($email);
}

function isAdmin($db, $email) {
    return $db->userByEmail($email)['admin'];
}

function authUser($db, $email, $password) {
    $info = $db->userByEmail($email);
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

function uploadProduct($db, $model) {
    $tags = '';
    foreach ($model->categories as $category) {
        $tags .= ",".$category;
    }
    return $db->upload($model->upload_name, $model->upload_image, $model->upload_price, $model->upload_description, $tags);
}

function editProduct($db, $model) {
    $tags = '';
    foreach ($model->categories as $category) {
        $tags .= ",".$category;
    }
    return $db->edit($model->product_id, $model->upload_name, $model->upload_image, $model->upload_price, $model->upload_description, $tags, date('Y-m-d H:i:s'));
}

function getProducts($db, $category) {
    return $db->getProductByCat($category);
}

function getProduct($db, $id) {
    return $db->getProductByID($id);
}

function getInfo($db, $name) {
    return $db->getInfoByName($name);
}

function getCategories($db) {
    return $db->categories();
}

function getTop($db, $howmany) {
    return $db->getMostSold($howmany);
}

function saveOrder($db, $total, $products, $customer_id) {
    return $db->saveOrdered($total, $products, $customer_id);
}
