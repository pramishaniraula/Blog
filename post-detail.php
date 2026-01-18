<?php
    session_start();
    require 'connection.php';
    $postSlug=$_GET['slug'];

    $sql = "SELECT p.id, p.title, p.slug, p.image, p.content, p.created_at, u.fullname AS author
            FROM posts p
            JOIN users u ON p.user_id = u.user_id
            WHERE p.status = 1 and p.slug='$postSlug'";

    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)==0){
        header("Location: blog.php");
        exit;
    }
    $post=mysqli_fetch_assoc($result);
    if (isset($_POST['post_comment'])) {
        $comment = $_POST['comment'];
        $userId = $_SESSION['userId'];
        $postId = $post['id'];
        $createdAt = date('Y-m-d H:i:s');

        if (empty($comment)) {
            $message = "Comment Text is required";
            $messageType = 'danger';
        } else {
            $commentSql = "INSERT INTO comments (comment, post_id, user_id, created_at) VALUES('$comment', '$postId', '$userId', '$createdAt')";
            if (mysqli_query($conn, $commentSql) === TRUE) {
                $message = "Comment Created Successfully!";
                $messageType = 'success';
            }
        }
    }
    $postId = $post['id'];
    $allcomment = "SELECT c.id, c.comment, c.created_at, c.user_id, u.fullname AS author
            FROM comments c
            JOIN users u ON c.user_id = u.user_id
            WHERE c.post_id = '$postId'";
        $commentResult = mysqli_query($conn, $allcomment);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$post['title']?>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            height:500px;
            width:500px;
            object-fit: cover;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .card-text {
            font-size: 0.95rem;
        }

        .read-more {
            text-decoration: none;
        }

        .read-more:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <?php include 'include/navbar.php'; ?>

    <div class="container py-5">
        <h1 class="mb-4"><?=$post['title']?></h1>
        <p class="text-muted mb-2 mt-auto">
            By <?= htmlspecialchars($post['author']) ?> | <?= date('M d, Y', strtotime($post['created_at'])) ?>
        </p>
        <img src="uploads/post/<?= $post['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($post['title']) ?>">
        <p class="mt-4"><?= strip_tags($post['content']) ?></p>

        <div class="mt-4">
            <?php if (mysqli_num_rows($commentResult) > 0) {
                while ($comment = mysqli_fetch_assoc($commentResult)) {
            ?>
                    <div class="border p-2 rounded mb-3">
                        <p>
                            <span class="fw-bold">By <?= $comment['author'] ?></span>
                            <span>
                                <?= $comment['created_at'] ?>
                            </span>
                        </p>
                        <p>
                            <?= $comment['comment'] ?>
                        </p>
                    </div>
            <?php }
            } ?>
            <form action="" method="post">
                <textarea name="comment" placeholder="Post your comment here!" class="form-control"></textarea>
                <button  class="btn btn-primary mt-2" type="submit" name="post_comment">Post Comment</button>
            </form>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


<?php
// Close DB connection
$conn->close();
?>