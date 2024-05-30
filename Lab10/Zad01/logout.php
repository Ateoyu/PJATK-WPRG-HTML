<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Capy Counter</title>
    <link rel='stylesheet' href="">
</head>
<body>
<h1>You are logged out.</h1>
<a href="Zad01.php">Log in Again.</a>
</body>
<?php
header("HTTP/1.1 401 Unauthorized");
exit;
?>
