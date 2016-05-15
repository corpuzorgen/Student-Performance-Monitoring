<?php 
	session_start();
	if( !isset($_SESSION['parentUsername']) ){
		header('Location: ../parent-portal.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Parent Attendance CC Smart Kidz School Incorporated - Official Website</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		
		<header class="parent-Attendance">
			<nav class=" light-blue darken-1">
			    <div class="nav-wrapper nav-wrapper-parent">
			    	<div class="nav-wrap-show">
				    <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
				    <ul class="">
				        <li><a href="" class="parent-page-title">Attendance</a></li>
	      			</ul>
	      			<ul id="slide-out" class="side-nav">
	      				<li class="parent-avatar-sidenav light-blue darken-1">
							<img src="../images/admin-avatar.png" alt="" class="parent-avatar-img" >
							<p class="parent-usr">Parent Id: <b><span id="parent-pid-nav"></span></b></p>
	      				</li>
						<li class=""><a href="dashboard.php"><i class="fa fa-tachometer fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
					    <li class=""><a href="profile.php"><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
					    <li class=""><a href="messages.php"><i class="fa fa-comments-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a></li>
					   	<li class=""><a href="evaluation.php"><i class="fa fa-area-chart fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;View Evaluation</a></li>
					   	<li class="active"><a href="attendance.php"><i class="fa fa-calendar fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;View Attendance</a></li>
					    <a href="../logout.php"><i class="fa fa-sign-out fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
	  				</ul>
	  				<a href="" data-target="Attendance-settings" class="modal-trigger"><i class="material-icons right" >more_vert</i></a>
	  				<a href="" class="parent-search"><i class="material-icons right">search</i></a>
					</div>
					<form id="search-parent-content"class="hide">
				        <div class="input-field">
				          <input id="search" type="search" placeholder="What are you looking? Search it here."required>
				        
				          <i class="material-icons close-search-parent">close</i>
				        </div>
			      	</form>	  				
			    </div>
			</nav>			
		</header>

		<main>
			<div class="container"style="margin-top: 2%;">


			<h4 class="grey-text center-align" style="margin-bottom: 3%;">Select Student to see the Attendance via Graphs</h4>

			<form action="" style="margin-bottom: 10%;">
				<select name="" id="childattendance" class="browser-default" style="margin-bottom: 5%;">
					<option disabled value="null" class="liststudentattendanceparent">Select Student to view Attendance</option>
				</select>
				<div class="monthlist">
					
				</div>
			</form>

			<div id="attendancecontainer"></div>

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
			</div>		    
		</main>
			<div id="attendancetable" style="display: none;">
				<table id="attendancetableprint">
					<thead>
					<tr>
					<th colspan="100%"><h4>Attendance Report</h4><hr /></th></tr>
					</tr>
					<tr>
						<th>Name</th>
				        <th>Month</th>
				        <th>Days Present</th>
				        <th>Days Late</th>
				        <th>Days Absent</th>
				        <th>Class Teacher</th>
					</tr>
					</thead>
					<tbody class="tbody-sumgradeforparent">

					</tbody>
				</table>
			</div>
		<div class="fixed-action-btn horizontal attdlbtn invisible" style="bottom: 45px; right: 24px;">
	    <a href="#" class="btn-floating btn-large blue tooltipped" data-position="left" data-delay="50" data-tooltip="Download Attendance Report (PDF)" id='exporttopdfattendance'>
	   		<i class="fa fa-download" aria-hidden="true"></i>
	    </a>
 	</div>
 	<div class="fixed-action-btn horizontal attdlbtn invisible" style="bottom: 45px; right: 94px;">
	    <a class="btn-floating btn-large grey tooltipped" data-position="left" data-delay="50" data-tooltip="Print Attendance Report" id='printattendance'>
	   		<i class="fa fa-print" aria-hidden="true"></i>
	    </a>
 	</div>
		<script src="../js/jquery.1.12.0.js"></script>
		<script src="../js/jquery.canvasjs.min.js"></script>
		<script src="../js/materialize.min.js"></script>
		<script src="../js/parent.js"></script>
	</body>
</html>