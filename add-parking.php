<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once 'classes/Category.php';

  include_once 'classes/Parking.php';

  $category = new Category();

  $parking = new Parking();

  $getCategory = $category->get_active_category_data();


  if ($_SERVER['REQUEST_METHOD']=='POST') {
    
    $addPrking = $parking->add_new_parking($_POST);
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
            <?php if(in_array('updateParking', $userPermission) || in_array('viewParking', $userPermission) || in_array('deleteParking', $userPermission)): ?>
            <!-- general form elements -->
            <a href="manage-parking.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Manage Parking</a>
            <?php endif; ?>
            <br><br>
            <div class="card card-primary">
              <?php if(isset($addPrking)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $addPrking; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Add New Parking</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action='' method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Vehicle Name</label>
                    <input type="text" class="form-control" name="vehicle_name" placeholder="Enter vehicle Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Vehicle Licence</label>
                    <input type="text" class="form-control" name="vehicle_licence" placeholder="Enter vehicle licence Number">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Vehicle User Name</label>
                    <input type="text" class="form-control" name="vehicle_user_name" placeholder="Enter Vehicle User Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Vehicle User Mobile</label>
                    <input type="text" class="form-control" name="vehicle_user_mobile" placeholder="Enter Vehicle User Mobile Number">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Vehicle Category</label>
                    <select class="form-control" onchange="get_slot(this.value), get_rate(this.value);" name="vehicle_category" id="vehicle_category">
                      <option value="0">Select Vehicle Category</option>

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
                    <label for="exampleInputEmail1">Vehicle Parking Slot</label>
                    <select class="form-control" id="vehicle_parking_slot" name="vehicle_parking_slot">
                      <option value="0">Select Vehicle Category First</option>

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
                    <label for="exampleInputEmail1">Vehicle Parking Rate</label>
                    <select class="form-control" id="vehicle_parking_rate" name="vehicle_parking_rate">
                      <option value="0">Select Vehicle Category First</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="add_parking" value="add_parking" class="btn btn-primary float-right">Add New Parking</button>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript">
    function get_slot(val)
    {
     $.ajax({
     type: 'post',
     url: 'get-data-by-ajax.php',
     data: {
      get_slot:val
     },
     success: function (response) {
      document.getElementById("vehicle_parking_slot").innerHTML=response; 
     }
     });
    }

    function get_rate(val)
    {
     $.ajax({
     type: 'post',
     url: 'get-data-by-ajax.php',
     data: {
      get_rate:val
     },
     success: function (response) {
      document.getElementById("vehicle_parking_rate").innerHTML=response; 
     }
     });
    }

  </script>
  <?php

  include_once "inc/footer.php";
?>