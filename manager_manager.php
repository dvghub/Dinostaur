<?php 
include 'session_manager.php';
include 'sql_manager.php';

function loginUser($email) {
    $user = getUserByEmail($email);
    if ($user['found']) {
        login($user['name']);
    }
}

function save($email, $name, $password) {
    return saveUser($email, $name, $password);
}

function userByEmail($email) {
    getUserByEmail($email);
}

function authUser($email, $password) {
    $info = getUserByEmail($email);
    if (!$info['found']) {
        return array('status' => 'user_unknown');
    } else {
        if ($info['password'] != $password) {
            return array('status' => 'password_incorrect');
        } else {
            return array('status' => 'all_good', 'name' => $info['name']);
        }
    }
};