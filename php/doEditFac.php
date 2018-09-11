<?php 
session_start();
date_default_timezone_set("asia/singapore");
$dateTime =  date("Y-m-d") ." ". date("H:i:s");

include ("dbconn.php");
if( isset($_POST['location_id']) && isset($_POST['location_address']) && isset($_POST['location_postalcode']) 
	&&  isset($_POST['location_latitude']) && isset($_POST['location_longtitude'])
	&&  isset($_POST['facility_name']) && isset($_POST['facility_category'])
	&& isset($_POST['user_id']) && isset($_POST['facility_id']) ){
		
	if($_POST['submit']=='Cancel'){
		header('Location: '.'../school.php');
	}
	else{
	$location_id = $_POST['location_id'];
	$facility_id = $_POST['facility_id'];
	$user_id = $_POST['user_id'];
	$location_latitude = $_POST['location_latitude'];
	$location_longtitude = $_POST['location_longtitude'];
	
	$location_address = $_POST['location_address'];
	$location_postalcode = $_POST['location_postalcode'];
	$facility_name = $_POST['facility_name'];
	$facility_category = $_POST['facility_category'];
	$dest = "../editFac.php?fac_id=$facility_id&location_id=$location_id";
	
	//-------------------------------------------------------
	

	$queryLocation = "UPDATE `Location` SET 
	`location_address` = '$location_address', 
	`location_postalcode` = '$location_postalcode', 
	`location_latitude` = '$location_latitude', 
	`location_longitude` = '$location_longtitude'
	WHERE `Location`.`location_id` = $location_id;";

	
	$queryUpload = "UPDATE `Upload` SET `last_modified_user_id` = '$user_id', `last_modified_date` = '$dateTime' WHERE location_id = $location_id";
	
	$querySchool ="UPDATE `Facility` SET 
	`facility_name` = '$facility_name', `facility_category` = '$facility_category' 
	WHERE `Facility`.`facility_id` = '$facility_id';";
	
	$location_result= mysqli_query($link, $queryLocation) or die(mysqli_error($link));
	$upload_result= mysqli_query($link, $queryUpload) or die(mysqli_error());
	$school_result= mysqli_query($link, $querySchool) or die(mysqli_error());
	
	if( $location_result && $upload_result && $school_result ){
		$_SESSION['info']="You have successfully update $facility_name ";
		$_SESSION['passFail']=1;
		header('location:'.$dest );	
		
	}
	else{
		
		$_SESSION['info']="Unable to create  ";
		$_SESSION['passFail']=0;
		header('location:'.$dest );	
	}
	
		
	}
	

}
else{
	echo "never fulfill";
}




?>