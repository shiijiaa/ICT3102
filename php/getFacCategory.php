<?php 
include("dbconn.php");
$facArr= array();
$query = "select distinct `facility_category` from Facility";

$result = mysqli_query($link,$query) or die(mysqli_error());
while($row = mysqli_fetch_assoc($result)){
	array_push($facArr, $row);
	}
?>