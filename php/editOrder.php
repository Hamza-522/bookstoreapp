<?php
include('config.php');

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $query = "SELECT * FROM orders WHERE order_id = '$order_id'";
    $result = mysqli_query($con, $query);
    $order = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $total_price = mysqli_real_escape_string($con, $_POST['total_price']);
        $updateQuery = "UPDATE orders SET total_price = '$total_price' WHERE order_id = '$order_id'";
        if (mysqli_query($con, $updateQuery)) {
            echo "Order updated successfully!";
            header("Location: showOrders.php");
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Order</title>
</head>
<body>
    <h2>Edit Order</h2>
    <form method="POST">
        <label>Total Price:</label>
        <input type="number" name="total_price" value="<?= $order['total_price'] ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
