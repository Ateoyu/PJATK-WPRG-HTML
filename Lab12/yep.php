<?php
$dbhost = 'szuflandia.pjwstk.edu.pl';
$dbuser = 's31661';
$dbpass = 'Mar.Stan';
$dbname = 's31661';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($mysqli->connect_errno) {
    printf("Connect failed: %s<br />", $mysqli->connect_error);
    exit();
}

printf('Connected successfully.<br />');