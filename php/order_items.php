<?php
include 'config.php';

if (isset($_POST['order_id'], $_POST['book_id'], $_POST['quantity'], $_POST['price'])) {

   
    $order_id = $_POST['order_id'];
    $book_id = $_POST['book_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];


    if (!is_numeric($order_id) || !is_numeric($book_id) || !is_numeric($quantity) || !is_numeric($price)) {
        echo json_encode(['status' => 'failure', 'message' => 'Invalid input data']);
        exit;
    }


    $sql = "INSERT INTO order_items (order_id, book_id, quantity, price) VALUES (?, ?, ?, ?)";

  
    if ($stmt = $con->prepare($sql)) {
        

        $stmt->bind_param("iiii", $order_id, $book_id, $quantity, $price);


        if ($stmt->execute()) {

            echo json_encode(['status' => 'success', 'message' => 'Order item added successfully']);
        } else {
            echo json_encode(['status' => 'failure', 'message' => 'Failed to add order item']);
        }
        // Close the statement
        $stmt->close();
    } else {

        echo json_encode(['status' => 'failure', 'message' => 'Failed to prepare statement']);
    }

} else {

    echo json_encode(['status' => 'failure', 'message' => 'Missing required parameters']);
}


$con->close();
?>
