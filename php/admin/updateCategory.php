<?php
include('config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_id = (int)$_POST['cid'];
    $cname = mysqli_real_escape_string($con, $_POST['cname']);
    $query = "UPDATE categories SET cname = '$cname' WHERE cid = '$category_id'";
    if (mysqli_query($con, $query)) {
        echo "Category updated successfully!";
    } else {
        echo "Error updating category.";
    }
}
?>
