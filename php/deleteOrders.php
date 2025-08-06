<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];

    // Delete the order from the database
    $query = "DELETE FROM orders WHERE order_id = '$order_id'";
    if (mysqli_query($con, $query)) {
        echo "Order deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Order</title>
</head>
<body>
    <h2>Delete Order</h2>
    <form method="POST" action="">
        <label for="order_id">Order ID:</label>
        <input type="text" name="order_id" id="order_id" required>
        <button type="submit">Delete Order</button>
    </form>
</body>
</html>
