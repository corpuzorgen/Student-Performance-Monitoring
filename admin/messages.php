<?php 
	session_start();
	if( !isset($_SESSION['adminEmployeeId']) ){
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Messages CC Smart Kidz School Incorporated - Official Website</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body class="msg-body-admin">
		<header class="admin-messages" >
			<nav id = 'msg-admin-nav'>
			    <div class="nav-wrapper nav-wrapper-admin">
			    	<div class="nav-wrap-show">
				    <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
				    <ul class="">
				        <li><a href="" class="admin-page-title">Messages</a></li>
	      			</ul>
	      			<ul id="slide-out" class="side-nav">
	      				<li class="admin-avatar-sidenav red darken-3">
							<img src="../images/admin-avatar.png" alt="" class="admin-avatar-img" >
							<p class="admin-usr">Employee Id: <b><span id="admin-empid-nav"></span></b></p>
	      				</li>
						<li class=""><a href="dashboard.php"><i class="fa fa-tachometer fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
					    <li class=""><a href="profile.php"><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
					    <li class="active"><a href="messages.php"><i class="fa fa-comments-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a></li>
					    <li class=""><a href="accounts.php"><i class="fa fa-users fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Accounts</a></li>
					    <li class=""><a href="post.php"><i class="fa fa-pencil-square-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Post</a></li>
					    <li class=""><a href="gallery.php"><i class="fa fa-picture-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Gallery</a></li>
					    <li class=""><a href="finance.php"><i class="fa fa-money fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Finance Statement</a></li>
					    <a href="../logout.php"><i class="fa fa-sign-out fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
	  				</ul>
	  				<a href="" data-target="message-settings" class="modal-trigger"><i class="material-icons right" >more_vert</i></a>
	  			
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
		<main class="msg-main">
			<div class="row msg-wrap">
				<div class="col s12 m5 inbox-admin">
					<h4 class=" admin-msg-convo">Conversation</h4>
					<div class="divider"></div>
				  	<div class="section">
				  		
				  		<div class="no-mgs-yet center-align grey-text">
							<i class="fa fa-inbox fa-4x"></i>
							<h4 class="center-align">No message yet</h4>
						</div>
						
						<ul class="collection ul-msg-admin">
							<!--
						    <li class="collection-item avatar li-msg-admin">
							    <img src="images/yuna.jpg" alt="" class="circle">
								<span class="title inbox-receiver">Judel Dispo</span>
								<p class="truncate msg-content">asdasdasdsad</p>
								<p class="secondary-content "> few seconds ago</p>
						    </li>
						    <li class="collection-item avatar li-msg-admin">
							    <img src="images/yuna.jpg" alt="" class="circle">
								<span class="title inbox-receiver">Renzy Guinto</span>								
								<p class="truncate msg-content">First Linee</p>
								<p class="secondary-content "> 1 hour ago</p>
						    </li>
						    -->
						</ul>

				  	</div>										
				</div>
				<div class="col s12 m7 blue-grey lighten-5 inbox-content-admin">
					<h3 class="center-align grey-text no-msg">No message selected</h3>
					<div class="row">
				      <div class="col s12 m12">
				        <div class="card-panel white full-msg-admin-panel hidden-input">
				          <span class="black-text">
				          		<div class="valign-wrapper header-msg teal-text">
				          			<img src="../images/male-user.png" alt="" height="35px" width="35px">&nbsp;&nbsp;	
				          			<h5 class="reciever-name" style="display: inline;margin-right: 73%;"></h5>
				          			<p class="right-align"><a href="" class='delmsgadmin  red-text'><i class="fa fa-trash-o fa-lg" aria-hidden="true"></i></a></p>
				          		</div>
								<div class="divider"></div>
								<div class="card-content content-msg">
					              <ul class="collection ul-msg-convo">
					              	
					              </ul>
					            </div>
				          </span>
							<div class="card-action footer-msg">
								<div class="row reply-msg-wrapper">
							        <div class="input-field col s12 type-msg-admin">
							          <input type="text" placeholder="Type your reply here..." length="120" class="validate admin-reply-msg">
							        </div>
							        <a class="waves-effect waves-teal btn-flat reply-admin" style="">Reply</a>
							        <a class="waves-effect waves-red btn-flat" style="float: right;">Cancel</a>
						      	</div>
				            </div>
				        </div>
				      </div>
				    </div>
				</div>
			</div>
			<div class="fixed-action-btn horizontal click-to-toggle" style="bottom: 45px; right: 24px;">
			    <a href="#create-msg-admin" class="btn-floating btn-large red tooltipped modal-trigger" data-position="top" data-delay="50" data-tooltip="New message">
			      <i class="large material-icons">mode_edit</i>
			    </a>
  			</div>						

			<!-- Modal Structure Create Message -->
			<div id="create-msg-admin" class="modal modal-fixed-footer">
			    <div class="modal-content">
			    <h4 class="newmsgtext">New Message</h4>
			    <div class="divider"></div>
			      <form id="message-room">
				      	<div class="row">
					      	<div class="input-field col s12">
					      		<i class="fa fa-at fa-1x prefix"></i>
								<input id="recipient" type="text" class="validate">
								<ul id="results" class="grey-text select-dropdown invisible"></ul>
	          					<label for="recipient" class="messagelabel">Recipient's Name</label>
							</div>
							<div class="input-field col s12">
								<i class="fa fa-ticket fa-1x prefix"></i>
								<input id="subject" type="text" class="subject-input" value="">
	          					<label for="subject" class="messagelabel">Subject (optional)</label>
							</div>
							<div class="input-field col s12">
					          <i class="fa fa-commenting fa-1x prefix"></i>
					          <textarea id="message_content" class="materialize-textarea validate" length="200"></textarea>
					          <label for="message_content" class="messagelabel">Message...</label>
					        </div>						
				        </div>
			      </form>
			    </div>
			    <div class="modal-footer">
			    	<span class="sendingmsg hide">Sending message...</span>
			      <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat modal-close-msg-admin">Close</a>
					<button class="btn left waves-effect waves-light" type="submit" name="action" id="sendmsg-admin">Send
				    	<i class="material-icons right">send</i>
				  	</button>
			    </div>
			</div>

			<!-- Modal Structure Message Settings -->
			  <div id="message-settings" class="modal bottom-sheet">
			    	<div class="modal-content">
			      			<h4>Messages Settings</h4>
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
		<div id="deladminmsg" class="modal">
		    <div class="modal-content center-align">
		      <p>Are you sure you want to delete this?</p>
		      <a class="waves-effect waves-green btn-flat" id='delyesmsgadmin'>Yes</a>&nbsp;
		      <a class="waves-effect modal-close waves-red btn-flat">No</a>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
		    </div>
		</div>

		<script src="../js/jquery.1.12.0.js"></script>
		<script src="../js/materialize.min.js"></script>
		<script src="../js/script.js"></script>

	</body>
</html>