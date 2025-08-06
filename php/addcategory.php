<?php
include('config.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cname = mysqli_real_escape_string($con, $_POST['cname']);
    
    $query = "INSERT INTO `categories` (`cname`) VALUES ('$cname')";

    if (mysqli_query($con, $query)) {
        echo "Category added successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
</head>
<body>

<h2>Add New Category</h2>

<!-- Form to add a new category -->
<form action="addcategory.php" method="POST">
    <label for="cname">Category Name:</label>
    <input type="text" name="cname" id="cname" required><br><br>
    <input type="submit" value="Add Category">
</form>

</body>
</html>
