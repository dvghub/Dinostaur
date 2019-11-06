<?php
function showWsHomeContent($data) {
    $products = getProducts($data['category']);

    $categories = getCategories();
    showCategories($categories);
    if ($products) {
        showProducts($products);
    }
}

function showCategories($categories) {
    echo "<form>
        <input type='hidden' name='page' value='dinostaur'>
        <span class='col-12 d-block mb-2'>Show: 
            <select name='category' onchange='this.form.submit()'>";
    foreach ($categories as $category) {
        echo "<option value='".$category."' ".($category == 'all' ? 'selected' : '')."><span class='text-capitalize'>".$category."</span></option>";
    }
    echo "</select></span></form>";
}

function showProducts($products) {
    echo "<div class='col-12 d-flex flex-wrap'>";
    foreach ($products as $product) {
        echo "<article class='col-12 col-sm-6 col-md-4 col-lg-3 float-left p-2 tile d-flex flex-wrap'>
              <img class='col-12 mb-auto p-0' src='".$product['image']."'>
              <span class='mt-auto col-12 d-flex flex-wrap p-0'>
                  <span class='float-left clear-left font-weight-bold col-12'>" .$product['name']. "</span>
                  <span class='float-left clear-left col-6'>&euro;" .$product['price']."</span>";
        if (isUserLogged()) {
            echo "<form action='index.php' method='post' class='col-6'>
                      <input type='hidden' name='product_id' value='" . $product['id'] . "'>
                      <input type='hidden' name='product_name' value='" . $product['name'] . "'>
                      <input type='hidden' name='page' value='details'>
                      <input type='submit' value='ORDER' class='tile-order float-right clear-right col-12 bg-cornflower text-decoration-none text-white border-0'>
                  </form>";
        }
        echo '</span></article>';
    }
    echo "</div>";
}

function showDetailsContent($data) {
    include 'form.php';
    $product = getProduct($data['product_id']);
    $tags = '';

    echo "
    <img class='float-left float-md-right col-12 col-md-6' src='".$product['image']."'>
    <span class='text-justify float-left clear-left col-12 col-md-6'>" .$product['description']. "</span>";
    foreach (explode(',', $product['tags']) as $id => $tag) {
        $id == 0 ? $tags = '#' . $tag : $tags .= ', #' . $tag;
    }
    echo "
    <span class='float-left clear-left font-weight-light col-12 col-md-6 font-italic'>".$tags."</span>
    <span class='float-left clear-left font-weight-bold  col-12 col-md-6'>&euro;" .$product['price']. "</span>";
    if (isUserLogged()) {
        echo "
        <form method='post' class='float-left clear-left col-12 col-md-6 mt-2'>
        <input type='hidden' name='page' value='order'>";
        showFormInput('product_id', '', 'input', 'hidden', $product['id'], '', false, '', false);
        showFormInput('product_name', '', 'input', 'hidden', $product['name'], '', false, '', false);
        echo "<input type='number' name='amount' min='1' value='1' class='float-left clear-left border-cornflower col-3' style='height: 40px;'>
              <input type='submit' class='col-9 col-md-3 p-2 bg-cornflower text-decoration-none text-white border-0 float-left' value='ORDER'>
          </form>";
    } else {
        echo "<span class='text-justify float-left clear-left col-12 col-md-6'>Please log in to purchase.</span>";
    }
    echo "";
}
