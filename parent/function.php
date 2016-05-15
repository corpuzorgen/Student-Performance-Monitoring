<?php
	session_start();
	include '../connection.php';
	error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
	$adminnamesession = $_SESSION['adminEmployeeId'];
	$facultyusernamesession = $_SESSION['facultyUsername'];
	$parentnamesession = $_SESSION['parentUsername'];
	mysqli_select_db($conn, 'orgencor_ccsmartkidz');

	$data           	   				= array(); 


	//parent Update account info
	$parent_new_pass= $_POST["parent_new_pass"];
	//parent update basic info 
	$parent_firstname= $_POST["parent_firstname"];
	$parent_middlename= $_POST["parent_middlename"];
	$parent_lastname= $_POST["parent_lastname"];
	$parent_gender= $_POST["parent_gender"];
	$parent_dob= $_POST["parent_dob"];
	$parent_address= $_POST["parent_address"];
	//parent update contact info
	$parent_position= $_POST["parent_position"];
	$parent_email= $_POST["parent_email"];
	$parent_phone= $_POST["parent_phone"];
	
	$studentidtoget= $_POST["studentidtoget"];
	$studentidatt= $_POST["studentidatt"];
	$month= $_POST["month"];
	$studentmonth= $_POST["studentmonth"];
	$subjectval= $_POST["subjectval"];
	$subjectstudent= $_POST["subjectstudent"];
	//Fetch contacts
	$keyword_parent= $_POST["keyword_parent"];
	//parent delete message
	$delmsgparent= $_POST["delmsgparent"];

	if(isset($delmsgparent)){

		$deleteparentmsg = "DELETE FROM messages WHERE from_id = '$parentnamesession' AND to_id = '$delmsgparent' || from_id = '$delmsgparent' AND to_id = '$parentnamesession'";
		$deleteparentltmsg = "DELETE FROM latestmessage WHERE from_id = '$parentnamesession' AND to_id = '$delmsgparent' || from_id = '$delmsgparent' AND to_id = '$parentnamesession'";
		if(mysqli_query($conn, $deleteparentmsg) && mysqli_query($conn, $deleteparentltmsg)){
			$data["delmsgparet"] = true;
		}
		
	}

	if(isset($keyword_parent)){

		$selectfromfacultyusers = "SELECT * FROM faculty_account WHERE employee_id LIKE '%".$_POST['keyword_parent']."%' OR firstname LIKE '%".$_POST['keyword_parent']."%' OR middlename LIKE '%".$_POST['keyword_parent']."%' OR lastname LIKE '%".$_POST['keyword_parent']."%' OR email LIKE '%".$_POST['keyword_parent']."%' LIMIT 0,5";
		$resultfromfacultyusers = mysqli_query($conn, $selectfromfacultyusers);
		if(mysqli_num_rows($resultfromfacultyusers) > 0){
			
			while($rowfromfacultyusers = mysqli_fetch_assoc($resultfromfacultyusers)) {
				if($rowfromfacultyusers["employee_id"] != $facultyusernamesession){
					$fullname = $rowfromfacultyusers["firstname"]." ".$rowfromfacultyusers["middlename"]." ".$rowfromfacultyusers["lastname"];
					$contactsforfaculty[] = "<li class='item' id='parentcon".$rowfromfacultyusers["employee_id"]."'>".$fullname."</li>";
				}
			}

		}else{
			$data["keywords_parent"] = "<li>No Records Found!</li>";
		}
		$selectfromadminusers = "SELECT * FROM admin WHERE employee_id LIKE '%".$_POST['keyword_parent']."%' OR firstname LIKE '%".$_POST['keyword_parent']."%' OR middlename LIKE '%".$_POST['keyword_parent']."%' OR lastname LIKE '%".$_POST['keyword_parent']."%' OR email LIKE '%".$_POST['keyword_parent']."%' LIMIT 0,5";
		$resultfromadminusers = mysqli_query($conn, $selectfromadminusers);
		$rowfromadminusers = mysqli_fetch_assoc($resultfromadminusers);
		$fullname = $rowfromadminusers["firstname"]." ".$rowfromadminusers["middlename"]." ".$rowfromadminusers["lastname"];
		$contactsforfaculty[] = "<li class='item' id='parentcon".$rowfromadminusers["employee_id"]."'>".$fullname."</li>";

		$data["keywords_parent"] = $contactsforfaculty;
	}



	//Attendance Month
	if(isset($month,$studentmonth)){
		$selectdatafrommonth = "SELECT * FROM attendance WHERE attendance_month = '$month' AND attendance_student_id = '$studentmonth' ";
		$resultdatafrommonth = mysqli_query($conn, $selectdatafrommonth);
		$rowdatafrommonth = mysqli_fetch_assoc($resultdatafrommonth);
		$data["present"] = intval($rowdatafrommonth['days_present']);
		$data["late"] = intval($rowdatafrommonth['days_late']);
		$data["absent"] = intval($rowdatafrommonth['days_absent']);
	}

	//Attendance
	if(isset($studentidatt)){

		$selectattendance = "SELECT * FROM attendance WHERE attendance_student_id = '$studentidatt'";
		$resultattendance = mysqli_query($conn, $selectattendance);
		if (mysqli_num_rows($resultattendance) > 0) {
			while ( $rowgrades = mysqli_fetch_assoc($resultattendance) ) {
				
				$attendancemonth[] = "<p class='monthline'><input name='month' class='monthselect' type='radio' id='".$rowgrades["attendance_month"]."' value = '".$rowgrades["attendance_month"]."'/><label for='".$rowgrades["attendance_month"]."'>".$rowgrades["attendance_month"]."</label></p>";	
				$data["parentstudattendance"] = $attendancemonth;
			}
		}else{
			$data["parentstudattendance"] = "No Attendance recorded yet.";
		}
	}



	//Subject 
	if(isset($subjectval, $subjectstudent)){
		$selectsubjectgrade = "SELECT * FROM summarygrade WHERE sumgrade_student_id = '$subjectstudent' AND sumgrade_subject = '$subjectval' ";
		$resultsubjectgrade = mysqli_query($conn, $selectsubjectgrade);
		$rowsubjectgrade = mysqli_fetch_assoc($resultsubjectgrade);

		$data["onequarter"] = intval($rowsubjectgrade["sum_quarterone"]);
		$data["twoquarter"] = intval($rowsubjectgrade["sum_quartertwo"]);
		$data["threequarter"] = intval($rowsubjectgrade["sum_quarterthree"]);
		$data["fourquarter"] = intval($rowsubjectgrade["sum_quarterfour"]);
		$data["finalgrade"] = intval($rowsubjectgrade["sum_final"]);
		$data["remarkforgrade"] = $rowsubjectgrade["sum_remark"];
	}



	//Evaluation
	if(isset($studentidtoget)){

		$selectsubject = "SELECT * FROM summarygrade WHERE sumgrade_student_id = '$studentidtoget' ";
		$resultsubject = mysqli_query($conn, $selectsubject);
		if (mysqli_num_rows($resultsubject) > 0) {
			while ($rowsubject = mysqli_fetch_assoc($resultsubject)) {
				
			$subjectlistparent[] = "<p class='subjectss'><input name='subjectlist' class='subjectselect' type='radio' id='".$rowsubject["sumgrade_subject"]."' value = '".$rowsubject["sumgrade_subject"]."'/><label for='".$rowsubject["sumgrade_subject"]."'>".$rowsubject["sumgrade_subject"]."</label></p>" ;
			}
			$data["subjectsforparent"] = $subjectlistparent;
		}else{
			$data["subjectsforparent"] = "No Grades added yet.";
		}

		$selectgrades = "SELECT * FROM summarygrade INNER JOIN student ON summarygrade.sumgrade_student_id = student.student_id WHERE summarygrade.sumgrade_student_id = '$studentidtoget' GROUP BY summarygrade.sumgrade_student_id, summarygrade.sumgrade_subject ";
		$resultgrades = mysqli_query($conn, $selectgrades);
		if (mysqli_num_rows($resultgrades) > 0) {
			$count = 0;
			$quarter;
			while ( $rowgrades = mysqli_fetch_assoc($resultgrades) ) {

				$fullname =$rowgrades["firstname"]." ".$rowgrades["middlename"]." ".$rowgrades["lastname"];
				$sumgradetable[] = "<tr><td>".$fullname."</td><td class='tdsubject'>".$rowgrades["sumgrade_subject"]."</td><td class='tdquarterone'>".$rowgrades["sum_quarterone"]."</td><td>".$rowgrades["sum_quartertwo"]."</td><td>".$rowgrades["sum_quarterthree"]."</td><td>".$rowgrades["sum_quarterfour"]."</td><td>".$rowgrades["sum_final"]."</td><td>".$rowgrades["sum_remark"]."</td></tr>";
				
			}
			$data["sumgradetable"] = $sumgradetable;
		
		}

		
	}


	if(isset($parentnamesession)){

		$selectlstmsgparent = "SELECT * FROM latestmessage WHERE from_id = '$parentnamesession' OR to_id = '$parentnamesession' ORDER BY msg_datetime DESC";
		$resultlstmsgparent = mysqli_query($conn, $selectlstmsgparent);
		if (mysqli_num_rows($resultlstmsgparent) > 0) {
			while($rowlstmsgparent = mysqli_fetch_assoc($resultlstmsgparent)) {
				$to_idmod;
				if( $rowlstmsgparent["to_id"] == $parentnamesession ){
					$to_idmod = $rowlstmsgparent["from_id"];
				}else if($rowlstmsgparent["from_id"] == $parentnamesession){
					$to_idmod = $rowlstmsgparent["to_id"];
				}
				$toidname;
				$selectfromfaculty = "SELECT * FROM faculty_account WHERE employee_id = '$to_idmod' ";
				$resultfromfaculty = mysqli_query($conn, $selectfromfaculty);
				if(mysqli_num_rows($resultfromfaculty) > 0){
					$rowfromfaculty = mysqli_fetch_assoc($resultfromfaculty);
					$toidname = $rowfromfaculty["firstname"]." ".$rowfromfaculty["lastname"];
				}
				$selectfromparent = "SELECT * FROM parent_account WHERE parent_id = '$to_idmod' ";
				$resultfromparent = mysqli_query($conn, $selectfromparent);
				if(mysqli_num_rows($resultfromparent) > 0){
					$rowfromparent = mysqli_fetch_assoc($resultfromparent);
					$toidname = $rowfromparent["firstname"]." ".$rowfromparent["lastname"];
				}
				$selectfromadmin = "SELECT * FROM admin WHERE employee_id = '$to_idmod' ";
				$resultfromadmin = mysqli_query($conn, $selectfromadmin);
				if(mysqli_num_rows($resultfromadmin) > 0){
					$rowfromadmin = mysqli_fetch_assoc($resultfromadmin);
					$toidname = $rowfromadmin["firstname"]." ".$rowfromadmin["lastname"];
				}

	        	$parentmsg[] = "<li class='collection-item avatar li-msg-parent'><img src='../images/male-user.png' class='circle'><span class='title inbox-receiver-parent' id='".$to_idmod."'>".$toidname."</span><p class='truncate msg-content'>".$rowlstmsgparent["msg_content"]."</p><p class='secondary-content'></p></li>";
	        	$data["msglistparent"] = $parentmsg;
	    	}
	    }else{
	        	$data["msglistparent"] = "0";

	    }


		$selectmyinfo = "SELECT * FROM parent_account WHERE parent_id = '$parentnamesession' ";
		$resultmyinfo = mysqli_query($conn, $selectmyinfo);
		$rowmyinfo = mysqli_fetch_assoc($resultmyinfo);

		$parent_firstname = $rowmyinfo["firstname"];
		$parent_lastname = $rowmyinfo["lastname"];


		$selectchild = "SELECT * FROM student WHERE guardian_firstname = '$parent_firstname' AND guardian_lastname = '$parent_lastname' GROUP BY student_id";
		$resultchild = mysqli_query($conn, $selectchild);
		if (mysqli_num_rows($resultchild) > 0) {
			while ($rowchild = mysqli_fetch_assoc($resultchild)) {

				$fullname =$rowchild["firstname"]." ".$rowchild["middlename"]." ".$rowchild["lastname"];
				$selectchildlist[] = "<option value='".$rowchild["student_id"]."'>".$rowchild["student_id"] ." - ". $fullname."</option>";
			}
			$data["selectchildlist"] = $selectchildlist;
		}else{
			$data["selectchildlist"] = "<option value ='null' disabled>No student associated with you yet.</option>";
		}




		$parentselect = "SELECT * FROM parent_account WHERE parent_id = '$parentnamesession' ";
		$parentresult = mysqli_query($conn, $parentselect);
		$parentrow = mysqli_fetch_assoc($parentresult);

		$parentProfileInfo["firstname"] = $parentrow["firstname"];
		$parentProfileInfo["middlename"] = $parentrow["middlename"];
		$parentProfileInfo["lastname"] = $parentrow["lastname"];
		$parentProfileInfo["parent_id"] = $parentrow["parent_id"];
		$parentProfileInfo["password"] = $parentrow["password"];
		$parentProfileInfo["email"] = $parentrow["email"];
		$parentProfileInfo["dob"] = $parentrow["dob"];
		$parentProfileInfo["gender"] = $parentrow["gender"];
		$parentProfileInfo["address"] = $parentrow["address"];
		$parentProfileInfo["phone"] = $parentrow["phone"];
		$parentProfileInfo["image_src"] = $parentrow["image_src"];

		$data["parentProfileInfo"] = $parentProfileInfo;
	}

	//Faculty Update Account Info
	if( isset( $parent_new_pass ) ){
		$parentnewpassupdate = "UPDATE parent_account SET password = '$parent_new_pass' WHERE parent_id = '$parentnamesession' ";
		if (mysqli_query($conn, $parentnewpassupdate)) {
		    $data['success'] = true;
		}
	}
	//Faculty Basic Info Update
	if( isset($parent_firstname) ){
		$parentupdatefirstname= "UPDATE parent_account SET firstname='$parent_firstname' WHERE parent_id='$parentnamesession'";
		mysqli_query($conn, $parentupdatefirstname);
		$parentProfileInfoUpdate['update_firstname'] = true;
		$parentProfileInfoUpdate['update_firstnamecheck'] = $parent_firstname;
	}
	if( isset($parent_middlename) ){
		$parentupdatemiddlename= "UPDATE parent_account SET middlename='$parent_middlename' WHERE parent_id='$parentnamesession'";
		mysqli_query($conn, $parentupdatemiddlename);
		$parentProfileInfoUpdate['update_middlename'] = true;
	}
	if( isset($parent_lastname) ){
		$parentupdatelastname= "UPDATE parent_account SET lastname='$parent_lastname' WHERE parent_id='$parentnamesession'";
		mysqli_query($conn, $parentupdatelastname);
		$parentProfileInfoUpdate['update_lastname'] = true;
		$parentProfileInfoUpdate['update_lastnamecheck'] = $parent_lastname;
	}
	if( isset($parent_gender) ){
		$parentupdategender= "UPDATE parent_account SET gender='$parent_gender' WHERE parent_id='$parentnamesession'";
		mysqli_query($conn, $parentupdategender);
		$parentProfileInfoUpdate['update_gender'] = true;
	}
	if( isset($parent_dob) ){
		$parentupdatedob= "UPDATE parent_account SET dob='$parent_dob' WHERE parent_id='$parentnamesession'";
		mysqli_query($conn, $parentupdatedob);
		$parentProfileInfoUpdate['update_dob'] = true;
	}
	if( isset($parent_address) ){
		$parentupdateaddress= "UPDATE parent_account SET address='$parent_address' WHERE parent_id='$parentnamesession'";
		mysqli_query($conn, $parentupdateaddress);
		$parentProfileInfoUpdate['update_address'] = true;
	}
	//Admin Contact Info Update
	if( isset($parent_position) ){
		$parentupdateposition= "UPDATE parent_account SET position='$parent_position' WHERE parent_id='$parentnamesession'";
		mysqli_query($conn, $parentupdateposition);
		$parentProfileInfoUpdate['update_position'] = true;
	}
	if( isset($parent_email) ){
		$parentupdateemail= "UPDATE parent_account SET email='$parent_email' WHERE parent_id='$parentnamesession'";
		mysqli_query($conn, $parentupdateemail);
		$parentProfileInfoUpdate['update_email'] = true;
	}
	if( isset($parent_phone) ){
		$parentupdatephone= "UPDATE parent_account SET phone='$parent_phone' WHERE parent_id='$parentnamesession'";
		mysqli_query($conn, $parentupdatephone);
		$parentProfileInfoUpdate['update_phone'] = true;
	}
	//Input all update message here
	$data['parentProfileInfoUpdate'] = $parentProfileInfoUpdate;	
	//faculty Contact Info Update
	if( isset($parent_position) ){
		$parentupdateposition= "UPDATE parent_account SET position='$parent_position' WHERE parent_id='$parentnamesession'";
		mysqli_query($conn, $parentupdateposition);
		$parentProfileInfoUpdate['update_position'] = true;
	}
	if( isset($parent_email) ){
		$parentupdateemail= "UPDATE parent_account SET email='$parent_email' WHERE parent_id='$parentnamesession'";
		mysqli_query($conn, $parentupdateemail);
		$parentProfileInfoUpdate['update_email'] = true;
	}
	if( isset($parent_phone) ){
		$parentupdatephone= "UPDATE parent_account SET phone='$parent_phone' WHERE parent_id='$parentnamesession'";
		mysqli_query($conn, $parentupdatephone);
		$parentProfileInfoUpdate['update_phone'] = true;
	}
	//Input all update message here
	$data['parentProfileInfoUpdate'] = $parentProfileInfoUpdate;

	echo json_encode($data);
	mysqli_close($conn);

?>