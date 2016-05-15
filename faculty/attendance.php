<?php 
	session_start();
	if( !isset($_SESSION['facultyUsername']) ){
		header('Location: ../portal-signin.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Faculty Attendance CC Smart Kidz School Incorporated - Official Website</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		
		<header class="faculty-Attendance">
			<nav class=" light-blue darken-1">
			    <div class="nav-wrapper nav-wrapper-faculty">
			    	<div class="nav-wrap-show">
				    <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
				    <ul class="">
				        <li><a href="" class="faculty-page-title">Attendance</a></li>
	      			</ul>
	      			<ul id="slide-out" class="side-nav">
	      				<li class="faculty-avatar-sidenav light-blue darken-1">
							<img src="../images/admin-avatar.png" alt="" class="faculty-avatar-img" >
							<p class="faculty-usr">Employee Id: <b><span id="faculty-empid-nav"></span></b></p>
	      				</li>
						<li class=""><a href="dashboard.php"><i class="fa fa-tachometer fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
					    <li class=""><a href="profile.php"><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
					    <li class=""><a href="messages.php"><i class="fa fa-comments-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a></li>
					    <li class=""><a href="class.php"><i class="fa fa-calendar-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Class</a></li>
					    <li class=""><a href="grades.php"><i class="fa fa-percent fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Grades</a></li>
					    <li class=""><a href="evaluation.php"><i class="fa fa-area-chart fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Evaluation</a></li>
					    <li class="active"><a href="attendance.php"><i class="fa fa-calendar fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Attendance</a></li>
					    <a href="../logout.php"><i class="fa fa-sign-out fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
	  				</ul>
	  				<a href="" data-target="Attendance-settings" class="modal-trigger"><i class="material-icons right" >more_vert</i></a>
	  				
					</div>
					<form id="search-faculty-content"class="hide">
				        <div class="input-field">
				          <input id="search" type="search" placeholder="What are you looking? Search it here."required>
				          <label for="search"><i class="material-icons">search</i></label>
				          <i class="material-icons close-search-faculty">close</i>
				        </div>
			      	</form>	  				
			    </div>
			</nav>			
		</header>

		<main>
			<div class="container"style="margin-top: 3%;">
			<table class="bordered highlight">
				<thead>
			      	<tr>
			            <th>Academic Year</th>
			            <th>Student Id</th>
			            <th>Name</th>
			            <th>Month</th>
			            <th>Days Present</th>
			            <th>Days Late</th>
			            <th>Days Absent</th>
			            <th>Action</th>
			      	</tr>
			    </thead>
			    <tbody id="tbody_attendance">
			    	

			    </tbody>	
			</table>

			<p class='noattendance grey-text'><i class='fa fa-calendar-minus-o fa-lg'></i> No Attendance List added yet. add <a class='modal-trigger' href='#add-attendance'>here</a></p>
			
	
		<div class="fixed-action-btn vertical" style="bottom: 45px; right: 24px;">
		    <a class="btn-floating btn-large red btn-add-attendance">
		     	<i class="material-icons">add</i>
		    </a>
	  	</div>


			<div id="add-attendance" class="modal modal-fixed-footer">
			    <div class="modal-content">
			      <h4>Add Attendance</h4>
			      <div class="divider"></div>
					<div class="row">
					    <form id='form-attendance'class='col s12'>
					    	<div class="row">
						        <div class="input-field col s6">
						          <input placeholder="Academic Year" name="academic_year_att" id="academic_year_att" type="text" class="validate attendance_input">
						        </div>
					        </div>
							<select class="browser-default" name="student_id_att" id="student_id_att">
							    <option value="null" disabled selected id='selectstudentlistforattendance'>Select Student</option>
							</select>
					        <div class="row">
						        <div class="input-field col s6">
						          <input placeholder="Month" name="month_att" id="month_att" type="text" class="validate attendance_input">
						        </div>
					        </div>
					        <div class="row">
						        <div class="input-field col s4">
						          <input placeholder="Days present" name="days_present_att" id="days_present_att" type="text" class="validate attendance_input">
						        </div>
						        <div class="input-field col s4">
						          <input placeholder="Days late" name="days_late_att" id="days_late_att" type="text" class="validate attendance_input">
						        </div>
						         <div class="input-field col s4">
						          <input placeholder="Days absent" name="days_absent_att" id="days_absent_att" type="text" class="validate attendance_input">
						        </div>
					        </div>
					    
					</div>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat" onclick="location.reload();">Close</a>
			      <button href="#!" class="modal-action waves-effect waves-green btn-flat left add-btn-attendance" type="submit">Add Attendance</button>
			      </form>
			    </div>
			</div>
		
				<div id="add-success-attendance" class="modal">
				    <div class="modal-content center">
				      <p class="green-text"><i class="fa fa-check-circle fa-lg"></i>Attendance successfully added!</p>
				    </div>
				    <div class="modal-footer">
				      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
				    </div>
			  	</div>
				<!-- Modal Structure -->
			  <div id="Attendance-settings" class="modal bottom-sheet">
			    	<div class="modal-content">
			      			<h4>Attendance Settings</h4>
			      		 	<div class="divider"></div>
			      			<ul>
			      				<li><a href="../logout.php" class="red-text">Logout</a></li>
			      			</ul>
			    	</div>
			    	<div class="modal-footer">
			      		<a href="#!" class="modal-action modal-close waves-effect waves-red
			      		 btn-flat black-text" >Close</a>
			    	</div>
			  </div>

			<div id="update-form-attendance" class="modal modal-fixed-footer">
			    <div class="modal-content">
			      <h5>Update Attendance of: <span class='attof'></span></h5>
			     <div class="divider"></div>
					<form id='form-update-attendance'>
						<div class="row">
						    <div class="input-field col s12">
						      <input placeholder="Academic Year" name="academic_year_att_update" id="academic_year_att_update" type="text" class="validate attendance_input_update">
						    </div>
						    <div class="input-field col s12">
						      <input placeholder="Student Id" disabled name="student_id_att_update" id="student_id_att_update" type="text" class="validate attendance_input_update">
						    </div>
						    <div class="input-field col s12">
						      <input placeholder="Month" name="month_att_update" id="month_att_update" type="text" class="validate attendance_input_update">
						    </div>
							<div class="input-field col s4">
						      <input placeholder="Days present" name="days_present_att_update" id="days_present_att_update" type="text" class="validate attendance_input_update">
						    </div>
						    <div class="input-field col s4">
						      <input placeholder="Days late" name="days_late_att_update" id="days_late_att_update" type="text" class="validate attendance_input_update">
						    </div>
						    <div class="input-field col s4">
						      <input placeholder="Days absent" name="days_absent_att_update" id="days_absent_att_update" type="text" class="validate attendance_input_update">
						    </div>
					    </div>

			    </div>
			    <div class="modal-footer">
			      <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat" onclick="location.reload();">Close</a>
			      <button href="#!" class="left modal-actionwaves-effect waves-green btn-flat"type='submit' id='btn-update-ani'>Update</button>
			      	</form>
			    </div>
			</div>
		<div id="updatelabelattendance" class="modal">
	    <div class="modal-content center-align">
	    	<p class='successlabelforattendance'></p>
	    </div>
	    <div class="modal-footer">
	      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
	    </div>
	  </div>

	  <div id="deletelabelattendance" class="modal">
	    <div class="modal-content center-align">
	    	<div class="qeustiondelatt">
		      <p><b>Are you sure you want to delete attendance record of</b> : <span class="delfrom"></span> ?</p>
		       <a class="waves-effect waves-green btn-flat" id='delattendaceyes'>Yes</a>
		        <a class="waves-effect waves-red btn-flat modal-action modal-close">No</a>
			</div>
			<p class='hidden-input pfordellabel red-text'>Attendance record deleted!</p>
	    </div>
	    <div class="modal-footer">
	      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat" onclick="location.reload();">Close</a>
	    </div>
  	</div>
			</div>		    
		</main>
		<footer></footer>
		
		<script src="../js/jquery.1.12.0.js"></script>
		<script src="../js/materialize.min.js"></script>
		<script src="../js/faculty.js"></script>
	</body>
</html>