<?php
    $name = $_GET[name];
    $email = $_GET[email];
    $message = $_GET[message];
    
    if (in_array(null, $_GET)) {
        echo "
        <form action='contact.php'>
            <label for='name'>Name </label><input id='name' name='name' type='text' value='" . $name . "'><br>
            <label for='email'>Email </label><input id='email' name='email' type='email' value='" . $email . "'><br>
            <label for='message'>Message </label><textarea id=message' name='message'>" . $message . "</textarea><br>
            <input type='submit'><br>
        </form>
        ";
    } else {
        echo "Information received!<br>
        Name: " . $name . "<br>
        Email: " . $email . "<br>
        Message: " . $message;
    }
?>