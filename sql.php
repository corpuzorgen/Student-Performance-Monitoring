<?php
	session_start();
	include 'connection.php';
	error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
	$adminnamesession = $_SESSION['adminEmployeeId'];
	$facultyusernamesession = $_SESSION['facultyUsername'];
	$parentnamesession = $_SESSION['parentUsername'];
	mysqli_select_db($conn, 'orgencor_ccsmartkidz');


	$errors         	   				= array();      // array to hold validation errors
	$data           	   				= array();      // array to pass back data
	$facultyProfileInfo    				= array();
	$facultyProfileInfoUpdate    		= array(); 
	$adminProfileInfo	   				= array();
	$adminProfileInfoUpdate				= array();
	$idlist 							= array(); 
	$reglistfaculty						= array();
	$reglistparent						= array();
	$adminmsg							= array();
	$adminconvo							= array();
	$gallery							= array();
	$financerecord						= array();
	$recordlist							= array();
	$postnewslist						= array();
	$posteventslist						= array();
	$section_class						= array();
	$subject							= array();

	//Faculty users
	$firstname= $_POST["firstname"];
	$lastname= $_POST["lastname"];
	$employee_id= $_POST["employee_id"];
	$email= $_POST["email"];
	$password= $_POST["password"];
	//Faculty login
	$faculty_empid_login= $_POST["faculty_empid_login"];
	$faculty_password_login= $_POST["faculty_password_login"];
	
	//parent users
	$firstname_parent= $_POST["firstname"];
	$lastname_parent= $_POST["lastname"];
	$parent_id= $_POST["parent_id"];
	$email_parent= $_POST["email"];
	$password_parent= $_POST["password"];
	//Parent login
	$parent_id_login= $_POST["parent_id_login"];
	$parent_password_login= $_POST["parent_password_login"];

	//Admin login
	$admin_empid_login= $_POST["admin_empid-login"];
	$admin_password= $_POST["admin_password-login"];
	//Admin update account information
	$admin_new_pass= $_POST["admin_new_pass"];
	//Admin update basic info 
	$admin_firstname= $_POST["admin_firstname"];
	$admin_middlename= $_POST["admin_middlename"];
	$admin_lastname= $_POST["admin_lastname"];
	$admin_gender= $_POST["admin_gender"];
	$admin_dob= $_POST["admin_dob"];
	$admin_address= $_POST["admin_address"];
	//Admin update contact info
	$admin_position= $_POST["admin_position"];
	$admin_email= $_POST["admin_email"];
	$admin_phone= $_POST["admin_phone"];
	//Admin Account Id List
	$idlist_empid_faculty= $_POST["account-data-empid"];
	$idlist_firstname_faculty= $_POST["account-data-firstname"]; 
	$idlist_lastname_faculty= $_POST["account-data-lastname"];
	//Admin update account list faculty
	$faculty_update_empid_list= $_POST["faculty_update_empid_list"];		
	$faculty_update_firstnm_list= $_POST["faculty_update_firstnm_list"];
	$faculty_update_lastnm_list= $_POST["faculty_update_lastnm_list"];
	$id_update_list= $_POST["id_update_list"];
	//Admin update account list faculty
	$parent_update_empid_list= $_POST["parent_update_empid_list"];		
	$parent_update_firstnm_list= $_POST["parent_update_firstnm_list"];
	$parent_update_lastnm_list= $_POST["parent_update_lastnm_list"];
	$id_update_parent_list= $_POST["id_update_parent_list"];
	//Admin Account Id List Parent
	$idlist_pid_parent= $_POST["account-data-pid"];
	$idlist_firstname_parent= $_POST["account-data-firstname-parent"]; 
	$idlist_lastname_parent= $_POST["account-data-lastname-parent"];
	//Admin Delete Row Account List
	$facultyidlistdel= $_POST["facultyidlistdel"];
	$parentidlistdel= $_POST["parentidlistdel"];
	//Feature gallery delte
	$type= $_POST["type"];
	//Post admin
	$postcategory= $_POST["postcategory"];
	$posttitle= $_POST["posttitle"];
	$postcontent= $_POST["postcontent"];
	//Post update
	$postupdatecategory= $_POST["postupdatecategory"];
	$postupdatetitle= $_POST["postupdatetitle"];
	$postupdatecontent= $_POST["postupdatecontent"];
	$postupdateid= $_POST["postupdateid"];
	//Post delete
	$postdelid= $_POST["postdelid"];
	//Admin Finance form
	$academic_year= $_POST["academic_year"];
	$student_id= $_POST["student_id"];
	$student_name= $_POST["student_name"];
	$balance= $_POST["balance"];
	$balance_detail= $_POST["balance_detail"];
	$status= $_POST["status"];
	//Admin finance delete
	$deletefinance= $_POST["deletefinance"];
	//Admin finance update
	$id_update= $_POST["id_update"];
	$uacademic_year= $_POST["uacademic_year"];
	$ustudent_id= $_POST["ustudent_id"];
	$ustudent_name= $_POST["ustudent_name"];
	$ubalance= $_POST["ubalance"];
	$ubalance_detail= $_POST["ubalance_detail"];
	$ustatus= $_POST["ustatus"];
	//get keywords for contacts
	$keyword =$_POST["keyword"];

	$delmsgadmin= $_POST["delmsgadmin"];

	if(isset($delmsgadmin)){
		$deleteadminmsg = "DELETE FROM messages WHERE from_id = '$adminnamesession' AND to_id = '$delmsgadmin' || from_id = '$delmsgadmin' AND to_id = '$adminnamesession'";
		$deleteadminltmsg = "DELETE FROM latestmessage WHERE from_id = '$adminnamesession' AND to_id = '$delmsgadmin' || from_id = '$delmsgadmin' AND to_id = '$adminnamesession'";
		if(mysqli_query($conn, $deleteadminmsg) && mysqli_query($conn, $deleteadminltmsg)){
			$data["deletemsgadmin"] = true;
		}
	}
	

	if(isset($keyword)){
		$selectfromfacultyusers = "SELECT * FROM faculty_account WHERE employee_id LIKE '%".$_POST['keyword']."%' OR firstname LIKE '%".$_POST['keyword']."%' OR middlename LIKE '%".$_POST['keyword']."%' OR lastname LIKE '%".$_POST['keyword']."%' OR email LIKE '%".$_POST['keyword']."%' LIMIT 0,5";
		$resultfromfacultyusers = mysqli_query($conn, $selectfromfacultyusers);
		if(mysqli_num_rows($resultfromfacultyusers) > 0){
			
			while($rowfromfacultyusers = mysqli_fetch_assoc($resultfromfacultyusers)) {
				$fullname = $rowfromfacultyusers["firstname"]." ".$rowfromfacultyusers["middlename"]." ".$rowfromfacultyusers["lastname"];
				$contactsforadmin[] = "<li class='item' id='admincon".$rowfromfacultyusers["employee_id"]."'>".$fullname."</li>";
			}

		}else{
			$data["keywords"] = "<li>No Records Found!</li>";
		}
		$selectfromparentusers = "SELECT * FROM parent_account WHERE parent_id LIKE '%".$_POST['keyword']."%' OR firstname LIKE '%".$_POST['keyword']."%' OR middlename LIKE '%".$_POST['keyword']."%' OR lastname LIKE '%".$_POST['keyword']."%' OR email LIKE '%".$_POST['keyword']."%' LIMIT 0,5";
		$resultfromparentusers = mysqli_query($conn, $selectfromparentusers);
		if(mysqli_num_rows($resultfromparentusers) > 0){
			
			while($rowfromparentusers = mysqli_fetch_assoc($resultfromparentusers)) {
				$fullname = $rowfromparentusers["firstname"]." ".$rowfromparentusers["middlename"]." ".$rowfromparentusers["lastname"];
				$contactsforadmin[] = "<li class='item' id='admincon".$rowfromparentusers["parent_id"]."'>".$fullname."</li>";
			}

		}else{
			$data["keywords"] = "<li>No Records Found!</li>";
		}

		$data["keywords"] = $contactsforadmin;

	}

	//Ppost delete
	if(isset($postdelid)){
		$deletepost = "DELETE FROM post WHERE id = '$postdelid'";
		if(mysqli_query($conn, $deletepost)){
			$data["deletepost"] = true;
		}else{
			$data["deletepost"] = mysqli_error($conn);
		}
	}
	// Post update
	if( isset($postupdatecategory, $postupdatetitle, $postupdatecontent, $postupdateid) ){
		$updatepost = "UPDATE post SET category = '$postupdatecategory', title = '$postupdatetitle', content = '$postupdatecontent', date_posted=NOW() WHERE id = '$postupdateid'";
		if(mysqli_query($conn, $updatepost)){
			$data["updatepost"] = true;
		}else{
			$data["updatepost"] = mysqli_error($conn);
		}	
	}
	// Admin Update Accout Faculty List
	if ( isset($faculty_update_empid_list, $faculty_update_firstnm_list, $faculty_update_lastnm_list, $id_update_list)) {
		$updatefacultyaccount = "UPDATE id_account_list SET id_list ='$faculty_update_empid_list', firstname_list = '$faculty_update_firstnm_list', lastname_list='$faculty_update_lastnm_list' WHERE id = '$id_update_list'";
		if(mysqli_query($conn, $updatefacultyaccount)){
			$data["updatefacultyaccount"] = true;
		}else{
			$data["updatefacultyaccount"] = mysqli_error($conn);
		}
	}
	// Admin Update Accout Parent List
	if ( isset($parent_update_empid_list, $parent_update_firstnm_list, $parent_update_lastnm_list, $id_update_parent_list)) {
		$updateparentaccount = "UPDATE id_account_list_parent SET id_list ='$parent_update_empid_list', firstname_list = '$parent_update_firstnm_list', lastname_list='$parent_update_lastnm_list' WHERE id = '$id_update_parent_list'";
		if(mysqli_query($conn, $updateparentaccount)){
			$data["updateparentaccount"] = true;
		}else{
			$data["updateparentaccount"] = mysqli_error($conn);
		}
	}
	//Finance Update
	if(isset($uacademic_year, $ustudent_id, $ustudent_name, $ubalance, $ubalance_detail, $ustatus)){
		$updatefinance = "UPDATE finance SET academic_year ='$uacademic_year', student_id = '$ustudent_id', student_name = '$ustudent_name', balance = '$ubalance', balance_detail = '$ubalance_detail', status='$ustatus' WHERE id='$id_update'";
		if (mysqli_query($conn, $updatefinance)) {
   			 $data["updatefinance"] = true;
		}else{
			$data["updatefinance"] = mysqli_error($conn);
		}
	}
	//Finance delete
	if(isset($deletefinance)){
		$deletefinancerecord = "DELETE FROM finance WHERE id='$deletefinance' ";
		if (mysqli_query($conn, $deletefinancerecord)) {
		    $data["financedel"] = true;
		}
	}else{
	}
	//Finance
	if(isset($academic_year, $student_id, $student_name, $balance, $balance_detail, $status)){
		$selectfinance = "SELECT * FROM finance WHERE academic_year = '$academic_year' AND student_id = '$student_id' AND student_name = '$student_name' AND balance = '$balance' AND balance_detail = '$balance_detail' AND status = '$status' ";
		$resultfinance = mysqli_query($conn, $selectfinance);
		if (mysqli_num_rows($resultfinance) > 0) {
				$data["finance"] = false;
		}else{
			$insertfinance = "INSERT INTO finance (academic_year, student_id, student_name, balance, balance_detail, status) VALUES ('$academic_year','$student_id','$student_name','$balance','$balance_detail', '$status')";
			if(mysqli_query($conn, $insertfinance)){
				$data["finance"] = true;
			}
		}
	}
	//Post admin
	if(isset($postcategory, $posttitle, $postcontent)){
		$insertpost = "INSERT INTO post (category, title, content) VALUES ('$postcategory','$posttitle','$postcontent')";
		if(mysqli_query($conn, $insertpost)){
			$data["post"] = true;
		}
	}
	//Feature image
	if(isset($type)){
		$selectdelfeatureimage = "SELECT image_src FROM gallery WHERE type = '$type'";
		$resultdelfeatureimage = mysqli_query($conn, $selectdelfeatureimage);
		$rowdelfeatureimage = mysqli_fetch_assoc($resultdelfeatureimage);
		$delfile = $rowdelfeatureimage["image_src"];
		$delfilesub = substr($delfile, 3);
		unlink($delfilesub);
		$deletefeature = "DELETE FROM gallery WHERE type='$type'";
		if (mysqli_query($conn, $deletefeature)) {
			
    		$data["featuredel"] = true;
    		$data["type"] = $type;
		}	
	}


