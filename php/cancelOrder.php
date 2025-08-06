<?php
// cancelOrder.php
require_once 'config.php'; // Database connection

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

// Debugging: log the received data
error_log("Received data: " . print_r($data, true));

$order_id = $data['order_id'];
$user_id = $data['user_id'];

// Check if both order_id and user_id are provided
if (!$order_id || !$user_id) {
    echo json_encode(['status' => 'failure', 'message' => 'Invalid order ID or user ID']);
    exit;
}

// Prepare the SQL statement to delete the order
$sql = "DELETE FROM orders WHERE order_id = ? AND user_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $order_id, $user_id);
$stmt->execute();

// Check if any rows were affected
if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success', 'message' => 'Order cancelled successfully']);
} else {
    // If no rows were affected, check if the order exists
    $checkQuery = "SELECT * FROM orders WHERE order_id = ? AND user_id = ?";
    $checkStmt = $con->prepare($checkQuery);
    $checkStmt->bind_param("ii", $order_id, $user_id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Order exists but couldn't be cancelled (possibly due to status restrictions)
        echo json_encode(['status' => 'failure', 'message' => 'The order cannot be cancelled (status might be final or order already processed)']);
    } else {
        // No such order found
        echo json_encode(['status' => 'failure', 'message' => 'No such order found for the given user']);
    }

    $checkStmt->close();
}

// Clean up
$stmt->close();
$con->close();
?>
