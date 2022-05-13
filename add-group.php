<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";


  include_once "classes/Group.php";

  $group = new Group();

  if ($_SERVER['REQUEST_METHOD']=="POST") {
    
    $groupName = $_POST['group_name'];
    
    if (isset($_POST['permission'])) {

      $permission=$_POST['permission'];
      $addNewGroup = $group->add_new_group($groupName,$permission);
    }
    else{
      $addNewGroup =$meassage = "Group Name And Premission Fiels Must Not Be Empty!!";
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
            <!-- general form elements -->
            <?php if(in_array('updateGroup', $userPermission) || in_array('viewGroup', $userPermission) || in_array('deleteGroup', $userPermission)): ?>
            <a href="manage-group.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Manage Group</a>
            <?php endif; ?>
            <br><br>
            <div class="card card-primary">
              <?php if(isset($addNewGroup)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $addNewGroup; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Add New User Group</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="group_name">Group Name</label>
                    <input type="text" class="form-control" name="group_name" placeholder="Enter group name">
                  </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Permission</th>
                        <th>Create</th>
                        <th>Update</th>
                        <th>View</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Users</td>
                        <td><input type="checkbox" name="permission[]" value="createUser"></td>
                        <td><input type="checkbox" name="permission[]" value="updateUser"></td>
                        <td><input type="checkbox" name="permission[]" value="viewUser"></td>
                        <td><input type="checkbox" name="permission[]" value="deleteUser"></td>
                      </tr>
                      <tr>
                        <td>Groups</td>
                        <td><input type="checkbox" name="permission[]" value="createGroup"></td>
                        <td><input type="checkbox" name="permission[]" value="updateGroup"></td>
                        <td><input type="checkbox" name="permission[]" value="viewGroup"></td>
                        <td><input type="checkbox" name="permission[]" value="deleteGroup"></td>
                      </tr>
                      <tr>
                        <td>Category</td>
                        <td><input type="checkbox" name="permission[]" value="createCategory"></td>
                        <td><input type="checkbox" name="permission[]" value="updateCategory"></td>
                        <td><input type="checkbox" name="permission[]" value="viewCategory"></td>
                        <td><input type="checkbox" name="permission[]" value="deleteCategory"></td>
                      </tr>
                      <tr>
                        <td>Rates</td>
                        <td><input type="checkbox" name="permission[]" value="createRates"></td>
                        <td><input type="checkbox" name="permission[]" value="updateRates"></td>
                        <td><input type="checkbox" name="permission[]" value="viewRates"></td>
                        <td><input type="checkbox" name="permission[]" value="deleteRates"></td>
                      </tr>
                      <tr>
                        <td>Slots</td>
                        <td><input type="checkbox" name="permission[]" value="createSlots"></td>
                        <td><input type="checkbox" name="permission[]" value="updateSlots"></td>
                        <td><input type="checkbox" name="permission[]" value="viewSlots"></td>
                        <td><input type="checkbox" name="permission[]" value="deleteSlots"></td>
                      </tr>
                      <tr>
                        <td>Parking</td>
                        <td><input type="checkbox" name="permission[]" value="createParking"></td>
                        <td><input type="checkbox" name="permission[]" value="updateParking"></td>
                        <td><input type="checkbox" name="permission[]" value="viewParking"></td>
                        <td><input type="checkbox" name="permission[]" value="deleteParking"></td>
                      </tr>
                      <tr>
                        <td>Reports</td>
                        <td><input type="checkbox" name="permission[]" value="createReports"></td>
                        <td><input type="checkbox" name="permission[]" value="updateReports"></td>
                        <td><input type="checkbox" name="permission[]" value="viewReports"></td>
                        <td><input type="checkbox" name="permission[]" value="deleteReports"></td>
                      </tr>
                      <tr>
                        <td>Company</td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" value="updateCompany"></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Setting</td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" value="updateSetting"></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Profile</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" value="viewProfile"></td>
                        <td> - </td>
                      </tr>                      
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Add New Group</button>
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