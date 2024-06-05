<?php

class Car {
    private string $model;
    private float $price;
    private float $exchangeRate;

    public function __construct(string $model, float $price, float $exchangeRate) {
        $this->model = $model;
        $this->price = $price;
        $this->exchangeRate = $exchangeRate;
        if (!isset($_SESSION['carCount'])) {
            $_SESSION['carCount'] = 0;
        }
        $_SESSION['carCount']++;
    }

    function value(): float|int {
        return $this->price * $this->exchangeRate;
    }

    public function __toString(): string {
        return "Model: " . $this->model . ",\nBase Price: " . $this->price . "Euro" . ",\nExchange Rate: " . $this->exchangeRate;
    }

    public static function getCount(): int {
        if (!isset($_SESSION['carCount'])) {
            return 0;
        } else {
            return $_SESSION['carCount'];
        }
    }

    public function getExchangeRate(): float {
        return $this->exchangeRate;
    }

    public function getModel(): string {
        return $this->model;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public static function setCount(int $count): void {
        $_SESSION['carCount'] = isset($_SESSION['carCount']) ? $count : 0;
    }

    public function setExchangeRate(float $exchangeRate): void {
        $this->exchangeRate = $exchangeRate;
    }

    public function setModel(string $model): void {
        $this->model = $model;
    }

    public function setPrice(float $price): void {
        $this->price = $price;
    }
}