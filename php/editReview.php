<?php
include('config.php');

if (isset($_GET['review_id'])) {
    $review_id = $_GET['review_id'];
    $query = "SELECT * FROM reviews WHERE review_id = '$review_id'";
    $result = mysqli_query($con, $query);
    $review = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rating = mysqli_real_escape_string($con, $_POST['rating']);
        $comment = mysqli_real_escape_string($con, $_POST['comment']);
        $updateQuery = "UPDATE reviews SET rating = '$rating', review_text = '$comment' WHERE review_id = '$review_id'";
        if (mysqli_query($con, $updateQuery)) {
            echo "Review updated successfully!";
            header("Location: showReviews.php");
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Review</title>
</head>
<body>
    <h2>Edit Review</h2>
    <form method="POST">
        <label>Rating:</label>
        <input type="number" step="0.1" name="rating" value="<?= $review['rating'] ?>" required><br><br>
        <label>Comment:</label>
        <textarea name="comment" required><?= $review['review_text'] ?></textarea><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
