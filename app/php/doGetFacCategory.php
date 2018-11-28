<?php 
include("dbconn.php");

$facArrCategory= array();
$query = "select distinct `facility_category` from Facility";


$result = mysqli_query($link,$query) or die(mysqli_error());
while($row = mysqli_fetch_assoc($result)){
	array_push($facArrCategory, $row);
	}
?>