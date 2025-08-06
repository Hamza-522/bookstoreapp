<?php
include('config.php');

$query = "SELECT reviews.*, users.fname, books.title 
          FROM reviews
          INNER JOIN users ON reviews.user_id = users.id
          INNER JOIN books ON reviews.book_id = books.book_id";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Show Reviews</title>
</head>
<body>
    <h2>Reviews</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Review ID</th>
                <th>User Name</th>
                <th>Book Title</th>
                <th>Rating</th>
                <th>Comment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['review_id'] ?></td>
                <td><?= $row['fname'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['rating'] ?></td>
                <td><?= $row['review_text'] ?></td>
                <td>
                    <a href="editReview.php?review_id=<?= $row['review_id'] ?>">Edit</a>
                    <a href="deleteReview.php?review_id=<?= $row['review_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
