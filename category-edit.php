<?php
    session_start();
    require 'connection.php';
    if (!isset($_SESSION['isLogin'])==true) {
        header("Location: login.php");
        exit;
    }

    $catId = $_GET['id'];
    $selectQuery = "SELECT * FROM categories WHERE id='$catId'";
    $result = mysqli_query($conn, $selectQuery);
    
    $category = mysqli_fetch_assoc($result);
    

    if(isset($_POST['save'])){
        $name  = $_POST['name'];
        $slug  = $_POST['slug'];

        if(empty($name) || empty($slug)){
            $message = "Please enter name and slug";
            $messageType = 'error';
        }else{
            $updateFields = "name='$name', slug='$slug'";
            if(isset($_FILES['image']) && $_FILES['image']['error'] != 4){
                // Delete old image if exists
                if (!empty($category['image'])) {
                    $oldImagePath = "uploads/category/" . $category['image'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                // New image uploaded
                $imageName = time() . "_" . basename($_FILES['image']['name']);
                $target_dir = "uploads/category/";
                $target_file = $target_dir . $imageName;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    $updateFields .= ", image='$imageName'";
                } else {
                    $message = "Image upload failed";
                    $messageType = "error";
                    // Don't proceed with update if image upload fails
                    goto end;
                }
            }
            $sql = "UPDATE categories SET $updateFields WHERE id='$catId'";
            if ($conn->query($sql) === TRUE) {
                $message = "Category Updated Successfully.";
                $messageType = 'success';
                // Refresh the category data
                $result = mysqli_query($conn, $selectQuery);
                $category = mysqli_fetch_assoc($result);
            }else {
                echo "Error: ". $conn->error;
            }
            end:
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php  include 'include/navbar.php'; ?>

<div class="container my-5">
    <div class="row">
        <?php  include 'include/sidebar.php'; ?>
        <div class="col-lg-9">
            <?php if (!empty($message)) { ?>
                <div class="alert alert-<?= $messageType ?>">
                    <?= $message ?>
                </div>
            <?php } ?>
            <div class="card">
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" 
                            placeholder="Category Name" value="<?=$category['name']?>">
                        </div>
                        <div class="mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" placeholder="Category Slug" value="<?=$category['slug']?>">
                        </div>
                        <div class="mb-3">
                            <label for="image">Image</label>
                            <?php if(!empty($category['image'])): ?>
                                <br><img src="uploads/category/<?=$category['image']?>" width="100" alt="Current Image">
                            <?php endif; ?>
                            <input type="file" class="form-control" name="image" placeholder="Category Image">
                        </div>
                        <input type="submit" value="Save" class="btn btn-primary" name="save">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        <?php  include 'include/footer.php';   ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>