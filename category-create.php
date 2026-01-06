<?php
    session_start();
    require 'connection.php';
    if (!isset($_SESSION['isLogin'])==true) {
        header("Location: login.php");
        exit;
    }

    if(isset($_POST['save'])){
        $name  = $_POST['name'];
        $slug  = $_POST['slug'];
        $image = $_FILES['image'];

        if(empty($name) || empty($slug) || $_FILES['image']['error'] == 4){
            $message = "All Fields Required";
            $messageType = 'danger';
        }else{
            // Image upload handling
            $imageName = time() . "_" . basename($_FILES['image']['name']);
            $target_dir = "uploads/category/";
            $target_file = $target_dir . $imageName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $sql = "INSERT INTO categories (name, slug, image)
                        VALUES ('$name', '$slug', '$imageName')";
            } else {
                $message = "Image upload failed";
                $messageType = "error";
            }

            if ($conn->query($sql) === TRUE) {
                $message = "Category Created Successfully.";
                $messageType = 'success';
            }else {
                echo "Error: ". $conn->error;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php  include 'include/navbar.php'; ?>

<div class="container my-5">
    <div class="row">
        <?php  include 'include/sidebar.php'; ?>
        <div class="col-lg-9">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3>Create Category</h3>
                <a href="category-list.php" class="btn btn-primary">All Category</a>
            </div>
            <?php if (!empty($message)) { ?>
                <div class="alert alert-<?= $messageType ?>">
                    <?= $message ?>
                </div>
            <?php } ?>
            <div class="card">
                <div class="card-body">
                    <form action="category-create.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Category Name">
                        </div>
                        <div class="mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" placeholder="Category Slug">
                        </div>
                        <div class="mb-3">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" placeholder="Category Image">
                        </div>
                        <input type="submit" value="Save" class="btn btn-primary" name="save">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>