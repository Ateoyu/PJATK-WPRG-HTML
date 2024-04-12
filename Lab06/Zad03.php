<?php

//works when ran in the terminal through bash.

echo 'Input feet number you want to convert: ';
$inputFeet = fgets(STDIN);

$outputMetres = $inputFeet * 0.3048;

echo "Metres: $outputMetres";