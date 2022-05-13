 <?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once 'classes/Parking.php';

  $parking = new Parking();


  if (isset($_GET['change-status']) && isset($_GET['id'])) {

    $parkingStatus = $_GET['change-status'];
    $parkingId = $_GET['id'];
    if($parkingStatus=='delete'){

        $changePrking = $parking->delete_parking($parkingId);
    }
    elseif($parkingStatus=='paid'){

        $changePrking = $parking->paid_parking($parkingId);
    }
    elseif($parkingStatus=='un-paid'){

        $changePrking = $parking->un_paid_parking($parkingId);
    }
  } 

  $getParking = $parking->get_all_parking_data();

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
            <?php if(in_array('createParking', $userPermission)): ?>
            <a href="add-parking.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Parking</a>
            <?php endif; ?>
            <br><br>
            <div class="card">
              <?php if(isset($changePrking)){?>
              <div style="padding: 10px; background: green; color: white;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
               <?php echo $changePrking; ?>
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
                    <th>Parking code</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Vehicle Type</th>
                    <th>Vehicle Name</th>
                    <th>Rate Name</th>
                    <th>Rate</th>
                    <th>Slot</th>
                    <th>Total Time</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php
                        if(isset($getParking)){
                          foreach ($getParking as $key => $parking) {
                      ?>
                        <tr>
                          <td><?php echo $parking['parking']['parking_code'];?></td>
                          <td>
                            <?php
                              $date=date('Y-m-d', $parking['parking']['in_time']);
                              $time=date('h:i a', $parking['parking']['in_time']);
                              echo $date . '<br />' . $time;
                            ?>
                          </td>
                          <td>
                            <?php 

                            if($parking['parking']['out_time'] == '') {
                              echo "-";
                            }
                            else {
                               $date= date('Y-m-d', $parking['parking']['out_time']);
                               $time= date('h:i a', $parking['parking']['out_time']);
        
                               echo $date . '<br />' . $time;

                            }

                            ?>
                          </td>
                          <td><?php echo $parking['category']['vechile_category_name']; ?></td>
                          <td><?php echo $parking['parking']['vehicle_name']; ?></td>
                          <td><?php echo $parking['rate']['rate_name']; ?></td>
                          <td><?php echo $parking['rate']['rate_price']; ?></td>
                          <td><?php echo $parking['slot']['slot_name']; ?></td>
                          <td><?php echo $parking['parking']['total_time'] . ' hour'; echo ($parking['parking']['total_time'] > 1)?'s':'';?></td>
                          <td><?php echo $companyInformation['company_currency'].' ';?><?php echo ($parking['parking']['total_amount'])?:'-'; ?></td>
                          <td><?php echo ($parking['parking']['paid_status'] == 1) ? '<label class="label label-success">Paid</label>' : '<label class="label label-warning">Not Paid</label>'; ?></td>
                          <td>
                            <?php if(in_array('viewParking', $userPermission)): ?>
                            <a onclick="printParking('invoice.php?parking-id=<?php echo $parking['parking']['id'];?>')" class="btn btn-default"><i class="fa fa-print"></i></a>
                          <?php endif; ?>
                            <?php if(in_array('updateParking', $userPermission)): ?>
                              <?php if ($parking['parking']['paid_status']==0){ ?>
                              <a href="?change-status=paid&&id=<?php echo $parking['parking']['id'];?>" class="btn btn-success">
                                <i class="fa fa-thumbs-up"></i>
                              </a>
                            <?php }
                            elseif ($parking['parking']['paid_status']==1) {
                              ?>
                              <a href="?change-status=un-paid&&id=<?php echo $parking['parking']['id'];?>" class="btn btn-warning">
                                <i class="fa fa-thumbs-down"></i>
                              </a>
                              <?php 
                            }?>
                            <?php endif; ?>
                            <?php if(in_array('updateParking', $userPermission)): ?>
                            <a href="edit-parking.php?parking-id=<?php echo $parking['parking']['id'];?>" class="btn btn-info">
                              <i class="fa fa-edit"></i>
                            </a>
                            <?php endif; ?>
                            <?php if(in_array('viewParking', $userPermission)): ?>   
                            <a href="edit-parking.php?parking-id=<?php echo $parking['parking']['id'];?>" class="btn btn-primary">
                              <i class="fa fa-eye"></i>
                            </a>
                            <?php endif; ?>
                            <?php if(in_array('deleteParking', $userPermission)): ?>
                            <a href="?change-status=delete&&id=<?php echo $parking['parking']['id'];?>" class="btn btn-danger">
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
                    <th>Parking code</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Vehicle Type</th>
                    <th>Vehicle Name</th>
                    <th>Rate Name</th>
                    <th>Rate</th>
                    <th>Slot</th>
                    <th>Total Time</th>
                    <th>Total Amount</th>
                    <th>Status</th>
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
  <script type="text/javascript">

    function printParking(parking_url)
    {
      $.ajax({
        url: parking_url,
        type: 'get',
        success:function(response) {

          var mywindow = window.open('', '', 'height=400,width=600');

          mywindow.document.write(response);


          mywindow.document.close(); // necessary for IE >= 10
          mywindow.focus(); // necessary for IE >= 10*/

          mywindow.print();
          


        }
      })
    }
  </script>
  <?php
  include_once "inc/footer.php";
?>