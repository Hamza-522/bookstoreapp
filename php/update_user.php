<?php
include('config.php');

$userId = $_POST['userId'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$image = $_FILES['image']; 
$address = $_POST['address'];


$imagePath = 'uploads/Profiles/' . basename($image['name']);
move_uploaded_file($image['tmp_name'], $imagePath);


$query = "UPDATE users SET fname = ?, email = ?, pnumber = ?, password = ?, image = ?, address = ? WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("ssssssi", $name, $email, $phone, $password, $imagePath, $address, $userId);
$response = [];

if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = 'Profile updated successfully';
} else {
    $response['success'] = false;
    $response['message'] = 'Update failed';
}

echo json_encode($response);
$stmt->close();
$con->close();
?>
