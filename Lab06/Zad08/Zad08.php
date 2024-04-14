<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zad08</title>
    <link rel="stylesheet" href="Zad08.css">
</head>

<body>

<?php
function CapybaraNomsCarrot(): bool
{
    $randomNum = rand(0, 10);

    if ($randomNum <= 6) {
        return true;
    } else {
        return false;
    }
}

?>

<div id="flexContainer">
    <img class="cappyImg"
         src="https://www.blackpoolzoo.org.uk/content/dam/blk/images/discover-the-zoo/what-we-have/experiences/animals-experiences/Capy.JPG"
         width="500" alt="Capybara Image"/>
    <?php if (CapybaraNomsCarrot()) : ?>
        <img class="carrot"
             src="https://static.vecteezy.com/system/resources/previews/027/216/290/original/red-carrot-red-carrot-transparent-background-ai-generated-free-png.png"
             width="500" alt="Carrot Image"/>
    <?php endif; ?>
</div>

</body>
</html>


