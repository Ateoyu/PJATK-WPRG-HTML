<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Refresh Counter</title>
    <link rel="stylesheet" href="Zad02.css">
</head>
<body>
<div id="main">
    <div class="mainHeader">
        <h2>Page Refresh Counter</h2>
    </div>

    <h3>Refresh Count:</h3>
    <p><?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo resetVisits();
        } else {
            echo checkAndIncrementVisits();
        }
        ?></p>

    <form method="post" action="">
        <button type="submit">Reset</button>
    </form>

</div>
</body>
</html>

<?php
function checkAndIncrementVisits() : int
{
    if (file_exists("./counter.txt")) {
        $counter = (int)file_get_contents("./counter.txt");
        $counter++;
        file_put_contents("./counter.txt", $counter);
        return $counter;
    }
    return 0;
}

function resetVisits(): int
{
    file_put_contents("./counter.txt", 0);
    return 0;
}

?>