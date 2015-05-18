<?php

	$hostname="localhost"; //local server name default localhost
	$usernameDB="";  //mysql username default is root.
	$passwordDB="";       
	$database="webProjectDB";  //database name which you created

	$error=''; // Variable To Store Error Message
	
	
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$conn = mysqli_connect($hostname,$usernameDB,$passwordDB);

  	//mysqli_set_charset('utf8', $conn);
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}	
	//echo "Connected successfully \n";

	// Selecting Database
	$db = mysqli_select_db($conn, $database);


?>
