<?php include("header.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>School Looker</title>
		<link href="css/css.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- Latest compiled&minified CSS -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script><!-- jQuery library -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<!-- Dialog -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css">

		<!-- Include Date Range Picker -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
	</head>
	<body>
	
	<section  id="mainSection" >
	<div class="container"  id="container">
		<div class="spanx well"  >
		<legend><h1>Search School!</h1></legend>
		 <form id="searchSchoolForm" action="main.php" method="get" style="display: block;" >
			
			<div class="form-group required">
			<input id="email" type="text" class="form-control" name="postalcode" placeholder="Postal Code">
			</div>
			
			<div class="form-group required" >
				<select name="level" id="reg_gender" class="form-control" tabindex="2" >
				<option value="" disabled selected>Education Level</option>
				<option value="primary">Primary</option>
				<option value="secondary">Secondary</option>
				<option value="tertiary">Tertiary</option>
				</select>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<input type="submit" id="submit" tabindex="4" class="form-control btn btn-primary" value="Search">
					</div>
				</div>
			</div>
		</form>
		</div>
	</div> 
	<footer class="navbar-default navbar-fixed-bottom" id="footer">
			<center><h4>© SchoolLooker 2017</h4><center>
	</footer>
	</section>

	</body>
</html>

