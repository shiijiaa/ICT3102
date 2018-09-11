<?php 
include("dbconn.php");
$fbArr= array();

if(isset($_GET['sch_id'])){
	$schID= $_GET['sch_id'];
	$query = "select  * from Feedback f, School s,`User` u 
	where s.sch_id = f.sch_id 
	and u.user_id = f.user_id
	and  s.sch_id = '$schID'
	order by fb_date desc
	";

$result = mysqli_query($link,$query) or die(mysqli_error());
while($row = mysqli_fetch_assoc($result)){
	array_push($fbArr, $row);
}
}
else{
	header('location: aFeedback.php');
}

?>