<?php

interface MenuInterface {
    static function displayAllCategories();
    static function displayAllMenuItems();
    static function displayCategoryMenuItems($category);
    static function addToCart($foodId, $quantity);
    static function displayCartTotal();
    static function getFoodDetails($foodId);



}