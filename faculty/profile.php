<?php 
	session_start();
	if( !isset($_SESSION['facultyUsername']) ){
		header('Location: ../portal-signin.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Faculty Profile CC Smart Kidz School Incorporated - Official Website</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		<header class="faculty-profile">
			<nav class=" light-blue darken-1">
			    <div class="nav-wrapper nav-wrapper-faculty">
			    	<div class="nav-wrap-show">
				    <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
				    <ul class="">
				        <li><a href="" class="faculty-page-title">Profile</a></li>
	      			</ul>
	      			<ul id="slide-out" class="side-nav">
	      				<li class="faculty-avatar-sidenav light-blue darken-1">
							<img src="../images/admin-avatar.png" alt="" class="faculty-avatar-img" >
							<p class="faculty-usr">Employee Id: <b><span id="faculty-empid-nav"></span></b></p>
	      				</li>
						<li class=""><a href="dashboard.php"><i class="fa fa-tachometer fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
					    <li class="active"><a href="profile.php"><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
					    <li class=""><a href="messages.php"><i class="fa fa-comments-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a></li>
					    <li class=""><a href="class.php"><i class="fa fa-calendar-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Class</a></li>
					    <li class=""><a href="grades.php"><i class="fa fa-percent fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Grades</a></li>
					    <li class=""><a href="evaluation.php"><i class="fa fa-area-chart fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Evaluation</a></li>
					    <li class=""><a href="attendance.php"><i class="fa fa-calendar fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Attendance</a></li>
					    <a href="../logout.php"><i class="fa fa-sign-out fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
	  				</ul>
	  				<a href="" data-target="profile-settings" class="modal-trigger"><i class="material-icons right" >more_vert</i></a>
	  			
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
			<div class="container"style="margin-top: 2%;">
				<div class="row">
					<div class="col s12 m5" >
						<div class="row">
					      <div class="col s12 m12">
					        <div class="card-panel ">
					        	<div class="card-image">
					        		<div id="card-image-faculty">
					        			<img src="avatar/avatar.png" class="responsive-img profile-faculty-avatar-default" style="margin-bottom: 3%;">
					        			<img src="" class="responsive-img profile-faculty-avatar hidden-input" style="margin-bottom: 3%;">
					        		</div>
									<form id="faculty-avatar-form" style="margin-bottom: 5%;" class="hidden-input">
									    <div class="file-field input-field">
									      <div class="btn">
									        <span>File</span>
									        <input type="file" name="facultyImage" accept="image/*" id="faculty_avatar-input">
									      </div>
									      <div class="file-path-wrapper">
									        <input class="file-path validate" type="text" placeholder="Upload profile avatar">
									      </div>
									    </div>
										<button class="btn waves-effect waves-light" type="submit" name="action">Upload</button>
									</form>			         		
								</div>
								<div class="divider"></div>
								<div class="section " id="account-info-faculty">
									<div class="account-info-data-faculty account-empid-faculty valign-wrapper">
										<p class=""><i class="fa fa-hashtag"></i>&nbsp;&nbsp;&nbsp;<span id="faculty-empid"> </span><span class="grey-info empid-faculty-grey">Employee Id</span></p>
										<input type="text" class=" hidden-input validate" placeholder="Employee Id" id="faculty-empid-input">
										<label for="faculty-empid-input" data-error=""></label>
									</div>
								    <div class="account-info-data-faculty account-pass-faculty valign-wrapper">
										<p class="" ><i class="fa fa-lock"></i>&nbsp;&nbsp;&nbsp;<span id="faculty-password"> </span><span class="grey-info password-faculty-grey">*******</span></p>
										<input type="password" class=" hidden-input validate" placeholder="Password" id="faculty-old-pass-input"><label for="faculty-old-pass-input" data-error=""></label>
								    </div>
								    <div class="account-info-data-faculty valign-wrapper">
								    	<input type="password" class=" hidden-input validate" placeholder="New Password" id="faculty-new-pass-input">
								    	<a href="" class="show-password-faculty"><i class="fa fa-eye fa-lg fa-eye-faculty hidden-input"></i></a>
								    	<a href="" class="hide-password-faculty"><i class="fa fa-eye-slash fa-eye-slash-faculty fa-lg hidden-btn"></i></a>
								    </div>
								    <span class="error-msg-account-info-faculty err-old-pass-faculty red-text"></span>
								    <span class="error-msg-account-info-faculty err-new-pass-faculty red-text"></span>
								     <span class="success-msg-account-info-faculty success-img-faculty green-text"></span>
								    <span class="success-msg-account-info-faculty success-old-pass-faculty green-text"></span>
								    <span class="success-msg-account-info-faculty success-new-pass-faculty green-text"></span>
								</div>
								<div class="card-action valign-wrapper">
					              <a href="#" class="update-account-info-btn-faculty">Update information</a>
					              <a href="#" class="save-account-info-btn-faculty hidden-input">Save</a>&nbsp;&nbsp;
					               <a href="#" class="cancel-account-info-btn-faculty red-text hidden-input">Cancel</a>
					            </div>													         	
					        </div>
					      </div>
					    </div>				
					</div>
					<div class="col s12 m7">
						<div class="row">
						<div class="col s12 m12">
					        <div class="card-panel hoverable" id="basic-info-card">
					        	<div>
						        	<span class="card-title"><h5 class="profile-title-card black-text" style="display: inline-block;">Basic Information</h5></span>
						        	<div class="valign-wrapper right">
							        	<a href="" class="basic-info-btn-edit-faculty"><i class="fa fa-pencil fa-lg black-text"></i></a>
							        	<a href="" class="basic-info-btn-save-faculty tooltipped hidden-input "data-position="top" data-delay="50" data-tooltip="save"><i class="fa fa-floppy-o fa-lg green-text"></i></a>&nbsp;&nbsp;
							        	<a href="" class="basic-info-btn-back-faculty tooltipped hidden-input" data-position="top" data-delay="50" data-tooltip="go back"><i class="fa fa-arrow-left fa-lg red-text"></i> </a>
						        	</div>
					        	</div>
								<div class="divider"></div>
							  	<div class="section black-text" id="basic-information-faculty">
							  		<div class="basic-info-data-faculty valign-wrapper">
							  			<h5 class="basic-info">
							  			<span id="complete-name-faculty"></span>
							  			<span class="grey-info complete-namefaculty">Complete name</span></h5>
							  			<input type="text" class="validate hidden-input" placeholder="First name" id="firstnm-faculty">
							  			<input type="text" class="validate hidden-input" placeholder="Middle name" id="middlenm-faculty">
							  			<input type="text" class="validate hidden-input" placeholder="Last name" id="lastnm-faculty">
							  		</div>
							    	<div class="basic-info-data-faculty valign-wrapper">
							    		<p class="basic-info" id="">
							    		<i class="fa fa-male"></i>&nbsp;&nbsp;&nbsp;<span class="" id="gender-faculty"></span><span class="grey-info  gender-grey-faculty">Gender</span></p>
							    		<select name="" id="gender-faculty-input" class="browser-default validate hidden-input">
							    			<option value="" disabled selected>Gender</option>
							    			<option value="Male">Male</option>
							    			<option value="Female">Female</option>
							    		</select>
							    	</div>
							    	<div class="basic-info-data-faculty valign-wrapper">
							    		<p class="basic-info" id="">
							    		<i class="fa fa-birthday-cake"></i>&nbsp;&nbsp;&nbsp;<span class="" id="dob-faculty"></span><span class="grey-info dob-grey-faculty">Date of Birth</span></p>
							    		<input type="text" class="validate hidden-input" placeholder="Date of Birth e.g MM/DD/YYYY" id="dob-faculty-input">
							    	</div>
							    	<div class="basic-info-data-faculty valign-wrapper">
							    		<p class="basic-info" id="">
							    		<i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;<span class="" id="address-faculty"></span><span class="grey-info address-grey-faculty">Home address</span></p>
							    		<input type="text" class="validate hidden-input col s12" placeholder="Home address" id="address-faculty-input">
							    		
							    	</div>
							    	<span class="error-msg-faculty err-name-faculty red-text"></span>
							    	<span class="error-msg-faculty err-dob-faculty red-text"></span>
							    	<span class="error-msg-faculty err-address-faculty red-text"></span>
							    	<span class="success-msg-faculty success-name-faculty green-text"></span>
							    	<span class="success-msg-faculty success-gender-faculty green-text"></span>
							    	<span class="success-msg-faculty success-dob-faculty green-text"></span>
							    	<span class="success-msg-faculty success-address-faculty green-text"></span>
							  	</div>
					        </div>
					      </div>
      
					      <div class="col s12 m12">
					        <div class="card-panel hoverable">
					        	<div>
						        	<span class="card-title"><h5 class="profile-title-card black-text" style="display: inline-block;">Contact Information</h5></span>
						        	<div class="valign-wrapper right">
							        	<a href="" class="contact-info-btn-edit-contact-faculty"><i class="fa fa-pencil fa-lg black-text"></i></a>
							        	<a href="" class="contact-info-btn-save-contact-faculty tooltipped hidden-input "data-position="top" data-delay="50" data-tooltip="save"><i class="fa fa-floppy-o fa-lg green-text"></i></a>&nbsp;&nbsp;
							        	<a href="" class="contact-info-btn-back-contact-faculty tooltipped hidden-input" data-position="top" data-delay="50" data-tooltip="go back"><i class="fa fa-arrow-left fa-lg red-text"></i> </a>
						        	</div>
					        	</div>
								<div class="divider"></div>
							  	<div class="section black-text" id="contact-information-faculty">
							  		<div class="contact-info-data-faculty valign-wrapper">
							  			<h5 class="contact-info"><span id="position-faculty"></span><span class="grey-info position-grey-faculty">Position in School Department</span></h5>
										<input type="text" class="validate hidden-input" placeholder="Position" id="position-faculty-input">
							  		</div>
							    	<div class="contact-info-data-faculty valign-wrapper">
							    		<p class="contact-info"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;&nbsp;<span class=" " id="email-faculty"></span><span class="grey-info email-grey-faculty">Email address</span></p>
							    		<input type="email" class="validate hidden-input" placeholder="Email address" id="email-faculty-input">
							    	</div>
							    	<div class="contact-info-data-faculty valign-wrapper">
										<p class="contact-info"><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;<span class=" " id="phone-faculty"></span><span class="grey-info phone-grey-faculty">Phone number</span></p>
										<input type="text" class="validate hidden-input" placeholder="Phone number" id="phone-faculty-input">
							    	</div>
							    	<span class="error-msg-contact-info-faculty err-position-faculty red-text"></span>
							    	<span class="error-msg-contact-info-faculty err-email-faculty red-text"></span>
							    	<span class="error-msg-contact-info-faculty err-phone-faculty red-text"></span>
							    	<span class="success-msg-contact-info-faculty success-position-faculty green-text"></span>
							    	<span class="success-msg-contact-info-faculty success-email-faculty green-text"></span>
							    	<span class="success-msg-contact-info-faculty success-phone-faculty green-text"></span>
							  	</div>
					        </div>
					      </div>
					    </div>
					</div>					
				</div>
			</div>	


				<!-- Modal Structure -->
			  <div id="profile-settings" class="modal bottom-sheet">
			    	<div class="modal-content">
			      			<h4>Profile Settings</h4>
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