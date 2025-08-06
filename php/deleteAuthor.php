<?php
include('config.php');

    $author_id = $_GET['author_id'];

    $query = "DELETE FROM authors WHERE author_id = '$author_id'";
    $result = mysqli_query($con, $query);
    if($result){
        echo "Author deleted successfully!";
        header('location:showAuthors.php');
        
    
    }else{
        echo '<script>alert("Error")</script>';  
    
    };
?>
