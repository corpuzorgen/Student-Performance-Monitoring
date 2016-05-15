<!DOCTYPE html>
<html lang='en'>
	<head>		
		<title> CC Smart Kidz - OFFICIAL WEBSITE</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>
		
		<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">

	</head>
	<body class="homecontainer index">
			<header>
				<div class="navbar" id="hpnavheader">
					<nav id = "navbar-home">
					    <div class="nav-wrapper blue darken-1 nav-wrapper-index-hp">
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
							        <li class="active"><a href="index.php">HOME</a></li>
							        <li><a href="portal-signin.php" target="_blank"><i class="material-icons left">recent_actors</i>STAFF</a></li>
							        <li><a href="parent-portal.php" target="_blank"><i class="material-icons left">person_pin</i>PARENTS</a></li>
							        <li><a href="contact.php"><i class="material-icons left">location_on</i>CONTACT</a></li>
						      	</ul>
					      	</div>				      	
							<ul id="slide-out" class="side-nav">
							    <li class="active"><a href="#">HOME</a></li>
							    <li><a href="portal-signin.php" target="_blank"><i class="material-icons left">recent_actors</i>STAFF</a></li>
							    <li><a href="parent-portal.php" target="_blank"><i class="material-icons left">person_pin</i>PARENTS</a></li>
							    <li><a href="contact.php"><i class="material-icons left">location_on</i>CONTACT</a></li>
							</ul>
							<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>				      	
					    </div>
					</nav>
				</div>
			</header>
			<main class="homeContent index">
				<div class="slider">
				    <ul class="slides">
				      <li>
				        <img src="images/featured-image.png" id="slideone" class="feature-images">
				      </li>
				      <li>
				        <img src="images/featured-image.png" id="slidetwo" class="feature-images"> <!-- random image -->
				      </li>
				      <li>
				        <img src="images/featured-image.png" id="slidethree" class="feature-images"> <!-- random image -->
				      </li>
				    </ul>
				</div>

				<div class="row main-content">
					<div class="col s12 news">
						<h4 class="center-align"> <b>News and Announcements</b> </h4>
						 	<div class="row row-latest-news" style="margin-top: 5%;">
						    </div>
					</div>
				</div>
			</main>
			
			<footer class="page-footer blue darken-1">
			    <div class="container">
			        <div class="row">
			            <div class="col l6 s12">
			            	<div class="col s6">
			            		<img src="images/logo.png" alt="">
			            	</div>
			            	<div class="col s6">
			            		<h5 class="white-text">CC Smart Kidz Incorporated</h5>
			                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
			            	</div>
			                
			            </div>
			            <div class="col l4 offset-l2 s12">
			                <h5 class="white-text">Helpful Links</h5>
			                <ul>
			                  <li><a class="grey-text text-lighten-3" href="portal-signin.php">Faculty Portal</a></li>
			                  <li><a class="grey-text text-lighten-3" href="parent-portal.php">Parent Portal</a></li>
			                  <li><a class="grey-text text-lighten-3" href="contact.php">Contact Us</a></li>
			                </ul>
			            </div>
			        </div>
			    </div>
			    <div class="footer-copyright">
			        <div class="container">
			            CC Smart Kidz Incorporated © 2016 Copyright
			          	<a class="grey-text text-lighten-4 right gototop" href="#">Go to top</a>
			        </div>
			    </div>
			</footer>			
		<script src="js/jquery.1.12.0.js"></script>
		<script src="js/materialize.min.js"></script>
		<script src="js/script.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				
				$.ajax({
					type: "GET",
					url: "index_function.php",
					success: function(data){
						obj = JSON.parse(data);
						if(obj.gallery.slideone){
							sub = obj.gallery.slideone;
							subset = sub.substring(3);
							$("#slideone").attr("src", subset);
						}
						if(obj.gallery.slidetwo){
							sub = obj.gallery.slidetwo;
							subset = sub.substring(3);
							$("#slidetwo").attr("src", subset);
						}
						if(obj.gallery.slidethree){
							sub = obj.gallery.slidethree;
							subset = sub.substring(3);
							$("#slidethree").attr("src", subset);
						}
					}
				});	

				$.ajax({
					type: "GET",
					url: "index_function.php",
					success: function(data){
						obj = JSON.parse(data);
						$(".row-latest-news").prepend(obj.latest_news);
						var target = window.location.hash;
							$('html, body').animate({
							    scrollTop: $(target).offset().top
							}, 1000);
					}
				});	
			});
		</script>
	</body>
	</html>