<?php 
	session_start();
	if( !isset($_SESSION['adminEmployeeId']) ){
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Profile CC Smart Kidz School Incorporated - Official Website</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		<header class="admin-profile">
			<nav>
			    <div class="nav-wrapper nav-wrapper-admin">
			    	<div class="nav-wrap-show">
				    <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
				    <ul class="">
				        <li><a href="" class="admin-page-title">Profile</a></li>
	      			</ul>
	      			<ul id="slide-out" class="side-nav">
	      				<li class="admin-avatar-sidenav red darken-3">
							<img src="../images/admin-avatar.png" alt="" class="admin-avatar-img " >
							<p class="admin-usr">Employee Id: <b><span id="admin-empid-nav"></span></b></p>
	      				</li>
						<li class=""><a href="dashboard.php"><i class="fa fa-tachometer fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
					    <li class="active"><a href="profile.php"><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
					    <li class=""><a href="messages.php"><i class="fa fa-comments-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a></li>
					    <li class=""><a href="accounts.php"><i class="fa fa-users fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Accounts</a></li>
					    <li class=""><a href="post.php"><i class="fa fa-pencil-square-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Post</a></li>
					    <li class=""><a href="gallery.php"><i class="fa fa-picture-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Gallery</a></li>
					    <li class=""><a href="finance.php"><i class="fa fa-money fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Finance Statement</a></li>
					    <a href="../logout.php"><i class="fa fa-sign-out fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
	  				</ul>
	  				<a href="" data-target="profile-settings" class="modal-trigger"><i class="material-icons right" >more_vert</i></a>
	  				
					</div>
					<form id="search-admin-content"class="hide">
				        <div class="input-field">
				          <input id="search" type="search" placeholder="What are you looking? Search it here."required>
				          <label for="search"><i class="material-icons">search</i></label>
				          <i class="material-icons close-search">close</i>
				        </div>
			      	</form>	  				
			    </div>
			</nav>			
		</header>	
		<main>
			<div class="container" style="margin-top: 2%;">
				<div class="row">
					<div class="col s12 m5" >
						<div class="row">
					      <div class="col s12 m12">
					        <div class="card-panel ">
					        	<div class="card-image">
					        		<div id="card-image-admin">
					        			<img src="avatar/avatar.png" class="responsive-img profile-admin-avatar-default" style="margin-bottom: 3%;">
					        			<img src="" class="responsive-img profile-admin-avatar hidden-input" style="margin-bottom: 3%;">
					        		</div>
									<form id="admin-avatar-form" style="margin-bottom: 5%;" class="hidden-input">
									    <div class="file-field input-field">
									      <div class="btn">
									        <span>File</span>
									        <input type="file" name="adminImage" accept="image/*" id="admin_avatar-input">
									      </div>
									      <div class="file-path-wrapper">
									        <input class="file-path validate" type="text" placeholder="Upload profile avatar">
									      </div>
									    </div>
										<button class="btn waves-effect waves-light" type="submit" name="action">Upload</button>
									</form>			         		
								</div>
								<div class="divider"></div>
								<div class="section " id="account-info-admin">
									<div class="account-info-data account-empid valign-wrapper">
										<p class=""><i class="fa fa-hashtag"></i>&nbsp;&nbsp;&nbsp;<span id="admin-empid"> </span><span class="grey-info empid-admin-grey">Employee Id</span></p>
										<input type="text" class=" hidden-input validate" placeholder="Employee Id" id="admin-empid-input">
										<label for="admin-empid-input" data-error=""></label>
									</div>
								    <div class="account-info-data account-pass valign-wrapper">
										<p class="" ><i class="fa fa-lock"></i>&nbsp;&nbsp;&nbsp;<span id="admin-password"> </span><span class="grey-info password-admin-grey">*******</span></p>
										<input type="password" class=" hidden-input validate" placeholder="Password" id="admin-old-pass-input"><label for="admin-old-pass-input" data-error=""></label>
								    </div>
								    <div class="account-info-data valign-wrapper">
								    	<input type="password" class=" hidden-input validate" placeholder="New Password" id="admin-new-pass-input">
								    	<a href="" class="show-password"><i class="fa fa-eye fa-lg hidden-input"></i></a>
								    	<a href="" class="hide-password"><i class="fa fa-eye-slash fa-lg hidden-btn"></i></a>
								    </div>
								    <span class="error-msg-account-info err-old-pass-admin red-text"></span>
								    <span class="error-msg-account-info err-new-pass-admin red-text"></span>
								     <span class="success-msg-account-info success-img-admin green-text"></span>
								    <span class="success-msg-account-info success-old-pass-admin green-text"></span>
								    <span class="success-msg-account-info success-new-pass-admin green-text"></span>
								</div>
								<div class="card-action valign-wrapper">
					              <a href="#" class="update-account-info-btn">Update information</a>
					              <a href="#" class="save-account-info-btn hidden-input">Save</a>&nbsp;&nbsp;
					               <a href="#" class="cancel-account-info-btn red-text hidden-input">Cancel</a>
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
							        	<a href="" class="basic-info-btn-edit"><i class="fa fa-pencil fa-lg black-text"></i></a>
							        	<a href="" class="basic-info-btn-save tooltipped hidden-input "data-position="top" data-delay="50" data-tooltip="save"><i class="fa fa-floppy-o fa-lg green-text"></i></a>&nbsp;&nbsp;
							        	<a href="" class="basic-info-btn-back tooltipped hidden-input" data-position="top" data-delay="50" data-tooltip="go back"><i class="fa fa-arrow-left fa-lg red-text"></i> </a>
						        	</div>
					        	</div>
								<div class="divider"></div>
							  	<div class="section black-text" id="basic-information-admin">
							  		<div class="basic-info-data valign-wrapper">
							  			<h5 class="basic-info">
							  			<span id="complete-name-admin"></span>
							  			<span class="grey-info complete-name">Complete name</span></h5>
							  			<input type="text" class="validate hidden-input" placeholder="First name" id="firstnm-admin">
							  			<input type="text" class="validate hidden-input" placeholder="Middle name" id="middlenm-admin">
							  			<input type="text" class="validate hidden-input" placeholder="Last name" id="lastnm-admin">
							  		</div>
							    	<div class="basic-info-data valign-wrapper">
							    		<p class="basic-info" id="">
							    		<i class="fa fa-male"></i>&nbsp;&nbsp;&nbsp;<span class="" id="gender-admin"></span><span class="grey-info  gender-grey-admin">Gender</span></p>
							    		<select name="" id="gender-admin-input" class="browser-default validate hidden-input">
							    			<option value="" disabled selected>Gender</option>
							    			<option value="Male">Male</option>
							    			<option value="Female">Female</option>
							    		</select>
							    	</div>
							    	<div class="basic-info-data valign-wrapper">
							    		<p class="basic-info" id="">
							    		<i class="fa fa-birthday-cake"></i>&nbsp;&nbsp;&nbsp;<span class="" id="dob-admin"></span><span class="grey-info dob-grey-admin">Date of Birth</span></p>
							    		<input type="text" class="validate hidden-input" placeholder="Date of Birth e.g MM/DD/YYYY" id="dob-admin-input">
							    	</div>
							    	<div class="basic-info-data valign-wrapper">
							    		<p class="basic-info" id="">
							    		<i class="fa fa-home"></i>&nbsp;&nbsp;&nbsp;<span class="" id="address-admin"></span><span class="grey-info address-grey-admin">Home address</span></p>
							    		<input type="text" class="validate hidden-input col s12" placeholder="Home address" id="address-admin-input">
							    		
							    	</div>
							    	<span class="error-msg err-name-admin red-text"></span>
							    	<span class="error-msg err-dob-admin red-text"></span>
							    	<span class="error-msg err-address-admin red-text"></span>
							    	<span class="success-msg success-name-admin green-text"></span>
							    	<span class="success-msg success-gender-admin green-text"></span>
							    	<span class="success-msg success-dob-admin green-text"></span>
							    	<span class="success-msg success-address-admin green-text"></span>
							  	</div>
					        </div>
					      </div>
					      <div class="col s12 m12">
					        <div class="card-panel hoverable">
					        	<div>
						        	<span class="card-title"><h5 class="profile-title-card black-text" style="display: inline-block;">Contact Information</h5></span>
						        	<div class="valign-wrapper right">
							        	<a href="" class="contact-info-btn-edit-contact"><i class="fa fa-pencil fa-lg black-text"></i></a>
							        	<a href="" class="contact-info-btn-save-contact tooltipped hidden-input "data-position="top" data-delay="50" data-tooltip="save"><i class="fa fa-floppy-o fa-lg green-text"></i></a>&nbsp;&nbsp;
							        	<a href="" class="contact-info-btn-back-contact tooltipped hidden-input" data-position="top" data-delay="50" data-tooltip="go back"><i class="fa fa-arrow-left fa-lg red-text"></i> </a>
						        	</div>
					        	</div>
								<div class="divider"></div>
							  	<div class="section black-text" id="contact-information-admin">
							  		<div class="contact-info-data valign-wrapper">
							  			<h5 class="contact-info"><span id="position-admin"></span><span class="grey-info position-grey-admin">Position in School Department</span></h5>
										<input type="text" class="validate hidden-input" placeholder="Position" id="position-admin-input">
							  		</div>
							    	<div class="contact-info-data valign-wrapper">
							    		<p class="contact-info"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;&nbsp;<span class=" " id="email-admin"></span><span class="grey-info email-grey-admin">Email address</span></p>
							    		<input type="email" class="validate hidden-input" placeholder="Email address" id="email-admin-input">
							    	</div>
							    	<div class="contact-info-data valign-wrapper">
										<p class="contact-info"><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;<span class=" " id="phone-admin"></span><span class="grey-info phone-grey-admin">Phone number</span></p>
										<input type="text" class="validate hidden-input" placeholder="Phone number" id="phone-admin-input">
							    	</div>
							    	<span class="error-msg-contact-info err-position-admin red-text"></span>
							    	<span class="error-msg-contact-info err-email-admin red-text"></span>
							    	<span class="error-msg-contact-info err-phone-admin red-text"></span>
							    	<span class="success-msg-contact-info success-position-admin green-text"></span>
							    	<span class="success-msg-contact-info success-email-admin green-text"></span>
							    	<span class="success-msg-contact-info success-phone-admin green-text"></span>
							  	</div>
					        </div>
					      </div>
					    </div>
					</div>					
				</div>
			</div>
			<!-- Modal Structure -->
			  <div id="account-info-modal" class="modal">
			    <div class="modal-content modal-account-msg">
			      <div class="divider"></div>
			      <p class="admin-empid-updated hidden-input">Employee Id has been Updated</p>
			      <p class="admin-username-updated hidden-input">Username has been Updated</p>
			      <p class="admin-password-update hidden-input">Password has been Updated</p>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
			    </div>
			  </div>			
			<!-- Modal Structure Profile Settings-->
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
		</main>


		<script src="../js/jquery.1.12.0.js"></script>
		<script src="../js/materialize.min.js"></script>
		<script src="../js/script.js"></script>
	</body>
</html>