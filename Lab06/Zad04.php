<?php

echo 'Enter radius of the cylinder: ';
$radius = fgets(STDIN);

echo 'Enter cylinder height: ';
$height = fgets(STDIN);

$cylinderVolume = pi()*(pow($radius, 2))*$height;

echo "Volume of cylinder: $cylinderVolume";