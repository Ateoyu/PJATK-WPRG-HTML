<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zad03</title>
    <link rel="stylesheet" href="Zad04.css">
</head>
<body>

<?php
function union($set1, $set2): void
{
    $unionArray = array_unique(array_merge($set1, $set2));
    echo 'Union: ' . implode(', ', $unionArray);
}

function difference($set1, $set2): void
{
    $exceptArray = array_diff($set1, $set2);
    echo 'Difference: ' . implode(', ', $exceptArray);
}

function intersect($set1, $set2): void
{
    $intersectArray = array_intersect($set1, $set2);
    echo 'Intersect: ' . implode(', ', $intersectArray);
}

?>

<div id="flexContainer">
    <fieldset id="form">
        <form method="post" action="">
            <label for="SequenceA">Sequence A</label>
            <input type="text" id="SequenceA" name="SequenceA" placeholder="Input sequence A here">

            <label for="SequenceB">Sequence B</label>
            <input type="text" id="SequenceB" name="SequenceB" placeholder="Input sequence B here">

            <label for="operation">Operation</label>
            <select id="operation" name="operator">
                <option value="UNION">UNION</option>
                <option value="DIFFERENCE">DIFFERENCE</option>
                <option value="INTERSECT">INTERSECT</option>
            </select>

            <button type="submit">Calculate</button>

        </form>
    </fieldset>

    <div class="answerOutsideDiv">
        <h2>Answer</h2>
        <?php

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $arraySeqA = explode(',', $_POST['SequenceA']);
            $arraySeqB = explode(',', $_POST['SequenceB']);

            echo '<div class="answerInsideDiv">';
            match ($_POST['operator']) {
                "UNION" => union($arraySeqA, $arraySeqB),
                "DIFFERENCE" => difference($arraySeqA, $arraySeqB),
                "INTERSECT" => intersect($arraySeqA, $arraySeqB),
                default => 'ERROR'
            };
            echo '</div>';
        }
        ?>
    </div>
</div>

</body>
</html>