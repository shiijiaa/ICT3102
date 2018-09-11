<?php 
include("dbconn.php");
$facArr= array();
$query = "select distinct * from Facility f, Location l where  l.location_id = f.location_id order by facility_name asc";

$result = mysqli_query($link,$query) or die(mysqli_error());
while($row = mysqli_fetch_assoc($result)){
	array_push($facArr, $row);
	}

?>