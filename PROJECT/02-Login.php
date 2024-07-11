<?php
require_once 'PageFunctionality.php';
include_once 'HeaderForAllPages.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['loginButton'])) {
    $loginMessage = PageFunctionality::login();
}

if (isset($_POST['registerButton'])) {
    $registerMessage = PageFunctionality::register();
}

?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Safari Stop Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Gabriela&display=swap');
        @import "03-Menu.css";
    </style>
    <link rel="stylesheet" href="02-Login.css">
</head>
<body>

<div id="loginFormContainer">
    <form id="loginForm" method="POST" action="">
        <fieldset form="loginForm">
            <legend><h1>Login</h1></legend>
            <label for="loginEmail">Email:</label>
            <input type="text" id="loginEmail" name="loginEmail" required>
            <label for="loginPassword">Password:</label>
            <input type="password" id="loginPassword" name="loginPassword" required>
            <button type="submit" id="loginButton" name="loginButton">Login</button>
        </fieldset>
        <?php if (isset($loginMessage)) {
            echo "<h3>$loginMessage</h3>";
        } ?>
    </form>

    <form id="registerForm" method="POST" action="">
        <fieldset form="registerForm">
            <legend><h1>Register</h1></legend>
            <label for="registerUsername">Username:</label>
            <input type="text" id="registerUsername" name="registerUsername" required>
            <label for="registerPassword">Password:</label>
            <input type="password" id="registerPassword" name="registerPassword" required>
            <label for="registerEmail">Email:</label>
            <input type="email" id="registerEmail" name="registerEmail" required>
            <button type="submit" id="registerButton" name="registerButton">Register</button>
        </fieldset>
        <?php if (isset($registerMessage)) {
            echo "<h3>$registerMessage</h3>";
        } ?>
    </form>
</div>

</body>
</html>

