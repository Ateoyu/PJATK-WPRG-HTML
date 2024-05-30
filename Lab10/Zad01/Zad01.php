<?php

$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

$users = ['test' => 'test', 'admin' => 'admin', 'editor' => 'editor', 'user' => 'user'];

if (!isset($users[$username]) || !isset($users[$password]) || $password !== $users[$username]) {
    header('WWW-Authenticate: Basic realm="My Realm"');
} else {
    echo 'Test ' . $username;
}

if (isset($_COOKIE[$username])) {
    $capyCount = (int)$_COOKIE[$username];
} else {
    $capyCount = 0;
}

if (isset($_POST["addCapy"])) {
    setcookie($username, ++$capyCount);
}

echo $capyCount;

?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Capy Counter</title>
    <link rel='stylesheet' href="">
</head>
<body>
<form method="post" action="">
    <button type="submit" name="addCapy">Add Capybara</button>
</form>
<form method="post" action="logout.php">
    <button type="submit" name="logout">Log Out</button>
</form>
</body>
