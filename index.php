<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

whatIsHappening();

//your products with their price.
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];
if (isset($_GET['food']) && (int)$_GET['food'] === 0) {
    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ];
}

$totalValue = 0;
function totalPrice($products, $totalValue)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach ($_POST['products'] as $i => $product) {
            $totalValue += (float)$products[$i]['price'];
            $_COOKIE['totalValue'] = $totalValue;
        }
        if (!empty($_POST['express_delivery'])) {
            $totalValue += (float)$_POST['express_delivery'];
            $_COOKIE['express_delivery'] = $totalValue;
        }
    }
    return $totalValue;
}


require 'form-view.php';