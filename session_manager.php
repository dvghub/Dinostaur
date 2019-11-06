<?php 
function loginSessionUser($username) {
    $_SESSION['username'] = $username;
}

function isSessionUserLogged() {
    return array_key_exists('username', $_SESSION);
}

function getLoggedSessionUsername() {
    return $_SESSION['username'];
}

function logoutSessionUser() {
    session_destroy();
}