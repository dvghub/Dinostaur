<?php

class Database {
    private $db = null;
    private $isConnected = false;

    public function isConnected() {
        return $this->isConnected;
    }

    public function connect() {
        $db_host = '127.0.0.1';
        $db_username = 'sql_manager';
        $db_password = 'lookatmeimastrongpassword';
        $db_name = 'dinostaur';

        $db =  mysqli_connect($db_host, $db_username, $db_password, $db_name);
        if (!$db) {
            throw new Exception("Database connection failed.");
        } else {
            $this->isConnected = true;
            $this->db = $db;
        }
    }

    public function getUserByEmail($email) {
        $email = mysqli_real_escape_string($this->db, $email);
        $sql = "SELECT * FROM users WHERE email= '".$email."'";
        $result = mysqli_query($this->db, $sql);
        $result = mysqli_fetch_assoc($result);
        return $result;
    }

    public function saveUser($email, $name, $password) {
        $email = mysqli_real_escape_string($this->db, $email);
        $name = mysqli_real_escape_string($this->db, $name);
        $password = mysqli_real_escape_string($this->db, $password);
        $sql = "INSERT INTO users (email, name, password) 
    VALUES ('".$email."', '".$name."', '".$password."')";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function categories() {
        $sql = 'DESCRIBE products tags';
        $result = mysqli_fetch_assoc(mysqli_query($this->db, $sql));
        $result = str_replace('set(', '', $result['Type']);
        $result = str_replace(')', '', $result);
        $result = str_replace('\'', '', $result);
        $result = explode(',', $result);
        return $result;
    }

    public function upload($name, $img, $price, $description, $tags) {
        $name = mysqli_real_escape_string($this->db, $name);
        $img = mysqli_real_escape_string($this->db, $img);
        $price = mysqli_real_escape_string($this->db, $price);
        $description = mysqli_real_escape_string($this->db, $description);
        $tags = mysqli_real_escape_string($this->db, $tags);
        $sql = "INSERT INTO products (name, image, price, description, tags)
    VALUES ('".$name."', 'img/".$img."', '".$price."', '".$description."', 'all".$tags."')";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function edit($id, $name, $img, $price, $description, $tags, $time) {
        $id = mysqli_real_escape_string($this->db, $id);
        $name = mysqli_real_escape_string($this->db, $name);
        $img = mysqli_real_escape_string($this->db, $img);
        $price = mysqli_real_escape_string($this->db, $price);
        $description = mysqli_real_escape_string($this->db, $description);
        $tags = mysqli_real_escape_string($this->db, $tags);
        $time = mysqli_real_escape_string($this->db, $time);
        $sql = "UPDATE products 
            SET name = '".$name."', image = '".$img."', price = '".$price."', description = '".$description."', 
                 tags = 'all".$tags."', last_edited = '".$time."' 
            WHERE id = '".$id."'";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }

    public function getProductByCat($category) {
        $category = mysqli_real_escape_string($this->db, $category);
        $sql = "SELECT * FROM products WHERE tags LIKE '%".$category."%'";
        $result = mysqli_fetch_all(mysqli_query($this->db, $sql), MYSQLI_ASSOC);
        return $result;
    }

    public function getProductByID($id) {
        $id = mysqli_real_escape_string($this->db, $id);
        $sql = "SELECT * FROM products WHERE id='".$id."'";
        $result = mysqli_fetch_assoc(mysqli_query($this->db, $sql));
        return $result;
    }

    public function getInfoByName($name) {
        $name = mysqli_real_escape_string($this->db, $name);
        $sql = "SELECT id, image, last_edited FROM products WHERE name = '".$name."'";
        $result = mysqli_fetch_assoc(mysqli_query($this->db, $sql));
        return $result;
    }

    public function getMostSold($howmany) {
        $howmany = mysqli_real_escape_string($this->db, $howmany);
        $sql = "SELECT order_products.product_id, SUM(order_products.product_amount) AS total, products.name 
            FROM order_products 
            LEFT JOIN products ON order_products.product_id = products.id 
            WHERE order_products.order_id IN (SELECT orders.id FROM orders WHERE orders.date >= ADDDATE(CURRENT_DATE(), INTERVAL -1 WEEK)) 
            GROUP BY order_products.product_id 
            ORDER BY total DESC 
            LIMIT " . $howmany;
        $result = mysqli_fetch_all(mysqli_query($this->db, $sql), MYSQLI_ASSOC);
        return $result;
    }

    public function saveOrdered($total, $products, $customer_id) {
        $total = mysqli_real_escape_string($this->db, $total);
        $customer_id = mysqli_real_escape_string($this->db, $customer_id);
        $sql = "INSERT INTO orders (total_price, customer_id, date) VALUES (".$total.", ".$customer_id.", CURRENT_DATE())";
        mysqli_query($this->db, $sql);
        $order_id = mysqli_insert_id($this->db);
        foreach ($products as $id=>$amount) {
            $product_id = mysqli_real_escape_string($this->db, $id);
            $amount = mysqli_real_escape_string($this->db, $amount);
            $sql = 'INSERT INTO order_products (order_id, product_id, product_amount) VALUES ('.$order_id.', '.$product_id.', '.$amount.')';
            mysqli_query($this->db, $sql);
        }
        return $order_id;
    }
}