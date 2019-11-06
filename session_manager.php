<?php 
function login($name) {
    $_SESSION['name'] = $name;
}

function isUserLogged() {
    return array_key_exists('name', $_SESSION);
}

function getLoggerUsername() {
    return $_SESSION['name'];
}

function logoutUser() {
    session_unset();
    session_destroy();
}

function setSessionVar($id, $value) {
    $_SESSION[$id] = $value;
}

function getSessionVar($id) {
    return array_key_exists($id, $_SESSION) ? $_SESSION[$id] : null;
    
}
