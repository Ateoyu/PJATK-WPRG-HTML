<?php

class Person {
    private string $firstname;
    private string $secondname;

    function __construct(string $firstname, string $secondname) {
        $this->firstname = $firstname;
        $this->secondname = $secondname;
    }


}