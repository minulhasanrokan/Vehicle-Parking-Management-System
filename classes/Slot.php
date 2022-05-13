<?php
	
	$dataTable = 1;
	
	include_once 'lib/Database.php';
	include_once 'helpers/Format.php';

class Slot{

	public $database;
	public $dataFormat;


	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	// add new slot 
	public function add_slot_category($data){

		$slotName = $this->dataFormat->data_validation($data['slot_name']);

		$slotCategory = $this->dataFormat->data_validation($data['category']);

		$slotStatus = $this->dataFormat->data_validation($data['slot_status']);

		if($slotStatus==0 || $slotStatus==1){

			$getSlotQuery = "SELECT * FROM tbl_slots WHERE slot_name='$slotName'";

			$getSlot= $this->database->select($getSlotQuery);

			if ($getSlot>'0') {
				
				$meassage = "This Slot Already In Database!!";
				return $meassage;
			}
			else{

				$insertSlotQuery ="INSERT INTO tbl_slots(slot_name, slot_category,slot_status) VALUES ('$slotName', '$slotCategory',$slotStatus)";

				$insertSlot= $this->database->insert($insertSlotQuery);

				if ($insertSlot) {
					$meassage = "New Slot Created Succesfully";
					return $meassage;
				}
				else{
					$meassage = "Something Went Wrong, Please Contact With Administator!!";
					return $meassage;
				}
			}
		}
		else{
			$meassage = "Slot Name And Status Fiels Must Not Be Empty!!";
			return $meassage;
		}
	}

	// get all slot data

	public function get_all_slot_data(){
		$getSlotQuery = "SELECT * FROM tbl_slots";

		$getSlot= $this->database->select($getSlotQuery);

		if ($getSlot>'0') {
			return $getSlot;
		}
	}

	// active slot status 

	public function active_slot_status($slotId){

		$updateSlotStatusQuery = "UPDATE tbl_slots SET slot_status=1 WHERE id=$slotId";

		$updateSlotStatus= $this->database->update($updateSlotStatusQuery);

		if ($updateSlotStatus) {

			$message ="Vechile Parking Slot Ativated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// deactive slot status 

	public function deactive_slot_status($slotId){

		$updateSlotStatusQuery = "UPDATE tbl_slots SET slot_status=0 WHERE id=$slotId";

		$updateSlotStatus= $this->database->update($updateSlotStatusQuery);

		if ($updateSlotStatus) {

			$message ="Vechile Parking Slot Deativated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// delete slot with parking data
	public function delete_slot($slotId){

		$slotId = $slotId;

		$deleteSlot = "DELETE FROM tbl_slots WHERE id=$slotId";

		$deleteSlot= $this->database->delete($deleteSlot);

		if ($deleteSlot) {

			$errorMassage ="Vechile Parking Slot Deleted Succesfully!!!";
			return $errorMassage;
		}
		else{

			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// get single slot data

	public function get_single_slot_data($slotId){

		$getSlotQuery = "SELECT * FROM tbl_slots WHERE id=$slotId";

		$getSlot= $this->database->select($getSlotQuery);

		if ($getSlot>'0') {
			return $getSlot;
		}
	}

	// update slot data

	public function update_slot($data,$slotId){

		$slotName = $this->dataFormat->data_validation($data['slot_name']);

		$slotStatus = $this->dataFormat->data_validation($data['slot_status']);

		$slotId = $slotId;

		if($slotStatus==0 || $slotStatus==1){

			$getSlotQuery = "SELECT * FROM tbl_slots WHERE slot_name='$slotName' AND id!=$slotId";

			$getSlot= $this->database->select($getSlotQuery);

			if ($getSlot>'0') {
				
				$meassage = "This Slot Name Already In Another parking Slot!!";
				return $meassage;
			}
			else{

				$updateSlotQuery = "UPDATE tbl_slots SET slot_name='$slotName', slot_status=$slotStatus WHERE id=$slotId";

				$updateSlot= $this->database->update($updateSlotQuery);

				if ($updateSlot) {
					$meassage = "Vehicle Slot Updated Succesfully";
					return $meassage;
				}
				else{
					$meassage = "Something Went Wrong, Please Contact With Administator!!";
					return $meassage;
				}
			}
		}
		else{
			$meassage = "Slot Name And Status Fiels Must Not Be Empty!!";
			return $meassage;
		}
	}

	// get slot by category

	public function get_slot_by_category($categoryId){

		$getSlotQuery = "SELECT * FROM tbl_slots WHERE slot_category=$categoryId AND availability_status=1  AND slot_status=1";

		$getSlot= $this->database->select($getSlotQuery);

		if ($getSlot>'0') {
			return $getSlot;
		}
	}

	// get all active slot

	public function get_all_available_active_slot(){

		$getSlotQuery = "SELECT * FROM tbl_slots WHERE availability_status=1 AND slot_status=1";

		$getSlot= $this->database->select($getSlotQuery);

		if ($getSlot>'0') {
			return $getSlot;
		}
	}
}