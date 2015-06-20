<?php

header('Content-type: text/html; charset=utf-8');
include_once( 'connToDB.php' );

$delete = mysqli_real_escape_string($conn, $_POST['deleteData']); 
//$delete = "Praktika tango club patras";    

$sql = "DELETE FROM eventsData WHERE name LIKE '%".$delete."%' "; 
$retval = mysqli_query($conn, $sql); 

$rowNum = mysqli_affected_rows($conn);

if(!$retval)
{
	die('Could not get data: ' . mysql_error());
} 

if($rowNum != 0) {
	echo '{"deleteData": 0 }';
	//die('Delete failed! ' . mysql_error());
	//echo "DELETE failed: $conn<br />" . 
    //mysql_error() . "<br /><br />";
} else if($rowNum == 0) {
	echo '{"deleteData": 1 }';
	//echo "DELETE succeed: $conn<br />";
}


$conn->close();

//refresh the events on the website
//include( 'showEvents.php' );

?>