<?php

require_once "Car.php";
require_once "NewCar.php";
require_once "InsuranceCar.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['checkEditCarDetails'])) {
    $carIndex = $_POST['carIndex'];
    $car = $_SESSION['carInventory'][$carIndex];
    if ($car instanceof InsuranceCar) {
        $carType = "InsuranceCar";
    } else if ($car instanceof NewCar) {
        $carType = "NewCar";
    } else {
        $carType = "Car";
    }
    ?>
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title><?= $car->getModel() . "details" ?></title>
        <link rel='stylesheet' href="Zad05.css">
    </head>
    <body>
    <div id="carInventoryFormContainer">
        <form id="detailForm" method="POST" action="Zad05.php">
            <h2> Edit <?= $carType ?> </h2>
            <label for="model">Model:</label>
            <input type="text" id="model" name="model" value="<?= $car->getModel() ?>" required>
            <label for="priceEuro">Price (EURO):</label>
            <input type="number" id="priceEuro" name="priceEuro" value="<?= $car->getPrice() ?>" min="0" step=".01"
                   inputmode="decimal" placeholder="0" required>
            <label for="exchangeRatePLN">Exchange rate (PLN):</label>
            <input type="number" id="exchangeRatePLN" name="exchangeRatePLN" value="<?= $car->getExchangeRate() ?>"
                   min="0"
                   step=".01" inputmode="decimal" placeholder="0.00" required>
            <?php
            if ($carType == "NewCar") {
                ?>
                <div class="checkboxes">
                    <div>
                        <label for="alarmCheckbox">Alarm:</label>
                        <input type="checkbox" id="alarmCheckbox"
                               name="alarmCheckbox" <?= $car->getAlarm() ? "checked" : "" ?>>
                    </div>
                    <div>
                        <label for="radioCheckbox">Radio:</label>
                        <input type="checkbox" id="radioCheckbox"
                               name="radioCheckbox" <?= $car->getRadio() ? "checked" : "" ?>>
                    </div>
                    <div>
                        <label for="climatronicCheckbox">Climatronic:</label>
                        <input type="checkbox" id="climatronicCheckbox"
                               name="climatronicCheckbox" <?= $car->getClimatronic() ? "checked" : "" ?>>
                    </div>
                </div>
                <?php
            } else if ($carType == "InsuranceCar") {
                ?>
                <div class="checkboxes">
                    <div>
                        <label for="alarmCheckbox">Alarm:</label>
                        <input type="checkbox" id="alarmCheckbox"
                               name="alarmCheckbox" <?= $car->getAlarm() ? "checked" : "" ?>>
                    </div>
                    <div>
                        <label for="radioCheckbox">Radio:</label>
                        <input type="checkbox" id="radioCheckbox"
                               name="radioCheckbox" <?= $car->getRadio() ? "checked" : "" ?>>
                    </div>
                    <div>
                        <label for="climatronicCheckbox">Climatronic:</label>
                        <input type="checkbox" id="climatronicCheckbox"
                               name="climatronicCheckbox" <?= $car->getClimatronic() ? "checked" : "" ?>>
                    </div>
                    <div>
                        <label for="firstOwnerCheckbox">First Owner:</label>
                        <input type="checkbox" id="firstOwnerCheckbox"
                               name="firstOwnerCheckbox" <?= $car->getFirstOwner() ? "checked" : "" ?>>
                    </div>
                </div>
                <label for="carAge">Car Age (years):</label>
                <input type="number" id="carAge" name="carAge" value="<?= $car->getYears() ?>" min="0" step="1"
                       inputmode="numeric"
                       placeholder="0" required>
            <?php } ?>
            <input type="hidden" name="carIndex" value="<?= $carIndex ?>">
            <button type="submit" id="addCar" name="editCar">Edit Car</button>
        </form>
    </div>
    </body>
    </html>
    <?php
}
?>