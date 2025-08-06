<?php
include 'config.php';
if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    $query = "DELETE FROM `users` WHERE `id` = '$user_id'";
    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "User deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete user: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid user ID"]);
}
mysqli_close($conn);
?>