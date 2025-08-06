<?php
include('config.php');

$user_id = $_POST['user_id'];
$book_id = $_POST['book_id'];
$quantity = $_POST['quantity'];

// Update the quantity of the book in the cart
$updateQuery = "UPDATE cart SET quantity = $quantity WHERE user_id = '$user_id' AND book_id = '$book_id'";
if (mysqli_query($con, $updateQuery)) {
    echo "Cart updated!";
} else {
    echo "Failed to update cart.";
}
?>
