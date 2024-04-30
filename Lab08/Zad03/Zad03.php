<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Advanced String Operations2</title>
    <link rel="stylesheet" href="Zad03.css">
</head>
<body>

<div class="uhm">
    <form method="post" action="">
        <fieldset id='form'>
            <div class="formHeader">
                <h2>Analyser and Transformer of Text with Regex in PHP </h2>
            </div>
            <div class="formContent">
                <label for="stringField">Enter Text:</label>
                <textarea id="stringField" name="stringField" required></textarea>

                <label for="regexPattern">Enter REGEX Pattern:</label>
                <input type="text" id="regexPattern" name="regexPattern" placeholder="Make sure to input delimiter"
                       required>

                <label for="operation">Choose Operation:</label>
                <select id="operation" name="operation" required>
                    <option value="match">Match</option>
                    <option value="matchPositions">Match Positions</option>
                    <option value="replace">Replace</option>
                    <option value="validate">Validate</option>
                </select>

                <div id="replaceInput" class="replaceInput">
                    <label for="replaceInputText">Enter replacement text:</label>
                    <input type="text" id="replaceInputText" name="replaceInputText">
                </div>

                <button type="submit">Execute</button>
            </div>
        </fieldset>
    </form>

    <script>
        const source = document.querySelector("#operation");
        const chosenOption = "replace"
        const target = document.querySelector("#replaceInput");

        function displayWhenSelected(source, chosenOption, target) {
            if (source[source.selectedIndex].value === chosenOption) {
                target.classList.add("show");
            } else {
                target.classList.remove("show");
            }
        }

        source.addEventListener("change", function () {
            displayWhenSelected(source, chosenOption, target);
        }, false);
    </script>

    <div id="resultDiv">
        <div class="resultHeader">
            <h2>Result</h2>
        </div>
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["stringField"]) && isset($_POST["regexPattern"]) && isset($_POST["operation"])) {
                $inputText = $_POST["stringField"];
                $regexPattern = $_POST["regexPattern"];
                $operation = $_POST["operation"];
                $replaceText = $_POST["replaceInputText"];

                switch ($operation) {
                    case "match":
                        if (preg_match_all($regexPattern, $inputText, $matches)) {
                            echo "<table class='matchTable'>";
                            echo "<tbody>";
                            foreach ($matches[0] as $match) {
                                echo "<tr>";
                                echo "<td>Match:</td>";
                                echo "<td>$match</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                        } else {
                            echo "No results found for match: " . $regexPattern . "<br>";
                        }
                        break;

                    case "matchPositions":

                        if (preg_match_all($regexPattern, $inputText, $matches, PREG_OFFSET_CAPTURE)) {
                            echo "<table class='matchPositionsTable'>";
                            echo "<thead>";
                            echo "<th>Match</th>";
                            echo "<th>Position</th>";
                            echo "</thead>";
                            echo "<tbody>";

                            foreach ($matches[0] as $match) {
                                echo "<tr>";
                                echo "<td>$match[0]</td>";
                                echo "<td>$match[1]</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                        } else {
                            echo "No results found for match: " . $regexPattern . "<br>";
                        }
                        break;

                    case "replace":
                        $replaceString = preg_replace($regexPattern, $replaceText, $inputText, -1, $replacementAmount);
                        if ($replaceString === $inputText) {
                            echo "No results found for match: " . $regexPattern . " in " . $inputText . "<br>";
                        } else {
                            echo "<b>Replace Result:</b> " . $replaceString . "<br><b>Amount of Replacements:</b>" . $replacementAmount . "<br>";
                        }
                        break;

                    case "validate":
                        if (preg_match($regexPattern, $inputText) == 1) {
                            echo "The input and regex matches :D";
                        } else {
                            echo "The input and regex does not match D:";
                        }
                        break;

                    default:
                        echo "Error.";
                        break;
                }
            }


        }
        ?>
    </div>

</div>

</body>