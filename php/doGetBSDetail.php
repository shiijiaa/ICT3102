<?php 
include("dbconn.php");
	if(isset($_GET['bs_id'])){
		$bsID = $_GET['bs_id'];
		$bsData= array();
		$query = "select * from Blackspot b,Location l where b.location_id = l.location_id and blackspot_id=$bsID";
		$result = mysqli_query($link,$query) or die(mysqli_error());
		$row = mysqli_fetch_assoc($result);
		$bs_id =$row ['blackspot_id'];
		$bs_add = $row ['location_address'];
		$bs_lat = $row ['location_latitude'];
		$bs_long = $row ['location_longitude'];

	}
	else{
		header("Location: aManageBS.php");
	}

?>