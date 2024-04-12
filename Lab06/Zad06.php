<?php

$evenNumbers = 2;

echo "<ul>";

for ($i = 0; $i < 10; $i++) {
    echo "<li>$evenNumbers</li>";
    $evenNumbers += 2;
}

echo "</ul>";