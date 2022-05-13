<?php
	
	$dataTable = 1;
	
	include_once 'lib/Database.php';
	include_once 'helpers/Format.php';

class Category{

	public $database;
	public $dataFormat;

	public function __construct(){

		$this->database= new Database();
		$this->dataFormat= new Format();
	}

	// add new category 
	public function add_new_category($data){

		$categoryName = $this->dataFormat->data_validation($data['category_name']);

		$categoryStatus = $data['category_status'];

		if($categoryStatus==0 || $categoryStatus==1){

			$getCategoryQuery = "SELECT * FROM vechile_category WHERE vechile_category_name='$categoryName'";

			$getCategory= $this->database->select($getCategoryQuery);

			if ($getCategory>'0') {
				
				$meassage = "This Vechile Category Already In Database!!";
				return $meassage;
			}
			else{

				$insertCategoryQuery ="INSERT INTO vechile_category(vechile_category_name,vechile_category_status) VALUES ('$categoryName',$categoryStatus)";

				$insertCategory= $this->database->insert($insertCategoryQuery);

				if ($insertCategory) {
					$meassage = "New Vechile Category Created Succesfully";
					return $meassage;
				}
				else{
					$meassage = "Something Went Wrong, Please Contact With Administator!!";
					return $meassage;
				}
			}
		}
		else{
			$meassage = "Vechile Category Name And Status Fiels Must Not Be Empty!!";
			return $meassage;
		}
	}

	// get all category data

	public function get_all_category_data(){

		$getCategoryQuery = "SELECT * FROM vechile_category";

		$getCategory= $this->database->select($getCategoryQuery);

		if ($getCategory>'0') {
			return $getCategory;
		}
	}

	// active category status 

	public function active_category_status($categoryId){

		$updateCategoryStatusQuery = "UPDATE vechile_category SET vechile_category_status=1 WHERE vechile_category_id=$categoryId";

		$updateCategoryStatus= $this->database->update($updateCategoryStatusQuery);

		if ($updateCategoryStatus) {

			$message ="Vechile Category Ativated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// deactive category status
	public function deactive_category_status($categoryId){

		$updateCategoryStatusQuery = "UPDATE vechile_category SET vechile_category_status=0 WHERE vechile_category_id=$categoryId";

		$updateCategoryStatus= $this->database->update($updateCategoryStatusQuery);

		if ($updateCategoryStatus) {

			$message ="Vechile Category Deativated Succesfully";
			return $message;
		}
		else{
			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}


	// delete Category with parking data
	public function delete_category($categoryId){

		$categoryId = $categoryId;

		$deleteCategory = "DELETE FROM vechile_category WHERE vechile_category_id=$categoryId";

		$deleteCategory= $this->database->delete($deleteCategory);

		if ($deleteCategory) {

			$errorMassage ="Vechile Category Deleted Succesfully!!!";
			return $errorMassage;
		}
		else{

			$errorMassage ="Something Wrong!!!";
			return $errorMassage;
		}
	}

	// get single category data

	public function get_single_category_data($categoryId){

		$getCategoryQuery = "SELECT * FROM vechile_category WHERE vechile_category_id=$categoryId";

		$getCategory= $this->database->select($getCategoryQuery);

		if ($getCategory>'0') {
			return $getCategory;
		}
	}

	// update category data

	public function update_category($data,$categoryId){

		$categoryId = $categoryId;

		$categoryName = $this->dataFormat->data_validation($data['category_name']);

		$categoryStatus = $data['category_status'];

		if($categoryStatus==0 || $categoryStatus==1){


			$getCategoryQuery = "SELECT * FROM vechile_category WHERE vechile_category_name='$categoryName' AND vechile_category_id!=$categoryId";

			$getCategory= $this->database->select($getCategoryQuery);

			if ($getCategory>'0') {
				
				$meassage = "This Category Name Already In Another Category!!";
				return $meassage;
			}
			else{

				$updateCategoryQuery = "UPDATE vechile_category SET vechile_category_name='$categoryName', vechile_category_status=$categoryStatus WHERE vechile_category_id=$categoryId";

				$updateCategory= $this->database->update($updateCategoryQuery);

				if ($updateCategory) {

					$message ="Vechile Category Updated Succesfully";
					return $message;
				}
				else{
					$errorMassage ="Something Wrong!!!";
					return $errorMassage;
				}
			}

		}
		else{
			$meassage = "Vechile Category Name And Status Fiels Must Not Be Empty!!";
			return $meassage;
		}
	}

	// get active category data

	public function get_active_category_data(){

		$getCategoryQuery = "SELECT * FROM vechile_category WHERE vechile_category_status=1";

		$getCategory= $this->database->select($getCategoryQuery);

		if ($getCategory>'0') {
			return $getCategory;
		}
	}
}