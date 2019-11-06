<?php
include_once 'Crud.php';

class Store_Crud extends Crud {

    public function uploadProduct($model) {
        $tags = 'all';
        foreach ($model->getCategories() as $category) {
            $tags .= ",".$category;
        }
        $params = array(':name'=>$model->getUploadName(), ':image'=>$model->getUploadImage(), ':price'=>$model->getUploadPrice(), ':description'=>$model->getUploadDescription(), ':tags'=>$tags);
        return $this->create('INSERT INTO products (name, image, price, description, tags)
                        VALUES (:name, :image, :price, :description, :tags)', $params);
    }

    public function editProduct($model) {
        $tags = 'all';
        foreach ($model->getCategories() as $category) {
            $tags .= ",".$category;
        }
        $params = array(':id'=>$model->getProductId(), ':name'=>$model->getUploadName(), ':image'=>$model->getUploadImage(),
            ':price'=>$model->getUploadPrice(), ':description'=>$model->getUploadDescription(), ':tags'=>$tags,
            ':time'=>date('Y-m-d H:i:s'));
        return $this->update('UPDATE products SET name = :name, image = :image, price = :price,
                        description = :description, tags = :tags, last_edited = :time
                        WHERE id = :id', $params);
    }

    public function getProducts($category) {
        $params = array(':category'=>'%'.$category.'%');
        return $this->read('SELECT * FROM products WHERE tags LIKE :category', $params);
    }

    public function getProduct($id) {
        $params = array(':id'=>$id);
        return $this->read('SELECT * FROM products WHERE id = :id', $params)[0];
    }

    public function getInfo($name) {
        $params = array(':name'=>$name);
        $result = $this->read('SELECT id, image, last_edited FROM products WHERE name = :name', $params);
        return $result ? $result[0] : false;
    }

    public function getCategories() {
        $result =  $this->read('DESCRIBE products tags', array());
        $result = str_replace('set(', '', $result[0]['Type']);
        $result = str_replace(')', '', $result);
        $result = str_replace('\'', '', $result);
        $result = explode(',', $result);
        return $result;
    }

    public function getTop($howmany) {
        $params = array(':howmany'=>$howmany);
        return $this->read('SELECT order_products.product_id, SUM(order_products.product_amount) AS total, products.name
        FROM order_products
        LEFT JOIN products ON order_products.product_id = products.id
        WHERE order_products.order_id IN (SELECT orders.id FROM orders WHERE orders.date >= ADDDATE(CURRENT_DATE(), INTERVAL -1 WEEK))
        GROUP BY order_products.product_id
        ORDER BY total DESC
        LIMIT :howmany', $params);
    }

    public function saveOrder($total, $products, $customer_id) {
        $params = array(':total'=>$total, ':customer_id'=>$customer_id);
        $order_id = $this->create('INSERT INTO orders (total_price, customer_id, date) VALUES (:total, :customer_id, CURRENT_DATE())', $params);
        if ($order_id != 0) {
            foreach ($products as $id=>$amount) {
                $params = array(':order_id'=>$order_id, 'product_id'=>$id, 'product_amount'=>$amount);
                $this->create('INSERT INTO order_products (order_id, product_id, product_amount) VALUES (:order_id, :product_id, :amount)', $params);
            }
            return $order_id;
        } else {
            return false;
        }
    }
}