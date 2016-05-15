<?php
	
	$server = "localhost";
	$username = "orgencor_orgenco";
	$password = "ccsmartkidz";

	$conn = mysqli_connect($server, $username, $password);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

?>