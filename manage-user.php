<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once 'classes/Group.php';

  include_once 'classes/User.php';

  $group = new Group();

  $user = new User();

  if (isset($_GET['change-status']) && isset($_GET['id'])) {

    $userStatus = $_GET['change-status'];
    $userId = $_GET['id'];

    if ($userStatus=='active') {

      $changeUser = $user->active_user_status($userId);

    }
    elseif($userStatus=='deactive'){

      $changeUser = $user->deactive_user_status($userId);
    }
    elseif($userStatus=='delete'){

      $changeUser = $user->delete_user($userId);
    }

  }

  $getGroup = $group->get_active_group_data();

  $getUser = $user->get_all_user_data();


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
            <?php if(in_array('createUser', $userPermission)): ?>
            <a href="add-user.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Add User</a>
            <?php endif; ?>
            <br><br>
            <div class="card">
              <?php if(isset($changeUser)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $changeUser; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Manage All User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Group</th>
                    <th>Status</th>
                    <th style="width:165px;">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                     <?php
                        if(isset($getUser)){
                          $sl = 0;
                          while ($user = mysqli_fetch_assoc($getUser)) {
                            $sl++;
                      ?>
                        <tr>
                          <td><?php echo $sl;?></td>
                          <td><img style="width: 40px;" src="uploads/user/<?php echo $user['image'];?>"></td>
                          <td><?php echo $user['firstname'].' '.$user['lastname'];?></td>
                          <td><?php echo $user['email'];?></td>
                          <td><?php echo $user['phone'];?></td>
                          <td>
                          	<?php
                          		if(isset($getGroup)){
                          			while ($group = mysqli_fetch_assoc($getGroup)){
                          				if ($user['group_id']==$group['id']) {
                          					echo $group['group_name'];
                          				}
                          			}
                          		}
                          	?>
                          	</td>
                          <td>
                            <?php
                              if ($user['status']==0){
                                echo "In Active";
                              }
                              elseif ($user['status']==1) {
                                echo "Active";
                              }
                            ?>
                          </td>
                          <td>
                              <?php if ($user['status']==0){ ?>
                              <a href="?change-status=active&&id=<?php echo $user['id'];?>" class="btn btn-success">
                                <i class="fa fa-thumbs-up"></i>
                              </a>
                            <?php }
                            elseif ($user['status']==1) {
                              ?>
                              <?php if(in_array('updateUser', $userPermission)): ?>
                              <a href="?change-status=deactive&&id=<?php echo $user['id'];?>" class="btn btn-warning">
                                <i class="fa fa-thumbs-down"></i>
                              </a>
                              <?php endif; ?>
                              <?php 
                            }?>
                            <?php if(in_array('updateUser', $userPermission)): ?>
                            <a href="edit-user.php?user-id=<?php echo $user['id'];?>" class="btn btn-info">
                              <i class="fa fa-edit"></i>
                            </a>
                            <?php endif; ?>

                            <?php if(in_array('viewUser', $userPermission)): ?>   
                            <a href="edit-user.php?user-id=<?php echo $user['id'];?>" class="btn btn-primary">
                              <i class="fa fa-eye"></i>
                            </a>
                            <?php endif; ?>
                            <?php if(in_array('deleteUser', $userPermission)): ?>
                            <a href="?change-status=delete&&id=<?php echo $user['id'];?>" class="btn btn-danger">
                              <i class="fa fa-trash"></i>
                            </a>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php
                        }
                      }
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>SL No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Group</th>
                    <th>Status</th>
                    <th style="width:165px;">Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
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