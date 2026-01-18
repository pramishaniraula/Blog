<?php
require 'connection.php';
$userId = $_GET['id'];

$selectQuery = "SELECT user_id FROM users WHERE user_id='$userId'";
$result = mysqli_query($conn, $selectQuery);
if (mysqli_num_rows($result) > 0) {
    $deleteQuery = "DELETE FROM users WHERE user_id = '$userId'";
    if (mysqli_query($conn, $deleteQuery) === TRUE) {
        echo "User Deleted Successfully.";
        header("Location: user-list.php");
    }
} else {
    echo "User not found.";
}

// Close DB connection
$conn->close();