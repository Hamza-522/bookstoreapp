<?php
include("config.php");

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $pnumber = $_POST['pnumber'];
    $password = $_POST['password'];
    $address = $_POST['address'];  // Capture the address field

    // Check if email is already in use
    $checkEmailQuery = "SELECT id FROM users WHERE email = '$email'";
    $checkEmailResult = mysqli_query($con, $checkEmailQuery);

    $arr = [];

    if (mysqli_num_rows($checkEmailResult) > 0) {
        $arr["done"] = "false";
        $arr["error"] = "Email already in use. Please use another email.";
    } else {
        // Insert data including the address field
        $query = "INSERT INTO `users`(`fname`, `email`, `pnumber`, `password`, `address`) 
                  VALUES ('$fname','$email','$pnumber','$password','$address')";

        $result = mysqli_query($con, $query);

        if ($result) {
            $arr["done"] = "true";
        } else {
            $arr["done"] = "false";
            $arr["error"] = "Registration failed. Please try again.";
        }
    }

    echo json_encode($arr);
}

?>
