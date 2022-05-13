<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once "classes/Slot.php";

  include_once "classes/Parking.php";

  $slot = new Slot();
  $parking = new Parking();

  $availableTotalSlot = $slot->get_all_available_active_slot();

  $allUnpaidParking = $parking->get_all_unpaid_parking();

  if ($availableTotalSlot) {
    $availableTotalSlot = mysqli_num_rows($availableTotalSlot);
  }
  else{
    $availableTotalSlot= 0;
  }


  if ($allUnpaidParking) {
    $allUnpaidParking = mysqli_num_rows($allUnpaidParking);
  }
  else{
    $allUnpaidParking= 0;
  }

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $availableTotalSlot;?></h3>
                <p>Total Available Parking Slot</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $allUnpaidParking;?></h3>
                <p>Total Parking</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div>
    </section>
  </div>
  <?php
  include_once "inc/footer.php";
?>