<?php 
include("dbconn.php");
	if(isset($_GET['fac_id'])){
		$facID = $_GET['fac_id'];
		$query = "select * from Facility f,Location l where f.location_id = l.location_id and facility_id=$facID";
		$result = mysqli_query($link,$query) or die(mysqli_error());
		$row = mysqli_fetch_assoc($result);
		$fac_id =$row ['facility_id'];
		$fac_name = $row ['facility_name'];
		$fac_cate = $row ['facility_category'];
		$fac_add = $row ['location_address'];
		$fac_postal = $row ['location_postalcode'];
		$fac_lat = $row ['location_latitude'];
		$fac_long = $row ['location_longitude'];

	}
	else{
		header("Location: aManageFac.php");
	}

?>