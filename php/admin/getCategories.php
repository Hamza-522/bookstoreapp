<?php
include('config.php');

$query = "SELECT `cid`, `cname` FROM `categories`"; 
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

$categories = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}

echo json_encode($categories);

mysqli_close($con);
?>
