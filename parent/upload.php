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
		if(is_uploaded_file($_FILES['parentImage']['tmp_name'])) {
		$sourcePath = $_FILES['parentImage']['tmp_name'];
		$targetPath = "avatar/".$_FILES['parentImage']['name'];
			$uploadOk = 1;
			// Check if image file is a actual image or fake image
			    $check = getimagesize($_FILES["parentImage"]["tmp_name"]);
			    if($check !== false) {
			        $data["img_src_parent"] = "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        $data["img_src_parent"] = "File is not an image.";
			        $uploadOk = 0;
			    }
			// Check file size
				if ($_FILES["parentImage"]["size"] > 2500000) {
				    $data["img_src_parent"] = "Sorry, your file is too large.";
				    $uploadOk = 0;
				}

				if ($uploadOk != 0) {
					if(move_uploaded_file($sourcePath,$targetPath)) {
						$src = $targetPath;
						$adminimgsrc = "UPDATE parent_account SET image_src ='$src' WHERE parent_id='$parentnamesession' ";
							if (mysqli_query($conn, $adminimgsrc)) {
							   	$data["img_src_parent"] = true;
							}
					}
				}

			
		}
	}

	echo json_encode($data);
	mysqli_close($conn);
?>