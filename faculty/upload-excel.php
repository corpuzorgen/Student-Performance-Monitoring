<?php
	session_start();
	include ("../connection.php");
	error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
	$adminnamesession = $_SESSION['adminEmployeeId'];
	$facultyusernamesession = $_SESSION['facultyUsername'];
	$parentnamesession = $_SESSION['parentUsername'];
	mysqli_select_db($conn, 'orgencor_ccsmartkidz');

	$data				= array();

 $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
	if(is_array($_FILES)) {


		if(isset($_FILES['studentlisttoupload']['tmp_name'])){
			if(in_array($_FILES['studentlisttoupload']['type'],$mimes)){
				if(is_uploaded_file($_FILES['studentlisttoupload']['tmp_name'])) {
					$file = $_FILES['studentlisttoupload']['tmp_name'];
					$handle = fopen($file, "r");
					$c = 0;
					while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
					{
						$student_section = $filesop[0];
						$student_subject = $filesop[1];
						$student_id = $filesop[2];
						$firstname = $filesop[3];
						$middlename = $filesop[4];
						$lastname = $filesop[5];
						$address = $filesop[6];
						$guardian_firstname = $filesop[7];
						$guardian_lastname = $filesop[8];
						$guardian_phone = $filesop[9];
						$professor = $_SESSION['facultyUsername'];

						$sql ="INSERT INTO student (student_id, firstname, middlename, lastname, address, guardian_firstname,guardian_lastname, guardian_phone, section, subject, professor) VALUES ('$student_id','$firstname','$middlename','$lastname','$address','$guardian_firstname','$guardian_lastname','$guardian_phone','$student_section','$student_subject','$professor')";
						mysqli_query($conn, $sql);

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

						$c = $c + 1;
					}

					if($sql){
						$data["idexcel"] = true;
						$data["idexcelrow"] = $c;
					}
			
					
				}
			}else{
				$data["idexcel"] = "File type is not in CSV format. Please check you file again.";
			}

			
		}


	}

	echo json_encode($data);
	mysqli_close($conn);
?>