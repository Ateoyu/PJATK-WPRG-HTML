<?php

$arraySize = readline("Enter array size: ");

for ($i = 0; $i < $arraySize; $i++) {
    $array[$i] = readline("Enter $i array element: ");
}


do {
    $nPosition = readline("Enter an array index for $: ");
    if (!is_numeric($nPosition)) {
        echo "ERRORMake sure to enter a number! \n";
    }
} while(!is_numeric($nPosition));

 array_splice($array, $nPosition, 0, '$');

 print_r($array)

?>
