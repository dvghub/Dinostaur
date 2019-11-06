<?php
  include_once "home_doc.php";

  $data = array ( 'page' => 'home' );
  $view = new Home_Doc($data);
  $view->show();