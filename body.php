<?php 

function showBodySection($data) {
    include 'menu.php';
    echo '<body>';
    showHeader($data);
    showMenu($data);
    showContent($data);
    showFooter();
    echo '</body>';
}

function showHeader($data){
    echo '<header>';
    echo $data['page'] != 'details' ? '<h1>'.$data['page'].'</h1>' : '<h1>'.$data['product_name'].'</h1>';
    echo '</header>';
}

function showContent($data) {
    switch ($data['page']) {
        case 'home':
            include 'home.php';
            showHomeContent();
            break;
        case 'dinostaur':
            include 'dinostaur.php';
            showWsHomeContent($data);
            break;
        case 'details':
            include 'dinostaur.php';
            showDetailsContent($data);
            break;
        case 'about':
            include 'about.php';
            showAboutContent();
            break;
        case 'contact':
            include 'contact.php';
            showContactForm($data);
            break;
        case 'contact_received':
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
        case 'cart':
            include 'cart.php';
            showCartContent($data);
            break;
        case 'order received':
            include 'cart.php';
            showOrderReceived($data);
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
