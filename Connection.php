<?php
	//1. Create a database connection
	$dbhost = "localhost:8889";
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "fest";
	$dbport = "3389";
	$dbsock = '';
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	//Test if connection occured.
	if(mysqli_connect_errno())
	{
		die("Database connection failed: " . 
			mysqli_connect_error() . 
			" (" . mysqli_connect_errno() . ")" 
		);
	}
	//echo "Connected";
?>
