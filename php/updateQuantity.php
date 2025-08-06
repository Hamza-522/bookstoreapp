<?php
// Include the database connection file
include 'config.php';

// Set the response header to return JSON
header('Content-Type: application/json');

// Check if the required parameters are sent via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the JSON body from the request
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['cart_id']) && isset($data['quantity'])) {
        $cart_id = $data['cart_id'];
        $quantity = $data['quantity'];

        // Validate quantity to ensure it's greater than 0
        if ($quantity < 1) {
            echo json_encode([
                "status" => "error",
                "message" => "Quantity must be at least 1."
            ]);
            exit();
        }

        // Prepare the SQL query to update the quantity
        $sql = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
        $stmt = $con->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ii", $quantity, $cart_id); // Bind parameters
            if ($stmt->execute()) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Quantity updated successfully."
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Failed to update quantity."
                ]);
            }
            $stmt->close(); // Close the statement
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Failed to prepare the statement."
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid input. 'cart_id' and 'quantity' are required."
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method. Use POST."
    ]);
}

// Close the database connection
$con->close();
?>
