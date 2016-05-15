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
		if(is_uploaded_file($_FILES['adminImage']['tmp_name'])) {
		$sourcePath = $_FILES['adminImage']['tmp_name'];
		$targetPath = "avatar/".$_FILES['adminImage']['name'];

				$uploadOk = 1;
			// Check if image file is a actual image or fake image
			    $check = getimagesize($_FILES["adminImage"]["tmp_name"]);
			    if($check !== false) {
			        $data["img_src_admin"] = "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        $data["img_src_admin"] = "File is not an image.";
			        $uploadOk = 0;
			    }
			// Check file size
				if ($_FILES["adminImage"]["size"] > 2500000) {
				    $data["img_src_admin"] = "Sorry, your file is too large.";
				    $uploadOk = 0;
				}

				if ($uploadOk != 0) {
					if(move_uploaded_file($sourcePath,$targetPath)) {
						$src = $targetPath;
						$adminimgsrc = "UPDATE admin SET image_src ='$src' WHERE employee_id='$adminnamesession' ";
							if (mysqli_query($conn, $adminimgsrc)) {
							   	$data["img_src_admin"] = true;
							}
					}
				}


			
		}
		if(is_uploaded_file($_FILES['featuredimageone1']['tmp_name'])) {
			$sourcePath1 = $_FILES['featuredimageone1']['tmp_name'];
			$targetPath1 = "../images/feature/".$_FILES['featuredimageone1']['name'];
			$uploadOk = 1;
			// Check if image file is a actual image or fake image
			    $check = getimagesize($_FILES["featuredimageone1"]["tmp_name"]);
			    if($check !== false) {
			        $data["featuredimageone"] = "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        $data["featuredimageone"] = "File is not an image.";
			        $uploadOk = 0;
			    }
			// Check file size
				if ($_FILES["featuredimageone1"]["size"] > 2500000) {
				    $data["featuredimageone"] = "Sorry, your file is too large.";
				    $uploadOk = 0;
				}

				if ($uploadOk != 0) {
				    if(move_uploaded_file($sourcePath1,$targetPath1)) {
						$src = $targetPath1;
						$selectgallery1 = "SELECT type FROM gallery WHERE type = 'slideone'";
						$resultygallery1 = mysqli_query($conn, $selectgallery1);
						if (mysqli_num_rows($resultygallery1) > 0) {
							//UPDATE
							$updatefeatureimageone = "UPDATE gallery SET image_src = '$src', date_uploaded=NOW() WHERE type = 'slideone'";
							if(mysqli_query($conn, $updatefeatureimageone)) {
		    					$data["featuredimageone"] = true ;
							}else{
								$data["featuredimageone"] = "Error updating record: " . mysqli_error($conn);
							}
						}else{
							//INSERT
							$insertfeatureimageone = "INSERT INTO gallery (type, image_src) VALUES ('slideone','$src')";
							if(mysqli_query($conn, $insertfeatureimageone)) {
		    					$data["featuredimageone"] = true ;
							}else{
								$data["featuredimageone"] = "Error updating record: " . mysqli_error($conn);
							}
						}
					}
				}
		
			
		}

		if(is_uploaded_file($_FILES['featuredimagetwo2']['tmp_name'])) {
			$sourcePath = $_FILES['featuredimagetwo2']['tmp_name'];
			$targetPath = "../images/feature/".$_FILES['featuredimagetwo2']['name'];

			$uploadOk = 1;
			// Check if image file is a actual image or fake image
			    $check = getimagesize($_FILES["featuredimagetwo2"]["tmp_name"]);
			    if($check !== false) {
			        $data["featuredimagetwo"] = "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        $data["featuredimagetwo"] = "File is not an image.";
			        $uploadOk = 0;
			    }
			// Check file size
				if ($_FILES["featuredimagetwo2"]["size"] > 2500000) {
				    $data["featuredimagetwo"] = "Sorry, your file is too large.";
				    $uploadOk = 0;
				}

				if ($uploadOk != 0) {
					if(move_uploaded_file($sourcePath,$targetPath)) {
						$src = $targetPath;
						$selectgallery = "SELECT type FROM gallery WHERE type = 'slidetwo'";
						$resultygallery = mysqli_query($conn, $selectgallery);
						if (mysqli_num_rows($resultygallery) > 0) {
							//UPDATE
							$updatefeatureimagetwo = "UPDATE gallery SET image_src = '$src', date_uploaded=NOW() WHERE type = 'slidetwo'";
							if(mysqli_query($conn, $updatefeatureimagetwo)) {
		    					$data["featuredimagetwo"] = true ;
							}else{
								$data["featuredimagetwo"] = "Error updating record: " . mysqli_error($conn);
							}
						}else{
							//INSERT
							$insertfeatureimagetwo = "INSERT INTO gallery (type, image_src) VALUES ('slidetwo','$src')";
							if(mysqli_query($conn, $insertfeatureimagetwo)) {
		    					$data["featuredimagetwo"] = true ;
							}else{
								$data["featuredimagetwo"] = "Error updating record: " . mysqli_error($conn);
							}
						}
					}
				}
			
		}
		if(is_uploaded_file($_FILES['featuredimagethree3']['tmp_name'])) {
		$sourcePath = $_FILES['featuredimagethree3']['tmp_name'];
		$targetPath = "../images/feature/".$_FILES['featuredimagethree3']['name'];

			$uploadOk = 1;
				// Check if image file is a actual image or fake image
				    $check = getimagesize($_FILES["featuredimagethree3"]["tmp_name"]);
				    if($check !== false) {
				        $data["featuredimagethree"] = "File is an image - " . $check["mime"] . ".";
				        $uploadOk = 1;
				    } else {
				        $data["featuredimagethree"] = "File is not an image.";
				        $uploadOk = 0;
				    }
				// Check file size
					if ($_FILES["featuredimagethree3"]["size"] > 2500000) {
					    $data["featuredimagethree"] = "Sorry, your file is too large.";
					    $uploadOk = 0;
					}

					if ($uploadOk != 0) {
						if(move_uploaded_file($sourcePath,$targetPath)) {
							$src = $targetPath;
							$selectgallery = "SELECT type FROM gallery WHERE type = 'slidethree'";
							$resultygallery = mysqli_query($conn, $selectgallery);
							if (mysqli_num_rows($resultygallery) > 0) {
								//UPDATE
								$updatefeatureimagethree = "UPDATE gallery SET image_src = '$src', date_uploaded=NOW() WHERE type = 'slidethree'";
								if(mysqli_query($conn, $updatefeatureimagethree)) {
			    					$data["featuredimagethree"] = true ;
								}else{
									$data["featuredimagethree"] = "Error updating record: " . mysqli_error($conn);
								}
							}else{
								//INSERT
								$insertfeatureimagethree = "INSERT INTO gallery (type, image_src) VALUES ('slidethree','$src')";
								if(mysqli_query($conn, $insertfeatureimagethree)) {
			    					$data["featuredimagethree"] = true ;
								}else{
									$data["featuredimagethree"] = "Error updating record: " . mysqli_error($conn);
								}
							}
						}
					}
			
		}

		
	}

	echo json_encode($data);
	mysqli_close($conn);
?>