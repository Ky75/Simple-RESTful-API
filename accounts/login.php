<?php

namespace login {
	// to prevent anyone from reaching this file by the browser or whatever else...
	$urlLen = (strpos($_SERVER['REQUEST_URI'], '?')) ? strpos($_SERVER['REQUEST_URI'], '?') : strlen($_SERVER['PHP_SELF']);

	$url = substr($_SERVER['REQUEST_URI'], 0, $urlLen);
	if ($_SERVER['PHP_SELF'] == $url) {
		header("HTTP/1.1 404 Not Found");
		die();
	}
	//our preparition ends here


	/**
	 * Login to The database
	 */
	class login
	{
		
		/*** @param string   $username = (client username)
		*
		* 	 @param string   $password = (client password)
		*
		* 	 @param func..   $conn = (our database connnetion) ***/

		public function login($username, $password, $conn)
		{
			// check if the username was empty

			if (!$username) {
				// throw a new error
				throw new \Exception("Error: username must not be empty", 1);
				exit();

				// check if the password was empty
			} elseif (!$password) {
				// throw a new error
				throw new \Exception("Error: password must not be empty", 1);
				exit();
			}

			// if the client passed the test then make a SELECT query

			$login = $conn->connection->prepare("SELECT * FROM users WHERE username='$username'");

			// execute our query
			$login->execute();

			// fetch all of the results
			$result = $login->fetchAll();

			// check if the user existed
			if (count($result) <= 0) {
				// throw a new error
				throw new \Exception("Error: username undifined", 1);
				exit();
			}

			// get every single item...
			foreach ($result as $key)
			{
				// then matcing it with the client pasword
				if ($key['password'] == $password) {

					// if it passed then return true
					return true;
				} else {
					// if didn't pass then throw a new error
					throw new \Exception("Error: the password was incorrect", 1);
					exit();
				} 
				
			}
		}
	}
}