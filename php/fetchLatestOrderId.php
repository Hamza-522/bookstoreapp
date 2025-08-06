<?php 
include('config.php');

$userId = $_POST['userId'];

// Fetch the most recent order ID for the user
$query = "SELECT id FROM orders WHERE user_id = ? ORDER BY order_date DESC LIMIT 1";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$response = [];
if ($result->num_rows > 0) {
    $latestOrder = $result->fetch_assoc();
    $response['success'] = true;
    $response['latestOrderId'] = $latestOrder['id'];
} else {
    $response['success'] = false;
    $response['message'] = "No orders found for this user.";
}

echo json_encode($response);
$stmt->close();
$con->close();

?>