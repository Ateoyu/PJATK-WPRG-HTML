<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>
    <link rel="stylesheet" href="ContactForm.css">
</head>
<body>
<h1>Contact Form</h1>
<div id="uhm">
    <form method="post" action="">
        <fieldset id='contactField'>
            <div class="form">
                <label for="fullname"></label>
                <input type="text" id="fullname" name="fullname" placeholder="Your forename and surname" required>

                <label for="email"></label>
                <input type="email" id="email" name="email" placeholder="Your email" required>

                <label for="phoneNumber"></label>
                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Your phone number" required>

                <label for="topic"></label>
                <select id="topic" name="topic" required>
                    <option value="" disabled selected>Select topic</option>
                    <option value="Topic1">Topic 1</option>
                    <option value="Topic2">Topic 2</option>
                </select>

                <label for="message"></label>
                <input type="text" id="message" name="message" placeholder="Your message here">

                <div class="checkboxLabel">
                    <label for="checkbox1">Choose Options:</label>
                </div>
                <div class="checkboxes">
                    <input type="checkbox" id="checkbox1" name="checkbox1">
                    <label for="checkbox1">Option 1</label>

                    <input type="checkbox" id="checkbox2" name="checkbox2">
                    <label for="checkbox2">Option 2</label>
                </div>

                <div class="radioLabel">
                    <label for="radio1">Choose one option:</label>
                </div>
                <div class="radios">
                    <input type="radio" id="radio1" name="radio" value="radio1">
                    <label for="radio1">Option 1</label>

                    <input type="radio" id="radio2" name="radio" value="radio2">
                    <label for="radio2">Option 2</label>
                </div>

                <button type="submit">Send</button>
            </div>
        </fieldset>
    </form>
</div>

<?php
function validateEmail($email): string
{
    if (!preg_match("/^[A-z0-9.]+@[A-z]+\.[A-z]{3}+$/", $email)) {
        return "ERROR";
    }
    return $email;
}

function validatePhoneNumber($phoneNumber): string
{
    if (!preg_match("/^[+][0-9]/", $phoneNumber)) {
        return "ERROR";
    }
    return $phoneNumber;
}

function validateCheckbox($checkbox1, $checkbox2): string
{
    if (isset($_POST['checkbox1'], $_POST['checkbox2'])) return $checkbox1 . $checkbox2;
    else if (isset($_POST['checkbox1']) && !isset($_POST['checkbox2'])) return $checkbox1 . "off";
    else if (!isset($_POST['checkbox1']) && isset($_POST['checkbox2'])) return "off" . $checkbox2;
    return "ERROR";
}

function displayCheckbox($checkbox): string
{
    if ($checkbox == "onon") return "Option 1 + Option 2";
    else if ($checkbox == "onoff") return "Option 1";
    else if ($checkbox == "offon") return "Option 2";
    return "ERROR";
}

function displayRadios($radio): string
{
    if ($radio == "radio1") {
        return 'Option 1';
    } elseif ($radio == "radio2") {
        return 'Option 2';
    }
    return 'Error.';
}

?>

<div class="formResult">
    <h1>Form Info:</h1>
    <ul>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['radio'])) {
            if (isset($_POST["fullname"]) + isset($_POST["email"]) + isset($_POST["phoneNumber"]) + isset($_POST["topic"]) + isset($_POST["message"]) + isset($_POST["checkbox1"]) + isset($_POST["checkbox2"])) {
                echo "<li>" . $_POST['fullname'] . "</li>";
                echo "<li>" . validateEmail($_POST['email']) . "</li>";
                echo "<li>" . validatePhoneNumber($_POST['phoneNumber']) . "</li>";
                echo "<li>" . $_POST['topic'] . "</li>";
                echo "<li>" . $_POST['message'] . "</li>";
                echo "<li>" . displayCheckbox(validateCheckbox(isset($_POST['checkbox1']) , isset($_POST['checkbox2']))) . "</li>";
                echo "<li>" . displayRadios($_POST['radio']) . "</li>";
            }
        }
        ?>
    </ul>
</div>
</body>