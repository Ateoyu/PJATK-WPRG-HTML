<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    $_SESSION['chosenBackground'] = $_POST['backgroundColourSelect'];
    $_SESSION['chosenTextColour'] = $_POST['textColourSelect'];
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Preferences Site</title>
    <link rel='stylesheet' href="">
</head>
<body>

<?php
$backgroundColour = $_SESSION['chosenBackground'];
$textColour = $_SESSION['chosenTextColour'];

echo "<h1>Preferences Site</h1>";
echo "<ul>"
    . "<li>Background Color: $backgroundColour</li>"
    . "<li>Text Colour: $textColour</li>"
    . "</ul>";

?>

<form method="post" action="Zad03.php">
    <button>Go Back</button>
</form>
<form method="post" action="Zad03-3.php">
    <button>Submit</button>
</form>


</body>