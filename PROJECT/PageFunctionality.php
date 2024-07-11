<?php
require_once 'LoginInterface.php';
require_once 'PageFunctionality.php';
require_once 'databases.php';
require_once 'User.php';
require_once 'Food.php';

global $pdo;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

abstract class PageFunctionality implements LoginInterface {

    static function login(): string {
        global $pdo;
        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];
        $userDetails = $pdo->query("SELECT * FROM users WHERE email = '$email'")->fetch(PDO::FETCH_ASSOC);
        if ($userDetails) {
            if (password_verify($password, $userDetails['password'])) {
                $user = new User($userDetails['user_id'], $userDetails['username'], $userDetails['password'], $userDetails['email']);
                $_SESSION['loggedInUser'] = $user;
                return "Login successful";
            } else {
                return "Incorrect password";
            }
        } else {
            return "Email not found";
        }
    }

    static function register(): string {
        global $pdo;
        $username = $_POST['registerUsername'];
        $password = $_POST['registerPassword'];
        $email = $_POST['registerEmail'];
        $user = $pdo->query("SELECT COUNT(*) FROM users WHERE email = '$email'");
        if ($user == 0) {
            return "Email already in use";
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $pdo->exec("INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')");
            return "Registration successful";
        }
    }

    static function logout(): void {
        if (isset($_POST['logoutButton'])) {
            session_unset();
            session_destroy();
        }
    }
}