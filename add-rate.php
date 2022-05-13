<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once 'classes/Rate.php';

  include_once 'classes/Category.php';

  $rate = new Rate();
  $category = new Category();

  $getCategory = $category->get_active_category_data();

  if ($_SERVER['REQUEST_METHOD']=="POST") {
    
    $addNewRate = $rate->add_new_rate($_POST);
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
            <?php if(in_array('updateRates', $userPermission) || in_array('viewRates', $userPermission) || in_array('deleteRates', $userPermission)): ?>
            <!-- general form elements -->
            <a href="manage-rate.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Manage Parking Rate</a>
            <?php endif; ?>
            <br><br>
            <div class="card card-primary">
              <?php if(isset($addNewRate)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $addNewRate; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Add New Parking Rate</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action='' method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Parking Rate Name</label>
                    <input type="text" class="form-control" name="rate_name" placeholder="Enter Parking Rate Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Select Vehicle Category</label>
                    <select class="form-control" name="parking_category">
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
                    <label for="exampleInputEmail1">Parking Rate Type</label>
                    <select class="form-control" name="rate_type">
                      <option>Select Category Status</option>
                      <option value="1">Fixed</option>
                      <option value="2">Hourly</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Parking Rate</label>
                    <input type="number" class="form-control" name="rate_price" placeholder="Enter User Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Parking Rate Status</label>
                    <select class="form-control" name="rate_status">
                      <option>Parking Rate Status Status</option>
                      <option value="1">Active</option>
                      <option value="0">Deactive</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="add_rate" class="btn btn-primary float-right">Add New Parking Rate</button>
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