<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EasterThing</title>
    <link rel="stylesheet" href="EasterThing.css">
</head>
<body>

<div id="flexContainer">
    <div class="header">
        <h1>Easter Calculator</h1>
    </div>
    <div class="inputContent">
        <form method="post" action="">
            <div class="test">
            <label for="year">Input the Year:</label>
            <input type="number" id="year" name="year" placeholder="Enter year here" required>

            <button type="submit">Calculate</button>
            </div>
        </form>
    </div>


    <?php
    function calcEasterDate($year): string
    {
        if ($year > 0) {
            $x = 0;
            $y = 0;

            switch ($year) {
                case 1 - 1582:
                    $x = 15;
                    $y = 6;
                    break;
                case 1583 - 1699:
                    $x = 22;
                    $y = 3;
                    break;
                case 1700 - 1799:
                    $x = 23;
                    $y = 4;
                    break;
                case 1800 - 1899:
                    $x = 24;
                    $y = 4;
                    break;
                case 1900 - 2099:
                    $x = 24;
                    $y = 5;
                    break;
                case 2100 - 2199:
                    $x = 24;
                    $y = 6;
                    break;
            }
            $a = $year % 19;
            $b = $year % 4;
            $c = $year % 7;
            $d = (19 * $a + $x) % 30;
            $e = (2 * $b + 4 * $c + 6 * $d + $y) % 7;

            if ($e == 6 && $d == 29) {
                return "26 April. $year";
            } elseif ($e == 6 && $d == 28 && ((11 * $x + 11) % 30) < 19) {
                return "18 April. $year";
            } elseif (($d + $e) < 10) {
                return (22 + $d + $e) . " March. $year";
            } elseif (($d + $e) > 9) {
                return ($d + $e - 9) . " April. $year";
            }
        }
        return "Incorrect Year input.";
    }

    ?>
    <div class="result">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["year"])) {
                echo "Easter date: ";
                echo calcEasterDate($_POST["year"]);
            }
        }
        ?>
    </div>
</div>
</body>