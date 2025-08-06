<?php
require_once 'config.php'; 

header('Content-Type: application/json');

// Allow CORS for testing and production (remove in production if unnecessary)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collecting the POST data
    $user_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : null;
    $book_id = isset($_POST['book_id']) ? trim($_POST['book_id']) : null;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1; // Default quantity is 1
    
    if (empty($user_id) || empty($book_id)) {
        echo json_encode([
            "success" => false,
            "message" => "User ID and Book ID are required."
        ]);
        exit();
    }

    // Prepare the SQL query to insert data into the cart
    $sql = "INSERT INTO cart (user_id, book_id, quantity, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute the query
        $stmt->bind_param("iii", $user_id, $book_id, $quantity);
        if ($stmt->execute()) {
            echo json_encode([
                "success" => true,
                "message" => "Book added to cart successfully!"
            ]);
        } else {
            echo json_encode([
                "success" => false,
                "message" => "Failed to add book to cart."
            ]);
        }
        $stmt->close();
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Database query preparation failed."
        ]);
    }

    // Close the database connection
    $con->close();
} else {
    // If the request method is not POST
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method."
    ]);
}
?>
