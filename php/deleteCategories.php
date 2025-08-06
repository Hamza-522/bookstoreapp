<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = $_POST['category_id'];

    // Delete the category from the database
    $query = "DELETE FROM categories WHERE category_id = '$category_id'";
    if (mysqli_query($con, $query)) {
        echo "Category deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

?>


