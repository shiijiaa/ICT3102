<?php 
include("dbconn.php");
$schArr= array();
$query = "select distinct * from School s, Location l where  l.location_id = s.location_id order by sch_name asc";

$result = mysqli_query($link,$query) or die(mysqli_error());
while($row = mysqli_fetch_assoc($result)){
	array_push($schArr, $row);
	}

/*
for($i=0;$i<count($schArr) ; $i++){
	echo $schArr[$i]['location_id'];
	echo "<br>";
}
*/
?>