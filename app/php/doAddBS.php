<?php 
session_start();
date_default_timezone_set("asia/singapore");
$dateTime =  date("Y-m-d") ." ". date("H:i:s");

include ("dbconn.php");
if(isset($_POST['location_address']) && isset($_POST['user_id'])
	&&  isset($_POST['location_latitude']) && $_POST['location_longtitude']
	){
		
	if($_POST['submit']=='Cancel'){
		header('Location: '.'../school.php');
	}
	
	else{
	$location_address = $_POST['location_address'];
	$location_latitude = $_POST['location_latitude'];
	$location_longtitude = $_POST['location_longtitude'];
	$user_id = $_POST['user_id'];
	
	
//---------------------------Query--------------------------------------------------

	$queryLocation = "INSERT INTO `Location` (`location_id`, `location_address`, `location_postalcode`, `location_latitude`, `location_longitude`) 
	VALUES (NULL, '$location_address', '', '$location_latitude', '$location_longtitude');";
	$location_result= mysqli_query($link, $queryLocation) or die(mysqli_error($link));

	
	if($location_result){
		echo "here4";
		$location_id = mysqli_insert_id($link);
		
		//=================Query ==========================

		$queryUpload = "INSERT INTO `Upload` (`user_id`, `upload_date`, `last_modified_user_id`, `last_modified_date`, `location_id`) 
		VALUES ('$user_id', '$dateTime', '$user_id', '$dateTime', '$location_id');";
		$queryBS = "INSERT INTO `Blackspot` (`blackspot_id`, `location_id`) VALUES (NULL, '$location_id');";

		
		$upload_result= mysqli_query($link, $queryUpload);
		$bs_result= mysqli_query($link, $queryBS) or die(mysqli_error());
		$bs_id = mysqli_insert_id($link);
		
		//=================Result==================================
		if($bs_result && $upload_result){
			$_SESSION['info']="You have successfully created new BlackSpot ";
			$_SESSION['passFail']=1;
			header('location: bsDetail.php?bs_id='.$bs_id);			
		}
		else{
			$_SESSION['info']="Unable to create  ";
			$_SESSION['passFail']=0;
			header('location: addBS.php');
		}
	}
	else{
		$_SESSION['info']="Unable to create  ";
		$_SESSION['passFail']=0;
		header('location: addBS.php');
	}

		
	}
	

}




?>