<?php
header("Content-Type: application/json");
include("config.php");

$response = ['success' => false, 'message' => 'Invalid Request'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'] ?? null;
    $bookId = $_POST['bookId'] ?? null;

    if ($userId && $bookId) {
        $stmt = $con->prepare("INSERT INTO favorites (user_id, book_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $userId, $bookId);

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = "Book added to favorites.";
        } else {
            $response['message'] = "Failed to add to favorites.";
        }

        $stmt->close();
    } else {
        $response['message'] = "User ID and Book ID are required.";
    }
}

echo json_encode($response);
?>
