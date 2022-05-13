 <?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once 'classes/Slot.php';

  $slot = new Slot();

  if (isset($_GET['change-status']) && isset($_GET['id'])) {

    $slotStatus = $_GET['change-status'];
    $slotId = $_GET['id'];

    if ($slotStatus=='active') {

      $changeSlot = $slot->active_slot_status($slotId);

    }
    elseif($slotStatus=='deactive'){

      $changeSlot = $slot->deactive_slot_status($slotId);
    }
    elseif($slotStatus=='delete'){

      $changeSlot = $slot->delete_slot($slotId);
    }

  }

  $getSlot = $slot->get_all_slot_data();


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
            <?php if(in_array('createSlots', $userPermission)): ?>
            <a href="add-category.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Category</a>
            <?php endif; ?>
            <br><br>
            <div class="card">
              <?php if(isset($changeSlot)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $changeSlot; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Manage All Slot</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Slot Name</th>
                    <th>Slot Status</th>
                    <th style="width:165px;">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                     <?php
                        if(isset($getSlot)){
                          $sl = 0;
                          while ($slot = mysqli_fetch_assoc($getSlot)) {
                            $sl++;
                      ?>
                        <tr>
                          <td><?php echo $sl;?></td>
                          <td><?php echo $slot['slot_name'];?></td>
                          <td>
                            <?php
                              if ($slot['slot_status']==0){
                                echo "In Active";
                              }
                              elseif ($slot['slot_status']==1) {
                                echo "Active";
                              }
                            ?>
                          </td>
                          <td>
                            <?php if(in_array('updateSlots', $userPermission)): ?>
                              <?php if ($slot['slot_status']==0){ ?>
                              <a href="?change-status=active&&id=<?php echo $slot['id'];?>" class="btn btn-success">
                                <i class="fa fa-thumbs-up"></i>
                              </a>
                            <?php }
                            elseif ($slot['slot_status']==1) {
                              ?>
                              <a href="?change-status=deactive&&id=<?php echo $slot['id'];?>" class="btn btn-warning">
                                <i class="fa fa-thumbs-down"></i>
                              </a>
                              <?php 
                            }?>
                            <?php endif; ?>
                            <?php if(in_array('updateSlots', $userPermission)): ?>
                            <a href="edit-slot.php?slot-id=<?php echo $slot['id'];?>" class="btn btn-info">
                              <i class="fa fa-edit"></i>
                            </a>
                            <?php endif; ?>
                            <?php if(in_array('viewSlots', $userPermission)): ?>   
                            <a href="edit-slot.php?slot-id=<?php echo $slot['id'];?>" class="btn btn-primary">
                              <i class="fa fa-eye"></i>
                            </a>
                            <?php endif; ?>
                            <?php if(in_array('deleteSlots', $userPermission)): ?>
                            <a href="?change-status=delete&&id=<?php echo $slot['id'];?>" class="btn btn-danger">
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
                    <th>Slot Name</th>
                    <th>Slot Status</th>
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