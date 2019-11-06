<?php
require_once 'Form_Doc.php';

class Upload_Doc extends Form_Doc {
    public function __construct($model) {
        parent::__construct($model);
    }

    protected function content() {
//        $this->debugPrint($this->_model);

        $time = date('Y-m-d H:i:s');

        $this->showFormStart('upload');
        $this->showFormInput('upload_name', 'Product name: ' , 'input', 'text', $this->_model->getUploadName(), '[A-Za-z]{}', false, $this->_model->getErrorUploadName());
        $this->showFormInput('upload_image', '' , 'input', 'hidden', '', '', false, '', false);
        echo "<span class='d-block float-left'></span>";
        $this->showFormInput('upload_new', 'Upload image: ' , 'input', 'file', '', '', false, $this->_model->getErrorUploadImage(), true);
        if ($this->_model->getUploadImage()) echo "<span class='d-block float-left col-12 col-md-auto'>Currently: ".$this->_model->getUploadImage()."</span>";
        $this->showFormInput('upload_price', 'Product price: ' , 'input', 'number', $this->_model->getUploadPrice(), '', false, $this->_model->getErrorUploadPrice());
        $this->showFormInput('upload_description', 'Product description: ' , 'textarea', '', $this->_model->getUploadDescription(), '', false, $this->_model->getErrorUploadDescription());
        echo "<span class='d-block float-left my-1 col-6 col-md-4 clear-left'>Select categories: </span>
          <span class='float-left col-6 col-md-8 px-0'>";
        foreach ($this->_model->getDb()->getCategories() as $id => $category) {
            if ($category != 'all'){
                $check = $category == 'all' ? true : in_array($category, $this->_model->getCategories());
                echo "<label class='d-block float-left my-1 col-7 col-md-3 clear-left'>".$category."</label>
                  <input class='float-left my-1 col-1' type='checkbox' name='categories[]' value='$category' ".($check ? 'checked' : '')."/>";
            }
        }
        echo "</span>";
        $this->showFormInput('time', '' , 'input', 'hidden', $time, '', false, '', false);
        $this->showFormInput('product_id', '' , 'input', 'hidden', $this->_model->getProductId(), '', false, '', false);
        $this->showFormEnd('float-right clear-right height-50 col-12 col-sm-6 col-md-3 bg-cornflower border-0 text-white', 'UPLOAD');
    }
}