<?php

session_start();

$dbhost = 'mysql:host=localhost';
$dbuser = 'Marcel';
$dbpass = 'wahoo';

$userArray = null;
$loginMessage = null;
$updateMessage = null;
$deleteMessage = null;
$passwordMessage = null;

try {
    $pdo = new PDO($dbhost, $dbuser, $dbpass);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS zad03");
    $pdo->exec("USE zad03");

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
    <title>Zad03 DataBase Stuff</title>
    <link rel="stylesheet" href="Zad03.css">
</head>
<body>

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

<?php if (!empty($userArray)) : ?>
<div id="userCount">
    <?php if ($userArray) {
        $count = 0;
        foreach ($userArray as $user) {
            $count += 1;
        }
        echo '<h1>' . $count . ' users</h1>';
    } ?>
</div>
<?php endif ?>

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
<?php if (isset($_SESSION['loggedInUser'])) : ?>
<!--Update User Data Form-->
<form method="post" action="">
    <fieldset>
        <legend><h1>Update User Data</h1></legend>
        <label for="firstNameUpdate">First Name:</label>
        <input type="text" id="firstNameUpdate" name="firstNameUpdate" required>
        <label for="lastNameUpdate">Last Name:</label>
        <input type="text" id="lastNameUpdate" name="lastNameUpdate" required>
        <label for="emailUpdate">Email:</label>
        <input type="email" id="emailUpdate" name="emailUpdate" required>
        <button type="submit" name="updateUserData">Update</button>
        <?php if ($updateMessage != null) {
            echo '<p>' . $updateMessage . '</p>';
        } ?>
    </fieldset>
</form>
<!--Delete Account Form-->
<form method="post" action="">
    <fieldset>
        <legend><h1>Delete Account</h1></legend>
        <button type="submit" name="deleteAccount">Delete Account</button>
        <?php if ($deleteMessage != null) {
            echo '<p>' . $deleteMessage . '</p>';
        } ?>
    </fieldset>
</form>
<!--Reset Password Form-->
<form method="post" action="">
    <fieldset>
        <legend><h1>Reset Password</h1></legend>
        <label for="emailForReset">Email:</label>
        <input type="email" id="emailForReset" name="emailForReset">
        <label for="newPassword">Password:</label>
        <input type="password" id="newPassword" name="newPassword">
        <button type="submit" name="resetPassword">Reset Password</button>
        <?php if ($passwordMessage != null) {
            echo '<p>' . $passwordMessage . '</p>';
        } ?>
    </fieldset>
</form>
<?php endif ?>
</body>
</html>
