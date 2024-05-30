<?php
$backgroundColour = $_COOKIE['chosenBackground'];
$textColour = $_COOKIE['chosenTextColour'];
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Preferences Site</title>
    <link rel='stylesheet' href="Zad02-3.css">
    <style>
        body {
            background-color: <?php echo $backgroundColour; ?>;
            color: <?php echo $textColour; ?>;;
        }
    </style>
</head>
<body>
<div class="output">
    <h1>Output Page</h1>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus feugiat justo arcu, eget scelerisque metus
        mattis
        vitae. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean pharetra
        tincidunt congue. Vivamus ante eros, feugiat sit amet rutrum nec, pretium euismod nisi. Suspendisse porttitor ut
        sapien id finibus. Suspendisse bibendum feugiat imperdiet. Maecenas lobortis mauris et purus mollis pretium.
    </p>
    <p>
        Nullam hendrerit vel dolor vel mollis. Vestibulum porttitor enim in auctor lobortis. Proin ac est porttitor,
        venenatis massa quis, placerat mi. Etiam tristique nec magna vel pellentesque. Phasellus consequat magna magna,
        eget
        venenatis arcu egestas id. Praesent sit amet blandit lacus. Ut in felis eu tortor sollicitudin consequat. Etiam
        vulputate, augue at tincidunt bibendum, ante lectus congue nibh, ac lacinia risus nisl ut dolor. Aliquam a
        ligula a
        purus fermentum elementum. Suspendisse iaculis feugiat ex, in blandit velit lacinia a.
    </p>
    <p>
        Integer purus velit, pulvinar vel elementum vitae, ultricies vel lacus. Nunc imperdiet et ex ut egestas. Fusce
        aliquam urna tincidunt arcu blandit, et imperdiet dui euismod. Proin consequat, nulla vel ultricies porttitor,
        massa
        felis vulputate leo, consectetur iaculis nisl diam non lorem. In vulputate ante nec dolor egestas pellentesque.
        Suspendisse ornare nulla vel lectus tincidunt ornare. Sed gravida ut dui vitae viverra. Nulla sed augue eget
        erat
        blandit accumsan. Duis vitae velit quis ex eleifend pellentesque vitae at ante. Quisque placerat fermentum
        malesuada.
    </p>
    <p>
        Nulla facilisi. Nunc lectus tellus, dapibus consequat lectus sed, lobortis lobortis justo. Morbi gravida diam
        sed
        blandit placerat. Sed lacinia feugiat lacus. In ut tincidunt augue. Proin in pretium lacus. Aenean nec magna a
        eros
        congue scelerisque. Nullam mollis luctus ipsum quis malesuada. Nullam et pulvinar nunc. Integer blandit
        venenatis
        tellus sed ultricies. Cras eu est faucibus, ultrices nisl et, venenatis ante. Nulla facilisi.
    </p>
    <p>
        Morbi pretium quam felis, a fringilla sapien tempor eget. Curabitur nec consequat felis. Sed facilisis a nulla
        eu
        suscipit. Proin suscipit ullamcorper tortor sit amet semper. Donec id lectus sed libero porttitor laoreet sit
        amet
        in tortor. Praesent et lacinia risus, eu bibendum nulla. Maecenas dictum accumsan mauris, a viverra est
        scelerisque
        eu. Quisque aliquet nibh ex. Donec commodo quam ex, sit amet sodales ex pretium in. Nunc venenatis, odio nec
        eleifend accumsan, felis neque finibus massa, et aliquet neque risus laoreet nisl.
    </p>
    <a href="Zad02.php" style="font-weight: bold">Go back to preference selection.</a>
</div>
</body>
