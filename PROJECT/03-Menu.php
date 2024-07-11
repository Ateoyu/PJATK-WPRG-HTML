<?php
require_once 'MenuFunctionality.php';
PageFunctionality::logout();
include_once 'HeaderForAllPages.php';

if (isset($_POST['addToCart'])) {
    MenuFunctionality::addToCart($_POST['addToCart'], $_POST['itemAmount']);
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Safari Stop Menu</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Gabriela&display=swap');
    </style>
    <link rel="stylesheet" href="03-Menu.css">
</head>
<body>

<?php MenuFunctionality::displaySideNav(); ?>

<main id="mainMenu">
    <?php
    if (isset($_POST['category'])) {
        MenuFunctionality::displayCategoryMenuItems($_POST['category']);
    } else {
        MenuFunctionality::displayAllMenuItems();
    }
    ?>
</main>

<?php MenuFunctionality::displayBasketFooterDiv(); ?>

</body>

</html>

