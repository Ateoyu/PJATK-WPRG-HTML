<?php

use Zad02\User;

require_once "User.php";

$user = new User();

$name = "Bob";
echo $user->introduce($name);


