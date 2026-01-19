<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home - Blog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <?php include 'include/navbar.php'; ?>

  <div class="container col-xxl-8 px-4">
  <div class="container col-xxl-8 px-4 h-100">
    <div class="row align-items-center g-5 flex-lg-row-reverse">

      <!-- Hero Image -->
      <div class="col-10 col-sm-8 col-lg-6 mx-auto">
        <img src="img/blog.png"
          class="d-block mx-lg-auto img-fluid "
          alt="Blog Hero Image">
      </div>

      <!-- Hero Content -->
      <div class="col-lg-6 text-center text-lg-start">
        <h1 class="display-4 fw-bold mb-3">Welcome to Our Blog</h1>
        <p class="lead mb-4">
          Discover insightful articles, tutorials, and tips on web development, programming, and modern technologies. Build your skills and stay updated with the latest trends.
        </p>

        <div class="d-grid gap-2 d-md-flex justify-content-center justify-content-lg-start">
          <a href="blog.php" class="btn btn-primary btn-lg px-4 me-md-2 shadow-sm">Read Articles</a>
          <a href="contact.php" class="btn btn-outline-secondary btn-lg px-4 shadow-sm">Get in Touch</a>
        </div>
      </div>

    </div>
  </div>

  <?php include 'include/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
