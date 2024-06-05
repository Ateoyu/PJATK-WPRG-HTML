<?php

class carTypeForm {
    public static function outputChosenForm($chosenCarType): void {
        ?>
        <form id="detailForm" method="POST" action="">
            <h2> Add <?= $chosenCarType ?> </h2>
            <label for="model">Model:</label>
            <input type="text" id="model" name="model" required>
            <label for="priceEuro">Price (EURO):</label>
            <input type="number" id="priceEuro" name="priceEuro" min="0" step=".01" inputmode="decimal" placeholder="0"
                   required>
            <label for="exchangeRatePLN">Exchange rate (PLN):</label>
            <input type="number" id="exchangeRatePLN" name="exchangeRatePLN" min="0" step=".01" inputmode="decimal"
                   placeholder="0.00" required>
            <?php self::checkCarType($chosenCarType); ?>
            <button type="submit" id="addCar" name="addCar">Add Car</button>
        </form>
    <?php }

    private static function checkCarType($chosenCarType): void {
        if ($chosenCarType == "NewCar") {
            self::outputNewCarForm();
            echo '</div>';
        } else if ($chosenCarType == "InsuranceCar") {
            self::outputNewCarForm();
            self::outputInsuranceCarForm();
        }
    }

    private static function outputNewCarForm(): void {
        ?>
        <div class="checkboxes">
        <div>
            <label for="alarmCheckbox">Alarm:</label>
            <input type="checkbox" id="alarmCheckbox" name="alarmCheckbox">
        </div>
        <div>
            <label for="radioCheckbox">Radio:</label>
            <input type="checkbox" id="radioCheckbox" name="radioCheckbox">
        </div>
        <div>
            <label for="climatronicCheckbox">Climatronic:</label>
            <input type="checkbox" id="climatronicCheckbox" name="climatronicCheckbox">
        </div>
    <?php }

    private static function outputInsuranceCarForm(): void {
        ?>
        <div>
            <label for="firstOwnerCheckbox">First Owner:</label>
            <input type="checkbox" id="firstOwnerCheckbox" name="firstOwnerCheckbox">
        </div>
        </div>
        <label for="carAge">Car Age (years):</label>
        <input type="number" id="carAge" name="carAge" min="0" step="1" inputmode="numeric" placeholder="0" required>
    <?php }
}