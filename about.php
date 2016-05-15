<!DOCTYPE html>
<html lang="en">
	<head>
		<title>About CC Smart Kidz - OFFICIAL WEBSITE</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>
		
		<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<header>
			<div class="navbar-fixed" id="hpnavheader">
				<nav>
					<div class="nav-wrapper blue darken-1">
					    <!-- Search -->
						<form class="hide" id="searchbar">
							<div class="input-field">
							    <input id="search" type="search" required>
							    <label for="search"><i class="material-icons">search</i></label>
							    <i class="material-icons" id="searchbtnclose">close</i>
							</div>
						</form>

						<!--Navigation-->
						<div id="hpnav"class=" ">
						    <a href="#" class="brand-logo">
						      	<div clas="valign-wrapper" id="hplogo">
							      	<img class="responsive-img logo" src="images/logo.png" width="25"height="25">
							      	<span class="logo">CC Smart Kidz Incorporated</span>
						      	</div>
						    </a>
						    <ul class="right hide-on-med-and-down">
							    <li><a href="index.php">HOME</a></li>
							    <li class="active"><a href="about.php"><i class="material-icons left">info_outline</i>ABOUT US</a></li>
							    <li><a class="dropdown-button" href="#!" data-activates="staffdrp"><i class="material-icons left">recent_actors</i>STAFF<i class="material-icons right">arrow_drop_down</i></a></li>
							    <li><a href="parent-portal.php" target="_blank"><i class="material-icons left">person_pin</i>PARENTS</a></li>
							    <li><a href="#"><i class="material-icons left">email</i>CONTACT</a></li>
							    <li><a id="searchbtn"><i class="material-icons">search</i></a></li>
						    </ul>
					    </div>				      	
							<ul id="slide-out" class="side-nav">
							    <li class="active"><a href="#">HOME</a></li>
						        <li><a href="#"><i class="material-icons left">info_outline</i>ABOUT US</a></li>
						        <li><a class="dropdown-button" href="#!" data-activates="staffdrpsn"><i class="material-icons left">recent_actors</i>STAFF<i class="material-icons right">arrow_drop_down</i></a></li>
						        <li><a href="#"><i class="material-icons left">person_pin</i>PARENTS</a></li>
						        <li><a href="#"><i class="material-icons left">email</i>CONTACT</a></li>
							</ul>
							<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>				      	
					</div>
				</nav>
				<!-- Dropdown for Staff -->
				<ul id="staffdrp" class="dropdown-content">
					<li><a href="#!">MEMBERS</a></li>
					<li class="divider"></li>
					<li><a href="portal-signin.php" target="_blank">PORTAL</a></li>
				</ul>
				<ul id="staffdrpsn" class="dropdown-content">
					<li><a href="#!">MEMBERS</a></li>
					<li class="divider"></li>
					<li><a href="#!">PORTAL</a></li>
				</ul>								
			</div>
		</header>
		

		<footer class="page-footer blue darken-1">
			<div class="container">
			    <div class="row">
			        <div class="col l6 s12">
			            <h5 class="white-text">CC Smart Kidz Incorporated</h5>
			            <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
			        </div>
			        <div class="col l4 offset-l2 s12">
			            <h5 class="white-text">Helpful Links</h5>
			            <ul>
			                <li><a class="grey-text text-lighten-3" href="portal-signin.php">Faculty Portal</a></li>
			                <li><a class="grey-text text-lighten-3" href="parent-portal.php">Parent Portal</a></li>
			                <li><a class="grey-text text-lighten-3" href="#">Gallery</a></li>
			                <li><a class="grey-text text-lighten-3" href="contact.php">Contact Us</a></li>
			            </ul>
			        </div>
			    </div>
			</div>
			<div class="footer-copyright">
			    <div class="container">
			        CC Smart Kidz Incorporated © 2014 Copyright
			        <a class="grey-text text-lighten-4 right" href="#!">Go to top</a>
			    </div>
			</div>
		</footer>
		<script src="js/jquery.1.12.0.js"></script>
		<script src="js/materialize.min.js"></script>
		<script src="js/script.js"></script>
	</body>
</html>