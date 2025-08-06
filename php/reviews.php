<?php
include('config.php'); // Include your database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $book_id = mysqli_real_escape_string($con, $_POST['book_id']);
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']); // Assuming user_id is available
    $review_text = mysqli_real_escape_string($con, $_POST['review_text']);
    $rating = mysqli_real_escape_string($con, $_POST['rating']);

    // Insert the review into the database
    $query = "INSERT INTO `reviews`(`book_id`, `user_id`, `review_text`, `rating`, `timestamp`) 
              VALUES ('$book_id', '$user_id', '$review_text', '$rating', NOW())";

    if (mysqli_query($con, $query)) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit a Review</title>
</head>
<body>

<h2>Submit a Review</h2>

<!-- Form to submit a review for a book -->
<form action="reviews.php" method="POST">
    <label for="user_id">User ID:</label>
    <input type="text" name="user_id" id="user_id" required><br><br>

    <label for="book_id">Book:</label>
    <select name="book_id" id="book_id" required>
        <?php
        // Fetch all books from the database
        $result = mysqli_query($con, "SELECT * FROM books");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $row['book_id'] . "'>" . $row['title'] . "</option>";
        }
        ?>
    </select><br><br>

    <label for="rating">Rating (1-5):</label>
    <input type="number" name="rating" id="rating" min="1" max="5" required><br><br>

    <label for="review_text">Review Text:</label>
    <textarea name="review_text" id="review_text" required></textarea><br><br>

    <input type="submit" value="Submit Review">
</form>

</body>
</html>
