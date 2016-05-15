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
		if(isset($_FILES['id_list_faculty']['tmp_name'])){
			if(in_array($_FILES['id_list_faculty']['type'],$mimes)){
				if(is_uploaded_file($_FILES['id_list_faculty']['tmp_name'])) {
					$file = $_FILES['id_list_faculty']['tmp_name'];
					$handle = fopen($file, "r");
					$c = 0;
					while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
					{
						$id = $filesop[0];
						$fn = $filesop[1];
						$ln = $filesop[2];
						
						$sql ="INSERT INTO id_account_list (id_list, firstname_list, lastname_list) VALUES ('$id','$fn','$ln')";
						mysqli_query($conn, $sql);
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
		if(isset($_FILES['id_list_parent']['tmp_name'])){
			if(in_array($_FILES['id_list_parent']['type'],$mimes)){
				if(is_uploaded_file($_FILES['id_list_parent']['tmp_name'])) {
					$file = $_FILES['id_list_parent']['tmp_name'];
					$handle = fopen($file, "r");
					$c = 0;
					while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
					{
						$id = $filesop[0];
						$fn = $filesop[1];
						$ln = $filesop[2];
						
						$sql ="INSERT INTO id_account_list_parent (id_list, firstname_list, lastname_list) VALUES ('$id','$fn','$ln')";
						mysqli_query($conn, $sql);
						
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

		if($_FILES["finance_excel_input"]["error"] == 4) {
			$data["financeexcel"] = "norecord";
		}else if(isset($_FILES['finance_excel_input']['tmp_name'])){
			if(in_array($_FILES['finance_excel_input']['type'],$mimes)){
				if(is_uploaded_file($_FILES['finance_excel_input']['tmp_name'])) {
					$file = $_FILES['finance_excel_input']['tmp_name'];
					$handle = fopen($file, "r");
					$c = 0;
					while(($filesop = fgetcsv($handle, 5000, ",")) !== false)
					{
						$academic_year = $filesop[0];
						$student_id = $filesop[1];
						$student_name = $filesop[2];
						$balance = $filesop[3];
						$balance_detail = $filesop[4];
						$status = $filesop[5];
						
						$sql ="INSERT INTO finance (academic_year, student_id, student_name, balance, balance_detail, status) VALUES ('$academic_year','$student_id','$student_name','$balance','$balance_detail','$status')";
						mysqli_query($conn, $sql);
						$c = $c + 1;
					}
				
					if($sql){
						$data["financeexcel"] = true;
						$data["financeexcelrow"] = $c;
					}
				}
			}else{
				$data["financeexcel"] = "File type is not in CSV format. Please check you file again.";
			}
			
		}
	}

	echo json_encode($data);
	mysqli_close($conn);
?>