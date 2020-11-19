<?php include("includes/header.php"); ?>
<?php 
if (!$session->is_signed_in()) { redirect("login.php"); } 
?>

<?php

  if (isset($_POST['create'])) {
    $user = new User();
    $user->username = $_POST['username'];
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->password = $_POST['password'];

    
  }

?>

  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <?php include("includes/top_nav.php"); ?>
      <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
      <?php include("includes/side_nav.php"); ?>
      <!-- /.navbar-collapse -->
  </nav>

  <div id="page-wrapper">
        <div class="container-fluid">

              <!-- Page Heading -->
              <div class="row">
                <h1 class="page-header">
                    users
                    <small>Subheading</small>
                </h1>
                     
                <div class="col-md-6 col-md-offset-3">
                  <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username">
                      </div>

                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name">
                      </div>
                      
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="last_name">
                      </div>
                      
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                      </div>

                      <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" class="form-control-file" name="user_image">
                      </div>
                    
                      <input type="submit" name="create" class="btn btn-primary pull-right" value="Create">
                  </form>
                </div>

              </div>
              <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
  </div>
  <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>