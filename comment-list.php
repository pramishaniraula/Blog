<?php
    session_start();
    require 'connection.php';
    if (!isset($_SESSION['isLogin'])==true) {
        header("Location: login.php");
        exit;
    }

    $sql ="SELECT c.id, c.comment, c.created_at, c.user_id, u.fullname AS author
        FROM comments c
        JOIN users u ON c.user_id = u.user_id";
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
                <h3>Comment List</h3>
                <a href="comment-create.php" class="btn btn-primary">Create Comment</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Comment</th>
                        <th scope="col">CreatedAt</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     if(mysqli_num_rows($results)>0) {
                    $i = 1; 
                     while ($comment = mysqli_fetch_assoc($results)) {
                       
                    ?>
                    <tr>
                        <th scope="row"><?= $i++ ?></th>

                        <td><?= $comment['comment'] ?></td>
                        <td><?= $comment['created_at'] ?></td>
                        <td>
                            <a href="comment-delete.php?id=<?=$comment['id']?>" class="btn btn-danger btn-sm">Delete</a>
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