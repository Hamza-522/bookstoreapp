<?php
include('config.php');

// Get the user_id from the request
$user_id = $_POST['user_id'];

// Start a transaction
mysqli_begin_transaction($con);

try {
    // Step 1: Calculate the total price of the cart items
    $query = "SELECT SUM(books.price * cart.quantity) AS total_price
              FROM cart
              INNER JOIN books ON cart.book_id = books.book_id
              WHERE cart.user_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);  // Bind user_id as integer
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $total_price);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // If no total_price was found, we have an issue
    if ($total_price === NULL) {
        throw new Exception('Error calculating total price.');
    }

    // Step 2: Insert the order into the orders table
    $orderQuery = "INSERT INTO orders (user_id, total_price) VALUES (?, ?)";
    $stmt = mysqli_prepare($con, $orderQuery);
    mysqli_stmt_bind_param($stmt, 'id', $user_id, $total_price);  // Bind user_id as integer, total_price as decimal
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception('Error inserting order into orders table.');
    }

    // Get the order_id
    $order_id = mysqli_insert_id($con);
    mysqli_stmt_close($stmt);

    // Step 3: Insert order details for each book in the order
    $cartQuery = "SELECT cart.book_id, cart.quantity, books.price
                  FROM cart
                  INNER JOIN books ON cart.book_id = books.book_id
                  WHERE cart.user_id = ?";
    $stmt = mysqli_prepare($con, $cartQuery);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);  // Bind user_id as integer
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $book_id, $quantity, $price);

    while (mysqli_stmt_fetch($stmt)) {
        $orderDetailQuery = "INSERT INTO order_details (order_id, book_id, quantity, price)
                             VALUES (?, ?, ?, ?)";
        $orderStmt = mysqli_prepare($con, $orderDetailQuery);
        mysqli_stmt_bind_param($orderStmt, 'iiid', $order_id, $book_id, $quantity, $price);  // Bind values
        if (!mysqli_stmt_execute($orderStmt)) {
            throw new Exception('Error inserting order details.');
        }
        mysqli_stmt_close($orderStmt);
    }

    // Step 4: Clear the cart after order placement
    $clearCartQuery = "DELETE FROM cart WHERE user_id = ?";
    $stmt = mysqli_prepare($con, $clearCartQuery);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);  // Bind user_id as integer
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception('Error clearing cart.');
    }
    mysqli_stmt_close($stmt);

    // Commit the transaction
    mysqli_commit($con);

    echo "Order placed successfully!";
} catch (Exception $e) {
   
    echo "Error: " . $e->getMessage();
}
?>
