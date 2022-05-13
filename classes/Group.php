<?php
	
	$dataTable = 1;
	
	include_once 'lib/Database.php';
	include_once 'helpers/Format.php';

class Group{

	public $database;
	public $dataFormat;


	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	// add new group 
	public function add_new_group($groupName,$permission){

		$groupName = $this->dataFormat->data_validation($groupName);

		$permission = $permission;

		$permission = serialize($permission);


		if (empty($groupName) || empty($permission)) {
			$meassage = "Group Name And Premission Fiels Must Not Be Empty!!";
			return $meassage;
			
		}
		else{

			$getGroupQuery = "SELECT * FROM user_groups WHERE group_name='$groupName'";

			$getGroupQuery= $this->database->select($getGroupQuery);

			if ($getGroupQuery>'0') {
				
				$meassage = "This Group Already In Database!!";
				return $meassage;
			}
			else{

				$insertGroupQuery ="INSERT INTO user_groups(group_name,permission) VALUES ('$groupName','$permission')";

				$insertGroupQuery= $this->database->insert($insertGroupQuery);

				if ($insertGroupQuery) {
					$meassage = "New Group Created Succesfully";
					return $meassage;
				}
				else{
					$meassage = "Something Went Wrong, Please Contact With Administator!!";
					return $meassage;
				}
			}
			
		}
	}

	// get all active group data

	public function get_active_group_data(){

		$getGroupQuery = "SELECT * FROM user_groups WHERE status=1";

		$getGroupQuery= $this->database->select($getGroupQuery);

		if ($getGroupQuery>'0') {
			return $getGroupQuery;
		}
	}

	// get all group data
	public function get_all_group_data(){

		$getGroupQuery = "SELECT * FROM user_groups";

			$getGroupQuery= $this->database->select($getGroupQuery);

			if ($getGroupQuery>'0') {
				return $getGroupQuery;
			}
	}

	// active group status 

	public function active_group_status($groupId){

		$updateGroupStatusQuery = "UPDATE user_groups SET status=1 WHERE id=$groupId";

		$updateGroupStatus= $this->database->update($updateGroupStatusQuery);

		if ($updateGroupStatus) {

			$message ="Group Ativated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// in active group status 

	public function deactive_group_status($groupId){

		$updateGroupStatusQuery = "UPDATE user_groups SET status=0 WHERE id=$groupId";

		$updateGroupStatus= $this->database->update($updateGroupStatusQuery);

		if ($updateGroupStatus) {
			$message ="Group Deativated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// delete group with group user
	public function delete_group($groupId){

		$groupId = $groupId;

		$deleteGroup = "DELETE FROM user_groups WHERE id=$groupId";

		$deleteGroup= $this->database->delete($deleteGroup);

		if ($deleteGroup) {

			$deleteUser = "DELETE FROM tbl_user WHERE group_id=$groupId";

			$deleteUser= $this->database->delete($deleteUser);

			if ($deleteUser) {
				
				$message ="Group Deleted Succesfully";
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

	// get single group data
	public function get_single_group_data($groupId){
		
		$getGroupQuery = "SELECT * FROM user_groups WHERE id=$groupId";

		$getGroupQuery= $this->database->select($getGroupQuery);

		if ($getGroupQuery>'0') {
			return $getGroupQuery;
		}
	}

	// update group ...

	public function update_group($groupName,$permission,$groupId){

		$groupId = $groupId;

		$groupName = $this->dataFormat->data_validation($groupName);

		$permission = $permission;


		$permission = serialize($permission);


		if (empty($groupName) || empty($permission)) {
			$meassage = "Group Name And Premission Fiels Must Not Be Empty!!";
			return $meassage;
			
		}
		else{

			$getGroupQuery = "SELECT * FROM user_groups WHERE group_name='$groupName' AND id!=$groupId";

			$getGroupQuery= $this->database->select($getGroupQuery);

			if ($getGroupQuery>'0') {
				
				$meassage = "This Group Name Already In Another Group!!";
				return $meassage;
			}
			else{

				$updateGroupStatusQuery = "UPDATE user_groups SET group_name='$groupName', permission='$permission' WHERE id=$groupId";

				$updateGroupStatus= $this->database->update($updateGroupStatusQuery);

				if ($updateGroupStatus) {

					$message ="Group Permission Updated Succesfully";
					return $message;
				}
				else{
					$errorMassage ="Something Wrong!!!";
					return $errorMassage;
				}
			}
			
		}
	}
}