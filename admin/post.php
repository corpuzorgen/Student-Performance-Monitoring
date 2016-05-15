<?php 
	session_start();
	if( !isset($_SESSION['adminEmployeeId']) ){
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Post List CC Smart Kidz School Incorporated - Official Website</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		<header class="admin-post">
			<nav>
			    <div class="nav-wrapper nav-wrapper-admin">
			    	<div class="nav-wrap-show">
				    <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
				    <ul class="">
				        <li><a href="" class="admin-page-title">Post</a></li>
	      			</ul>
	      			<ul id="slide-out" class="side-nav">
	      				<li class="admin-avatar-sidenav red darken-3">
							<img src="../images/admin-avatar.png" alt="" class="admin-avatar-img" >
							<p class="admin-usr">Employee Id: <b><span id="admin-empid-nav"></span></b></p>
	      				</li>
						<li class=""><a href="dashboard.php"><i class="fa fa-tachometer fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
					    <li class=""><a href="profile.php"><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
					    <li class=""><a href="messages.php"><i class="fa fa-comments-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a></li>
					    <li class=""><a href="accounts.php"><i class="fa fa-users fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Accounts</a></li>
					    <li class="active"><a href="post.php"><i class="fa fa-pencil-square-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Post</a></li>
					    <li class=""><a href="gallery.php"><i class="fa fa-picture-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Gallery</a></li>
					    <li class=""><a href="finance.php"><i class="fa fa-money fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Finance Statement</a></li>
					    <a href="../logout.php"><i class="fa fa-sign-out fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
	  				</ul>
	  				<a href="" data-target="post-settings" class="modal-trigger"><i class="material-icons right" >more_vert</i></a>
	  				
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

		<main class="container">
			<h3 class="">Articles</h3>
			<div class="post-main-admin ">
				<div class="article-wrap">
				<div class="row">
					<div class="col s12 m12 post-news">
						<div class="valign-wrapper article-title grey-text">
							<i class="fa fa-newspaper-o fa-2x"></i>&nbsp;&nbsp;&nbsp;<h4 class="">News</h4>
							<span class="secondary-content counter-article-news"></span>
						</div>
						<div class="divider"></div>
						<div class="section" id="newssection">
					  		<ul id="newsuladmin" class="collapsible popout" data-collapsible="accordion">
					  		</ul>
						</div>
					</div>
					<div class="col s12 m12 post-events">
						<div class="valign-wrapper article-title grey-text">
							<i class="fa fa-file-text-o fa-2x"></i>&nbsp;&nbsp;&nbsp;<h4 class="grey-text">Events</h4>
							<span class="secondary-content counter-article-events"></span>
						</div>
						<div class="divider"></div>
					  	<div class="section" id="eventssection">
							<ul id="eventsuladmin" class="collapsible popout" data-collapsible="accordion">
					  			
					  		</ul>
				  		</div>	
					</div>					

				</div>
				</div>
			</div>

			<!-- Compose Button -->
		 	<div class="fixed-action-btn horizontal click-to-toggle">
			    <a class="btn-floating btn-large red" id="newpost">
			       <i class="large material-icons">mode_edit</i>
			    </a>
		  	</div>			
			<!-- Modal Structure -->
			  <div id="post-settings" class="modal bottom-sheet">
			    	<div class="modal-content">
			      			<h4>Post Settings</h4>
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
		<!-- Modal Structure -->
		  <div id="postadmin" class="modal modal-fixed-footer">
		    <div class="modal-content ">
		      <h4>New Post</h4>
		        <div class="divider"></div>
		      <div class="row">
		      <div class="col s12">
		      	<select class="browser-default" id="catergorypost">
				    <option value="null" disabled selected>Choose category</option>
				    <option value="news">News/Announcements</option>
				    <option value="events">Upcoming Events</option>
			  	</select>
		      </div>
		      <div class="col s12">
				<div class="input-field col s12 m8 l8">
		          <input placeholder="Title" id="titlepost" type="text" class="validate" length="50">
		        </div>
		      </div>
		      <div class="col s12">
				<form class="">
			        <div class="input-field col s12">
			          <textarea id="postcontent" class="materialize-textarea validate" placeholder="Write content here.."></textarea>
			        </div>
			    </form>
		      </div>
		      	<p class="error-content error-content-category red-text"></p>
				<p class="error-content error-content-title red-text"></p>
				<p class="error-content error-content-content red-text"></p>
				<p class="success-content green-text"></p>
		      </div>
		    </div>
		    <div class="modal-footer fixed">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat post-cancel" onclick="location.reload();">Close</a>
		      <a href="#!" class=" modal-action waves-effect waves-green btn-flat post-send left">Post</a>
		    </div>
		  </div>
			<!-- Modal Structure -->
			  <div id="updatearticlespost" class="modal modal-fixed-footer">
			    <div class="modal-content">
			      <h4>Update News Article</h4>
			      <div class="divider"></div>
				<div class="row">
			      <div class="col s12">
			      	<select class="browser-default" id="catergorypostupdate">
					    <option value="null" disabled selected>Choose category</option>
					    <option value="news">News/Announcements</option>
					    <option value="events">Upcoming Events</option>
				  	</select>
			      </div>
			      <div class="col s12">
					<div class="input-field col s12 m8 l8">
			          <input placeholder="Title" id="titlepostupdate" type="text" class="validate" length="50">
			        </div>
			      </div>
			      <div class="col s12">
					<form class="">
				        <div class="input-field col s12">
				          <textarea id="postcontentupdate" class="materialize-textarea validate" placeholder="Write content here.."></textarea>
				        </div>
				    </form>
			      </div>
					<p class="error-content error-content-title_update red-text"></p>
					<p class="error-content error-content-content_update red-text"></p>
					<p class="success-content_update green-text"></p>
			      </div>
			    </div>
			    <div class="modal-footer">
			     	<a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat post-cancel" onclick="location.reload();">Close</a>
		      		<a href="#!" class=" modal-action waves-effect waves-green btn-flat post-update left">Update</a>
			    </div>
			  </div>
			  <!-- Modal Structure -->
			  <div id="postdelete" class="modal">
			    <div class="modal-content center-align">
			    		<div class="questiondelwrapper">
							<p>Are you sure you want to delete this article? <b><span class="deletetitlearticle"></span></b></p>
						  	<a class="waves-effect waves-green btn-flat deletearticleyes">Yes</a>
						    <a class="waves-effect waves-red btn-flat modal-close">No</a>
					    </div>
					    <p class="articledeletesuccess hidden-input green-text"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;Article successfully deleted!</p>
				<div class="modal-footer">
			      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat" onclick="location.reload();">Close</a>
			    </div>
			    </div>
			  </div>
		
		<script src="../js/jquery.1.12.0.js"></script>
		<script src="../js/materialize.min.js"></script>
		<script src="../js/script.js"></script>
	</body>

	  </script>
</html>