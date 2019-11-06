<?php 
function showMenu($data) {
    $page = $data['page'];
    
    showMenuStart();
    showMenuItem('home', 'HOME', $page);
    showMenuItem('top', 'TOP 5', $page);
    showMenuItem('dinostaur', 'DINOSTAUR', $page);
    showMenuItem('about', 'ABOUT', $page);
    showMenuItem('contact', 'CONTACT', $page);
    if (isUserLogged()) {
        if (isUserAdmin()) {
            showMenuItem('upload', 'UPLOAD', $page);
        }
        showMenuItem('logout', 'LOG OUT ', $page, strtoupper(getUserByEmail(getLoggedEmail())['name']));
        showMenuItem('cart', 'CART (' . (cartExists() ? getAmountInCart() : 0) . ' ITEMS)', $page, '', true);
    } else {
        showMenuItem('login', 'LOG IN', $page);
        showMenuItem('register', 'REGISTER', $page);
    }
    showMenuEnd();
}

function showMenuStart() {
    echo "<nav class='navbar navbar-expand-md bg-dark navbar-dark p-0'>
              <button type='button' class='navbar-toggler ' data-toggle='collapse' data-target='#collapsible' aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
                  <span class='oi oi-menu' aria-label='menu'></span>
              </button>
              <div id='collapsible' class='collapse navbar-collapse'>
                  <div class='navbar-nav'>";
}
function showMenuItem($id, $title, $page, $extras = '', $cart = false) {
    echo "            <a class='nav-item nav-link text-decoration-none text-white px-3 py-2 ".($page == $id ? 'active' : '')."' href='index.php?page=".$id."'>". ($cart ? "<span class='d-none d-sm-inline oi oi-cart' title='cart' aria-hidden='true' aria-label='".$id."'></span> " : '') .$title."<span class='d-none d-md-inline'>".$extras."</span></a>";
}
function showMenuEnd() {
    echo "</div></div></nav>
          <div class='col-12 bg-cornflower px-0 height-5 mb-3'></div>";
}
