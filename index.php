<?php

require 'main.php';

// importing our main php file...
use mainAPI\mainAPI;


// calling our class
$api = new mainAPI;

// try to log in
try {
	//if success ... then ...
	$result = $api->login('dvesceffe', 'dddddssdd');
} catch (Exception $e) {
	//if failed ... then show our error message
	$result = $e->getMessage();
}

//rsponse
print_r($result);

header("HTTP/1.1 404 Not Found");