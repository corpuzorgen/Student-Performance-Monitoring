<?php 
	session_start();
	if( !isset($_SESSION['adminEmployeeId']) ){
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Admin Finance Statement CC Smart Kidz School Incorporated - Official Website</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		
		<header class="admin-finance">
			<nav>
			    <div class="nav-wrapper nav-wrapper-admin">
			    	<div class="nav-wrap-show">
				    <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
				    <ul class="">
				        <li><a href="" class="admin-page-title">Financial Statement</a></li>
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
					    <li class=""><a href="gallery.php"><i class="fa fa-picture-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Gallery</a></li>
					    <li class="active"><a href="finance.php"><i class="fa fa-money fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Finance Statement</a></li>
					    <a href="../logout.php"><i class="fa fa-sign-out fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
	  				</ul>
	  				<a href="" data-target="finance-settings" class="modal-trigger"><i class="material-icons right" >more_vert</i></a>
	  			
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
			<div class="container"style="margin-top: 5%;">
				
			<table class="bordered highlight" style="max-width: 100% !important;">
				<thead>
			      	<tr>
			      		<th data-field="list">#</th>
			            <th data-field="academic_year">Academic Year</th>
			            <th data-field="student_id">Student Id</th>
			            <th data-field="name">Name</th>
			            <th data-field="balance">Balance</th>
			            <th data-field="details">Details</th>
			            <th data-field="status">Status</th>
			            <th data-field="date_posted">Posted Date</th>
			            <th data-field="action">Action</th>
			      	</tr>
			    </thead>
			    <tbody id="financetablebody">
			    	

			    </tbody>	
			</table>
			<p id="norecordfinance"></p>
		    </div>
			<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
			    <a class="btn-floating btn-large red" id="add-finance-btn">
			      <i class="large material-icons">add</i>
			    </a>
			    <ul>
      				<li><a class="btn-floating green white-text tooltipped" data-position="left" data-delay="50" data-tooltip="Upload Finance Record via Excel" id="btn-excel-finance"><i class="fa fa-file-excel-o fa-lg"></i></a></li>
      				<li><a href='../templates/Finance-template.csv' target="_blank" class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Download Finance Excel Template"><i class="fa fa-download"></i></a></li>
    			</ul>
			</div>
			<!-- Modal Structure -->
			  <div id="finance-settings" class="modal bottom-sheet">
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

		 <!-- Modal Structure -->
		  <div id="add-finance" class="modal modal-fixed-footer">
		    <div class="modal-content">
		      <h4>Add Record</h4>
		      <div class="divider"></div>
		      <form id="finance-record-form">
				<div class="input-field col s12">
		          <input placeholder="Academic Year" name= "academic_year" id="academic_year" type="text" class="validate input-finance">
		        </div>
		        <div class="input-field col s12">
		          <input placeholder="Student Id" name= "student_id" id="student_id" type="text" class="validate input-finance">
		        </div>		      		
		        <div class="input-field col s12">
		          <input placeholder="Name" name= "student_name" id="student_name" type="text" class="validate input-finance">
		        </div>
		        <div class="input-field col s12">
		          <input placeholder="Balance" name= "balance" id="balance" type="text" class="validate input-finance">
		        </div>
		        <div class="input-field col s12">
		          <input placeholder="Details" name= "balance_detail" id="balance_detail" type="text" class="validate input-finance">
		        </div>
		        <label>Status</label>
		          <select class="browser-default" name="status" id="status">
				    <option value="Not Paid" selected="">Not Paid</option>
				    <option value="Paid">Paid</option>
				  </select>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat" id="close-btn-record">Close</a>
		      <button href="#!" class=" modal-action waves-effect waves-green btn-flat left" type="submit" id="save-btn-record">Save</button>
		      </form>
		    </div>
		 </div>
		 <!-- Modal Structure -->
		  <div id="update-finance" class="modal modal-fixed-footer">
		    <div class="modal-content">
		      <h4>Update Record</h4>
		      <div class="divider"></div>
		      <form id="finance-update_record-form">
				<div class="input-field col s12">
		          <input placeholder="Academic Year" name= "uacademic_year" id="uacademic_year" type="text" class="validate input-finance">
		        </div>
		        <div class="input-field col s12">
		          <input placeholder="Student Id" name= "ustudent_id" id="ustudent_id" type="text" class="validate input-finance">
		        </div>		      		
		        <div class="input-field col s12">
		          <input placeholder="Name" name= "ustudent_name" id="ustudent_name" type="text" class="validate input-finance">
		        </div>
		        <div class="input-field col s12">
		          <input placeholder="Balance" name= "ubalance" id="ubalance" type="text" class="validate input-finance">
		        </div>
		        <div class="input-field col s12">
		          <input placeholder="Details" name= "ubalance_detail" id="ubalance_detail" type="text" class="validate input-finance">
		        </div>
		        <label>Status</label>
		          <select class="browser-default" name="ustatus" id="ustatus">
				    <option value="Not Paid" selected="">Not Paid</option>
				    <option value="Paid">Paid</option>
				  </select>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat" onclick="location.reload();">Close</a>
		      <button href="#!" class=" modal-action waves-effect waves-green btn-flat left" type="submit" id="update-btn-record">Update</button>
		      </form>
		    </div>
		 </div>
		<!-- Modal Structure -->
		  <div id="record-succcess" class="modal">
		    <div class="modal-content">
		      <p class="green-text"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;Record Saved!</p>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
		    </div>
		  </div>
		  <div id="record-updated" class="modal">
		    <div class="modal-content">
		      <p class="green-text"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;Record Updated!</p>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
		    </div>
		  </div>
		  <div id="record-failed" class="modal">
		    <div class="modal-content">
		      <p class="red-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;&nbsp;Saving Failed. Record is already existing.</p>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
		    </div>
		  </div>
	
			<div id="delete-confirm" class="modal">
			    <div class="modal-content center-align">
			    	<div class="question-del-finance">
				      <h5>Are you sure you want to delete the record of <b><span class="record-holder"></span></b>?</h5>
				      <a class="waves-effect waves-green btn-flat btn-delete-finance-yes">Yes</a>
				      <a class="modal-close waves-effect waves-red btn-flat">No</a>
			      	</div>
			      	<p class="success-text-finance green-text"></p>
					<div class="modal-footer">
				      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat" onclick="location.reload();">Close</a>
				    </div>
			    </div>
		  	</div>				  		  
			
		<!-- Modal Structure -->
		  <div id="excel-finance" class="modal">
		    <div class="modal-content">
			<h5>Add Records via Excel</h5>
		    <div class="divider"></div>
				<form id="form-excel-finance">
				    <div class="file-field input-field">
				      <div class="btn">
				        <span>File</span>
				        <input type="file" name= "finance_excel_input" accept=".csv">
				      </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text" placeholder="Upload excel file (.csv)">
				      </div>
				    </div>
			<p>*Important: Please see instruction before uploading excel file. <a href = 'finance-instruction.php' target="_blank">see instruction</a></p>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat" onclick="location.reload();">Close</a>
		      <button href="#!" class=" modal-action waves-effect waves-green btn-flat left" type="submit" id='finupdiag'>Upload</button>
		      </form>
		    </div>
		  </div>
		  <div id="record-succcess-excel" class="modal">
		    <div class="modal-content">
		      <p class="green-text"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;Record Saved!</p>
		    </div>
		    <div class="modal-footer">
		      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
		    </div>
		  </div>
		  <div id="record-fail-excel" class="modal">
		    <div class="modal-content">
		      <p class="red-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;&nbsp;<span id='failfinanceexcel'></span></p>
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