<?php

function checkIfAlphanumeric($inputPassword): bool
{
    if (!ctype_alnum($inputPassword)) {
        return false;
    } else {
        return true;
    }
}


function countNumbers($inputPassword): bool
{
    $passwordArray = str_split($inputPassword);

    $count = 0;

    foreach ($passwordArray as $x) {
        if (is_numeric($x)) {
            $count++;
        }
    }

    if ($count < 2) {
        return false;
    } else {
        return true;
    }
}

do {
    $inputPassword = readline("Enter your password: ");
    $passwordLength = strlen($inputPassword);
    $alphanumericBool = checkIfAlphanumeric($inputPassword);
    $twoNumbersBool = countNumbers($inputPassword);

} while ($passwordLength < 8 or $alphanumericBool == false or $twoNumbersBool == false);

echo "Password is correct.";

