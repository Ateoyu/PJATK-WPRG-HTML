<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Form Site</title>
    <link rel='stylesheet' href="">
</head>
<body>
<form method="post" action="Zad03-2.php">
    <fieldset>
        <label for="backgroundColour">Select Background Colour:</label>
        <select id="backgroundColour" name="backgroundColourSelect">
            <option value="black">Black</option>
            <option value="white">White</option>
            <option value="red">Red</option>
            <option value="blue">Blue</option>
            <option value="green">Green</option>
        </select>
        <label for="textColour">Select Text Colour:</label>
        <select id="textColour" name="textColourSelect">
            <option value="black">Black</option>
            <option value="white">White</option>
            <option value="red">Red</option>
            <option value="blue">Blue</option>
            <option value="green">Green</option>
        </select>
        <button type="submit" name="submitPref">Submit Preferences</button>
    </fieldset>
</form>
</body>