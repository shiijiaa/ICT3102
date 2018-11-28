<?php 
session_start();
date_default_timezone_set("asia/singapore");
$dateTime =  date("Y-m-d") ." ". date("H:i:s");

include ("dbconn.php");
if( isset($_POST['location_id']) && isset($_POST['location_address'])  
	&&  isset($_POST['location_latitude']) &&  isset($_POST['location_longtitude'])
	&& isset($_POST['user_id']) && isset($_POST['blackspot_id']) ){
	
		
	if($_POST['submit']=='Cancel'){
		header('Location: '.'../school.php');
	}
	else{
	$location_id = $_POST['location_id'];
	$blackspot_id = $_POST['blackspot_id'];
	$user_id = $_POST['user_id'];
	
	$location_address = $_POST['location_address'];
	$location_latitude = $_POST['location_latitude'];
	$location_longtitude = $_POST['location_longtitude'];
	$dest = "../editBS.php?bs_id=$blackspot_id&location_id=$location_id";
	
	//-------------------------------------------------------
	

	$queryLocation = "UPDATE `Location` SET 
	`location_address` = '$location_address',
	`location_latitude` = '$location_latitude', 
	`location_longitude` = '$location_longtitude' 
	WHERE `Location`.`location_id` = $location_id;";

	
	$queryUpload = "UPDATE `Upload` SET `last_modified_user_id` = '$user_id', `last_modified_date` = '$dateTime' WHERE location_id = $location_id";
	
	$queryBS ="UPDATE `Blackspot` SET `location_id` = '$location_id' WHERE `Blackspot`.`blackspot_id` = '$blackspot_id';";
	
	$location_result= mysqli_query($link, $queryLocation) or die(mysqli_error($link));
	$upload_result= mysqli_query($link, $queryUpload) or die(mysqli_error());
	$bs_result= mysqli_query($link, $queryBS) or die(mysqli_error());
	
	if( $location_result && $upload_result && $bs_result ){
		$_SESSION['info']="You have successfully update the Blackspot ";
		$_SESSION['passFail']=1;
		echo "Pass";
		header('location:'.$dest );	
	}
	else{
		
		$_SESSION['info']="Unable to update the Blackspot  ";
		$_SESSION['passFail']=0;
		echo "Fail";
		header('location:'.$dest );	
	}
	
		
	}
	

}
else{
	echo "Never meet the requirement";
}




?>