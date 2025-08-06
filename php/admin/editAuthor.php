<?php
include('config.php');

if (isset($_GET['author_id'])) {
    $author_id = $_GET['author_id'];

    // Fetch the author's details
    $query = "SELECT * FROM authors WHERE author_id = '$author_id'";
    $result = mysqli_query($con, $query);
    $author = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ath_name = mysqli_real_escape_string($con, $_POST['ath_name']);
        
        // Handle file upload if a new image is provided
        if (!empty($_FILES['ath_image']['name'])) {
            $fileTmpPath = $_FILES['ath_image']['tmp_name'];
            $fileName = $_FILES['ath_image']['name'];
            $uploadDir = 'uploads/authors/';
            $destPath = $uploadDir . $fileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $ath_image = $destPath;
            } else {
                $ath_image = $author['ath_image']; // Keep old image if upload fails
            }
        } else {
            $ath_image = $author['ath_image']; // Keep old image if no new one is provided
        }

        // Update author details
        $updateQuery = "UPDATE authors SET ath_name = '$ath_name', ath_image = '$ath_image' WHERE author_id = '$author_id'";
        if (mysqli_query($con, $updateQuery)) {
            echo "Author updated successfully!";
            header("Location: showAuthors.php");
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

