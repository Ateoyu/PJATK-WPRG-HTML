<?php

require_once 'MenuFunctionality.php';

class CheckoutFunctionality extends MenuFunctionality {

    static function displayCartItems(): void { ?>
        <?php foreach ($_SESSION['cart'] as $cartItem) : ?>
            <li>
                <div class="foodDetailsImage">
                    <img src="<?= $cartItem->getImage() ?>" alt="<?= $cartItem->getName() ?>">
                </div>
                <div class="foodDetailsInfo">
                    <h1><?= $cartItem->getName() ?></h1>
                    <p><?= $cartItem->getDescription() ?></p>
                    <div class="quantityTotalContainer">
                        <form method="POST" action="">
                            <p> Quantity: <?= $cartItem->getQuantity() ?></p>
                            <input type="hidden" name="incrementId" value="<?= $cartItem->getId() ?>">
                            <button class="incButton" type="submit" name="incrementQuantity">+</button>
                            <button class="decButton" type="submit" name="decrementQuantity">-</button>
                        </form>
                        <p> Total: <?= $cartItem->calculateTotalItemPrice() ?></p>
                    </div>
                </div>
                <form class="deleteForm" method="POST" action="">
                    <input type="hidden" name="removeFromCart" value="<?= $cartItem->getId() ?>">
                    <button type="submit" value="<?= $cartItem->getId() ?>">Remove from cart</button>
                </form>
            </li>
        <?php endforeach;
    }

    static function incrementQuantity($foodId): void {
        foreach ($_SESSION['cart'] as $cartItem) {
            if ($cartItem->getId() == $foodId) {
                $cartItem->setQuantity($cartItem->getQuantity() + 1);
            }
        }
    }

    static function decrementQuantity($foodId): void {
        foreach ($_SESSION['cart'] as $cartItem) {
            if ($cartItem->getId() == $foodId) {
                $cartItem->setQuantity($cartItem->getQuantity() - 1);
                if ($cartItem->getQuantity() == 0) {
                    self::removeFromCart($foodId);
                }
            }
        }
    }

    static function removeFromCart($foodId): void {
        foreach ($_SESSION['cart'] as $key => $cartItem) {
            if ($cartItem->getId() == $foodId) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }

    static function displayDeliveryForm(): void { ?>
        <div class="deliveryInfoContainer">
            <form id="deliveryForm" method="POST" action="06-Delivery.php">
                <h2>Delivery Information</h2>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>

                <label for="postcode">Postcode:</label>
                <input type="text" id="postcode" name="postcode" required>

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email"
                       value=" <?= (isset($_SESSION['loggedInUser'])) ? $_SESSION['loggedInUser']->getEmail() : null ?> "
                       required>
            </form>
        </div>
    <?php }

    static function displayBasketFooterDiv(): void { ?>
        <div class="basketDiv">
            <?php self::displayCartTotal();
            if (!empty($_SESSION['cart'])) { ?>
                <button type="submit" form="deliveryForm" name="checkoutButton">Checkout</button>
            <?php } else { ?>
                <button type="button" name="checkoutButton">Cart is empty</button>
            <?php } ?>
        </div>
    <?php }

}