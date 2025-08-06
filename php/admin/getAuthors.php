<?php
include('config.php');

$query = "SELECT `author_id`, `ath_name`  FROM `authors`"; 
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

$authors = [];
while ($row = mysqli_fetch_assoc($result)) {
    $authors[] = $row;
}

echo json_encode($authors);

mysqli_close($con);
?>
