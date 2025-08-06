<?php
include('config.php');

header('Content-Type: application/json');

// Initialize query to fetch feedback from the database
$query = "SELECT id, user_id, feedback_text, suggestions_text, created_at FROM feedback";

// Execute the query
$result = mysqli_query($con, $query);

// Prepare the response array
$feedbacks = [];
while ($row = mysqli_fetch_assoc($result)) {
    $feedbacks[] = [
        'id' => $row['id'],
        'user_id' => $row['user_id'],
        'feedback_text' => $row['feedback_text'],
        'suggestions_text' => $row['suggestions_text'],
        'created_at' => $row['created_at'],
    ];
}

// Return the feedbacks as JSON
echo json_encode($feedbacks);
?>
