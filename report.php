<?php
  include_once "inc/header.php";
  include_once "inc/sidebar.php";

  include_once "classes/Report.php";

  $report = new Report();

  if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="POST"){

      $seletctYear = $_POST['select_year'];

      $parkingReport = $report->get_parking_report_by_year($seletctYear);

      $reportYear = $report->get_report_year();
  }
  else{
    
    $thisYear = date('Y');
    
    $parkingReport = $report->get_parking_report_by_year($thisYear);

    $reportYear = $report->get_report_year();
  }


?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <form class="form-inline" action="" method="POST">
            <div class="form-group">
              <label for="date">Year</label> 
              <select class="form-control" name="select_year" id="select_year">
                  <?php
                    foreach($reportYear as $year){
                  ?>
                  <option <?php if (isset($seletctYear)) {
                    if ($seletctYear==$year) {
                      echo "selected";
                    }
                  }
                  else{
                    if ($thisYear==$year) {
                      echo "selected";
                    }

                  }?> value="<?php echo $year ?>"><?php echo $year ?></option>
                <?php }?>
              </select>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12 col-xs-12">

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="chart">
                <canvas id="myChart" style="height:350px !important; width:100%;"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <!-- /.content -->
  </div>
    <script>
      var report_data = <?php echo '[' . implode(',', $parkingReport) . ']'; ?>;
      var xValues = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

      var barColors = ["red", "green","blue","orange","brown", "red", "green","blue","orange","brown" , "red", "green",];
      new Chart("myChart", {
        type: "bar",
        data: {
          labels: xValues,
          datasets: [{
backgroundColor: barColors,
          data: report_data
          }]
        },
        options: {
          legend: {display: false},
          title: {
            display: true,
            text: "Total Parking - Report of <?php if (isset($seletctYear)){ echo $seletctYear;}else{ echo $year;}?>"
          }
        }
      });
      </script>

  <?php
  include_once "inc/footer.php";
?>