<?php 
include("dbconn.php");
	if(isset($_GET['sch_id'])){
		$schID = $_GET['sch_id'];
		$schData= array();
		$query = "select * from School s,Location l where s.location_id = l.location_id and sch_id=$schID";
		$result = mysqli_query($link,$query) or die(mysqli_error());
		$row = mysqli_fetch_assoc($result);
		$sch_id =$row ['sch_id'];
		$sch_name = $row ['sch_name'];
		$sch_edu= $row ['sch_education_level'];
		$sch_add = $row ['location_address'];
		$sch_postal = $row ['location_postalcode'];
		$sch_lat = $row ['location_latitude'];
		$sch_long = $row ['location_longitude'];

	}
	else{
		header("Location: aManage.php");
	}

?>