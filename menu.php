<?php 
function showMenu($data) {
    $page = $data['page'];
    
    showMenuStart();
    showMenuItem('home', 'HOME', $page);
    showMenuItem('about', 'ABOUT', $page);
    showMenuItem('contact', 'CONTACT', $page);
    if (isUserLogged()) {
        showMenuItem('logout', 'LOG OUT '.strtoupper(getLoggedUsername()), $page);
    } else {
        showMenuItem('login', 'LOG IN', $page);
        showMenuItem('register', 'REGISTER', $page);
    }
    showMenuEnd();
}

function showMenuStart() {
    echo '    <nav>';
}
function showMenuItem($id, $title, $page) {
    echo '<a href=\'index.php?page='.$id.($page == $id ? '\' class=\'active\'' : '').'\'>'.$title.'</a>';
}
function showMenuEnd() {
    echo '    </nav>
    <div id=\'nav-line\'></div>';
}