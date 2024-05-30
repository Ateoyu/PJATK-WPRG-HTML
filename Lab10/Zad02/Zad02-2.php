<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    setcookie('chosenBackground', $_POST['backgroundColourSelect']);
    $_COOKIE['chosenBackground'] = $_POST['backgroundColourSelect'];
    setcookie('chosenTextColour', $_POST['textColourSelect']);
    $_COOKIE['chosenTextColour'] = $_POST['textColourSelect'];
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
$backgroundColour = $_COOKIE['chosenBackground'];
$textColour = $_COOKIE['chosenTextColour'];

echo "<h1>Preferences Site</h1>";
echo "<ul>"
    . "<li>Background Color: $backgroundColour</li>"
    . "<li>Text Colour: $textColour</li>"
    . "</ul>";

?>

<form method="post" action="Zad02.php">
    <button>Go Back</button>
</form>
<form method="post" action="Zad02-3.php">
    <button>Submit</button>
</form>


</body>