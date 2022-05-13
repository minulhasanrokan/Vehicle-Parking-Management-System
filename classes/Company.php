<?php
	
	$dataTable = 1;
	
	include_once 'lib/Database.php';
	include_once 'helpers/Format.php';

class Company{

	public $database;
	public $dataFormat;

	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	// company info 
	public function company_info($data, $file){

		$companyName = $this->dataFormat->data_validation($data['company_name']);
		$companyAddress = $this->dataFormat->data_validation($data['company_address']);
		$companyMobile = $this->dataFormat->data_validation($data['company_mobile']);
		$companyEmail = $this->dataFormat->data_validation($data['company_email']);
		$companyWebsite = $this->dataFormat->data_validation($data['company_website']);
		$companyFacebook = $this->dataFormat->data_validation($data['company_facebook']);
		$companyYoutube = $this->dataFormat->data_validation($data['company_youtube']);
		$companyMessage = $this->dataFormat->data_validation($data['company_message']);
		$companyCurrency = $this->dataFormat->data_validation($data['company_currency']);

		$companyLogo = $file['company_logo'];

		if (empty($companyName) || empty($companyCurrency) || empty($companyAddress)) {
			$meassage = "Company Name, Company Address And Company Currency Fiels Must Not Be Empty!!";
			return $meassage;
		}
		else{
	   		
	   		$companyId = 1;
			$allow = array('jpg', 'jpeg', 'png');
		   	$exntension = explode('.', $companyLogo['name']);
		   	$fileActExt = strtolower(end($exntension));
		   	$fileName = str_replace(' ', '_', $companyName);
		   	$fileNew = $fileName."_".rand(10,999).".".$fileActExt;
		   	$filePath = 'uploads/'.$fileNew;

	   		if(empty($companyLogo['name'])){
	   			
	   			$updateCompanyQuery = "UPDATE tbl_company SET company_name='$companyName',company_address='$companyAddress',company_mobile='$companyMobile',company_email='$companyEmail',company_website='$companyWebsite',company_facebook='$companyFacebook',company_youtube='$companyYoutube',company_message='$companyMessage',company_currency='$companyCurrency' WHERE id=$companyId";

				$updateCompany= $this->database->update($updateCompanyQuery);

				if($updateCompany){
					$meassage = "Company Info Updated Succesfully";
  					return $meassage;
				}
				else{
					$meassage = "Company Not Updated Succesfully";
  					return $meassage;
				}
	   		}
	   		else{
	   			
	   			if (in_array($fileActExt, $allow)) {
		   			if ($companyLogo['size']>1048576) {
		   				$message = "Company Logo Must Not Be Greter Than 1 MB!!!";
	      	    		return $message;
		   			}
		   			else{
		   				$companyInfo = $this->get_company_info($companyId);

			   			$companyInfo = mysqli_fetch_array($companyInfo);

			   			$image = $companyInfo['company_logo'];

		   				$path = "uploads/".$image;
		   				if(unlink($path)==true){
		   					if (move_uploaded_file($companyLogo['tmp_name'], $filePath)){
		   				
				   				$updateCompanyQuery = "UPDATE tbl_company SET company_name='$companyName',company_address='$companyAddress',company_mobile='$companyMobile',company_email='$companyEmail',company_website='$companyWebsite',company_facebook='$companyFacebook',company_youtube='$companyYoutube',company_message='$companyMessage',company_currency='$companyCurrency',company_logo='$fileNew' WHERE id=$companyId";

								$updateCompany= $this->database->update($updateCompanyQuery);

								if($updateCompany){
									$meassage = "Company Info Updated Succesfully";
			      					return $meassage;
								}
								else{
									$meassage = "Company Not Updated Succesfully";
			      					return $meassage;
								}
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
			   	}
			   	else{
			   		$meassage = "Uploaded File Not Supported!!!";
	      			return $meassage;
			   	}
	   		}
	   	
		}

	}

	// get company info

	public function get_company_info(){

		$companyId = 1;
		if ($companyId) {
			
			$getCompanyInfoQuery = "SELECT * FROM tbl_company WHERE id=$companyId";

			$getCompanyInfo= $this->database->select($getCompanyInfoQuery);

			if ($getCompanyInfo>'0') {
				return $getCompanyInfo;
			}

		}
	}
}