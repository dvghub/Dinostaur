<?php 
include 'file_manager.php';
include 'session_manager.php';

function saveUser($email, $username, $password) {
    return saveUserToFile($email, $username, $password);
}

function emailKnown($email) {
    return emailOnFile($email);
}

function authUser($email, $password) {
    return authUserInFile($email, $password);
};

function loginUser($username) {
    loginSessionUser($username);
}

function isUserLogged() {
    return isSessionUserLogged();
}

function getLoggedUsername() {
    return getLoggedSessionUsername();
}

function logoutUser() {
    logoutSessionUser();
}
