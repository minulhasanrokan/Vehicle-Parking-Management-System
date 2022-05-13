<?php
	
	$dataTable = 1;
	
	include_once 'lib/Database.php';
	include_once 'helpers/Format.php';

	include_once 'classes/Category.php';
	include_once 'classes/Slot.php';
	include_once 'classes/Rate.php';
	include_once 'classes/Parking.php';

	include_once 'classes/Company.php';

class Report{

	public $database;
	public $dataFormat;

	public $category;
	public $slot;
	public $rate;
	public $parking;
	public $company;

	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();

		$this->category = new Category();
		$this->slot = new Slot();
		$this->rate = new Rate();
		$this->parking = new Parking();

		$this->company = new Company();
	}

	// get report year...
	public function get_report_year(){
		
		$parkingData = $this->parking->get_all_paid_parking_data();
		
		$return_data = array();

		if ($parkingData) {
			foreach ($parkingData as $k => $v) {
				$date = date('Y', $v['in_time']);
				$return_data[] = $date;
			}
		}


		$return_data = array_unique($return_data);

		return $return_data;
		
	}

	// get data by year
	public function get_parking_report_by_year($year){

		$parking_data = $this->parking->get_parking_data_by_year($year);

		$final_parking_data = array();

		foreach ($parking_data as $k => $v) {
			if(count($v) > 1) {
				$total_amount_earned = array();
				foreach ($v as $k2 => $v2) {
					if($v2) {
						$total_amount_earned[] = $v2['total_amount'];
						
					}
				}
				$final_parking_data[$k] = array_sum($total_amount_earned);	
			}
			else {
				$final_parking_data[$k] = 0;	
			}
			
		}

		return $final_parking_data;
	}

}