<?php
include('config.php');

header('Content-Type: application/json');

// Get parameters
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
$author_id = isset($_GET['author_id']) ? $_GET['author_id'] : null;

// Initialize query
$query = "";

if ($category_id) {
    // Fetch books by category
    $query = "SELECT books.*, authors.ath_name, authors.ath_image, categories.cname 
              FROM books
              INNER JOIN authors ON books.author_id = authors.author_id
              INNER JOIN categories ON books.cat_id = categories.cid
              WHERE books.cat_id = $category_id";
} elseif ($author_id) {
    // Fetch books by author
    $query = "SELECT books.*, authors.ath_name, authors.ath_image, categories.cname 
              FROM books
              INNER JOIN authors ON books.author_id = authors.author_id
              INNER JOIN categories ON books.cat_id = categories.cid
              WHERE books.author_id = $author_id";
} else {
    // Fetch all books
    $query = "SELECT 
                books.book_id, 
                books.title, 
                books.image, 
                books.price, 
                authors.ath_name, 
                authors.ath_image, 
                categories.cname, 
                books.rating, 
                books.description 
              FROM books
              INNER JOIN authors ON books.author_id = authors.author_id
              INNER JOIN categories ON books.cat_id = categories.cid";
}

// Execute query
$result = mysqli_query($con, $query);

// Prepare response
$arr = [];
while ($row = mysqli_fetch_assoc($result)) {
    $arr[] = [
        'book_id' => $row['book_id'],
        'title' => $row['title'],
        'image' => 'http://192.168.100.19:80/' . $row['image'], // Ensure base URL is added
        'price' => $row['price'],
        'ath_name' => $row['ath_name'],
        'ath_image' => $row['ath_image'],
        'cname' => $row['cname'],
        'rating' => $row['rating'],
        'description' => $row['description'],
    ];
}

// Return JSON response
echo json_encode($arr);
?>
