<?php

require_once "Car.php";
require_once "NewCar.php";

//"Klasę NewCar oraz Car z poprzedniego zadania wklej tutaj."
//im not certain if I understand the above task, for now I will keep the classes separate, if necessary it's just a matter of copy and paste.

class InsuranceCar extends NewCar {
    private bool $firstOwner;
    private int $years;


    public function __construct(string $model, float $price, float $exchangeRate, bool $alarm, bool $radio, bool $climatronic, bool $firstOwner, int $years) {
        parent::__construct($model, $price, $exchangeRate, $alarm, $radio, $climatronic);
        $this->firstOwner = $firstOwner;
        $this->years = $years;
    }

    public function __toString(): string {
        return parent::__toString() . ",\nFirst Owner: " . var_export($this->firstOwner, 1) . ",\nYears: " . $this->years;
    }

    public function value(): float|int {
        $value = parent::value();
        if ($this->years >= 1) {
            $value -= $value * (0.01 * $this->years);
        }
        if ($this->firstOwner) {
            $value -= ($value * 0.05);
        }
        return $value;
    }

    public function getFirstOwner(): bool {
        return $this->firstOwner;
    }

    public function setFirstOwner($firstOwner): void {
        $this->firstOwner = $firstOwner;
    }

    public function getYears(): int {
        return $this->years;
    }

    public function setYears($years): void {
        $this->years = $years;
    }
}