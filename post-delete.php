<?php
require 'connection.php';
$postId = $_GET['id'];

$selectQuery = "SELECT id,image FROM posts WHERE id='$postId'";
$result = mysqli_query($conn, $selectQuery);
if (mysqli_num_rows($result)>0) {
    $row = mysqli_fetch_assoc($result);
    $imageName = $row['image'];
    $imagePath = "uploads/post/" . $imageName;
    if (!empty($imageName) && file_exists($imagePath)) {
        unlink($imagePath);
    }
    $deleteQuery = "DELETE FROM posts WHERE id = '$postId'";
    if (mysqli_query($conn, $deleteQuery) === TRUE) {
        echo "Post Deleted Successfully.";
        header("Location: post-list.php");
    }
}else{
    echo "Post not found.";
}



?>