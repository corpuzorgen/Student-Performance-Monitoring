<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Login CC Smart Kidz School Incorporated - Official Website</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body class="admin-wrapper">
		<header class="admin-page z-depth-1"></header>
		<main class="admin-page">
			<div class="admin-login container">
				<div class="row">
					<h1 class="admin-panel-title center-align white-text">Admin Panel</h1>
				    <div class="col s12 m12">
				        <div class="card-panel hoverable white">
				        	<img src="../images/admin.png" alt="Admin Account Image" class"responsive-img admin-page-img" height="100px" width="100px"style="position: relative;top: 0;left: 50%;transform: translate(-50%);">
				        	<h5 class="center-align">Login</h5>
				        	<div class="container form-admin">
					          	<form role="form" id="form-login-admin">
					          		<div class="row">
										<div class="input-field col s12">
										    <i class="material-icons prefix">account_circle</i>
										    <input id="icon_prefix" type="text" name="admin_empid-login" id="admin_empid-login">
										    <label for="icon_prefix">Employee Id</label>
										</div>
										<div class="input-field col s12">
										    <i class="material-icons prefix">lock</i>
										    <input id="icon_prefix" type="password" name="admin_password-login" id="admin_password-login">
										    <label for="icon_prefix">Password</label>
										</div>				          			
					          		</div>
					          		<p class="center-align" id="admin-login-error-msg"></p>
					          		<div class="col s6 m6">
										<input type="checkbox" class="filled-in remember_admin" id="filled-in-box" />
								      	<label for="filled-in-box">REMEMBER ME</label>					          			
					          		</div>
					          		<div class="col s6 m6 right-align">
										<a href="">Forgot your password?</a>				          		
					          		</div>
					          		<div class="col s12 center-align btn-admin-form">
										<button type="submit" class="waves-effect waves-light btn">Login</button>			          		
					          		</div>
					          	</form>
				          	</div>
				        </div>
				    </div>
				</div>
			</div>
		</main>
		<footer class="admin-page"></footer>
		<script src="../js/jquery.1.12.0.js"></script>
		<script src="../js/materialize.min.js"></script>
		<script src="../js/script.js"></script>
	</body>
</html>