<?php
	//session_start(); // Starting Session

	$hostname="localhost"; //local server name default localhost
	$usernameDB="root";  //mysql username default is root.
	$passwordDB="20/5/1993Mast";       
	$database="webProjectDB";  //database name which you created

	$error=''; // Variable To Store Error Message
	if (isset($_POST['Submit'])) {
		if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
		}
	}
	else
	{
		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];

		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect($hostname,$usernameDB,$passwordDB);

		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);

		// Selecting Database
		$db = mysql_select_db($database, $connection);

		// SQL query to fetch information of registerd users and finds user match.
		$query = mysql_query("select * from users where password='$password' AND username='$username';", $connection);
		$rows = mysql_num_rows($query);

		if ($rows > 0) {
			//$_SESSION['login_user']=$username; // Initializing Session
			header("location: panel.html"); // Redirecting To Other Page
		} else {
			$error = "Username or Password is invalid";
		}
		mysql_close($connection); // Closing Connection
	}
	<p> Hey </p>
?>