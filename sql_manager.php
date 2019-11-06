<?php 
function connect() {
    $db_host = '127.0.0.1';
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
    $sql = "SELECT * FROM users WHERE email= '".$email."'";
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
    $sql = "INSERT INTO users (email, name, password) 
    VALUES ('".$email."', '".$name."', '".$password."')";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    return $result;
}

function categories() {
    $db = connect();
    $sql = 'DESCRIBE products tags';
    $result = mysqli_fetch_assoc(mysqli_query($db, $sql));
    $result = str_replace('set(', '', $result['Type']);
    $result = str_replace(')', '', $result);
    $result = str_replace('\'', '', $result);
    $result = explode(',', $result);
    mysqli_close($db);
    return $result;
}

function upload($name, $img, $price, $description, $tags) {
    $db = connect();
    $name = mysqli_real_escape_string($db, $name);
    $img = mysqli_real_escape_string($db, $img);
    $price = mysqli_real_escape_string($db, $price);
    $description = mysqli_real_escape_string($db, $description);
    $tags = mysqli_real_escape_string($db, $tags);
    $sql = "INSERT INTO products (name, image, price, description, tags)
    VALUES ('".$name."', 'img/".$img."', '".$price."', '".$description."', 'all".$tags."')";
    $result = mysqli_query($db, $sql);
    mysqli_close($db);
    return $result;
}

function edit($id, $name, $img, $price, $description, $tags, $time) {
    $db = connect();
    $id = mysqli_real_escape_string($db, $id);
    $name = mysqli_real_escape_string($db, $name);
    $img = mysqli_real_escape_string($db, $img);
    $price = mysqli_real_escape_string($db, $price);
    $description = mysqli_real_escape_string($db, $description);
    $tags = mysqli_real_escape_string($db, $tags);
    $time = mysqli_real_escape_string($db, $time);
    $sql = "UPDATE products 
            SET name = '".$name."', image = '".$img."', price = '".$price."', description = '".$description."', 
                 tags = 'all".$tags."', last_edited = '".$time."' 
            WHERE id = '".$id."'";
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
    $id = mysqli_real_escape_string($db, $id);
    $sql = "SELECT * FROM products WHERE id='".$id."'";
    $result = mysqli_fetch_assoc(mysqli_query($db, $sql));
    mysqli_close($db);
    return $result;
}

function getInfoByName($name) {
    $db = connect();
    $name = mysqli_real_escape_string($db, $name);
    $sql = "SELECT id, image, last_edited FROM products WHERE name = '".$name."'";
    $result = mysqli_fetch_assoc(mysqli_query($db, $sql));
    mysqli_close($db);
    return $result;
}

function getMostSold($howmany) {
    $db = connect();
    $howmany = mysqli_real_escape_string($db, $howmany);
    $sql = "SELECT order_products.product_id, SUM(order_products.product_amount) AS total, products.name 
            FROM order_products 
            LEFT JOIN products ON order_products.product_id = products.id 
            WHERE order_products.order_id IN (SELECT orders.id FROM orders WHERE orders.date >= ADDDATE(CURRENT_DATE(), INTERVAL -1 WEEK)) 
            GROUP BY order_products.product_id 
            ORDER BY total DESC 
            LIMIT " . $howmany;
    $result = mysqli_fetch_all(mysqli_query($db, $sql), MYSQLI_ASSOC);
    mysqli_close($db);
    return $result;

}

function saveOrdered($total, $products, $customer_id) {
    $db = connect();
    $total = mysqli_real_escape_string($db, $total);
    $customer_id = mysqli_real_escape_string($db, $customer_id);
    $sql = "INSERT INTO orders (total_price, customer_id, date) VALUES (".$total.", ".$customer_id.", CURRENT_DATE())";
    mysqli_query($db, $sql);
    $order_id = mysqli_insert_id($db);
    foreach ($products as $id=>$amount) {
        $product_id = mysqli_real_escape_string($db, $id);
        $amount = mysqli_real_escape_string($db, $amount);
        $sql = 'INSERT INTO order_products (order_id, product_id, product_amount) VALUES ('.$order_id.', '.$product_id.', '.$amount.')';
        mysqli_query($db, $sql);
    }
    mysqli_close($db);
    return $order_id;
}
