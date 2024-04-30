<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Advanced String Operations</title>
    <link rel="stylesheet" href="Zad02.css">
</head>
<body>

<div id="uhm">
    <form method="post" action="">
        <fieldset id='stringField'>
            <div class="form">
                <div id=header>
                    <h1>Advanced String Operations</h1>
                </div>
                <div class="formContent">
                    <label for="string">Input String:</label>
                    <textarea id="string" name="string" placeholder="Input string here" required></textarea>

                    <label for="operation">Operation:</label>

                    <select id="operation" name="operation" required>
                        <option value="" disabled selected>Select String Operation</option>
                        <option value="extractWordsAndCount">Count Each Word in String</option>
                        <option value="sortAlphabeticallyAZ">Sort Words Alphabetically</option>
                        <option value="countCharacters">Count Characters</option>
                        <option value="removeWhitespace">Remove Whitespace</option>
                    </select>

                    <div id="extractWordCaseSensitive" class="extractWordCaseSensitive">
                        <label for="isCaseSensitive">Should the word count be Case Sensitive?</label>
                        <input type="checkbox" id="isCaseSensitive" name="isCaseSensitive" value="on">
                    </div>

                    <div id="sortAlphabeticallyReverse" class="sortAlphabeticallyReverse">
                        <label for="reverseSort">Reverse Sort?</label>
                        <input type="checkbox" id="reverseSort" name="reverseSort" value="on">
                    </div>

                    <button type="submit">Calculate</button>
                </div>
            </div>
        </fieldset>
    </form>


    <script>
        const source = document.querySelector("#operation");
        const chosenOption = "extractWordsAndCount"
        const target = document.querySelector("#extractWordCaseSensitive");

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

        const chosenOption2 = "sortAlphabeticallyAZ"
        const target2 = document.querySelector("#sortAlphabeticallyReverse");

        source.addEventListener("change", function () {
            displayWhenSelected(source, chosenOption2, target2);
        }, false);
    </script>

    <div class="resultDiv">
        <div class="resultDivInside">
            <?php
            function extractWordsAndCountCaseSensitive($input): array
            {
                return array_count_values(str_word_count($input, 1, '0123456789'));
            }

            function extractWordsAndCount($input): array
            {
                $input = strtolower($input);
                return extractWordsAndCountCaseSensitive($input);
            }

            function sortAlphabeticallyAZ($input): array
            {
                //Ensure all non-word characters are replaced with " " except for "'" and "-".
                $input = preg_replace("/[^\w'-]/", " ", $input);
                $input = strtolower($input);
                $inputArr = explode(' ', $input);
                sort($inputArr, SORT_STRING);
                $inputArr = array_filter($inputArr);
                return array_values($inputArr);
            }

            function sortAlphabeticallyReverse($input): array
            {
                $input = sortAlphabeticallyAZ($input);
                rsort($input, SORT_STRING);
                return $input;
            }

            function countCharacters($input): array
            {
                $input = strtolower($input);
                $inputArr = str_split($input);
                sort($inputArr, SORT_NATURAL);
                return array_count_values($inputArr);
            }

            function removeWhitespace($input): string
            {
                return preg_replace("/[^\w'-]/", "", $input);
            }

            function displayAsTable($outputArray): void
            {
                echo "<table>";
                echo "<thead>";
                echo "<th>Word</th>";
                echo "<th>Count</th>";
                echo "</thead>";
                echo "<tbody>";
                foreach ($outputArray as $key => $value) {
                    echo "<tr>";
                    echo "<td>" . $key . "</td>";
                    echo "<td>" . $value . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["string"])) {
                    $string = $_POST["string"];
                    $operation = $_POST["operation"];
                    $caseSensitive = isset($_POST["isCaseSensitive"]);

                    echo "<div class='inputString'>";
                    echo "<h3>Input String: </h3>";
                    echo "<p>$string</p>";
                    echo "</div>";

                    echo "<div class='answer'>";
                    switch ($operation) {
                        case "extractWordsAndCount":
                            echo "<h4 class='resultType'> Words & Count </h4>";
                            if (isset($_POST["isCaseSensitive"])) {
                                $outputArray = extractWordsAndCountCaseSensitive($string);
                                displayAsTable($outputArray);
                                break;
                            } else {
                                $outputArray = (extractWordsAndCount($string));
                                displayAsTable($outputArray);
                            }
                            break;
                        case "sortAlphabeticallyAZ":
                            if (isset($_POST["reverseSort"])) {
                                echo "<h4 class='resultType'> Sorted Alphabetically (Reverse) </h4>";
                                echo implode(" ", sortAlphabeticallyReverse($string));
                                break;
                            } else
                                echo "<h4 class='resultType'> Sorted Alphabetically </h4>";
                            echo implode(" ", sortAlphabeticallyAZ($string));
                            break;
                        case "countCharacters":
                            $outputArray = countCharacters($string);
                            displayAsTable($outputArray);
                            break;
                        case "removeWhitespace":
                            $outputArray = removeWhitespace($string);
                            echo "<p>$outputArray</p>";
                    }
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>
</div>
</body>