<?php

	include_once 'lib/Session.php';
	Session::initSession();
	Session::checkSessionLogin();
	
	include_once 'lib/Database.php';
	include_once 'helpers/Format.php';

	include_once 'classes/Register.php';

	include_once 'classes/Group.php';

	class Login{

		private $database;
		private $dataFormat;
	 
		public function __construct(){

			$this->database= new Database();
			$this->dataFormat= new Format();
		}


		public function check_Login($email, $password){

			$email = $this->dataFormat->data_validation($email);
			$password = $this->dataFormat->data_validation($password);

			if (empty($email) || empty($password)) {
				$meassage = "User Email and Password Must Not Be Empty";
	      		return $meassage;
			}
			else{

				$loginQuery = "SELECT * FROM tbl_user WHERE email ='$email' AND password ='$password'";

				$loginQuery= $this->database->select($loginQuery);

				if ($loginQuery) {

					$userRow = mysqli_fetch_assoc($loginQuery);

					$userStatus = $userRow['user_v_status'];

					$email = $userRow['email'];

					$userId = $userRow['id'];

					$groupId = $userRow['group_id'];

					$group = new Group();

					$groupData = $group->get_single_group_data($groupId);

					if ($groupData) {
	                  	while ($group = mysqli_fetch_assoc($groupData)) {

		                    $permission = $group['permission'];
		                    
		                    $permission = unserialize($permission);
	                	}
	                }
	                $permission = $permission;
					if ($userStatus==1) {

						Session::setSession('login', true);

						Session::setSession('userStatus', $userStatus);

						Session::setSession('email', $email);

						Session::setSession('userId', $userId);

						Session::setSession('permission', $permission);

						header('location:index.php');
					}
					else{

						$name = $userRow['firstname'].' '.$userRow['lastname'];
						$email = $userRow['email'];
						$userVToken = $userRow['user_v_token'];

						$verifyUser = new Register();

						$verifyUser->send_user_verify_email($name, $email, $userVToken);

						$message = "This Email Not Verified Please verify this email and try again. To Verify Your Email Please Check your Email Box";
	      				return $message;
					}
				}
				else{
					$meassage = "Wrong User Email Or Password. Please Try With Write User name Name Password.";
      				return $meassage;
				}
			}
		}
	}