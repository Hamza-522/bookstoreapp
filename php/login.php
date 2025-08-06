<?php
include('config.php');

if (!$con) {
    die(json_encode(["done" => "false", "error" => "Database connection failed"]));
}

$email = mysqli_real_escape_string($con, $_POST['email']);
$password = mysqli_real_escape_string($con, $_POST['password']);

$query = "SELECT id, password FROM users WHERE email = '$email'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    if ($password === $user['password']) { 
        // Return userId on successful login
        echo json_encode([
            "done" => "true",
            "userId" => $user['id']
        ]);
    } else {
        echo json_encode(["done" => "false", "error" => "Invalid password"]);
    }
} else {
    echo json_encode(["done" => "false", "error" => "User not found"]);
}

mysqli_close($con);
?>
