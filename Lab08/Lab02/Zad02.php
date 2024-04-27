<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Advanced Sequence Operations</title>
    <link rel="stylesheet" href="">
</head>
<body>
<div id=header>
    <h1>Advanced Sequence Operations</h1>
</div>
<div id="uhm">
    <form method="post" action="">
        <fieldset id='sequenceField'>
            <div class="form">
                <label for="sequenceInput">Input Sequence:</label>
                <input type="text" id="sequenceInput" name="sequenceInput" placeholder="Input Sequence here" required>

                <label for="operation">Operation:</label>
                
                <select id="operation" name="operation" required>
                    <option value="extractWordsAndCount">Count how many times a word appears in the Sequence</option>
                    <option value="sortAlphabeticallyAZ">Sort Words Alphabetically [A-Z]</option>
                    <option value="sortAlphabeticallyZA">Sort Words Alphabetically [Z-A]</option>
                    <option value="count">Count</option>
                    <option value="removeWhitespace">Remove Whitespace</option>
                </select>

                <button type="submit">Calculate</button>
            </div>
        </fieldset>
    </form>
</div>