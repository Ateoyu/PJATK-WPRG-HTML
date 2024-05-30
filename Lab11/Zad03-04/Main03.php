<?php
require_once "Car.php";
require_once "NewCar.php";
require_once "InsuranceCar.php";

$car1 = new InsuranceCar("Audi", 3000, 4.6, true, false, true, true, 2);
echo $car1;
echo "\nFinal Converted Price:" . $car1->value() . "PLN";
echo "\nCar Count: " . $car1::getCount();