<?php

	header('Content-type: text/html; charset=utf-8');
	include_once( 'connToDB.php' );

	//take user's entry
	$delete = mysqli_real_escape_string($conn, $_POST['deleteData']); 
	//$delete = "Praktika tango club patras";    

	//make the query
	$sql = "DELETE FROM eventsData WHERE name LIKE '%".$delete."%' "; 
	$retval = mysqli_query($conn, $sql); 
	//check if any row changed after the query
	$rowNum = mysqli_affected_rows($conn);

	//make sure that the query was succesful
	if(!$retval)
	{
		die('Could not get data: ' . mysql_error());
	} 

	//send the response
	if($rowNum != 0) {
		echo '{"deleteData": 0 }';
	} else if($rowNum == 0) {
		echo '{"deleteData": 1 }';
	}

	//close the DB connection
	$conn->close();

?>