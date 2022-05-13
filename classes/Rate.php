<?php
	
	$dataTable = 1;
	
	include_once 'lib/Database.php';
	include_once 'helpers/Format.php';

class Rate{

	public $database;
	public $dataFormat;

	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	// add new rate 

	public function add_new_rate($data){

		if (!empty($data['rate_name']) && !empty($data['parking_category']) && !empty($data['rate_type']) && !empty($data['rate_price']) && !empty($data['rate_status'])) {

			$rateName = $this->dataFormat->data_validation($data['rate_name']);
			$parkingCategory = $this->dataFormat->data_validation($data['parking_category']);
			$rateType = $this->dataFormat->data_validation($data['rate_type']);
			$ratePrice = $this->dataFormat->data_validation($data['rate_price']);
			$rateStatus = $this->dataFormat->data_validation($data['rate_status']);

			if(($rateType==1 || $rateType==2) && ($rateStatus==0 || $rateStatus==1)){

				$getRateQuery = "SELECT * FROM parking_rate WHERE rate_name='$rateName'";

				$getRate= $this->database->select($getRateQuery);

				if ($getRate>'0') {
				
				$meassage = "This Parking rate Already In Database!!";
				return $meassage;
				}
				else{

					$insertRateQuery ="INSERT INTO parking_rate(rate_name,parking_category,rate_type,rate_price,rate_status) VALUES ('$rateName',$parkingCategory,$rateType,$ratePrice,$rateStatus)";

					$insertRate= $this->database->insert($insertRateQuery);

					if ($insertRate) {
						$meassage = "New Parking Created Succesfully";
						return $meassage;
					}
					else{
						$meassage = "Something Went Wrong, Please Contact With Administator!!";
						return $meassage;
					}
				}
			}
			else{
				$meassage = "Rate Type And Status Fiels Must Not Be Empty!!";
				return $meassage;
			}
	    }
	    else{
	      $meassage = "input Fiels Must Not Be Empty!!";
	      return $meassage;
	    }
	}

	// get all rate data

	public function get_all_rate_data(){

		$getRateQuery = "SELECT * FROM parking_rate";

		$getRate= $this->database->select($getRateQuery);

		if ($getRate>'0') {
		
			return $getRate;
		}
	}

	// active rate status 

	public function active_rate_status($rateId){

		$updateRateStatusQuery = "UPDATE parking_rate SET rate_status=1 WHERE id=$rateId";

		$updateRateStatus= $this->database->update($updateRateStatusQuery);

		if ($updateRateStatus) {

			$message ="Vechile Parking Rate Ativated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// deactive rate status 

	public function deactive_rate_status($rateId){

		$updateRateStatusQuery = "UPDATE parking_rate SET rate_status=0 WHERE id=$rateId";

		$updateRateStatus= $this->database->update($updateRateStatusQuery);

		if ($updateRateStatus) {

			$message ="Vechile Parking Rate Detivated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// delete rate with parking data
	public function delete_rate($rateId){

		$rateId = $rateId;

		$deleteRate = "DELETE FROM parking_rate WHERE id=$rateId";

		$deleteRate= $this->database->delete($deleteRate);

		if ($deleteRate) {

			$errorMassage ="Vechile Parking Rate Deleted Succesfully!!!";
			return $errorMassage;
		}
		else{

			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// get single rate data

	public function get_single_rate_data($rateId){

		$getRateQuery = "SELECT * FROM parking_rate WHERE id=$rateId";

		$getRate= $this->database->select($getRateQuery);

		if ($getRate>'0') {
		
			return $getRate;
		}
	}

	// update parking rate 

	public function update_rate($data,$rateId){

		if (!empty($data['rate_name']) && !empty($data['parking_category']) && !empty($data['rate_type']) && !empty($data['rate_price']) && !empty($data['rate_status'])) {

			$rateName = $this->dataFormat->data_validation($data['rate_name']);
			$parkingCategory = $this->dataFormat->data_validation($data['parking_category']);
			$rateType = $this->dataFormat->data_validation($data['rate_type']);
			$ratePrice = $this->dataFormat->data_validation($data['rate_price']);
			$rateStatus = $this->dataFormat->data_validation($data['rate_status']);

			if(($rateType==1 || $rateType==2) && ($rateStatus==0 || $rateStatus==1)){


				$getRateQuery = "SELECT * FROM parking_rate WHERE rate_name='$rateName' AND id!=$rateId";

				$getRate= $this->database->select($getRateQuery);

				if ($getRate>'0') {
					
					$meassage = "This Parking Rate Name Already In Another Parking Rate!!";
					return $meassage;
				}
				else{

					$updateRateQuery = "UPDATE parking_rate SET rate_name='$rateName', parking_category=$parkingCategory, rate_type=$rateType, rate_price=$ratePrice, rate_status=$rateStatus WHERE id=$rateId";

					$updateRate= $this->database->update($updateRateQuery);

					if ($updateRate) {
						$meassage = "Vehocle Parking Rate Updated Succesfully";
						return $meassage;
					}
					else{
						$meassage = "Something Went Wrong, Please Contact With Administator!!";
						return $meassage;
					}
				}
				
			}
			else{
				$meassage = "Rate Type And Status Fiels Must Not Be Empty!!";
				return $meassage;
			}
	    }
	    else{
	      $meassage = "input Fiels Must Not Be Empty!!";
	      return $meassage;
	    }
	}

	// get rate by category

	public function get_rate_by_category($categoryId){

		$getRateQuery = "SELECT * FROM parking_rate WHERE parking_category=$categoryId AND rate_status=1";

		$getRate= $this->database->select($getRateQuery);

		if ($getRate>'0') {
			return $getRate;
		}
	}
}