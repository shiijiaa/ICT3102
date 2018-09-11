<?php 
session_start();
include ("dbconn.php");

date_default_timezone_set("asia/singapore");
$dateTime =  date("Y-m-d") ." ". date("H:i:s");

if(isset($_POST['location_latitude']) && isset($_POST['location_longtitude'])
	){
	echo "pass";
}

if( isset($_POST['location_id']) && isset($_POST['location_address']) && isset($_POST['location_postalcode']) 
	&&  isset($_POST['location_latitude']) && isset($_POST['location_longtitude'])
	&&  isset($_POST['sch_name']) && isset($_POST['sch_educaiton_level']) 
	&& isset($_POST['user_id']) && isset($_POST['sch_id']) ){
		

	$location_id = $_POST['location_id'];
	$sch_id = $_POST['sch_id'];
	$user_id = $_POST['user_id'];
	
	$location_address = $_POST['location_address'];
	$location_postalcode = $_POST['location_postalcode'];
	$user = $_POST['user_id'];
	$location_latitude = $_POST['location_latitude'];
	$location_longtitude = $_POST['location_longtitude'];
	$sch_name = $_POST['sch_name'];
	$sch_educaiton_level = $_POST['sch_educaiton_level'];
	$dest = "../editSchool.php?sch_id=$sch_id&location_id=$location_id";
	
	//------------------------------------------------------
	$queryLocation = "UPDATE `Location` SET 
	`location_address` = '$location_address', 
	`location_postalcode` = '$location_postalcode', 
	`location_latitude` = '$location_latitude', 
	`location_longitude` = '$location_longtitude' 
	WHERE `Location`.`location_id` = '$location_id';";
	

	
	$queryUpload = "UPDATE `Upload` SET `last_modified_user_id` = '$user_id', `last_modified_date` = '$dateTime' WHERE location_id = $location_id";
	
	$querySchool ="UPDATE `School` SET `sch_name` = '$sch_name', `sch_education_level` = '$sch_educaiton_level' 
	WHERE `School`.`sch_id` = $sch_id;";
	
	$location_result= mysqli_query($link, $queryLocation) or die(mysqli_error($link));
	$upload_result= mysqli_query($link, $queryUpload) or die(mysqli_error());
	$school_result= mysqli_query($link, $querySchool) or die(mysqli_error());
	
	
	if( $location_result && $upload_result && $school_result ){
		$_SESSION['info']="You have successfully update $sch_name ";
		$_SESSION['passFail']=1;
		echo "PASS";
		header('location:'.$dest );	
	}
	else{
		
		$_SESSION['info']="Unable to update  ";
		$_SESSION['passFail']=0;
		echo "Fail";
		header('location:'.$dest );	
	}
	
		

	

}
else{
		$_SESSION['info']="Something not fulfill";
		$_SESSION['passFail']=0;
		echo "something not fulfill";
}




?>