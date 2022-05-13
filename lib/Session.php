<?php
	
	class Session{
		
		public static function initSession(){
			
			session_start();
		}

		public static function setSession($key, $value){
			
			$_SESSION[$key] = $value;
		}

		public static function getSession($key){
			
			if (isset($_SESSION[$key])) {
				
				return $_SESSION[$key];
			}
			else{
				return false;
			}
		}

		public static function loginCheck(){

			self::initSession();

			if (self::getSession('login')==true) {
				
				header('location:index.php');
			}
		}

		public static function checkSession(){

			self::initSession();

			if (self::getSession('login')==false) {
				self::destroySession();
			}

		}

		public static function checkSessionLogin(){


			if (self::getSession('login')==true) {
				header('location:index.php');
			}

		}

		public static function destroySession(){

			session_destroy();

			header('location:login.php');
		}
	}