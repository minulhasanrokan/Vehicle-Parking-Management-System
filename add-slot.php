<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once "classes/Slot.php";

  include_once "classes/Category.php";

  $slot = new Slot();

  $category = new Category();

  $getCategory = $category->get_active_category_data();

  if ($_SERVER['REQUEST_METHOD']=="POST") {
    
    echo $_POST['slot_status'];
    if ($_POST['slot_name']==null || $_POST['category']==null) {

      $addNewSlot =$meassage = "Slot Name and Category Fiels Must Not Be Empty!!";
    }
    else{
      $addNewSlot = $slot->add_slot_category($_POST);
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
            <?php if(in_array('updateSlots', $userPermission) || in_array('viewSlots', $userPermission) || in_array('deleteSlots', $userPermission)): ?>
            <a href="manage-slot.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Manage Slot</a>
            <?php endif; ?>
            <br><br>
            <div class="card card-primary">
              <?php if(isset($addNewSlot)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $addNewSlot; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Add New Parking Slot</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action='' method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Slot Name</label>
                    <input type="text" class="form-control" name="slot_name" placeholder="Enter User Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Vehicle Category</label>
                    <select class="form-control" name="category">
                      <option>Select Vehicle Category</option>

                      <?php
                        if(isset($getCategory)){
                          while ($category = mysqli_fetch_assoc($getCategory)) {
                      ?>
                      <option value="<?php echo $category['vechile_category_id'];?>"><?php echo $category['vechile_category_name'];?></option>
                      <?php
                          }
                        }
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Slot Status</label>
                    <select class="form-control" name="slot_status">
                      <option>Select Slot Status</option>
                      <option value="1">Active</option>
                      <option value="0">Deactive</option>
                    </select>
                  </div> 
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="add_slot" class="btn btn-primary float-right">Add New Slot</button>
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