<?php 
	session_start();
	if( !isset($_SESSION['adminEmployeeId']) ){
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Accounts List CC Smart Kidz School Incorporated - Official Website</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		<header class="admin-accounts">
			<nav>
			    <div class="nav-wrapper nav-wrapper-admin">
			    	<div class="nav-wrap-show">
				    <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
				    <ul class="">
				        <li><a href="" class="admin-page-title">Accounts</a></li>
	      			</ul>
	      			<ul id="slide-out" class="side-nav">
	      				<li class="admin-avatar-sidenav red darken-3">
							<img src="../images/admin-avatar.png" alt="" class="admin-avatar-img" >
							<p class="admin-usr">Employee Id: <b><span id="admin-username"></span></b></p>
	      				</li>
						<li class=""><a href="dashboard.php"><i class="fa fa-tachometer fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
					    <li class=""><a href="profile.php"><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
					    <li class=""><a href="messages.php"><i class="fa fa-comments-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a></li>
					    <li class="active"><a href="accounts.php"><i class="fa fa-users fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Accounts</a></li>
					    <li class=""><a href="post.php"><i class="fa fa-pencil-square-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Post</a></li>
					    <li class=""><a href="gallery.php"><i class="fa fa-picture-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Gallery</a></li>
					    <li class=""><a href="finance.php"><i class="fa fa-money fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Finance Statement</a></li>
					    <a href="../logout.php"><i class="fa fa-sign-out fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
	  				</ul>
	  				<a href="" data-target="accounts-settings" class="modal-trigger"><i class="material-icons right" >more_vert</i></a>
	  				
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
			<div class="container">
				<div class="row">
					<div class="col s12">
						<h3>Accounts List</h3>
						<p class="grey-text">This list contains Id's for users to use in signing-up for Portal account. </p>
						 <ul class="collapsible" data-collapsible="expandable">
						    <li class="">
						      <div class="collapsible-header "><i class="fa fa-users"></i>Faculty<span class="secondary-content counter-faculty-account"></span></div>
						      <div class="collapsible-body accounts-list-body">
									<table class="highlight responsive-table">
								        <thead class="grey-text">
								          <tr>
								          		<th data-field="#">#</th>
								              	<th data-field="id">Employee Id</th>
								              	<th data-field="name">First name</th>
								              	<th data-field="price">Last name</th>
								              	<th data-field="price">Action</th>
								          </tr>
								        </thead>
								        <tbody id="faculty-idlist-table">

								          	<tr class="">
									          		<td class="counter-faculty-idlist">1</td>
									          	<form id="account-list">
										            <td><input type="text" class="add-account-data validate" id="account-data-empid" name="account-data-empid" placeholder="Enter employee id"></td>
										            <td><input type="text" class="add-account-data validate" id="account-data-firstname" name="account-data-firstname" placeholder="Enter first name"></td>
										            <td><input type="text" class="add-account-data validate" id="account-data-lastname" name="account-data-lastname" placeholder="Enter last name"></td>
									            </form>
									            <td>
									            	<a href="" class="tooltipped" id="btn-save-idlist-faculty" data-position="top" data-delay="50" data-tooltip="Add"><i class="fa fa-plus-square fa-lg blue-text"></i></a>
									            	<a href="" class="tooltipped" id="btn-cancel-idlist-faculty" data-position="top" data-delay="50" data-tooltip="Cancel"><i class="fa fa-minus-square fa-lg red-text"></i></a>
									            	<a href="" class="tooltipped" id="btn-excel-idlist-faculty" data-position="top" data-delay="50" data-tooltip="Add via excel"><i class="fa fa-file-excel-o fa-lg green-text"></i></a>
												</td>
								          	</tr>
								        </tbody>
								      </table>
						      </div>
						    </li>
						    <li class="">
						      <div class="collapsible-header "><i class="fa fa-users"></i>Parent<span class="secondary-content counter-parent-account"></span></div>
						      <div class="collapsible-body accounts-list-body">
									<table class="highlight responsive-table">
								        <thead class="grey-text">
								          <tr>
								          		<th data-field="#">#</th>
								              	<th data-field="id">Parent Id</th>
								              	<th data-field="name">First name</th>
								              	<th data-field="price">Last name</th>
								              	<th data-field="price">Action</th>
								          </tr>
								        </thead>
								        <tbody id="parent-idlist-table">

								          	<tr>
								          		<td class="counter-parent-idlist"></td>
								          		<form id ="account-list-parent">
									            <td><input type="text" class="add-account-data-parent" id="account-data-pid" name="account-data-pid" placeholder="Enter parent id"></td>
									            <td><input type="text" class="add-account-data-parent" id="account-data-firstname-parent" name="account-data-firstname-parent" placeholder="Enter first name"></td>
									            <td><input type="text" class="add-account-data-parent" id="account-data-lastname-parent" name="account-data-lastname-parent" placeholder="Enter last name"></td>
									            </form>
									            <td>
									            	<a href="" class="tooltipped" id="btn-save-idlist-parent" data-position="top" data-delay="50" data-tooltip="Add"><i class="fa fa-plus-square fa-lg blue-text"></i></a>
									            	<a href="" class="tooltipped" id="btn-cancel-idlist-parent" data-position="top" data-delay="50" data-tooltip="Cancel"><i class="fa fa-minus-square fa-lg red-text"></i></a>
									            	<a href="" class="tooltipped" id="btn-excel-idlist-parent" data-position="top" data-delay="50" data-tooltip="Add via excel"><i class="fa fa-file-excel-o fa-lg green-text"></i></a>
												</td>
								          	</tr>
								        </tbody>
								    </table>	
						      </div>
						    </li>
						</ul>
					</div>
					<div class="col s12">
						<h3>Registered Users List</h3>
						<p class="grey-text">This list contains the registered users of the Portal.</p>
						 <ul class="collapsible popout" data-collapsible="accordion">
						    <li class="">
						      <div class="collapsible-header"><i class="fa fa-users"></i>Faculty<span class="secondary-content counter-faculty-account-reglist"></span></div>
						      <div class="collapsible-body registered-list-body">
									<table class="responsive-table">
								        <thead class="grey-text">
								          <tr>
								          		<th >#</th>
								              	<th>Employee Id</th>
								              	<th>First Name</th>
								              	<th>Last Name</th>
								              	<th>Email Address</th>
								           		<th>Phone Number</th>
								              	<th>Date/Time registered</th>
								          </tr>
								        </thead>
								        <tbody id="faculty-reglist-table">

								        </tbody>
								    </table>
						      </div>
						    </li>
						    <li class="">
						      <div class="collapsible-header"><i class="fa fa-users"></i>Parent<span class="secondary-content counter-parent-account-reglist"></span></div>
						      <div class="collapsible-body registered-list-body">
									<table class="responsive-table">
								        <thead class="grey-text">
								          <tr>
								          		<th >#</th>
								              	<th>Parent Id</th>
								              	<th>First Name</th>
								              	<th>Last Name</th>
								              	<th>Email Address</th>
								           		<th>Phone Number</th>
								              	<th>Date/Time registered</th>
								          </tr>
								        </thead>
								        <tbody id="parent-reglist-table">

								        </tbody>
								    </table>
						      </div>
						    </li>
						</ul>
					</div>
				</div>
			</div>


			<!-- Modal Structure Message Settings -->
			  <div id="accounts-settings" class="modal bottom-sheet">
			    	<div class="modal-content">
			      			<h4>Accounts Settings</h4>
			      		 	<div class="divider"></div>
			      			<ul class="blue-text">
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
		  <div id="idlist-faculty-excel" class="modal">
		    <div class="modal-content">
		      <h4>Add Id list for Faculty</h4>
		      <div class="divider"></div>
		      	<div class="">
					<form id="idlist-faculty-excel-form">
					    <div class="file-field input-field">
					      <div class="btn">
					        <span>File</span>
					        <input type="file" name = "id_list_faculty" accept=".csv">
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text" placeholder="Upload one or more files" id="excel-name-faculty-idlist">
					        <span class="success-msg success-idlist-faculty green-text"></span>
					      </div>
					    </div>
					
					<br />
					<p>Read <a href="account-instruction.php" target="_blank">instruction</a> on how to upload list via excel csv.</p>
		      	</div>
		    </div>
		    <div class="modal-footer">
		      <a href="" class=" modal-action modal-close waves-effect waves-red btn-flat" id="modal-close-idlist-faculty">Close</a>
		      <button class=" modal-action waves-effect waves-green btn-flat" id="btn-upload-faculty-excel" type="submit">Upload</button>
		      		</form>
		    </div>
		  </div>
		  <!-- Modal Structure -->
		  <div id="idlist-parent-excel" class="modal">
		    <div class="modal-content">
		      <h4>Add Id list for Parent</h4>
		      <div class="divider"></div>
		      	<div class="">
					<form id="idlist-parent-excel-form">
					    <div class="file-field input-field">
					      <div class="btn">
					        <span>File</span>
					        <input type="file" name = "id_list_parent" accept=".csv">
					      </div>
					      <div class="file-path-wrapper">
					        <input class="file-path validate" type="text" placeholder="Upload one or more files" id="excel-name-parent-idlist">
					        <span class="success-msg success-idlist-parent green-text"></span>
					      </div>
					    </div>
					
					<br />
					<p>Read <a href="account-instruction.php" target="_blank">instruction</a> on how to upload list via excel csv.</p>
		      	</div>
		    </div>
		    <div class="modal-footer">
		      <a href="" class=" modal-action modal-close waves-effect waves-red btn-flat" id="modal-close-idlist-parent">Close</a>
		      <button class=" modal-action waves-effect waves-green btn-flat" id="btn-upload-parent-excel" type="submit">Upload</button>
		      		</form>
		    </div>
		  </div>
		  <div id="idlistdel" class="modal">
		    <div class="modal-content center-align">
		      	<p class="red-text" id="question"><i class="fa fa-warning fa-lg"></i>&nbsp;&nbsp;&nbsp;Are you sure you want to delete this?
		      	<br />
		      	<br />
		      	<a href="" class="btn btn-flat" id="btn-delete-yes">Yes</a>
		      	<a href="" class="btn btn-flat modal-action modal-close" id="btn-delete-cancel">No</a>
		      	</p>
		      	<span class="hidden-input green-text" id="success-delete"><i class="fa fa-check-circle fa-lg"></i>&nbsp;&nbsp;&nbsp;Account successfully deleted.</span>
		    </div>
		    <div class="modal-footer hidden-input" id="success-delete-footer">
		      <a href="" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
		    </div>
		  </div>
		  <div id="idlistsave" class="modal">
		    <div class="modal-content">
		      	<p class="green-text"><i class="fa fa-check-circle fa-lg"></i>&nbsp;&nbsp;&nbsp;Account details has been successfully saved.</p>
		    </div>
		    <div class="modal-footer">
		      <a href="" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
		    </div>
		  </div>
			 <!-- Modal Structure -->
			  <div id="update_faculty_list" class="modal">
			    <div class="modal-content">
			      <h5>Update Account List</h5>
			      <div class="divider"></div>
					<form id="update_faculty_list_form">
				        <div class="input-field col s12">
				          <input id="faculty_update_empid_list" name="faculty_update_empid_list" type="text" placeholder= "Employee Id" class="validate">
				        </div>
				        <div class="input-field col s12">
				          <input id="faculty_update_firstnm_list" name="faculty_update_firstnm_list" type="text" placeholder= "First name" class="validate">
				        </div>
				        <div class="input-field col s12">
				          <input id="faculty_update_lastnm_list" name="faculty_update_lastnm_list" type="text" placeholder= "Last name" class="validate">
				        </div>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat" onclick="location.reload();">Close</a>
			      <button href="#!" class=" modal-action waves-effect waves-green btn-flat left" id="update-btn-account-list-faculty">Update</button>
			      </form>
			    </div>
			  </div>
			  <!-- Modal Structure -->
			  <div id="update-success-faculty-account" class="modal">
			    <div class="modal-content center-align">
			      <p class="green-text"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;Updated successfully!</p>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a>
			    </div>
			  </div>

			  <!-- Modal Structure -->
			  <div id="update_parent_list" class="modal">
			    <div class="modal-content">
			      <h5>Update Account List</h5>
			      <div class="divider"></div>
					<form id="update_parent_list_form">
				        <div class="input-field col s12">
				          <input id="parent_update_empid_list" name="parent_update_empid_list" type="text" placeholder= "Parent Id" class="validate">
				        </div>
				        <div class="input-field col s12">
				          <input id="parent_update_firstnm_list" name="parent_update_firstnm_list" type="text" placeholder= "First name" class="validate">
				        </div>
				        <div class="input-field col s12">
				          <input id="parent_update_lastnm_list" name="parent_update_lastnm_list" type="text" placeholder= "Last name" class="validate">
				        </div>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat" onclick="location.reload();">Close</a>
			      <button href="#!" class=" modal-action waves-effect waves-green btn-flat left" id="update-btn-account-list-parent">Update</button>
			      </form>
			    </div>
			  </div>
			  <!-- Modal Structure -->
			  <div id="update-success-parent-account" class="modal">
			    <div class="modal-content center-align">
			      <p class="green-text"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;Updated successfully!</p>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a>
			    </div>
			  </div>
			  <!-- Modal Structure -->
			  <div id="update-failed" class="modal">
			    <div class="modal-content center-align">
			      <p class="red-text"><i class="fa fa-excalamation" aria-hidden="true"></i>&nbsp;&nbsp;Can't update, account is already used!</p>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a>
			    </div>
			  </div>


		<div id="send-to-email" class="modal">
		    <div class="modal-content">
		      <p class="grey-text">This account information will be sent via email address of the Parent.</p>
		      <form id='formsenemal'>
		      		<input placeholder='Enter Parents Email Address' id="emailparent" name="emailparent" type="email" class="validate">
		      		<label for="emailparent" data-error="Please enter a valid email address"></label>
		      <p></p>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
		      <button href="#!" class=" left modal-action waves-effect waves-green btn-flat btn-sendformemail" type="submit">Send</button>
		      </form>
		    </div>
	  	</div>

		<div id="successemail" class="modal">
		    <div class="modal-content">
		      <p class="green-text"><i class="fa fa-check-circle" aria-hidden="true"></i>Email sent!</p>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
		    </div>
	  	</div>
	  	
	  	<div id="failemail" class="modal">
		    <div class="modal-content">
		      <p class="red-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Email failed to send!</p>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
		    </div>
	  	</div>
		
		<div class="fixed-action-btn horizontal" style="bottom: 45px; right: 24px;">
		    <a href='../templates/Account-template.csv'  target="_blank" class="btn-floating btn-large blue tooltipped" data-position="top" data-delay="50" data-tooltip="Download Account Excel Template">
		      <i class="fa fa-download" aria-hidden="true"></i>
		    </a>
	  	</div>
		<script src="../js/jquery.1.12.0.js"></script>
		<script src="../js/materialize.min.js"></script>
		<script src="../js/script.js"></script>
	</body>
</html>