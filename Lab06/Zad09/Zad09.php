<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zad09</title>
    <link rel="stylesheet" href="Zad09.css">
</head>
<body>

<?php

function generateRandomValues(): array {
    $randArray = [];
    while (count($randArray) < 3) {
        $randValue = rand(1, 9);
        if (!in_array($randValue, $randArray)) {
            $randArray[] = $randValue;
        }
    }
    return $randArray;
}
?>

<div id="flexContainer">
<?php
    foreach (generateRandomValues() as $randNum) {
        echo match ($randNum) {
            1 => '<img src="Capy01.jpeg" alt="Capy Bath"/>',
            2 => '<img src="Capy02.jpeg" alt="Capy Ponder"/>',
            3 => '<img src="Capy03.jpeg" alt="Capy Blanky"/>',
            4 => '<img src="Capy04.jpeg" alt="Capy voices"/>',
            5 => '<img src="Capy05.jpeg" alt="Capy Princess"/>',
            6 => '<img src="Capy06.jpeg" alt="Capy Bipolar"/>',
            7 => '<img src="Capy07.jpeg" alt="Capy Coconut"/>',
            8 => '<img src="Capy08.jpeg" alt="Capy Tired"/>',
            9 => '<img src="Capy09.jpeg" alt="Capy Gaming"/>',
            default => 'Error',
        };
    }
?>
</div>
    
</body>
</html>