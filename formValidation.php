<?php
declare(strict_types=1);

//errors
$emailErr = '';
$streetErr = '';
$streetNumberErr = '';
$cityErr = '';
$zipCodeErr = '';
$productsErr = [];


//validate function
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //validate email address
    if (empty($_POST['email'])) {
        $emailErr = '<div class="alert alert-danger" role="alert">Email required</div>';
        echo $emailErr;
    } else {
        $isValidEmail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if (!$isValidEmail) {
            $inValidEmail = '<div class="alert alert-danger" role="alert">Please provide a valid email address</div>';
            echo $inValidEmail;
        }
        $email = testInput($isValidEmail);
        $_SESSION['email'] = $email;
    }
    //validate street name
    if (empty($_POST['street'])) {
        $streetErr = '<div class="alert alert-danger" role="alert">Street name is required</div>';
        echo $streetErr;
    } else {
        $street = testInput($_POST['street']);
        if (!preg_match("/^[a-zA-Z ]*$/", $street)) {
            $isString = '<div class="alert alert-danger" role="alert">Only letters and white space allowed</div>';
            echo $isString;
        }
        $_SESSION['street'] = $street;
    }
    //validate street number
    if (empty($_POST['streetnumber'])) {
        $streetNumberErr = '<div class="alert alert-danger" role="alert">Street number is required</div>';
        echo $streetNumberErr;
    } else {
        $streetNumber = testInput($_POST['streetnumber']);
        if (!is_numeric($streetNumber)) {
            $isNan = '<div class="alert alert-danger" role="alert">Only numbers allowed</div>';
            echo $isNan;
        }
        $_SESSION['streetnumber'] = $streetNumber;
    }
    //validate city
    if (empty($_POST['city'])) {
        $cityErr = '<div class="alert alert-danger" role="alert">City name is required</div>';
        echo $cityErr;
    } else {
        $city = testInput($_POST['city']);
        if (!preg_match("/^[a-zA-Z ]+$/", $city)) {
            $isValidString = '<div class="alert alert-danger" role="alert">Only letters allowed</div>';
            echo $isValidString;
        }
        $_SESSION['city'] = $city;
    }
    //validate zipcode
    if (empty($_POST['zipcode'])) {
        $zipCodeErr = '<div class="alert alert-danger" role="alert">Zipcode is required</div>';
        echo $zipCodeErr;
    } else {
        $zipCode = testInput($_POST['zipcode']);
        if (!is_numeric($zipCode)) {
            $isNanZip = '<div class="alert alert-danger" role="alert">Only numbers allowed</div>';
            echo $isNanZip;
        }
        $_SESSION['zipcode'] = $zipCode;
    }
    //validate checked if it is checked
    if (isset($_POST['products']) && !empty($_POST['products'])) {
        $productsErr = "Products needs to be selected";
    } else {
        $products = testInput($_POST['products']);
        //$_SESSION['products'] = $products;
    }
}


//test input and trim unnecessary data
function testInput($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}