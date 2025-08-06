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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Author</title>
</head>
<body>
    <h2>Edit Author</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="ath_name">Author Name:</label>
        <input type="text" name="ath_name" id="ath_name" value="<?= $author['ath_name'] ?>" required><br><br>

        <label for="ath_image">Author Image:</label>
        <input type="file" name="ath_image" id="ath_image" accept="image/*"><br><br>
        <img src="<?= $author['ath_image'] ?>" alt="Image" width="100"><br><br>

        <input type="submit" value="Update Author">
    </form>
</body>
</html>
