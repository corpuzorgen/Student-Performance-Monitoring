<?php 
	session_start();
	if( !isset($_SESSION['facultyUsername']) ){
		header('Location: ../portal-signin.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Faculty Dashboard CC Smart Kidz School Incorporated - Official Website</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		
		<header class="faculty-dashboard">
			<nav class=" light-blue darken-1">
			    <div class="nav-wrapper nav-wrapper-faculty">
			    	<div class="nav-wrap-show">
				    <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
				    <ul class="">
				        <li><a href="" class="faculty-page-title">Dashboard</a></li>
	      			</ul>
	      			<ul id="slide-out" class="side-nav">
	      				<li class="faculty-avatar-sidenav light-blue darken-1">
							<img src="../images/admin-avatar.png" alt="" class="faculty-avatar-img" >
							<p class="faculty-usr">Employee Id: <b><span id="faculty-empid-nav"></span></b></p>
	      				</li>
						<li class="active"><a href="dashboard.php"><i class="fa fa-tachometer fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
					    <li class=""><a href="profile.php"><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
					    <li class=""><a href="messages.php"><i class="fa fa-comments-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a></li>
					    <li class=""><a href="class.php"><i class="fa fa-calendar-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Class</a></li>
					    <li class=""><a href="grades.php"><i class="fa fa-percent fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Grades</a></li>
					    <li class=""><a href="evaluation.php"><i class="fa fa-area-chart fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Evaluation</a></li>
					    <li class=""><a href="attendance.php"><i class="fa fa-calendar fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Attendance</a></li>
					    <a href="../logout.php"><i class="fa fa-sign-out fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
	  				</ul>
	  				<a href="" data-target="dashboard-settings" class="modal-trigger"><i class="material-icons right" >more_vert</i></a>
	  			
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
			<div class="container"style="margin-top: 5%;">
				
			<div class="row">

		      <div class="col s12 m6 profilesummaryfaculty">
						<div class="card grey darken-1">
				            <div class="card-content white-text">
				              <span class="card-title"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Profile</span>
				              <div class="divider dashboard-divider"></div>
				              <div class="card-content">
					             <h5><i class="fa fa-tag" aria-hidden="true"></i>&nbsp;&nbsp;<span id="complete-name-faculty"></span></h5>
					             <h5><i class="fa fa-hashtag" aria-hidden="true"></i>&nbsp;&nbsp;<span id="faculty-empid"></span></h5>
					             <h5><i class="fa fa-sitemap" aria-hidden="true"></i>&nbsp;&nbsp;<span id='position-faculty'></span></h5>
					          </div>
				            </div>
				        </div>
					</div>
		      <div class="col s12 m6 class">
						<div class="card grey darken-1">
				            <div class="card-content white-text">
				              <span class="card-title"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Class</span>
				              <div class="divider dashboard-divider"></div>
				              <div class="card-content">
					            <h5 class="numclass"></h5>
					            <h5 class="numstud"></h5>
					          </div>
				            </div>
				        </div>
					</div>

					<div class="col s12 number of students per class">
						<div class="card grey darken-1">
				            <div class="card-content white-text">
				              <span class="card-title"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Students</span>
				              <div class="divider dashboard-divider"></div>
				              <div class="card-content">
					            
					          </div>
				            </div>
				        </div>
					</div>

    		</div>


				<!-- Modal Structure -->
			  <div id="dashboard-settings" class="modal bottom-sheet">
			    	<div class="modal-content">
			      			<h4>Dashboard Settings</h4>
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
		<footer></footer>
		
		<script src="../js/jquery.1.12.0.js"></script>
		<script src="../js/materialize.min.js"></script>
		<script src="../js/faculty.js"></script>
	</body>
</html>