// Admin login
	if( isset( $admin_empid_login, $admin_password ) ){
		$string = $admin_password;
		$salt = "ccsmartkidz";
		$dcy = crypt($string, $salt);
		
		$selectadminlogin = "SELECT employee_id, password FROM admin WHERE employee_id = '$admin_empid_login' AND password = '$dcy' ";
		$resultadminlogin = mysqli_query($conn, $selectadminlogin);
		$rowadminlogin = mysqli_fetch_assoc($resultadminlogin);

		if( !$rowadminlogin ){
			$errors["admin_login"] = "Something went wrong. Either wrong Employee Id or Password is incorrect.";
		}

		if( !empty($errors) ){
			// if there are items in our errors array, return those errors
	        $data['success'] = false;
	        $data['errors']  = $errors;		   	
		   }else{
		   	//process if no errors
			//Add session going in to dashboard
    			$_SESSION['adminEmployeeId'] = $admin_empid_login;
		   		$data['success'] = true;
		   } 
	}

	if( isset( $adminnamesession ) ){
		//Post admin
		$selectpostadminnews = "SELECT * FROM post WHERE category = 'news' ORDER BY id DESC";
		$resultpostadminnews = mysqli_query($conn, $selectpostadminnews);
		if (mysqli_num_rows($resultpostadminnews) > 0) {
			//has record
			$data["postadminnewscounter"]= mysqli_num_rows($resultpostadminnews);
			while($rowpostadminnews = mysqli_fetch_assoc($resultpostadminnews)){
				$datetime=	$rowpostadminnews["date_posted"];
				$time=	strtotime($datetime);
				$date = date("F W\, Y",$time);

		      $postnewslist[] = "<li class='newliadmin'><div class='collapsible-header truncate'><span class='right newstime'>".$date."</span><span class='newstitle'>".htmlspecialchars($rowpostadminnews["title"], ENT_QUOTES, 'UTF-8')."</span></div><div class='collapsible-body'><p class='newscontent'>".$rowpostadminnews["content"]."</p><div class='collapsible-footer right-align'><a href='' class='blue-text btn-update-post-news' id='".$rowpostadminnews["id"]."'><i class='fa fa-pencil-square-o'></i>&nbsp;&nbsp;Update Article</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='' class='red-text btn-trash-post-news' id='".$rowpostadminnews["id"]."'><i class='fa fa-trash-o'></i>&nbsp;&nbsp;Move to trash</a></div></li>";
		      $data["postadminnews"] = $postnewslist;



		    }
		}else{
			//no record
			$data["postadminnews"] = "no record";
		}
		$selectpostadminevents = "SELECT * FROM post WHERE category = 'events' ORDER BY id DESC";
		$resultpostadminevents = mysqli_query($conn, $selectpostadminevents);
		if (mysqli_num_rows($resultpostadminevents) > 0) {
			//has record
			$data["postadmineventscounter"]= mysqli_num_rows($resultpostadminevents);
			while($rowpostadminevents = mysqli_fetch_assoc($resultpostadminevents)) {
				$datetime=	$rowpostadminevents["date_posted"];
				$time=	strtotime($datetime);
				$date = date("F W\, Y",$time);

		      $posteventslist[] = "<li class='eventsliadmin'><div class='collapsible-header truncate'><span class='right eventstime'>".$date."</span><span class='eventstitle'>".htmlspecialchars($rowpostadminevents["title"], ENT_QUOTES, 'UTF-8')."</span></div><div class='collapsible-body'><p class='eventscontent'>".$rowpostadminevents["content"]."</p><div class='collapsible-footer right-align'><a href='' class='blue-text btn-update-post-events' id='".$rowpostadminevents["id"]."'><i class='fa fa-pencil-square-o'></i>&nbsp;&nbsp;Update Article</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='' class='red-text btn-trash-post-events' id='".$rowpostadminevents["id"]."'><i class='fa fa-trash-o'></i>&nbsp;&nbsp;Move to trash</a></div></li>";
		      $data["postadminevents"] = $posteventslist;
		    }
		}else{
			//no record
			$data["postadminevents"] = "no record";
		}

		//Finance
		$selectfinancerecord = "SELECT * FROM finance ORDER BY id DESC";
		$resultfinancerecord = mysqli_query($conn, $selectfinancerecord);
		if (mysqli_num_rows($resultfinancerecord) > 0) {
			$i = mysqli_num_rows($resultfinancerecord);
			while($rowfinancerecord = mysqli_fetch_assoc($resultfinancerecord)) {
				$datetime=	$rowfinancerecord["date_record"];
				$time=	strtotime($datetime);
				$date = date("F W\, Y",$time);

		        $financerecord[] = "<tr><td>".$i."</td><td class='td_academic'>".$rowfinancerecord["academic_year"]."</td><td class='td_student_id'>".$rowfinancerecord["student_id"]."</td><td class='finance_holder'>".$rowfinancerecord["student_name"]."</td><td class='td_balance'>".$rowfinancerecord["balance"]."</td><td class='td_balance_detail'>".$rowfinancerecord["balance_detail"]."</td><td class='td_status'>".$rowfinancerecord["status"]."</td><td class='date_rcotd'>".$date."</td><td class='action_tdf'><a href='' class='btn-update-finance' id='".$rowfinancerecord["id"]."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>&nbsp;&nbsp;<a href='' class='red-text btn-delete-finance' id='".$rowfinancerecord["id"]."'><i class='fa fa-trash-o' aria-hidden='true'></i></a></td></tr>";
		        
		        $data["financerecord"] = $financerecord;
		        $i--;
		    }
		}else{
		   		$data["financerecord"] = "no record";
		}
		//FETCH Feature gallery
		$selectfeatureimages1 = "SELECT image_src FROM gallery WHERE type = 'slideone'";
		$resultfeatureimages1 = mysqli_query($conn, $selectfeatureimages1);
		$rowfeatureimages1 = mysqli_fetch_assoc($resultfeatureimages1);
        $gallery["slideone"] = $rowfeatureimages1["image_src"];
        $selectfeatureimages2 = "SELECT image_src FROM gallery WHERE type = 'slidetwo'";
		$resultfeatureimages2 = mysqli_query($conn, $selectfeatureimages2);
		$rowfeatureimages2 = mysqli_fetch_assoc($resultfeatureimages2);
        $gallery["slidetwo"] = $rowfeatureimages2["image_src"];
        $selectfeatureimages3 = "SELECT image_src FROM gallery WHERE type = 'slidethree'";
		$resultfeatureimages3 = mysqli_query($conn, $selectfeatureimages3);
		$rowfeatureimages3 = mysqli_fetch_assoc($resultfeatureimages3);
        $gallery["slidethree"] = $rowfeatureimages3["image_src"];

        $data["gallery"] = $gallery;
		// FETCH messages
		$selectlstmsgadmin = "SELECT * FROM latestmessage WHERE from_id = '$adminnamesession' OR to_id = '$adminnamesession' GROUP BY from_id ORDER BY msg_datetime DESC";
		$resultlstmsgadmin = mysqli_query($conn, $selectlstmsgadmin);
			if (mysqli_num_rows($resultlstmsgadmin) > 0) {
				while($rowlstmsgadmin = mysqli_fetch_assoc($resultlstmsgadmin)) {
					$to_idmod;
					if( $rowlstmsgadmin["to_id"] == $adminnamesession ){
						$to_idmod = $rowlstmsgadmin["from_id"];
					}else if($rowlstmsgadmin["from_id"] == $adminnamesession){
						$to_idmod = $rowlstmsgadmin["to_id"];
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

		        	$adminmsg[] = "<li class='collection-item avatar li-msg-admin'><img src='../images/male-user.png' class='circle'><span class='title inbox-receiver' id='".$to_idmod."'>".$toidname."</span><p class='truncate msg-content'>".$rowlstmsgadmin["msg_content"]."</p><p class='secondary-content'></p></li>";
		        	$data["msglistadmin"] = $adminmsg;
		    	}
		    }else{
		    	$data["msglistadmin"] = "0";
		    }

		


		$adminSelect = "SELECT * FROM admin WHERE employee_id = '$adminnamesession' ";
		$adminResult = mysqli_query($conn, $adminSelect);
		$adminRow	 = mysqli_fetch_assoc($adminResult);
			$str = $adminRow["password"];
			$salt = "ccsmartkidz";
			$dcy = crypt($str, $salt);
		$adminProfileInfo["firstname"] = $adminRow["firstname"];
		$adminProfileInfo["middlename"] = $adminRow["middlename"];
		$adminProfileInfo["lastname"] = $adminRow["lastname"];
		$adminProfileInfo["position"] = $adminRow["position"];
		$adminProfileInfo["employee_id"] = $adminRow["employee_id"];
		$adminProfileInfo["password"] = $dcy;
		$adminProfileInfo["email"] = $adminRow["email"];
		$adminProfileInfo["gender"] = $adminRow["gender"];
		$adminProfileInfo["dob"] = $adminRow["dob"];
		$adminProfileInfo["address"] = $adminRow["address"];
		$adminProfileInfo["phone"] = $adminRow["phone"];
		$adminProfileInfo["image_src"] = $adminRow["image_src"];
		//pass faculty info to data
		$data["adminProfileInfo"] = $adminProfileInfo;

				//Admin Update Account Info
	if( isset( $admin_new_pass ) ){
		$adminnewpassupdate = "UPDATE admin SET password = '$admin_new_pass' WHERE employee_id = '$adminnamesession' ";
		if (mysqli_query($conn, $adminnewpassupdate)) {
		    $data['success'] = true;
		}
	}
		//Admin Basic Info Update
	if( isset($admin_firstname) ){
		$adminupdatefirstname= "UPDATE admin SET firstname='$admin_firstname' WHERE employee_id='$adminnamesession'";
		mysqli_query($conn, $adminupdatefirstname);
		$adminProfileInfoUpdate['update_firstname'] = true;
	}
	if( isset($admin_middlename) ){
		$adminupdatemiddlename= "UPDATE admin SET middlename='$admin_middlename' WHERE employee_id='$adminnamesession'";
		mysqli_query($conn, $adminupdatemiddlename);
		$adminProfileInfoUpdate['update_middlename'] = true;
	}
	if( isset($admin_lastname) ){
		$adminupdatelastname= "UPDATE admin SET lastname='$admin_lastname' WHERE employee_id='$adminnamesession'";
		mysqli_query($conn, $adminupdatelastname);
		$adminProfileInfoUpdate['update_lastname'] = true;
	}
	if( isset($admin_gender) ){
		$adminupdategender= "UPDATE admin SET gender='$admin_gender' WHERE employee_id='$adminnamesession'";
		mysqli_query($conn, $adminupdategender);
		$adminProfileInfoUpdate['update_gender'] = true;
	}
	if( isset($admin_dob) ){
		$adminupdatedob= "UPDATE admin SET dob='$admin_dob' WHERE employee_id='$adminnamesession'";
		mysqli_query($conn, $adminupdatedob);
		$adminProfileInfoUpdate['update_dob'] = true;
	}
	if( isset($admin_address) ){
		$adminupdateaddress= "UPDATE admin SET address='$admin_address' WHERE employee_id='$adminnamesession'";
		mysqli_query($conn, $adminupdateaddress);
		$adminProfileInfoUpdate['update_address'] = true;
	}
	//Admin Contact Info Update
	if( isset($admin_position) ){
		$adminupdateposition= "UPDATE admin SET position='$admin_position' WHERE employee_id='$adminnamesession'";
		mysqli_query($conn, $adminupdateposition);
		$adminProfileInfoUpdate['update_position'] = true;
	}
	if( isset($admin_email) ){
		$adminupdateemail= "UPDATE admin SET email='$admin_email' WHERE employee_id='$adminnamesession'";
		mysqli_query($conn, $adminupdateemail);
		$adminProfileInfoUpdate['update_email'] = true;
	}
	if( isset($admin_phone) ){
		$adminupdatephone= "UPDATE admin SET phone='$admin_phone' WHERE employee_id='$adminnamesession'";
		mysqli_query($conn, $adminupdatephone);
		$adminProfileInfoUpdate['update_phone'] = true;
	}
	//Input all update message here
	$data['adminProfileInfoUpdate'] = $adminProfileInfoUpdate;


		// Faculty 
		$adminSelectIdlist = "SELECT * FROM id_account_list ORDER BY id DESC";
		$adminResultIdlist = mysqli_query($conn, $adminSelectIdlist);
		if (mysqli_num_rows($adminResultIdlist) > 0) {
			$data["getIdlistfaculty"]= mysqli_num_rows($adminResultIdlist);
		    // output data of each row
		    $i=$data["getIdlistfaculty"];
		    while($adminRowIdlist = mysqli_fetch_assoc($adminResultIdlist)) {
		    	
		        $idlist[]= "<tr><td>".$i."</td><td class='td_faculty_empid'>".$adminRowIdlist["id_list"]."</td><td class='td_faculty_firstnm'>".$adminRowIdlist["firstname_list"]."</td><td class='td_faculty_lastnm'>".$adminRowIdlist["lastname_list"]."</td><td><a href='#' class='btn-update-faculty' id='".$adminRowIdlist['id']."'><i class='fa fa-pencil-square-o fa-lg'></i></a>
		        	<a href='#' id='".$adminRowIdlist['id_list']."' class='btn-delete-faculty'><i class='fa fa-trash fa-lg red-text'></i></a></td></tr>";
		    $data["idlistfaculty"] = $idlist;
		    $i--;
		    }
		} else {
		    $data["getIdlistfaculty"]= "";
		}
		//Parent
		$adminSelectIdlistparent = "SELECT * FROM id_account_list_parent ORDER BY id DESC";
		$adminResultIdlistparent = mysqli_query($conn, $adminSelectIdlistparent);
		if (mysqli_num_rows($adminResultIdlistparent) > 0) {
			$data["getIdlistparent"]= mysqli_num_rows($adminResultIdlistparent);
		    // output data of each row
		    $i=$data["getIdlistparent"];
		    while($adminRowIdlistparent = mysqli_fetch_assoc($adminResultIdlistparent)) {
		    	
		        $idlistparent[]= "<tr><td>".$i."</td><td class='td_parent_pid'>".$adminRowIdlistparent["id_list"]."</td><td class='td_parent_firstnm'>".$adminRowIdlistparent["firstname_list"]."</td><td class='td_parent_lastnm'>".$adminRowIdlistparent["lastname_list"]."</td><td><a href='#' class='btn-update-parent' id='".$adminRowIdlistparent['id']."'><i class='fa fa-pencil-square-o fa-lg'></i></a>
		        	<a href='#' id='".$adminRowIdlistparent['id_list']."' class='btn-delete-parent'><i class='fa fa-trash fa-lg red-text'></i></a>
		        	<a href='' id='".$adminRowIdlistparent['id_list']."' class='btn-send-email'><i class='fa fa-paper-plane-o fa-lg grey-text'></i></a>
		        	</td></tr>";
		    $data["idlistparent"] = $idlistparent;
		    $i--;
		    }
		} else {
		    $data["getIdlistparent"]= "";
		}

		//Admin Get registered Faculty User
		$selectregfaculty = "SELECT * FROM faculty_account ORDER BY id DESC";
		$resultregfaculty = mysqli_query($conn, $selectregfaculty);
		if (mysqli_num_rows($resultregfaculty) > 0) {
			$data["getreglistfaculty"]= mysqli_num_rows($resultregfaculty);
		    // output data of each row
		    $i=$data["getreglistfaculty"];
		    while($rowregfaculty = mysqli_fetch_assoc($resultregfaculty)) {

		    	$datetime=$rowregfaculty["reg_date"];
				$time=strtotime($datetime);
				$date = date("l F W\, Y  \-  h:i:sA",$time);

		        $reglistfaculty[]= "<tr><td>".$i."</td><td class='td_facultyaccountreg'>".$rowregfaculty["employee_id"]."</td><td>".$rowregfaculty["firstname"]."</td><td>".$rowregfaculty["lastname"]."</td><td>".$rowregfaculty["email"]."</td><td>".$rowregfaculty["phone"]."</td><td>".$date."</td></tr>";
		    $data["reglistfaculty"] = $reglistfaculty;
		    $i--;
		    }
		} else {
		    $data["getreglistfaculty"]= "";
		}
		//Admin Get registered Parent User
		$selectregparent = "SELECT * FROM parent_account ORDER BY id DESC";
		$resultregparent = mysqli_query($conn, $selectregparent);
		if (mysqli_num_rows($resultregparent) > 0) {
			$data["getreglistparent"]= mysqli_num_rows($resultregparent);
		    // output data of each row
		    $i=$data["getreglistparent"];
		    while($rowregparent = mysqli_fetch_assoc($resultregparent)) {
		    	$datetime=$rowregparent["reg_date"];
				$time=strtotime($datetime);
				$date = date("l F W\, Y  \-  h:i:sA",$time);

		        $reglistparent[]= "<tr><td>".$i."</td><td class='td_parentaccountreg'>".$rowregparent["parent_id"]."</td><td>".$rowregparent["firstname"]."</td><td>".$rowregparent["lastname"]."</td><td>".$rowregparent["email"]."</td><td>".$rowregparent["phone"]."</td><td>".$date."</td></tr>";
		    $data["reglistparent"] = $reglistparent;
		    $i--;
		    }
		} else {
		    $data["getreglistparent"]= "";
		}				
	}//end of isset admin

	if(isset($idlist_empid_faculty, $idlist_firstname_faculty, $idlist_lastname_faculty)){
		$insertidlist = "INSERT INTO id_account_list (id_list, firstname_list, lastname_list) VALUES ('$idlist_empid_faculty', '$idlist_firstname_faculty', '$idlist_lastname_faculty')";
		mysqli_query($conn, $insertidlist);
		$data["insertidlist"] = true;	
	}
	if(isset($idlist_pid_parent, $idlist_firstname_parent, $idlist_lastname_parent)){
		$insertidlistparent = "INSERT INTO id_account_list_parent (id_list, firstname_list, lastname_list) VALUES ('$idlist_pid_parent', '$idlist_firstname_parent', '$idlist_lastname_parent')";
		mysqli_query($conn, $insertidlistparent);
		$data["insertidlistparent"] = true;	
	}

	//Delete Row From Account List Faculty
	if( isset($facultyidlistdel) ){
		$deletefacultyidlist = "DELETE FROM id_account_list WHERE id_list='$facultyidlistdel'" ;
		mysqli_query($conn, $deletefacultyidlist);
		$deletefacultyaccount = "DELETE FROM faculty_account WHERE employee_id='$facultyidlistdel'" ;
		mysqli_query($conn, $deletefacultyaccount);
		$deletefacultyprof = "DELETE FROM class WHERE professor='$facultyidlistdel'" ;
		mysqli_query($conn, $deletefacultyprof);
		$data["delrowfacultyidlist"] = true;
	}
	//Delete Row From Account List Parent
	if( isset($parentidlistdel) ){
		$deleteparentidlist = "DELETE FROM id_account_list_parent WHERE id_list='$parentidlistdel'" ;
		mysqli_query($conn, $deleteparentidlist);
		$deleteparentaccount = "DELETE FROM parent_account WHERE parent_id='$parentidlistdel'" ;
		mysqli_query($conn, $deleteparentaccount);

		$data["delrowparentidlist"] = true;
	}




		//Faculty
	if( isset( $firstname, $lastname, $employee_id, $email, $password) ){
		// faculty_account to create table
		

		//Select all from faculty_account table
		$selectFAdata = "SELECT * FROM faculty_account WHERE employee_id = '$employee_id'";
		$resultFAdata = mysqli_query($conn, $selectFAdata);
		$rowFAdata = mysqli_fetch_assoc($resultFAdata);
		if( $rowFAdata["employee_id"] == $employee_id){
			$errors["employee_id"] = "An account has already created for this Id.";
		}
		$selectFAdatae = "SELECT * FROM faculty_account WHERE email = '$email'";
		$resultFAdatae = mysqli_query($conn, $selectFAdatae);
		$rowFAdatae = mysqli_fetch_assoc($resultFAdatae);

		if( $rowFAdatae["email"] == $email ){
			$errors["email"] = "This email address is already been used.";
		}


		$selectempidlist ="SELECT id_list FROM id_account_list WHERE id_list ='$employee_id' ";
		$resultempidlist = mysqli_query($conn, $selectempidlist);
		$rowempidlist = mysqli_fetch_assoc($resultempidlist);
		if( $rowempidlist["id_list"] != $employee_id){
			$errors["employee_id_notreg"] = "Employee Id is not enrolled in the School. Please contact the Administrator/Principal of the School to have your Id listed.";
		}
		
		   if( !empty($errors) ){
			// if there are items in our errors array, return those errors
	        $data['success'] = false;
	        $data['errors']  = $errors;		   	
		   }else{
		   	//process if no errors
			//Faculty data Insert into faculty_account table
			$string = $password;
			$salt = "ccsmartkidz";
			$dcy = crypt($string, $salt);
			$insertFAdata = "INSERT INTO faculty_account (firstname, lastname, employee_id, email, password)
			VALUES ('$firstname', '$lastname', '$employee_id', '$email', '$dcy')";
				if (mysqli_query($conn, $insertFAdata)) {
		    			$data['success'] = true;
				}
		   } 
		
	}// end of if 

	if( isset( $faculty_empid_login, $faculty_password_login ) ){

		$string = $faculty_password_login;
		$salt = "ccsmartkidz";
		$dcy = crypt($string, $salt);

		$selectFAdatalogin = "SELECT employee_id, password FROM faculty_account WHERE employee_id ='$faculty_empid_login' AND password='$dcy' ";
		$resultFAdatalogin = mysqli_query($conn, $selectFAdatalogin);
		$rowFAdatalogin = mysqli_fetch_assoc($resultFAdatalogin);

		if( !$rowFAdatalogin ){
			$errors["faculty_login"] = "Something went wrong. Either wrong username or password is incorrect.";
		}
			if( !empty($errors) ){
			// if there are items in our errors array, return those errors
	        $data['success'] = false;
	        $data['errors']  = $errors;		   	
		   }else{
		   	//process if no errors
			//Add session going in to dashboard
    			$_SESSION['facultyUsername'] = $faculty_empid_login;
		   		$data['success'] = true;
		   } 

	}




	
	//Parent 
	if( isset( $firstname_parent, $lastname_parent, $parent_id, $email_parent, $password_parent) ){

		//Select all from faculty_account table
		$selectPAdata = "SELECT * FROM parent_account WHERE parent_id = '$parent_id'";
		$resultPAdata = mysqli_query($conn, $selectPAdata);
		$rowPAdata = mysqli_fetch_assoc($resultPAdata);
		if( $rowPAdata["parent_id"] == $parent_id){
			$errors["parent_id"] = "An account has already created for this Id.";
		}
		$selectPAdatas = "SELECT * FROM parent_account WHERE email = '$email_parent'";
		$resultPAdatas = mysqli_query($conn, $selectPAdatas);
		$rowPAdatas = mysqli_fetch_assoc($resultPAdatas);
		if( $rowPAdatas["email"] == $email ){
			$errors["email"] = "This email address is already been used.";
		}
		$selectparentidlist= "SELECT id_list FROM id_account_list_parent WHERE id_list= '$parent_id'";
		$resultparentidlist= mysqli_query($conn, $selectparentidlist);
		$rowparentidlist= mysqli_fetch_assoc($resultparentidlist);
		if( $rowparentidlist["id_list"] != $parent_id){
			$errors["parent_id_notreg"] = "Parent Id is not enrolled in the School. Please contact the Administrator/Principal of the School to have your Id listed.";
		}
		
		   if( !empty($errors) ){
			// if there are items in our errors array, return those errors
	        $data['success'] = false;
	        $data['errors']  = $errors;		   	
		   }else{
		   	//process if no errors
			//Faculty data Insert into faculty_account table
			$string = $password_parent;
			$salt = "ccsmartkidz";
			$dcy = crypt($string, $salt);
			$insertPAdata = "INSERT INTO parent_account (firstname, lastname, parent_id, email, password)
			VALUES ('$firstname_parent', '$lastname_parent', '$parent_id', '$email_parent', '$dcy')";
				if (mysqli_query($conn, $insertPAdata)) {
		    			$data['success'] = true;
				}
		   } 
		
	}// end of if 

	if( isset( $parent_id_login, $parent_password_login ) ){

		$string = $parent_password_login;
		$salt = "ccsmartkidz";
		$dcy = crypt($string, $salt);

		$selectPAdatalogin = "SELECT parent_id, password FROM parent_account WHERE parent_id='$parent_id_login' AND password = '$dcy' ";
		$resultPAdatalogin = mysqli_query($conn, $selectPAdatalogin);
		$rowPAdatalogin = mysqli_fetch_assoc($resultPAdatalogin);

		if( !$rowPAdatalogin ){
			$errors["parent_login"] = "Something went wrong. Either wrong username or password is incorrect.";
		}
			if( !empty($errors) ){
			// if there are items in our errors array, return those errors
	        $data['success'] = false;
	        $data['errors']  = $errors;		   	
		   }else{
		   	//process if no errors
			//Add session going in to dashboard
    			$_SESSION['parentUsername'] = $parent_id_login;
		   		$data['success'] = true;
		   } 

	}

	


//send email to parent
	$parent_idemail= $_POST["parent_idemail"];
	$firstnmemail= $_POST["firstnmemail"];
	$lastnmemail= $_POST["lastnmemail"];
	$emailparentsend= $_POST["emailparentsend"];

	if(isset($parent_idemail, $firstnmemail, $lastnmemail, $emailparentsend)){
		$to = $emailparentsend;
		$subject = "Account information to register in CC Smart Kidz School Parent Portal";
		$message = "
		<html>
		<head>
		<title>CC Smart Kidz School Email</title>
		</head>
		<body>
			<h5> Good day from CC Smart Kidz School! </h5>
			<br />
			<p>This email was sent by the Administrator/Principal of the school to inform you about the details you need to register in the <a href = 'http://ccsmartkidz.com/parent-portal.php' target='_blank'>Parent Portal</a> of the School Website <a href = 'http://ccsmartkidz.com' target='_blank'> www.ccsmartkidz.com </a>. Below are the details. <br />
			Parent Id: ".$parent_idemail."
			<br />
			Firstname: ".$firstnmemail."
			<br />
			Lastname: ".$lastnmemail."
			</p>
		</body>
		</html>
		";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <admin@ccsmartkidz.com>' . "\r\n";
		$headers .= 'Cc: admin@ccsmartkidz.com' . "\r\n";

		if(mail($to,$subject,$message,$headers)){
			$data["emailsend"] = "true";
		}else{
			$data["emailsend"] = "false";
		}
	}
	

	//Admin set
	$adminempidset= $_POST["adminempidset"];
	$adminpassset= $_POST["adminpassset"];
	if(isset($adminempidset, $adminpassset)){
			$str = $adminpassset;
			$salt = "ccsmartkidz";
			$dcy = crypt($str, $salt);

		$inserttoadmin = "INSERT INTO admin (employee_id, password) VALUES ('$adminempidset', '$dcy')";
		if (mysqli_query($conn, $inserttoadmin)) {
		    $data["adminadded"] = true . "" . $dcy . " " .$adminpassset;

			}else{
				 $data["adminadded"] = mysqli_error($conn);
			}
	}

	echo json_encode($data);
	mysqli_close($conn);

?>