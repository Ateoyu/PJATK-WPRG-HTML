<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sequence Operations</title>
    <link rel="stylesheet" href="Zad01.css">
</head>
<body>
<div id=header>
    <h1>Sequence Operations</h1>
</div>
<div id="uhm">
    <form method="post" action="">
        <fieldset id='sequenceField'>
            <div class="form">
                <label for="sequenceInput">Input Sequence:</label>
                <input type="text" id="sequenceInput" name="sequenceInput" placeholder="Input Sequence here" required>

                <label for="operation">Operation:</label>
                <select id="operation" name="operation" required>
                    <option value="Reverse">Reverse</option>
                    <option value="toUpper">To Uppercase</option>
                    <option value="toLower">To Lowercase</option>
                    <option value="count">Count</option>
                    <option value="removeWhitespace">Remove Whitespace</option>
                </select>

                <button type="submit">Calculate</button>
            </div>
        </fieldset>
    </form>
</div>

<div class="resultDiv">
    <h2>Result</h2>
    <?php

    function reverse($input): string
    {
        return strrev($input);
    }

    function toUpper($input): string
    {
        return strtoupper($input);
    }

    function toLower($input): string
    {
        return strtolower($input);
    }

    function countString($input): string
    {
        return strlen($input);
    }

    function removeWhitespace($input): string
    {
        return preg_replace('/\s+/', '', $input);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["sequenceInput"]) && isset($_POST["operation"])) {
            $ResultString = match ($_POST["operation"]) {
                "Reverse" => reverse($_POST["sequenceInput"]),
                "toUpper" => toUpper($_POST["sequenceInput"]),
                "toLower" => toLower($_POST["sequenceInput"]),
                "count" => countString($_POST["sequenceInput"]),
                "removeWhitespace" => removeWhitespace($_POST["sequenceInput"])
            };
            echo $ResultString;
        }
    }
    ?>
</div>
