<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once 'classes/Group.php';

  include_once 'classes/User.php';

  $group = new Group();
  $user = new User();

  if(isset($_GET['user-id'])){

    $userId  = $_GET['user-id'];

    $getGroup = $group->get_active_group_data();

    if ($_SERVER['REQUEST_METHOD']=="POST") {
      if(isset($_POST['add_user'])){

        if($_POST['add_user']=='add_user'){

          $updateUser = $user->update_user($_POST, $_FILES,$userId);
        }
        else{

          $updateUser =$meassage = "Something Went Wrong!!!";
        }
      }
    }

    $userData = $user->get_single_user_data($userId);
  }
  else{

  }

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <?php if(in_array('createUser', $userPermission)): ?>
            <a href="add-user.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Add User</a>
            <?php endif; ?>
            <?php if(in_array('updateUser', $userPermission) || in_array('viewUser', $userPermission) || in_array('deleteUser', $userPermission)): ?>
            <a href="manage-user.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Manage User</a>
            <?php endif; ?>
            <br><br>
            <div class="card card-primary">
              <?php if(isset($updateUser)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $updateUser; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Edit User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
                if ($userData) {
                  while ($user = mysqli_fetch_assoc($userData)) {
              ?>
              <form action='' method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Group</label>
                    <select class="form-control" name="user_group">
                      <option>Select User Group</option>

                      <?php
                        if(isset($getGroup)){
                          while ($group = mysqli_fetch_assoc($getGroup)) {
                      ?>
                      <option <?php
                        if ($group['id']==$user['group_id']) {
                          echo "selected";
                        }
                    ?> value="<?php echo $group['id'];?>"><?php echo $group['group_name'];?></option>
                      <?php
                          }
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Fast Name</label>
                    <input type="text" class="form-control" name="user_f_name" value="<?php echo $user['firstname'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Last Name</label>
                    <input type="text" class="form-control" name="user_l_name" value="<?php echo $user['lastname'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Email address</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $user['email'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?php echo $user['phone'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $user['password'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Confirm Password</label>
                    <input type="password" name="c_password" class="form-control" value="<?php

                    echo $user['password'];?>">
                  </div>    
                  <div class="form-group">
                    <label for="exampleInputFile">Profile Photo</label>
                    <img class="img-fluid" style="width:50px;" src="uploads/user/<?php echo $user['image'];?>">
                    <div class="input-group">

                      <div class="custom-file">

                        <input type="file" name="image" class="custom-file-input">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                  <label for="gender">Gender</label>
                  <div class="radio">
                    <label>
                      <input <?php 
                        if ($user['gender']==1) {
                          echo "checked";
                        }
                    ?> type="radio" name="gender" id="male" value="1">
                      Male
                    </label>
                    <label>
                      <input<?php 
                        if ($user['gender']==0) {
                          echo "checked";
                        }
                    ?> type="radio" name="gender" id="female" value="0">
                      Female
                    </label>
                  </div>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="add_user" value="add_user" class="btn btn-primary float-right">Update User</button>
                </div>
              </form>
              <?php
                  }
                }
              ?>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php
  include_once "inc/footer.php";
?>