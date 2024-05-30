<?php

//require - if no worky, borken
//include - in no worky, skipped
//require_once 
//include_once
require_once "Animal.php";
require_once "Capybara.php";

$capybara = new Capybara('Green', 12);
$capybara->color = "red";
$capybara->age = 20;

echo $capybara->makeSound();

//to call static method, use "[class]::[method]", you call them without an object, just for a static variable.
//the "this->$var" equivalent for static variables is "self::[var]"
