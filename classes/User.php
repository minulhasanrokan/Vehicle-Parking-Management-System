<?php
	
	$dataTable = 1;
	
	include_once 'lib/Database.php';
	include_once 'helpers/Format.php';

class User{

	public $database;
	public $dataFormat;

	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	// add new user 
	public function add_new_user($data, $file){

		$userName = $this->dataFormat->data_validation($data['user_name']);
		$userName = str_replace(' ','',$userName);
		$firstName = $this->dataFormat->data_validation($data['user_f_name']);
		$lastName = $this->dataFormat->data_validation($data['user_l_name']);
		$email = $this->dataFormat->data_validation($data['email']);
		$phone = $this->dataFormat->data_validation($data['phone']);
		$password = md5($this->dataFormat->data_validation($data['password']));
		$CofirmPassword = md5($this->dataFormat->data_validation($data['c_password']));
		$gender = $this->dataFormat->data_validation($data['gender']);
		$group_id = $this->dataFormat->data_validation($data['user_group']);


		if($file['image']['name']!=null){

			$file_name = $file['image']['name'];
		    $file_size =$file['image']['size'];
	        $file_tmp =$file['image']['tmp_name'];
		    $file_type=$file['image']['type'];

		    $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

		    $imageName =$userName.substr(md5(time()),0,10).'.'.$file_ext;

		    $imageName = str_replace(' ','-',$imageName);

		    $filePath = 'uploads/user/'.$imageName;

		      
		    $extensions= array("jpeg","jpg","png");

		    if(in_array($file_ext,$extensions)=== false){
         		
         		$meassage="extension not allowed, please choose a jpeg ,jpg or png file.";

         		return $meassage;
		    }
		    elseif($file_size > 2097152){
		        
		        $meassage='File size must be excately 2 MB';
		        return $meassage;
		    }
		    else{

		    	if(!empty($userName) || !empty($firstName) || !empty($lastName) || !empty($email) || !empty($phone) || !empty($password) || !empty($CofirmPassword) || !empty($gender) || !empty($group_id)){

		    		if ($password==$CofirmPassword){

		    			$getUserQuery = "SELECT * FROM tbl_user WHERE email='$email' OR phone='$phone' OR username='$userName'";

						$getUserQuery= $this->database->select($getUserQuery);

						if ($getUserQuery>'0') {
				
							$meassage = "This User Already In Database!!";
							return $meassage;
						}
						else{
							
							$fileUpload = move_uploaded_file($file_tmp, $filePath);
							
							if($fileUpload==true){

								$insertUserQuery ="INSERT INTO tbl_user(username, password, email, firstname, lastname, phone, image, gender, group_id) VALUES ('$userName','$password','$email','$firstName','$lastName', '$phone','$imageName', $gender, $group_id)";

								$insertUserQuery= $this->database->insert($insertUserQuery);

								if ($insertUserQuery) {
									$meassage = "New User Created Succesfully";
									return $meassage;
								}
								else{
									$meassage = "Something Went Wrong, Please Contact With Administator!!";
									return $meassage;
								}
							}
							else{
								
								$meassage = "Something Went Wrong When Uploading User Image";
								return $meassage;
							}
						}
		    		}
		    		else{
		    			
		    			$meassage = "Cofirm Password does Not Match, Please Try With Currect Password!!!";
		    			return $meassage;
		    		}
		    	}
		    	else{
		    		$meassage = "User Input Fiels Must Not Be Empty!!";
		    		return $meassage;
		    	}
		    }
		}
		else{

			if(!empty($userName) || !empty($firstName) || !empty($lastName) || !empty($email) || !empty($phone) || !empty($password) || !empty($CofirmPassword) || !empty($gender) || !empty($group_id)){

		    		if ($password==$CofirmPassword){

		    			$getUserQuery = "SELECT * FROM tbl_user WHERE email='$email' OR phone='$phone' OR username='$userName'";

						$getUserQuery= $this->database->select($getUserQuery);

						if ($getUserQuery>'0') {
				
							$meassage = "This User Already In Database!!";
							return $meassage;
						}
						else{
							
							$insertUserQuery ="INSERT INTO tbl_user(username, password, email, firstname, lastname, phone, gender, group_id) VALUES ('$userName','$password','$email','$firstName','$lastName', '$phone',$gender,$group_id)";

							$insertUserQuery= $this->database->insert($insertUserQuery);

							if ($insertUserQuery) {
								$meassage = "New User Created Succesfully";
								return $meassage;
							}
							else{
								$meassage = "Something Went Wrong, Please Contact With Administator!!";
								return $meassage;
							}
						}
		    		}
		    		else{
		    			
		    			$meassage = "Cofirm Password does Not Match, Please Try With Currect Password!!!";
		    			return $meassage;
		    		}
		    	}
		    	else{
		    		$meassage = "User Input Fiels Must Not Be Empty!!";
		    		return $meassage;
		    	}
		}
	}

	// get all user data
	public function get_all_user_data(){

		$getUserQuery = "SELECT * FROM tbl_user";

		$getUserQuery= $this->database->select($getUserQuery);

		if ($getUserQuery>'0') {
			return $getUserQuery;
		}
	}

	// active user status

