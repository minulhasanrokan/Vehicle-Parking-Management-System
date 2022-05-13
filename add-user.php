<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once 'classes/Group.php';

  include_once 'classes/User.php';

  $group = new Group();
  $user = new User();



  $getGroup = $group->get_active_group_data();

  if ($_SERVER['REQUEST_METHOD']=="POST") {
    if(isset($_POST['add_user'])){

      if($_POST['add_user']=='add_user'){

        $addNewUser = $user->add_new_user($_POST, $_FILES);
      }
      else{

        $addNewUser =$meassage = "Something Went Wrong!!!";
      }
    }
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
            <?php if(in_array('updateUser', $userPermission) || in_array('viewUser', $userPermission) || in_array('deleteUser', $userPermission)): ?>
            <!-- general form elements -->
            <a href="manage-user.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Manage User</a>
            <?php endif; ?>
            <br><br>
            <div class="card card-primary">
              <?php if(isset($addNewUser)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $addNewUser; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Add New User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
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
                      <option value="<?php echo $group['id'];?>"><?php echo $group['group_name'];?></option>
                      <?php
                          }
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input type="text" class="form-control" name="user_name" placeholder="Enter User Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Fast Name</label>
                    <input type="text" class="form-control" name="user_f_name" placeholder="Enter User Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Last Name</label>
                    <input type="text" class="form-control" name="user_l_name" placeholder="Enter User Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">User Phone</label>
                    <input type="text" name="phone" class="form-control"  placeholder="Enter Phone Number">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Confirm Password</label>
                    <input type="password" name="c_password" class="form-control">
                  </div>    
                  <div class="form-group">
                    <label for="exampleInputFile">Profile Photo</label>
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
                      <input type="radio" name="gender" id="male" value="1">
                      Male
                    </label>
                    <label>
                      <input type="radio" name="gender" id="female" value="2">
                      Female
                    </label>
                  </div>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="add_user" value="add_user" class="btn btn-primary float-right">Add New User</button>
                </div>
              </form>
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