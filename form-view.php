<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Order food & drinks</title>
</head>
<body>


<div class="container">
    <h1>Order food in restaurant "the Personal Ham Processors"</h1>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    <span><?php ?></span>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <span><?php ?></span>
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email"
                       value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" class="form-control"/>
            </div>
        </div>

        <fieldset>
            <legend>Address</legend>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <span><?php ?></span>
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street"
                           value="<?php echo isset($_POST["street"]) ? $_POST["street"] : ''; ?>" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <span><?php ?></span>
                    <input type="text" id="streetnumber" name="streetnumber"
                           value="<?php echo isset($_POST["streetnumber"]) ? $_POST["streetnumber"] : ''; ?>"
                           class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <span><?php ?></span>
                    <input type="text" id="city" name="city"
                           value="<?php echo isset($_POST["city"]) ? $_POST["city"] : ''; ?>" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <span><?php ?></span>
                    <input type="text" id="zipcode" name="zipcode"
                           value="<?php echo isset($_POST["zipcode"]) ? $_POST["zipcode"] : ''; ?>"
                           class="form-control">

                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products as $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?>
                    -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br/>
            <?php endforeach; ?>
        </fieldset>
        <label>
            <input type="checkbox" name="express_delivery" value="5"/>
            Express delivery (+ 5 EUR)
        </label>
        <button type="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo totalPrice($products, $totalValue); ?></strong> in food and
        drinks.
    </footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>


<?php
require 'formValidation.php';
require 'delivery.php'
?>