	public function active_user_status($userId){

		$updateUserStatusQuery = "UPDATE tbl_user SET status=1 WHERE id=$userId";

		$updateUserStatus= $this->database->update($updateUserStatusQuery);

		if ($updateUserStatus) {

			$message ="User Ativated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// active user status

	public function deactive_user_status($userId){

		$updateUserStatusQuery = "UPDATE tbl_user SET status=0 WHERE id=$userId";

		$updateUserStatus= $this->database->update($updateUserStatusQuery);

		if ($updateUserStatus) {

			$message ="User Deativated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// delete User with user Data
	public function delete_user($userId){

		$userId = $userId;

		$getUserImageQuery = "SELECT image FROM tbl_user WHERE id=$userId";

		$getUserImage= $this->database->select($getUserImageQuery);

		$getUserImage = mysqli_fetch_assoc($getUserImage);

		if ($getUserImage==true) {
			
			$filePath = 'uploads/user/'.$getUserImage['image'];

			unlink($filePath);
		}

		$deleteUser = "DELETE FROM tbl_user WHERE id=$userId";

		$deleteUser= $this->database->delete($deleteUser);

		if ($deleteUser) {

			$message ="User Deleted Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// get single user data

	public function get_single_user_data($userId){

		$getUserQuery = "SELECT * FROM tbl_user WHERE id=$userId";

		$getUser= $this->database->select($getUserQuery);

		if ($getUser>'0') {
			
			return $getUser;
		}
	}
	// update user details

	public function update_user($data, $file,$userId){

		$firstName = $this->dataFormat->data_validation($data['user_f_name']);
		$lastName = $this->dataFormat->data_validation($data['user_l_name']);
		$email = $this->dataFormat->data_validation($data['email']);
		$phone = $this->dataFormat->data_validation($data['phone']);
		$password = md5($this->dataFormat->data_validation($data['password']));
		$CofirmPassword = md5($this->dataFormat->data_validation($data['c_password']));
		$gender = $this->dataFormat->data_validation($data['gender']);
		$group_id = $this->dataFormat->data_validation($data['user_group']);

		if($file['image']['name']!=null){

			$file_name = $file['image']['name'];
		    $file_size =$file['image']['size'];
	        $file_tmp =$file['image']['tmp_name'];
		    $file_type=$file['image']['type'];

		    $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);

		    $imageName =$userName.substr(md5(time()),0,10).'.'.$file_ext;

		    $imageName = str_replace(' ','-',$imageName);

		    $filePath = 'uploads/user/'.$imageName;

		      
		    $extensions= array("jpeg","jpg","png");

		    if(in_array($file_ext,$extensions)=== false){
         		
         		$meassage="extension not allowed, please choose a jpeg ,jpg or png file.";

         		return $meassage;
		    }
		    elseif($file_size > 2097152){
		        
		        $meassage='File size must be excately 2 MB';
		        return $meassage;
		    }
		    else{

		    	if(!empty($userName) || !empty($firstName) || !empty($lastName) || !empty($email) || !empty($phone) || !empty($password) || !empty($CofirmPassword) || !empty($gender) || !empty($group_id)){

		    		if ($password==$CofirmPassword){


		    			$getUserQuery = "SELECT * FROM tbl_user WHERE (email='$email' OR phone='$phone') AND id!=$userId";

						$getUser= $this->database->select($getUserQuery);

						if ($getUser>'0') {
							
							$meassage = "This User Email Or Phone Already In Another User!!";
							return $meassage;
						}
						else{

							$fileUpload = move_uploaded_file($file_tmp, $filePath);
						
							if($fileUpload==true){

								$getUserImageQuery = "SELECT image FROM tbl_user WHERE id=$userId";
								$getUserImage= $this->database->select($getUserImageQuery);

								$getUserImage = mysqli_fetch_assoc($getUserImage);

								if ($getUserImage==true) {
									
									$filePath = 'uploads/user/'.$getUserImage['image'];

									unlink($filePath);
								}
								$updateUserQuery = "UPDATE tbl_user SET password='$password', email='$email', firstname='$firstName', lastname='$lastName', phone='$phone', image='$imageName', gender=$gender, group_id=$group_id WHERE id=$userId";

								$updateUser= $this->database->update($updateUserQuery);

								$updateUser= $this->database->update($updateUserQuery);

								if ($updateUser) {
									$meassage = "User Details Updated Succesfully";
									return $meassage;
								}
								else{
									$meassage = "Something Went Wrong, Please Contact With Administator!!";
									return $meassage;
								}
							}
							else{
								
								$meassage = "Something Went Wrong When Uploading User Image";
								return $meassage;
							}
						}
						
		    		}
		    		else{
		    			
		    			$meassage = "Cofirm Password does Not Match, Please Try With Currect Password!!!";
		    			return $meassage;
		    		}
		    	}
		    	else{
		    		$meassage = "User Input Fiels Must Not Be Empty!!";
		    		return $meassage;
		    	}
		    }
		}
		else{

			if(!empty($userName) || !empty($firstName) || !empty($lastName) || !empty($email) || !empty($phone) || !empty($password) || !empty($CofirmPassword) || !empty($gender) || !empty($group_id)){

		    		if ($password==$CofirmPassword){
					
						$updateUserQuery = "UPDATE tbl_user SET password='$password', email='$email', firstname='$firstName', lastname='$lastName', phone='$phone', gender=$gender, group_id=$group_id WHERE id=$userId";

							$updateUser= $this->database->update($updateUserQuery);

						if ($updateUser) {
							$meassage = "Update User Details Succesfully";
							return $meassage;
						}
						else{
							$meassage = "Something Went Wrong, Please Contact With Administator!!";
							return $meassage;
						}
						
		    		}
		    		else{
		    			
		    			$meassage = "Cofirm Password does Not Match, Please Try With Currect Password!!!";
		    			return $meassage;
		    		}
		    	}
		    	else{
		    		$meassage = "User Input Fiels Must Not Be Empty!!";
		    		return $meassage;
		    	}
		}
	}
}