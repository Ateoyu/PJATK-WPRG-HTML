<?php

session_start();

$userArray = null;
$loginMessage = null;
$updateMessage = null;
$deleteMessage = null;
$passwordMessage = null;

$dbhost = 'mysql:host=szuflandia.pjwstk.edu.pl';
$dbuser = 's31661';
$dbpass = 'Mar.Stan';



try {
    $pdo = new PDO($dbhost, $dbuser, $dbpass);

    $pdo->exec("USE s31661");

    $userTable = "CREATE TABLE IF NOT EXISTS users (
    user_id INT PRIMARY KEY,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    email_address VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL);";

    $pdo->exec($userTable);

    if (isset($_POST['register'])) {
        $firstname = $_POST['firstName'];
        $lastname = $_POST['lastName'];
        $phoneNumber = $_POST['phoneNumber'];
        $emailAddress = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $pdo->exec("INSERT INTO users (first_name, last_name, phone_number, email_address, password) VALUES ('$firstname', '$lastname', '$phoneNumber', '$emailAddress', '$password')");
    }

    if (isset($_POST['login'])) {
        $emailLogin = $_POST['emailLogin'];
        $passwordLogin =  $_POST['passwordLogin'];
        $databasePassword = $pdo->query("SELECT password FROM users WHERE email_address = '$emailLogin'")->fetch();
        $databasePassword = $databasePassword[0];
        $yes = password_verify($passwordLogin, $databasePassword);
        if (!$yes) {
            $loginMessage = "Login Failed, account is not registered";
        } else {
            $_SESSION['loggedInUser'] = $emailLogin;
            $loginMessage = "Login Successful";
        }
    }

    if (isset($_SESSION['loggedInUser'])) {
        if (isset($_POST['updateUserData'])) {
            $firstnameUpdate = $_POST['firstNameUpdate'];
            $lastnameUpdate = $_POST['lastNameUpdate'];
            $emailUpdate = $_POST['emailUpdate'];
            $userID = $pdo->query("SELECT user_id FROM users WHERE email_address = '{$_SESSION['loggedInUser']}'")->fetch(PDO::FETCH_ASSOC);
            $rowsAffected = $pdo->exec("UPDATE users SET first_name = '$firstnameUpdate', last_name = '$lastnameUpdate', email_address = '$emailUpdate' WHERE user_id = '$userID[user_id]'");
            if ($rowsAffected > 0) {
                $updateMessage = "Record updated successfully";
            } else {
                $updateMessage = "Error updating record";
            }
        }

        if (isset($_POST['deleteAccount'])) {
            $userID = $pdo->query("SELECT user_id FROM users WHERE email_address = '{$_SESSION['loggedInUser']}'")->fetch(PDO::FETCH_ASSOC);
            $rowsAffected = $pdo->exec("DELETE FROM users WHERE user_id = '$userID[user_id]'");
            if ($rowsAffected > 0) {
                $deleteMessage = "Record deleted successfully";
                session_destroy();
            } else {
                $deleteMessage = "Error deleting record";
            }
        }

        if (isset($_POST['resetPassword'])) {
            $emailForReset = $_POST['emailForReset'];
            $newPassword = password_hash($_POST['newPassword'], PASSWORD_BCRYPT);
            $rowsAffected = $pdo->exec("UPDATE users SET password = '$newPassword' WHERE email_address = '$emailForReset'");
            if ($rowsAffected > 0) {
                $passwordMessage = "Password updated successfully";
            } else {
                $passwordMessage = "Error updating Password";
            }
        }
    }

    $query = "SELECT * FROM users";
    $userArray = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {

}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Simple Shop</title>
    <link rel="stylesheet" href="">
</head>
<body>

<header>
    <a href="Basket.php"><h2>Basket</h2></a>
    <h1>Shop</h1>
    <a href="../PROJECT/02-Login.php"><h2>Login</h2></a>
</header>


<!--Registration Form-->
<form method="post" action="">
    <fieldset>
        <legend><h1>Registration Form</h1></legend>
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required>
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required>
        <label for="phoneNumber">Phone Number:</label>
        <input type="tel" id="phoneNumber" name="phoneNumber">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Passwords:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit" name="register">Register</button>
    </fieldset>
</form>

<!--Login Form-->
<form method="post" action="">
    <fieldset>
        <legend><h1>Login Form</h1></legend>
        <label for="emailLogin">Email:</label>
        <input type="email" id="emailLogin" name="emailLogin">
        <label for="passwordLogin">Password:</label>
        <input type="password" id="passwordLogin" name="passwordLogin">
        <button type="submit" name="login">Login</button>
        <?php if ($loginMessage != null) {
            echo '<p>' . $loginMessage . '</p>';
        } ?>
    </fieldset>
</form>



</body>
</html>