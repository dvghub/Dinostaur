<?php 

function validateContact($data) {
    if (!empty($data['name']) && !empty($data['email']) && !empty($data['message'])) {
        if (preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $data['email'])) {
            $data['valid'] = true;
            return $data;
        } else {
            $data['error_email'] = 'Please enter a valid email address.';
            return $data;
        }
    } else {
        if ($data['type'] == 'POST') {
            $data['error_name'] = empty($data['name']) ? 'Please enter your name.' : '';
            $data['error_email'] = empty($data['email']) ? 'Please enter an email address.' : '';
            $data['error_message'] = empty($data['message']) ? 'Please enter your message.' : '';
        } else {
            $data['error_name'] = '';
            $data['error_email'] = '';
            $data['error_message'] = '';
        }
        return $data;
    }
}

function validateLogin($data) {
    
    if (!empty($data['email']) && !empty($data['password'])) {
        if (preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $data['email'])) {
            $result = authUser($data['email'], $data['password']);
            switch ($result['status']) {
                case 'user_unknown': 
                    $data['error_email'] = 'This email is not in our database. Please try again or register.';
                    return $data;
                    break;
                case 'password_incorrect':
                    $data['error_password'] = 'This password is incorrect.';
                    return $data;
                    break;
                case 'all_good':
                    $data['valid'] = true;
                    return $data;
                    break;
                default: 
                    $data['error_email'] = 'Something went wrong. Please try again.';
                    return $data;
                    break;
            }
        } else {
            $data['error_email'] = 'Please enter a valid email address.';
            return $data;
        }
    } else {
        if ($data['type'] == 'POST') {
            $data['error_email'] = empty($data['email']) ? 'Please enter an email address.' : '';
            $data['error_password'] = empty($data['password']) ? 'Please enter a password.' : '';
        } else {
            $data['error_email'] = '';
            $data['error_password'] = '';
        }
        return $data;
    }
}

function validateRegistration($data) {
   
    if (!empty($data['name']) && !empty($data['email']) && !empty($data['password']) && !empty($data['password2'])) {
        if (!userByEmail($data['email'])['found']){
            if ($data['password'] == $data['password2']) {
                if (save($data['email'], $data['name'], $data['password'])) {
                    $data['valid'] = true;
                    return $data;
                } else {
                    $data['error_name'] = 'Something went wrong, please try again.';
                    return $data;
                }
            } else {
                $data['error_password2'] = 'Passwords do not match.';
                return $data;
            }
        } else {
            $data['error_email'] = 'This email address is already in our database.';
            return $data;
        }
    } else {
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
        return $data;
    }
}
