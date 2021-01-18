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
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">PHP CodeIgniter Web Push</a>
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

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

        <?php if(isset($success_message)) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php } ?>

        <?php if(isset($_GET['msg'])) { ?>
          <?php if($_GET['msg'] === 'success') { ?>
            <div class="alert alert-success" role="alert">
                <?php echo 'Record deleted successfully.'; ?>
            </div>
          <?php } else if($_GET['msg'] === 'error') { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo 'Sorry there has been an issue, please try again.'; ?>
            </div>
          <?php } ?>
        <?php } ?>

          <h2>Subscribers List</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php if(isset($items)) {
                    $no = 1;
                    foreach($items as $item) {?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $item['title']; ?></td>
                  <td><?php echo $item['description']; ?></td>
                  <td><?php echo $item['image']; ?></td>
                  <td><button id="<?php echo $item['id']; ?>" name="delete" onclick="delete_record(this.id)" class="btn btn-sm btn-danger">DELETE</button></td>
                </tr>
              <?php } 
                  }else { ?>
                <tr>
                  <td colspan="5">Sorry! there is no record to be displayed.</td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
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
    <script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script  src="assets/js/bootstrap.min.js"></script>

	<script src="assets/js/app.js"></script>

  <script>

    function delete_record(id) {
      if(confirm('Are you sure you want to delete this record')) {
        $.ajax({
            url: "<?php echo base_url('delete_item'); ?>",
            method: "POST",
            data: {
                id: id
            },
            success: function(data) {
                console.log(data);
                if(data == '1') {
                  window.location = '<?php echo base_url('/?msg=success'); ?>';
                } else if(data == '0') {
                  window.location = '<?php echo base_url('/?msg=error'); ?>';
                }
            }
        });
      }
    }

  </script>

</body>
</html>