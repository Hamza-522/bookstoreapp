<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    $query = "UPDATE users SET fname = ?, email = ?, address = ?, password = ? WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssssi", $fname, $email, $address, $password, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "User updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update user."]);
    }

    $stmt->close();
}

mysqli_close($con);
?>
