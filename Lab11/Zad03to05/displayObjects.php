<?php
require_once "carDetails.php";

class displayObjects {

    public static function displayCars(): void {
        echo '<div id="carList">';
        foreach ($_SESSION['carInventory'] as $index => $car) { ?>
            <ul>
                <li><b>Model:</b> <?= $car->getModel(); ?></li>
                <li><b>Price (Euro):</b> <?= $car->getPrice(); ?></li>
                <li><b>Exchange Rate (PLN):</b> <?= $car->getExchangeRate(); ?></li>
            </ul>
            <div class="buttons">
                <form method="POST" action="">
                    <input type="hidden" name="carIndex" value="<?= $index ?>">
                    <button type="submit" name="calculatePrice">Calculate Price</button>
                </form>
                <form method="post" action="carDetails.php">
                    <input type="hidden" name="carIndex" value="<?= $index ?>">
                    <button type="submit" name="checkEditCarDetails">Check/Edit Details</button>
                </form>
                <form method="POST" action="">
                    <input type="hidden" name="carIndex" value="<?= $index ?>">
                    <button type="submit" name="deleteCar">Delete <br> Car</button>
                </form>
            </div>
            <?php
            if (isset($_POST["calculatePrice"]) && $_POST['carIndex'] == $index) {
                $finalValue = $_SESSION['carInventory'][$_POST['carIndex']]->value();
                $finalValue = number_format($finalValue, 2);
                echo '<p><b>Calculated Final Value:</b> ' . $finalValue . 'PLN </p>';
            }
        }
        echo '</div>';
    }
} ?>