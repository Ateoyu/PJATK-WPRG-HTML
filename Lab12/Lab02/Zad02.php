<?php
$dbhost = 'mysql:host=localhost';
$dbuser = 'Marcel';
$dbpass = 'wahoo';
$personsArray = null;
$carsArray = null;
$searchResult = null;
$deleteMessage = null;

try {
    $pdo = new PDO($dbhost, $dbuser, $dbpass);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS zad02");
    $pdo->exec("USE zad02");


    $personTable = "CREATE TABLE IF NOT EXISTS Person (
        Person_id INT AUTO_INCREMENT,
        Person_first_name VARCHAR(255) NOT NULL,
        Person_second_name VARCHAR(255) NOT NULL, 
        PRIMARY KEY ( Person_id ));";

    $pdo->exec($personTable);

    $carsTable = "CREATE TABLE IF NOT EXISTS Cars (
        Cars_id INT AUTO_INCREMENT, 
        Cars_model VARCHAR(255) NOT NULL, 
        Cars_price FLOAT NOT NULL, 
        Cars_day_of_buy DATETIME NOT NULL, 
        Person_id INT,

        PRIMARY KEY ( Cars_id ),
        FOREIGN KEY ( Person_id ) REFERENCES Person ( Person_id ));";

    $pdo->exec($carsTable);
    echo "Successfully created tables";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addPerson'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $insertPersonDetails = "INSERT INTO person(Person_first_name, Person_second_name) VALUES('$firstName', '$lastName');";
        $pdo->exec($insertPersonDetails);
    }

    if (isset($_POST['addCar'])) {
        $carModel = $_POST['carModel'];
        $carPrice = $_POST['carPrice'];
        $carDayOfBuy = $_POST['carDayOfBuy'];
        $person_id = $_POST['selectPersonID'];
        $insertCarDetails = "INSERT INTO cars(Cars_model, Cars_price, Cars_day_of_buy, Person_id) VALUES('$carModel', '$carPrice', '$carDayOfBuy', '$person_id');";
        $pdo->exec($insertCarDetails);
    }
    //EDITING PERSON TO DB
    if (isset($_POST['submitPersonEdit'])) {
        $person_id = $_POST['personIndex'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $pdo->exec("UPDATE person SET Person_first_name = '$firstName', Person_second_name = '$lastName' WHERE Person_id = '$person_id'");
    }
    //EDITING CAR TO DB
    if (isset($_POST['submitCarEdit'])) {
        $carModel = $_POST['carModel'];
        $carPrice = $_POST['carPrice'];
        $carDayOfBuy = $_POST['dayOfBuyEdit'];
        $person_id = $_POST['selectPersonID'];
        $car_id = $_POST['carIndex'];
        $pdo->exec("UPDATE cars SET Cars_model = '$carModel', Cars_price = '$carPrice', Cars_day_of_buy = '$carDayOfBuy', Person_id = '$person_id' WHERE Cars_id = '$car_id'");
    }
    //SEARCHING DATABASE
    if (isset($_POST['searchSubmit'])) {
        $searchColumn = $_POST['searchColumn'];
        $searchValue = $_POST['searchValue'];
        $searchResult = $pdo->query("SELECT * FROM person JOIN cars ON person.Person_id = cars.Person_id WHERE $searchColumn LIKE '%$searchValue%'")->fetchAll(PDO::FETCH_ASSOC);
    }

    if (isset($_POST['deletePerson'])) {
        $person_id = $_POST['personIndex'];
        $pdo->exec("DELETE FROM person WHERE Person_id = '$person_id'");
        $pdo->exec("DELETE FROM cars WHERE Person_id = '$person_id'");
        $deleteMessage = "Successfully deleted person with ID " . $person_id;
    }

    if (isset($_POST['deleteCar'])) {
        $car_id = $_POST['carIndex'];
        $pdo->exec("DELETE FROM cars WHERE Cars_id = '$car_id'");
        $deleteMessage = "Successfully deleted car with ID: " . $car_id;
    }

    $personsArray = $pdo->query("SELECT * FROM person")->fetchAll(PDO::FETCH_ASSOC);
    $carsArray = $pdo->query("SELECT * FROM cars")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Zad02 DataBase Stuff</title>
    <link rel="stylesheet" href="Zad02.css">
</head>
<body>
<div id="flexMainContainer">
    
<?php if ($deleteMessage != null) : ?>
<h3> <?= $deleteMessage ?></h3>
<?php endif ?>
<form method="post" action="">
    <fieldset>
        <legend><h1>Manage MySQL Database</h1></legend>
        <h2>Add Person</h2>
        <label>
            <input type="text" name="firstName" placeholder="First Name" required>
            <input type="text" name="lastName" placeholder="Last Name" required>
        </label>
        <button type="submit" name="addPerson">Add Person</button>
    </fieldset>
</form>
<form method="post" action="">
    <fieldset>
        <legend><h1>Add Cars</h1></legend>
        <label>
            <input type="text" name="carModel" placeholder="Model" required>
            <input type="number" name="carPrice" step="0.01" min="0" placeholder="0.00" required>
            <input type="datetime-local" name="carDayOfBuy" required>
            <select name="selectPersonID">
                <?php foreach ($personsArray as $personID) : ?>
                    <option value=" <?= $personID['Person_id'] ?> "> <?= $personID['Person_id'] ?> </option>
                <?php endforeach ?>
            </select>
        </label>
        <button type="submit" name="addCar">Add Car</button>
    </fieldset>
</form>

<!--SEARCHING DATABASE-->
<form method="post" action="">
    <fieldset>
        <legend><h1>Search Database</h1></legend>
        <label>
            <select name="searchColumn">
                <option value="Person_first_name">Person_first_name</option>
                <option value="Person_second_name">Person_second_name</option>
                <option value="Cars_model">Cars_model</option>
                <option value="Cars_price">Cars_price</option>
                <option value="Cars_day_of_buy">Cars_day_of_buy</option>
            </select>
            <input type="text" name="searchValue" placeholder="Input Search Text">
        </label>
        <button type="submit" name="searchSubmit">Search</button>
    </fieldset>
</form>
<?php if (isset($searchResult) && !empty($searchResult)) : ?>
<fieldset>
    <h1>Search Results</h1>
    <table>
        <thead>
        <tr>
            <th>First Name</th>
            <th>Second Name</th>
            <th>Cars Model</th>
            <th>Cars Price</th>
            <th>Cars Day of Buy</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($searchResult as $row) : ?>
            <tr>
                <td> <?= $row['Person_first_name'] ?> </td>
                <td> <?= $row['Person_second_name'] ?> </td>
                <td> <?= $row['Cars_model'] ?> </td>
                <td> <?= $row['Cars_price'] ?> </td>
                <td> <?= $row['Cars_day_of_buy'] ?> </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</fieldset>
<?php endif ?>


<!--EDITING PERSON FORM-->
<?php if (isset($_POST['editPerson'])) : ?>
    <?php $person_id = $_POST['personIndex'];
    $row = $pdo->query("SELECT * FROM person WHERE Person_id = '$person_id'")->fetchAll(PDO::FETCH_ASSOC); ?>
    <form method="post" action="">
        <fieldset>
            <legend><h1>Edit <?= $row[0]['Person_first_name'] ?> </h1></legend>
            <label>
                <input type="text" name="firstName" value="<?= $row[0]['Person_first_name'] ?>"
                       placeholder="First Name" required>
                <input type="text" name="lastName" value="<?= $row[0]['Person_second_name'] ?>"
                       placeholder="Last Name" required>
            </label>
            <input type="hidden" name="personIndex" value="<?= $person_id ?>">
            <button type="submit" name="submitPersonEdit">Edit Person</button>
        </fieldset>
    </form>
<?php endif ?>

<?php if (isset($_POST['editCar'])) : ?>
    <?php $car_id = $_POST['carIndex'];
    $car = $pdo->query("SELECT * FROM cars WHERE Cars_id = '$car_id'")->fetchAll(PDO::FETCH_ASSOC); ?>
    <form method="post" action="">
        <fieldset>
            <legend><h1>Edit Car: <?= $car[0]['Cars_model'] ?></h1></legend>
            <label>
                <input type="text" name="carModel" value="<?= $car[0]['Cars_model'] ?>" placeholder="Model" required>
                <input type="number" name="carPrice" step="0.01" min="0" value="<?= $car[0]['Cars_price'] ?>"
                       placeholder="0.00" required>
                <input type='datetime-local' name='dayOfBuyEdit' value='<?= $car[0]['Cars_day_of_buy'] ?>' required>
                <select name="selectPersonID">
                    <?php foreach ($personsArray as $personID) : ?>
                        <?php if ($personID['Person_id'] == $car[0]['Person_id']) { ?>
                            <option value=" <?= $car[0]['Person_id'] ?> "
                                    selected> <?= $car[0]['Person_id'] ?> </option>
                        <?php } else { ?>
                            <option value=" <?= $personID['Person_id'] ?> "> <?= $personID['Person_id'] ?> </option>
                        <?php } ?>
                    <?php endforeach ?>
                </select>
            </label>
            <input type="hidden" name="carIndex" value=" <?= $car_id ?>">
            <button type="submit" name="submitCarEdit">Edit Car</button>
        </fieldset>
    </form>
<?php endif ?>


<?php if ($personsArray) : ?>
    <table>
        <thead>
        <tr>
            <th>Person ID</th>
            <th>First Name</th>
            <th>Second Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($personsArray as $row) : ?>
            <tr>
                <td> <?= $row['Person_id'] ?> </td>
                <td> <?= $row['Person_first_name'] ?> </td>
                <td> <?= $row['Person_second_name'] ?> </td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="personIndex" value=" <?= $row['Person_id'] ?>">
                        <button type="submit" name="deletePerson">Delete</button>
                        <button type="submit" name="editPerson">Edit</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>

<?php if ($carsArray) : ?>
    <table>
        <thead>
        <tr>
            <th>Cars ID</th>
            <th>Cars Model</th>
            <th>Cars Price</th>
            <th>Cars Day of Buy</th>
            <th>Person ID</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($carsArray as $car) : ?>
            <tr>
                <td> <?= $car['Cars_id'] ?> </td>
                <td> <?= $car['Cars_model'] ?> </td>
                <td> <?= $car['Cars_price'] ?> </td>
                <td> <?= $car['Cars_day_of_buy'] ?> </td>
                <td> <?= $car['Person_id'] ?> </td>
                <td class="buttonTD">
                    <form method="post" action="">
                        <input type="hidden" name="carIndex" value=" <?= $car['Cars_id'] ?>">
                        <button type="submit" name="deleteCar">Delete</button>
                        <button type="submit" name="editCar">Edit</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>
</div>
</body>
</html>