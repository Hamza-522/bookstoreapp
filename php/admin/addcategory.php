<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get category name from POST request
    $cname = mysqli_real_escape_string($con, $_POST['cname']);

    // Check if category name is provided
    if (empty($cname)) {
        echo "Category name is required.";
        exit;
    }

    // Insert category into the database
    $query = "INSERT INTO categories (cname) VALUES ('$cname')";
    if (mysqli_query($con, $query)) {
        echo "Category added successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
