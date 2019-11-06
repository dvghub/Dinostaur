<?php
require_once 'Model.php';

class User_Model extends Model {
    public function __construct($database) {
    parent::__construct($database);
}

    public function validateContact() {
        if ($this->type == 'POST') {
            $this->error_name = empty($this->name) ? 'Please enter your name.' : '';
            $this->error_email = empty($this->email) ? 'Please enter an email address.' : '';
            $this->error_message = empty($this->message) ? 'Please enter your message.' : '';

            if (!empty($this->email)) {
                if ($this->validateEmail($this->email)) {
                    if (empty($this->error_name) && empty($this->error_message)) {
                        $this->page = 'contact received';
                    }
                } else {
                    $this->error_email = 'Please enter a valid email address.';
                }
            }
        }
    }

    public function validateLogin() {
        if ($this->type == 'POST') {
            $this->error_email = empty($this->email) ? 'Please enter an email address.' : '';
            $this->error_password = empty($this->password) ? 'Please enter a password.' : '';
        }

        if (!empty($this->email) && !empty($this->password)) {
            if ($this->validateEmail($this->email)) {
                $result = $this->db->authUser($this->email, $this->password);
                switch ($result['status']) {
                    case 'user_unknown':
                        $this->error_email = 'This email is not in our database. Please try again or register.';
                        break;
                    case 'password_incorrect':
                        $this->error_password = 'This password is incorrect.';
                        break;
                    case 'all_good':
                        $this->name = $result['name'];
                        try {
                            loginUser($this->email, $this->db->isAdmin($this->email));
                        } catch (Exception $e) {
                            $this->alert = 'Connection to database failed. Please try again or contact the site\'s administrator.';
                        }
                        $this->page = 'home';
                        break;
                    default:
                        $this->error_email = 'Something went wrong. Please try again.';
                        break;
                }
            } else {
                $this->error_email = 'Please enter a valid email address.';
            }
        }
    }

    public function validateRegistration() {
        if ($this->type == 'POST') {
            $this->error_name = empty($this->name) ? 'Please enter your name.' : '';
            $this->error_email = empty($this->email) ? 'Please enter an email address.' : '';
            $this->error_password = empty($this->password) ? 'Please enter a password.' : '';
            $this->error_password2 = empty($this->password2) ? 'Please repeat your password.' : '';
        }

        if (!empty($this->name) && !empty($this->email) && !empty($this->password) && !empty($this->password2)) {
            if ($this->validateEmail($this->email)) {
                if ($this->password == $this->password2) {
                    try {
                        $user = $this->db->userByEmail($this->email);
                        if (!$user) {
                            if ($this->db->save($this->email, $this->name, password_hash($this->password, PASSWORD_BCRYPT))) {
                                $this->page = 'login';
                            } else {
                                $this->error_name = "Something went wrong. Please try again.";
                            }
                        } else {
                            $this->error_email = 'This email address is already in our database.';
                        }
                    } catch (Exception $e) {
                        $this->alert = $e->getMessage();    //'Connection to database failed. Please try again or contact the site\'s administrator.'
                    }
                } else {
                    $this->error_password2 = 'Passwords do not match.';
                }
            } else {
                $this->error_email = 'Please enter a valid email address.';
            }
        }
    }

    private function validateEmail($email) {
        return preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $email) ? true : false;
    }

    public function logout() {
        logoutUser();
        $this->page = 'home';
    }
}