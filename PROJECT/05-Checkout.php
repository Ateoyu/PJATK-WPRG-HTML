<?php
require_once 'CheckoutFunctionality.php';
require_once 'MenuFunctionality.php';
PageFunctionality::logout();
include_once 'HeaderForAllPages.php';

if (isset($_POST['incrementQuantity'])) {
    CheckoutFunctionality::incrementQuantity($_POST['incrementId']);
}

if (isset($_POST['decrementQuantity'])) {
    CheckoutFunctionality::decrementQuantity($_POST['incrementId']);
}

if (isset($_POST['removeFromCart'])) {
    CheckoutFunctionality::removeFromCart($_POST['removeFromCart']);
}

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
    <link rel="stylesheet" href="05-Checkout.css">
</head>
<body>

<div id="placeholderHeaderDiv"> </div>

<?php MenuFunctionality::displaySideNav(); ?>

<main id="checkoutMainContainer">
    <div class="cartItemsContainer">
        <h1>Checkout</h1>
        <ul>
            <?php if (!empty($_SESSION['cart'])) {
                CheckoutFunctionality::displayCartItems();
            } else {
                echo '<h2>Your cart is empty</h2>';
            }
            ?>
        </ul>
    </div>

    <?php CheckoutFunctionality::displayDeliveryForm(); ?>

</main>

<?php CheckoutFunctionality::displayBasketFooterDiv(); ?>

</body>
</html>