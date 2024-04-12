<?php

echo 'a    b    pow(a, b) <br>';

$a = 1;
$b = 2;

for ($i = 1; $i <= 5; $i++) {
    echo nl2br("$a $b ");
    echo (pow($a, $b) . "<br>");
    $a++;
    $b++;
}