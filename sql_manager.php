<?php 
function connect() {
    $db_host = 'localhost';
    $db_username = 'sql_manager';
    $db_password = 'lookatmeimastrongpassword';
    $db_name = 'dinostaur';

    $db =  mysqli_connect($db_host, $db_username, $db_password, $db_name);
    if (!$db) {
        throw new Exception("Database connection failed.");
    } else {
        return $db;
    }
}

function getUserByEmail($email) {
    $db = connect();
    $email = mysqli_real_escape_string($db, $email);
    $sql = 'SELECT id, name, password FROM users WHERE email= "'.$email.'"';
    $result = mysqli_query($db, $sql);
    $result = mysqli_fetch_assoc($result);
    mysqli_close($db);
    return $result;
}

function saveUser($email, $name, $password) {
    $db = connect();
    $email = mysqli_real_escape_string($db, $email);
    $name = mysqli_real_escape_string($db, $name);
    $password = mysqli_real_escape_string($db, $password);
    $sql = 'INSERT INTO users (email, name, password) 
    VALUES ("'.$email.'", "'.$name.'", "'.$password.'")';
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    return $result;
}

function getProductByCat($category) {
    $db = connect();
    $category = mysqli_real_escape_string($db, $category);
    $sql = "SELECT * FROM products WHERE tags LIKE '%".$category."%'";
    $result = mysqli_fetch_all(mysqli_query($db, $sql), MYSQLI_ASSOC);
    mysqli_close($db);
    return $result;
}

function getProductByID($id) {
    $db = connect();
    $id= mysqli_real_escape_string($db, $id);
    $sql = 'SELECT * FROM products WHERE id="'.$id.'"';
    $result = mysqli_query($db, $sql);
    $result = mysqli_fetch_assoc($result);
    mysqli_close($db);
    return $result;
}

function saveOrdered($total, $products, $customer_id) {
    $db = connect();
    $total = mysqli_real_escape_string($db, $total);
    $customer_id = mysqli_real_escape_string($db, $customer_id);
    $sql = "INSERT INTO orders (total_price, customer_id) VALUES (".$total.", ".$customer_id.")";
    mysqli_query($db, $sql);
    $order_id = mysqli_insert_id($db);
    foreach ($products as $id=>$amount) {
        $product_id = mysqli_real_escape_string($db, $id);
        $sql = 'INSERT INTO order_products (order_id, product_id, product_amount) VALUES ('.$order_id.', '.$product_id.', '.$amount.')';
        mysqli_query($db, $sql);
    }
    mysqli_close($db);
    return $order_id;
}