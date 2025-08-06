<?php
// getCart.php
require_once 'config.php'; // Database connection

header('Content-Type: application/json');

// Get the user ID from request (replace with actual user ID logic)
$user_id = $_GET['user_id']; 

$sql = "SELECT c.cart_id, c.user_id, c.book_id, c.quantity, b.title, b.price, b.image
        FROM cart c 
        JOIN books b ON c.book_id = b.book_id
        WHERE c.user_id = ?";
        
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $cartItems = [];
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }
    echo json_encode($cartItems);
} else {
    echo json_encode([]);
}

$stmt->close();
$con->close();
?>
