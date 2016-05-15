<?php
	session_start();
	include 'connection.php';
	error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
	$adminnamesession = $_SESSION['adminEmployeeId'];
	$facultyusernamesession = $_SESSION['facultyUsername'];
	$parentnamesession = $_SESSION['parentUsername'];
	mysqli_select_db($conn, 'orgencor_ccsmartkidz');

	//Admin Message
	$recipient= $_POST["recipient"];
	$subject= $_POST["subject"];
	$message_content= $_POST["message_content"];
	//Get convo
	$getconvoadmin= $_POST["getconvoadmin"];
	//Admin reply
	$adminreply= $_POST["adminreply"];
	$adminreplyto= $_POST["adminreplyto"];
	//Faculty Message
	$recipientforfaculty= $_POST["recipientforfaculty"];
	$subjectforfaculty= $_POST["subjectforfaculty"];
	$message_contentforfaculty= $_POST["message_contentforfaculty"];
	//Faculty reply
	$facultyreply= $_POST["facultyreply"];
	$facultyreplyto= $_POST["facultyreplyto"];
	//Get convo faculty
	$getconvofaculty= $_POST["getconvofaculty"];

	//Get convo parent
	$getconvoparent= $_POST["getconvoparent"];
	//parent reply
	$parentreply= $_POST["parentreply"];
	$parentreplyto= $_POST["parentreplyto"];
	//Parent Message
	$recipientforparent= $_POST["recipientforparent"];
	$subjectforparent= $_POST["subjectforparent"];
	$message_contentforparent= $_POST["message_contentforparent"];





	//Admin reply
	if(isset($adminreply)){
		$insertadminreply = "INSERT INTO messages (from_id, to_id, msg_content) VALUES ('$adminnamesession','$adminreplyto','$adminreply')";
		if(mysqli_query($conn, $insertadminreply)){
			echo "true";
		}
		$updatelatestmessagereplyadmin = "UPDATE latestmessage SET msg_content = '$adminreply' WHERE from_id='$adminnamesession' AND to_id='$adminreplyto'";
			mysqli_query($conn, $updatelatestmessagereplyadmin);
	}
	//Admin get convo
	if(isset($getconvoadmin)){
		$selectconvoadmin = "SELECT * FROM messages WHERE from_id='$adminnamesession' AND to_id='$getconvoadmin' || to_id='$adminnamesession' AND from_id='$getconvoadmin'";
		$resultconvoadmin = mysqli_query($conn, $selectconvoadmin);	
			if (mysqli_num_rows($resultconvoadmin) > 0) {
			    // output data of each row
			    while($rowconvoadmin = mysqli_fetch_assoc($resultconvoadmin)) {
			    	if( $rowconvoadmin["from_id"] == $adminnamesession){
			    		echo "<li class='collection-item right-align'><span class='senders-msg'>".$rowconvoadmin["msg_content"]."</span></li>";
			    	}
			    	if( $rowconvoadmin["from_id"] == $getconvoadmin ){
			    		echo "<li class='collection-item '><span class='recipient-msg'>".$rowconvoadmin["msg_content"]."</span></li>";
			    	}
			    }
			}
	}
	//Admin New Message
	if( isset($recipient, $subject, $message_content) ){
		$insertmesgadmin = "INSERT INTO messages (from_id, to_id, msg_subject, msg_content) VALUES ('$adminnamesession','$recipient','$subject','$message_content')";
		if(mysqli_query($conn, $insertmesgadmin)){
			echo "true";
		}
		$selectlatestmsg = "SELECT * FROM latestmessage WHERE from_id='$adminnamesession' AND to_id='$recipient'";
		$resultlatestmsg = mysqli_query($conn, $selectlatestmsg);
		if (mysqli_num_rows($resultlatestmsg) > 0) {
		    $updatelatestmessageadmin = "UPDATE latestmessage SET msg_content = '$message_content' WHERE from_id='$adminnamesession' AND to_id='$recipient'";
			mysqli_query($conn, $updatelatestmessageadmin);
		} else {
		    $insertlatestmsgadmin = "INSERT INTO latestmessage (from_id, to_id, msg_content) VALUES ('$adminnamesession','$recipient','$message_content')";
		    mysqli_query($conn, $insertlatestmsgadmin);
		}
		
	}

	//Faculty get convo
	if(isset($getconvofaculty)){
		$selectconvofaculty = "SELECT * FROM messages WHERE from_id='$facultyusernamesession' AND to_id='$getconvofaculty' || to_id='$facultyusernamesession' AND from_id='$getconvofaculty'";
		$resultconvofaculty = mysqli_query($conn, $selectconvofaculty);	
			if (mysqli_num_rows($resultconvofaculty) > 0) {
			    // output data of each row
			    while($rowconvofaculty = mysqli_fetch_assoc($resultconvofaculty)) {
			    	if( $rowconvofaculty["from_id"] == $facultyusernamesession){
			    		echo "<li class='collection-item right-align'><span class='senders-msg'>".$rowconvofaculty["msg_content"]."</span></li>";
			    	}
			    	if( $rowconvofaculty["from_id"] == $getconvofaculty ){
			    		echo "<li class='collection-item '><span class='recipient-msg'>".$rowconvofaculty["msg_content"]."</span></li>";
			    	}
			    }
			}
	}

	//Faculty reply
	if(isset($facultyreply)){
		$insertfacultyreply = "INSERT INTO messages (from_id, to_id, msg_content) VALUES ('$facultyusernamesession','$facultyreplyto','$facultyreply')";
		if(mysqli_query($conn, $insertfacultyreply)){
			echo "true";
		}
		$updatelatestmessagereplyfaculty = "UPDATE latestmessage SET msg_content = '$facultyreply' WHERE from_id='$facultyusernamesession' AND to_id='$facultyreplyto'";
			mysqli_query($conn, $updatelatestmessagereplyfaculty);
	}

	//Faculty New Message
	if( isset($recipientforfaculty, $subjectforfaculty, $message_contentforfaculty) ){
		$insertmesgfaculty = "INSERT INTO messages (from_id, to_id, msg_subject, msg_content) VALUES ('$facultyusernamesession','$recipientforfaculty','$subjectforfaculty','$message_contentforfaculty')";
		if(mysqli_query($conn, $insertmesgfaculty)){
			echo "true";
		}
		$selectlatestmsgfaculty = "SELECT * FROM latestmessage WHERE from_id='$facultyusernamesession' AND to_id='$recipientforfaculty'";
		$resultlatestmsgfaculty = mysqli_query($conn, $selectlatestmsgfaculty);
		if (mysqli_num_rows($resultlatestmsgfaculty) > 0) {
		    $updatelatestmessagefaculty = "UPDATE latestmessage SET msg_content = '$message_contentforfaculty' WHERE from_id='$facultyusernamesession' AND to_id='$recipientforfaculty'";
			mysqli_query($conn, $updatelatestmessagefaculty);
		} else {
		    $insertlatestmsgfaculty = "INSERT INTO latestmessage (from_id, to_id, msg_content) VALUES ('$facultyusernamesession','$recipientforfaculty','$message_contentforfaculty')";
		    mysqli_query($conn, $insertlatestmsgfaculty);
		}
		
	}

	//Parent get convo
	if(isset($getconvoparent)){
		$selectconvoparent = "SELECT * FROM messages WHERE from_id='$parentnamesession' AND to_id='$getconvoparent' || to_id='$parentnamesession' AND from_id='$getconvoparent'";
		$resultconvoparent = mysqli_query($conn, $selectconvoparent);	
			if (mysqli_num_rows($resultconvoparent) > 0) {
			    // output data of each row
			    while($rowconvoparent = mysqli_fetch_assoc($resultconvoparent)) {
			    	if( $rowconvoparent["from_id"] == $parentnamesession){
			    		echo "<li class='collection-item right-align'><span class='senders-msg'>".$rowconvoparent["msg_content"]."</span></li>";
			    	}
			    	if( $rowconvoparent["from_id"] == $getconvoparent ){
			    		echo "<li class='collection-item '><span class='recipient-msg'>".$rowconvoparent["msg_content"]."</span></li>";
			    	}
			    }
			}
	}
	//Parent reply
	if(isset($parentreply)){
		$insertparentreply = "INSERT INTO messages (from_id, to_id, msg_content) VALUES ('$parentnamesession','$parentreplyto','$parentreply')";
		if(mysqli_query($conn, $insertparentreply)){
			echo "true";
		}
		$updatelatestmessagereplyparent = "UPDATE latestmessage SET msg_content = '$parentreply' WHERE from_id='$parentnamesession' AND to_id='$parentreplyto'";
			if(mysqli_query($conn, $updatelatestmessagereplyparent)){
				echo "true";
			}
	}

	//Parent New Message
	if( isset($recipientforparent, $subjectforparent, $message_contentforparent) ){
		$insertmesgparent = "INSERT INTO messages (from_id, to_id, msg_subject, msg_content) VALUES ('$parentnamesession','$recipientforparent','$subjectforparent','$message_contentforparent')";
		if(mysqli_query($conn, $insertmesgparent)){
			echo "true";
		}
		$selectlatestmsgparent = "SELECT * FROM latestmessage WHERE from_id='$parentnamesession' AND to_id='$recipientforparent'";
		$resultlatestmsgparent = mysqli_query($conn, $selectlatestmsgparent);
		if (mysqli_num_rows($resultlatestmsgparent) > 0) {
		    $updatelatestmessageparent = "UPDATE latestmessage SET msg_content = '$message_contentforparent' WHERE from_id='$parentnamesession' AND to_id='$recipientforparent'";
			mysqli_query($conn, $updatelatestmessageparent);
		} else {
		    $insertlatestmsgparent = "INSERT INTO latestmessage (from_id, to_id, msg_content) VALUES ('$parentnamesession','$recipientforparent','$message_contentforparent')";
		    mysqli_query($conn, $insertlatestmsgparent);
		}
		
	}





	mysqli_close($conn);

?>