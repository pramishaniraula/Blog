<?php
    session_start();
    require 'connection.php';
    if (!isset($_SESSION['isLogin'])==true) {
        header("Location: login.php");
        exit;
    }

    $sql = "SELECT * FROM users";
    $results = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php  include 'include/navbar.php';   ?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-3">
            <ul class="list-group">
                <a href="dashboard.php" class="list-group-item list-group-item-action">
                    Dashboard
                </a>
                <a href="category-list.php" class="list-group-item list-group-item-action">
                    Categories
                </a>
                <a href="post-list.php" class="list-group-item list-group-item-action">
                    Posts
                </a>
                <a href="comment-list.php" class="list-group-item list-group-item-action">
                    Comments
                </a>
                <a href="user-list.php" class="list-group-item list-group-item-action active">
                    Users
                </a>
                <a href="logout.php" class="list-group-item list-group-item-action">
                    Logout
                </a>
            </ul>
        </div>
        <div class="col-lg-9">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     if(mysqli_num_rows($results)>0) {
                    $i = 1; 
                     while ($user = mysqli_fetch_assoc($results)) {
                       
                    ?>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= $user['fullname'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['status'] == 1 ? 'Active' : 'Inactive' ?></td>
                        <td><?= $user['phone'] ?></td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
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