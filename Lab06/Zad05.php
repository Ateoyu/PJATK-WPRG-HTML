<?php


$inputString = readline("Enter the input: ");
$inputString = strtolower($inputString);
$vowels = ['a','e','i','o','u','y'];
$inputStringLength = strlen($inputString);

$consonantAmount = 0;


for ($i = 0; $i < $inputStringLength ; $i++) {
    if (!in_array($inputString[$i], $vowels)) {
        ++$consonantAmount;
    }
}

echo "Consonant amount: $consonantAmount";