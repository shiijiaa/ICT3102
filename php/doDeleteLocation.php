<?php 
//Have to modify 
session_start();
include("dbconn.php");
$directTo ="";
$typeName ="";

if(isset($_POST['location_id']) && isset($_POST['deleteName']) && isset($_POST['deleteType'])){
	
	//Delete Type Switch Statement
	//Other
	$location_id = $_POST['location_id'];

	$deleteName = $_POST['deleteName'];
	$deleteType =  $_POST['deleteType'];
	$query = "DELETE FROM `Location` WHERE location_id = $location_id";
	$result = mysqli_query($link,$query) or die(mysqli_error($link));;

	if($result){
			$_SESSION['info']="You have successfully delete $deleteName. ";
			$_SESSION['passFail']=1;

			
	}
	else{
			$_SESSION['info']="Unable to delete $deleteName!";
			$_SESSION['passFail']=0;
			
	}
	if(strcasecmp($deleteType,"School")==0){
		header('location: ../aManage.php');
	}
	else if(strcasecmp($deleteType,"BS")==0){
		header('location: ../aManageBS.php');
	}
	else if(strcasecmp($deleteType,"Fac")==0){
		header('location: ../aManageFac.php');
	}

	
	//Back to previous page
	//header('location: ../adminHomePage.php');
}
?>