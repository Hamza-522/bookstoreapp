<?php
include('config.php');

// Validate userId exists in POST data
if (!isset($_POST['userId']) || empty($_POST['userId'])) {
    echo json_encode([
        'success' => false,
        'message' => 'User ID not provided',
    ]);
    exit;
}

$userId = intval($_POST['userId']); 

// Query to fetch user details including image
$query = "SELECT fname, email, pnumber, password, image FROM users WHERE id = ?";
$stmt = $con->prepare($query);

if ($stmt === false) {
    echo json_encode([
        'success' => false,
        'message' => 'Prepare statement failed: ' . $con->error,
    ]);
    exit;
}

$stmt->bind_param("i", $userId); // "i" means integer
$stmt->execute();
$result = $stmt->get_result();

$response = [];

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $response['success'] = true;
    $response['user'] = [
        'fname' => $user['fname'] ?? '',
        'email' => $user['email'] ?? '',
        'pnumber' => (string) $user['pnumber'],
        'password' => $user['password'] ?? '',
        'image' => !empty($user['image']) ? $user['image'] : 'uploads/Profiles/default.png', // Return user image or default
    ];
} else {
    $response['success'] = false;
    $response['message'] = 'User not found';
}

echo json_encode($response);

$stmt->close();
$con->close();
?>
