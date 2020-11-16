<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
            </h1>

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

                $users = User::find_all();
                foreach($users as $user) {
                    echo $user->username . "<br>";
                }
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

            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->