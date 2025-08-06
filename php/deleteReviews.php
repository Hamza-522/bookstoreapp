<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $review_id = $_POST['review_id'];

    // Delete the review from the database
    $query = "DELETE FROM reviews WHERE review_id = '$review_id'";
    if (mysqli_query($con, $query)) {
        echo "Review deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Review</title>
</head>
<body>
    <h2>Delete Review</h2>
    <form method="POST" action="">
        <label for="review_id">Review ID:</label>
        <input type="text" name="review_id" id="review_id" required>
        <button type="submit">Delete Review</button>
    </form>
</body>
</html>
