<?php
include('config.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $author_id = mysqli_real_escape_string($con, $_POST['author_id']);
    $cat_id = mysqli_real_escape_string($con, $_POST['category_id']); 
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $rating = mysqli_real_escape_string($con, $_POST['average_rating']); 


    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $uploadDir = 'uploads/books/'; 

      
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); 
        }

        $destPath = $uploadDir . $fileName;


        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $image = $destPath;
        } else {
            echo "Error uploading file!";
        }
    } else {
        $image = ''; 
    }

 
    $query = "INSERT INTO `books` (`title`, `author_id`, `cat_id`, `description`, `image`, `price`, `rating`) 
              VALUES ('$title', '$author_id', '$cat_id', '$description', '$image', '$price', '$rating')";

    if (mysqli_query($con, $query)) {
        echo "Book added successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

