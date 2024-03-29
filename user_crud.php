<?php
include_once 'Crud.php';

class User_Crud extends Crud {
    public function save($email, $name, $password) {
        $params = array(':email'=>$email, ':name'=>$name, ':password'=>$password);
        return $this->create('INSERT INTO users (email, name, password) VALUES (:email, :name, :password)', $params);
    }

    public function isAdmin($email) {
        return $this->userByEmail($email)['admin'];
    }

    public function authUser($email, $password) {
        $info = $this->userByEmail($email);
        if (!$info) {
            return array('status' => 'user_unknown');
        } else {
            if (password_verify($password, $info['password'])) {
                return array('status' => 'all_good', 'name' => $info['name']);
            } else {

                return array('status' => 'password_incorrect');
            }
        }
    }
}