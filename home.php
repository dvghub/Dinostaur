<?php 
function showHomeContent() {
    echo "<p id='welcome-message'>Hello hello home page</p>";

    showTopSold();
    //Hier neergezet want ik had toch nog ruimte over
}

function showTopSold() {
    echo '<strong>Top 5 items sold this week: </strong>';
    echo "<ol id='top-list'>";
    $products = getTop(5);
    foreach ($products as $place => $product) {
        $place += 1;
        echo "<li class='top-item'><span class='top-place'>".$place."</span><a class='top-name' href='index.php?page=details&product_id=".$product['product_id']."'>".$product['name']."</a><span class='top-total'>".$product['total']."</span></li>";
    }
    echo "</ol>";
}