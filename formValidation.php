<?php
declare(strict_types=1);

//Form validation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //validate email address
    function validateEmails()
    {
        $isValidEmail = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        if (empty($_POST['email'])) {
            $emailErr = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Email required
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                     </div>';
            echo $emailErr;
        } elseif (!$isValidEmail) {
            $inValidEmail = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Please provide a valid email address
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                             </div>';
            echo $inValidEmail;
        } else {
            $email = testInput($isValidEmail);
            $_SESSION['email'] = $email;
        }
    }

    //validate street name
    function validateStreet()
    {
        $street = testInput($_POST['street']);
        if (empty($_POST['street'])) {
            $streetErr = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Street name required
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                         </button>
                      </div>';

            echo $streetErr;
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $street)) {
            $isString = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Only letters and white space allowed
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                             </button>
                         </div>';
            echo $isString;
        } else {
            $_SESSION['street'] = $street;
        }
    }


    //validate street number
    function validateStreetNumber()
    {
        $streetNumber = testInput($_POST['streetnumber']);
        if (empty($_POST['streetnumber'])) {
            $streetNumberErr = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Street number required
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                            </div>';

            echo $streetNumberErr;
        } elseif (!is_numeric($streetNumber)) {
            $isNan = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Only numbers allowed
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                         </button>
                      </div>';
            echo $isNan;
        } else {
            $_SESSION['streetnumber'] = $streetNumber;
        }
    }

    //validate city
    function validateCity()
    {
        $city = testInput($_POST['city']);
        if (empty($_POST['city'])) {
            $cityErr = '<div class="alert alert-danger alert-dismissible fade show" role="alert">City name required
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                         </button>
                    </div>';
            echo $cityErr;
        } elseif (!preg_match("/^[a-zA-Z ]+$/", $city)) {
            $isValidString = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Only letters allowed
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>';
            echo $isValidString;
        } else {
            $_SESSION['city'] = $city;
        }
    }

    //validate zipcode
    function validateZipcode()
    {
        $zipCode = testInput($_POST['zipcode']);
        if (empty($_POST['zipcode'])) {
            $zipCodeErr = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Zipcode required
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                       </div>';
            echo $zipCodeErr;
        } elseif (!is_numeric($zipCode)) {
            $isNanZip = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Only numbers allowed
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                         </button>
                     </div>';
            echo $isNanZip;
        } else {
            $_SESSION['zipcode'] = $zipCode;
        }
    }

    //validate checked if it is checked
    function validateProducts()
    {
        if (!empty($_POST['products'])) {
            $products = testInput($_POST['products']);
            foreach ($products as $product) {
                $_SESSION['products'] = $product;
            }
        } else {
            $productsErr = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Products needs to be selected
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                            </div>';
            echo $productsErr;
        }
    }

    validateEmails();
    validateStreet();
    validateStreetNumber();
    validateCity();
    validateZipcode();
    validateProducts();
}


//test input and trim unnecessary data
function testInput($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}