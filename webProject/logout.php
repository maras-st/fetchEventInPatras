<?php
	session_start();

	// remove all session variables
	session_unset();

	// destroy the session
	session_destroy(); 

	//if(session_destroy()) // Destroying All Sessions
	//{
		header("Location: index.html"); // Redirecting To Home Page
	//}
?>