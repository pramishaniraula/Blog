<?php
session_start();
require 'connection.php';
$commentId = $_GET['id'];

$selectQuery = "SELECT id,comment,user_id,created_at FROM comments WHERE id='$commentId'";
$result = mysqli_query($conn, $selectQuery);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if($_SESSION['userId']==$row['user_id']){
       header("Location: comment-list.php");
        exit;
    }
    $deleteQuery = "DELETE FROM comments WHERE id = '$commentId'";
    if (mysqli_query($conn, $deleteQuery) === TRUE) {
     header("Location: comment-list.php");
    }
} else {
    echo "comment not found.";
}

// Close DB connection
$conn->close();