<?php

include("config.php");

// Update order status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET status = '$status' WHERE order_id = '$order_id'";

    if ($con->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Order status updated"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $con->error]);
    }
}

$con->close();
?>
