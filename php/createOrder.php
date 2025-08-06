<?php
include 'config.php';


$data = json_decode(file_get_contents('php://input'), true);

$user_id = $data['user_id'];
$total_amount = $data['total_amount'];
$shipping_fee = $data['shipping_fee'];
$cart_items = $data['cart_items'];


$order_sql = "INSERT INTO orders (user_id, total_amount, shipping_fee) VALUES (?, ?, ?)";
$stmt = $con->prepare($order_sql);
$stmt->bind_param("idd", $user_id, $total_amount, $shipping_fee);
$stmt->execute();

$order_id = $stmt->insert_id; 

foreach ($cart_items as $item) {
    $book_id = $item['book_id'];
    $quantity = $item['quantity'];
    $price = $item['price'];

    $order_item_sql = "INSERT INTO order_items (order_id, book_id, quantity, price) VALUES (?, ?, ?, ?)";
    $order_stmt = $con->prepare($order_item_sql);
    $order_stmt->bind_param("iiid", $order_id, $book_id, $quantity, $price);
    $order_stmt->execute();
}

echo json_encode(['status' => 'success']);

$stmt->close();
$order_stmt->close();
$con->close();


?>
