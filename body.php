<?php 
require 'menu.php';
require 'home.php';
require 'about.php';
require 'contact.php';
require 'login.php';
require 'register.php';
require 'form.php';

function showBodySection($data) {
    echo '    <body>';
    showHeader($data['page']);
    showMenu($data);
    showContent($data);
    showFooter();
    echo '    </body>';
}

function showHeader($page){
    echo '
    <header>
        <h1>'.$page.'</h1>
    </header>';
}

function showContent($data) {
    switch ($data['page']) {
        case 'home':
            showHomeContent();
            break;
        case 'about':
            showAboutContent();
            break;
        case 'contact':
            showContactContent($data);
            break;
        case 'login':
            showLoginContent($data);
            break;
        case 'register':
            showRegisterContent($data);
            break;
        case 'logout':
            logoutUser();
            echo "<script language='javascript'>window.location.href ='index.php?page=home'</script>";
        default:
            showError('Page ['.$data['page'].'] not found.');
            break;
    }
}

function showFooter() {
    echo "    <div id='footer-line'></div>
    <footer>&copy;2019 dvg</footer>";
}

function showError($error) {
    echo $error;
}
