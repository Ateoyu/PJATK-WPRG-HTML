<?php

session_start();

if (!isset($_SESSION['carInventory'])) {
    $_SESSION['carInventory'] = array();
}

require_once "Car.php";
require_once "InsuranceCar.php";
require_once "NewCar.php";
require_once "CarTypeForm.php";

if (isset($_POST['submitChosenCarType'])) {
    $carType = $_POST['carType'];

    if (isset($_POST['addCar'])) {
        $model = $_POST['model'];
        $priceEuro = $_POST['priceEuro'];
        $exchangeRatePLN = $_POST['exchangeRatePLN'];

        switch ($carType) {
            case "Car": {
                $car = new Car($model, $priceEuro, $exchangeRatePLN);
                $_SESSION['carInventory'][] = $car;
                break;
            }
            case "NewCar": {
                $alarm = isset($_POST['alarmCheckbox']);
                $radio = isset($_POST['radioCheckbox']);
                $climatronic = isset($_POST['climatronicCheckbox']);
                $car = new NewCar($model, $priceEuro, $exchangeRatePLN, $alarm, $radio, $climatronic);
                $_SESSION['carInventory'][] = $car;
                break;
            }
            case "InsuranceCar": {
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
        $carType = $_POST['carType'];
        carTypeForm::outputChosenForm($carType);
    }
    echo print_r($_SESSION['carInventory'], 1);

    ?>
</div>

</body>
</html>