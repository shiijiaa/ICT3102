<?php 
session_start();
date_default_timezone_set("asia/singapore");
$dateTime =  date("Y-m-d") ." ". date("H:i:s");

include ("dbconn.php");
if(isset($_POST['location_address']) && isset($_POST['location_postalcode']) 
	&&  isset($_POST['location_latitude']) && $_POST['location_longtitude']
	&&  isset($_POST['facility_name']) && $_POST['facility_category']
	&& isset($_POST['user_id'])
	){
		
	if($_POST['submit']=='Cancel'){
		header('Location: '.'../school.php');
	}
	
	else{
	$location_address = $_POST['location_address'];
	$location_postalcode = $_POST['location_postalcode'];
	$location_latitude = $_POST['location_latitude'];
	$location_longtitude = $_POST['location_longtitude'];
	$facility_name = $_POST['facility_name'];
	$facility_category = $_POST['facility_category'];
	$user_id = $_POST['user_id'];
	
	
//---------------------------Query--------------------------------------------------
	$queryLocation = "INSERT INTO `Location` (`location_id`, `location_address`, `location_postalcode`, `location_latitude`, `location_longitude`) 
	VALUES (NULL, '$location_address', '$location_postalcode', '$location_latitude', '$location_longtitude');";
	$location_result= mysqli_query($link, $queryLocation);
	
	if($location_result){
		$location_id = mysqli_insert_id($link);
		
		//=================Query ==========================
		$queryUpload = "INSERT INTO `Upload` (`user_id`, `upload_date`, `last_modified_user_id`, `last_modified_date`, `location_id`) 
		VALUES ('$user_id', '$dateTime', '$user_id', '$dateTime', '$location_id');";
		$queryFac = "INSERT INTO `Facility` (`facility_id`, `facility_name`, `facility_category`, `location_id`) 
		VALUES (NULL, '$facility_name', '$facility_category', '$location_id');";
		
		
		$upload_result= mysqli_query($link, $queryUpload) or die(mysqli_error());
		$fac_result= mysqli_query($link, $queryFac) or die(mysqli_error());
		$fac_id = mysqli_insert_id($link);
		
		//=================Result==================================
		if($fac_result && $upload_result){
			$_SESSION['info']="You have successfully created $facility_name ";
			$_SESSION['passFail']=1;
			header('location: facDetail.php?fac_id='.$fac_id);			
		}
		else{

			if(!$upload_result){
				echo "<br>aaaaaaax2";
			}
			$_SESSION['info']="Unable to create";
			$_SESSION['passFail']=0;
			header('location: addFac.php');
		}
	}
	else{
		$_SESSION['info']="Unable to create  ";
		$_SESSION['passFail']=0;

		header('location: addFac.php');
	}
	
	
		
	}
	

}




?>