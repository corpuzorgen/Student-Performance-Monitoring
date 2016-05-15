<?php 
	session_start();
	if( !isset($_SESSION['facultyUsername']) ){
		header('Location: ../portal-signin.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Faculty Messages CC Smart Kidz School Incorporated - Official Website</title>
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
				        <li><a href="" class="faculty-page-title">Messages</a></li>
	      			</ul>
	      			<ul id="slide-out" class="side-nav">
	      				<li class="faculty-avatar-sidenav light-blue darken-1">
							<img src="../images/admin-avatar.png" alt="" class="faculty-avatar-img" >
							<p class="faculty-usr">Employee Id: <b><span id="faculty-empid-nav"></span></b></p>
	      				</li>
						<li class=""><a href="dashboard.php"><i class="fa fa-tachometer fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
					    <li class=""><a href="profile.php"><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
					    <li class="active"><a href="messages.php"><i class="fa fa-comments-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a></li>
					    <li class=""><a href="class.php"><i class="fa fa-calendar-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Class</a></li>
					    <li class=""><a href="grades.php"><i class="fa fa-percent fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Grades</a></li>
					    <li class=""><a href="evaluation.php"><i class="fa fa-area-chart fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Evaluation</a></li>
					    <li class=""><a href="attendance.php"><i class="fa fa-calendar fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Attendance</a></li>
					    <a href="../logout.php"><i class="fa fa-sign-out fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
	  				</ul>
	  				<a href="" data-target="message-settings" class="modal-trigger"><i class="material-icons right" >more_vert</i></a>
	  			
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
			<div class="row msg-wrap">
				<div class="col s12 m5 inbox-faculty">
					<h4 class="light-blue-text">Conversation</h4>
					<div class="divider"></div>
				  	<div class="section">
				  		<div class="no-mgs-yet-faculty center-align grey-text">
							<i class="fa fa-inbox fa-4x"></i>
							<h4 class="center-align">No message yet</h4>
						</div>
						<ul class="collection ul-msg-faculty">
							<!--
						    <li class="collection-item avatar li-msg-faculty">
							    <img src="images/yuna.jpg" alt="" class="circle">
								<span class="title inbox-receiver">Judel Dispo</span>
								<p class="truncate msg-content">asdasdasdsad</p>
								<p class="secondary-content "> few seconds ago</p>
						    </li>
						    <li class="collection-item avatar li-msg-faculty">
							    <img src="images/yuna.jpg" alt="" class="circle">
								<span class="title inbox-receiver">Renzy Guinto</span>								
								<p class="truncate msg-content">First Linee</p>
								<p class="secondary-content "> 1 hour ago</p>
						    </li>
						    -->
						</ul>

				  	</div>										
				</div>
				<div class="col s12 m7 blue-grey lighten-5 inbox-content-faculty">
					<h3 class="center-align grey-text no-msg">No message selected</h3>
					<div class="row">
				      <div class="col s12 m12">
				        <div class="card-panel white full-msg-faculty-panel hidden-input">
				          <span class="black-text">
				          		<div class="valign-wrapper header-msg teal-text">
				          			<img src="../images/male-user.png" alt="" height="35px" width="35px">&nbsp;&nbsp;	
				          			<h5 class="reciever-name-faculty" style="display: inline;margin-right: 62%;"></h5>
				          			<p class="right-align"><a href="" class='delmsgfaculty  red-text'><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a></p>
				          		</div>
								<div class="divider"></div>
								<div class="card-content content-msg-faculty">
					              <ul class="collection ul-msg-convo">
					              	
					              </ul>
					            </div>
				          </span>
							<div class="card-action footer-msg">
								<div class="row reply-msg-wrapper">
							        <div class="input-field col s12 type-msg-faculty">
							          <input type="text" placeholder="Type your reply here..." length="120" class="validate faculty-reply-msg">
							        </div>
							        <a class="waves-effect waves-teal btn-flat reply-faculty" style="">Reply</a>
							        <a class="waves-effect waves-red btn-flat" style="float: right;">Cancel</a>
						      	</div>
				            </div>
				        </div>
				      </div>
				    </div>
				</div>
			</div>

			<div class="fixed-action-btn horizontal click-to-toggle" style="bottom: 45px; right: 24px;">
			    <a href="#create-msg-faculty" class="btn-floating btn-large red tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="New message">
			      <i class="large material-icons light-blue">mode_edit</i>
			    </a>
  			</div>						

			<!-- Modal Structure Create Message -->
			<div id="create-msg-faculty" class="modal modal-fixed-footer">
			    <div class="modal-content">
			    <h4 class="light-blue-text">New Message</h4>
			    <div class="divider"></div>
			      <form id="message-room-faculty">
				      	<div class="row">
					      	<div class="input-field col s12">
					      		<i class="fa fa-at fa-1x prefix"></i>
								<input id="recipientforfaculty" type="text" class="validate" name=''>
								<ul id="results-faculty" class="grey-text select-dropdown invisible"></ul>
	          					<label for="recipientforfaculty" class="messagelabelforfaculty">Recipient's Name</label>
							</div>
							<div class="input-field col s12">
								<i class="fa fa-ticket fa-1x prefix"></i>
								<input id="subjectforfaculty" type="text" class="subject-input" value="">
	          					<label for="subjectforfaculty" class="messagelabelforfaculty">Subject (optional)</label>
							</div>
							<div class="input-field col s12">
					          <i class="fa fa-commenting fa-1x prefix"></i>
					          <textarea id="message_contentforfaculty" class="materialize-textarea validate" length="200"></textarea>
					          <label for="message_contentforfaculty" class="messagelabelforfaculty">Message...</label>
					        </div>						
				        </div>
			      </form>
			    </div>
			    <div class="modal-footer">
			    	<span class="sendingmsg-faculty hide">Sending message...</span>
			      <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat modal-close-msg-faculty">Close</a>
					<button class="btn left waves-effect waves-light" type="submit" name="action" id="sendmsg-faculty">Send
				    	<i class="material-icons right">send</i>
				  	</button>
			    </div>
			</div>	


				<!-- Modal Structure -->
			  <div id="message-settings" class="modal bottom-sheet">
			    	<div class="modal-content">
			      			<h4>Message Settings</h4>
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
		<div id="delfacultymsg" class="modal">
		    <div class="modal-content center-align">
		      <p>Are you sure you want to delete this?</p>
		      <a class="waves-effect waves-green btn-flat" id='delyesmsgfaculty'>Yes</a>&nbsp;
		      <a class="waves-effect modal-close waves-red btn-flat">No</a>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
		    </div>
		  </div>
		
		<script src="../js/jquery.1.12.0.js"></script>
		<script src="../js/materialize.min.js"></script>
		<script src="../js/faculty.js"></script>
	</body>
</html>