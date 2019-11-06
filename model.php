<?php

class Model {
    protected $type = '';
    protected $page = '';
    protected $alert = '';
    protected $name = '';
    protected $error_name = '';
    protected $email = '';
    protected $error_email = '';
    protected $message = '';
    protected $error_message = '';
    protected $password = '';
    protected $error_password = '';
    protected $password2 = '';
    protected $error_password2 = '';
    protected $category = '';
    protected $product_id = '';
    protected $product_name = '';
    protected $amount = 0;
    protected $amounts = array();
    protected $products = array();
    protected $categories = array();
    protected $total = 0;
    protected $order_id = -1;
    protected $customer_id = -1;
    protected $upload_name = '';
    protected $error_upload_name = '';
    protected $upload_new = '';
    protected $upload_image = '';
    protected $error_upload_image = '';
    protected $upload_price = 0;
    protected $error_upload_price = 0;
    protected $upload_description = '';
    protected $error_upload_description = '';
    protected $time = 0;
    protected $cart_empty = true;

    protected $db;

    public function __construct($database) {
        $this->type = $_SERVER['REQUEST_METHOD'];
        $this->db = $database;
    }

    public function setModel() {
        if ($this->type == 'POST') {
            $this->page = $this->testInput($this->getPostVar('page', 'home'));
            $this->alert = $this->testInput($this->getPostVar('alert', ''));
            $this->name = $this->testInput($this->getPostVar('name', ''));
            $this->email = $this->testInput($this->getPostVar('email', ''));
            $this->message = $this->testInput($this->getPostVar('message', ''));
            $this->password = $this->testInput($this->getPostVar('password', ''));
            $this->password2 = $this->testInput($this->getPostVar('password2', ''));
            $this->category = $this->testInput($this->getPostVar('category', 'all'));
            $this->product_id = $this->testInput($this->getPostVar('product_id', -1));
            $this->product_name = $this->testInput($this->getPostVar('product_name', ''));
            $this->amount = $this->testInput($this->getPostVar('amount', 0));
            $this->amounts = array_key_exists('amounts', $_POST) ? $_POST['amounts'] : array();
            $this->products = array_key_exists('products', $_POST) ? $_POST['products'] : array();
            $this->categories = array_key_exists('categories', $_POST) ? $_POST['categories'] : array();
            $this->total = $this->testInput($this->getPostVar('total', 0));
            $this->customer_id = $this->testInput($this->getPostVar('customer_id', -1));
            $this->upload_name = $this->testInput($this->getPostVar('upload_name', ''));
            $this->upload_image = $this->testInput($this->getPostVar('upload_image', ''));
            $this->upload_new = $this->testInput($this->getPostVar('upload_new', ''));
            $this->upload_price = $this->testInput($this->getPostVar('upload_price', 0));
            $this->upload_description = $this->testInput($this->getPostVar('upload_description', ''));
            $this->time = $this->testInput($this->getPostVar('time', 0));
        } else {
            $this->page = $this->testInput($this->getUrlVar('page', 'home'));
            $this->category = $this->testInput($this->getUrlVar('category', 'all'));
            $this->product_id = $this->testInput($this->getUrlVar('product_id', -1));
            $this->product_name = $this->testInput($this->getUrlVar('product_name', ''));
        }
    }

    public function getType() {
        return $this->type;
    }

    public function getPage() {
        return $this->page;
    }

    public function getAlert() {
        return $this->alert;
    }

    public function getName() {
        return $this->name;
    }

    public function getErrorName() {
        return $this->error_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getErrorEmail() {
        return $this->error_email;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getErrorMessage() {
        return $this->error_message;
    }

    public function getErrorPassword() {
        return $this->error_password;
    }

    public function getErrorPassword2() {
        return $this->error_password2;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getProductName() {
        return $this->product_name;
    }

    public function getProductId() {
        return $this->product_id;
    }

    public function getAmounts() {
        return $this->amounts;
    }

    public function getCategories() {
        return $this->categories;
    }

    public function getOrderId() {
        return $this->order_id;
    }

    public function getUploadName() {
        return $this->upload_name;
    }

    public function getErrorUploadName() {
        return $this->error_upload_name;
    }

    public function getUploadImage() {
        return $this->upload_image;
    }

    public function getErrorUploadImage() {
        return $this->error_upload_image;
    }

    public function getUploadPrice() {
        return $this->upload_price;
    }

    public function getErrorUploadPrice() {
        return $this->error_upload_price;
    }

    public function getUploadDescription() {
        return $this->upload_description;
    }

    public function getErrorUploadDescription() {
        return $this->error_upload_description;
    }

    public function getDb() {
        return $this->db;
    }

    private function getPostVar($key, $default='') {
        $value = filter_input(INPUT_POST, $key);
        return isset($value) ? $value : $default;
    }

    private function getUrlVar($key, $default='') {
        $value = filter_input(INPUT_GET, $key);
        return isset($value) ? $value : $default;
    }

    private function testInput($data) {
        $data = trim($data);
        $data = addslashes($data);
        $data = htmlentities($data);
        return $data;
    }
}
