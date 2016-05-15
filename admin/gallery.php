<?php 
	session_start();
	if( !isset($_SESSION['adminEmployeeId']) ){
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Admin Gallery Management CC Smart Kidz School Incorporated - Official Website</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		
		<header class="admin-gallery">
			<nav>
			    <div class="nav-wrapper nav-wrapper-admin">
			    	<div class="nav-wrap-show">
				    <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
				    <ul class="">
				        <li><a href="" class="admin-page-title">Gallery</a></li>
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
					    <li class=""><a href="post.php"><i class="fa fa-pencil-square-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Post</a></li>
					    <li class="active"><a href="gallery.php"><i class="fa fa-picture-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Gallery</a></li>
					    <li class=""><a href="finance.php"><i class="fa fa-money fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Finance Statement</a></li>
					    <li class=""><a href="#!"><i class="fa fa-cog fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Settings</a></li>
					    <a href="../logout.php"><i class="fa fa-sign-out fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
	  				</ul>
	  				<a href="" data-target="gallery-settings" class="modal-trigger"><i class="material-icons right" >more_vert</i></a>
	  				
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
			<div class="container"style="margin-top: 2%;">
				<div class="row">
					<div class="col s12">
						<h4>Featured Images</h4>
							<div class="card featured-image-gallery" id="slide-one">
					            <div class="card-image">
					              <img src="../images/featured-image.png" class="materialboxed responsive-img" data-caption="Slide one" id="feature-slideone" style="height: 300px;">
					            </div>
					            <div class="card-content">
					              <p>Slide one</p>
					            </div>
					            <div class="card-action">
					              <a href="#" class="blue-text change-feature-image-one">Change Image</a>
					              <a href="#" class="red-text right delete-feature-image">Delete</a>
					            </div>
					        </div>						
							<div class="card featured-image-gallery" id="slide-two">
					            <div class="card-image">
					              <img src="../images/featured-image.png" class="materialboxed responsive-img" data-caption="Slide two" id="feature-slidetwo" style="height: 300px;">
					            </div>
					            <div class="card-content">
					              <p>Slide two</p>
					            </div>
					            <div class="card-action">
					              <a href="#" class="blue-text change-feature-image-two">Change Image</a>
					              <a href="#" class="red-text right delete-feature-image">Delete</a>
					            </div>
					        </div>
					        <div class="card featured-image-gallery" id="slide-three">
					            <div class="card-image">
					              <img src="../images/featured-image.png" class="materialboxed responsive-img" data-caption="Slide three" id="feature-slidethree" style="height: 300px;">
					            </div>
					            <div class="card-content">
					              <p>Slide 3</p>
					            </div>
					            <div class="card-action">
					              <a href="#" class="blue-text change-feature-image-three">Change Image</a>
					              <a href="#" class="red-text right delete-feature-image">Delete</a>
					            </div>
					        </div>
							
					</div>

				</div>
	
		    </div>
		    <!-- Modal Structure -->
			  <div id="change-feature-modal-slideone" class="modal">
			    	<div class="modal-content">
			      		<h4 class="change-feature-title">Slide One</h4>
			      		<div class="divider"></div>
						<form id="upload-featured-image-one">
						    <div class="file-field input-field">
						      <div class="btn">
						        <span>File</span>
						        <input type="file" name="featuredimageone1" accept="image/*" class="featuredimageone">
						      </div>
						      <div class="file-path-wrapper">
						        <input class="file-path validate" type="text" placeholder="Upload image for slide one">
						      </div>
						    </div>
			    	</div>
			    	<div class="modal-footer">
			      		<a href="#!" class="modal-action modal-close waves-effect waves-red
			      		 btn-flat black-text" id="featuredimageoneclose" onclick="location.reload();">Close</a>
			      		 <button class="modal-action waves-effect waves-blue
			      		 btn left upload-feature" type="submit">Upload</button>
			      		 </form>
			      		<span class="msg1"></span>
			    	</div>
			  </div>
			  <!-- Modal Structure -->
			  <div id="change-feature-modal-slidetwo" class="modal">
			    	<div class="modal-content">
			      		<h4 class="change-feature-title">Slide Two</h4>
			      		<div class="divider"></div>
						<form id="upload-featured-image-two">
						    <div class="file-field input-field">
						      <div class="btn">
						        <span>File</span>
						        <input type="file" name="featuredimagetwo2" accept="image/*" class="featuredimagetwo">
						      </div>
						      <div class="file-path-wrapper">
						        <input class="file-path validate" type="text" placeholder="Upload image for slide two">
						      </div>
						    </div>
			    	</div>
			    	<div class="modal-footer">
			      		<a href="#!" class="modal-action modal-close waves-effect waves-red
			      		 btn-flat black-text" id="featuredimagetwoclose" onclick="location.reload();">Close</a>
			      		 <button class="modal-action waves-effect waves-blue
			      		 btn left upload-feature" type="submit">Upload</button>
			      		 </form>
			      		 <span class="msg2"></span>
			    	</div>
			  </div>
			  <!-- Modal Structure -->
			  <div id="change-feature-modal-slidethree" class="modal">
			    	<div class="modal-content">
			      		<h4 class="change-feature-title">Slide Three</h4>
			      		<div class="divider"></div>
						<form id="upload-featured-image-three">
						    <div class="file-field input-field">
						      <div class="btn">
						        <span>File</span>
						        <input type="file" name="featuredimagethree3" accept="image/*" class="featuredimagethree">
						      </div>
						      <div class="file-path-wrapper">
						        <input class="file-path validate" type="text" placeholder="Upload image for slide three">
						      </div>
						    </div>
			    	</div>
			    	<div class="modal-footer">
			      		<a href="#!" class="modal-action modal-close waves-effect waves-red
			      		 btn-flat black-text" id="featuredimagethreeclose" onclick="location.reload();">Close</a>
			      		 <button class="modal-action waves-effect waves-blue
			      		 btn left upload-feature" type="submit">Upload</button>
			      		 </form>
			      		 <span class="msg3"></span>
			    	</div>
			  </div>
			<!-- Modal Structure -->
			  <div id="delmodal" class="modal bottom-sheet">
			    	<div class="modal-content">
						<div class="center-align">
							<h4>Are you sure you want to delete this image?</h4>
							<p class="successdel green-text hidden-input"><i class="fa fa-check-circle fa-lg" aria-hidden="true"></i>&nbsp;&nbsp;Image successfully deleted!</p>
							<div class="delbutton">
								<a class="waves-effect waves-teal btn-flat green white-text yesdel">Yes</a>
								<a class="waves-effect waves-teal btn-flat red white-text nodel">No</a>
							</div>
						</div>
			    	</div>
			    	<div class="modal-footer">
			      		<a href="#!" class="modal-action modal-close waves-effect waves-red
			      		 btn-flat black-text" onclick="location.reload();">Close</a>
			    	</div>
			  </div>
			  <!-- Modal Structure -->
			  <div id="gallery-settings" class="modal bottom-sheet">
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
		</main>
		<footer></footer>
		
		<script src="../js/jquery.1.12.0.js"></script>
		<script src="../js/materialize.min.js"></script>
		<script src="../js/script.js"></script>
	</body>
</html>