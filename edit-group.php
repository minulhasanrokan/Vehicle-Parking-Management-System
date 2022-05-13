<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";


  include_once "classes/Group.php";

  $group = new Group();

  if (isset($_GET['group-id'])) {

    $groupId  = $_GET['group-id'];


    if ($_SERVER['REQUEST_METHOD']=="POST") {
      
      $groupName = $_POST['group_name'];
      
      if (isset($_POST['permission'])) {

        $permission=$_POST['permission'];

        $updateGroup = $group->update_group($groupName,$permission,$groupId);
      }
      else{
        $updateGroup =$meassage = "Something Went Wrong!!!";
      }
    }

    $groupData = $group->get_single_group_data($groupId);
    
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
            <?php if(in_array('createGroup', $userPermission)): ?>
            <a href="add-group.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Group</a>
            <?php endif; ?>
            <?php if(in_array('updateGroup', $userPermission) || in_array('viewGroup', $userPermission) || in_array('deleteGroup', $userPermission)): ?>
            <a href="manage-group.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Manage Group</a>
            <?php endif; ?>
            <br><br>
            <div class="card card-primary">
              <?php if(isset($updateGroup)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $updateGroup; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Edit User Group</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
                if ($groupData) {
                  while ($group = mysqli_fetch_assoc($groupData)) {

                    $permission = $group['permission'];

                    $permission = unserialize($permission);   
              ?>
              <form method="POST" action="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="group_name">Group Name</label>
                    <input type="text" class="form-control" name="group_name" value="<?php echo $group['group_name'];?>">
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
                        <td><input type="checkbox" name="permission[]" id="permission" value="createUser" <?php if($permission) {
                          if(in_array('createUser', $permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateUser" <?php 
                        if($permission) {
                          if(in_array('updateUser', $permission)) { echo "checked"; } 
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewUser" <?php 
                        if($permission) {
                          if(in_array('viewUser', $permission)) { echo "checked"; }   
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteUser" <?php 
                        if($permission) {
                          if(in_array('deleteUser', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                      </tr>
                      <tr>
                        <td>Groups</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createGroup" <?php 
                        if($permission) {
                          if(in_array('createGroup', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateGroup" <?php 
                        if($permission) {
                          if(in_array('updateGroup', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewGroup" <?php 
                        if($permission) {
                          if(in_array('viewGroup', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteGroup" <?php 
                        if($permission) {
                          if(in_array('deleteGroup', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                      </tr>
                      <tr>
                        <td>Category</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createCategory" <?php 
                        if($permission) {
                          if(in_array('createCategory', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCategory" <?php 
                        if($permission) {
                          if(in_array('updateCategory', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewCategory" <?php 
                        if($permission) {
                          if(in_array('viewCategory', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteCategory" <?php 
                        if($permission) {
                          if(in_array('deleteCategory', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                      </tr>
                      <tr>
                        <td>Rates</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createRates" <?php 
                        if($permission) {
                          if(in_array('createRates', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateRates" <?php 
                        if($permission) {
                          if(in_array('updateRates', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewRates" <?php 
                        if($permission) {
                          if(in_array('viewRates', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteRates" <?php 
                        if($permission) {
                          if(in_array('deleteRates', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                      </tr>
                      <tr>
                        <td>Slots</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createSlots" <?php 
                        if($permission) {
                          if(in_array('createSlots', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSlots" <?php 
                        if($permission) {
                          if(in_array('updateSlots', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewSlots" <?php 
                        if($permission) {
                          if(in_array('viewSlots', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteSlots" <?php 
                        if($permission) {
                          if(in_array('deleteSlots', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                      </tr>
                      <tr>
                        <td>Parking</td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createParking" <?php 
                        if($permission) {
                          if(in_array('createParking', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateParking" <?php 
                        if($permission) {
                          if(in_array('updateParking', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewParking" <?php 
                        if($permission) {
                          if(in_array('viewParking', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteParking" <?php 
                        if($permission) {
                          if(in_array('deleteParking', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                      </tr>
                      <tr>
                        <td>Company</td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCompany" <?php 
                        if($permission) {
                          if(in_array('updateCompany', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Setting</td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateSetting" <?php 
                        if($permission) {
                          if(in_array('updateSetting', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Reports</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewReports" <?php 
                        if($permission) {
                          if(in_array('viewReports', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td> - </td>
                      </tr>
                      <tr>
                        <td>Profile</td>
                        <td> - </td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProfile" <?php 
                        if($permission) {
                          if(in_array('viewProfile', $permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td> - </td>
                      </tr>   
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Update Group</button>
                </div>
              </form>
            <?php } }?>
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