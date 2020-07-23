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

//whatIsHappening();

//your products with their price.
$foods = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];
$drinks = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];
if (isset($_GET['food']) && (int)$_GET['food'] === 0) {
    $foods = $drinks;
}
$totalValue = 0;
function totalPrice($foods, $totalValue)
{
    if (!isset($_COOKIE['totalValue'])) {
        setcookie('totalValue', (string)$totalValue, time() + 86400);
    }
    if (isset($_COOKIE['totalValue'])) {
        $totalValue += (int)$_COOKIE['totalValue'];
        foreach ($_POST['foods'] as $i => $food) {
            $totalValue += (float)$foods[$i]['price'];
        }
        if (!empty($_POST['express_delivery'])) {
            $totalValue += (float)$_POST['express_delivery'];
        }
        (int)$_COOKIE['totalValue'] = $totalValue;
        setcookie('totalValue', (string)$totalValue, time() + 86400);
    }

    return $_COOKIE['totalValue'];
}

totalPrice($foods, $totalValue);


function orderConfirmation()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['email']) && !empty($_POST['street']) && !empty($_POST['streetnumber']) && !empty($_POST['city']) && !empty($_POST['zipcode']) && !empty($_POST['foods'])) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Thank you for your order
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>';
            sendMail();
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Fill all required inputs and then try again
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>';
        }
    }
}

orderConfirmation();


require 'form-view.php';
require 'formValidation.php';
require 'mail.php';