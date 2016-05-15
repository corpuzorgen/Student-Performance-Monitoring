<?php
	session_start();
	include '../connection.php';
	error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
	$adminnamesession = $_SESSION['adminEmployeeId'];
	$facultyusernamesession = $_SESSION['facultyUsername'];
	$parentnamesession = $_SESSION['parentUsername'];
	mysqli_select_db($conn, 'orgencor_ccsmartkidz');

	$data           	   				= array();  
	$section_class						= array();
	$subject							= array();
	$class 								= array();


	//Faculty Update account info
	$faculty_new_pass= $_POST["faculty_new_pass"];
	//Faculty update basic info 
	$faculty_firstname= $_POST["faculty_firstname"];
	$faculty_middlename= $_POST["faculty_middlename"];
	$faculty_lastname= $_POST["faculty_lastname"];
	$faculty_gender= $_POST["faculty_gender"];
	$faculty_dob= $_POST["faculty_dob"];
	$faculty_address= $_POST["faculty_address"];
	//faculty update contact info
	$faculty_position= $_POST["faculty_position"];
	$faculty_email= $_POST["faculty_email"];
	$faculty_phone= $_POST["faculty_phone"];
	
	//Class
	$class_name= $_POST["class_name"];
	$class_section= $_POST["class_section"];
	$filipino= $_POST["filipino"];
	$english= $_POST["english"];
	$math= $_POST["math"];
	$science= $_POST["science"];
	$ap= $_POST["ap"];
	$epp= $_POST["epp"];
	$esp= $_POST["esp"];
	$mapeh= $_POST["mapeh"];

	//Adding Student
	$student_id= $_POST["student_id"];
	$student_first_name= $_POST["student_first_name"];
	$student_middle_name= $_POST["student_middle_name"];
	$student_last_name= $_POST["student_last_name"];
	$student_address= $_POST["student_address"];
	$student_guardianfn= $_POST["student_guardianfn"];
	$student_guardianln= $_POST["student_guardianln"];
	$guardian_phone= $_POST["guardian_phone"];
	$student_section= $_POST["student_section"];
	$student_subject= $_POST["student_subject"];
	

	//Retrieve Student
	$lisubject= $_POST["lisubject"];
	$lisection= $_POST["lisection"];

	//Update Student
	$student_first_name_update= $_POST["student_first_name_update"];
	$student_middle_name_update= $_POST["student_middle_name_update"];
	$student_last_name_update= $_POST["student_last_name_update"];
	$student_address_update= $_POST["student_address_update"];
	$student_guardianfn_update= $_POST["student_guardianfn_update"];
	$student_guardianln_update= $_POST["student_guardianln_update"];
	$guardian_phone_update= $_POST["guardian_phone_update"];
	$getstudentidupdate= $_POST["getstudentidupdate"];
	//Drop Student
	$dropstudid= $_POST["dropstudid"];
	$studiddel= $_POST["studiddel"];
	$classdel= $_POST["classdel"];
	$subjdel= $_POST["subjdel"];
	//Evaluation Class selected
	$classselected= $_POST["classselected"];
	//Evaluation Student selected
	$studentselect= $_POST["studentselect"];
	$studentclass= $_POST["studentclass"];
	//Remove Class
	$classnametoremove= $_POST["classnametoremove"];
	$classsectiontoremove= $_POST["classsectiontoremove"];
	$classsubjecttoremove= $_POST["classsubjecttoremove"];
	//Select subject for grades
	$classselectforgrades= $_POST["classselectforgrades"];
	//Select Students for grades
	$subjectselectforgrades= $_POST["subjectselectforgrades"];
	$subjectclassselectforgrades= $_POST["subjectclassselectforgrades"];
	//Fetch qaurter grades
	$quarterselected= $_POST["quarterselected"];
	$subjectselectforquarter= $_POST["subjectselectforquarter"];
	$classselectforquarter= $_POST["classselectforquarter"];
	//Save hsp
	$hpsval= $_POST["hpsval"];
	$hpsquarter= $_POST["hpsquarter"];
	$hpsfor= $_POST["hpsfor"];
	$hsp_subject= $_POST["hsp_subject"];
	$hsp_section= $_POST["hsp_section"];
	$item= $_POST["item"];
	$totalscorehsp= $_POST["totalscorehsp"];
	//Student Grade
	$student= $_POST["student"];
	$gradevalue= $_POST["gradevalue"];
	$gradeitem= $_POST["gradeitem"];
	$gradefor= $_POST["gradefor"];
	$gradequarter= $_POST["gradequarter"];
	$gradesubject= $_POST["gradesubject"];
	$gradesection= $_POST["gradesection"];
	$totalscore= $_POST["totalscore"];
	$pstotal= $_POST["pstotal"];
	$wstotal= $_POST["wstotal"];
	//Initiual and Quarter Grade
	$initialgrade= $_POST["initialgrade"];
	$quarterlygrade= $_POST["quarterlygrade"];
	$finalgrade= $_POST["finalgrade"];
	//Student Evaluation
	$subjeval= $_POST["subjeval"];
	$studenteval= $_POST["studenteval"];
	$sectioneval= $_POST["sectioneval"];
	//Add Attendance
	$academic_year_att= $_POST["academic_year_att"];
	$student_id_att= $_POST["student_id_att"];
	$month_att= $_POST["month_att"];
	$days_present_att= $_POST["days_present_att"];
	$days_late_att= $_POST["days_late_att"];
	$days_absent_att= $_POST['days_absent_att'];
	//Update Attendance
	$academic_year_att_update= $_POST["academic_year_att_update"];
	$student_id_att_update= $_POST["student_id_att_update"];
	$month_att_update= $_POST["month_att_update"];
	$days_present_att_update= $_POST["days_present_att_update"];
	$days_late_att_update= $_POST["days_late_att_update"];
	$days_absent_att_update= $_POST['days_absent_att_update'];
	$id_update= $_POST["id_update"];
	//Delte attedance
	$deletethisid= $_POST["deletethisid"];
	//Fetch contacts
	$keyword_faculty= $_POST["keyword_faculty"];

	$delmsgfaculty= $_POST["delmsgfaculty"];
	//update sumgrade
	$computefinal= $_POST["computefinal"];
	$remarks= $_POST["remarks"];
	$subjecttoupdate= $_POST["subjecttoupdate"];
	$sectionupdatetoupdate= $_POST["sectionupdatetoupdate"];
	$studupdatetoupdate= $_POST['studupdatetoupdate'];

	$computefinalpt= $_POST["computefinalpt"];
	$remarkspt= $_POST["remarkspt"];
	$subjecttoupdatept= $_POST["subjecttoupdatept"];
	$sectionupdatetoupdatept= $_POST["sectionupdatetoupdatept"];
	$studupdatetoupdatept= $_POST['studupdatetoupdatept'];

	if(isset($computefinalpt,$remarkspt)){
		$updatesumgradept = "UPDATE summarygrade SET sum_final = '$computefinalpt', sum_remark ='$remarkspt' WHERE sumgrade_subject ='$subjecttoupdatept' AND sumgrade_section ='$sectionupdatetoupdatept' AND sumgrade_student_id = '$studupdatetoupdatept' ";
		if(mysqli_query($conn, $updatesumgradept)){
			$data["updateptsumgrade"] = $computefinalpt ." ".$studupdatetoupdatept ." ". $sectionupdatetoupdatept." ".$subjecttoupdatept;
		}else{
			$data["updateptsumgrade"] = false;
		}
	}

	if(isset($computefinal,$remarks)){
		$updatesumgrade = "UPDATE summarygrade SET sum_final = '$computefinal', sum_remark ='$remarks' WHERE sumgrade_subject ='$subjecttoupdate' AND sumgrade_section ='$sectionupdatetoupdate' AND sumgrade_student_id = '$studupdatetoupdate' ";
		if(mysqli_query($conn, $updatesumgrade)){
			$data["updatewwsumgrade"] = true;
		}else{
			$data["updatewwsumgrade"] = false;
		}
	}



	if(isset($delmsgfaculty)){
		$deletefacultymsg = "DELETE FROM messages WHERE from_id = '$facultyusernamesession' AND to_id = '$delmsgfaculty' || from_id = '$delmsgfaculty' AND to_id = '$facultyusernamesession'";
		$deletefacultyltmsg = "DELETE FROM latestmessage WHERE from_id = '$facultyusernamesession' AND to_id = '$delmsgfaculty' || from_id = '$delmsgfaculty' AND to_id = '$facultyusernamesession'";
		if(mysqli_query($conn, $deletefacultymsg) && mysqli_query($conn, $deletefacultyltmsg)){
			$data["delmsgfaculty"] = true;
		}
	}

	//Update Grades WW

	$studenidupdategrade = $_POST["studenidupdategrade"];
	$studentquarterupdate = $_POST["studentquarterupdate"];
	$studentsubjectupdate = $_POST["studentsubjectupdate"];
	$studentclassupdate = $_POST["studentclassupdate"];
	$wwitem1 = $_POST["wwitem1"];
	$wwitem2 = $_POST["wwitem2"];
	$wwitem3 = $_POST["wwitem3"];
	$wwitem4 = $_POST["wwitem4"];
	$wwitem5 = $_POST["wwitem5"];
	$wwitem6 = $_POST["wwitem6"];
	$wwitem7 = $_POST["wwitem7"];
	$wwitem8 = $_POST["wwitem8"];
	$wwitem9 = $_POST["wwitem9"];
	$wwitem10 = $_POST["wwitem10"];
	$wwtotalupdate = $_POST["wwtotalupdate"];
	$wwpsupdate = $_POST["wwpsupdate"];
	$wwwsupdate = $_POST["wwwsupdate"];
	$initialgradeww= $_POST["initialgradeww"];
	$quarterlygradeupdateww= $_POST["quarterlygradeupdateww"];

	//Update Grades PT
	$studenidupdategradept = $_POST["studenidupdategradept"];
	$studentquarterupdatept = $_POST["studentquarterupdatept"];
	$studentsubjectupdatept = $_POST["studentsubjectupdatept"];
	$studentclassupdatept = $_POST["studentclassupdatept"];
	$ptitem1 = $_POST["ptitem1"];
	$ptitem2 = $_POST["ptitem2"];
	$ptitem3 = $_POST["ptitem3"];
	$ptitem4 = $_POST["ptitem4"];
	$ptitem5 = $_POST["ptitem5"];
	$ptitem6 = $_POST["ptitem6"];
	$ptitem7 = $_POST["ptitem7"];
	$ptitem8 = $_POST["ptitem8"];
	$ptitem9 = $_POST["ptitem9"];
	$ptitem10 = $_POST["ptitem10"];
	$pttotalupdate = $_POST["pttotalupdate"];
	$ptpsupdate = $_POST["ptpsupdate"];
	$ptwsupdate = $_POST["ptwsupdate"];
	$initialgradept= $_POST["initialgradept"];
	$quarterlygradeupdatept= $_POST["quarterlygradeupdatept"];

	//Update Grades qa
	$studenidupdategradeqa = $_POST["studenidupdategradeqa"];
	$studentquarterupdateqa = $_POST["studentquarterupdateqa"];
	$studentsubjectupdateqa = $_POST["studentsubjectupdateqa"];
	$studentclassupdateqa = $_POST["studentclassupdateqa"];
	$examscoreqaupdate = $_POST["examscoreqaupdate"];
	$qapsupdate = $_POST["qapsupdate"];
	$qawsupdate = $_POST["qawsupdate"];
	$initialgradeqa= $_POST["initialgradeqa"];
	$quarterlygradeupdateqa= $_POST["quarterlygradeupdateqa"];

	if(isset($studenidupdategradeqa, $studentquarterupdateqa, $studentsubjectupdateqa, $studentclassupdateqa)){
		$section_name_selected;
		if( $studentclassupdateqa === "kindergarten_1") {
			$section_name_selected = "Kindergarten 1";
		}
		if( $studentclassupdateqa === "kindergarten_2") {
			$section_name_selected = "Kindergarten 2";
		}
		if( $studentclassupdateqa === "preparatory") {
			$section_name_selected = "Preparatory";
		}
		if( $studentclassupdateqa === "grade_1") {
			$section_name_selected = "Grade 1";
		}
		if( $studentclassupdateqa === "grade_2") {
			$section_name_selected = "Grade 2";
		}
		if( $studentclassupdateqa === "grade_3") {
			$section_name_selected = "Grade 3";
		}
		if( $studentclassupdateqa === "grade_4") {
			$section_name_selected = "Grade 4";
		}
		if( $studentclassupdateqa === "grade_5") {
			$section_name_selected = "Grade 5";
		}
		if( $studentclassupdateqa === "grade_6") {
			$section_name_selected = "Grade 6";
		}

		$updateqaforgrades = "UPDATE quarterassesment SET exam_score = '$examscoreqaupdate', qa_ps = '$qapsupdate', qa_ws ='$qawsupdate'  WHERE qa_quarter = '$studentquarterupdateqa' AND qa_subj = '$studentsubjectupdateqa' AND qa_section = '$section_name_selected' AND qa_student_id = '$studenidupdategradeqa'";
		if (mysqli_query($conn, $updateqaforgrades)) {
			$data["updategradeqas"] = true;
			$data["examscoreqa"] = $examscoreqaupdate;
		}else{
			$data["updategradeqas"] = mysqli_error($conn);
		}
		$updategradesqa = "UPDATE grades SET initial_grade = '$initialgradeqa', quarterly_grade = '$quarterlygradeupdateqa' WHERE grade_quarter = '$studentquarterupdateqa' AND grade_subject = '$studentsubjectupdateqa' AND grade_section = '$section_name_selected' AND grade_student_id = '$studenidupdategradeqa'";
		if (mysqli_query($conn, $updategradesqa)) {
			$data["goupdateqa"] = true;
			$data["updateiniqa"] = $initialgradeqa;
			$data["updatequarterlyqa"] = $quarterlygradeupdateqa;
			$data["updatestudqa"] = $studenidupdategradeqa;
		}else{
			$data["goupdateqa"] = mysqli_error($conn);
		}
		$updatealsosumgradeqa = "UPDATE summarygrade SET sum_".$studentquarterupdateqa." = '$quarterlygradeupdateqa' WHERE sumgrade_subject = '$studentsubjectupdateqa' AND sumgrade_section = '$section_name_selected' AND sumgrade_student_id = '$studenidupdategradeqa'";
		mysqli_query($conn, $updatealsosumgradeqa);

	}

	if(isset($studenidupdategradept, $studentquarterupdatept, $studentsubjectupdatept, $studentclassupdatept)){
		$section_name_selected;
		if( $studentclassupdatept === "kindergarten_1") {
			$section_name_selected = "Kindergarten 1";
		}
		if( $studentclassupdatept === "kindergarten_2") {
			$section_name_selected = "Kindergarten 2";
		}
		if( $studentclassupdatept === "preparatory") {
			$section_name_selected = "Preparatory";
		}
		if( $studentclassupdatept === "grade_1") {
			$section_name_selected = "Grade 1";
		}
		if( $studentclassupdatept === "grade_2") {
			$section_name_selected = "Grade 2";
		}
		if( $studentclassupdatept === "grade_3") {
			$section_name_selected = "Grade 3";
		}
		if( $studentclassupdatept === "grade_4") {
			$section_name_selected = "Grade 4";
		}
		if( $studentclassupdatept === "grade_5") {
			$section_name_selected = "Grade 5";
		}
		if( $studentclassupdatept === "grade_6") {
			$section_name_selected = "Grade 6";
		}

		$updatept = "UPDATE performancetask SET item_1 = '$ptitem1',item_2 = '$ptitem2',item_3 = '$ptitem3',item_4 = '$ptitem4',item_5 = '$ptitem5',item_6 = '$ptitem6',item_7 = '$ptitem7',item_8 = '$ptitem8',item_9 = '$ptitem9',item_10 = '$ptitem10', pt_total= '$pttotalupdate', pt_ps = '$ptpsupdate', pt_ws = '$ptwsupdate' WHERE pt_quarter = '$studentquarterupdatept' AND pt_subj = '$studentsubjectupdatept' AND pt_section = '$section_name_selected' AND pt_student_id = '$studenidupdategradept' ";
		if (mysqli_query($conn, $updatept)) {
			$data["updategradept"] = true;
			$data["pt1"] = $ptitem1;$data["pt2"] = $ptitem2;$data["pt3"] = $ptitem3;$data["pt4"] = $ptitem4;$data["pt5"] = $ptitem5;$data["pt6"] = $ptitem6;$data["pt7"] = $ptitem7;$data["pt8"] = $ptitem8;$data["pt9"] = $ptitem9;$data["pt10"] = $ptitem10;	
		}
		$updategradespt = "UPDATE grades SET initial_grade = '$initialgradept', quarterly_grade = '$quarterlygradeupdatept' WHERE grade_quarter = '$studentquarterupdatept' AND grade_subject = '$studentsubjectupdatept' AND grade_section = '$section_name_selected' AND grade_student_id = '$studenidupdategradept'";
		if (mysqli_query($conn, $updategradespt)) {
			$data["goupdatept"] = true;
			$data["updateinipt"] = $initialgradept;
			$data["updatequarterlypt"] = $quarterlygradeupdatept;
			$data["updatestudpt"] = $studenidupdategradept;
			$data["sujectupdatept"] = $studentsubjectupdatept;
			$data["sectionupdatept"] = $section_name_selected;
		}else{
			$data["goupdatept"] = mysqli_error($conn);
		}

		$updatealsosumgradept = "UPDATE summarygrade SET sum_".$studentquarterupdatept." = '$quarterlygradeupdatept' WHERE sumgrade_subject = '$studentsubjectupdatept' AND sumgrade_section = '$section_name_selected' AND sumgrade_student_id = '$studenidupdategradept'";
		mysqli_query($conn, $updatealsosumgradept);

		
	}


	if(isset($studenidupdategrade, $studentquarterupdate, $studentsubjectupdate, $studentclassupdate)){
		$section_name_selected;
		if( $studentclassupdate === "kindergarten_1") {
			$section_name_selected = "Kindergarten 1";
		}
		if( $studentclassupdate === "kindergarten_2") {
			$section_name_selected = "Kindergarten 2";
		}
		if( $studentclassupdate === "preparatory") {
			$section_name_selected = "Preparatory";
		}
		if( $studentclassupdate === "grade_1") {
			$section_name_selected = "Grade 1";
		}
		if( $studentclassupdate === "grade_2") {
			$section_name_selected = "Grade 2";
		}
		if( $studentclassupdate === "grade_3") {
			$section_name_selected = "Grade 3";
		}
		if( $studentclassupdate === "grade_4") {
			$section_name_selected = "Grade 4";
		}
		if( $studentclassupdate === "grade_5") {
			$section_name_selected = "Grade 5";
		}
		if( $studentclassupdate === "grade_6") {
			$section_name_selected = "Grade 6";
		}

		$updateww = "UPDATE writtenworks SET item_1 = '$wwitem1',item_2 = '$wwitem2',item_3 = '$wwitem3',item_4 = '$wwitem4',item_5 = '$wwitem5',item_6 = '$wwitem6',item_7 = '$wwitem7',item_8 = '$wwitem8',item_9 = '$wwitem9',item_10 = '$wwitem10', ww_total= '$wwtotalupdate', ww_ps = '$wwpsupdate', ww_ws = '$wwwsupdate' WHERE ww_quarter = '$studentquarterupdate' AND ww_subj = '$studentsubjectupdate' AND ww_section = '$section_name_selected' AND ww_student_id = '$studenidupdategrade' ";
		if (mysqli_query($conn, $updateww)) {
			$data["updategrade"] = true;
			$data["ww1"] = $wwitem1;$data["ww2"] = $wwitem2;$data["ww3"] = $wwitem3;$data["ww4"] = $wwitem4;$data["ww5"] = $wwitem5;$data["ww6"] = $wwitem6;$data["ww7"] = $wwitem7;$data["ww8"] = $wwitem8;$data["ww9"] = $wwitem9;$data["ww10"] = $wwitem10;	
		}
		$updategradesww = "UPDATE grades SET initial_grade = '$initialgradeww', quarterly_grade = '$quarterlygradeupdateww' WHERE grade_quarter = '$studentquarterupdate' AND grade_subject = '$studentsubjectupdate' AND grade_section = '$section_name_selected' AND grade_student_id = '$studenidupdategrade'";
		if (mysqli_query($conn, $updategradesww)) {
			$data["goupdate"] = true;
			$data["updateini"] = $initialgradeww;
			$data["updatequarterly"] = $quarterlygradeupdateww;
			$data["updatestud"] = $studenidupdategrade;
			$data["sujectupdate"] = $studentsubjectupdate;
			$data["sectionupdate"] = $section_name_selected;

		}

		$updatealsosumgrade = "UPDATE summarygrade SET sum_".$studentquarterupdate." = '$quarterlygradeupdateww' WHERE sumgrade_subject = '$studentsubjectupdate' AND sumgrade_section = '$section_name_selected' AND sumgrade_student_id = '$studenidupdategrade'";
		mysqli_query($conn, $updatealsosumgrade);

		
	}


	if(isset($keyword_faculty)){

		$selectfromfacultyusers = "SELECT * FROM faculty_account WHERE employee_id LIKE '%".$_POST['keyword_faculty']."%' OR firstname LIKE '%".$_POST['keyword_faculty']."%' OR middlename LIKE '%".$_POST['keyword_faculty']."%' OR lastname LIKE '%".$_POST['keyword_faculty']."%' OR email LIKE '%".$_POST['keyword_faculty']."%' LIMIT 0,5";
		$resultfromfacultyusers = mysqli_query($conn, $selectfromfacultyusers);
		if(mysqli_num_rows($resultfromfacultyusers) > 0){
			
			while($rowfromfacultyusers = mysqli_fetch_assoc($resultfromfacultyusers)) {
				if($rowfromfacultyusers["employee_id"] != $facultyusernamesession){
					$fullname = $rowfromfacultyusers["firstname"]." ".$rowfromfacultyusers["middlename"]." ".$rowfromfacultyusers["lastname"];
					$contactsforfaculty[] = "<li class='item' id='facultycon".$rowfromfacultyusers["employee_id"]."'>".$fullname."</li>";
				}
			}

		}else{
			$data["keywords_faculty"] = "<li>No Records Found!</li>";
		}
		$selectfromparentusers = "SELECT * FROM parent_account WHERE parent_id LIKE '%".$_POST['keyword_faculty']."%' OR firstname LIKE '%".$_POST['keyword_faculty']."%' OR middlename LIKE '%".$_POST['keyword_faculty']."%' OR lastname LIKE '%".$_POST['keyword_faculty']."%' OR email LIKE '%".$_POST['keyword_faculty']."%' LIMIT 0,5";
		$resultfromparentusers = mysqli_query($conn, $selectfromparentusers);
		if(mysqli_num_rows($resultfromparentusers) > 0){
			
			while($rowfromparentusers = mysqli_fetch_assoc($resultfromparentusers)) {
				$fullname = $rowfromparentusers["firstname"]." ".$rowfromparentusers["middlename"]." ".$rowfromparentusers["lastname"];
				$contactsforfaculty[] = "<li class='item' id='facultycon".$rowfromparentusers["parent_id"]."'>".$fullname."</li>";
			}

		}else{
			$data["keywords_faculty"] = "<li>No Records Found!</li>";
		}

		$selectfromadminusers = "SELECT * FROM admin WHERE employee_id LIKE '%".$_POST['keyword_faculty']."%' OR firstname LIKE '%".$_POST['keyword_faculty']."%' OR middlename LIKE '%".$_POST['keyword_faculty']."%' OR lastname LIKE '%".$_POST['keyword_faculty']."%' OR email LIKE '%".$_POST['keyword_faculty']."%' LIMIT 0,5";
		$resultfromadminusers = mysqli_query($conn, $selectfromadminusers);
		$rowfromadminusers = mysqli_fetch_assoc($resultfromadminusers);
		$fullname = $rowfromadminusers["firstname"]." ".$rowfromadminusers["middlename"]." ".$rowfromadminusers["lastname"];
		$contactsforfaculty[] = "<li class='item' id='facultycon".$rowfromadminusers["employee_id"]."'>".$fullname."</li>";

		$data["keywords_faculty"] = $contactsforfaculty;
	}



	if(isset($deletethisid)){
		$deleteattendance = "DELETE FROM attendance WHERE attendance_id ='$deletethisid' ";
		if(mysqli_query($conn, $deleteattendance)){
			$data["deleteattendanceupdates"] = true;
		}else{
			$data["deleteattendanceupdates"] = mysqli_query($conn);
		}
	}

	if(isset($academic_year_att, $student_id_att, $month_att)){
		$insertintoattendance = "INSERT INTO attendance (attendance_sy, attendance_student_id, attendance_month, days_present, days_late, days_absent, professor) VALUES ('$academic_year_att', '$student_id_att', '$month_att', '$days_present_att', '$days_late_att', '$days_absent_att', '$facultyusernamesession')";
		if(mysqli_query($conn, $insertintoattendance)){
			$data["add_attendance"] = true;
		}

	}

	if(isset($id_update)){
		$updateattendace = "UPDATE attendance SET attendance_sy = '$academic_year_att_update', attendance_student_id = '$student_id_att_update', attendance_month = '$month_att_update', days_present = '$days_present_att_update', days_late = '$days_late_att_update', days_absent = '$days_absent_att_update' WHERE attendance_id = '$id_update' ";
		if(mysqli_query($conn, $updateattendace)){
			$data["updateattendance"] = true;
		}
	}




	if(isset($subjeval, $studenteval, $sectioneval)){
		$section_name_selected;
		if( $sectioneval === "kindergarten_1") {
			$section_name_selected = "Kindergarten 1";
		}
		if( $sectioneval === "kindergarten_2") {
			$section_name_selected = "Kindergarten 2";
		}
		if( $sectioneval === "preparatory") {
			$section_name_selected = "Preparatory";
		}
		if( $sectioneval === "grade_1") {
			$section_name_selected = "Grade 1";
		}
		if( $sectioneval === "grade_2") {
			$section_name_selected = "Grade 2";
		}
		if( $sectioneval === "grade_3") {
			$section_name_selected = "Grade 3";
		}
		if( $sectioneval === "grade_4") {
			$section_name_selected = "Grade 4";
		}
		if( $sectioneval === "grade_5") {
			$section_name_selected = "Grade 5";
		}
		if( $sectioneval === "grade_6") {
			$section_name_selected = "Grade 6";
		}

		$selectstudenteval = "SELECT * FROM summarygrade INNER JOIN student ON summarygrade.sumgrade_student_id = student.student_id WHERE summarygrade.sumgrade_subject = '$subjeval' AND summarygrade.sumgrade_section = '$section_name_selected' AND student.subject = '$subjeval' AND student.section = '$section_name_selected' AND summarygrade.sumgrade_student_id = '$studenteval' AND student.student_id = '$studenteval' ";
		$resultstudenteval = mysqli_query($conn, $selectstudenteval);
		$rowstudenteval = mysqli_fetch_assoc($resultstudenteval);
		$data["quarteroneeval"] = $rowstudenteval["sum_quarterone"];
		$data["quartertwoeval"] = $rowstudenteval["sum_quartertwo"];
		$data["quarterthreeeval"] = $rowstudenteval["sum_quarterthree"];
		$data["quarterfoureval"] = $rowstudenteval["sum_quarterfour"];
		$data["finaleval"] = $rowstudenteval["sum_final"];
		$data["evalsubject"] = $subjeval;


	}

	if(isset($initialgrade, $quarterlygrade)){
		$section_name_selected;
		if( $gradesection === "kindergarten_1") {
			$section_name_selected = "Kindergarten 1";
		}
		if( $gradesection === "kindergarten_2") {
			$section_name_selected = "Kindergarten 2";
		}
		if( $gradesection === "preparatory") {
			$section_name_selected = "Preparatory";
		}
		if( $gradesection === "grade_1") {
			$section_name_selected = "Grade 1";
		}
		if( $gradesection === "grade_2") {
			$section_name_selected = "Grade 2";
		}
		if( $gradesection === "grade_3") {
			$section_name_selected = "Grade 3";
		}
		if( $gradesection === "grade_4") {
			$section_name_selected = "Grade 4";
		}
		if( $gradesection === "grade_5") {
			$section_name_selected = "Grade 5";
		}
		if( $gradesection === "grade_6") {
			$section_name_selected = "Grade 6";
		}

		$insertgrades = "UPDATE grades SET initial_grade = '$initialgrade',  quarterly_grade = '$quarterlygrade' WHERE grade_student_id = '$student' AND grade_quarter = '$gradequarter' AND grade_subject = '$gradesubject' AND grade_section = '$section_name_selected'";
		mysqli_query($conn, $insertgrades);
		$remark = "";
		
		if($finalgrade == 0){
			$finalgrade = "";
		}else{
			if($finalgrade <= 100 && $finalgrade >= 75){
			$remark = "PASSED";
			}else if($finalgrade >= 0 && $finalgrade <=74){
				$remark = "FAILED";
			}else{
				$remark = "";
			}
		}

		$insersumgrade = "UPDATE summarygrade SET sum_".$gradequarter." = '$quarterlygrade', sum_final = '$finalgrade', sum_remark = '$remark' WHERE sumgrade_subject = '$gradesubject' AND sumgrade_section = '$section_name_selected' AND sumgrade_student_id = '$student' ";
		mysqli_query($conn, $insersumgrade);
			
	}

	if(isset($student, $gradevalue, $gradeitem, $gradefor, $gradequarter, $gradesubject, $gradesection, $totalscore, $pstotal, $wstotal)){
		$section_name_selected;
		if( $gradesection === "kindergarten_1") {
			$section_name_selected = "Kindergarten 1";
		}
		if( $gradesection === "kindergarten_2") {
			$section_name_selected = "Kindergarten 2";
		}
		if( $gradesection === "preparatory") {
			$section_name_selected = "Preparatory";
		}
		if( $gradesection === "grade_1") {
			$section_name_selected = "Grade 1";
		}
		if( $gradesection === "grade_2") {
			$section_name_selected = "Grade 2";
		}
		if( $gradesection === "grade_3") {
			$section_name_selected = "Grade 3";
		}
		if( $gradesection === "grade_4") {
			$section_name_selected = "Grade 4";
		}
		if( $gradesection === "grade_5") {
			$section_name_selected = "Grade 5";
		}
		if( $gradesection === "grade_6") {
			$section_name_selected = "Grade 6";
		}

		if( $gradefor == 'writtenworks' ){

			$updategradeforww = "UPDATE writtenworks SET ".$gradeitem." = '$gradevalue', ww_total = '$totalscore', ww_ps = '$pstotal', ww_ws = '$wstotal' WHERE ww_quarter= '$gradequarter' AND ww_subj = '$gradesubject' AND ww_section ='$section_name_selected' and ww_student_id = '$student'";
			if(mysqli_query($conn, $updategradeforww)){
				$data["checkgrade"] = "true";
				$data["totalgradescore"] = $totalscore;
			}
		}else if( $gradefor == 'performancetask'){
			$updategradeforpt = "UPDATE performancetask SET ".$gradeitem." = '$gradevalue', pt_total = '$totalscore' ,pt_ps = '$pstotal', pt_ws = '$wstotal'WHERE pt_quarter= '$gradequarter' AND pt_subj = '$gradesubject' AND pt_section ='$section_name_selected' and pt_student_id = '$student'";
			if(mysqli_query($conn, $updategradeforpt)){
				$data["checkgrade"] = "true";
				$data["totalgradescore"] = $totalscore;
			}

		}else if( $gradefor == 'quarterassesment'){
			$updategradeforqa = "UPDATE quarterassesment SET ".$gradeitem." = '$gradevalue', qa_ps = '$pstotal', qa_ws = '$wstotal' WHERE qa_quarter= '$gradequarter' AND qa_subj = '$gradesubject' AND qa_section ='$section_name_selected' and qa_student_id = '$student'";
			if(mysqli_query($conn, $updategradeforqa)){
				$data["checkgrade"] = "true";
			}

		}
		
	}else{
		$data["checkgrade"] = "gg";
	}

	if(isset($hsp_section, $hsp_subject, $hpsfor, $hpsquarter, $hpsval, $item)){
		$checkhsp = "SELECT * FROM hsp WHERE hsp_for = '$hpsfor' AND hsp_quarter = '$hpsquarter' AND hsp_section = '$hsp_section' AND hsp_subject = '$hsp_subject'";
		$resultcheckhsp = mysqli_query($conn, $checkhsp);
		if (mysqli_num_rows($resultcheckhsp) > 0) {
			$rowcheckhsp = mysqli_fetch_assoc($resultcheckhsp);
			if( $hpsfor == "quarterlyassessment"){
				$totalscorehsp = $hpsval;
			}
				$updatehsp = "UPDATE hsp SET ".$item." = $hpsval, hsp_total = $totalscorehsp WHERE hsp_for = '$hpsfor' AND hsp_quarter = '$hpsquarter' AND hsp_section = '$hsp_section' AND  hsp_subject = '$hsp_subject' ";
				mysqli_query($conn, $updatehsp);
				
		
		}else{
			$inserthsp = "INSERT INTO hsp (hsp_for, hsp_quarter,".$item.", hsp_section, hsp_subject, hsp_total) VALUES ('$hpsfor','$hpsquarter','$hpsval','$hsp_section','$hsp_subject','$totalscorehsp')";
			mysqli_query($conn, $inserthsp);
		}


	}

	//for summary of grade
	if(isset($quarterselected, $subjectselectforquarter, $classselectforquarter)){

		$section_name_selected;
		if( $classselectforquarter === "kindergarten_1") {
			$section_name_selected = "Kindergarten 1";
		}
		if( $classselectforquarter === "kindergarten_2") {
			$section_name_selected = "Kindergarten 2";
		}
		if( $classselectforquarter === "preparatory") {
			$section_name_selected = "Preparatory";
		}
		if( $classselectforquarter === "grade_1") {
			$section_name_selected = "Grade 1";
		}
		if( $classselectforquarter === "grade_2") {
			$section_name_selected = "Grade 2";
		}
		if( $classselectforquarter === "grade_3") {
			$section_name_selected = "Grade 3";
		}
		if( $classselectforquarter === "grade_4") {
			$section_name_selected = "Grade 4";
		}
		if( $classselectforquarter === "grade_5") {
			$section_name_selected = "Grade 5";
		}
		if( $classselectforquarter === "grade_6") {
			$section_name_selected = "Grade 6";
		}

		$selectstudentsumgrades = "SELECT * FROM summarygrade INNER JOIN student ON summarygrade.sumgrade_student_id = student.student_id WHERE summarygrade.sumgrade_subject = '$subjectselectforquarter' AND summarygrade.sumgrade_section = '$section_name_selected' AND student.subject = '$subjectselectforquarter' AND student.section = '$section_name_selected'  ";
		$resultstudentsumgrades = mysqli_query($conn, $selectstudentsumgrades);
		while($rowstudentsumgrades = mysqli_fetch_assoc($resultstudentsumgrades)) {

			 $fullname = $rowstudentsumgrades["lastname"] . ", " . $rowstudentsumgrades["firstname"] . " " . $rowstudentsumgrades["middlename"];

			 if( $rowstudentsumgrades["sum_remark"] == "PASSED"){
			 	$remark = "<span class='green-text'>PASSED</span>";
			 }else if($rowstudentsumgrades["sum_remark"] == "FAILED"){
			 	$remark = "<span class='red-text'>FAILED</span>";
			 }else{
			 	$remark = "";
			 }
			 $studentlistforsum[] = "<tr class = 'sumgrades'><td class='expand' id='".$rowstudentsumgrades["sumgrade_student_id"]."'>".$fullname."</td><td class='shrink' id='".$rowstudentsumgrades["sumgrade_student_id"]."quarterone'>".$rowstudentsumgrades["sum_quarterone"]."</td><td class='shrink' id='".$rowstudentsumgrades["sumgrade_student_id"]."quartertwo'>".$rowstudentsumgrades["sum_quartertwo"]."</td><td class='shrink' id='".$rowstudentsumgrades["sumgrade_student_id"]."quarterthree'>".$rowstudentsumgrades["sum_quarterthree"]."</td><td class='shrink' id='".$rowstudentsumgrades["sumgrade_student_id"]."quarterfour'>".$rowstudentsumgrades["sum_quarterfour"]."</td><td class='shrink finalgradebold'>".$rowstudentsumgrades["sum_final"]."</td><td class='shrink' >".$remark."</td></tr>";

			 $data["studentlistforsum"] = $studentlistforsum;
		}


	}


	//for initial grade
	if(isset($quarterselected, $subjectselectforquarter, $classselectforquarter)){

		$section_name_selected;
		if( $classselectforquarter === "kindergarten_1") {
			$section_name_selected = "Kindergarten 1";
		}
		if( $classselectforquarter === "kindergarten_2") {
			$section_name_selected = "Kindergarten 2";
		}
		if( $classselectforquarter === "preparatory") {
			$section_name_selected = "Preparatory";
		}
		if( $classselectforquarter === "grade_1") {
			$section_name_selected = "Grade 1";
		}
		if( $classselectforquarter === "grade_2") {
			$section_name_selected = "Grade 2";
		}
		if( $classselectforquarter === "grade_3") {
			$section_name_selected = "Grade 3";
		}
		if( $classselectforquarter === "grade_4") {
			$section_name_selected = "Grade 4";
		}
		if( $classselectforquarter === "grade_5") {
			$section_name_selected = "Grade 5";
		}
		if( $classselectforquarter === "grade_6") {
			$section_name_selected = "Grade 6";
		}

		$selectstudentgrades = "SELECT * FROM grades INNER JOIN student ON grades.grade_student_id = student.student_id WHERE student.section = '$section_name_selected' AND student.subject = '$subjectselectforquarter' AND grades.grade_quarter = '$quarterselected' AND grades.grade_subject = '$subjectselectforquarter' ";
		$resultstudentgrades = mysqli_query($conn, $selectstudentgrades);
			if (mysqli_num_rows($resultstudentgrades) > 0) {

				while($rowstudentgrades = mysqli_fetch_assoc($resultstudentgrades)) {

				 $fullname = $rowstudentgrades["lastname"] . ", " . $rowstudentgrades["firstname"] . " " . $rowstudentgrades["middlename"]; 

					$studentlistfor[] = "<tr class='grades'><td class='expand' id='".$rowstudentgrades["grade_student_id"]."'>".$fullname."</td><td class='shrink ini_grade' id='ini".$rowstudentgrades["grade_student_id"]."'>".$rowstudentgrades["initial_grade"]."</td><td class='shrink ' id='qg".$rowstudentgrades["grade_student_id"]."'>".$rowstudentgrades["quarterly_grade"]."</td></tr>";
				}

				$data["studentlistfor"] = $studentlistfor;
				
			}

	}
	//for quarterly assessment
	if(isset($quarterselected, $subjectselectforquarter, $classselectforquarter)){
		$selectqapercent = "SELECT subj_qa FROM subject WHERE subj_name = '$subjectselectforquarter' ";
			$resultqapercent = mysqli_query($conn, $selectqapercent);
			$rowqapercent = mysqli_fetch_assoc($resultqapercent);
			$qapercent = substr($rowqapercent["subj_qa"], 1);
		
		$selecthspforqa = "SELECT * FROM hsp WHERE hsp_section = '$classselectforquarter' AND hsp_subject = '$subjectselectforquarter' AND hsp_quarter = '$quarterselected' AND hsp_for = 'quarterlyassessment'";
		$resulthspforqa = mysqli_query($conn, $selecthspforqa);
		if (mysqli_num_rows($resulthspforqa) > 0) {
			while($rowhspforqa = mysqli_fetch_assoc($resulthspforqa)) {
				if( $rowhspforqa["item_1"] !== ""){
					$item_1 = "<span class = 'item_1'>".$rowhspforqa['item_1']."</span>";
				}else{
					$item_1 = "<input type='text' class='item_1'>";
				}

				$inputhspqa = "<th class='expand'>Highest Possible Score</th><th class='shrink hpsinput hspqa_total'>".$item_1."</th></th><th class='shrink'>100</th><th class='shrink qawspercent' id='".$rowqapercent["subj_qa"]."'>".$qapercent."%</th>";
				$data["hspforqa"] = $inputhspqa;

			}

		}else{
			$inputhspqa = "<th class='expand'>Highest Possible Score</th><th class='shrink hpsinput hspqa_total'><input type='text' class='item_1'></th></th><th class='shrink'>100</th><th class='shrink qawspercent' id='".$rowqapercent["subj_qa"]."'>".$qapercent."%</th>";
			$data["hspforqa"] = $inputhspqa;
		}

		$section_name_selected;
		if( $classselectforquarter === "kindergarten_1") {
			$section_name_selected = "Kindergarten 1";
		}
		if( $classselectforquarter === "kindergarten_2") {
			$section_name_selected = "Kindergarten 2";
		}
		if( $classselectforquarter === "preparatory") {
			$section_name_selected = "Preparatory";
		}
		if( $classselectforquarter === "grade_1") {
			$section_name_selected = "Grade 1";
		}
		if( $classselectforquarter === "grade_2") {
			$section_name_selected = "Grade 2";
		}
		if( $classselectforquarter === "grade_3") {
			$section_name_selected = "Grade 3";
		}
		if( $classselectforquarter === "grade_4") {
			$section_name_selected = "Grade 4";
		}
		if( $classselectforquarter === "grade_5") {
			$section_name_selected = "Grade 5";
		}
		if( $classselectforquarter === "grade_6") {
			$section_name_selected = "Grade 6";
		}

		$selectstudentgradesqa = "SELECT * FROM quarterassesment INNER JOIN student ON quarterassesment.qa_student_id = student.student_id WHERE student.section = '$section_name_selected' AND student.subject = '$subjectselectforquarter' AND quarterassesment.qa_quarter = '$quarterselected' AND quarterassesment.qa_subj = '$subjectselectforquarter' ";
		$resultstudentgradesqa = mysqli_query($conn, $selectstudentgradesqa);
			if (mysqli_num_rows($resultstudentgradesqa) > 0) {

				while($rowstudentgradesqa = mysqli_fetch_assoc($resultstudentgradesqa)) {
					if( !$rowstudentgradesqa["exam_score"] == ""){
						$exam_score = $rowstudentgradesqa["exam_score"];
					}else{
						$exam_score = "<input type = 'text' class='inputgrades'>";	
					}

				 $fullname = $rowstudentgradesqa["lastname"] . ", " . $rowstudentgradesqa["firstname"] . " " . $rowstudentgradesqa["middlename"]; 

					$studentlistforqa[] = "<tr class='quarterassesment'><td id='".$rowstudentgradesqa["qa_student_id"]."' class='qaname'>".$fullname."</td><td class='exam_score'>".$exam_score."</td><td class='pstotal'>".$rowstudentgradesqa["qa_ps"]."</td><td class='wstotal' id='qa".$rowstudentgradesqa["qa_student_id"]."'>".$rowstudentgradesqa["qa_ws"]."</td><td><a href= '' class='btn-edit-grades-qa'><i class='fa fa-pencil-square-o fa-lg'></i> Edit</a></td></tr>";
				}

				$data["studentlistforqa"] = $studentlistforqa;
			}

	}


	//for perfomance tasks
	if(isset($quarterselected, $subjectselectforquarter, $classselectforquarter)){
		$selectptpercent = "SELECT subj_pt FROM subject WHERE subj_name = '$subjectselectforquarter' ";
			$resultptpercent = mysqli_query($conn, $selectptpercent);
			$rowptpercent = mysqli_fetch_assoc($resultptpercent);
			$ptpercent = substr($rowptpercent["subj_pt"], 1);

		$selecthspforpt = "SELECT * FROM hsp WHERE hsp_section = '$classselectforquarter' AND hsp_subject = '$subjectselectforquarter' AND hsp_quarter = '$quarterselected' AND hsp_for = 'performancetasks'";
		$resulthspforpt = mysqli_query($conn, $selecthspforpt);
		if (mysqli_num_rows($resulthspforpt) > 0) {
			while($rowhspforpt = mysqli_fetch_assoc($resulthspforpt)) {
				if( $rowhspforpt["item_1"] !== ""){
					$item_1 = "<span class = 'item_1'>".$rowhspforpt['item_1']."</span>";
				}else{
					$item_1 = "<input type='text' class='item_1'>";
				}
				if( $rowhspforpt["item_2"] !== ""){
					$item_2 = "<span class = 'item_2'>".$rowhspforpt['item_2']."</span>";
				}else{
					$item_2 = "<input type='text' class='item_2'>";
				}
				if( $rowhspforpt["item_3"] !== ""){
					$item_3 = "<span class = 'item_3'>".$rowhspforpt['item_3']."</span>";
				}else{
					$item_3 = "<input type='text' class='item_3'>";
				}
				if( $rowhspforpt["item_4"] !== ""){
					$item_4 = "<span class = 'item_4'>".$rowhspforpt['item_4']."</span>";
				}else{
					$item_4 = "<input type='text' class='item_4'>";
				}
				if( $rowhspforpt["item_5"] !== ""){
					$item_5 = "<span class = 'item_5'>".$rowhspforpt['item_5']."</span>";
				}else{
					$item_5 = "<input type='text' class='item_5'>";
				}
				if( $rowhspforpt["item_6"] !== ""){
					$item_6 = "<span class = 'item_6'>".$rowhspforpt['item_6']."</span>";
				}else{
					$item_6 = "<input type='text' class='item_6'>";
				}
				if( $rowhspforpt["item_7"] !== ""){
					$item_7 = "<span class = 'item_7'>".$rowhspforpt['item_7']."</span>";
				}else{
					$item_7 = "<input type='text' class='item_7'>";
				}
				if( $rowhspforpt["item_8"] !== ""){
					$item_8 = "<span class = 'item_8'>".$rowhspforpt['item_8']."</span>";
				}else{
					$item_8 = "<input type='text' class='item_8'>";
				}
				if( $rowhspforpt["item_9"] !== ""){
					$item_9 = "<span class = 'item_9'>".$rowhspforpt['item_9']."</span>";
				}else{
					$item_9 = "<input type='text' class='item_9'>";
				}
				if( $rowhspforpt["item_10"] !== ""){
					$item_10 = "<span class = 'item_10'>".$rowhspforpt['item_10']."</span>";
				}else{
					$item_10 = "<input type='text' class='item_10'>";
				}

				$inputhsp = "<th class='expand'>Highest Possible Score</th><th class='shrink hpsinput'>".$item_1."</th><th class='shrink hpsinput'>".$item_2."</th><th class='shrink hpsinput'>".$item_3."</th><th class='shrink hpsinput'>".$item_4."</th><th class='shrink hpsinput'>".$item_5."</th><th class='shrink hpsinput'>".$item_6."</th><th class='shrink hpsinput'>".$item_7."</th><th class='shrink hpsinput'>".$item_8."</th><th class='shrink hpsinput'>".$item_9."</th><th class='shrink hpsinput'>".$item_10."</th><th class='shrink hsppt_total'>".$rowhspforpt["hsp_total"]."</th><th class='shrink'>100</th><th class='shrink ptwspercent' id='".$rowptpercent["subj_pt"]."'>".$ptpercent."%</th>";
					$data["hspforpt"] = $inputhsp;
				}
			}else{
				$inputhsp = "<th class='expand'>Highest Possible Score</th><th class='shrink hpsinput'><input type='text' class='item_1'></th><th class='shrink hpsinput'><input type='text' class='item_2'></th><th class='shrink hpsinput'><input type='text' class='item_3'></th><th class='shrink hpsinput'><input type='text' class='item_4'></th><th class='shrink hpsinput'><input type='text' class='item_5'></th><th class='shrink hpsinput'><input type='text' class='item_6'></th><th class='shrink hpsinput'><input type='text' class='item_7'></th><th class='shrink hpsinput'><input type='text' class='item_8'></th><th class='shrink hpsinput'><input type='text' class='item_9'></th><th class='shrink hpsinput'><input type='text' class='item_10'></th><th class='shrink hsppt_total'></th><th class='shrink'>100</th><th class='shrink ptwspercent' id='".$rowptpercent["subj_pt"]."'>".$ptpercent."%</th>";
				$data["hspforpt"] = $inputhsp;
			}
		
		$section_name_selected;
		if( $classselectforquarter === "kindergarten_1") {
			$section_name_selected = "Kindergarten 1";
		}
		if( $classselectforquarter === "kindergarten_2") {
			$section_name_selected = "Kindergarten 2";
		}
		if( $classselectforquarter === "preparatory") {
			$section_name_selected = "Preparatory";
		}
		if( $classselectforquarter === "grade_1") {
			$section_name_selected = "Grade 1";
		}
		if( $classselectforquarter === "grade_2") {
			$section_name_selected = "Grade 2";
		}
		if( $classselectforquarter === "grade_3") {
			$section_name_selected = "Grade 3";
		}
		if( $classselectforquarter === "grade_4") {
			$section_name_selected = "Grade 4";
		}
		if( $classselectforquarter === "grade_5") {
			$section_name_selected = "Grade 5";
		}
		if( $classselectforquarter === "grade_6") {
			$section_name_selected = "Grade 6";
		}

		$selectstudentgradespt = "SELECT * FROM performancetask INNER JOIN student ON performancetask.pt_student_id = student.student_id WHERE performancetask.pt_quarter = '$quarterselected' AND performancetask.pt_subj = '$subjectselectforquarter' AND performancetask.pt_section = '$section_name_selected' AND student.section = '$section_name_selected' AND student.subject = '$subjectselectforquarter'";
		$resultstudentgradespt = mysqli_query($conn, $selectstudentgradespt);
			if (mysqli_num_rows($resultstudentgradespt) > 0) {

				while($rowstudentgradespt = mysqli_fetch_assoc($resultstudentgradespt)) {
					if( !$rowstudentgradespt["item_1"] == ""){
						$item_1 = $rowstudentgradespt["item_1"];
					}else{
						$item_1 = "<input type = 'text' class='inputgrades item_1'>";	
					}
					if( !$rowstudentgradespt["item_2"] == ""){
						$item_2 = $rowstudentgradespt["item_2"];
					}else{
						$item_2 = "<input type = 'text' class='inputgrades item_2'>";	
					}
					if( !$rowstudentgradespt["item_3"] == ""){
						$item_3 = $rowstudentgradespt["item_3"];
					}else{
						$item_3 = "<input type = 'text' class='inputgrades item_3'>";	
					}
					if( !$rowstudentgradespt["item_4"] == ""){
						$item_4 = $rowstudentgradespt["item_4"];
					}else{
						$item_4 = "<input type = 'text' class='inputgrades item_4'>";	
					}
					if( !$rowstudentgradespt["item_5"] == ""){
						$item_5 = $rowstudentgradespt["item_5"];
					}else{
						$item_5 = "<input type = 'text' class='inputgrades item_5'>";	
					}
					if( !$rowstudentgradespt["item_6"] == ""){
						$item_6 = $rowstudentgradespt["item_6"];
					}else{
						$item_6 = "<input type = 'text' class='inputgrades item_6'>";	
					}
					if( !$rowstudentgradespt["item_7"] == ""){
						$item_7 = $rowstudentgradespt["item_7"];
					}else{
						$item_7 = "<input type = 'text' class='inputgrades item_7'>";	
					}
					if( !$rowstudentgradespt["item_8"] == ""){
						$item_8 = $rowstudentgradespt["item_8"];
					}else{
						$item_8 = "<input type = 'text' class='inputgrades item_8'>";	
					}
					if( !$rowstudentgradespt["item_9"] == ""){
						$item_9 = $rowstudentgradespt["item_9"];
					}else{
						$item_9 = "<input type = 'text' class='inputgrades item_9'>";	
					}
					if( !$rowstudentgradespt["item_10"] == ""){
						$item_10 = $rowstudentgradespt["item_10"];
					}else{
						$item_10 = "<input type = 'text' class='inputgrades item_10'>";	
					}

				 $fullname = $rowstudentgradespt["lastname"] . ", " . $rowstudentgradespt["firstname"] . " " . $rowstudentgradespt["middlename"]; 

					$studentlistforpt[] = "<tr class='performancetask'><td id = '".$rowstudentgradespt["pt_student_id"]."' class='ptname'>".$fullname."</td><td class='item_1'>".$item_1."</td><td class='item_2'>".$item_2."</td><td class='item_3'>".$item_3."</td><td class='item_4'>".$item_4."</td><td class='item_5'>".$item_5."</td><td class='item_6'>".$item_6."</td><td class='item_7'>".$item_7."</td><td class='item_8'>".$item_8."</td><td class='item_9'>".$item_9."</td><td class='item_10'>".$item_10."</td><td class='totalforgradeww'>".$rowstudentgradespt["pt_total"]."</td><td class='pstotal'>".$rowstudentgradespt["pt_ps"]."</td><td class='wstotal' id='pt".$rowstudentgradespt["pt_student_id"]."'>".$rowstudentgradespt["pt_ws"]."</td><td><a href= '' class='btn-edit-grades-pt'><i class='fa fa-pencil-square-o'></i> Edit</a></td></tr>";
				}

				$data["studentlistforpt"] = $studentlistforpt;
			}
			
	}
	//for written works
	if(isset($quarterselected, $subjectselectforquarter, $classselectforquarter)){
			$selectwwpercent = "SELECT subj_ww FROM subject WHERE subj_name = '$subjectselectforquarter' ";
			$resultwwpercent = mysqli_query($conn, $selectwwpercent);
			$rowwwpercent = mysqli_fetch_assoc($resultwwpercent);
			$wwpercent = substr($rowwwpercent["subj_ww"], 1);
		$selecthsp = "SELECT * FROM hsp WHERE hsp_section = '$classselectforquarter' AND hsp_subject = '$subjectselectforquarter' AND hsp_quarter = '$quarterselected' AND hsp_for = 'writtenworks'";
		$resulthsp = mysqli_query($conn, $selecthsp);
			
		if (mysqli_num_rows($resulthsp) > 0) {
			while($rowhsp = mysqli_fetch_assoc($resulthsp)) {
				if( $rowhsp["item_1"] !== ""){
					$item_1 = "<span class = 'item_1'>".$rowhsp['item_1']."</span>";
				}else{
					$item_1 = "<input type='text' class='item_1'>";
				}
				if( $rowhsp["item_2"] !== ""){
					$item_2 = "<span class = 'item_2'>".$rowhsp['item_2']."</span>";
				}else{
					$item_2 = "<input type='text' class='item_2'>";
				}
				if( $rowhsp["item_3"] !== ""){
					$item_3 = "<span class = 'item_3'>".$rowhsp['item_3']."</span>";
				}else{
					$item_3 = "<input type='text' class='item_3'>";
				}
				if( $rowhsp["item_4"] !== ""){
					$item_4 = "<span class = 'item_4'>".$rowhsp['item_4']."</span>";
				}else{
					$item_4 = "<input type='text' class='item_4'>";
				}
				if( $rowhsp["item_5"] !== ""){
					$item_5 = "<span class = 'item_5'>".$rowhsp['item_5']."</span>";
				}else{
					$item_5 = "<input type='text' class='item_5'>";
				}
				if( $rowhsp["item_6"] !== ""){
					$item_6 = "<span class = 'item_6'>".$rowhsp['item_6']."</span>";
				}else{
					$item_6 = "<input type='text' class='item_6'>";
				}
				if( $rowhsp["item_7"] !== ""){
					$item_7 = "<span class = 'item_7'>".$rowhsp['item_7']."</span>";
				}else{
					$item_7 = "<input type='text' class='item_7'>";
				}
				if( $rowhsp["item_8"] !== ""){
					$item_8 = "<span class = 'item_8'>".$rowhsp['item_8']."</span>";
				}else{
					$item_8 = "<input type='text' class='item_8'>";
				}
				if( $rowhsp["item_9"] !== ""){
					$item_9 = "<span class = 'item_9'>".$rowhsp['item_9']."</span>";
				}else{
					$item_9 = "<input type='text' class='item_9'>";
				}
				if( $rowhsp["item_10"] !== ""){
					$item_10 = "<span class = 'item_10'>".$rowhsp['item_10']."</span>";
				}else{
					$item_10 = "<input type='text' class='item_10'>";
				}

				$inputhsp = "<th class='expand'>Highest Possible Score</th><th class='shrink hpsinput'>".$item_1."</th><th class='shrink hpsinput'>".$item_2."</th><th class='shrink hpsinput'>".$item_3."</th><th class='shrink hpsinput'>".$item_4."</th><th class='shrink hpsinput'>".$item_5."</th><th class='shrink hpsinput'>".$item_6."</th><th class='shrink hpsinput'>".$item_7."</th><th class='shrink hpsinput'>".$item_8."</th><th class='shrink hpsinput'>".$item_9."</th><th class='shrink hpsinput'>".$item_10."</th><th class='shrink hspww_total'>".$rowhsp["hsp_total"]."</th><th class='shrink'>100</th><th class='shrink wwwspercent' id='".$rowwwpercent["subj_ww"]."'>".$wwpercent."%</th>";
				$data["countstudent"] = $inputhsp;
			}
		}else{
			$inputhsp = "<th class='expand'>Highest Possible Score</th><th class='shrink hpsinput'><input type='text' class='item_1'></th><th class='shrink hpsinput'><input type='text' class='item_2'></th><th class='shrink hpsinput'><input type='text' class='item_3'></th><th class='shrink hpsinput'><input type='text' class='item_4'></th><th class='shrink hpsinput'><input type='text' class='item_5'></th><th class='shrink hpsinput'><input type='text' class='item_6'></th><th class='shrink hpsinput'><input type='text' class='item_7'></th><th class='shrink hpsinput'><input type='text' class='item_8'></th><th class='shrink hpsinput'><input type='text' class='item_9'></th><th class='shrink hpsinput'><input type='text' class='item_10'></th><th class='shrink hspww_total'></th><th class='shrink'>100</th><th class='shrink wwwspercent' id='".$rowwwpercent["subj_ww"]."'>".$wwpercent."%</th>";
			$data["countstudent"] = $inputhsp;
		}

		//RETRIEVE STUDENTS

		$section_name_selected;
		if( $classselectforquarter === "kindergarten_1") {
			$section_name_selected = "Kindergarten 1";
		}
		if( $classselectforquarter === "kindergarten_2") {
			$section_name_selected = "Kindergarten 2";
		}
		if( $classselectforquarter === "preparatory") {
			$section_name_selected = "Preparatory";
		}
		if( $classselectforquarter === "grade_1") {
			$section_name_selected = "Grade 1";
		}
		if( $classselectforquarter === "grade_2") {
			$section_name_selected = "Grade 2";
		}
		if( $classselectforquarter === "grade_3") {
			$section_name_selected = "Grade 3";
		}
		if( $classselectforquarter === "grade_4") {
			$section_name_selected = "Grade 4";
		}
		if( $classselectforquarter === "grade_5") {
			$section_name_selected = "Grade 5";
		}
		if( $classselectforquarter === "grade_6") {
			$section_name_selected = "Grade 6";
		}

		$selectstudentgradeww = "SELECT * FROM writtenworks INNER JOIN student ON writtenworks.ww_student_id = student.student_id WHERE writtenworks.ww_quarter = '$quarterselected' AND writtenworks.ww_subj = '$subjectselectforquarter' AND writtenworks.ww_section = '$section_name_selected' AND student.section = '$section_name_selected' AND student.subject = '$subjectselectforquarter' ";
		$resultstudentgradeww = mysqli_query($conn, $selectstudentgradeww);
		if (mysqli_num_rows($resultstudentgradeww) > 0) {

				while($rowstudentgradeww = mysqli_fetch_assoc($resultstudentgradeww)) {
					if( !$rowstudentgradeww["item_1"] == ""){
						$item_1 = $rowstudentgradeww["item_1"];
					}else{
						$item_1 = "<input type = 'text' class='inputgrades item_1'>";	
					}
					if( !$rowstudentgradeww["item_2"] == ""){
						$item_2 = $rowstudentgradeww["item_2"];
					}else{
						$item_2 = "<input type = 'text' class='inputgrades item_2'>";	
					}
					if( !$rowstudentgradeww["item_3"] == ""){
						$item_3 = $rowstudentgradeww["item_3"];
					}else{
						$item_3 = "<input type = 'text' class='inputgrades item_3'>";	
					}
					if( !$rowstudentgradeww["item_4"] == ""){
						$item_4 = $rowstudentgradeww["item_4"];
					}else{
						$item_4 = "<input type = 'text' class='inputgrades item_4'>";	
					}
					if( !$rowstudentgradeww["item_5"] == ""){
						$item_5 = $rowstudentgradeww["item_5"];
					}else{
						$item_5 = "<input type = 'text' class='inputgrades item_5'>";	
					}
					if( !$rowstudentgradeww["item_6"] == ""){
						$item_6 = $rowstudentgradeww["item_6"];
					}else{
						$item_6 = "<input type = 'text' class='inputgrades item_6'>";	
					}
					if( !$rowstudentgradeww["item_7"] == ""){
						$item_7 = $rowstudentgradeww["item_7"];
					}else{
						$item_7 = "<input type = 'text' class='inputgrades item_7'>";	
					}
					if( !$rowstudentgradeww["item_8"] == ""){
						$item_8 = $rowstudentgradeww["item_8"];
					}else{
						$item_8 = "<input type = 'text' class='inputgrades item_8'>";	
					}
					if( !$rowstudentgradeww["item_9"] == ""){
						$item_9 = $rowstudentgradeww["item_9"];
					}else{
						$item_9 = "<input type = 'text' class='inputgrades item_9'>";	
					}
					if( !$rowstudentgradeww["item_10"] == ""){
						$item_10 = $rowstudentgradeww["item_10"];
					}else{
						$item_10 = "<input type = 'text' class='inputgrades item_10'>";	
					}

				 $fullname = $rowstudentgradeww["lastname"] . ", " . $rowstudentgradeww["firstname"] . " " . $rowstudentgradeww["middlename"]; 

					$studentlistforww[] = "<tr class='writtenworks'><td id = '".$rowstudentgradeww["ww_student_id"]."' class='wwname'>".$fullname."</td><td class='item_1'>".$item_1."</td><td class='item_2'>".$item_2."</td><td class='item_3'>".$item_3."</td><td class='item_4'>".$item_4."</td><td class='item_5'>".$item_5."</td><td class='item_6'>".$item_6."</td><td class='item_7'>".$item_7."</td><td class='item_8'>".$item_8."</td><td class='item_9'>".$item_9."</td><td class='item_10'>".$item_10."</td><td class='totalforgradeww'>".$rowstudentgradeww["ww_total"]."</td><td class='pstotal'>".$rowstudentgradeww["ww_ps"]."</td><td class='wstotal' id='ww".$rowstudentgradeww["ww_student_id"]."'>".$rowstudentgradeww["ww_ws"]."</td><td><a href= '' class='btn-edit-grades-ww'><i class='fa fa-pencil-square-o'></i> Edit</a></td></tr>";
				}

				$data["studentlistforww"] = $studentlistforww;
			}

	}

	if(isset($classselectforgrades)){
		$selectsubjectsforgrades = "SELECT class_subject FROM class WHERE class_section='$classselectforgrades' AND professor='$facultyusernamesession'";
		$resultsubjectsforgrades = mysqli_query($conn, $selectsubjectsforgrades);
		while($rowsubjectsforgrades = mysqli_fetch_assoc($resultsubjectsforgrades)) {
			$subjectlistforgrades[] = "<option value='".$rowsubjectsforgrades["class_subject"]."'>".$rowsubjectsforgrades["class_subject"]."</option>";
			$data["subjectlistforgrades"] = $subjectlistforgrades;
		}
		
	}

	if( isset($classnametoremove, $classsectiontoremove, $classsubjecttoremove)){
		$section_to_remove;
		if( $classsectiontoremove === "Kindergarten 1") {
			$section_to_remove = "kindergarten_1";
		}
		if( $classsectiontoremove === "Kindergarten 2") {
			$section_to_remove = "kindergarten_2";
		}
		if( $classsectiontoremove === "Preparatory") {
			$section_to_remove = "preparatory";
		}
		if( $classsectiontoremove === "Grade 1") {
			$section_to_remove = "grade_1";
		}
		if( $classsectiontoremove === "Grade 2") {
			$section_to_remove = "grade_2";
		}
		if( $classsectiontoremove === "Grade 3") {
			$section_to_remove = "grade_3";
		}
		if( $classsectiontoremove === "Grade 4") {
			$section_to_remove = "grade_4";
		}
		if( $classsectiontoremove === "Grade 5") {
			$section_to_remove = "grade_5";
		}
		if( $classsectiontoremove === "Grade 6") {
			$section_to_remove = "grade_6";
		}

		$removefromclass = "DELETE FROM class WHERE class_name = '$classnametoremove' AND class_section = '$section_to_remove' AND class_subject='$classsubjecttoremove' AND professor = '$facultyusernamesession'";
		$dropstudentsfromclass = "DELETE FROM student WHERE section = '$classsectiontoremove' AND subject = '$classsubjecttoremove' AND professor = '$facultyusernamesession'";
		if( mysqli_query($conn, $removefromclass) AND mysqli_query($conn, $dropstudentsfromclass)){
			$data["removeclass"] = true;
		}else{
			$data["removeclass"] = mysqli_error($conn);
		}

		
	}

	if(isset($studentselect, $studentclass)){
		$section_name_selected;
		if( $studentclass === "kindergarten_1") {
			$section_name_selected = "Kindergarten 1";
		}
		if( $studentclass === "kindergarten_2") {
			$section_name_selected = "Kindergarten 2";
		}
		if( $studentclass === "preparatory") {
			$section_name_selected = "Preparatory";
		}
		if( $studentclass === "grade_1") {
			$section_name_selected = "Grade 1";
		}
		if( $studentclass === "grade_2") {
			$section_name_selected = "Grade 2";
		}
		if( $studentclass === "grade_3") {
			$section_name_selected = "Grade 3";
		}
		if( $studentclass === "grade_4") {
			$section_name_selected = "Grade 4";
		}
		if( $studentclass === "grade_5") {
			$section_name_selected = "Grade 5";
		}
		if( $studentclass === "grade_6") {
			$section_name_selected = "Grade 6";
		}
		$data["gg"] = $studentselect.$section_name_selected;
		$selectsubject = "SELECT subject FROM student WHERE student_id = '$studentselect' AND section = '$section_name_selected' AND professor = '$facultyusernamesession'";
		$resultsubject = mysqli_query($conn, $selectsubject);
		if (mysqli_num_rows($resultsubject) > 0) {
			$data["subjectcapture"] = true;
		 	while($rowsubject = mysqli_fetch_assoc($resultsubject)) {
			 	$subjectcapture[] = "<p><input type='radio' class='radiosubject' name='radiosubject' id='".$rowsubject["subject"]."' value='".$rowsubject["subject"]."'/><label for='".$rowsubject["subject"]."'>".$rowsubject["subject"]."</label></p>"; 
			 	$data["subjectcapture"] = $subjectcapture;
			}
		}else{
			$data["subjectcapture"] = false;
		}
	}

	if(isset($classselected)){
		$section_name_selected;
		if( $classselected === "kindergarten_1") {
			$section_name_selected = "Kindergarten 1";
		}
		if( $classselected === "kindergarten_2") {
			$section_name_selected = "Kindergarten 2";
		}
		if( $classselected === "preparatory") {
			$section_name_selected = "Preparatory";
		}
		if( $classselected === "grade_1") {
			$section_name_selected = "Grade 1";
		}
		if( $classselected === "grade_2") {
			$section_name_selected = "Grade 2";
		}
		if( $classselected === "grade_3") {
			$section_name_selected = "Grade 3";
		}
		if( $classselected === "grade_4") {
			$section_name_selected = "Grade 4";
		}
		if( $classselected === "grade_5") {
			$section_name_selected = "Grade 5";
		}
		if( $classselected === "grade_6") {
			$section_name_selected = "Grade 6";
		}
		$selectstudentfromclass = "SELECT student_id, firstname, middlename, lastname FROM student WHERE section = '$section_name_selected' AND professor = '$facultyusernamesession' GROUP BY firstname, middlename, lastname";
		$resultstudentfromclass = mysqli_query($conn, $selectstudentfromclass);
			if (mysqli_num_rows($resultstudentfromclass) > 0) {

 				while($rowstudentfromclass = mysqli_fetch_assoc($resultstudentfromclass)) {

 					$fullname = $rowstudentfromclass["lastname"] .", ". $rowstudentfromclass["firstname"] . " " . $rowstudentfromclass["middlename"];
 					$studentclassselected[] = "<option value='".$rowstudentfromclass["student_id"]."'>".$fullname."</option>";

 					$data["studentclassselected"] = $studentclassselected;
 				}
			}else{
				$data["studentclassselected"] = "<option disabled>No Students added yet.</option>";
			}

	
	}

	if( isset($dropstudid, $studiddel, $classdel, $subjdel) ){
		$dropstudent = "DELETE FROM student WHERE id = '$dropstudid'";
		if( mysqli_query($conn, $dropstudent) ){
			$data["dropstudent"] = true;
		}else{
			$data["dropstudent"] = mysqli_error($conn);
		}

		$delwwofstud = "DELETE FROM writtenworks WHERE ww_student_id ='$studiddel' AND ww_subj = '$subjdel' AND ww_section = '$classdel'";
		mysqli_query($conn, $delwwofstud);
		$delptofstud = "DELETE FROM performancetask WHERE pt_student_id ='$studiddel' AND pt_subj = '$subjdel' AND pt_section = '$classdel'";
		mysqli_query($conn, $delptofstud);
		$delqaofstud = "DELETE FROM quarterassesment WHERE qa_student_id ='$studiddel' AND qa_subj = '$subjdel' AND qa_section = '$classdel'";
		mysqli_query($conn, $delqaofstud);
		$delgradeofstud = "DELETE FROM grades WHERE grade_student_id ='$studiddel' AND grade_subject = '$subjdel' AND grade_section = '$classdel'";
		mysqli_query($conn, $delgradeofstud);
		$delsumgradeofstud = "DELETE FROM summarygrade WHERE sumgrade_student_id ='$studiddel' AND sumgrade_subject = '$subjdel' AND sumgrade_section = '$classdel'";
		mysqli_query($conn, $delsumgradeofstud);

	}

	if(isset($student_first_name_update, $student_middle_name_update, $student_last_name_update, $student_address_update, $student_guardianfn_update, $student_guardianln_update, $guardian_phone_update, $getstudentidupdate)){

		$updatestudent = "UPDATE student SET firstname = '$student_first_name_update', middlename= '$student_middle_name_update', lastname='$student_last_name_update', address='$student_address_update', guardian_firstname='$student_guardianfn_update', guardian_lastname = '$student_guardianln_update', guardian_phone='$guardian_phone_update' WHERE id ='$getstudentidupdate'";
		if (mysqli_query($conn, $updatestudent)) {
		    $data["updatestudent"] = true;
		}else{
			$data["updatestudent"] = mysqli_error($conn);
		}

	}

	if(isset($lisection, $lisubject)){
		$selectstudent= "SELECT * FROM student WHERE section = '$lisection' AND subject = '$lisubject' AND professor = '$facultyusernamesession' ORDER BY id DESC";
		$resultstudent = mysqli_query($conn, $selectstudent);
		
		if (mysqli_num_rows($resultstudent) > 0) {
			$data["studentlistcount"] = mysqli_num_rows($resultstudent);
			 while($rowstudent = mysqli_fetch_assoc($resultstudent)) {


			 	$studentlist[] = "<tr class='".$rowstudent["section"]."' name='".$rowstudent["subject"]."'><td class='td_student_id'>".$rowstudent["student_id"]."</td><td class='td_full'><span class='td_ln_student'>".$rowstudent["lastname"].",&nbsp;</span><span class='td_fn_student'>".$rowstudent["firstname"]."&nbsp;</span><span class='td_mn_student'>".$rowstudent["middlename"]."</span></td><td class='td_add_student'>".$rowstudent["address"]."</td><td class='td_guardian_student'><span class='guardfn'>".$rowstudent["guardian_firstname"]. "</span> <span class='guardln'>".$rowstudent["guardian_lastname"]."</span></td><td class='td_guardian_phone_student'>".$rowstudent["guardian_phone"]."</td><td>
				<a href='' class='green-text btn-update-student' id='".$rowstudent["id"]."'><i class='fa fa-pencil-square-o fa-2x' ></i></a>
				<a href='' class='red-text btn-drop-student' id='".$rowstudent["id"]."'><i class='fa fa-minus-circle fa-2x'></i></i></a>
			 	</td></tr>";
			 	$data["studentlist"] = $studentlist;

			 }

		}else{
			//no result
			$data["studentlistcount"] = "0";
			$data["studentlist"] = "none";
		}
	}

	//Student
	if(isset($student_first_name, $student_middle_name, $student_last_name, $student_address, $student_guardianfn, $student_guardianln, $student_id)){
		$insertstudent = "INSERT INTO student (student_id, firstname, middlename, lastname, address, guardian_firstname,guardian_lastname, guardian_phone, section, subject, professor) VALUES ('$student_id','$student_first_name','$student_middle_name','$student_last_name','$student_address','$student_guardianfn','$student_guardianln','$guardian_phone','$student_section','$student_subject','$facultyusernamesession')";
		if( mysqli_query($conn, $insertstudent)){
			$data["studentadd"] = true;
		}else{
			$data["studentadd"] = mysqli_error($conn);
		}

		
		$insertintoww = "INSERT INTO writtenworks (ww_quarter, ww_student_id, ww_subj, ww_section) VALUES ('quarterone', '$student_id', '$student_subject', '$student_section'), ('quartertwo', '$student_id', '$student_subject', '$student_section'), ('quarterthree', '$student_id', '$student_subject', '$student_section'), ('quarterfour', '$student_id', '$student_subject', '$student_section')";
		mysqli_query($conn, $insertintoww);
		$insertintopt = "INSERT INTO performancetask (pt_quarter, pt_student_id, pt_subj, pt_section) VALUES ('quarterone', '$student_id', '$student_subject', '$student_section'), ('quartertwo', '$student_id', '$student_subject', '$student_section'), ('quarterthree', '$student_id', '$student_subject', '$student_section'), ('quarterfour', '$student_id', '$student_subject', '$student_section')";
		mysqli_query($conn, $insertintopt);
		$insertintoqa = "INSERT INTO quarterassesment (qa_quarter, qa_student_id, qa_subj, qa_section) VALUES ('quarterone', '$student_id', '$student_subject', '$student_section'), ('quartertwo', '$student_id', '$student_subject', '$student_section'), ('quarterthree', '$student_id', '$student_subject', '$student_section'), ('quarterfour', '$student_id', '$student_subject', '$student_section')";
		mysqli_query($conn, $insertintoqa);
		$insertintogrades = "INSERT INTO grades (grade_subject, grade_section, grade_quarter, grade_student_id) VALUES ('$student_subject','$student_section', 'quarterone', '$student_id'), ('$student_subject','$student_section', 'quartertwo', '$student_id'), ('$student_subject','$student_section', 'quarterthree', '$student_id'), ('$student_subject','$student_section', 'quarterfour', '$student_id')";
		mysqli_query($conn, $insertintogrades);
		$insertintosumgrades = "INSERT INTO summarygrade (sumgrade_subject, sumgrade_section, sumgrade_student_id) VALUES ('$student_subject','$student_section', '$student_id')";
		mysqli_query($conn, $insertintosumgrades);

	}

	//FAculty Class
	if(isset($class_name,$class_section, $filipino)){
		$checkselect = "SELECT * FROM class WHERE class_section='$class_section' AND class_subject = '$filipino'";
		$checkresult = mysqli_query($conn, $checkselect);
		 if (mysqli_num_rows($checkresult) > 0) {
		 	$data["class"] = false;
			while($checkrow = mysqli_fetch_assoc($checkresult)) {
				$data["section_error"] = $checkrow["class_section"];
				$subject[] = $checkrow["class_subject"];
				$data["subject_error"] = $subject;
			}
		 }else{
		 	$insertclassfilipino = "INSERT INTO class (class_name, class_section, class_subject, professor) VALUES ('$class_name', '$class_section','$filipino', '$facultyusernamesession')";
			if( mysqli_query($conn, $insertclassfilipino) ){
				$data["class"] = true;
			}else{
				$data["class"] = mysqli_error($conn);
			}
		 }
	}

	if(isset($class_name,$class_section, $english)){
		$checkselect = "SELECT * FROM class WHERE class_section='$class_section' AND class_subject = '$english'";
		$checkresult = mysqli_query($conn, $checkselect);
		 if (mysqli_num_rows($checkresult) > 0) {
		 	$data["class"] = false;
			while($checkrow = mysqli_fetch_assoc($checkresult)) {
				$data["section_error"] = $checkrow["class_section"];
				$subject[] = $checkrow["class_subject"];
				$data["subject_error"] = $subject;
			}
		 }else{
		 	$insertclassfilipino = "INSERT INTO class (class_name, class_section, class_subject, professor) VALUES ('$class_name', '$class_section','$english', '$facultyusernamesession')";
			if( mysqli_query($conn, $insertclassfilipino) ){
				$data["class"] = true;
			}else{
				$data["class"] = mysqli_error($conn);
			}
		 }
		
	}
	if(isset($class_name,$class_section, $math)){
		$checkselect = "SELECT * FROM class WHERE class_section='$class_section' AND class_subject = '$math'";
		$checkresult = mysqli_query($conn, $checkselect);
		 if (mysqli_num_rows($checkresult) > 0) {
		 	$data["class"] = false;
			while($checkrow = mysqli_fetch_assoc($checkresult)) {
				$data["section_error"] = $checkrow["class_section"];
				$subject[] = $checkrow["class_subject"];
				$data["subject_error"] = $subject;
			}
		 }else{
		 	$insertclassfilipino = "INSERT INTO class (class_name, class_section, class_subject, professor) VALUES ('$class_name', '$class_section','$math', '$facultyusernamesession')";
			if( mysqli_query($conn, $insertclassfilipino) ){
				$data["class"] = true;
			}else{
				$data["class"] = mysqli_error($conn);
			}
		 }
		
	}
	if(isset($class_name,$class_section, $science)){
		$checkselect = "SELECT * FROM class WHERE class_section='$class_section' AND class_subject = '$science'";
		$checkresult = mysqli_query($conn, $checkselect);
		 if (mysqli_num_rows($checkresult) > 0) {
		 	$data["class"] = false;
			while($checkrow = mysqli_fetch_assoc($checkresult)) {
				$data["section_error"] = $checkrow["class_section"];
				$subject[] = $checkrow["class_subject"];
				$data["subject_error"] = $subject;
			}
		 }else{
		 	$insertclassfilipino = "INSERT INTO class (class_name, class_section, class_subject, professor) VALUES ('$class_name', '$class_section','$science', '$facultyusernamesession')";
			if( mysqli_query($conn, $insertclassfilipino) ){
				$data["class"] = true;
			}else{
				$data["class"] = mysqli_error($conn);
			}
		 }
		
	}
	if(isset($class_name,$class_section, $ap)){
		$checkselect = "SELECT * FROM class WHERE class_section='$class_section' AND class_subject = '$ap'";
		$checkresult = mysqli_query($conn, $checkselect);
		 if (mysqli_num_rows($checkresult) > 0) {
		 	$data["class"] = false;
			while($checkrow = mysqli_fetch_assoc($checkresult)) {
				$data["section_error"] = $checkrow["class_section"];
				$subject[] = $checkrow["class_subject"];
				$data["subject_error"] = $subject;
			}
		 }else{
		 	$insertclassfilipino = "INSERT INTO class (class_name, class_section, class_subject, professor) VALUES ('$class_name', '$class_section','$ap', '$facultyusernamesession')";
		if( mysqli_query($conn, $insertclassfilipino) ){
			$data["class"] = true;
		}else{
			$data["class"] = mysqli_error($conn);
		}
		 }
		
	}
	if(isset($class_name,$class_section, $mapeh)){
		$checkselect = "SELECT * FROM class WHERE class_section='$class_section' AND class_subject = '$mapeh'";
		$checkresult = mysqli_query($conn, $checkselect);
		 if (mysqli_num_rows($checkresult) > 0) {
		 	$data["class"] = false;
			while($checkrow = mysqli_fetch_assoc($checkresult)) {
				$data["section_error"] = $checkrow["class_section"];
				$subject[] = $checkrow["class_subject"];
				$data["subject_error"] = $subject;
			}
		 }else{
		 	$insertclassfilipino = "INSERT INTO class (class_name, class_section, class_subject, professor) VALUES ('$class_name', '$class_section','$mapeh', '$facultyusernamesession')";
			if( mysqli_query($conn, $insertclassfilipino) ){
				$data["class"] = true;
			}else{
				$data["class"] = mysqli_error($conn);
			}
		 }
		
	}
	if(isset($class_name,$class_section, $esp)){
		$checkselect = "SELECT * FROM class WHERE class_section='$class_section' AND class_subject = '$esp'";
		$checkresult = mysqli_query($conn, $checkselect);
		 if (mysqli_num_rows($checkresult) > 0) {
		 	$data["class"] = false;
			while($checkrow = mysqli_fetch_assoc($checkresult)) {
				$data["section_error"] = $checkrow["class_section"];
				$subject[] = $checkrow["class_subject"];
				$data["subject_error"] = $subject;
			}
		 }else{
		 	$insertclassfilipino = "INSERT INTO class (class_name, class_section, class_subject, professor) VALUES ('$class_name', '$class_section','$esp', '$facultyusernamesession')";
			if( mysqli_query($conn, $insertclassfilipino) ){
				$data["class"] = true;
			}else{
				$data["class"] = mysqli_error($conn);
			}
		 }
		
	}
	if(isset($class_name,$class_section, $epp)){
		$checkselect = "SELECT * FROM class WHERE class_section='$class_section' AND class_subject = '$epp'";
		$checkresult = mysqli_query($conn, $checkselect);
		 if (mysqli_num_rows($checkresult) > 0) {
		 	$data["class"] = false;
			while($checkrow = mysqli_fetch_assoc($checkresult)) {
				$data["section_error"] = $checkrow["class_section"];
				$subject[] = $checkrow["class_subject"];
				$data["subject_error"] = $subject;
			}
		 }else{
		 	$insertclassfilipino = "INSERT INTO class (class_name, class_section, class_subject, professor) VALUES ('$class_name', '$class_section','$epp', '$facultyusernamesession')";
			if( mysqli_query($conn, $insertclassfilipino) ){
				$data["class"] = true;
			}else{
				$data["class"] = mysqli_error($conn);
			}	
		 }
	}





	if( isset($facultyusernamesession) ){
			//Faculty Get All info
		$facultyselect = "SELECT * FROM faculty_account WHERE employee_id = '$facultyusernamesession' ";
		$facultyresult = mysqli_query($conn, $facultyselect);
		$facultyrow = mysqli_fetch_assoc($facultyresult);

		$facultyProfileInfo["firstname"] = $facultyrow["firstname"];
		$facultyProfileInfo["middlename"] = $facultyrow["middlename"];
		$facultyProfileInfo["lastname"] = $facultyrow["lastname"];
		$facultyProfileInfo["position"] = $facultyrow["position"];
		$facultyProfileInfo["employee_id"] = $facultyrow["employee_id"];
		$facultyProfileInfo["password"] = $facultyrow["password"];
		$facultyProfileInfo["email"] = $facultyrow["email"];
		$facultyProfileInfo["dob"] = $facultyrow["dob"];
		$facultyProfileInfo["gender"] = $facultyrow["gender"];
		$facultyProfileInfo["address"] = $facultyrow["address"];
		$facultyProfileInfo["phone"] = $facultyrow["phone"];
		$facultyProfileInfo["image_src"] = $facultyrow["image_src"];

		$data["facultyProfileInfo"] = $facultyProfileInfo;

		
		$selectclasslist = "SELECT * FROM class WHERE professor= '$facultyusernamesession' ";
		$resultclasslist = mysqli_query($conn, $selectclasslist);
		if (mysqli_num_rows($resultclasslist) > 0) {
			$data["classnumber"] = mysqli_num_rows($resultclasslist);
			$data["classlistcheck"] = true;
		}else{
			$data["classnumber"] = "You have not yet added a Class. add <a href = 'class.php'>here</a>";
			$data["classlistcheck"] = false;
		}
		$selectclassstudent = "SELECT * FROM student WHERE professor = '$facultyusernamesession' GROUP BY section";
		$resultclassstudent = mysqli_query($conn, $selectclassstudent);
		if (mysqli_num_rows($resultclassstudent) > 0) {
			$data["studnumber"] = mysqli_num_rows($resultclasslist);
			$data["studlistcheck"] = true;
		}else{
			$data["studnumber"] = "You have not yet added a Student in you class. add <a href = 'class.php'>here</a>";
			$data["studlistcheck"] = false;
		}

		// FETCH messages
		$selectlstmsgfaculty = "SELECT * FROM latestmessage WHERE from_id = '$facultyusernamesession' OR to_id = '$facultyusernamesession' ORDER BY msg_datetime DESC";
		$resultlstmsgfaculty = mysqli_query($conn, $selectlstmsgfaculty);
		if (mysqli_num_rows($resultlstmsgfaculty) > 0) {
			while($rowlstmsgfaculty = mysqli_fetch_assoc($resultlstmsgfaculty)) {
				$to_idmod;
				if( $rowlstmsgfaculty["to_id"] == $facultyusernamesession ){
					$to_idmod = $rowlstmsgfaculty["from_id"];
				}else if($rowlstmsgfaculty["from_id"] == $facultyusernamesession){
					$to_idmod = $rowlstmsgfaculty["to_id"];
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

	        	$facultymsg[] = "<li class='collection-item avatar li-msg-faculty'><img src='../images/male-user.png' class='circle'><span class='title inbox-receiver-faculty' id='".$to_idmod."'>".$toidname."</span><p class='truncate msg-content'>".$rowlstmsgfaculty["msg_content"]."</p><p class='secondary-content'></p></li>";
	        	$data["msglistfaculty"] = $facultymsg;
	    	}
	    }else{
	        	$data["msglistfaculty"] = "0";

	    }

	
		
		$selectstudentlistforprof = "SELECT * FROM student WHERE professor ='$facultyusernamesession' GROUP BY student_id";
		$resultstudentlistforprof = mysqli_query($conn, $selectstudentlistforprof);
		if (mysqli_num_rows($resultstudentlistforprof) > 0) {
			while($rowstudentlistforprof = mysqli_fetch_assoc($resultstudentlistforprof)) {
				$studentlistforprof[] = "<option value='".$rowstudentlistforprof["student_id"]."'>".$rowstudentlistforprof["lastname"].", ".$rowstudentlistforprof["firstname"]." ".$rowstudentlistforprof["middlename"]."</option>";
			}
			$data["studentlistforprof"]=$studentlistforprof;
		}else{
			$data["studentlistforprof"]="No students added yet.";
		}

		$selectattendance = "SELECT * FROM attendance INNER JOIN student ON attendance.attendance_student_id = student.student_id GROUP BY attendance.attendance_student_id, attendance.attendance_month DESC";
		$resultattendances = mysqli_query($conn, $selectattendance);
		if (mysqli_num_rows($resultattendances) > 0) {
			while($rowattendances = mysqli_fetch_assoc($resultattendances)) {
				$fullname = $rowattendances["lastname"].", ".$rowattendances["firstname"]." ".$rowattendances["middlename"];
				$attendancelist[] = "<tr><td>".$rowattendances["attendance_sy"]."</td><td>".$rowattendances["attendance_student_id"]."</td><td class=''>".$fullname."</td><td>".$rowattendances["attendance_month"]."</td><td>".$rowattendances["days_present"]."</td><td>".$rowattendances["days_late"]."</td><td>".$rowattendances["days_absent"]."</td><td class='action'><a href='' class='blue-text btn-update-attendance' id='".$rowattendances["attendance_id"]."'><i class='fa fa-pencil-square-o fa-lg'></i></a>
				<a href='' class='red-text btn-delete-attendance' id='".$rowattendances["attendance_id"]."'><i class='fa fa fa-trash-o fa-lg'></i></a></td></tr>";
			}
			$data["attendancelist"] = $attendancelist;
		}else{
			$data["attendancelist"] = "0";
		}

		$selectclass = "SELECT * FROM class WHERE professor = '$facultyusernamesession'";
		$resultclass = mysqli_query($conn, $selectclass);
		if (mysqli_num_rows($resultclass) > 0) {
			while($rowclass = mysqli_fetch_assoc($resultclass)) {
				if( $rowclass["class_section"] === "kindergarten_1") {
					$section_name = "Kindergarten 1";
				}
				if( $rowclass["class_section"] === "kindergarten_2") {
					$section_name = "Kindergarten 2";
				}
				if( $rowclass["class_section"] === "preparatory") {
					$section_name = "Preparatory";
				}
				if( $rowclass["class_section"] === "grade_1") {
					$section_name = "Grade 1";
				}
				if( $rowclass["class_section"] === "grade_2") {
					$section_name = "Grade 2";
				}
				if( $rowclass["class_section"] === "grade_3") {
					$section_name = "Grade 3";
				}
				if( $rowclass["class_section"] === "grade_4") {
					$section_name = "Grade 4";
				}
				if( $rowclass["class_section"] === "grade_5") {
					$section_name = "Grade 5";
				}
				if( $rowclass["class_section"] === "grade_6") {
					$section_name = "Grade 6";
				}

				$subjectlist[] = $rowclass["class_subject"];

				$class[] ="<li class=' li-class'><div class='collapsible-header headerli'><span class='li-class-class'>".$rowclass["class_name"]. "</span> - <span class='li-class-section'>" .
				$section_name. "</span><span class='right li-class-subject'>".$rowclass["class_subject"]."</span></div><div class='collapsible-body'>
				<p class='grey-text'>List of Students: 
				<a href='' class='remove-class right red-text'> <i class='fa fa-trash-o fa-2x'></i> </a>
				<a href='' class='add-student-class right'> <i class='fa fa-plus-circle fa-2x'></i> </a>
				</p>
				<table class='highlight centered tableforclassstudlist'>
				<thead>
					<tr class=''>
						<th data-field='student_id'>Student Id</th>
		              	<th data-field='name'>Full name</th>
		              	<th data-field='address'>Address</th>
		              	<th data-field='guardian'>Guardian</th>
		              	<th data-field='guardian_phone'>Guardian Phone</th>
		              	<th data-field='action'>Action</th>
          			</tr>
          		</thead>
          			<tbody class='tableforstudent'>

          			</tbody>
				</table>
				</div></li>";
				$data["classlist"] = $class;

			}
		}else{
			$data["classlist"] = "none";
		}


		$selectallclass = "SELECT class_name, class_section FROM class WHERE professor='$facultyusernamesession' GROUP BY class_section";
		$resultallclass = mysqli_query($conn, $selectallclass);
		if (mysqli_num_rows($resultallclass) > 0) {

			while($rowallclass = mysqli_fetch_assoc($resultallclass)) {
				$section_name;
				if( $rowallclass["class_section"] === "kindergarten_1") {
					$section_name = "Kindergarten 1";
				}
				if( $rowallclass["class_section"] === "kindergarten_2") {
					$section_name = "Kindergarten 2";
				}
				if( $rowallclass["class_section"] === "preparatory") {
					$section_name = "Preparatory";
				}
				if( $rowallclass["class_section"] === "grade_1") {
					$section_name = "Grade 1";
				}
				if( $rowallclass["class_section"] === "grade_2") {
					$section_name = "Grade 2";
				}
				if( $rowallclass["class_section"] === "grade_3") {
					$section_name = "Grade 3";
				}
				if( $rowallclass["class_section"] === "grade_4") {
					$section_name = "Grade 4";
				}
				if( $rowallclass["class_section"] === "grade_5") {
					$section_name = "Grade 5";
				}
				if( $rowallclass["class_section"] === "grade_6") {
					$section_name = "Grade 6";
				}

			       $selectallclassoption[]= "<option value='".$rowallclass["class_section"]."'>".$rowallclass["class_name"]." - ".$section_name."</option>";
			       $data["selectallclassoption"] = $selectallclassoption;
			    }
		}else{
			$data["selectallclassoption"] ="none";
		}
		//Class list for grades
		$selectallclassforgrades = "SELECT class_name, class_section FROM class WHERE professor='$facultyusernamesession' GROUP BY class_section";
		$resultallclassforgrades = mysqli_query($conn, $selectallclassforgrades);
		if (mysqli_num_rows($resultallclassforgrades) > 0) {

			while($rowallclassforgrades = mysqli_fetch_assoc($resultallclassforgrades)) {
				$section_name;
				if( $rowallclassforgrades["class_section"] === "kindergarten_1") {
					$section_name = "Kindergarten 1";
				}
				if( $rowallclassforgrades["class_section"] === "kindergarten_2") {
					$section_name = "Kindergarten 2";
				}
				if( $rowallclassforgrades["class_section"] === "preparatory") {
					$section_name = "Preparatory";
				}
				if( $rowallclassforgrades["class_section"] === "grade_1") {
					$section_name = "Grade 1";
				}
				if( $rowallclassforgrades["class_section"] === "grade_2") {
					$section_name = "Grade 2";
				}
				if( $rowallclassforgrades["class_section"] === "grade_3") {
					$section_name = "Grade 3";
				}
				if( $rowallclassforgrades["class_section"] === "grade_4") {
					$section_name = "Grade 4";
				}
				if( $rowallclassforgrades["class_section"] === "grade_5") {
					$section_name = "Grade 5";
				}
				if( $rowallclassforgrades["class_section"] === "grade_6") {
					$section_name = "Grade 6";
				}

			       $selectallclassoptionforgrades[]= "<option value='".$rowallclassforgrades["class_section"]."'>".$rowallclassforgrades["class_name"]." - ".$section_name."</option>";
			       $data["selectallclassoptionforgrades"] = $selectallclassoptionforgrades;
			    }
		}else{
			$data["selectallclassoptionforgrades"] ="none";
		}


	}//end of session

	//Faculty Update Account Info
	if( isset( $faculty_new_pass ) ){
		$facultynewpassupdate = "UPDATE faculty_account SET password = '$faculty_new_pass' WHERE employee_id = '$facultyusernamesession' ";
		if (mysqli_query($conn, $facultynewpassupdate)) {
		    $data['success'] = true;
		}
	}
	//Faculty Basic Info Update
	if( isset($faculty_firstname) ){
		$facultyupdatefirstname= "UPDATE faculty_account SET firstname='$faculty_firstname' WHERE employee_id='$facultyusernamesession'";
		mysqli_query($conn, $facultyupdatefirstname);
		$facultyProfileInfoUpdate['update_firstname'] = true;
	}
	if( isset($faculty_middlename) ){
		$facultyupdatemiddlename= "UPDATE faculty_account SET middlename='$faculty_middlename' WHERE employee_id='$facultyusernamesession'";
		mysqli_query($conn, $facultyupdatemiddlename);
		$facultyProfileInfoUpdate['update_middlename'] = true;
	}
	if( isset($faculty_lastname) ){
		$facultyupdatelastname= "UPDATE faculty_account SET lastname='$faculty_lastname' WHERE employee_id='$facultyusernamesession'";
		mysqli_query($conn, $facultyupdatelastname);
		$facultyProfileInfoUpdate['update_lastname'] = true;
	}
	if( isset($faculty_gender) ){
		$facultyupdategender= "UPDATE faculty_account SET gender='$faculty_gender' WHERE employee_id='$facultyusernamesession'";
		mysqli_query($conn, $facultyupdategender);
		$facultyProfileInfoUpdate['update_gender'] = true;
	}
	if( isset($faculty_dob) ){
		$facultyupdatedob= "UPDATE faculty_account SET dob='$faculty_dob' WHERE employee_id='$facultyusernamesession'";
		mysqli_query($conn, $facultyupdatedob);
		$facultyProfileInfoUpdate['update_dob'] = true;
	}
	if( isset($faculty_address) ){
		$facultyupdateaddress= "UPDATE faculty_account SET address='$faculty_address' WHERE employee_id='$facultyusernamesession'";
		mysqli_query($conn, $facultyupdateaddress);
		$facultyProfileInfoUpdate['update_address'] = true;
	}
	//Admin Contact Info Update
	if( isset($faculty_position) ){
		$facultyupdateposition= "UPDATE faculty_account SET position='$faculty_position' WHERE employee_id='$facultyusernamesession'";
		mysqli_query($conn, $facultyupdateposition);
		$facultyProfileInfoUpdate['update_position'] = true;
	}
	if( isset($faculty_email) ){
		$facultyupdateemail= "UPDATE faculty_account SET email='$faculty_email' WHERE employee_id='$facultyusernamesession'";
		mysqli_query($conn, $facultyupdateemail);
		$facultyProfileInfoUpdate['update_email'] = true;
	}
	if( isset($faculty_phone) ){
		$facultyupdatephone= "UPDATE faculty_account SET phone='$faculty_phone' WHERE employee_id='$facultyusernamesession'";
		mysqli_query($conn, $facultyupdatephone);
		$facultyProfileInfoUpdate['update_phone'] = true;
	}
	//Input all update message here
	$data['facultyProfileInfoUpdate'] = $facultyProfileInfoUpdate;	
	//faculty Contact Info Update
	if( isset($faculty_position) ){
		$facultyupdateposition= "UPDATE faculty_account SET position='$faculty_position' WHERE employee_id='$facultyusernamesession'";
		mysqli_query($conn, $facultyupdateposition);
		$facultyProfileInfoUpdate['update_position'] = true;
	}
	if( isset($faculty_email) ){
		$facultyupdateemail= "UPDATE faculty_account SET email='$faculty_email' WHERE employee_id='$facultyusernamesession'";
		mysqli_query($conn, $facultyupdateemail);
		$facultyProfileInfoUpdate['update_email'] = true;
	}
	if( isset($faculty_phone) ){
		$facultyupdatephone= "UPDATE faculty_account SET phone='$faculty_phone' WHERE employee_id='$facultyusernamesession'";
		mysqli_query($conn, $facultyupdatephone);
		$facultyProfileInfoUpdate['update_phone'] = true;
	}
	//Input all update message here
	$data['facultyProfileInfoUpdate'] = $facultyProfileInfoUpdate;


	echo json_encode($data);
	mysqli_close($conn);

?>