<?php
include('config.php');

if (isset($_GET['cid'])) {
    $category_id = $_GET['cid'];
    $query = "SELECT * FROM categories WHERE cid = '$category_id'";
    $result = mysqli_query($con, $query);
    $category = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cname = mysqli_real_escape_string($con, $_POST['cname']);
        $updateQuery = "UPDATE categories SET cname = '$cname' WHERE cid = '$category_id'";
        if (mysqli_query($con, $updateQuery)) {
            echo "Updated successfully!";
            header("Location: showCategories.php");
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
</head>
<body>
    <h2>Edit Category</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="cname" value="<?= $category['cname'] ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
