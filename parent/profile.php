<?php 
	session_start();
	if( !isset($_SESSION['parentUsername']) ){
		header('Location: ../parent-portal.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Parent Profile CC Smart Kidz School Incorporated - Official Website</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		
		<header class="parent-Profile">
			<nav class=" light-blue darken-1">
			    <div class="nav-wrapper nav-wrapper-parent">
			    	<div class="nav-wrap-show">
				    <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
				    <ul class="">
				        <li><a href="" class="parent-page-title">Profile</a></li>
	      			</ul>
	      			<ul id="slide-out" class="side-nav">
	      				<li class="parent-avatar-sidenav light-blue darken-1">
							<img src="../images/admin-avatar.png" alt="" class="parent-avatar-img" >
							<p class="parent-usr">Parent Id: <b><span id="parent-pid-nav"></span></b></p>
	      				</li>
						<li class=""><a href="dashboard.php"><i class="fa fa-tachometer fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
					    <li class="active"><a href="profile.php"><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
					    <li class=""><a href="messages.php"><i class="fa fa-comments-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a></li>
					    <li class=""><a href="evaluation.php"><i class="fa fa-area-chart fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;View Evaluation</a></li>
					    <li class=""><a href="attendance.php"><i class="fa fa-calendar fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;View Attendance</a></li>
					    <a href="../logout.php"><i class="fa fa-sign-out fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
	  				</ul>
	  				<a href="" data-target="Profile-settings" class="modal-trigger"><i class="material-icons right" >more_vert</i></a>
	  				
					</div>
					<form id="search-parent-content"class="hide">
				        <div class="input-field">
				          <input id="search" type="search" placeholder="What are you looking? Search it here."required>
				          <label for="search"><i class="material-icons">search</i></label>
				          <i class="material-icons close-search-parent">close</i>
				        </div>
			      	</form>	  				
			    </div>
			</nav>			
		</header>

		<main>
			<div class="container"style="margin-top: 3%;">
				<div class="row">
					<div class="col s12 m5" >
						<div class="row">
					      <div class="col s12 m12">
					        <div class="card-panel ">
					        	<div class="card-image">
					        		<div id="card-image-parent">
					        			<img src="avatar/avatar.png" class="responsive-img profile-parent-avatar-default" style="margin-bottom: 3%;">
					        			<img src="" class="responsive-img profile-parent-avatar hidden-input" style="margin-bottom: 3%;">
					        		</div>
									<form id="parent-avatar-form" style="margin-bottom: 5%;" class="hidden-input">
									    <div class="file-field input-field">
									      <div class="btn">
									        <span>File</span>
									        <input type="file" name="parentImage" accept="image/*" id="parent_avatar-input">
									      </div>
									      <div class="file-path-wrapper">
									        <input class="file-path validate" type="text" placeholder="Upload profile avatar">
									      </div>
									    </div>
										<button class="btn waves-effect waves-light" type="submit" name="action">Upload</button>
									</form>			         		
								</div>
								<div class="divider"></div>
								<div class="section " id="account-info-parent">
									<div class="account-info-data-parent account-pid-parent valign-wrapper">
										<p class=""><i class="fa fa-hashtag"></i>&nbsp;&nbsp;&nbsp;<span id="parent-pid"> </span><span class="grey-info pid-parent-grey">Parent Id</span></p>
										<input type="text" class=" hidden-input validate" placeholder="Parent Id" id="parent-pid-input">
										<label for="parent-pid-input" data-error=""></label>
									</div>
								    <div class="account-info-data-parent account-pass-parent valign-wrapper">
										<p class="" ><i class="fa fa-lock"></i>&nbsp;&nbsp;&nbsp;<span id="parent-password"> </span><span class="grey-info password-parent-grey">*******</span></p>
										<input type="password" class=" hidden-input validate" placeholder="Password" id="parent-old-pass-input"><label for="parent-old-pass-input" data-error=""></label>
								    </div>
								    <div class="account-info-data-parent valign-wrapper">
								    	<input type="password" class=" hidden-input validate" placeholder="New Password" id="parent-new-pass-input">
								    	<a href="" class="show-password-parent"><i class="fa fa-eye fa-lg fa-eye-parent hidden-input"></i></a>
								    	<a href="" class="hide-password-parent"><i class="fa fa-eye-slash fa-eye-slash-parent fa-lg hidden-btn"></i></a>
								    </div>
								    <span class="error-msg-account-info-parent err-old-pass-parent red-text"></span>
								    <span class="error-msg-account-info-parent err-new-pass-parent red-text"></span>
								     <span class="success-msg-account-info-parent success-img-parent green-text"></span>
								    <span class="success-msg-account-info-parent success-old-pass-parent green-text"></span>
								    <span class="success-msg-account-info-parent success-new-pass-parent green-text"></span>
								</div>
								<div class="card-action valign-wrapper">
					              <a href="#" class="update-account-info-btn-parent">Update information</a>
					              <a href="#" class="save-account-info-btn-parent hidden-input">Save</a>&nbsp;&nbsp;
					               <a href="#" class="cancel-account-info-btn-parent red-text hidden-input">Cancel</a>
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
							        	<a href="" class="basic-info-btn-edit-parent"><i class="fa fa-pencil fa-lg black-text"></i></a>
							        	<a href="" class="basic-info-btn-save-parent tooltipped hidden-input "data-position="top" data-delay="50" data-tooltip="save"><i class="fa fa-floppy-o fa-lg green-text"></i></a>&nbsp;&nbsp;
							        	<a href="" class="basic-info-btn-back-parent tooltipped hidden-input" data-position="top" data-delay="50" data-tooltip="go back"><i class="fa fa-arrow-left fa-lg red-text"></i> </a>
						        	</div>
					        	</div>
								<div class="divider"></div>
							  	<div class="section black-text" id="basic-information-parent">
							  		<div class="basic-info-data-parent valign-wrapper">
							  			<h5 class="basic-info">
							  			<span id="complete-name-parent"></span>
							  			<span class="grey-info complete-nameparent">Complete name</span></h5>
							  			<input type="text" class="validate hidden-input" placeholder="First name" id="firstnm-parent">
							  			<input type="text" class="validate hidden-input" placeholder="Middle name" id="middlenm-parent">
							  			<input type="text" class="validate hidden-input" placeholder="Last name" id="lastnm-parent">
							  		</div>
							    	<div class="basic-info-data-parent valign-wrapper">
							    		<p class="basic-info" id="">
							    		<i class="fa fa-male"></i>&nbsp;&nbsp;&nbsp;<span class="" id="gender-parent"></span><span class="grey-info  gender-grey-parent">Gender</span></p>
							    		<select name="" id="gender-parent-input" class="browser-default validate hidden-input">
							    			<option value="" disabled selected>Gender</option>
							    			<option value="Male">Male</option>
							    			<option value="Female">Female</option>
							    		</select>
							    	</div>
							    	<div class="basic-info-data-parent valign-wrapper">
							    		<p class="basic-info" id="">
							    		<i class="fa fa-birthday-cake"></i>&nbsp;&nbsp;&nbsp;<span class="" id="dob-parent"></span><span class="grey-info dob-grey-parent">Date of Birth</span></p>
							    		<input type="text" class="validate hidden-input" placeholder="Date of Birth e.g MM/DD/YYYY" id="dob-parent-input">
							    	</div>
							    	<div class="basic-info-data-parent valign-wrapper">
							    		<p class="basic-info" id="">
							    		<i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;<span class="" id="address-parent"></span><span class="grey-info address-grey-parent">Home address</span></p>
							    		<input type="text" class="validate hidden-input col s12" placeholder="Home address" id="address-parent-input">
							    		
							    	</div>
							    	<span class="error-msg-parent err-name-parent red-text"></span>
							    	<span class="error-msg-parent err-dob-parent red-text"></span>
							    	<span class="error-msg-parent err-address-parent red-text"></span>
							    	<span class="success-msg-parent success-name-parent green-text"></span>
							    	<span class="success-msg-parent success-gender-parent green-text"></span>
							    	<span class="success-msg-parent success-dob-parent green-text"></span>
							    	<span class="success-msg-parent success-address-parent green-text"></span>
							  	</div>
					        </div>
					      </div>
      
					      <div class="col s12 m12">
					        <div class="card-panel hoverable">
					        	<div>
						        	<span class="card-title"><h5 class="profile-title-card black-text" style="display: inline-block;">Contact Information</h5></span>
						        	<div class="valign-wrapper right">
							        	<a href="" class="contact-info-btn-edit-contact-parent"><i class="fa fa-pencil fa-lg black-text"></i></a>
							        	<a href="" class="contact-info-btn-save-contact-parent tooltipped hidden-input "data-position="top" data-delay="50" data-tooltip="save"><i class="fa fa-floppy-o fa-lg green-text"></i></a>&nbsp;&nbsp;
							        	<a href="" class="contact-info-btn-back-contact-parent tooltipped hidden-input" data-position="top" data-delay="50" data-tooltip="go back"><i class="fa fa-arrow-left fa-lg red-text"></i> </a>
						        	</div>
					        	</div>
								<div class="divider"></div>
							  	<div class="section black-text" id="contact-information-parent">
							    	<div class="contact-info-data-parent valign-wrapper">
							    		<p class="contact-info"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;&nbsp;<span class=" " id="email-parent"></span><span class="grey-info email-grey-parent">Email address</span></p>
							    		<input type="email" class="validate hidden-input" placeholder="Email address" id="email-parent-input">
							    	</div>
							    	<div class="contact-info-data-parent valign-wrapper">
										<p class="contact-info"><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;<span class=" " id="phone-parent"></span><span class="grey-info phone-grey-parent">Phone number</span></p>
										<input type="text" class="validate hidden-input" placeholder="Phone number" id="phone-parent-input">
							    	</div>
							    	<span class="error-msg-contact-info-parent err-email-parent red-text"></span>
							    	<span class="error-msg-contact-info-parent err-phone-parent red-text"></span>
							    	<span class="success-msg-contact-info-parent success-email-parent green-text"></span>
							    	<span class="success-msg-contact-info-parent success-phone-parent green-text"></span>
							  	</div>
					        </div>
					      </div>
					    </div>
					</div>					
				</div>

			</div>


			<!-- Modal Structure -->
			  <div id="Profile-settings" class="modal bottom-sheet">
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
		</main>
		<footer></footer>
		
		<script src="../js/jquery.1.12.0.js"></script>
		<script src="../js/materialize.min.js"></script>
		<script src="../js/parent.js"></script>
	</body>
</html>