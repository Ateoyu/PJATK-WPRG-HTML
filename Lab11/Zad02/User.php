<?php

namespace Zad02;

class User
{
        public string $message;

        function __construct() {
            $this->message = "This is a message from";
        }

        function introduce($name) : string {
                return $this->message . ' ' . $name;
        }

}