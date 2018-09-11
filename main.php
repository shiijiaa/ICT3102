<?php
if(isset($_GET['level']) && !empty($_GET['level'])) {
	$level = $_GET['level'];
} else {
	$level = "";
}
if(isset($_GET['postalcode']) && !empty($_GET['postalcode'])) {
	$postalcode = $_GET['postalcode'];
} else {
	$postalcode = "";
}
?>

<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>EduLife</title>
		
		<!-- Font Awesome -->
		<script src="https://use.fontawesome.com/beb79bf684.js"></script>

        <!-- Bootstrap -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
		<!-- CSS -->
		<link rel="stylesheet" href="css/main.css" type="text/css"/>

    </head>

    <body>
        <?php
			include 'header.php';
        ?>
        
		<div class="col-xs-12 container" id="menuBar">
			<div id="searchContainer" class="col-xs-2 menuBarContent">				
				<input autocomplete="off" type="search" id="search" placeholder="Search for location" onkeyup="getSearchResults(this.value)">
				<div id="searchResults" class="col-xs-12">
				</div>
			</div>
			
			<div id="schoolContainer" class="col-xs-3 menuBarContent">
				<input autocomplete="off" type="checkbox" name="school" onclick="toggleFilters('schoolGroup')"> Schools
				<div id="schoolGroup">
					<div class="col-xs-12">
						<div class="col-xs-6">
							<input autocomplete="off" type="checkbox" onclick="toggleSubFilters('schoolGroup')" name="schoolFilter" value="Primary"> Primary
						</div>
						<div class="col-xs-6">
							<input autocomplete="off" type="checkbox" onclick="toggleSubFilters('schoolGroup')" name="schoolFilter" value="Secondary"> Secondary
						</div>
					</div>
					<div class="col-xs-12">
						<div class="col-xs-6">
							<input autocomplete="off" type="checkbox" onclick="toggleSubFilters('schoolGroup')" name="schoolFilter" value="Tertiary"> Tertiary
						</div>
						<div class="col-xs-6">
							<input autocomplete="off" type="checkbox" onclick="toggleSubFilters('schoolGroup')" name="schoolFilter" value="Mixed"> Mixed Level
						</div>
					</div>
				</div>
			</div>
			
			<div id="facilityContainer" class="col-xs-5 menuBarContent">
				<input autocomplete="off" type="checkbox" name="facility" onclick="toggleFilters('facilityGroup')"> Facilities<br>
				<div id="facilityGroup">
					<div class="col-xs-12">
						<div class="col-xs-4">
							<input autocomplete="off" type="checkbox" onclick="toggleSubFilters('facilityGroup')" name="facilityFilter" value="Parks"> Park
						</div>
						<div class="col-xs-4">
							<input autocomplete="off" type="checkbox" onclick="toggleSubFilters('facilityGroup')" name="facilityFilter" value="Gyms"> Gym
						</div>
						<div class="col-xs-4">
							<input autocomplete="off" type="checkbox" onclick="toggleSubFilters('facilityGroup')" name="facilityFilter" value="Water Activities"> Water Activitiy
						</div>
					</div>
					<div class="col-xs-12">
						<div class="col-xs-4">
							<input autocomplete="off" type="checkbox" onclick="toggleSubFilters('facilityGroup')" name="facilityFilter" value="Sports Fields"> Sports Centre
						</div>
						<div class="col-xs-5">
							<input autocomplete="off" type="checkbox" onclick="toggleSubFilters('facilityGroup')" name="facilityFilter" value="Community Clubs"> Community Centre
						</div>
					</div>
				</div>
			</div>
			
			<div id="blackspotContainer" class="col-xs-1 menuBarContent">
				<input autocomplete="off" type="checkbox" name="blackspot" value="Blackspots"> Blackspots
			</div>
			
			<div class="col-xs-1 menuBarContent">
				<a href="javascript:resetZoom()" class="btn btn-info" role="button">Reset Zoom</a>
			</div>
				
		</div>
		
		<div class="col-xs-12" id="mainPanel">
			<div id="map">
			</div>
		</div>
		
		<div id="infoModal" class="modal">
		</div>
		<div id="infoPanel" class="col-xs-12">
			<a id="infoCloseBtn" href="#"><span class="glyphicon glyphicon-remove"></span></a>
			<div id="locationIcon" class="col-xs-12">
			</div>
			<div id="locationDetails" class="col-xs-12">
				<div id="locationCategory">
				</div>
				<div id="locationName">
				</div>
				<div id="locationAddress">
				</div>
				<div id="locationPostalcode">
				</div>
			</div>
			<div id="locationFeedback" class="col-xs-12">
				<div id="locationFeedbackComments" class="col-xs-12">
				</div>
				<div id="locationFeedbackSubmission" class="col-xs-12">
				</div>
			</div>
		</div>
		<div id="flagModal" class="modal">
		</div>
		<div id="flagConfirm" class="col-xs-12">
		</div>
		
		<?php
			include 'php/getAllLocations.php';
        ?>
		
         <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script type="text/javascript">
			var schoolList = <?php echo $school_array; ?>;
			var facilityList = <?php echo $facility_array; ?>;
			var blackspotList = <?php echo $blackspot_array; ?>;
			var level = <?php echo json_encode($level); ?>;
			var postalcode = <?php echo json_encode($postalcode); ?>;
		</script>
		<!-- Custom JavaScript -->
		<script src="js/main.js"></script>
		<!-- Google Maps -->
		<script async defer src="https://maps.googleapis.com/maps/api/js?key= AIzaSyD47wxDcUCwLZUzyaL_SykYPdhOiCHI0Ts&callback=initAll"></script>
    </body>
</html>