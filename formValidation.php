<?php
declare(strict_types=1);

//errors
$errors = [
    'emailErr' => '',
    'streetErr' => '',
    'streetNumberErr' => '',
    'cityErr' => '',
    'zipCodeErr' => '',
    'productsErr' => []
];


//validate function
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //validate email address
    if (empty($_POST['email'])) {
        array_push($errors['emailErr'], '<div class="alert alert-danger" role="alert">Email required</div>');
    } else {
        $isValidEmail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if (!$isValidEmail) {
            $validEmail = 'Please provide a valid email address';
        }
        $email = testInput($isValidEmail);
        $_SESSION['email'] = $email;
    }
    //validate street name
    if (empty($_POST['street'])) {
        $streetErr = 'Street name is required';
    } else {
        $street = testInput($_POST['street']);
        if (!preg_match("/^[a-zA-Z ]*$/", $street)) {
            $streetErr = "Only letters and white space allowed";
        }
        $_SESSION['street'] = $street;
    }
    //validate street number
    if (empty($_POST['streetnumber'])) {
        $streetNumberErr = 'Street number is required';
    } else {
        $streetNumber = testInput($_POST['streetnumber']);
        if (!is_numeric($streetNumber)) {
            $streetErr = "Only numbers allowed";
        }
        $_SESSION['streetnumber'] = $streetNumber;
    }
    //validate city
    if (empty($_POST['city'])) {
        $cityErr = 'City name is required';
    } else {
        $city = testInput($_POST['city']);
        if (!preg_match("/^[a-zA-Z ]+$/", $city)) {
            $streetErr = "Only letters allowed";
        }
        $_SESSION['city'] = $city;
    }
    //validate zipcode
    if (empty($_POST['zipcode'])) {
        $zipCodeErr = 'Zipcode is required';
    } else {
        $zipCode = testInput($_POST['zipcode']);
        if (!is_numeric($zipCode)) {
            $streetErr = "Only numbers allowed";
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