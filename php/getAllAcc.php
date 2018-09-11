<?php 
include("dbconn.php");
$userArr= array();
$query = "select * from User order by user_name asc";

$result = mysqli_query($link,$query) or die(mysqli_error());
while($row = mysqli_fetch_assoc($result)){
	array_push($userArr, $row);
	}
?>