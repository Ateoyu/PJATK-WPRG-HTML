<?php
class Animal
{
    protected string $species;
    private int $id;

    public function makeSound(): string
    {
        return "sound";
    }

    function __toString(): string
    {
        return "wahoo, toString works!";
    }
}