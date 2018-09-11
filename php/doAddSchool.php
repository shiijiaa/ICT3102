<?php 
session_start();
date_default_timezone_set("asia/singapore");
$dateTime =  date("Y-m-d") ." ". date("H:i:s");

include ("dbconn.php");
if(isset($_POST['location_address']) && isset($_POST['location_postalcode']) 
	&&  isset($_POST['location_latitude']) && isset($_POST['location_longtitude'])
	&&  isset($_POST['sch_name']) &&  isset($_POST['sch_educaiton_level']) 
	&& isset($_POST['user_id'])
	){

	
	
	$location_address = $_POST['location_address'];
	$location_postalcode = $_POST['location_postalcode'];
	$user = $_POST['user_id'];
	$location_latitude = $_POST['location_latitude'];
	$location_longtitude = $_POST['location_longtitude'];
	$sch_name = $_POST['sch_name'];
	$sch_educaiton_level = $_POST['sch_educaiton_level'];
	$uid = $_POST['user_id'];
	
	
//---------------------------Query--------------------------------------------------

	$queryLocation = "INSERT INTO `Location` (`location_id`, `location_address`, `location_postalcode`, `location_latitude`, `location_longitude`) 
	VALUES (NULL, '$location_address', '$location_postalcode', '$location_latitude', '$location_longtitude');";
	$location_result= mysqli_query($link, $queryLocation);
	
	if($location_result){
		$location_id = mysqli_insert_id($link);
		
		//=================Query ==========================
		$queryUpload = "INSERT INTO `Upload` (`user_id`, `upload_date`, `last_modified_user_id`, `last_modified_date`, `location_id`) 
		VALUES ('$uid ', '$dateTime', '$uid ', '$dateTime', '$location_id');";
		$querySchool = "INSERT INTO `School` (`sch_id`, `sch_name`, `sch_education_level`, `visited`,`location_id`) 
		VALUES (NULL, '$sch_name', '$sch_educaiton_level',0 ,'$location_id');";
		
		$upload_result= mysqli_query($link, $queryUpload);
		$sch_result= mysqli_query($link, $querySchool) or die(mysqli_error());
		$sch_id = mysqli_insert_id($link);
		
		//=================Result==================================
		if($sch_result && $upload_result){
			$_SESSION['info']="You have successfully created $sch_name ";
			$_SESSION['passFail']=1;
			header('location: schoolDetail.php?sch_id='.$sch_id);			
		}
		else{

			$_SESSION['info']="Unable to creat new school";
			$_SESSION['passFail']=0;
			header('location: addSchool.php');
		}
	}
	else{
		$_SESSION['info']="Unable to create new school";
		$_SESSION['passFail']=0;
		header('location: addSchool.php');
	}
	
	}

?>