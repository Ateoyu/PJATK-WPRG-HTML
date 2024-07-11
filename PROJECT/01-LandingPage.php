<?php
require_once 'PageFunctionality.php';
PageFunctionality::logout();
include_once 'HeaderForAllPages.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Safari Stop</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Gabriela&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Gluten:wght@100..900&display=swap');
        @import "03-Menu.css";
    </style>
    <link rel="stylesheet" href="01-LandingPage.css">
</head>
<body>

<div id="landingPageBackground">
    <div class="landingPageText">
        <h1>Safari Stop<br>Restaurant</h1>
        <h2>Wind down with the animals</h2>
    </div>
</div>

<div id="flexContainer">
    <div class="zooInfo">
        <h2>Partnering with Safari Trails</h2>
        <p>Our restaurant is located in the heart of the Safari Trails zoo. We offer a variety of dishes and drinks to
            enjoy while you take a break from exploring the zoo. Our restaurant is open to all visitors, so come on by
            and enjoy a meal with the animals!</p>
    </div>
</div>

<div class="restaurantInfo">
    <img class="restaurantInteriorImg" src="Photos/restaurantInterior.jpg" alt="restaurantInteriorImg">
    <div class="restaurantInfoText">
        <h1>Safari Stop Bistro & Cafe & Restaurant</h1>
        <p>Originating in 2024, Safari Stop set out with a mission to provide fun, cutely presented meals inspired
            by the zoo animals, all while retaining focus on the delicacy and savoury flavour of each dish. Open
            all-year round, Safari Stop offers a unique and unforgettable dining experience within an already eventful
            trip through our beautiful Safari Trails Zoo! </p>

        <div class="buttons">
            <a href="03-Menu.php">
                <img id="menuIcon" src="Photos/menu_Icon.webp" alt="menuIcon">
                <label for="menuIcon">Menu</label>
            </a>
            <a href="Contact.php">
                <img id="contactIcon" src="Photos/contact_Icon.webp" alt="contactIcon">
                <label for="contactIcon">Contact</label>
            </a>
        </div>
    </div>

</div>


</body>
</html>