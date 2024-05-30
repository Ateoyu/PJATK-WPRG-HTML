<?php
require_once "Animal.php";
class Capybara extends Animal {
    public string $color;
    public int $age;


    function __construct(string $color, int $age) {
        $this->color = $color;
        $this->age = $age;
        $this->species = 'mammal';
    }

    function makeSound() : string {
        return "Capybara Noises! My species is " . $this->species;
    }


}