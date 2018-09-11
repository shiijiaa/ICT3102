<?php 
include("dbconn.php");
$bsArr= array();
$query = "select distinct * from Blackspot bs, Location l where  l.location_id = bs.location_id order by location_address asc";
$result = mysqli_query($link,$query) or die(mysqli_error());
while($row = mysqli_fetch_assoc($result)){
	array_push($bsArr, $row);
	}

?>