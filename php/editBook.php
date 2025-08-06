<?php
include('config.php');

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    $query = "SELECT * FROM books WHERE book_id = '$book_id'";
    $result = mysqli_query($con, $query);
    $book = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = mysqli_real_escape_string($con, $_POST['title']);
        $author_id = mysqli_real_escape_string($con, $_POST['author_id']);
        $cat_id = mysqli_real_escape_string($con, $_POST['cat_id']);
        $price = mysqli_real_escape_string($con, $_POST['price']);
        $rating = mysqli_real_escape_string($con, $_POST['rating']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $image = $book['image'];

        if (!empty($_FILES['image']['name'])) {
            $fileTmpPath = $_FILES['image']['tmp_name'];
            $fileName = $_FILES['image']['name'];
            $uploadDir = 'uploads/books/';
            $destPath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $image = $destPath;
            }
        }

        $updateQuery = "UPDATE books 
                        SET title = '$title', author_id = '$author_id', cat_id = '$cat_id', 
                            price = '$price', rating = '$rating', description = '$description', image = '$image'
                        WHERE book_id = '$book_id'";
        if (mysqli_query($con, $updateQuery)) {
            echo "Updated successfully!";
            header("Location: showBooks.php");
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
</head>
<body>
    <h2>Edit Book</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" value="<?= $book['title'] ?>" required><br><br>
        <label>Author:</label>
        <input type="text" name="author_id" value="<?= $book['author_id'] ?>" required><br><br>
        <label>Category:</label>
        <input type="text" name="cat_id" value="<?= $book['cat_id'] ?>" required><br><br>
        <label>Price:</label>
        <input type="number" name="price" value="<?= $book['price'] ?>" required><br><br>
        <label>Rating:</label>
        <input type="number" step="0.1" name="rating" value="<?= $book['rating'] ?>" required><br><br>
        <label>Description:</label>
        <textarea name="description" required><?= $book['description'] ?></textarea><br><br>
        <label>Image:</label>
        <input type="file" name="image"><br><br>
        <img src="<?= $book['image'] ?>" width="100"><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
