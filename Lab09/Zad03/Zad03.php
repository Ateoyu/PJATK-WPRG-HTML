<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UHHHHHHH</title>
    <link rel="stylesheet" href="Zad03.css">
</head>
<body>

<div class="uhm">
    <form method="post" action="">
        <fieldset id='form'>
            <div class="formHeader">
                <h2>Calculate Age and Work Days</h2>
            </div>
            <div class="formContent">
                <label for="calcAgeAndTime">Calculate age and local time</label>
                <div>
                    <input type="date" id="calcAgeAndTime" name="calcAgeAndTimeInput">
                    <label for="localTime"></label>
                    <select id="localTime" name="localTimeSelect">
                        <option value="selectTimezone" disabled selected>Select Timezone</option>
                        <?php
                        $timezoneArray = DateTimeZone::listIdentifiers();
                        foreach ($timezoneArray as $timezone) {
                            echo '<option value="' . $timezone . '">' . $timezone . '</option>';
                        }
                        ?>
                    </select>
                    <button type="submit">Calculate Age and Time</button>
                </div>
            </div>
            <div class="formContent2">
                <label for="beginDate">Calculate Work Days</label>
                <div>
                    <input type="date" id="beginDate" name="beginDateInput">
                    <label for="endDate"></label>
                    <input type="date" id="endDate" name="endDateInput">
                    <button type="submit">CalculateWorkDays</button>
                </div>
            </div>
        </fieldset>
    </form>

    <div id="resultDiv">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST['calcAgeAndTimeInput']) && isset($_POST['localTimeSelect'])) {
                echo "<p>Age:";
                calcAge($_POST['calcAgeAndTimeInput']) . "</p>";
                echo "<p>Timezone: ";
                outputLocalTime($_POST['localTimeSelect']) . "</p>";
            } elseif (isset($_POST['beginDateInput']) && isset($_POST['endDateInput'])) {
                $beginDate = $_POST['beginDateInput'];
                $endDate = $_POST['endDateInput'];
                echo "<p>Number of work days between " . $beginDate . " and " . $endDate . ": " . calcWorkDays($beginDate, $endDate) . "</p>";
            }
        }
        ?>
    </div>

</div>
</body>
</html>

<?php
function calcAge($dateOfBirth): void
{
    $dateOfBirth = new DateTime("$dateOfBirth");
    $currentDate = new DateTime("now");

    $dateInterval = $dateOfBirth->diff($currentDate);
    echo $dateInterval->format('%y years, %m months, %d days');
}

function outputLocalTime($timezone): void
{
    $dt = new DateTime("now", new DateTimeZone($timezone));
    echo $dt->format('d.m.Y, H:i:s');
}

function calcWorkDays($beginDate, $endDate): int
{
    $beginDate = new DateTime($beginDate);
    $endDate = new DateTime($endDate);
    $interval = new DateInterval('P1D');
    $dateRange = new DatePeriod($beginDate, $interval, $endDate);
    $workDays = 0;
    foreach ($dateRange as $date) {
        if ($date->format("N") < 6) {
            $workDays++;
        }
    }
    return $workDays;
}

?>