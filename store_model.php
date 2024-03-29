<?php
require_once 'Model.php';

class Store_Model extends Model {
    public function __construct($database) {
        parent::__construct($database);
    }

    public function adjustCart() {
        if (!empty($this->amounts)) {
            foreach ($this->amounts as $id => $amount) {
                if ($amount == 0) {
                    removeFromCart($id);
                }
            }
        }
    }

    public function addOrder() {
        if (!cartExists()) {
            createCart();
        }
        addToCart($this->product_id, $this->amount);
        $this->page = 'details';
    }

    public function processOrder() {
        if ($this->total != 0) {
            try {
                $this->order_id = $this->db->saveOrder($this->total, $this->products, $this->customer_id);
                removeFromSession('cart');
            } catch (Exception $e) {
                $this->alert = 'Connection to database failed. Please try again or contact the site\'s administrator.';
            }
        } else {
            $this->page = 'cart';
            $this->cart_empty = true;
        }
    }

    public function processUpload() {
        if (isUserAdmin()) {
            $this->validateUpload();
        } else {
            $this->page = 'nice try';
        }
    }

    public function prepareEdit() {
        if (isUserAdmin()) {
            try {
                $product = $this->db->getProduct($this->product_id);
                $this->upload_name = $product['name'];
                $this->upload_image = $product['image'];
                $this->upload_price = $product['price'];
                $this->upload_description = $product['description'];
                $this->categories = explode(',', $product['tags']);
                $this->error_upload_name = '';
                $this->error_upload_image = '';
                $this->error_upload_price = '';
                $this->error_upload_description = '';
                $this->page = 'upload';
            } catch (Exception $e) {
                $this->alert = 'Connection to database failed. Please try again or contact the site\'s administrator.';
            }
        } else {
            $this->page = 'nice try';
        }
    }

    protected function validateUpload() {
        $max_filesize = 8000;
        try {
            $info = $this->db->getInfo($this->upload_name);
            if (($this->product_id > -1) && ($this->time <= $info['last_edited'])) {
                $product = $this->db->getProduct($info['id']);
                $this->upload_name = $product['name'];
                $this->upload_image = $product['image'];
                $this->upload_price = $product['price'];
                $this->upload_description = $product['description'];
                $this->categories = explode(',', $product['tags']);
                $this->error_upload_name = 'The page you tried to edit has been edited.';
            } else {
                if (!empty($this->upload_new)) {
                    if (filesize('img/' . $this->upload_new) < $max_filesize) {
                        $this->upload_image = 'img/' . $this->upload_new;
                    } else {
                        $this->error_upload_image = 'Chosen file is too big. Maximum size is: ' . $max_filesize;
                    }
                }
                if (empty($this->upload_image) && $info['image']) {
                    $this->upload_image = $info['image'];
                }
                if ($this->type == 'POST') {
                    $this->error_upload_name = empty($this->upload_name) ? 'Please enter a name.' : '';
                    $this->error_upload_image = empty($this->upload_image) && empty($this->error_upload_image) ? 'Please select a file.' : '';
                    $this->error_upload_price = $this->upload_price <= 0 ? 'Please enter a valid price.' : '';
                    $this->error_upload_description = empty($this->upload_description) ? 'Please enter a description.' : '';
                }
                if (!empty($this->upload_name) && !empty($this->upload_image) && !$this->upload_price <= 0 && !empty($this->upload_description)) {
                    if ($this->product_id == -1) {
                        $this->db->uploadProduct($this);
                        $this->page = 'upload succeeded';
                    } else {
                        $this->db->editProduct($this);
                        $this->page = 'upload succeeded';
                    }
                }
            }
        } catch (Exception $e) {
            $this->alert = $e->getMessage(); //'Connection to database failed. Please try again or contact the site\'s administrator.'
        }
    }
}