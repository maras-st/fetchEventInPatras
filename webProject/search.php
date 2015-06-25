<?php 

	header('Content-type: text/html; charset=utf-8');
	include_once( 'connToDB.php' );

	//take user's entry
	$search = mysqli_real_escape_string($conn, $_POST['search']); 
	//$search = "TEDX";    

	//make the query
	$sql = "SELECT * FROM eventsData WHERE (name LIKE '%".$search."%' OR dateNtime LIKE '%".$search."%')"; 
	$retval = mysqli_query($conn, $sql); 

	//make sure that the query was successful
	if(!$retval)
	{
		die('Could not get data: ' . mysql_error());
	} 

	//check if the search was successful send the response
	if ($search) {
		while($row = mysqli_fetch_assoc($retval)){
		     $arr[] = $row;  
		}  

		echo '{"search":'.json_encode($arr).'}';

	} else {
		echo "Wrong Input";
	}

	//close the DB connection
	$conn->close();

?>