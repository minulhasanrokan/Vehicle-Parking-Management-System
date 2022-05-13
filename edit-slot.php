<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once "classes/Slot.php";

  $slot = new Slot();

  if(isset($_GET['slot-id'])){

    $slotId  = $_GET['slot-id'];

    if ($_SERVER['REQUEST_METHOD']=="POST") {
    
      if (!empty($_POST['slot_name'])) {

        $updateSlot = $slot->update_slot($_POST,$slotId);
      }
      else{
        $updateSlot =$meassage = "Category Name Field Must Not Be Empty!!";
      }
    }

    $slotData = $slot->get_single_slot_data($slotId);
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
            <?php if(in_array('createSlots', $userPermission)): ?>
            <a href="add-slot.php" class="btn btn-primary"> <i class="fa fa-plus"></i> ADD Slot</a>
            <?php endif; ?>
            <?php if(in_array('updateSlots', $userPermission) || in_array('viewSlots', $userPermission) || in_array('deleteSlots', $userPermission)): ?>
            <a href="manage-slot.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Manage Slot</a>
            <?php endif; ?>
            <br><br>
            <div class="card card-primary">
              <?php if(isset($updateSlot)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $updateSlot; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Edit Vechile Parking Slot</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
                if(isset($slotData)){

                  while($slot =mysqli_fetch_assoc($slotData)){
              ?>
              <form action='' method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Slot Name</label>
                    <input type="text" class="form-control" name="slot_name" value="<?php echo $slot['slot_name'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Slot Status</label>
                    <select class="form-control" name="slot_status">
                      <option>Select Slot Status</option>
                      <option
                      <?php
                        if($slot['slot_status']==1){
                          echo "selected";
                        }
                      ?>
                      value="1">Active</option>
                      <option
                      <?php
                        if($slot['slot_status']==0){
                          echo "selected";
                        }
                      ?>
                      value="0">Deactive</option>
                    </select>
                  </div> 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="update_slot" class="btn btn-primary float-right">Update Slot</button>
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