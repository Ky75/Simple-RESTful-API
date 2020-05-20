<?php

// to prevent anyone from reaching this file by the browser or whatever else...
$urlLen = (strpos($_SERVER['REQUEST_URI'], '?')) ? strpos($_SERVER['REQUEST_URI'], '?') : strlen($_SERVER['PHP_SELF']);

$url = substr($_SERVER['REQUEST_URI'], 0, $urlLen);
if ($_SERVER['PHP_SELF'] == $url) {
	header("HTTP/1.1 404 Not Found");
	die();
}
//our preparition ends here


/**
* config.php
**/
require 'config.php';

/**
* accounts\login.php
**/
require 'accounts\login.php';

/**
* accounts\register.php
**/
require 'accounts\register.php';
