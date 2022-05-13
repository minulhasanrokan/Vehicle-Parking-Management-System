<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once 'classes/Group.php';

  $group = new Group();

  if (isset($_GET['change-status']) && isset($_GET['id'])) {

    $groupStatus = $_GET['change-status'];
    $groupId = $_GET['id'];

    if ($groupStatus=='active') {

      $changeGroup = $group->active_group_status($groupId);

    }
    elseif($groupStatus=='deactive'){

      $changeGroup = $group->deactive_group_status($groupId);
    }
    elseif($groupStatus=='delete'){

      $changeGroup = $group->delete_group($groupId);
    }

  }

  $getGroup = $group->get_all_group_data();


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
            <?php if(in_array('createGroup', $userPermission)): ?>
            <a href="add-group.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Group</a>
            <?php endif; ?>
            <br><br>
            <div class="card">
              <?php if(isset($changeGroup)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $changeGroup; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Manage All Group</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Group Name</th>
                    <th>Group Status</th>
                    <th style="width:165px;">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                     <?php
                        if(isset($getGroup)){
                          $sl = 0;
                          while ($group = mysqli_fetch_assoc($getGroup)) {
                            $sl++;
                      ?>
                        <tr>
                          <td><?php echo $sl;?></td>
                          <td><?php echo $group['group_name'];?></td>
                          <td>
                            <?php
                              if ($group['status']==0){
                                echo "In Active";
                              }
                              elseif ($group['status']==1) {
                                echo "Active";
                              }
                            ?>
                          </td>
                          <td>
                            <?php if(in_array('updateGroup', $userPermission)): ?>
                              <?php if ($group['status']==0){ ?>
                              <a href="?change-status=active&&id=<?php echo $group['id'];?>" class="btn btn-success">
                                <i class="fa fa-thumbs-up"></i>
                              </a>
                            <?php }
                            elseif ($group['status']==1) {
                              ?>
                              <a href="?change-status=deactive&&id=<?php echo $group['id'];?>" class="btn btn-warning">
                                <i class="fa fa-thumbs-down"></i>
                              </a>
                              <?php 
                            }?>
                            <?php endif; ?>
                            <?php if(in_array('updateGroup', $userPermission)): ?>
                            <a href="edit-group.php?group-id=<?php echo $group['id'];?>" class="btn btn-info">
                              <i class="fa fa-edit"></i>
                            </a>
                            <?php endif; ?>
                            <?php if(in_array('viewGroup', $userPermission)): ?>   
                            <a href="edit-group.php?group-id=<?php echo $group['id'];?>" class="btn btn-primary">
                              <i class="fa fa-eye"></i>
                            </a>
                            <?php endif; ?>
                            <?php if(in_array('deleteGroup', $userPermission)): ?>
                            <a href="?change-status=delete&&id=<?php echo $group['id'];?>" class="btn btn-danger">
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
                    <th>Group Name</th>
                    <th>Group Status</th>
                    <th>Action</th>
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