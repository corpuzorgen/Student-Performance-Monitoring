<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang='en'>
	<head>		
		<title>Parent Corner Account</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>
		
		<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
	<body>
		<main id="pportal" class="container ">
			<div class="row">
		      	<div class="col s12 m4 l3">
		        <!-- Grey navigation panel -->
		        <img src="images/logo.png" class="center-align">
		        <h1 class="">CC Smart Kidz Inc.</h1>
		        <p></p>
		     	</div>

		      	<div class="col s12 m8 l9">
			        <!-- Teal page content  -->
			        <h3 class="">Parent <span id="login_register">Login</span></h3>
			        <form class="col s12" id="parent_login">
				     	<div class="row">
					        <div class="input-field col s6">
					          <i class="material-icons prefix iconlog">account_circle</i>
					          <input id="parent_id_login" type="text" class="validate" name="parent_id_login">
					          <label for="parent_id_login" class="loginlablel">Parent Id</label>
					        </div>
					        <div class="input-field col s6">
					          <i class="material-icons prefix iconlog">lock</i>
					          <input id="parent_password_login" type="password" class="validate" name="parent_password_login">
					          <label for="parent_password_login" class="loginlablel">Password</label>
					        </div>
					        <span id="loginalert" class="center-align"></span>
				   		</div>
				   		<div class="row">
					        <div class="input-field col s6 ">
								<button class="btn waves-effect waves-light" type="submit" name="action">Login</button>
							</div>
							<div class="input-field col s6 ">
								<p>Create an account. <a id="parent_registerbtn">Register here</a></p>
							</div>
						</div>
				      
				    </form>
			
				    <form class="col s12" id="parent_register">
						<div class="row">
					        <div class="input-field col s6">
					          <input id="first_name" name="firstname" type="text" class="validate">
					          <label for="first_name" data-error=" " class="col s6">*First Name</label>
					        </div>
					        <div class="input-field col s6">
					          <input id="last_name" name="lastname" type="text" class="validate">
					          <label for="last_name" data-error=" " class="col s6">*Last Name</label>
					        </div>
					    </div>
					    <div class="row">
					        <div class="input-field col s12">
					          <input id="parent_id" name="parent_id" type="text" class="validate">
					          <label for="parent_id" data-error=" " class="col s12">*Parent Id</label>
					        </div>
					    </div>
					    <div class="row">
					        <div class="input-field col s12">
					          <input id="email" name="email" type="email" class="validate">
					          <label for="email" data-error="Please enter a valid email address. e.g 'user@gmail.com'" class="col s12">*Email</label>
					        </div>
					    </div>
					    <div class="row">
					        <div class="input-field col s12">
					          <input id="password" name="password" type="password" class="validate">
					          <label for="password" data-error=" " class="col s12">*Password</label>
					        </div>
					    </div>
					    <div class="row">
					        <div class="input-field col s12">
					          <input id="repassword" name="repassword" type="password" class="validate">
					          <label for="repassword" data-error=" " class="col s12">*Re-type Password</label>
					        </div>
					    </div>
					    <div class="input-field col s6 ">
							<button class="btn waves-effect waves-light" type="submit" name="action">Register</button>
						</div>
						<div class="input-field col s6 ">
							<p>Already have an account? <a id="parent_loginbtn">Login here</a></p>
						</div>
				    </form>
		      	</div>
	      	</div>			
			
			<!-- Modal -->
			<div id="modal1" class="modal">
			    <div class="modal-content">
			      <span id="parentsuccess"></span>
			      <a href="#!" class="close modal-action modal-close waves-effect waves-red btn-flat">close</a>
			    </div>
			    
 			</div>
		</main>
		
		
		<script src="js/jquery.1.12.0.js"></script>
		<script src="js/materialize.min.js"></script>
		<script src="js/parent.js"></script>
	</body>
	</html>