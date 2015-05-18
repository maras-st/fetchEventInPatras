<?php 

header('Content-type: text/html; charset=utf-8');
include_once( 'connToDB.php' );



$search = mysqli_real_escape_string($conn, $_POST['search']); 
//$search = "TEDX";    


$sql = "SELECT * FROM eventsData WHERE name LIKE '%".$search."%'"; 
$retval = mysqli_query($conn, $sql); 


if(!$retval)
{
	die('Could not get data: ' . mysql_error());
} 


if ($search) {

	while($row = mysqli_fetch_assoc($retval)){
	     $arr[] = $row;  
	}  

	echo '{"search":'.json_encode($arr).'}';

} else {
	echo "Wrong Input";
}

$conn->close();

?>