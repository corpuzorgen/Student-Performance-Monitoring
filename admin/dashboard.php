<?php 
	session_start();
	if( !isset($_SESSION['adminEmployeeId']) ){
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Admin Dashboard CC Smart Kidz School Incorporated - Official Website</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		
		<header class="admin-dashboard">
			<nav>
			    <div class="nav-wrapper nav-wrapper-admin">
			    	<div class="nav-wrap-show">
				    <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
				    <ul class="">
				        <li><a href="" class="admin-page-title">Dashboard</a></li>
	      			</ul>
	      			<ul id="slide-out" class="side-nav">
	      				<li class="admin-avatar-sidenav red darken-3">
							<img src="../images/admin-avatar.png" alt="" class="admin-avatar-img" >
							<p class="admin-usr">Employee Id: <b><span id="admin-empid-nav"></span></b></p>
	      				</li>
						<li class="active"><a href="dashboard.php"><i class="fa fa-tachometer fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
					    <li class=""><a href="profile.php"><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
					    <li class=""><a href="messages.php"><i class="fa fa-comments-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a></li>
					    <li class=""><a href="accounts.php"><i class="fa fa-users fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Accounts</a></li>
					    <li class=""><a href="post.php"><i class="fa fa-pencil-square-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Post</a></li>
					    <li class=""><a href="gallery.php"><i class="fa fa-picture-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Gallery</a></li>
					    <li class=""><a href="finance.php"><i class="fa fa-money fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Finance Statement</a></li>
					    <a href="../logout.php"><i class="fa fa-sign-out fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
					   
	  				</ul>
	  				<a href="" data-target="dashboard-settings" class="modal-trigger"><i class="material-icons right" >more_vert</i></a>
	  			
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
			<div class="container"style="margin-top:2%;">
				<div class="row">
					<div class="col s12 m6 profilesummary">
						<div class="card grey darken-1">
				            <div class="card-content white-text">
				              <span class="card-title"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Profile</span>
				              <div class="divider dashboard-divider"></div>
				              <div class="card-content">
					             <p><i class="fa fa-tag" aria-hidden="true"></i>&nbsp;&nbsp;<span id="profsumname"></span></p>
					             <p><i class="fa fa-hashtag" aria-hidden="true"></i>&nbsp;&nbsp;<span id="profsumempid"></span></p>
					             <p><i class="fa fa-sitemap" aria-hidden="true"></i>&nbsp;&nbsp;<span id="profsumposition"></span></p>
					          </div>
				            </div>
				        </div>
					</div>
					<div class="col s12 m6 postsummary">
						<div class="card brown darken-1">
				            <div class="card-content white-text">
				              <span class="card-title"><i class="fa fa-newspaper-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Post</span>
				              <div class="divider dashboard-divider"></div>
				             <div class="card-content">
					              <p class="summaryposttitle">News</p>
					              <div class="divider dashboard-divider"></div>
					              <span class="right" id="newssumdash"></span>
					              <br />
					              <p class="summaryposttitle">Events</p>
					              <div class="divider dashboard-divider"></div>
					              <span class="right" id="eventssumdash"></span>
					          </div>
				            </div>
				        </div>
					</div>

					<div class="col s12 m12 accountssummary">
						<div class="card blue-grey darken-1">
				            <div class="card-content white-text">
				              <span class="card-title"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Accounts</span>
				              <div class="divider dashboard-divider"></div>
				              <div class="card-content">
					              <p class="summaryaccounttitle">Account list</p>
					              <div class="divider dashboard-divider"></div>
					              <p>Faculty: <span class="right" id="accountsumfaculty"></span></p>
					              <p>Parent: <span class="right" id="accountsumparent"></span></p>
					              <br />
					              <p class="summaryaccounttitle">Registered list</p>
					              <div class="divider dashboard-divider"></div>
					              <p>Faculty: <span class="right" id="regsumfaculty"></span></p>
					              <p>Parent: <span class="right" id="regsumparent"></span></p>
					          </div>
				            </div>
				        </div>
					</div>

				</div>	
			</div>		    
		</main>
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
		<script src="../js/jquery.1.12.0.js"></script>
		<script src="../js/materialize.min.js"></script>
		<script src="../js/script.js"></script>
	</body>
</html>