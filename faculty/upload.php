<?php
	session_start();
	include '../connection.php';
	error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
	$adminnamesession = $_SESSION['adminEmployeeId'];
	$facultyusernamesession = $_SESSION['facultyUsername'];
	$parentnamesession = $_SESSION['parentUsername'];
	mysqli_select_db($conn, 'orgencor_ccsmartkidz');

	$data				= array();


	if(is_array($_FILES)) {
		if(is_uploaded_file($_FILES['facultyImage']['tmp_name'])) {
		$sourcePath = $_FILES['facultyImage']['tmp_name'];
		$targetPath = "avatar/".$_FILES['facultyImage']['name'];

				$uploadOk = 1;
			// Check if image file is a actual image or fake image
			    $check = getimagesize($_FILES["facultyImage"]["tmp_name"]);
			    if($check !== false) {
			        $data["img_src_faculty"] = "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        $data["img_src_faculty"] = "File is not an image.";
			        $uploadOk = 0;
			    }
			// Check file size
				if ($_FILES["facultyImage"]["size"] > 2500000) {
				    $data["img_src_faculty"] = "Sorry, your file is too large.";
				    $uploadOk = 0;
				}

				if ($uploadOk != 0) {
					if(move_uploaded_file($sourcePath,$targetPath)) {
						$src = $targetPath;
						$adminimgsrc = "UPDATE faculty_account SET image_src ='$src' WHERE employee_id='$facultyusernamesession' ";
							if (mysqli_query($conn, $adminimgsrc)) {
							   	$data["img_src_faculty"] = true;
							}
					}
				}

			
		}
	}

	echo json_encode($data);
	mysqli_close($conn);
?>