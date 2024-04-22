<?php

function convertToHex($num): string
{
    return base_convert($num, 8, 16);
}

$arraySize = readline("Enter amount of numbers you want to convert to hex: ");
$octArray = [];

for ($i = 0; $i < $arraySize; $i++) {
    $octArray[$i] = readline("Enter $i element of the array in base8: ");
}

$hexArray = array_map("convertToHex", $octArray);

print_r($hexArray);