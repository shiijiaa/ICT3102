<?php
	include 'dbConn.php';

	$school_sql="SELECT 
	School.sch_id, 
	School.sch_name, 
	School.sch_education_level, 
	Location.location_address, 
	Location.location_postalcode, 
	Location.location_longitude, 
	Location.location_latitude 
	FROM School 
	INNER JOIN Location ON Location.location_id = School.location_id";
	
	$school = mysqli_query($link, $school_sql);

	$schoolList = array();
	while($row = mysqli_fetch_assoc($school)) {
	   $schoolList[] = $row;
	}
	$school_array = json_encode($schoolList);
	
	$facility_sql="SELECT 
	Facility.facility_id, 
	Facility.facility_name, 
	Facility.facility_category, 
	Location.location_address, 
	Location.location_postalcode, 
	Location.location_longitude, 
	Location.location_latitude 
	FROM Facility 
	INNER JOIN Location ON Location.location_id = Facility.location_id";
	
	$facility = mysqli_query($link, $facility_sql);
	
	$facilityList = array();
	while($row = mysqli_fetch_assoc($facility)) {
	   $facilityList[] = $row;
	}
	$facility_array = json_encode($facilityList);
	
	$blackspot_sql="SELECT 
	Blackspot.blackspot_id, 
	Location.location_address, 
	Location.location_postalcode, 
	Location.location_longitude, 
	Location.location_latitude 
	FROM Blackspot 
	INNER JOIN Location ON Location.location_id = Blackspot.location_id";
	
	$blackspot = mysqli_query($link, $blackspot_sql);
	
	$blackspotList = array();
	while($row = mysqli_fetch_assoc($blackspot)) {
	   $blackspotList[] = $row;
	}
	$blackspot_array = json_encode($blackspotList);
	
	mysqli_close($link);
?>