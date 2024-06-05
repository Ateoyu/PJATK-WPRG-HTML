<?php

require_once "Car.php";
require_once "InsuranceCar.php";
require_once "NewCar.php";
require_once "CarTypeForm.php";
require_once "displayObjects.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['carInventory'])) {
    $_SESSION['carInventory'] = array();
}

if (isset($_POST['submitChosenCarType'])) {
    $_SESSION['carType'] = $_POST['carType'];
}

if (!isset($_SESSION['calculatedPrices'])) {
    $_SESSION['calculatedPrices'] = array();
}

if (isset($_POST['addCar'])) {
    $model = $_POST['model'];
    $priceEuro = $_POST['priceEuro'];
    $exchangeRatePLN = $_POST['exchangeRatePLN'];

    switch ($_SESSION['carType']) {
        case "Car":
        {
            $car = new Car($model, $priceEuro, $exchangeRatePLN);
            $_SESSION['carInventory'][] = $car;
            break;
        }
        case "NewCar":
        {
            $alarm = isset($_POST['alarmCheckbox']);
            $radio = isset($_POST['radioCheckbox']);
            $climatronic = isset($_POST['climatronicCheckbox']);
            $car = new NewCar($model, $priceEuro, $exchangeRatePLN, $alarm, $radio, $climatronic);
            $_SESSION['carInventory'][] = $car;
            break;
        }
        case "InsuranceCar":
        {
            $alarm = isset($_POST['alarmCheckbox']);
            $radio = isset($_POST['radioCheckbox']);
            $climatronic = isset($_POST['climatronicCheckbox']);
            $firstOwner = isset($_POST['firstOwnerCheckbox']);
            $carAge = $_POST['carAge'];
            $car = new InsuranceCar($model, $priceEuro, $exchangeRatePLN, $alarm, $radio, $climatronic, $firstOwner, $carAge);
            $_SESSION['carInventory'][] = $car;
            break;
        }
    }
}

if (isset($_POST['editCar'])) {
    $carIndex = $_POST['carIndex'];
    $_SESSION['carInventory'][$carIndex]->setModel($_POST['model']);
    $_SESSION['carInventory'][$carIndex]->setPrice($_POST['priceEuro']);
    $_SESSION['carInventory'][$carIndex]->setExchangeRate($_POST['exchangeRatePLN']);

    switch ($_SESSION['carInventory'][$carIndex]) {
        case $_SESSION['carInventory'][$carIndex] instanceof InsuranceCar:
            $_SESSION['carInventory'][$carIndex]->setAlarm(isset($_POST['alarmCheckbox']));
            $_SESSION['carInventory'][$carIndex]->setRadio(isset($_POST['radioCheckbox']));
            $_SESSION['carInventory'][$carIndex]->setClimatronic(isset($_POST['climatronicCheckbox']));
            $_SESSION['carInventory'][$carIndex]->setFirstOwner(isset($_POST['firstOwnerCheckbox']));
            $_SESSION['carInventory'][$carIndex]->setYears($_POST['carAge']);
            break;
        case $_SESSION['carInventory'][$carIndex] instanceof NewCar:
            $_SESSION['carInventory'][$carIndex]->setAlarm(isset($_POST['alarmCheckbox']));
            $_SESSION['carInventory'][$carIndex]->setRadio(isset($_POST['radioCheckbox']));
            $_SESSION['carInventory'][$carIndex]->setClimatronic(isset($_POST['climatronicCheckbox']));
            break;
    }
}

if (isset($_POST["deleteCar"])) {
    unset($_SESSION['carInventory'][$_POST['carIndex']]);
    $_SESSION['carCount']--;
}

?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Car Inventory</title>
    <link rel='stylesheet' href="Zad05.css">
</head>
<body>

<div id="carInventoryFormContainer">
    <form method="POST" action="">
        <h1>Car Inventory</h1>
        <h3>Total Cars: <?php echo Car::getCount(); ?></h3>
        <label for="carType">Select Car Type:</label>
        <select id="carType" name="carType">
            <option value="Car">Car</option>
            <option value="NewCar">NewCar</option>
            <option value="InsuranceCar">InsuranceCar</option>
        </select>
        <button type="submit" name="submitChosenCarType">Submit</button>
    </form>

    <?php
    if (isset($_POST['submitChosenCarType'])) {
        carTypeForm::outputChosenForm($_SESSION['carType']);
    }


    if ($_SESSION['carInventory'] != null) {
        displayObjects::displayCars();
    }
    ?>
</div>

</body>
</html>