<?php

namespace config {
	// to prevent anyone from reaching this file by the browser or whatever else...
	$urlLen = (strpos($_SERVER['REQUEST_URI'], '?')) ? strpos($_SERVER['REQUEST_URI'], '?') : strlen($_SERVER['PHP_SELF']);

	$url = substr($_SERVER['REQUEST_URI'], 0, $urlLen);
	if ($_SERVER['PHP_SELF'] == $url) {
		header("HTTP/1.1 404 Not Found");
		die();
	}
	//our preparition ends here
	

	/**
	 * Connection with our database
	 */
	class connectDB
	{
		
		function __construct($host, $daba, $user, $pass)
		{
			$this->connection = new \PDO("mysql:host=$host;dbname=$daba", $user, $pass);
		}
	}
}
