<?php
    session_start();
    if (!isset($_SESSION['isLogin'])==true) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php  include 'include/navbar.php';   ?>
<div class="container my-5">
    <div class="row">
        <?php  include 'include/sidebar.php';   ?>
        <div class="col-lg-9">
            <div class="d-flex">
                <div class="alert alert-primary">
                    <p>Hello! <?= $_SESSION['name'] ?> </p>
                    <h5>Welcome to Dashboard</h5>
                </div>
                </div>
                <div class="d-flex gap-3">
                    <a href="category-create.php" class="btn btn-primary">Create Category</a>
                    <a href="category-create.php" class="btn btn-primary">Manage Post</a>
                    <a href="category-create.php" class="btn btn-primary">Create Category</a>
                    <a href="category-create.php" class="btn btn-primary">Create Category</a>
                </div>
            
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>