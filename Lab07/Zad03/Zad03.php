<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zad03</title>
    <link rel="stylesheet" href="Zad03.css">
</head>
<body>

<fieldset id="form">
    <form method="post" action="Zad03POST.php">
        <label for="SequenceA">Sequence A</label>
        <input type="text" id="SequenceA" name="SequenceA" placeholder="input sequence A here">

        <label for="SequenceB">Sequence B</label>
        <input type="text" id="SequenceB" name="SequenceB" placeholder="input sequence B here">

        <label for="operation">Operation</label>
        <select id="operation" name="operator">
            <option value="UNION">UNION</option>
            <option value="EXCEPT">EXCEPT</option>
            <option value="INTERSECT">INTERSECT</option>
        </select>

        <button type="submit">Calculate</button>
    </form>
</fieldset>

<?php



?>

</body>
</html>