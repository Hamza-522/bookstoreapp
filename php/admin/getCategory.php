<?php
include('config.php');
if (isset($_GET['cid'])) {
    $category_id = (int)$_GET['cid'];
    $query = "SELECT * FROM categories WHERE cid = '$category_id'";
    $result = mysqli_query($con, $query);
    echo json_encode(mysqli_fetch_assoc($result));
} else {
    echo json_encode(["error" => "Invalid category ID"]);
}
?>
