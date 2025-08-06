<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];

    $query = "DELETE FROM books WHERE book_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "Book deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete book."]);
    }

    $stmt->close();
}

mysqli_close($con);
?>
