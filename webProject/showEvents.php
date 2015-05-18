<?php

	include_once("connToDB.php");


	$sql_fetch = " SELECT name,place,owner_name,description FROM eventsData ; ";

	

	$retval = mysqli_query($conn, $sql_fetch);
	
	if(! $retval )
	{
	  die('Could not get data: ' . mysql_error());
	}

	while($row = mysqli_fetch_assoc($retval))
	{
	     //echo "ID :" . $row['id'] ." <br> " . "NAME :" . $row['name'] . "<br> " ;
	     //$row = mysqli_fetch_assoc($retval);
	     $arr[] = $row;
         
	} 
	echo '{"members":'.json_encode($arr).'}';
	//echo json_encode($data);
	//echo " \n\nFetched data successfully\n\n";
	//$array = mysqli_fetch_row($retval);
	$conn->close();

?>