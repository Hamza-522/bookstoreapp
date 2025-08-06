<?php 
include('config.php');

$userId = $_POST['userId'];
$orderId = $_POST['orderId'];

$query = "SELECT o.id AS orderId, o.total_price, o.order_date, 
                 oi.book_id, b.title AS bookTitle, b.price
          FROM orders o
          JOIN order_items oi ON o.id = oi.order_id
          JOIN books b ON oi.book_id = b.id
          WHERE o.user_id = ? AND o.id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ii", $userId, $orderId);
$stmt->execute();
$result = $stmt->get_result();

$response = [];
if ($result->num_rows > 0) {
    $orderItems = [];
    while ($row = $result->fetch_assoc()) {
        $orderItems[] = $row;
    }
    $response['success'] = true;
    $response['orderItems'] = $orderItems;
} else {
    $response['success'] = false;
    $response['message'] = "No details found for this order.";
}

echo json_encode($response);
$stmt->close();
$con->close();

?>