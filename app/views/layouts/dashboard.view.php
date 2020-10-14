<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi</title>
    <link rel="stylesheet" href="<?php echo url ('/css/bootstrap.min.css');?>">
</head>
<body>
<!-- As a link -->
<nav class="navbar navbar-expand-md navbar-dark bg-success">
  <div class="container">
    <a class="navbar-brand" href="<?php echo url('/'); ?>">Aplikasi</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar-menu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar-menu">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="<?php echo url('/home'); ?>" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="<?php echo url('/about'); ?>" class="nav-link">About</a></li>
            <li class="nav-item"><a href="<?php echo url('/contact-us'); ?>" class="nav-link">Contact Us</a></li>
        </ul>
    </div>
  </div>
</nav>

<main class="my-5">
    <?php 

    $view_path = APP_DIRECTORY . "/views/{$view_name}.view.php";

    if (! file_exists($view_path)) {
        throw new Exception("View pada direktori {$view_path} tidak wujud.");
    }

    include $view_path; 
    ?>
</main>



<script src="<?php echo url ('/js/jquery.min.js');?>"></script>
<script src="<?php echo url ('/js/popper.min.js');?>"></script>
<script src="<?php echo url ('/js/bootstrap.min.js');?>"></script>
</body>
</html>