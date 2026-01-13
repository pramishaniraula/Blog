<?php
require 'connection.php';
$commentId = $_GET['id'];

$selectQuery = "SELECT id FROM comments WHERE id='$commentId'";
$result = mysqli_query($conn, $selectQuery);
if (mysqli_num_rows($result)>0) {
    $deleteQuery = "DELETE FROM comments WHERE id = '$commentId'";
    if (mysqli_query($conn, $deleteQuery) === TRUE) {
        echo "Post Deleted Successfully.";
        header("Location: blog.php");
    }
}else{
    echo "Comment not found.";
}



?>