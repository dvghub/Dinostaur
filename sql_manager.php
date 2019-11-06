<?php 
function connect() {
    $db_host = 'localhost';
    $db_username = 'sql_manager';
    $db_password = '';
    $db_name = 'dinostaur';
    return mysqli_connect($db_host, $db_username, $db_password, $db_name);
}

function getUserByEmail($email) {
    $sql = "SELECT name, password FROM users WHERE email= '".$email."'";
    $result = query($sql, 0);
    if ($result) {
        return array('found' => true, 'name' => $result['name'], 'password' => $result['password']);
    } else {
        return array('found' => false, 'name', 'password');
    }
}

function saveUser($email, $name, $password) {
    $sql = 'INSERT INTO users (email, name, password) 
    VALUES ("'.$email.'", "'.$name.'", "'.$password.'")';
    $result = query($sql, 1);
    return $result;
}

function query($sql, $type) {
    $db = connect();
    if ($db) {
        switch ($type) {
            case 0:     //SELECT
                $result = mysqli_query($db, $sql);
                return mysqli_fetch_assoc($result);
                break;
            case 1:     //INSERT
                return mysqli_query($db, $sql);
                break;
        }
    } else {
        showMessage('Could not connect to database. Please try again or contact an administrator.');
    }
    mysqli_close($db);
}