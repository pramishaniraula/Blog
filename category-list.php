<?php
    session_start();
    require 'connection.php';
    if (!isset($_SESSION['isLogin'])==true) {
        header("Location: login.php");
        exit;
    }

    $sql = "SELECT * FROM categories ORDER BY id DESC";
    $results = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php  include 'include/navbar.php';   ?>

<div class="container my-5">
    <div class="row">
        <?php  include 'include/sidebar.php';   ?>
        <div class="col-lg-9">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3>Category List</h3>
                <a href="category-create.php" class="btn btn-primary">Create Category</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     if(mysqli_num_rows($results)>0) {
                    $i = 1; 
                     while ($category = mysqli_fetch_assoc($results)) {
                       
                    ?>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td>
                            <img width="100" src="uploads/category/<?= $category['image'] ?>" alt="">
                        </td>
                        <td><?= $category['name'] ?></td>
                        <td><?= $category['slug'] ?></td>
                        <td>
                            <a href="category-edit.php?id=<?=$category['id']?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="category-delete.php?id=<?=$category['id']?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    <?php } } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>