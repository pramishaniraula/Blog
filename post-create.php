<?php
    session_start();
    require 'connection.php';
    if (!isset($_SESSION['isLogin'])==true) {
        header("Location: login.php");
        exit;
    }

    if(isset($_POST['save'])){
        $title  = $_POST['title'];
        $slug  = $_POST['slug'];
        $image = $_FILES['image'];
        $content = $_POST['content'];
        $status = 0;
        $created_at =date('Y-m-d H:i:s',time());
        $userId=$_SESSION['userId'];

        if(empty($title) || empty($slug) || $_FILES['image']['error'] == 4){
            $message = "All Fields Required";
            $messageType = 'danger';
        }else{
            // Image upload handling
            $imageName = time() . "_" . basename($_FILES['image']['name']);
            $target_dir = "uploads/post/";
            $target_file = $target_dir . $imageName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $sql = "INSERT INTO posts (title, slug, image, content, status, created_at, user_id)
                        VALUES ('$title', '$slug', '$imageName','$content','$status','$created_at','$userId')";
            } else {
                $message = "Image upload failed";
                $messageType = "error";
            }

            if ($conn->query($sql) === TRUE) {
                $message = "Post Created Successfully.";
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
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const titleInput = document.querySelector("input[name='title']");
        const slugInput = document.querySelector("input[name='slug']");

        titleInput.addEventListener("keyup", function() {
            let slug = titleInput.value
                .toLowerCase()                // lowercase
                .trim()                       // remove spaces at ends
                .replace(/[^a-z0-9\s-]/g, '') // remove special chars
                .replace(/\s+/g, '-')         // spaces → dashes
                .replace(/-+/g, '-');         // collapse multiple dashes

            slugInput.value = slug;
        });
    });

    </script>

<body>

<?php  include 'include/navbar.php'; ?>

<div class="container my-5">
    <div class="row">
        <?php  include 'include/sidebar.php'; ?>
        <div class="col-lg-9">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3>Create Post</h3>
                <a href="post-list.php" class="btn btn-primary">All Post</a>
            </div>
            <?php if (!empty($message)) { ?>
                <div class="alert alert-<?= $messageType ?>">
                    <?= $message ?>
                </div>
            <?php } ?>
            <div class="card">
                <div class="card-body">
                    <form action="post-create.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Post Title">
                        </div>
                        <div class="mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" placeholder="Post Slug" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" placeholder="Post Image">
                        </div>
                        <div class="mb-3">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea>
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