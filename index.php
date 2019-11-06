<?php 
session_start();

include 'html.php';
include 'body.php';
include 'validation.php';
include 'manager_manager.php';
include 'session_manager.php';

$data = getRequestData();
$data = process($data);
showRequestedPage($data);

function getRequestData() {
    $request_type = $_SERVER['REQUEST_METHOD'];
    
    if ($request_type == 'POST') {
        $requested_page = testInput(getPostVar('page', 'home'));
        $name = testInput(getPostVar('name', ''));
        $email = testInput(getPostVar('email', ''));
        $message = testInput(getPostVar('message', ''));
        $password = testInput(getPostVar('password', ''));
        $password2 = testInput(getPostVar('password2', ''));
        $category = testInput(getPostVar('category', 'all'));
        $product_id = testInput(getPostVar('product_id', -1));
        $product_name = testInput(getPostVar('product_name', ''));
        $amount = testInput(getPostVar('amount', 0));
        $amounts = array_key_exists('amounts', $_POST) ? $_POST['amounts'] : array();
        $products = array_key_exists('products', $_POST) ? $_POST['products'] : array();
        $categories = array_key_exists('categories', $_POST) ? $_POST['categories'] : array();
        $total = testInput(getPostVar('total', 0));
        $customer_id = testInput(getPostVar('customer_id', -1));
        $upload_name = testInput(getPostVar('upload_name', ''));
        $upload_image = testInput(getPostVar('upload_image', ''));
        $upload_price = testInput(getPostVar('upload_price', 0));
        $upload_description = testInput(getPostVar('upload_description', ''));
        $time = testInput(getPostVar('time', 0));
    } else {
        $requested_page = testInput(getUrlVar('page', 'home'));
        $name = '';
        $email = '';
        $message = '';
        $password = '';
        $password2 = '';
        $category = testInput(getUrlVar('category', 'all'));
        $product_id = testInput(getUrlVar('product_id', -1));
        $product_name = testInput(getUrlVar('product_name', ''));
        $amount = 0;
        $amounts = array();
        $products = array();
        $categories = array();
        $total = 0;
        $customer_id = -1;
        $upload_name = '';
        $upload_image = '';
        $upload_price = 0;
        $upload_description = '';
        $time = 0;
    }
    return array('page'=>$requested_page, 'type'=>$request_type, 'name'=>$name, 'email'=>$email, 'message'=>$message,
        'password'=>$password, 'password2'=>$password2, 'category'=>$category, 'product_id'=>$product_id,
        'product_name'=>$product_name, 'amount'=>$amount, 'amounts'=>$amounts, 'products'=>$products, 'categories'=>$categories,
        'total'=>$total, 'customer_id'=>$customer_id, 'upload_name'=>$upload_name, 'upload_image'=>$upload_image,
        'upload_price'=>$upload_price, 'upload_description'=>$upload_description, 'time'=>$time);
}

function process($data) {
    switch ($data['page']) {
        case 'contact':
            $data = validateContact($data);
            if ($data['valid']) {
                $data['page'] = 'contact_received';
            }
            return $data;
            break;
        case 'login': 
            $data = validateLogin($data);
            if ($data['valid']) {
                $admin = isAdmin($data['email']);
                loginUser($data['email'], $admin);
                $data['page'] = 'home';
            }
            return $data;
            break;
        case 'register':
            $data = validateRegistration($data);
            if ($data['valid']) {
                $data['page'] = 'login';
            }
            return $data;
            break;
        case 'upload':
            if (isUserAdmin()) {
                if ($data['product_id'] == -1) {
                    //upload
                    $data = validateUpload($data);
                    if ($data['valid']) {
                        if (uploadProduct($data)) {
                            $data['page'] = 'upload succeeded';
                        } else {
                            $data['upload_name_error'] = 'Something went wrong please try again.';
                        }
                    }
                } else {
                    //edit
                    $data = validateUpload($data);
                    if ($data['valid']) {
                        if (editProduct($data)) {
                            $data['page'] = 'upload succeeded';
                        } else {
                            $data['upload_name_error'] = 'Something went wrong please try again.';
                        }
                    }
                }
            } else {
                $data['page'] = 'nice try';
            }
            return $data;
            break;
        case 'edit':
            if (isUserAdmin()) {
                $product = getProductByID($data['product_id']);
                $data['upload_name'] = $product['name'];
                $data['upload_image'] = $product['image'];
                $data['upload_price'] = $product['price'];
                $data['upload_description'] = $product['description'];
                $data['categories'] = explode(',', $product['tags']);
                $data['upload_name_error'] = '';
                $data['upload_image_error'] = '';
                $data['upload_price_error'] = '';
                $data['upload_description_error'] = '';
                $data['page'] = 'upload';
            } else {
                $data['page'] = 'nice try';
            }
            return $data;
            break;
        case 'logout':
            logoutUser();
            $data['page'] = 'home';
            return $data;
            break;
        case 'order':
            if (!cartExists()) {
                createCart();
            }
            addToCart($data['product_id'], $data['amount']);
            $data['page'] = 'details';
            return $data;
            break;
        case 'cart':
            if (!empty($data['amounts'])) {
                foreach ($data['amounts'] as $id => $amount) {
                    if ($amount == 0) {
                        removeFromCart($id);
                    }
                }
            }
            return $data;
            break;
        case 'order received':
            if ($data['total'] != 0) {
                $data['order_id'] = saveOrder($data['total'], $data['products'], $data['customer_id']);
                removeFromSession('cart');
            } else {
                $data['page'] = 'cart';
                $data['cart_empty'] = true;
            }
            return $data;
            break;
        case 'home':
        case 'top':
        case 'dinostaur':
        case 'details':
        case 'about':
        default:
            return $data;
            break;
    }
}

function showRequestedPage($data) {
    beginDocument();
    showHeadSection();
    showBodySection($data);
    endDocument();
}

function getPostVar($key, $default='') {
    $value = filter_input(INPUT_POST, $key);
    return isset($value) ? $value : $default;
}

function getUrlVar($key, $default='') {
    $value = filter_input(INPUT_GET, $key);
    return isset($value) ? $value : $default;
}

function testInput($data) {
  $data = trim($data);
  $data = addslashes($data);
  $data = htmlentities($data);
  return $data;
}
