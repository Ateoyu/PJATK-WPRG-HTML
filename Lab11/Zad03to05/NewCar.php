<?php

require_once "Car.php";

class NewCar extends Car {
    private bool $alarm;
    private bool $radio;
    private bool $climatronic;

    function __construct(string $model, float $price, float $exchangeRate, bool $alarm, bool $radio, bool $climatronic) {
        parent::__construct($model, $price, $exchangeRate);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->climatronic = $climatronic;
    }

    public function value(): float|int {
        $value = parent::value();
        if ($this->alarm) {
            $value *= 1.05;
        }
        if ($this->radio) {
            $value *= 1.075;
        }
        if ($this->climatronic) {
            $value *= 1.1;
        }
        return $value;
    }

    public function __toString(): string {
        return parent::__toString() . ",\nAlarm: " . var_export($this->alarm, 1) . ",\nRadio: " . var_export($this->radio, 1) . ",\nClimatronic: " . var_export($this->climatronic, 1);
    }


    public function getAlarm(): bool {
        return $this->alarm;
    }

    public function setAlarm(bool $alarm): void {
        $this->alarm = $alarm;
    }

    public function getRadio(): bool {
        return $this->radio;
    }

    public function setRadio(bool $radio): void {
        $this->radio = $radio;
    }

    public function getClimatronic(): bool {
        return $this->climatronic;
    }

    public function setClimatronic(bool $climatronic): void {
        $this->climatronic = $climatronic;
    }
}