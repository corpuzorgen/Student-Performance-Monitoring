<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dev</title>
	<link rel="stylesheet" type="text/css" href="../css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	
		<div class="container">
			<form id='dev'>
				<div class="row">
			        <div class="input-field col s12">
			          <input id="devid" type="text"class="validate">
			          <label for="devid">Id</label>
			        </div>
      			</div>
				<div class="row">
			        <div class="input-field col s12">
			          <input id="devpass" type="password"class="validate">
			          <label for="devpass">Password</label>
			        </div>
      			</div>
				<button id = 'log' type="submit">Login</button>
			</form>

			<div class="invisible">
			<form id='adminformforset'>
				<div class="row">
			        <div class="input-field col s12">
			          <input id="adminsetempid" type="text"class="validate">
			          <label for="adminsetempid">Admin Employee Id</label>
			        </div>
      			</div>
				<div class="row">
			        <div class="input-field col s12">
			          <input id="adminsetpass" type="password"class="validate">
			          <label for="adminsetpass">Admin Password</label>
			        </div>
      			</div>
				<button id = 'set' type="submit">Set</button>
			</form>
		</div>

		</div>

		




		<script src="../js/jquery.1.12.0.js"></script>
		<script src="../js/materialize.min.js"></script>
		<script src="../js/script.js"></script>
	
</body>
</html>