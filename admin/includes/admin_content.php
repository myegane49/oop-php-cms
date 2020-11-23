<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Dashboard</small>
            </h1>

            <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $session->count; ?></div>
                                        <div>New Views</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                  <span class="pull-left">View Details</span> 
                               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> 
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-photo fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo Photo::count_all(); ?></div>
                                        <div>Photos</div>
                                    </div>
                                </div>
                            </div>
                            <a href="photos.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Photos in Gallery</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo User::count_all(); ?></div>
                                        <div>Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Users</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                      <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo Comment::count_all(); ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Comments</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                        </div> <!--First Row-->

            <?php
                // $result = User::find_all_users();           
                // while($row = mysqli_fetch_assoc($result)) {
                //     echo $row['username'] . "<br>";
                // }

                // $found_user = User::find_user_by_id(1);
                // $user = User::instantiation($found_user);
                // echo $user->id;

                // $users = User::find_all_users();
                // foreach($users as $user) {
                //     echo $user->username . "<br>";
                // }

                // $found_user = User::find_user_by_id(1);
                // echo $found_user->username;

                // $users = User::find_all();
                // foreach($users as $user) {
                //     echo $user->username . "<br>";
                // }

            ?>

            <?php 
                // $user = new User();
                // $user->username = "test_user4";
                // $user->password = "123";
                // $user->first_name = "test4";
                // $user->last_name = "user4";

                // $user->create();
            ?>

            <?php
                // $user = User::find_user_by_id(9);
                // $user->first_name = 'DonaldJ';
                // $user->last_name = 'Trump';
                // $user->update();
            ?>

            <?php
                // $user = User::find_user_by_id(7);
                // $user->delete();
            ?>

            <?php
                // $user = User::find_user_by_id(8);
                // $user->username = "example";
                // $user->save();
            ?>

            <?php
                // $user = new User();
                // $user->username = "whatev";
                // $user->password = "whatev_pass";
                // $user->first_name = "whatev_name";
                // $user->last_name = "whatev_last";
                // $user->save();
            ?>

            <?php
                // $photos = Photo::find_all();
                // foreach($photos as $photo) {
                //     echo $photo->title . "<br>";
                // }

                // $photo = new Photo();
                // $photo->title = "second photo";
                // $photo->description = "desc 2";
                // $photo->type = "image";
                // $photo->size = 20;

                // $photo->create();
            ?>

            <?php
                // $photo = Photo::find_by_id(4);
                // echo $photo->title;
            ?>

            
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div id="piechart" style="width: 900px; height: 500px;"></div>
    </div>

</div>
<!-- /.container-fluid -->