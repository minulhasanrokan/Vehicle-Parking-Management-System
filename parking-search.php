<?php

include_once "classes/Parking.php";

$parking = new Parking();

if(isset($_GET['parking-value'])){

	$parkingValue = $_GET['parking-value'];

	$parkingData = $parking->parking_search($parkingValue);

	if ($parkingData) {
		while($parking = mysqli_fetch_assoc($parkingData)){

			echo "<a href='edit-parking?parking-id=".$parking['id']."' target='_blank'>".$parking['vehicle_name']."</a>";
		}
	}
	else{
		echo $response="No Parking Data Found!!!";
	}
}
else{
	echo $response="No Parking Data Found!!!";
}