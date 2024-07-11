<?php
require_once 'MenuFunctionality.php';
PageFunctionality::logout();
include_once 'HeaderForAllPages.php';

if (isset($_GET['food_id'])) {
    $chosenFood = $_GET['food_id'];
    $foodDetails = MenuFunctionality::getFoodDetails($chosenFood);
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
    <link rel="stylesheet" href="04-FoodDetails.css">
</head>
<body>
<?php MenuFunctionality::displaySideNav(); ?>

<main id="foodDetailsMain">
    <div class="foodDisplay">
        <div class="foodDetailsImage">
            <img src="<?= $foodDetails['food_image'] ?>" alt="<?= $foodDetails['food_name'] ?>">
        </div>
        <div class="foodDetailsInfo">
            <form method="POST" action="03-Menu.php">
                <h1><?= $foodDetails['food_name'] ?></h1>
                <p><?= $foodDetails['food_description'] ?></p>
                <div class="amountAndPrice">
                    <label for="itemAmountInput">Amount:</label>
                    <input type="number" step="1" id="itemAmountInput" name="itemAmount" value="1" min="1" required>
                    <p> for </p>
                    <div class="priceEach">
                        <p class="foodPrice"><?= '$' . $foodDetails['food_price'] ?></p>
                        <p class="eachP"> each </p>
                    </div>
                </div>
                <input type="hidden" name="addToCart" value="<?= $foodDetails['food_id'] ?>">
                <button type="submit">Add to cart</button>
            </form>
        </div>
    </div>
</main>

<?php MenuFunctionality::displayBasketFooterDiv(); ?>


</body>
</html>