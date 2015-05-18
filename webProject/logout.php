<?php
	session_start();

	// remove all session variables
	session_unset();

	// destroy the session
	session_destroy(); 

	//if(session_destroy()) // Destroying All Sessions
	//{
		$myfile = fopen("search.txt", "w") or die("Unable to open file!");
	    $txt = $_SESSION['username'];
	    fwrite($myfile, $txt);
	    fclose($myfile);
		header("Location: index.html"); // Redirecting To Home Page
	//}
?>