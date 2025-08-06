<?php

include("config.php");
// Fetch orders
$sql = "SELECT order_id, user_id, total_amount, shipping_fee, order_date, status FROM orders";
$result = $con->query($sql);

$orders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = [
            'order_id' => (int) $row['order_id'],
            'user_id' => (int) $row['user_id'],
            'total_amount' => (float) $row['total_amount'],
            'shipping_fee' => (float) $row['shipping_fee'],
            'order_date' => $row['order_date'], // Keep as string
            'status' => $row['status'],        // Keep as string
        ];
    }
            
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($orders);

$con->close();
?>
