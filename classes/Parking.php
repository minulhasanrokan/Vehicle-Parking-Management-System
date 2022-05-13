<?php
	
	$dataTable = 1;
	
	include_once 'lib/Database.php';
	include_once 'helpers/Format.php';
	include_once 'helpers/Barcode.php';

	include_once 'classes/Category.php';
	include_once 'classes/Slot.php';
	include_once 'classes/Rate.php';

	include_once 'classes/Company.php';

class Parking{

	public $database;
	public $dataFormat;

	public $category;
	public $slot;
	public $rate;
	public $company;

	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();

		$this->category = new Category();
		$this->slot = new Slot();
		$this->rate = new Rate();

		$this->company = new Company();
	}

	// add new parking

	public function add_new_parking($data){
		
		if (!empty($data['vehicle_name']) && !empty($data['vehicle_licence']) && !empty($data['vehicle_user_name']) && !empty($data['vehicle_user_mobile']) && !empty($data['vehicle_category']) && !empty($data['vehicle_parking_slot']) && !empty($data['vehicle_parking_rate']) && $data['vehicle_category']>=0 && $data['vehicle_parking_slot']>=0 && $data['vehicle_parking_rate']>=0) {

			$vehicleName = $this->dataFormat->data_validation($data['vehicle_name']);
			$vehicleLicence = $this->dataFormat->data_validation($data['vehicle_licence']);
			$vehicleUserName = $this->dataFormat->data_validation($data['vehicle_user_name']);
			$vehicleUserMobile = $this->dataFormat->data_validation($data['vehicle_user_mobile']);
			$vehicleCategory = $this->dataFormat->data_validation($data['vehicle_category']);
			$vehicleParkingSlot = $this->dataFormat->data_validation($data['vehicle_parking_slot']);
			$vehicleParkingRate = $this->dataFormat->data_validation($data['vehicle_parking_rate']);

			$parkingCode = strtoupper('pa-'.substr(md5(uniqid(mt_rand(), true)), 0, 6));

			$inTime = strtotime('now');

			$insertParkingQuery = "INSERT INTO tbl_parking(parking_code, vehicle_name, vehicle_licence, vehicle_user_name, vehicle_user_mobile, vechile_cat_id, rate_id, slot_id, in_time) VALUES('$parkingCode', '$vehicleName', '$vehicleLicence', '$vehicleUserName', '$vehicleUserMobile', $vehicleCategory, $vehicleParkingSlot, $vehicleParkingRate, '$inTime')";

			$insertParking= $this->database->insert($insertParkingQuery);

			if ($insertParking==true) {
				
				$updateSlotStatusQuery = "UPDATE tbl_slots SET availability_status=2 WHERE id=$vehicleParkingSlot";

				$updateSlotStatus= $this->database->update($updateSlotStatusQuery);

				if($updateSlotStatus==true){

					$meassage = "New Car Parking Created Succesfully!!!";
	      			return $meassage;
				}
				else{
					$meassage = "Something Went Wrong!!!";
	      			return $meassage;
				}
			}
			else{
				
				$meassage = "Something Went Wrong!!!";
	      		return $meassage;
			}

		}
		else{
			$meassage = "Parking input Fiels Must Not Be Empty!!";
	      	return $meassage;
		}
	}

	// get all parking data

	public function get_all_parking_data(){

		$getParkingQuery = "SELECT * FROM tbl_parking";

		$getParking= $this->database->select($getParkingQuery);

		$result = array();

		$key = 0;
		
		if($getParking){

			while($parking = mysqli_fetch_assoc($getParking)){
				
				$result[$key]['parking'] = $parking;
				
				$categoryData = $this->category->get_single_category_data($parking['vechile_cat_id']);
				$categoryData = mysqli_fetch_assoc($categoryData);
				
				$slotData = $this->slot->get_single_slot_data($parking['slot_id']);
				$slotData = mysqli_fetch_assoc($slotData);
				
				$rateData = $this->rate->get_single_rate_data($parking['rate_id']);
				$rateData = mysqli_fetch_assoc($rateData);
				
				$result[$key]['category'] = $categoryData;
				$result[$key]['slot'] = $slotData;
				$result[$key]['rate'] = $rateData;

				$key++;
			}
			$parkingData = $result;

			return $parkingData;
		}
	}

	// delete parking data
	public function delete_parking($parkingId){

		$parkingId = $parkingId;

		$getSlotIdQuery = "SELECT * FROM tbl_parking WHERE id=$parkingId";

		$getSlotId= $this->database->select($getSlotIdQuery);

		$slotId = mysqli_fetch_array($getSlotId);

		$slotId =$slotId['slot_id'];

		$deleteParking = "DELETE FROM tbl_parking WHERE id=$parkingId";

		$deleteParking= $this->database->delete($deleteParking);

		if ($deleteParking) {

			$updateSlotStatusQuery = "UPDATE tbl_slots SET availability_status=1 WHERE id=$slotId";

			$updateSlotStatus= $this->database->update($updateSlotStatusQuery);

			if ($updateSlotStatus) {
				
				$message ="Parking Deleted Succesfully";
				return $message;
			}
			else{
				$errorMassage ="Something Wrong!!!";
				return $errorMassage;
			}
		}
		else{

			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// get single parking data

	public function get_single_parking_data($parkingId){

		if($parkingId) {
			
			$singleParkingQuery = "SELECT * FROM tbl_parking WHERE id =$parkingId";
			
			$singleParking= $this->database->select($singleParkingQuery);

			if($singleParking>'0'){
				return $singleParking;
			}
		}
	}

	// print parking invoice

	public function get_parking_invoice_data($parkingId){

		if($parkingId) {
			
			$parking_data = $this->get_single_parking_data($parkingId);

			
			$parking_data = mysqli_fetch_array($parking_data);

			//$company_info = $this->model_company->getCompanyData(1);

			// get the vehicle type 
			$vehicle_category = $this->category->get_single_category_data($parking_data['vechile_cat_id']);

			$vehicle_category = mysqli_fetch_array($vehicle_category);

			// parking slor data

			$parkingSlot = $this->slot->get_single_slot_data($parking_data['slot_id']);


			$parkingSlot = mysqli_fetch_array($parkingSlot);


			// parking rate data

			$parkingRate = $this->rate->get_single_rate_data($parking_data['rate_id']);


			$parkingRate = mysqli_fetch_array($parkingRate);



			$check_in_date = date("Y-m-d", $parking_data['in_time']);
			$check_in = date("h:i a", $parking_data['in_time']);

			if($parking_data['out_time']){
				$check_out_date = date("Y-m-d", $parking_data['out_time']);
				$check_out	 = date("h:i a", $parking_data['out_time']);
			}
			else{
				$check_out_date='';
				$check_out ='';
			}

			

			if($parking_data['paid_status']==1){

				$paidStatus = "PAID";
				$color ="green";
			}
			else{
				$paidStatus = "UNPAID";
				$color ="red";
			}



			// company info
			$companyInfo=$this->company->get_company_info();

			$companyInfo = mysqli_fetch_array($companyInfo);


			$html = '<style>
		    .invoice-box {
		        max-width: 400px;
		        margin: auto;
		        padding: 30px;
		        border: 1px solid #eee;
		        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
		        font-size: 16px;
		        line-height: 24px;
		        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
		        color: #555;
		    }

		    .invoice-box table {
		        width: 100%;
		        line-height: inherit;
		        text-align: left;
		    }

		    .invoice-box table td {
		        padding: 5px;
		        vertical-align: top;
		    }

		    .invoice-box table tr td:nth-child(2) {
		        text-align: right;
		    }

		    .invoice-box table tr.top table td {
		        padding-bottom: 0px;
		    }

		    .invoice-box table tr.top table td.title {
		        font-size: 45px;
		        line-height: 45px;
		        color: #333;
		    }

		    .invoice-box table tr.information table td {
		        padding-bottom: 10px;
		    }

		    .invoice-box table tr.heading td {
		        background: #eee;
		        border-bottom: 1px solid #ddd;
		        font-weight: bold;
		    }

		    .invoice-box table tr.details td {
		        padding-bottom: 10px;
		    }

		    .invoice-box table tr.item td {
		        border-bottom: 1px solid #eee;
		    }

		    .invoice-box table tr.item.last td {
		        border-bottom: none;
		    }

		    .invoice-box table tr.total td:nth-child(2) {
		        font-weight: bold;
		    }

		    @media only screen and (max-width: 600px) {
		        .invoice-box table tr.top table td {
		            width: 100%;
		            display: block;
		            text-align: center;
		        }

		        .invoice-box table tr.information table td {
		            width: 100%;
		            display: block;
		            text-align: center;
		        }
		    }

		    /** RTL **/
		    .rtl {
		        direction: rtl;
		        font-family: Tahoma, "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
		    }

		    .rtl table {
		        text-align: right;
		    }

		    .rtl table tr td:nth-child(2) {
		        text-align: left;
		    }
		</style>

		<div>
		    
		    <div style="border-width: 6px;border-style: solid; border-color: '.$color.';border-radius: 8px; color: '.$color.'; opacity:0.6; position: absolute; z-index: 1; left:30%; top:35%; font-size: 60pt;-webkit-transform: rotate(-45deg);-ms-transform: rotate(-45deg);transform: rotate(-45deg); font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;">
		    '.$paidStatus.' </div>
		    
		    <div class="invoice-box">
		        <table cellpadding="0" cellspacing="0">
		            <tr class="top">
		            <td colspan="">
		                    <table>
		                        <tr>
		                            
		                            <td>
		                                <img style="width:120px;" src="uploads/'.$companyInfo['company_logo'].'"/>
		                            </td>
		                        </tr>
		                    </table>
		                </td>
		                <td colspan="">
		                    <table>
		                        <tr>
		                            <td class="title">
		                            </td>
		                            <td>
		                                Parking No #: '.$parking_data['parking_code'].'<br>
		                                Parking Date: '.$check_in_date.'<br>
		                                Parking Time: '.$check_in.'
		                            </td>
		                        </tr>
		                    </table>
		                </td>
		            </tr>

		            <tr class="information">
		                <td colspan="2">
		                    <table>
		                        <tr>     
		                            <td colspan="2" style="text-align:center">
		                                Name: '.$parking_data['vehicle_user_name'].'<br>
		                                Mobile: '.$parking_data['vehicle_user_mobile'].'
		                            </td>
		                        </tr>
		                    </table>
		                </td>
		            </tr>
		            <tr class="heading">
		                <td colspan="2" style="text-align:center">
		                    Parking Details
		                </td>
		            </tr>
		            <tr class="item">
		                <td>
		                   Vehicle Type :
		                </td>
		                <td>
		                    '.$vehicle_category['vechile_category_name'].'
		                </td>
		            </tr>

		            <tr class="item">
		                <td>
		                   Vehicle Name :
		                </td>
		                <td>
		                    '.$parking_data['vehicle_name'].'
		                </td>
		            </tr>

		            <tr class="item">
		                <td>
		                   Vehicle Licence :
		                </td>
		                <td>
		                    '.$parking_data['vehicle_licence'].'
		                </td>
		            </tr>

		            <tr class="item">
		                <td>
		                   Parking Slot :
		                </td>
		                <td>
		                    '.$parkingSlot['slot_name'].'
		                </td>
		            </tr>

		            <tr class="item">
		                <td>
		                   Parking Rate Type :
		                </td>
		                <td>
		                    '.$parkingRate['rate_name'].'
		                </td>
		            </tr>
		            <tr class="item">
		                <td>
		                   Parking Rate :
		                </td>
		                <td>
		                    '.$parkingRate['rate_price'].'
		                </td>
		            </tr>


		            <tr class="item">
		                <td>
		                   Parking In Time :
		                </td>
		                <td>
		                    '.$check_in_date.' / '.$check_in.'
		                </td>
		            </tr>
		      		
		      		<tr class="item">
		                <td>
		                   Parking Out Time :
		                </td>
		                <td>
		                    '.$check_out_date.' / '.$check_out.'
		                </td>
		            </tr>

		            <tr class="total">
		                <td></td>
		                <td>
		                    Total: '.$companyInfo['company_currency'].' '.$parking_data['total_amount'].'/-
		                </td>
		            </tr>

		            <tr>
			            <td style="text-align:center" colspan="2">
			            
			                '.$companyInfo['company_name'].'<br>
			                '.$companyInfo['company_address'].'
			            </td>
		            </tr>
		            <tr class="">
		                <td style="text-align:center; color: red" colspan="2">
		                    '.$companyInfo['company_message'].'
		                </td>
		            </tr>
		            
		        </table>
		    </div>
		</div>';
			echo $html;
		}
	}

	// change status to paid 
	public function paid_parking($parkingId){
		
		// get the data of parking data
		$parkingData = $this->get_single_parking_data($parkingId);

		$parkingData = mysqli_fetch_array($parkingData);
		
		$check_in_time = $parkingData['in_time'];
		$rate_id = $parkingData['rate_id'];
		$slot_id = $parkingData['slot_id'];

		$checkout_time = strtotime('now');

		// calculates the time by hourly
		$total_time = ceil((abs($checkout_time - $check_in_time) / 60) / 60);

		$parkingRate = $this->rate->get_single_rate_data($rate_id);

		$parkingRate = mysqli_fetch_array($parkingRate);

		$totalAmount = 0;

		if($parkingRate['rate_type'] == 1) {
			// means hourly
			$totalAmount = ((int) $parkingRate['rate_price'] * (int) $total_time);					
		}
		else {
			$totalAmount = $parkingRate['rate_price'];
		}

		$updateParkingQuery = "UPDATE tbl_parking SET out_time='$checkout_time', paid_status=1, total_time='$total_time', total_amount=$totalAmount WHERE id=$parkingId";

		$updateParking= $this->database->update($updateParkingQuery);

		if ($updateParking) {
			$updateSlotStatusQuery = "UPDATE tbl_slots SET availability_status=1 WHERE id=$slot_id";

				$updateSlotStatus= $this->database->update($updateSlotStatusQuery);
		}
		else{
			$meassage = "Something Went Wrong!!!";
	      	return $meassage;
		}

	}

	// get all paid parking data

	public function get_all_paid_parking_data(){

		$getParkingQuery = "SELECT * FROM tbl_parking WHERE paid_status=1";

		$parkingData= $this->database->select($getParkingQuery);
		
		if($parkingData>'0'){
			return $parkingData;
		}
	}

	// get parking data by year

	public function get_parking_data_by_year($year)
	{	
		if($year) {
			$months = $this->months();
			
			$getParkingQuery = "SELECT * FROM tbl_parking WHERE paid_status =1";
			
			$parkingData= $this->database->select($getParkingQuery);

			$final_data = array();
			if ($parkingData) {
				foreach ($months as $month_k => $month_y) {
					$get_mon_year = $year.'-'.$month_y;	
					$final_data[$get_mon_year][] = '';
					foreach ($parkingData as $k => $v) {
						$month_year = date('Y-m', $v['in_time']);

						if($get_mon_year == $month_year) {
							$final_data[$get_mon_year][] = $v;
						}
					}
				}
			}

			 return $final_data;
			
		}
	}

	private function months()
	{
		return array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
	}

	// get all unpaid parking

	public function get_all_unpaid_parking(){

		$getParkingQuery = "SELECT * FROM tbl_parking WHERE paid_status!=1";

		$parkingData= $this->database->select($getParkingQuery);
		
		if($parkingData>'0'){
			return $parkingData;
		}
	}

	// parking search
	public function parking_search($parkingValue){

		$getParkingQuery = "SELECT * FROM tbl_parking WHERE paid_status!=1 AND (vehicle_licence='$parkingValue' OR parking_code='$parkingValue')";

		$parkingData= $this->database->select($getParkingQuery);
		
		if($parkingData>'0'){
			return $parkingData;
		}
	}

	// update to unpaid parking
	public function un_paid_parking($parkingId){


		$updateParkingQuery = "UPDATE tbl_parking SET out_time=null, paid_status=0, total_time=null, total_amount=null WHERE id=$parkingId";

		$updateParking= $this->database->update($updateParkingQuery);

		if ($updateParking) {
			$meassage = "Parking unpaid Succesfully!!!";
	      	return $meassage;
		}
		else{
			$meassage = "Something Went Wrong!!!";
	      	return $meassage;
		}

	}
}