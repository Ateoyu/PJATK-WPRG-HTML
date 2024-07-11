<?php

class Food {
    private int $id;
    private string $name;
    private string $description;
    private float $price;
    private string $category;
    private string $image;
    private int $quantity;

    public function __construct(int $foodId, string $foodName, string $foodDescription, float $foodPrice, string $foodCategory, string $foodImage, int $foodQuantity) {
        $this->id = $foodId;
        $this->name = $foodName;
        $this->description = $foodDescription;
        $this->price = $foodPrice;
        $this->category = $foodCategory;
        $this->image = $foodImage;
        $this->quantity = $foodQuantity;
    }

    public function calculateTotalItemPrice() {
        $total =  $this->price * $this->quantity;
        return number_format($total, 2);
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getCategory(): string {
        return $this->category;
    }

    public function getImage(): string {
        return $this->image;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setDescription($description): void {
        $this->description = $description;
    }

    public function setPrice($price): void {
        $this->price = $price;
    }

    public function setCategory($category): void {
        $this->category = $category;
    }

    public function setImage($image): void {
        $this->image = $image;
    }

    public function setQuantity($quantity): void {
        $this->quantity = $quantity;
    }

    public function __toString() {
        return "ItemID: <?= $this->id ?>, Name: <?= $this->name ?>, Description: <?= $this->description ?>, Price: <?= $this->price ?>, Category: <?= $this->category ?>, Image: <?= $this->image ?>, Quantity: <?= $this->quantity ?>";
        }
}