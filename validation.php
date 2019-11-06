<?php 

function validateContact($data) {
    $data['valid'] = false;
    if ($data['type'] == 'POST') {
        $data['error_name'] = empty($data['name']) ? 'Please enter your name.' : '';
        $data['error_email'] = empty($data['email']) ? 'Please enter an email address.' : '';
        $data['error_message'] = empty($data['message']) ? 'Please enter your message.' : '';

        if (!empty($data['email'])) {
            if (!validateEmail($data['email'])) {
                $data['error_email'] = 'Please enter a valid email address.';
            }
        }
        if (!empty($data['name']) && $data['error_email'] == '' && !empty($data['message'])) {
            $data['valid'] = true;
        }
    } else {
        $data['error_name'] = '';
        $data['error_email'] = '';
        $data['error_message'] = '';
    }
    return $data;
}

function validateLogin($data) {
    $data['valid'] = false;
    if ($data['type'] == 'POST') {
        $data['error_email'] = empty($data['email']) ? 'Please enter an email address.' : '';
        $data['error_password'] = empty($data['password']) ? 'Please enter a password.' : '';
    } else {
        $data['error_email'] = '';
        $data['error_password'] = '';
    }

    if (!empty($data['email']) && !empty($data['password'])) {
        if (validateEmail($data['email'])) {
            $result = authUser($data['email'], $data['password']);
            switch ($result['status']) {
                case 'user_unknown': 
                    $data['error_email'] = 'This email is not in our database. Please try again or register.';
                    break;
                case 'password_incorrect':
                    $data['error_password'] = 'This password is incorrect.';
                    break;
                case 'all_good':
                    $data['valid'] = true;
                    $data['name'] = $result['name'];
                    break;
                default: 
                    $data['error_email'] = 'Something went wrong. Please try again.';
                    break;
            }
        } else {
            $data['error_email'] = 'Please enter a valid email address.';
        }
    }
    return $data;
}

function validateRegistration($data) {
    $data['valid'] = false;
    if ($data['type'] == 'POST') {
        $data['error_name'] = empty($data['name']) ? 'Please enter your name.' : '';
        $data['error_email'] = empty($data['email']) ? 'Please enter an email address.' : '';
        $data['error_password'] = empty($data['password']) ? 'Please enter a password.' : '';
        $data['error_password2'] = empty($data['password2']) ? 'Please repeat your password.' : '';
    } else {
        $data['error_name'] = '';
        $data['error_email'] = '';
        $data['error_password'] = '';
        $data['error_password2'] = '';
    }
   
    if (!empty($data['name']) && !empty($data['email']) && !empty($data['password']) && !empty($data['password2'])) {
        if (validateEmail($data['email'])) {
            if ($data['password'] == $data['password2']) {
                if (!userByEmail($data['email'])) {
                    if (save($data['email'], $data['name'], $data['password'])) {
                        $data['valid'] = true;
                    } else {
                        $data['error_name'] = "Something went wrong. Please try again.";
                    }
                } else {
                    $data['error_email'] = 'This email address is already in our database.';
                }
            } else {
                $data['error_password2'] = 'Passwords do not match.';
            }
        } else {
            $data['error_email'] = 'Please enter a valid email address.';
        }
    }
    return $data;
}

function validateEmail($email) {
    return preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $email) ? true : false;
}

function validateUpload($data) {
    $data['valid'] = false;
    $info = getInfo($data['upload_name']);
    $max_filesize = 2048;

    if (($data['product_id'] > -1) && ($data['time'] <= $info['last_edited'])) {
        showMessage("The page you tried to edit has been edited.");
        $product = getProductByID($info['id']);
        $data['upload_name'] = $product['name'];
        $data['upload_image'] = $product['image'];
        $data['upload_price'] = $product['price'];
        $data['upload_description'] = $product['description'];
        $data['categories'] = explode(',', $product['tags']);
        $data['upload_name_error'] = '';
        $data['upload_image_error'] = '';
        $data['upload_price_error'] = '';
        $data['upload_description_error'] = '';
    } else {
        if (!empty($data['upload_new'])) {
            if (file($data['upload_new']) < $max_filesize) {
                $data['upload_image'] = $data['upload_new'];
            } else {
                showMessage('Chosen file is too big. Maximum size is: '.$max_filesize);
            }
        } elseif (empty($data['upload_image']) && $info['image']) {
            $data['upload_image'] = $info['image'];
        }

        if ($data['type'] == 'POST') {
            $data['upload_name_error'] = empty($data['upload_name']) ? 'Please enter a name.' : '';
            $data['upload_image_error'] = empty($data['upload_image']) ? 'Please select a file.' : '';
            $data['upload_price_error'] = $data['upload_price'] <= 0 ? 'Please enter a valid price.' : '';
            $data['upload_description_error'] = empty($data['upload_description']) ? 'Please enter a description.' : '';
        } else {
            $data['upload_name_error'] = '';
            $data['upload_image_error'] = '';
            $data['upload_price_error'] = '';
            $data['upload_description_error'] = '';
        }

        if (!empty($data['upload_name']) && !empty($data['upload_image']) && !$data['upload_price'] <= 0 && !empty($data['upload_description'])) {
            $data['valid'] = true;
        }
    }
    return $data;
}
