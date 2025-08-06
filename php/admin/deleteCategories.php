<?php
include('config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = (int)$_POST['category_id'];
    $query = "DELETE FROM categories WHERE cid = '$category_id'";
    if (mysqli_query($con, $query)) {
        echo "Category deleted successfully!";
    } else {
        echo "Error deleting category.";
    }
}
?>
