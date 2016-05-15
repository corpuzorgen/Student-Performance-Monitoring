<?php 
	session_start();
	if( !isset($_SESSION['facultyUsername']) ){
		header('Location: ../portal-signin.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Faculty Class CC Smart Kidz School Incorporated - Official Website</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		
		<header class="faculty-Class">
			<nav class=" light-blue darken-1">
			    <div class="nav-wrapper nav-wrapper-faculty">
			    	<div class="nav-wrap-show">
				    <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
				    <ul class="">
				        <li><a href="" class="faculty-page-title">Class</a></li>
	      			</ul>
	      			<ul id="slide-out" class="side-nav">
	      				<li class="faculty-avatar-sidenav light-blue darken-1">
							<img src="../images/admin-avatar.png" alt="" class="faculty-avatar-img" >
							<p class="faculty-usr">Employee Id: <b><span id="faculty-empid-nav"></span></b></p>
	      				</li>
						<li class=""><a href="dashboard.php"><i class="fa fa-tachometer fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
					    <li class=""><a href="profile.php"><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
					    <li class=""><a href="messages.php"><i class="fa fa-comments-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a></li>
					    <li class=""><a href="class.php"><i class="fa fa-calendar-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Class</a></li>
					    <li class=""><a href="grades.php"><i class="fa fa-percent fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Grades</a></li>
					    <li class=""><a href="evaluation.php"><i class="fa fa-area-chart fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Evaluation</a></li>
					    <li class=""><a href="attendance.php"><i class="fa fa-calendar fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Attendance</a></li>
					    <a href="../logout.php"><i class="fa fa-sign-out fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
	  				</ul>
	  				<a href="" data-target="Class-settings" class="modal-trigger"><i class="material-icons right" >more_vert</i></a>
	  				
					</div>
					<form id="search-faculty-content"class="hide">
				        <div class="input-field">
				          <input id="search" type="search" placeholder="What are you looking? Search it here."required>
				         
				          <i class="material-icons close-search-faculty">close</i>
				        </div>
			      	</form>	  				
			    </div>
			</nav>			
		</header>

		<main>
			<div class="container"style="margin-top: 2%;">
				<h5 class="grey-text" id="noclassh5"><i class="fa fa-calendar-times-o fa-2x"></i>&nbsp;&nbsp;No class listed yet. Add <a href=""class="btn-add-class">here</a></h5>
					<h5 class="grey-text" style="margin-bottom: 3%;" id="hasclassh5"><i class="fa fa-calendar-check-o fa-2x"></i>&nbsp;&nbsp;Class List</h5>
				<ul class="collapsible popout" data-collapsible="expandable" id="ul-class">
				  
			  	</ul>


		<div class="fixed-action-btn vertical" style="bottom: 45px; right: 24px;">
		    <a class="btn-floating btn-large waves-effect waves-light red btn-add-class" ><i class="material-icons">add</i></a>
			<ul>
		      <li><a class="btn-floating green add-students-excel tooltipped" data-position="left" data-delay="50" data-tooltip="Upload Student via Excel"><i class="fa fa-file-excel-o"></i></a></li>
		      <li><a href='../templates/Student-template.csv' target="_blank" class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Download Student Excel Template"><i class="fa fa-download"></i></a></li>
		    </ul>
		  </div>
		

			<!-- Modal Structure -->
			  <div id="addclass" class="modal modal-fixed-footer">
			    <div class="modal-content">
			      <h4>Add a Class</h4>
			      <div class="divider"></div>
			      <form id="add-class-form">
					<div class="row">
				        <div class="input-field col s12">
				          <input placeholder="Class name" id="class_name" name="class_name" type="text" class="validate">
				        </div>
			        </div>
					<div class="input-field col s12">
					    <select id="class_section" name="class_section">
					      <optgroup label="Pre-School">
					        <option value="kindergarten_1">Kindergarten 1</option>
					        <option value="kindergarten_2">Kindergarten 2</option>
					        <option value="preparatory">Preparatory</option>
					      </optgroup>
					      <optgroup label="Grade School">
					        <option value="grade_1">Grade 1</option>
					        <option value="grade_2">Grade 2</option>
					        <option value="grade_3">Grade 3</option>
					        <option value="grade_4">Grade 4</option>
					        <option value="grade_5">Grade 5</option>
					        <option value="grade_6">Grade 6</option>
					      </optgroup>
					    </select>
					    <label>Choose a section</label>
				  	</div>
				  	<div class="input-field col s12">
				  		<h5 class="grey-text" style="margin-top: 3%">Select Subject/s</h5>
				  		<div class="row">
					  		<div class="col s6">
							    <p>
							      <input type="checkbox" id="filipino" name="filipino" value="Filipino"/>
							      <label for="filipino">Filipino</label>
							    </p>
							    <p>
							      <input type="checkbox" id="science" name="science" value="Science"/>
							      <label for="science">Science</label>
							    </p>
							    <p>
							      <input type="checkbox" id="math" name="math" value="Math"/>
							      <label for="math">Math</label>
							    </p>
							    <p>
							      <input type="checkbox" id="english" name="english" value="English"/>
							      <label for="english">English</label>
							    </p>
						    </div>
						    <div class="col s6">
								<p>
							      <input type="checkbox" id="ap" name="ap" value="AP"/>
							      <label for="ap">AP</label>
							    </p>
							    <p>
							      <input type="checkbox" id="epp" name="epp" value="EPP"/>
							      <label for="epp">EPP</label>
							    </p>
							    <p>
							      <input type="checkbox" id="mapeh" name="mapeh" value="Mapeh"/>
							      <label for="mapeh">Mapeh</label>
							    </p>
							    <p>
							      <input type="checkbox" id="esp" name="esp" value="ESP"/>
							      <label for="esp">ESP</label>
							    </p>
						    </div>
					    </div>
				  	</div>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat " onclick="location.reload();">Close</a>
			      <button class="modal-action waves-effect waves-green btn-flat left" id="btn-submit-class">Add Class</button>
			       </form>
			    </div>
			  </div>
			  <div id="classaddsuccess" class="modal">
				    <div class="modal-content center-align">
				      <p class="green-text"><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Class added successfully!</p>
				    </div>
				    <div class="modal-footer">
				      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
				    </div>
			  	</div>
				<div id="classerror" class="modal">
				    <div class="modal-content center-align">
				      <p>A class has already been created for the section: <span class="section_error"></span> with the subject <span class="subject_error"></span></p>
				    </div>
				    <div class="modal-footer">
				      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
				    </div>
			  	</div>
				<!-- Modal Structure -->
			  <div id="Class-settings" class="modal bottom-sheet">
			    	<div class="modal-content">
			      			<h4>Class Settings</h4>
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
			<!-- Modal Structure -->
			  <div id="add-student" class="modal modal-fixed-footer">
			    <div class="modal-content">
			      <h4>Add Students <span class="add-student-section-name"></span></h4>
			      <div class="divider"></div>
			      <form id="student-list-form">
			      <div class="row">
						<div class="input-field col s12">
				          <input placeholder="Student Id" id="student_id" name="student_id" type="text" class="validate inputaddstud">
				        </div>
        			</div>
			      	<div class="row">
				        <div class="input-field col s4">
				          <input placeholder="First name" id="student_first_name" name="student_first_name" type="text" class="validate inputaddstud">
				        </div>
				        <div class="input-field col s4">
				          <input placeholder="Middle name" id="student_middle_name" name="student_middle_name" type="text" class="validate inputaddstud">
				        </div>
				        <div class="input-field col s4">
				          <input placeholder="Last name" id="student_last_name" name="student_last_name" type="text" class="validate inputaddstud">
				        </div>
        			</div>
        			<div class="row">
						<div class="input-field col s12">
				          <input placeholder="Address" id="student_address" name="student_address" type="text" class="validate inputaddstud">
				        </div>
        			</div>
        			<div class="row">
						<div class="input-field col s4">
				          <input placeholder="Guardian firstname" id="student_guardianfn" name="student_guardianfn" type="text" class="validate inputaddstud">
				        </div>
				        <div class="input-field col s4">
				          <input placeholder="Guardian lastname" id="student_guardianln" name="student_guardianln" type="text" class="validate inputaddstud">
				        </div>
				        <div class="input-field col s4">
				          <input placeholder="Phone number" id="guardian_phone" name="guardian_phone" type="text" class="validate inputaddstud">
				        </div>
        			</div>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat " onclick="location.reload();">Close</a>
			      <button class="modal-action waves-effect waves-green btn-flat left btn-add-student" type='submit'>Add Student</button>
			      </form>
			    </div>
			  </div>

			<div id="addstudentsuccess" class="modal">
			    <div class="modal-content center-align">
			    <p class="green-text"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;Student added!</p>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
			    </div>
			  </div>
			</div>

			<!-- Modal Structure -->
			  <div id="update-student" class="modal modal-fixed-footer">
			    <div class="modal-content">
			      <h4>Update Student: <span class="update-student-section-name"></span></h4>
			      <div class="divider"></div>
			      <form id="student-update-list-form">
			      	<div class="row">
				        <div class="input-field col s4">
				          <input placeholder="First name" id="student_first_name_update" name="student_first_name_update" type="text" class="validate inputaddstud">
				        </div>
				        <div class="input-field col s4">
				          <input placeholder="Middle name" id="student_middle_name_update" name="student_middle_name_update" type="text" class="validate inputaddstud">
				        </div>
				        <div class="input-field col s4">
				          <input placeholder="Last name" id="student_last_name_update" name="student_last_name_update" type="text" class="validate inputaddstud">
				        </div>
        			</div>
        			<div class="row">
						<div class="input-field col s12">
				          <input placeholder="Address" id="student_address_update" name="student_address_update" type="text" class="validate inputaddstud">
				        </div>
        			</div>
        			<div class="row">
						<div class="input-field col s4">
				          <input placeholder="Guardian firstname" id="student_guardianfn_update" name="student_guardianfn_update" type="text" class="validate inputaddstud">
				        </div>
				        <div class="input-field col s4">
				          <input placeholder="Guardian lastname" id="student_guardianln_update" name="student_guardianln_update" type="text" class="validate inputaddstud">
				        </div>
				        <div class="input-field col s4">
				          <input placeholder="Phone number" id="guardian_phone_update" name="guardian_phone_update" type="text" class="validate inputaddstud">
				        </div>
        			</div>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat " onclick="location.reload();">Close</a>
			      <button class="modal-action waves-effect waves-green btn-flat left btn-update-student-yes" type='submit'>Update Student</button>
			      </form>
			    </div>
			  </div>
			<div id="updatesuccessstudent" class="modal">
			    <div class="modal-content center-align">
					<p class="green-text"><i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;Student information updated!</p>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
			    </div>
			  </div>
		<div id="deletequestionstudent" class="modal">
		    <div class="modal-content center-align">
		    	<div class="questiondrop">
					<p>Are you sure you want to DROP this student: <b><span class='dropstudname'></span></b>?</p>
					<a class="waves-effect waves-green btn-flat btn-drop-student-yes">Yes</a>&nbsp;&nbsp;
					<a class="waves-effect waves-red btn-flat modal-close">No</a>
				</div>
				<p class="successdropstud red-text hidden-input">Student successfully removed from class!</p>
		    </div>
		    <div class="modal-footer">
			      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat" onclick="location.reload();">Close</a>
			    </div>
		  </div>


	<div id="removeclass" class="modal">
	    <div class="modal-content center-align">
	    		<div class="removequestionfromclass">
				<p>Are you sure you want to remove this class:<br/> <b><span class='classnametoremove'></span></b> consisting of <b><span class="studentcount"></span> student/s</b> enrolled in the subject <b><span class="subjecttoremove"></span></b>?</p>
				 	<a class="waves-effect waves-green btn-flat btn-remove-class-yes">Yes</a>
				  	<a class="waves-effect waves-red btn-flat modal-close">No</a>
			  	</div>
			  	<p class="hidden-input removesuccessfromclass red-text">All information from the class has been successfully removed!</p>
	    </div>
	    <div class="modal-footer">
	      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat" onclick="location.reload();">Close</a>
	    </div>
  	</div>

  	<div id="excel-class-student" class="modal">
    <div class="modal-content">
      <h4 style="margin-bottom: 3%;">Add Students</h4>
	<div class="divider"></div>
		 <form id='formexcelstudentlist'>
		    <div class="file-field input-field">
		      <div class="btn">
		        <span>File</span>
		          <input type="file" name = "studentlisttoupload" accept=".csv">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text" placeholder="Upload Student List">
		      </div>
		    </div>
		  	<span class="green-text hidden-input" id='success-student-excel-upload'><i class="fa fa-check-circle"></i>&nbsp;&nbsp;Upload successful!</span>
			<span class="red-text hidden-input" id='fail-student-excel-upload'><i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;<span class="faildiag"></span></span>
		  	<p>* See first <a href="instruction.php" target = '_blank' >instruction</a> on how to upload student infomation using excel.</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat" onclick="location.reload();">Close</a>
      <button class="left modal-action waves-effect waves-green btn-flat" type='submit' id='upload-excel-studentlist'>Upload</button>
      </form>
    </div>
  </div>




		</main>
		<footer></footer>
		<script src="../js/jquery.1.12.0.js"></script>
		<script src="../js/materialize.min.js"></script>
		<script src="../js/faculty.js"></script>
	</body>
</html>