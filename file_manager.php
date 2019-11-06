<?php 
function getFilePath(){
    return 'users/users.txt';
}

function emailOnFile($email) {
    $contents = file_get_contents(getFilePath());
    return preg_match('/'.$email.'/', $contents) ? true : false;
}

function saveUserToFile($email, $username, $password) {
    $file = fopen(getFilePath(), 'r+');
    fseek($file, 0, SEEK_END);
    $succes = fwrite($file, "\r\n".$email."|".$username."|".$password);
    fclose($file);
    return $succes;
}

function authUserInFile($email, $password) {
    $contents = file_get_contents(getFilePath());
    $pattern = preg_quote($email, '/');
    $pattern = "/^.*".$pattern.".*\$/m";    //Find line containing pattern

    //Grab line of matching email or return form
    if (preg_match($pattern, $contents, $matches)) {
        $info = explode('|',$matches[0]);
        $saved_password = $info[2];
        //If passwords match return user info
        return !($saved_password == $password) ? $info[1] : 'password_error';
    } else {
        return 'unknown_error';
    }
}