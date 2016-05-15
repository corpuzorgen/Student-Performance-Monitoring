<?php 
	session_start();
	if( !isset($_SESSION['facultyUsername']) ){
		header('Location: ../portal-signin.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Faculty Grades CC Smart Kidz School Incorporated - Official Website</title>
		<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta charset='utf-8'>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body>
		
		<header class="faculty-grades">
			<nav class=" light-blue darken-1">
			    <div class="nav-wrapper nav-wrapper-faculty">
			    	<div class="nav-wrap-show">
				    <a href="" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
				    <ul class="">
				        <li><a href="" class="faculty-page-title">Grades</a></li>
	      			</ul>
	      			<ul id="slide-out" class="side-nav">
	      				<li class="faculty-avatar-sidenav light-blue darken-1">
							<img src="../images/admin-avatar.png" alt="" class="faculty-avatar-img" >
							<p class="faculty-usr">Employee Id: <b><span id="faculty-empid-nav"></span></b></p>
	      				</li>
						<li class=""><a href="Dashboard.php"><i class="fa fa-tachometer fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
					    <li class=""><a href="profile.php"><i class="fa fa-user fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Profile</a></li>
					    <li class=""><a href="messages.php"><i class="fa fa-comments-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Messages</a></li>
					    <li class=""><a href="class.php"><i class="fa fa-calendar-o fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Class</a></li>
					    <li class=""><a href="grades.php"><i class="fa fa-percent fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Grades</a></li>
					    <li class=""><a href="evaluation.php"><i class="fa fa-area-chart fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Evaluation</a></li>
					    <li class=""><a href="attendance.php"><i class="fa fa-calendar fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Attendance</a></li>
					    <a href="../logout.php"><i class="fa fa-sign-out fa-2x"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
	  				</ul>
	  				<a href="" data-target="Grades-settings" class="modal-trigger"><i class="material-icons right" >more_vert</i></a>
	  				
					</div>
					<form id="search-faculty-content"class="hide">
				        <div class="input-field">
				          <input id="search" type="search" placeholder="What are you looking? Search it here."required>
				          <label for="search"><i class="material-icons">search</i></label>
				          <i class="material-icons close-search-faculty">close</i>
				        </div>
			      	</form>	  				
			    </div>
			</nav>			
		</header>

		<main>
			<div class=""style="margin-top: 3%;">
			
			<div class="container">
			<h5 class="grey-text center-align" style="margin-bottom: 3%;">Input grades based on "Written works", "Performance Tasks" and "Quarterly Assessment".</h5>

			<form action="">
				<select class="browser-default" name="grades_class" id="grades_class">
					<option value="" disabled selected class="classoptiondisableclassforgrades">Choose your Class</option>
				</select>
				<select class="browser-default hidden-input" name="grades_subject" id="grades_subject" style="margin: 2% 0;">
					<option value="" disabled selected class="classoptiondisablesubjectforgrades">Select a subject</option>
				</select>
				<div class="radio-btn hidden-input">
					<p style="display: inline-block;">
					  <input name="quarter" type="radio" id="quarterone" class="quarter-btn" value="quarterone" />
					  <label for="quarterone">1st Quarter</label>
					</p>
					<p style="display: inline-block;">
					  <input name="quarter" type="radio" id="quartertwo" class="quarter-btn" value="quartertwo" />
					  <label for="quartertwo">2nd Quarter</label>
					</p>
					<p style="display: inline-block;">
					  <input name="quarter" type="radio" id="quarterthree" class="quarter-btn" value="quarterthree" />
					  <label for="quarterthree">3rd Quarter</label>
					</p>
					<p style="display: inline-block;">
					  <input name="quarter" type="radio" id="quarterfour" class="quarter-btn" value="quarterfour" />
					  <label for="quarterfour">4th Quarter</label>
					</p>
					<p style="display: inline-block;">
					  <input name="quarter" type="radio" id="sumquarterpersubject" class="quarter-btn" value="sumquarterpersubject" />
					  <label for="sumquarterpersubject">Summary of Quarterly Grades</label>
					</p>
				</div>
				</div>	
				<div class="invisible divgrades" style="margin: 1%;">
					<table class="highlight" style="margin: 3% 0;">
				        <thead>
				        <tr>
				        	<th colspan="14" class="center-align"><h4>Written Works</span></h4></th>
				        </tr>
				        <tr>
					        <th>Name</th>
					        <th>1</th>
					        <th>2</th>
					        <th>3</th>
					        <th>4</th>
					        <th>5</th>
					        <th>6</th>
					        <th>7</th>
					        <th>8</th>
					        <th>9</th>
					        <th>10</th>
					        <th>Total</th>
					        <th class="tooltipped" data-position="top" data-delay="50" data-tooltip="Percentage Score">PS</th>
					        <th class="tooltipped" data-position="top" data-delay="50" data-tooltip="Weighted Score">WS</th>
					        <th>Action</th>
				        </tr>
				        <tr class="hspforww" id = "writtenworks">
					        
				        </tr>
				        </thead>
				        <tbody class="tbody-ww">

				        </tbody>
			        </table>
			       <hr>
			        <table class="highlight" style="margin: 3% 0;">
				        <thead>
				        <tr>
				        	<th colspan="14" class="center-align"><h4>Performance Tasks </h4></th>
				        </tr>
				        <tr>
					        <th>Name</th>
					        <th>1</th>
					        <th>2</th>
					        <th>3</th>
					        <th>4</th>
					        <th>5</th>
					        <th>6</th>
					        <th>7</th>
					        <th>8</th>
					        <th>9</th>
					        <th>10</th>
					        <th>Total</th>
					        <th class="tooltipped" data-position="top" data-delay="50" data-tooltip="Percentage Score">PS</th>
					        <th class="tooltipped" data-position="top" data-delay="50" data-tooltip="Weighted Score">WS</th>
					        <th>Action</th>
				        </tr>
				        <tr class="hspforpt" id = "performancetasks">
					        
				        </tr>
				        </thead>
				        <tbody class="tbody-pt">

				        </tbody>
			        </table>
			       <hr>
			        <table class="highlight" style="margin: 3% 0;">
				        <thead>
				        <tr>
				        	<th colspan="14" class="center-align"><h4>Quarterly Assessment<span class="qapercent"></span></h4></th>
				        </tr>
				        <tr>
					        <th>Name</th>
					        <th>Exam Score</th>
					        <th class="tooltipped" data-position="top" data-delay="50" data-tooltip="Percentage Score">PS</th>
					        <th class="tooltipped" data-position="top" data-delay="50" data-tooltip="Weighted Score">WS</th>
					        <th>Action</th>
					       
				        </tr>
				        <tr class="hspforqa" id = "quarterlyassessment">
					        
				        </tr>
				        </thead>
				        <tbody class="tbody-qa">
							
						</tbody>
			        </table>
					   <hr>
			        <table class="highlight" style="margin: 3% 0;">
			       		<thead>
					        <tr>
						        <th>Name</th>
						        <th>Initital Grade</th>
						        <th>Quarterly Grade</th>
					        </tr>
				        </thead>
						<tbody class="tbody-grade">
							
						</tbody>
			        </table>
				</div>
				<div class="invisible sumofgradesdiv" style="margin: 1%;">
					<table class="highlight" style="margin: 3% 0;">
						<thead>
							<tr>
				        		<th colspan="14" class="center-align"><h4 class="subjofsumgrades"></span></h4></th>
				        	</tr>
					        <tr>
						        <th>Name</th>
						        <th>1st Quarter</th>
						        <th>2nd Quarter</th>
						        <th>3rd Quarter</th>
						        <th>4th Quarter</th>
						        <th>FINAL GRADE</th>
						        <th>REMARK</th>
					        </tr>
				        </thead>
						<tbody class="tbody-sumofgrades">
							
						</tbody>
					</table>
				</div>

			</form>






			<div id="emptyhps" class="modal">
			    <div class="modal-content center-align">
			      <p class="red-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;&nbsp;Please Enter a valid score higher than 0.</p>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
			    </div>
			  </div>
			  <div id="invalidgrade" class="modal">
			    <div class="modal-content center-align">
			      <p class="red-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>&nbsp;&nbsp;Please Enter a valid score lower than or equal to HPS.</p>
			    </div>
			    <div class="modal-footer">
			      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
			    </div>
			  </div>

				<!-- Modal Structure -->
			  <div id="Grades-settings" class="modal bottom-sheet">
			    	<div class="modal-content">
			      			<h4>Grades Settings</h4>
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
			</div>		    
		</main>

		<div id="errorhsp" class="modal">
	    <div class="modal-content center-align">
	      <p class="red-text errmsgforhsp"></p>
	    </div>
	    <div class="modal-footer">
	      <a href="#!" class=" modal-action modal-close waves-effect waves-red btn-flat">Close</a>
	    </div>
	  </div>

		<div id="editww" class="modal modal-fixed-footer">
		    <div class="modal-content">
					<h4 class="nametoupdategrade"></h4>
					<div class="divider"></div>
				<form action="">
					<div class="row">
				        <div class="input-field col s3">
				          <input id="item_1ww" type="text" class="validate editgradeww">
				          <label for="item_1ww">Item 1</label>
				        </div>
				        <div class="input-field col s3">
				          <input id="item_2ww" type="text" class="validate editgradeww">
				          <label for="item_2ww">Item 2</label>
				        </div>
				        <div class="input-field col s3">
				          <input id="item_3ww" type="text" class="validate editgradeww">
				          <label for="item_3ww">Item 3</label>
				        </div>
				        <div class="input-field col s3">
				          <input id="item_4ww" type="text" class="validate editgradeww">
				          <label for="item_4ww">Item 4</label>
				        </div>
			      	</div>
			      	<div class="row">
				        <div class="input-field col s3">
				          <input id="item_5ww" type="text" class="validate editgradeww">
				          <label for="item_5ww">Item 5</label>
				        </div>
				        <div class="input-field col s3">
				          <input id="item_6ww" type="text" class="validate editgradeww">
				          <label for="item_6ww">Item 6</label>
				        </div>
				        <div class="input-field col s3">
				          <input id="item_7ww" type="text" class="validate editgradeww">
				          <label for="item_7ww">Item 7</label>
				        </div>
				        <div class="input-field col s3">
				          <input id="item_8ww" type="text" class="validate editgradeww">
				          <label for="item_8ww">Item 8</label>
				        </div>
			      	</div>
			      	<div class="row">
				        <div class="input-field col s3">
				          <input id="item_9ww" type="text" class="validate editgradeww">
				          <label for="item_9ww">Item 9</label>
				        </div>
				        <div class="input-field col s3">
				          <input id="item_10ww" type="text" class="validate editgradeww">
				          <label for="item_10ww">Item 10</label>
				        </div>
				        <div class="input-field col s2">
				          <p>Total: <b><span class="totalupdate"></span></b></p>
				        </div>
				        <div class="input-field col s2">
				         <p>PS: <b><span class="psupdate"></span></b></p>
				        </div>
				        <div class="input-field col s2">
				         <p>WS: <b><span class="wsupdate"></span></b></p>
				        </div>

			      	</div>
				</form>

		    </div>
		    <div class="modal-footer">
		      <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a>
		      <a href="#!" class="modal-action left waves-effect waves-green btn-flat btn-yes-updategrades">Update</a>
		    </div>
		  </div>

		  <div id="editpt" class="modal modal-fixed-footer">
		    <div class="modal-content">
					<h4 class="nametoupdategradept"></h4>
					<div class="divider"></div>
				<form action="">
					<div class="row">
				        <div class="input-field col s3">
				          <input id="item_1pt" type="text" class="validate editgradept">
				          <label for="item_1pt">Item 1</label>
				        </div>
				        <div class="input-field col s3">
				          <input id="item_2pt" type="text" class="validate editgradept">
				          <label for="item_2pt">Item 2</label>
				        </div>
				        <div class="input-field col s3">
				          <input id="item_3pt" type="text" class="validate editgradept">
				          <label for="item_3pt">Item 3</label>
				        </div>
				        <div class="input-field col s3">
				          <input id="item_4pt" type="text" class="validate editgradept">
				          <label for="item_4pt">Item 4</label>
				        </div>
			      	</div>
			      	<div class="row">
				        <div class="input-field col s3">
				          <input id="item_5pt" type="text" class="validate editgradept">
				          <label for="item_5pt">Item 5</label>
				        </div>
				        <div class="input-field col s3">
				          <input id="item_6pt" type="text" class="validate editgradept">
				          <label for="item_6pt">Item 6</label>
				        </div>
				        <div class="input-field col s3">
				          <input id="item_7pt" type="text" class="validate editgradept">
				          <label for="item_7pt">Item 7</label>
				        </div>
				        <div class="input-field col s3">
				          <input id="item_8pt" type="text" class="validate editgradept">
				          <label for="item_8pt">Item 8</label>
				        </div>
			      	</div>
			      	<div class="row">
				        <div class="input-field col s3">
				          <input id="item_9pt" type="text" class="validate editgradept">
				          <label for="item_9pt">Item 9</label>
				        </div>
				        <div class="input-field col s3">
				          <input id="item_10pt" type="text" class="validate editgradept">
				          <label for="item_10pt">Item 10</label>
				        </div>
				        <div class="input-field col s2">
				          <p>Total: <b><span class="totalupdatept"></span></b></p>
				        </div>
				        <div class="input-field col s2">
				         <p>PS: <b><span class="psupdatept"></span></b></p>
				        </div>
				        <div class="input-field col s2">
				         <p>WS: <b><span class="wsupdatept"></span></b></p>
				        </div>

			      	</div>
				</form>

		    </div>
		    <div class="modal-footer">
		      <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a>
		      <a href="#!" class="modal-action left waves-effect waves-green btn-flat btn-yes-updategradespt">Update</a>
		    </div>
		  </div>

		  <div id="editqa" class="modal modal-fixed-footer">
		    <div class="modal-content">
					<h4 class="nametoupdategradeqa"></h4>
					<div class="divider"></div>
				<form action="">
					<div class="row">
				        <div class="input-field col s3">
				          <input id="qaexamscore" type="text" class="validate examscoreiput">
				          <label for="qaexamscore">Exam Score</label>
				        </div>
				        <div class="input-field col s3">
				          	<p>PS: <b><span class="psupdateqa"></span></b></p>
				        </div>
				        <div class="input-field col s3">
				         	<p>WS: <b><span class="wsupdateqa"></span></b></p>
				        </div>
					</div>
				</form>

		    </div>
		    <div class="modal-footer">
		      <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a>
		      <a href="#!" class="modal-action left waves-effect waves-green btn-flat btn-yes-updategradesqa">Update</a>
		    </div>
		  </div>

		
		<script src="../js/jquery.1.12.0.js"></script>
		<script src="../js/materialize.min.js"></script>
		<script src="../js/faculty.js"></script>
	</body>
</html>