<?php
	
	session_start(); // Starting Session

	require_once ('connToDB.php');	
	ob_start(); //just to fix a buffer error

	// Define $username and $password
	$username=$_POST['username'];
	$password=$_POST['password'];

	// To protect MySQL injection for Security purpose
	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = mysqli_real_escape_string($conn, $username);
	$password = mysqli_real_escape_string($conn, $password);


	if (isset($_POST['Submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";

		}
	}
	
	
	$error=''; // Variable To Store Error Message
	
	// SQL query to fetch information of registerd users and finds user match.
	$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'; ");
	$arr = mysqli_fetch_array($query);
	//print_r('Yeah:' . $arr['username']);

	$_SESSION['username']=$arr['username'];
	print_r($_SESSION['username']);

	if ($arr > 0) {
		$_SESSION['username']=$arr['username']; // Initializing Session
		header('location: panel.html'); // Redirecting To Other Page
	} else {
		$error = "Username or Password is invalid";
		header("location: index.html");
	}
	mysqli_close($conn); // Closing Connection	
	
?>
