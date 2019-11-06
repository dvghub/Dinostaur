<?php 

function showBodySection($data) {
    include 'menu.php';
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
            include 'home.php';
            showHomeContent();
            break;
        case 'about':
            include 'about.php';
            showAboutContent();
            break;
        case 'contact':
            include 'contact.php';
            showContactForm($data);
            break;
        case 'received':
            include 'contact.php';
            showReceived($data);
            break;
        case 'login':
            include 'login.php';
            showLoginForm($data);
            break;
        case 'register':
            include 'register.php';
            showRegistrationForm($data);
            break;
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

function showMessage($message) {
    echo "
        <span id='alert'>".$message."</span>
    ";
}
