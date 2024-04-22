<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zad03POST</title>
</head>
<body>

<?php

$seqA = $_POST['SequenceA'];
$seqB = $_POST['SequenceB'];

echo "$seqA <br>";
echo "$seqB <br>";

$arraySeqA = explode(',', $seqA);
$arraySeqB = explode(',', $seqB);

match ($_POST['operator']) {
    "UNION" => union($arraySeqA, $arraySeqB),
    "EXCEPT" => except($arraySeqA, $arraySeqB),
    "INTERSECT" => intersect($arraySeqA, $arraySeqB),
    default => 'ERROR'
};

function union($set1, $set2): void
{
    $unionArray = array_unique(array_merge($set1, $set2));
    echo '<p> $unionArray </p>';
}

function except($set1, $set2): void
{
    $exceptArray = array_diff($set1, $set2);
    foreach ($exceptArray as $item) {
        echo "$item, ";
    }
}

function intersect($set1, $set2): void
{
    $intersectArray = array_intersect($set1, $set2);
    foreach ($intersectArray as $item) {
        echo "$item, ";
    }
}

?>

</body>
</html>
