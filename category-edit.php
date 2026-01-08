<?php
session_start();
require 'connection.php';
if (!isset($_SESSION['isLogin']) == true) {
    header("Location: login.php");
    exit;
}
$catId = $_GET['id'];
$selectQuery = "SELECT * FROM categories WHERE id = '$catId'";
$result = mysqli_query($conn, $selectQuery);

$category = mysqli_fetch_assoc($result);


if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    if (empty($name) && empty($slug)) {
        $message = "Please enter name and slug";
        $messageType = 'danger';
    } else {
        $sql = "UPDATE categories SET name = '$name', slug='$slug' WHERE id = '$cat_Id";
        if ($conn->query($sql) == TRUE) {
            $message = "Category created Sucessfully";
            $messageType = 'success';
        } else {
            echo "error: .$conn->error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Create</title>
</head>

<body>
    <?php
    include 'include/navbar.php'
    ?>
    <div class="container my-5">
        <div class="row">
            <?php include 'include/sidebar.php'; ?>
            <div class="col-lg-9">
                <?php if (!empty($message)) { ?>
                    <div class="alert alert-<?= $messageType ?>">
                        <?= $message ?>
                    </div>
                <?php } ?>
                <div class="card">
                    <div class="card-body">
                        <form action="category-edit.php?id=<?$catid?>" method="POST">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Category Name" value="<?= $category['name'] ?>">
                            </div>

                            <div class="mb-3">
                                <label for="name">Slug</label>
                                <input type="text" class="form-control" name="slug" placeholder="Category slug">
                            </div>

                            <div class="mb-3">
                                <label for="name">Image</label>
                                <input type="file" class="form-control" name="image" placeholder="Catefory Image">
                            </div>
                            <input type="submit" value="update" class="btn btn-primary" name="update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>