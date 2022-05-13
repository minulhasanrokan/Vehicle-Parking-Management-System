<?php
	
	include_once 'config/config.php';
	include_once 'Session.php';

	Class Database{
		// database details...
		public $host = HOST;
		public $user = USER;
		public $pass = PASSWORD;
		public $database = DATABASE;

		public $link;
		public $error;

		public function __construct(){
			
			$this->dbConnect();
		}

		public function dbConnect(){
			
			$this->link = mysqli_connect($this->host, $this->user, $this->pass, $this->database);
			
			if (!$this->link) {
				
				$this->error = "Database Connecton Faild";
				return false;
			}
		}

		// select query
		public function select($query){

			$result  = mysqli_query($this->link,$query) or die($this->link->error.__LINE__);
			
			if (mysqli_num_rows($result)) {
				
				return $result;
			}
			else{
				
				return false;
			}
		}

		// insert query
		public function insert($query){

			$result  = mysqli_query($this->link,$query) or die($this->link->error.__LINE__);
			
			if ($result) {
				return $result;
			}
			else{
				
				return false;
			}
		}

		// update query
		public function update($query){

			$result  = mysqli_query($this->link,$query) or die($this->link->error.__LINE__);
			
			if ($result) {
				
				return $result;
			}
			else{
				
				return false;
			}
		}

		// delete query
		public function delete($query){

			$result  = mysqli_query($this->link,$query) or die($this->link->error.__LINE__);
			
			if ($result) {
				
				return $result;
			}
			else{
				
				return false;
			}
		}
	}