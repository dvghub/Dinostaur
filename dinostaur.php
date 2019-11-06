<?php
function showWsHomeContent($data) {
    $logged = isUserLogged();
    $products = getProducts($data['category']);
    showCategories();

    $col1 = array();
    $col2 = array();
    $col3 = array();
    $col4 = array();
    $col = 1;

    if ($products) {
        foreach ($products as $product) {
            $article = "<article id='".$product['id']."' class='tile'>";
            $article .= "<img class='tile-thumbnail' src='".$product['image']. "'>
                         <span class='tile-name'>" .$product['name']. "</span>
                         <span class='tile-price'>&euro;" .$product['price']."</span>";
                         if ($logged) {$article .= "
                         <form action='index.php' method='post'>
                             <input type='hidden' name='product_id' value='" . $product['id'] . "'>
                             <input type='hidden' name='product_name' value='" . $product['name'] . "'>
                             <input type='hidden' name='page' value='details'>
                             <input type='submit' value='ORDER' class='tile-order'>
                         </form>";
                         }
            $article .= "</article>";

            switch ($col) {
                case 1:
                    array_push($col1, $article);
                    $col += 1;
                    break;
                case 2:
                    array_push($col2, $article);
                    $col += 1;
                    break;
                case 3:
                    array_push($col3, $article);
                    $col += 1;
                    break;
                case 4:
                    array_push($col4, $article);
                    $col = 1;
                    break;
            }
        }
        showProducts(array($col1, $col2, $col3, $col4));
    }
}

function showCategories() { // ALERT
    echo "<form method='post' action='index.php'>
            <input type='hidden' name='page' value='dinostaur'>
        <span id='categories'>Show: 
            <select name='category' onchange='this.form.submit()'>
                <option value='all' selected>All</option>
                <option value='triassic'>Triassic period</option>
                <option value='jurassic'>Jurassic period</option>
                <option value='cretaceous'>Cretaceous period</option>
                <option value='land'>Land creatures</option>
                <option value='marine'>Marine creatures</option>
                <option value='avian'>Avian creatures</option>
                <option value='amphib'>Amphibians</option>
                <option value='reptile'>Reptiles</option>
                <option value='mammal'>Mammals</option>
                <option value='bird'>Birds</option>
                <option value='omni'>Omnivores</option>
                <option value='herbi'>Herbivores</option>
                <option value='carni'>Carnivores</option>
            </select></span></form>";
}

function showProducts($cols) {
    echo "<div class='row'>";
    foreach ($cols as $col) {
        echo    "<div class='col'>";
        foreach ($col as $article) {
            echo $article;
        }
        echo    '</div>';
    }
    echo '</div>';
}

function showDetailsContent($data) {
    $product = getProduct($data['product_id']);

    echo "
    <img class='page-img' src='".$product['image']."'>
    <span class='page-description'>" .$product['description']. "</span>
    <span class='page-price'>&euro;" .$product['price']. "</span>";
    if (isUserLogged()) {
        echo "
    <form action='index.php' method='post'>
        <input type='hidden' name='product_id' value='".$product['id']."'>
        <input type='hidden' name='product_name' value='".$product['name']. "'>
        <input type='hidden' name='page' value='order'>
        <input type='number' name='amount' min='1' value='1' class='page-amount'>
        <input type='submit' value='ORDER' class='page-order'>
    </form>";
    } else {
        echo '<span class="page-description">Please log in to purchase.</span>';
    }
}
