<?php
// Include the database connection configuration file
include('config.php');  // Make sure the config.php file is in the same directory

// Get POST data from the Flutter app
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$feedback_text = isset($_POST['feedback_text']) ? $_POST['feedback_text'] : '';
$suggestions_text = isset($_POST['suggestions_text']) ? $_POST['suggestions_text'] : '';

// Validate required fields
if (empty($user_id) || empty($feedback_text)) {
    echo json_encode(['success' => false, 'message' => 'User ID and feedback text are required.']);
    exit;
}

// Fetch user details (fname and useremail) from the users table
$query = "SELECT fname, email FROM users WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($user_name, $user_email);
$stmt->fetch();
$stmt->close();

// Check if user exists
if (!$user_name) {
    echo json_encode(['success' => false, 'message' => 'User not found.']);
    exit;
}

// Insert data into the feedback table
$stmt = $con->prepare("INSERT INTO feedback (user_id, feedback_text, suggestions_text) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $user_id, $feedback_text, $suggestions_text);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Feedback submitted successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to submit feedback.']);
}

$stmt->close();
$con->close();
?>
