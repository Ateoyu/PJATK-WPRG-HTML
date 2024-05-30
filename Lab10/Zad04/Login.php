<?php
session_start();
$usersJSON = 'users.json';
if (file_exists($usersJSON)) {
    $usersArray = json_decode(file_get_contents($usersJSON), true);
} else {
    $usersArray = [];
}

//register
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!isset($usersArray[$username])) {
        $usersArray[$username] = password_hash($password, PASSWORD_DEFAULT);
        file_put_contents($usersJSON, json_encode($usersArray));
    }
}

//login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($usersArray[$username]) && password_verify($password, $usersArray[$username])) {
        $_SESSION['LoggedIn' . $username] = $username;
    }
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Shop Login</title>
    <link rel='stylesheet' href="Login.css">
</head>
<body>
<header>
    <a href="Basket.php"><h2>Basket</h2></a>
    <a href="Shop.php"><h1>Shop</h1></a>
    <a href="Login.php"><h2>Login</h2></a>
</header>
<div id="overallContainer">
    <div id="formContainer">
        <form id="registerForm" method="POST" action="">
            <fieldset id="registerField" form="registerForm">
                <h2>Register</h2>
                <label for="registerUsername">Username:</label>
                <input type="text" id="registerUsername" name="username" required>
                <label for="registerPassword">Password:</label>
                <input type="password" id="registerPassword" name="password" required>
                <button type="submit" name="register">Register</button>
            </fieldset>
        </form>
        <form id="loginForm" method="POST" action="">
            <fieldset id="loginField" form="loginForm">
                <h2>Login</h2>
                <label for="loginUsername">Username:</label>
                <input type="text" id="loginUsername" name="username" required>
                <label for="loginPassword">Password:</label>
                <input type="password" id="loginPassword" name="password" required>
                <button type="submit" name="login">Login</button>
            </fieldset>
        </form>
    </div>
</div>
</body>
