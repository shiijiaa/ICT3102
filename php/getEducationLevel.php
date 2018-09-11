<?php 
include("dbconn.php");
$eduLevelArr= array();
$query = "select distinct `sch_education_level` from School";

$result = mysqli_query($link,$query) or die(mysqli_error());
while($row = mysqli_fetch_assoc($result)){
	$category = ucwords(strtolower($row['sch_education_level']));
	array_push($eduLevelArr, $category);
	}
	
//print_r($eduLevelArr);
?>