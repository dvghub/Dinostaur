<?php
require_once 'Form_Doc.php';

class Upload_Doc extends Form_Doc {
    public function __construct($data) {
        parent::__construct($data);
    }

    protected function content() {
        $time = date('Y-m-d H:i:s');

        $this->showFormStart('upload');
        $this->showFormInput('upload_name', 'Product name: ' , 'input', 'text', $this->_data['upload_name'], '[A-Za-z]{}', false, $this->_data['upload_name_error']);
        $this->showFormInput('upload_image', '' , 'input', 'hidden', $this->_data['upload_image'], '', false, '', false);
        echo "<span class='d-block float-left'></span>";
        $this->showFormInput('upload_new', 'Upload image: ' , 'input', 'file', '', '', false, $this->_data['upload_image_error'], true, "accept='image/png, image/jpg'");
        if ($this->_data['upload_image']) echo "<span class='d-block float-left col-12 col-md-auto'>Currently: ".$this->_data['upload_image']."</span>";
        $this->showFormInput('upload_price', 'Product price: ' , 'input', 'number', $this->_data['upload_price'], '', false, $this->_data['upload_price_error']);
        $this->showFormInput('upload_description', 'Product description: ' , 'textarea', '', $this->_data['upload_description'], '', false, $this->_data['upload_description_error']);
        echo "<span class='d-block float-left my-1 col-6 col-md-4 clear-left'>Select categories: </span>
          <span class='float-left col-6 col-md-8 px-0'>";
        foreach (getCategories() as $id => $category) {
            if ($category != 'all'){
                $check = $category == 'all' ? true : in_array($category, $this->_data['categories']);
                echo "<label class='d-block float-left my-1 col-7 col-md-3 clear-left'>".$category."</label>
                  <input class='float-left my-1 col-1' type='checkbox' name='categories[]' value='$category' ".($check ? 'checked' : '')."/>";
            }
        }
        echo "</span>";
        $this->showFormInput('time', '' , 'input', 'hidden', $time, '', false, '', false);
        $this->showFormInput('product_id', '' , 'input', 'hidden', $this->_data['product_id'], '', false, '', false);
        $this->showFormEnd('float-right clear-right height-50 col-12 col-sm-6 col-md-3 bg-cornflower border-0 text-white', 'UPLOAD');
    }
}