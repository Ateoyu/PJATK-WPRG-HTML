<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Creating Directories</title>
    <link rel="stylesheet" href="Zad01.css">
</head>
<body>

<div class="uhm">
    <form method="post" action="">
        <fieldset id='form'>
            <div class="formHeader">
                <h2>Input Filename or Directory Name</h2>
            </div>
            <div class="formContent">
                <label for="filename"></label>
                <input type="text" id="filename" name="filename">

                <div class="radios">
                    <div>
                        <label for="fileRadio">File</label>
                        <input type="radio" value="file" id="fileRadio" name="choice">
                    </div>
                    <div>
                        <label for="directoryRadio">Directory</label>
                        <input type="radio" value="directory" id="directoryRadio" name="choice">
                    </div>
                </div>

                <button type="submit">Submit</button>
            </div>
        </fieldset>
    </form>

    <div class="answerDiv">
        <?php
        if (isset($_POST['filename']) && isset($_POST['choice'])) {
            $filename = $_POST['filename'];
            $choice = $_POST['choice'];

            if (!file_exists($filename)) {
                if ($choice == "file") {
                    fopen("$filename", "w") or die("Unable to open file!");
                } else if ($choice == "directory") {
                    mkdir("$filename") or die("Unable to create directory!");
                }
            }
            outputDiffSizes($filename);
        }
        ?>
    </div>
</div>

</body>
</html>

<?php
function outputDiffSizes($filename): void
{
    $bytes = filesize("$filename");
    $kilobytes = $bytes/1024;
    $megabytes = $kilobytes/1024;
    $gigabytes = $megabytes/1024;

    echo "Size:\n
    Bytes: " . $bytes . "\n
    Kilobytes: " . $kilobytes . "\n
    Megabytes: " . $megabytes . "\n
    Gigabytes: " . $gigabytes . "\n";
}


?>
