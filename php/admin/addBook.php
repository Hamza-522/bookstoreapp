<?php
include('config.php');

// Check if the form is submitted via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $author_id = mysqli_real_escape_string($con, $_POST['author_id']);
    $cat_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $rating = mysqli_real_escape_string($con, $_POST['average_rating']);
    $image = '';  // Default value if no image is uploaded

    // Check if an image file is provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $uploadDir = 'uploads/books/';  // Directory where the image will be saved

        // Allowed file extensions
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate file type and size
        if (!in_array($fileExtension, $allowedExtensions)) {
            die("Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.");
        }
        if ($fileSize > 2 * 1024 * 1024) {  // Limit to 2MB
            die("File size exceeds the limit of 2MB.");
        }

        // Ensure the upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);  // Create the directory if it doesn't exist
        }

        // Generate a unique file name to avoid overwriting
        $uniqueFileName = uniqid('book_', true) . '.' . $fileExtension;
        $destPath = $uploadDir . $uniqueFileName;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $image = $destPath;  // Store the path of the uploaded image
        } else {
            die("Error uploading file.");
        }
    }

    // Prepare the SQL query to insert book data into the database
    $query = "INSERT INTO `books` (`title`, `author_id`, `cat_id`, `description`, `image`, `price`, `rating`) 
              VALUES ('$title', '$author_id', '$cat_id', '$description', '$image', '$price', '$rating')";

    // Execute the query and handle errors
    if (mysqli_query($con, $query)) {
        echo "Book added successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Invalid request method.";
}
?>
