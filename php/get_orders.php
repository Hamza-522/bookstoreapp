<?php
include('config.php');  // Make sure this file contains your database connection details

header('Content-Type: application/json');

// Get userId from POST request
$userId = isset($_POST['userId']) ? $_POST['userId'] : null;

// Validate input
if (!isset($userId) || !is_numeric($userId)) {
    echo json_encode(['success' => false, 'message' => 'Invalid user ID.']);
    exit;
}

$query = "
    SELECT 
        orders.order_id AS order_id, 
        orders.total_amount, 
        orders.order_date, 
        orders.status, 
        books.title, 
        books.price, 
        books.image 
    FROM 
        orders 
    JOIN 
        order_items 
        ON orders.order_id = order_items.order_id 
    JOIN 
        books 
        ON order_items.book_id = books.book_id 
    WHERE 
        orders.user_id = ? 
    ORDER BY 
        orders.order_date DESC 
    LIMIT 0, 25
";

// Prepare the SQL statement
$stmt = $con->prepare($query);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Query preparation failed: ' . $con->error]);
    exit;
}

// Bind the userId parameter to the prepared statement
$stmt->bind_param("i", $userId);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Initialize an array to hold the orders
$orders = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = [
            'order_id' => $row['order_id'],
            'total_amount' => $row['total_amount'],
            'order_date' => $row['order_date'],
            'status' => $row['status'],
            'items' => [
                [
                    'title' => $row['title'],
                    'price' => $row['price'],
                    'image' => $row['image']
                ]
            ]
        ];
    }

    // Return the orders in JSON format
    echo json_encode(['success' => true, 'orders' => $orders]);
} else {
    echo json_encode(['success' => false, 'message' => 'No orders found for this user.']);
}

// Clean up
$stmt->close();
$con->close();
?>
