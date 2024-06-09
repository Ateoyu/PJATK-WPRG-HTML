<?php
mysqli_report(MYSQLI_REPORT_OFF);

$dbhost = 'localhost';
$dbuser = 'Marcel';
$dbpass = 'wahoo';
$dbname = 'Zad01DB';
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($mysqli->connect_errno) {
    printf("Connect failed: %s<br />", $mysqli->connect_error);
    exit();
}
printf('Connected successfully.<br />');

$sql = "CREATE DATABASE IF NOT EXISTS Zad01DB";
if ($mysqli->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $mysqli->error;
}

$sql = "CREATE TABLE IF NOT EXISTS Students( " .
    "StudentID INT PRIMARY KEY AUTO_INCREMENT, " .
    "Firstname VARCHAR(255) NOT NULL, " .
    "Secondname VARCHAR(255) NOT NULL, " .
    "Salary INT NOT NULL, " .
    "DateOfBirth DATE NOT NULL);";

if ($mysqli->query($sql)) {
    printf("Table Students created successfully.<br />");
}

if (isset($_POST['dropTable'])) {
    $mysqli->query("DROP TABLE Students;");
    echo "Table Students dropped Successfully.<br />";
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Zad01 DataBase Stuff</title>
</head>
<body>

<form method="POST" action="">
    <label for="dropTable"></label>
    <button type="submit" id="dropTable" name="dropTable">Drop Table</button>
</form>

</body>
</html>