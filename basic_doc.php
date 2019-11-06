<?php
require_once 'Doc.php';

class Basic_Doc extends Doc {
    public function __construct($data) {
        parent::__construct($data);
    }

    private function title() {
        echo "<title>Dinostaur -- ".$this->_data['page']."</title>";
    }

    private function meta() {
        echo '<meta charset="utf-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
    }

    private function css() {
        echo '<link rel="stylesheet" href="css/bootstrap.css">';
        echo '<link rel="stylesheet" href="css/open-iconic-bootstrap.css">';
        echo '<link rel="stylesheet" href="css/style.css">';
    }

    private function header() {
        echo '<header class="d-none d-md-block text-center">';
        echo $this->_data['page'] != 'details' ? '<h1 class="text-uppercase">'.$this->_data['page'].'</h1>' : '<h1 class="text-uppercase">'.$this->_data['product_name'].'</h1>';
        echo '</header>';
    }

    private function menu() {
        $this->showMenuStart();
        $this->showMenuItem('home', 'HOME', $this->_data['page']);
        $this->showMenuItem('top', 'TOP 5', $this->_data['page']);
        $this->showMenuItem('dinostaur', 'DINOSTAUR', $this->_data['page']);
        $this->showMenuItem('about', 'ABOUT', $this->_data['page']);
        $this->showMenuItem('contact', 'CONTACT', $this->_data['page']);
        if (isUserLogged()) {
            if (isUserAdmin()) {
                $this->showMenuItem('upload', 'UPLOAD', $this->_data['page']);
            }
            $this->showMenuItem('logout', 'LOG OUT ', $this->_data['page'], strtoupper(getUserByEmail(getLoggedEmail())['name']));
            $this->showMenuItem('cart', 'CART (' . (cartExists() ? getAmountInCart() : 0) . ' ITEMS)', $this->_data['page'], '', true);
        } else {
            $this->showMenuItem('login', 'LOG IN', $this->_data['page']);
            $this->showMenuItem('register', 'REGISTER', $this->_data['page']);
        }
        $this->showMenuEnd();
    }

    protected function content() {}

    private function footer() {
        echo "<div id='footer-line' class='col-12 col-md-10 col-lg-8 mx-auto px-0 position-fixed bg-cornflower height-5'></div>
              <footer class='col-12 col-md-10 col-lg-8 mx-auto position-fixed px-1 py-1 bg-dark text-white text-right'>&copy;2019 dvg</footer>";
    }

    protected function headContent() {
        $this->title();
        $this->meta();
        $this->css();
    }

    protected function bodyContent() {
        $this->header();
        $this->menu();
        $this->content();
        $this->footer();
    }

    private function showMenuStart() {
        echo "<nav class='navbar navbar-expand-md bg-dark navbar-dark p-0'>
              <button type='button' class='navbar-toggler ' data-toggle='collapse' data-target='#collapsible' aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
              <span class='oi oi-menu' aria-label='menu'></span>
              </button>
              <div id='collapsible' class='collapse navbar-collapse'>
              <div class='navbar-nav'>";
    }

    private function showMenuItem($id, $title, $page, $extras = '', $cart = false) {
        echo "<a class='nav-item nav-link text-decoration-none text-white px-3 py-2 ".($page == $id ? 'active' : '')."' href='index.php?page=".$id."'>". ($cart ? "<span class='d-none d-sm-inline oi oi-cart' title='cart' aria-hidden='true' aria-label='".$id."'></span> " : '') .$title."<span class='d-none d-md-inline'>".$extras."</span></a>";
    }

    private function showMenuEnd() {
        echo "</div></div></nav><div class='col-12 bg-cornflower px-0 height-5 mb-3'></div>";
    }
}