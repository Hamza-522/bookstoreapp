<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];

    // Delete the book from the database
    $query = "DELETE FROM books WHERE book_id = '$book_id'";
    if (mysqli_query($con, $query)) {
        echo "Book deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Book</title>
</head>
<body>
    <h2>Delete Book</h2>
    <form method="POST" action="">
        <label for="book_id">Book ID:</label>
        <input type="text" name="book_id" id="book_id" required>
        <button type="submit">Delete Book</button>
    </form>
</body>
</html>
