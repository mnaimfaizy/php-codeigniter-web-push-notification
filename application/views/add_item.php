<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>PHP CodeIgniter Web Push Application</title>

	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<!-- Custom styles for this template -->
	<link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">
</head>
<body>

	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">PHP CodeIgniter Web Push</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <button id="push-subscription-button" class="btn btn-sm btn-primary">Enable Push Notification</button>
        </li>
      </ul>
    </nav>

	<div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="<?php echo base_url(); ?>">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="add_item">
                  <span data-feather="home"></span>
                  ADD Item 
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-4 px-4">

        <div class="alert alert-danger" role="alert">
            <?php echo validation_errors(); ?>
        </div>

        <?php if(isset($error_message)) {?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php } ?>

        <form action="add_item" name="add_item_form" id="add_item_form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo set_value('title'); ?>" placeholder="Enter title" />
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo set_value('description'); ?>" placeholder="Description" />
            </div>
            <div class="form-group">
                <label for="file">Image</label>
                <input type="file" class="form-control" id="file" name="file" />
            </div>
            <button type="submit" name="btn_add_item" id="btn_add_item" class="btn btn-primary">Submit</button>
        </form>

        </main>
      </div>
    </div>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">Place sticky footer content here.</span>
      </div>
    </footer>

	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-3.2.1.slim.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script  src="assets/js/bootstrap.min.js"></script>

	<script src="assets/js/app.js"></script>

</body>
</html>