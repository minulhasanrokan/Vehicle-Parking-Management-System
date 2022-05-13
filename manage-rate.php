 <?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once 'classes/Rate.php';
  include_once 'classes/Category.php';

  $rate = new Rate();
  $category = new Category();

  if (isset($_GET['change-status']) && isset($_GET['id'])) {


    $rateStatus = $_GET['change-status'];
    $rateId = $_GET['id'];

    if ($rateStatus=='active') {

      $changeRate = $rate->active_rate_status($rateId);

    }
    elseif($rateStatus=='deactive'){

      $changeRate = $rate->deactive_rate_status($rateId);
    }
    elseif($rateStatus=='delete'){

      $changeRate = $rate->delete_rate($rateId);
    }

  }

  $getRate = $rate->get_all_rate_data();

  // get active category data
  $getCategory = $category->get_active_category_data();


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
            <a href="add-rate.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Add arking Rate</a>
            <?php endif; ?>
            <br><br>
            <div class="card">
              <?php if(isset($changeRate)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $changeRate; ?>
              </div>
              <?php }?>
              <div class="card-header">
                <h3 class="card-title">Manage All Parking Rate</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL No</th>
                    <th>Rate Name</th>
                    <th>Parking Category</th>
                    <th>Rate Type</th>
                    <th>Rate Price</th>
                    <th>Rate Status</th>
                    <th style="width:165px;">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                     <?php
                        if(isset($getRate)){
                          $sl = 0;
                          while ($rate = mysqli_fetch_assoc($getRate)) {
                            $sl++;
                      ?>
                        <tr>
                          <td><?php echo $sl;?></td>
                          <td><?php echo $rate['rate_name'];?></td>
                          <td>
                          	<?php 
                          		if(isset($getCategory)){

		                          while ($category = mysqli_fetch_assoc($getCategory)) {
		                          	if ($category['vechile_category_id']==$rate['parking_category']) {
		                          		echo $category['vechile_category_name'];
		                          	}
		                          }
		                      }
                          	?>
                          		
                          	</td>
                          <td><?php
                          	if($rate['rate_type']==1){
                          		echo "Fixed";
                          	}
                          	elseif($rate['rate_type']==2){
                          		echo "Hourly";
                          	}
                      ?></td>
                          <td><?php echo $rate['rate_price'];?></td>
                          <td>
                            <?php
                              if ($rate['rate_status']==0){
                                echo "In Active";
                              }
                              elseif ($rate['rate_status']==1) {
                                echo "Active";
                              }
                            ?>
                          </td>
                          <td>
                            <?php if(in_array('updateRates', $userPermission)): ?>
                              <?php if ($rate['rate_status']==0){ ?>
                              <a href="?change-status=active&&id=<?php echo $rate['id'];?>" class="btn btn-success">
                                <i class="fa fa-thumbs-up"></i>
                              </a>
                            <?php }
                            elseif ($rate['rate_status']==1) {
                              ?>
                              <a href="?change-status=deactive&&id=<?php echo $rate['id'];?>" class="btn btn-warning">
                                <i class="fa fa-thumbs-down"></i>
                              </a>
                              <?php 
                            }?>
                            <?php endif; ?>
                            <?php if(in_array('updateRates', $userPermission)): ?>
                            <a href="edit-rate.php?rate-id=<?php echo $rate['id'];?>" class="btn btn-info">
                              <i class="fa fa-edit"></i>
                            </a>
                            <?php endif; ?>
                            <?php if(in_array('viewRates', $userPermission)): ?>   
                            <a href="edit-rate.php?rate-id=<?php echo $rate['id'];?>" class="btn btn-primary">
                              <i class="fa fa-eye"></i>
                            </a>
                            <?php endif; ?>
                            <?php if(in_array('deleteRates', $userPermission)): ?>
                            <a href="?change-status=delete&&id=<?php echo $rate['id'];?>" class="btn btn-danger">
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
                    <th>Rate Name</th>
                    <th>Parking Category</th>
                    <th>Rate Type</th>
                    <th>Rate Price</th>
                    <th>Rate Status</th>
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