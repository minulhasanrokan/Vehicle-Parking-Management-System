 <?php

  include_once 'classes/Parking.php';



  $parking = new Parking();


  if (isset($_GET['parking-id'])) {

    $parkingId = $_GET['parking-id'];

    $getParking = $parking->get_parking_invoice_data($parkingId);
  } 

?>