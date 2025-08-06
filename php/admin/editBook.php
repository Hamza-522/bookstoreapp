<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $cat_id = $_POST['cat_id'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];

    // Handle image upload if provided
    $image = $_POST['current_image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = 'uploads/books' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    $query = "UPDATE books SET title = ?, author_id = ?, cat_id = ?, description = ?, image = ?, price = ?, rating = ? WHERE book_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("siisssii", $title, $author_id, $cat_id, $description, $image, $price, $rating, $book_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "Book updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update book."]);
    }

    $stmt->close();
}

mysqli_close($con);
?>
