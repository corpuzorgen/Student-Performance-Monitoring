<?php 
	session_start();
	if($_SESSION['parentUsername']){
	session_destroy();	
	header("Location: parent-portal.php");
	}
	elseif($_SESSION['facultyUsername']){
	session_destroy();	
	header("Location: portal-signin.php");
	}elseif($_SESSION['adminEmployeeId']){
	session_destroy();	
	header("Location: admin/index.php");	
	}

?>