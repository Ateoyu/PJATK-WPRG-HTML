<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zad11</title>
    <link rel="stylesheet" href="Zad11.css">
</head>
<body>

<?php

function celsToFahr($celsius): float
{
    return round(($celsius * (9 / 5)) + 32, 2);
}

function fahrToCels($fahrenheit): float
{
    return round(($fahrenheit - 32) * (5 / 9), 2);
}

?>


<div id="flexContainer">
    <table>
        <thead>
        <tr>
            <th>Celsius</th>
            <th>Fahrenheit</th>
            <th>Fahrenheit</th>
            <th>Celsius</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>40</td>
            <td><?php echo celsToFahr(40) ?></td>
            <td>120</td>
            <td><?php echo fahrToCels(120) ?></td>
        </tr>

        <tr>
            <td>39</td>
            <td><?php echo celsToFahr(39) ?></td>
            <td>110</td>
            <td><?php echo fahrToCels(110) ?></td>
        </tr>

        <tr>
            <td>32</td>
            <td><?php echo celsToFahr(32) ?></td>
            <td>40</td>
            <td><?php echo fahrToCels(40) ?></td>
        </tr>

        <tr>
            <td>31</td>
            <td><?php echo celsToFahr(31) ?></td>
            <td>30</td>
            <td><?php echo fahrToCels(30) ?></td>
        </tr>
        </tbody>
    </table>
</div>


</body>
</html>
