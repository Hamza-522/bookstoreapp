<?php
header("Content-Type: application/json");
include("config.php");

// Initialize the response
$response = [
    'success' => false,
    'message' => '',
    'favorites' => []
];

// Get the user ID from the request
$userId = $_POST['userId'] ?? null; // Changed to POST for consistency with your app

if (!$userId) {
    $response['message'] = "User ID is required.";
    echo json_encode($response);
    exit();
}

$sql = "SELECT 
    books.book_id, 
    books.title, 
    books.image, 
    books.price, 
    books.rating, 
    books.description, 
    authors.ath_name AS authorName, 
    categories.cname AS categoryName 
FROM 
    favorites 
INNER JOIN books ON favorites.book_id = books.book_id 
INNER JOIN authors ON books.author_id = authors.author_id 
INNER JOIN categories ON books.cat_id = categories.cid 
WHERE 
    favorites.user_id = ?;
";


// Prepare and execute the statement
$stmt = $con->prepare($sql);
if (!$stmt) {
    $response['message'] = "Database query preparation failed.";
    echo json_encode($response);
    exit();
}

$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Check if the query returns results
if ($result->num_rows > 0) {
    $books = [];
    while ($row = $result->fetch_assoc()) {
        $books[] = [
            'book_id' => $row['book_id'],
            'title' => $row['title'],
            'image' => "http://192.168.100.19:80/bookstore/" . $row['image'], // Add base URL for image
            'price' => $row['price'],
            'rating' => $row['rating'],
            'description' => $row['description'],
            'authorName' => $row['authorName'], // This is from the ath_name column
            'categoryName' => $row['categoryName'] // This is from the cname column
        ];
    }
    $response['success'] = true;
    $response['favorites'] = $books;
} else {
    $response['message'] = "No favorite books found for the user.";
}

// Close the statement and connection
$stmt->close();
$con->close();

// Return the response as JSON
echo json_encode($response);
?>
