<?php
require 'connection.php';
$catId = $_GET['id'];

$selectQuery = "SELECT id,image FROM categories WHERE id='$catId'";
$result = mysqli_query($conn, $selectQuery);
if (mysqli_num_rows($result)>0) {
    $row = mysqli_fetch_assoc($result);
    $imageName = $row['image'];
    $imagePath = "uploads/category/" . $imageName;
    if (!empty($imageName) && file_exists($imagePath)) {
        unlink($imagePath);
    }
    $deleteQuery = "DELETE FROM categories WHERE id = '$catId'";
    if (mysqli_query($conn, $deleteQuery) === TRUE) {
        echo "Category Deleted Successfully.";
        header("Location: category-list.php");
    }
}else{
    echo "Category not found.";
}



?>