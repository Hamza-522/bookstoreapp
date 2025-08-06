<?php
// Database connection
include("config.php");

// Get the order ID from the request
$order_id = $_POST['order_id'];

// Fetch the order status from the database
$query = "SELECT status FROM orders WHERE order_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$stmt->bind_result($status);
$stmt->fetch();

if ($status) {
    // Return the status as a JSON response
    echo json_encode(['status' => $status]);
} else {
    // Return an error message if the order is not found
    echo json_encode(['status' => '']);
}

$stmt->close();
$con->close();
?>
