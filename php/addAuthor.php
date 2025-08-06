<?php
include('config.php'); 


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ath_name = mysqli_real_escape_string($con, $_POST['ath_name']);
    

    if (isset($_FILES['ath_image']) && $_FILES['ath_image']['error'] == 0) {
        $fileTmpPath = $_FILES['ath_image']['tmp_name'];
        $fileName = $_FILES['ath_image']['name'];
        $fileSize = $_FILES['ath_image']['size'];
        $fileType = $_FILES['ath_image']['type'];
        $uploadDir = 'uploads/authors/'; 


        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($fileType, $allowedTypes)) {
 
            $maxFileSize = 5 * 1024 * 1024; 
            if ($fileSize <= $maxFileSize) {
       
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); 
                }

                $newFileName = time() . '_' . $fileName;
                $destPath = $uploadDir . $newFileName;


                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $ath_image = $destPath;
                } else {
                    $ath_image = ''; 
                    echo "Error uploading file!";
                }
            } else {
                echo "File is too large. Maximum allowed size is 5MB.";
            }
        } else {
            echo "Invalid file type. Only JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        $ath_image = ''; 
    }

    $query = "INSERT INTO `authors` (`ath_name`, `ath_image`) VALUES ('$ath_name', '$ath_image')";

    if (mysqli_query($con, $query)) {
        echo "Author added successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

