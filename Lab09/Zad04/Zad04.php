<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>this one is evil Mr.Capy</title> <!-- the other ones were cool, this one not cool :( -->
    <link rel='stylesheet' href="Zad04.css">
</head>
<body>

<div class='uhm'>
    <form method='post' action="">
        <fieldset id='form'>
            <div class='formHeader'>
                <h2><label for='reviewInput'>Manage Reviews</label></h2>
            </div>
            <div class='formContent'>
                <textarea id='reviewInput' name='reviewInput' placeholder='Input your review here'></textarea>
                <button type='submit' name="addReview">Submit Review</button>
            </div>
        </fieldset>
    </form>

    <div id="allReviews">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!file_exists('./ReviewsDir') || !is_dir('./ReviewsDir')) {
                mkdir('./ReviewsDir');
            }

            if (isset($_POST["reset"])) {
                resetReviews();
            } elseif (isset($_POST['addReview']) && !empty($_POST['reviewInput'])) {
                $sentReview = $_POST['reviewInput'];
                $reviewDate = new DateTime('now');
                $fileName = $reviewDate->format('Y-m-d_H-i-s'); // This will create a unique filename based on the current date and time

                file_put_contents('./ReviewsDir/' . $fileName . 'review', $reviewDate->format('d.m.y H:m:s') . ' | ' . $sentReview);
            }
            if (isset($_POST['deleteReview'])) {
                $reviewToDelete = $_POST['deleteReview'];
                unlink('./ReviewsDir/' . $reviewToDelete);
            }

        }
        getReviews();

        function getReviews(): void
        {
            foreach (scandir('ReviewsDir') as $key => $review) {
                if ($review != "." && $review != "..") {
                    echo "<div class='reviewDiv'>";
                    $reviewMessage = file_get_contents('./ReviewsDir/' . $review);
                    echo "<p>" . $reviewMessage . "</p>";
                    echo "<form method='post' action=''>";
                    echo "<input type='hidden' name='deleteReview' value='$key'" . $review . "'>";
                    echo "<button type='submit' name='deleteReview' value='" . $review . "'>Delete Review</button></div>";
                    echo "</form>";
                }
            }
        }

        function resetReviews(): void
        {
            foreach (scandir('ReviewsDir') as $review) {
                if ($review != "." && $review != "..") {
                    unlink('./ReviewsDir/' . $review);
                }
            }
        }

        ?>
    </div>
    <form method='post' action="">
        <div class="lastButtonCuzItDontWannaCooperate">
        <button type="submit" id="resetButton" name="reset">Reset Reviews</button>
        </div>
    </form>
</div>

