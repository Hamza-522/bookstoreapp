<?php
header("Content-Type: application/json");
include("config.php");

$response = ['success' => false, 'message' => ''];

$userId = $_POST['userId'] ?? null;
$bookId = $_POST['bookId'] ?? null;

if (!$userId || !$bookId) {
    $response['message'] = "User ID and Book ID are required.";
    echo json_encode($response);
    exit();
}

// Query to remove the book from the favorites table
$sql = "DELETE FROM favorites WHERE user_id = ? AND book_id = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    $response['message'] = "Database query preparation failed.";
    echo json_encode($response);
    exit();
}

$stmt->bind_param("ii", $userId, $bookId);
if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = "Book removed from favorites.";
} else {
    $response['message'] = "Failed to remove book from favorites.";
}

$stmt->close();
$con->close();

echo json_encode($response);
?>
