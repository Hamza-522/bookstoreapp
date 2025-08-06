<?php
// removeFromCart.php
require_once 'config.php'; // Database connection

// Get the cart ID from request
$cart_id = $_GET['cart_id'];

$sql = "DELETE FROM cart WHERE cart_id = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $cart_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'failure']);
}

$stmt->close();
$con->close();
?>
