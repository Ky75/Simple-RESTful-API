<?php

namespace mainAPI {
	// to prevent anyone from reaching this file by the browser or whatever else...
	$urlLen = (strpos($_SERVER['REQUEST_URI'], '?')) ? strpos($_SERVER['REQUEST_URI'], '?') : strlen($_SERVER['PHP_SELF']);

	$url = substr($_SERVER['REQUEST_URI'], 0, $urlLen);
	if ($_SERVER['PHP_SELF'] == $url) {
		header("HTTP/1.1 404 Not Found");
		die();
	}
	//our preparition ends here

	
	// require our packges
	require 'packges.php';

	// our database and packges
	use config\connectDB;
	use login\login;
	use register\register;

	/**
	 * our Main class
	 */
	class mainAPI
	{
		// connecting to the database
		function __construct() {
			$this->conn = new connectDB('localhost', 'test', 'root', '');
		}


		/*** @param string   $username = (client username)
		*
		* 	 @param string   $password = (client password) ***/

		public function login($username, $password) 
		{
			// importing our login
			$login = new login;
			return $login->login($username, $password, $this->conn);
		}

		/*** @param string   $username = (client username)
		*
		*	 @param string   $email = (cilent email)
		*
		* 	 @param string   $password = (client password) ***/

		public function register($username, $email, $password) 
		{
			// importing our register
			$register = new register;
			return $register->register($username, $email, $password, $this->conn);
		}

	}
}