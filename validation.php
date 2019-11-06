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
