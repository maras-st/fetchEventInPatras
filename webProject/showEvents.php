<?php

	include_once("connToDB.php");

	//make the query
	$sql_fetch = " SELECT name,place,owner_name,description,dateNtime,cover_photo_url FROM eventsData ORDER BY dateNtime ; ";
	$retval = mysqli_query($conn, $sql_fetch);
	
	//make sure that the query was successful
	if(! $retval )
	{
	  die('Could not get data: ' . mysql_error());
	}

	//save the data to an array
	while($row = mysqli_fetch_assoc($retval))
	{
	     $arr[] = $row;
	} 

	//send the response
	echo '{"members":'.json_encode($arr).'}';
	
	//close the connection
	$conn->close();

?>