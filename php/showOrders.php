<?php
include('config.php');

$query = "SELECT orders.*, users.username 
          FROM orders
          INNER JOIN users ON orders.user_id = users.user_id";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Show Orders</title>
</head>
<body>
    <h2>Orders</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User Name</th>
                <th>Total Price</th>
                <th>Order Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['order_id'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['total_price'] ?></td>
                <td><?= $row['order_date'] ?></td>
                <td>
                    <a href="editOrder.php?order_id=<?= $row['order_id'] ?>">Edit</a>
                    <a href="deleteOrder.php?order_id=<?= $row['order_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
