<?php
require_once 'PageFunctionality.php';
require_once 'MenuInterface.php';

class MenuFunctionality extends PageFunctionality implements MenuInterface {

    private static function iterateFoodItems(array $fetchedFood): void {
        foreach ($fetchedFood as $food) : ?>
            <a href="04-FoodDetails.php?food_id=<?= $food['food_id'] ?>" class="foodItem">
                <div class="imageContainer">
                    <img src="<?= $food['food_image'] ?>" alt="<?php echo $food['food_name'] ?>">
                </div>
                <div class="foodInfo">
                    <h3><?= $food['food_name'] ?></h3>
                    <p><?= '$' . $food['food_price'] ?></p>
                </div>
            </a>
        <?php endforeach;
    }

    static function getOrderByClause($sortValue): string {
        return match ($sortValue) {
            'sortByNameA-Z' => 'ORDER BY food_name ASC',
            'sortByNameZ-A' => 'ORDER BY food_name DESC',
            'sortByPriceAsc' => 'ORDER BY food_price ASC',
            'sortByPriceDesc' => 'ORDER BY food_price DESC',
            default => '',
        };
    }

    static function displayAllMenuItems(): void {
        global $pdo; ?>
        <div class="categoryContainer">
            <h1 class="categoryLabel">All Menu Items</h1>
            <form class="sortButtons" method="POST" action="">
                <label for="sortItems">Sort by:</label>
                <button class="sortItems" type="submit" name="sortItems" value="sortByNameA-Z">A-Z</button>
                <button class="sortItems" type="submit" name="sortItems" value="sortByNameZ-A">Z-A</button>
                <button class="sortItems" type="submit" name="sortItems" value="sortByPriceAsc">Price Ascending</button>
                <button class="sortItems" type="submit" name="sortItems" value="sortByPriceDesc">Price Descending</button>
            </form>
        </div>
        <?php
        $orderBy = self::getOrderByClause($_POST['sortItems'] ?? '');
        $allFoods = $pdo->query("SELECT * FROM food $orderBy")->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($allFoods)) {
            self::iterateFoodItems($allFoods);
        } else {
            echo "<p>No food items found.</p>";
        }
    }

    static function displayCategoryMenuItems($category): void {
        global $pdo; ?>
        <div class="categoryContainer">
            <h1 class="categoryLabel"><?= $category ?></h1>
            <form class="sortButtons" method="POST" action="">
                <label for="sortItems">Sort by:</label>
                <button class="sortItems" type="submit" name="sortItems" value="sortByNameA-Z">A-Z</button>
                <button class="sortItems" type="submit" name="sortItems" value="sortByNameZ-A">Z-A</button>
                <button class="sortItems" type="submit" name="sortItems" value="sortByPriceAsc">Price Ascending</button>
                <button class="sortItems" type="submit" name="sortItems" value="sortByPriceDesc">Price Descending</button>
            </form>
        </div>
        <?php
        $orderBy = self::getOrderByClause($_POST['sortItems'] ?? '');
        $specificCategoryFood = $pdo->query("SELECT * FROM food WHERE food_category = '$category' $orderBy")->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($specificCategoryFood)) {
            self::iterateFoodItems($specificCategoryFood);
        } else {
            echo "<p>No food items found.</p>";
        }
    }

    static function displayAllCategories(): void {
        global $pdo;
        $categories = $pdo->query("SELECT DISTINCT food_category FROM food")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as $category) : ?>
            <li>
                <form method="POST" action="03-Menu.php">
                    <input type="hidden" name="category" value="<?= $category['food_category'] ?>">
                    <button type="submit"><?= $category['food_category'] ?></button>
                </form>
            </li>
        <?php endforeach;
    }

    static function getFoodDetails($foodId): array {
        global $pdo;
        return $pdo->query("SELECT * FROM food WHERE food_id = $foodId")->fetch(PDO::FETCH_ASSOC);
    }


    static function addToCart($foodId, $quantity): void {
        global $pdo;
        $food = $pdo->query("SELECT * FROM food WHERE food_id = $foodId")->fetch(PDO::FETCH_ASSOC);

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $matchingFood = array_filter($_SESSION['cart'], fn($food) => $food->getId() == $foodId);
        if (!empty($matchingFood)) {
            // Check if the food item is already in the cart
            foreach ($_SESSION['cart'] as $item) {
                if ($item->getId() == $foodId) {
                    // If it is, increment the quantity
                    $item->setQuantity($item->getQuantity() + $quantity);
                }
            }
        } else {
            // If it's not in the cart, add it
            $foodItem = new Food($food['food_id'], $food['food_name'], $food['food_description'], $food['food_price'], $food['food_category'], $food['food_image'], $quantity);
            $_SESSION['cart'][] = $foodItem;
        }
    }

    static function displayCartTotal(): void {
        $total = 0;
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $food) {
                $total += $food->getPrice() * $food->getQuantity();
            }
        }
        $total = number_format($total, 2);
        $_SESSION['cartTotal'] = $total;
        echo '<img src="Photos/ShoppingBag.svg" alt="ShoppingBag.svg"> <h2>Total: $' . $_SESSION['cartTotal'] . '</h2>';
    }

    static function displaySideNav(): void { ?>
        <nav id="sideNav">
            <h2>Hey,<br>what's it going to be today?</h2>
            <ul>
                <li>
                    <form method="POST" action="03-Menu.php">
                        <button type="submit">All Menu Items</button>
                    </form>
                </li>
                <?php MenuFunctionality::displayAllCategories(); ?>
            </ul>
        </nav>
    <?php }

    static function displayBasketFooterDiv(): void { ?>
        <div class="basketDiv">
            <?php self::displayCartTotal(); ?>
            <form class="checkoutButtonForm" method="POST" action="05-Checkout.php">
                <button type="submit" name="checkoutButton">View Basket</button>
            </form>
        </div>
    <?php }


}