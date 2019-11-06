<?php 
function getFilePath(){
    return 'users/users.txt';
}

function getUserByEmail($email) {
    $contents = file_get_contents(getFilePath());
    $pattern = preg_quote($email, '/');
    $pattern = "/^.*".$pattern.".*\$/m";
    
    if (preg_match($pattern, $contents, $matches)) {
        $info = explode('|',$matches[0], 3);
        return array ('found' => true, 'name' => $info[1], 'password' => $info[2]);
    } else {
        return array ('found' => false, 'name', 'password');
    }
}

function saveUser($email, $name, $password) {
    $file = fopen(getFilePath(), 'r+');
    fseek($file, 0, SEEK_END);
    $succes = fwrite($file, "\r\n".$email."|".$name."|".$password);
    fclose($file);
    return $succes;
}
