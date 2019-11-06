<?php
function showUpload($data) {
    include 'form.php';
    $time = date('Y-m-d H:i:s');

    showFormStart('upload');
    showFormInput('upload_name', 'Product name: ' , 'input', 'text', $data['upload_name'], '[A-Za-z]{}', false, $data['upload_name_error']);
    showFormInput('upload_image', '' , 'input', 'hidden', $data['upload_image'], '', false, '', false);
    echo "<span class='d-block float-left'></span>";
    showFormInput('upload_new', 'Upload image: ' , 'input', 'file', '', '', false, $data['upload_image_error'], true, "accept='image/png, image/jpg'");
    if ($data['upload_image']) echo "<span class='d-block float-left col-12 col-md-auto'>Currently: ".$data['upload_image']."</span>";
    showFormInput('upload_price', 'Product price: ' , 'input', 'number', $data['upload_price'], '', false, $data['upload_price_error']);
    showFormInput('upload_description', 'Product description: ' , 'textarea', '', $data['upload_description'], '', false, $data['upload_description_error']);
    echo "<span class='d-block float-left my-1 col-6 col-md-4 clear-left'>Select categories: </span>
          <span class='float-left col-6 col-md-8 px-0'>";
    foreach (getCategories() as $id => $category) {
        if ($category != 'all'){
            $check = $category == 'all' ? true : in_array($category, $data['categories']);
            echo "<label class='d-block float-left my-1 col-7 col-md-3 clear-left'>".$category."</label>
                  <input class='float-left my-1 col-1' type='checkbox' name='categories[]' value='$category' ".($check ? 'checked' : '')."/>";
        }
    }
    echo "</span>";
    showFormInput('time', '' , 'input', 'hidden', $time, '', false, '', false);
    showFormInput('product_id', '' , 'input', 'hidden', $data['product_id'], '', false, '', false);
    showFormEnd('float-right clear-right height-50 col-12 col-sm-6 col-md-3 bg-cornflower border-0 text-white', 'UPLOAD');
}

function showUploadSucceeded() {
    echo "<span>Upload succeeded.</span>";
}
