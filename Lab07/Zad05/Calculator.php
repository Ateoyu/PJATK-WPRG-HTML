<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zad04</title>
    <link rel="stylesheet" href="Calculator.css">
</head>
<body>

<div id="flexContainer">
    <h1>Calculator</h1>

    <fieldset id="simpleCalc">
        <form method="POST" action="">
            <h2>Simple</h2>
            <div class="inputLabels">
                <label for="simpleNum1">First Number:</label>
                <label for="simpleOperation">Operation</label>
                <label for="simpleNum2">Second Number:</label>
            </div>
            <div>
                <input type="number" id="simpleNum1" name="simpleNum1" placeholder="Enter first number">

                <select id="simpleOperation" name="operation">
                    <option value="+">+</option>
                    <option value="-">-</option>
                    <option value="*">*</option>
                    <option value="/">/</option>
                </select>

                <input type="number" id="simpleNum2" name="simpleNum2" placeholder="Enter second number">
            </div>
            <button type="submit">Calculate</button>
        </form>
    </fieldset>

    <fieldset id="advancedCalc">
        <form method="post" action="">
            <h2>Advanced</h2>
            <div class="inputLabels">
                <label for="advancedNum">Number:</label>
                <label for="advancedOperation">Operation</label>
            </div>
            <div>
                <input type="text" id="advancedNum" name="advancedNum" placeholder="Enter first number">

                <select id="advancedOperation" name="operation">
                    <option value="Cos">Cos</option>
                    <option value="Sin">Sin</option>
                    <option value="Tan">Tan</option>
                    <option value="Bin->Dec">Bin->Dec</option>
                    <option value="Dec->Bin">Dec->Bin</option>
                    <option value="Dec->Hex">Dec->Hex</option>
                    <option value="Hex->Dec">Hex->Dec</option>
                </select>

            </div>
            <button type="submit">Calculate</button>
        </form>
    </fieldset>


    <div class="answerDiv">
        <h2>Answer</h2>
        <?php

        function addition($a, $b): void
        {
            $additionResult = $a + $b;
            echo "$a + $b = $additionResult";
        }

        function subtraction($a, $b): void
        {
            $subtractionResult = $a - $b;
            echo "$a - $b = $subtractionResult";
        }

        function multiplication($a, $b): void
        {
            $multiplyResult = $a * $b;
            echo "$a * $b = $multiplyResult";
        }

        function division($a, $b): void
        {
            if ($b === 0) {
                throw new Exception('Division by zero');
            }
            $divResult = $a / $b;
            echo "$a / $b = $divResult";
        }

        function cosine($a): void
        {
            $cosineResult = cos($a);
            echo "cos($a) = $cosineResult";
        }

        function sine($a): void
        {
            $sineResult = sin($a);
            echo "sin($a) = $sineResult";
        }

        function tangent($a): void
        {
            $tanResult = tan($a);
            echo "tan($a) = $tanResult";
        }

        function binToDec($a): void
        {
            if (!preg_match('/^[01]+$/', $a)) {
                throw new Exception('Not a binary number');
            }
            $binToDecResult = bindec($a);
            echo "bin->dec  = $binToDecResult";
        }

        function decToBin($a): void
        {
            if (!is_numeric($a)) {
                throw new Exception('Not a number');
            }
            $decToBinResult = decbin($a);
            echo "dec->bin = $decToBinResult";
        }

        function decToHex($a): void
        {
            if (!is_numeric($a)) {
                throw new Exception('Not a number');
            }
            $decToHexResult = dechex($a);
            echo "dec->hex = $decToHexResult";
        }

        function hexToDec($a): void
        {
            if (!preg_match('/^[0-9A-Fa-f]+$/', $a)) {
                throw new Exception('Not a hex number');
            }
            $hexToDecResult = hexdec($a);
            echo "hex->dec = $hexToDecResult";
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                match ($_POST["operation"]) {
                    "+" => addition($_POST["simpleNum1"], $_POST["simpleNum2"]),
                    "-" => subtraction($_POST["simpleNum1"], $_POST["simpleNum2"]),
                    "*" => multiplication($_POST["simpleNum1"], $_POST["simpleNum2"]),
                    "/" => division($_POST["simpleNum1"], $_POST["simpleNum2"]),
                    "Cos" => cosine($_POST["advancedNum"]),
                    "Sin" => sine($_POST["advancedNum"]),
                    "Tan" => tangent($_POST["advancedNum"]),
                    "Bin->Dec" => binToDec($_POST["advancedNum"]),
                    "Dec->Bin" => decToBin($_POST["advancedNum"]),
                    "Dec->Hex" => decToHex($_POST["advancedNum"]),
                    "Hex->Dec" => hexToDec($_POST["advancedNum"]),
                    default => 'ERROR'
                };
            } catch
            (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        ?>
    </div>
</div>
</body>