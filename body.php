<?php 

function showBodySection($data) {
    include 'menu.php';
    include 'javascript.php';
    echo '<body class="col-12 col-md-10 col-lg-8 px-0 mx-md-auto pb-5 text-dark">';
    showHeader($data);
    showMenu($data);
    showContent($data);
    showFooter();
    showScripts();
    echo '</body>';
}

function showHeader($data){
    echo "<header class='d-none d-md-block text-center'>";
    echo $data['page'] != 'details' ? '<h1 class="text-uppercase">'.$data['page'].'</h1>' : '<h1 class="text-uppercase">'.$data['product_name'].'</h1>';
    echo '</header>';
}

function showContent($data) {
    switch ($data['page']) {
        case 'home':
            include 'home.php';
            showHomeContent();
            break;
        case 'top':
            include 'top.php';
            showTopSold();
            break;
        case 'dinostaur':
            include 'dinostaur.php';
            showDinostaurContent($data);
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
        case 'upload':
            include 'upload.php';
            showUpload($data);
            break;
        case 'upload succeeded':
            include 'upload.php';
            showUploadSucceeded();
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
    echo "<div id='footer-line' class='col-12 col-md-10 col-lg-8 mx-auto px-0 position-fixed bg-cornflower height-5'></div>
          <footer class='col-12 col-md-10 col-lg-8 mx-auto position-fixed px-1 py-1 bg-dark text-white text-right'>&copy;2019 dvg</footer>";
}

function showError($error) {
    echo $error;
}

function showMessage($message) {
    echo "<span class='d-block col-12 border border-danger text-danger text-center my-3'>".$message."</span>";
}

function debugPrint($stuff) {
    echo '<pre>';
    print_r($stuff);
    echo '</pre>';
}
