<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once 'classes/Rate.php';

  include_once 'classes/Category.php';

  $rate = new Rate();
  $category = new Category();

  if(isset($_GET['rate-id'])){

    $rateId  = $_GET['rate-id'];

    if ($_SERVER['REQUEST_METHOD']=="POST") {
      
      $updateRate = $rate->update_rate($_POST,$rateId);
    }

    $getRate = $rate->get_single_rate_data($rateId);

    $getCategory = $category->get_active_category_data();
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
            <?php if(in_array('createRates', $userPermission)): ?>
            <a href="add-rate.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Parking Rate</a>
            <?php endif; ?>
            <?php if(in_array('updateRates', $userPermission) || in_array('viewRates', $userPermission) || in_array('deleteRates', $userPermission)): ?>
            <a href="manage-rate.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Manage Parking rate</a>
            <?php endif; ?>
            <br><br>
            <div class="card card-primary">
              <?php if(isset($updateRate)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $updateRate; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Edit Parking Rate</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
                if(isset($getRate)){
                  while ($rate = mysqli_fetch_assoc($getRate)) {
              ?>
              <form action='' method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Parking Rate Name</label>
                    <input type="text" class="form-control" name="rate_name" value="<?php echo $rate['rate_name'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Select Vehicle category</label>
                    <select class="form-control" name="parking_category">
                      <option>Select User Group</option>

                      <?php
                        if(isset($getCategory)){
                          while ($category = mysqli_fetch_assoc($getCategory)) {
                      ?>
                      <option <?php

                        if ($category['vechile_category_id']==$rate['parking_category']) {
                          echo 'selected';
                        }
                    ?> value="<?php echo $category['vechile_category_id'];?>"><?php echo $category['vechile_category_name'];?></option>
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
                      <option <?php
                        if($rate['rate_type']==1){
                              echo "selected";
                            }
                    ?> value="1">Fixed</option>
                      <option <?php
                        if($rate['rate_type']==2){
                              echo "selected";
                            }
                    ?> value="2">Hourly</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Parking Rate</label>
                    <input type="number" class="form-control" name="rate_price" value="<?php echo $rate['rate_price'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Parking Rate Status</label>
                    <select class="form-control" name="rate_status">
                      <option>Parking Rate Status Status</option>
                      <option <?php
                        if($rate['rate_status']==1){
                              echo "selected";
                            }
                    ?> value="1">Active</option>
                      <option <?php
                        if($rate['rate_status']==0){
                              echo "selected";
                            }
                    ?> value="0">Deactive</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="update_rate" class="btn btn-primary float-right">Update Parking Rate</button>
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