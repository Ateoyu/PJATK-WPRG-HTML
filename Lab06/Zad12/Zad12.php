<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zad12</title>
    <link rel="stylesheet" href="Zad12.css">
</head>

<body>

<?php

$minute = date('i');
$minuteArr = str_split($minute);

//I don't know why match case doesn't work here but switch does so yea
//Technically task asks for 3 variants but here you have 10, bigger the better right? :D
switch ($minute[1]) {
    case 0:
        echo '<div class="shape shape0"> </div>';
        break;
    case 1:
        echo '<div class="shape shape1"> </div>';
        break;
    case 2:
        echo '<div class="shape shape2"> </div>';
        break;
    case 3:
        echo '<div class="shape shape3"> </div>';
        break;
    case 4:
        echo '<div class="shape shape4"> </div>';
        break;
    case 5:
        echo '<div class="shape shape5"> </div>';
        break;
    case 6:
        echo '<div class="shape shape6"> </div>';
        break;
    case 7:
        echo '<div class="shape shape7"> </div>';
        break;
    case 8:
        echo '<div class="shape shape8"> </div>';
        break;
    case 9:
        echo '<div class="shape shape9"> </div>';
        break;
}
?>

</body>
</html>