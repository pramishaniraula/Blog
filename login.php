
<?php
session_start();
require 'connection.php';
// $_SESSION['email'] = 'abc@gmail.com';
// $_SESSION['password'] = 'abcd';


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email)){
        $message = "Please enter your email";
        $messageType = 'error';
    }
    if(empty($password)){
        $message = "Please enter your password";
        $messageType = 'error';
    }

    // if ($email === $_SESSION['email'] && $password === $_SESSION['password']) {
    //   $_SESSION['isLogin'] = true;
    //   header("Location: dashboard.php");
    //   exit;
    // }else{
    //   $message = "Invalid Email and Password";
    // }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    //$result = $conn->query($sql);
    
    // check the record 
    if(mysqli_num_rows($result)>0){
      $user = mysqli_fetch_assoc($result);
      if(password_verify($password, $user['password'])){
        $_SESSION['userId'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['fullname'];
        $_SESSION['isLogin'] = true;
        header("Location: dashboard.php");
      }
    }else{
      $message = "Email and Password does not match";
    }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body> 

    <?php  include 'include/navbar.php';   ?>

<div class="container">
    <nav aria-label="breadcrumb" class="my-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Login</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-6 my-auto">
            <?php if (!empty($message)) { ?>
                <div class="alert alert-danger">
                    <?= $message ?>
                </div>
            <?php } ?>
            <div class="card">
                <div class="card-body">
                    <form action="login.php" method="post">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control mb-3" placeholder="Enter your email">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Enter your password">

                        <div class="d-flex">
                            <input name="submit" class="btn btn-primary mt-3 w-50" type="submit" value="Submit">
                            <input class="btn btn-danger mt-3 w-50 ms-3" type="reset" value="Reset">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <img src="img/login.png" alt="Login" class="img-fluid">
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>