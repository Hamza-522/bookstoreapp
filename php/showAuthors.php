<?php
include('config.php');

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$query = "SELECT * FROM authors";
$result = mysqli_query($con, $query);

$authors = array();
while ($row = mysqli_fetch_assoc($result)) {
    // Add the full URL to the image path
    $row['ath_image'] = "http://192.168.100.19/bookstore/admin/" . $row['ath_image'];
    $authors[] = $row;
}

echo json_encode($authors);
?>
