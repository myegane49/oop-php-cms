<?php include("includes/header.php"); ?>
<?php 
  if (!$session->is_signed_in()) { redirect("login.php"); } 
?>

<?php

  if (empty($_GET['id'])) {
    redirect("users.php");
  } else {
    $user = User::find_by_id($_GET['id']);
    if (isset($_POST['update'])) {
      $user->username = $_POST['username'];
      $user->first_name = $_POST['first_name'];
      $user->last_name = $_POST['last_name'];
      $user->password = $_POST['password'];

      if (!empty($_FILES['user_image'])) {
        $user->set_file($_FILES['user_image']);
        $user->upload_avatar();
      }
      $user->save();
      redirect("edit_user.php?id={$user->id}");
    }
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

                <div class="col-md-6">
                  <img src="<?php echo $user->avatar_path(); ?>" alt="User Avatar" width="300px">
                </div>     

                <div class="col-md-6">
                  <form action="" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo $user->username; ?>">
                      </div>

                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name" value="<?php echo $user->first_name; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="<?php echo $user->last_name; ?>">
                      </div>
                      
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" value="<?php echo $user->password; ?>">
                      </div>

                      <div class="form-group">
                        <label>Avatar</label>
                        <input type="file" class="form-control-file" name="user_image">
                      </div>

                      <a href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger">Delete</a>
                    
                      <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
                  </form>
                </div>

              </div>
              <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
  </div>
  <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>