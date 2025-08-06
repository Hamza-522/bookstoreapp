<?php
include('config.php');
$query = "SELECT * FROM users";
$result = mysqli_query($con, $query);
$users = [];

while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

echo json_encode($users);

mysqli_close($con);
?>
