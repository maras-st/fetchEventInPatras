<?php
	
	session_start(); // Starting Session

	require_once ('connToDB.php');	

	/*if (isset($_POST['Submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
		}
	}
	else
	{*/
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];


		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysqli_real_escape_string($username);
		$password = mysqli_real_escape_string($password);



	$hostname="localhost"; //local server name default localhost
	$usernameDB="root";  //mysql username default is root.
	$passwordDB="20/5/1993Mast";       
	$database="webProjectDB";  //database name which you created

	$error=''; // Variable To Store Error Message
	
	
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$connection = mysqli_connect($hostname,$usernameDB,$passwordDB);

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}	
		echo "Connected successfully";

		// Selecting Database
		$db = mysqli_select_db($database, $connection);


		// SQL query to fetch information of registerd users and finds user match.
		$query = mysqli_query("SELECT * FROM users WHERE username='$username' AND password='$password'; ", $connection);
		$rows = mysqli_num_rows($query);
		print_r($rows);

		if ($rows > 0) {
			//$_SESSION['login_user']=$username; // Initializing Session
			//header("location: panel.html"); // Redirecting To Other Page
		} else {
			$error = "Username or Password is invalid";
			//header("location: error.html");
		}
		mysqli_close($connection); // Closing Connection
	//}
?>
