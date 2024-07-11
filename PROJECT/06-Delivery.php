<?php
require_once 'MenuFunctionality.php';
require_once 'CheckoutFunctionality.php';
PageFunctionality::logout();
include_once 'HeaderForAllPages.php';


?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Safari Stop Menu</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Gabriela&display=swap');
        @import "03-Menu.css";
    </style>
    <link rel="stylesheet" href="06-Delivery.css">
</head>
<body>

<div id="receiptContainer">
    <div class="receipt">
        <h1>Thank you for your purchase!</h1>
        <h2>Order details:</h2>
        <ul>
            <?php
            foreach ($_SESSION['cart'] as $item) {
                $name = $item->getName();
                $quantity = $item->getQuantity();
                $price = number_format($item->getPrice(), 2); ?>
                <li><?= $name ?> x<?= $quantity ?> - $<?= $price ?> each</li>
                <?php
            }
            ?>

        </ul>
        <h2>Delivery information:</h2>
        <p>Name: <?= $_POST['name'] ?></p>
        <p>Address: <?= $_POST['address'] ?></p>
        <p>Postcode: <?= $_POST['postcode'] ?></p>
        <p>Phone number: <?= $_POST['phone'] ?></p>
        <p>Email: <?= $_POST['email'] ?></p>
        <h2>Total price: <?= $_SESSION['cartTotal'] ?></h2>
    </div>
</div>

</body>
</html>

<?php

if (isset($_POST['checkoutButton'])) {
    unset($_SESSION['cart']);
    unset($_SESSION['cartTotal']);
}