<?php

namespace register {
	// to prevent anyone from reaching this file by the browser or whatever else...
	$urlLen = (strpos($_SERVER['REQUEST_URI'], '?')) ? strpos($_SERVER['REQUEST_URI'], '?') : strlen($_SERVER['PHP_SELF']);

	$url = substr($_SERVER['REQUEST_URI'], 0, $urlLen);
	if ($_SERVER['PHP_SELF'] == $url) {
		header("HTTP/1.1 404 Not Found");
		die();
	}
	//our preparition ends here


	/**
	 * Register class
	 */
	class register
	{
		/*** @param string   $username = (client username)
		*
		*	 @param string   $email = (cilent email)
		*
		* 	 @param string   $password = (client password)
		*
		* 	 @param func..   $conn = (our database connnetion) ***/

		public function register($username, $email, $password, $conn)
		{
			// registerition status
			$status = true;

			// filtering clinet's information
			if (!$this->filter($username, true, 4)) $status = false;
			if (!$this->filter($password, true, 8)) $status = false;

			if (!$this->checker($username, $conn)) $status = false;
			if (!$this->checker($email, $conn)) $status = false;

			// if the status was true

			if ($status) {
				// send the query
				$register = $conn->connection->prepare("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')");

				// execute it 
				$register->execute();

				return true;
			} else {
				return false;
			}

		}

		/*** @param string    $input = (the input to filter and check)
		*
		*	 @param boolean   $isRequired = (so it cann't be empty)
		*
		* 	 @param int       $length = (the minemium length) ***/

		protected function filter(string $input, bool $isRequired, int $length)
		{
			// check if its empty and required
			if (!strlen($input) && $isRequired) {
				throw new \Exception("Error: your username or password shouldn't be empty", 1);
				exit();
			}

			if (strlen($input) <= $length) {
				throw new \Exception("Error: your input '$input', should be longer than $length", 1);
				exit();
			}

			return true;
		}

		/*** @param string    $input = (the input to check the databasek)
		*
		* 	 @param func..    $conn = (our database connnetion) ***/

		protected function checker($input, $conn)
		{
			// checkin if [username / email] ware unavailabel

			$usercheck = $conn->connection->prepare("SELECT * FROM users WHERE username='$input'");

			// execute our query
			$usercheck->execute();

			// fetch all of the results
			$resultUser = $usercheck->fetchAll();

			if(count($resultUser)) {
				throw new \Exception("Error: your username is unavailabel", 1);
				exit();
			}

			// checkin if [username / email] ware unavailabel
			$emailcheck = $conn->connection->prepare("SELECT * FROM users WHERE email='$input'");

			// execute our query
			$emailcheck->execute();

			// fetch all of the results
			$resultEmail = $emailcheck->fetchAll();

			if(count($resultEmail)) {
				throw new \Exception("Error: your email was taken", 1);
				exit();
			}

			return true;
		}
	}
}








