<?php 
session_start();
include ("dbconn.php");
if( isset($_POST['user_role']) && isset($_POST['acc_id']) ){
	$ar = $_POST['user_role'];
	$aid	 = $_POST['acc_id'];
	$updateStatus = "";
	if (strcasecmp($ar, "Admin") == 0) {
		$updateStatus = "A";
	}else{
		$updateStatus = "U";
	}
	
	$dest = "../editAccount.php?acc_id=$aid";

	//-------------------------------------------------------
	

	$queryRole= "UPDATE User SET user_role='$ar' WHERE user_id='$aid';";
	$roleResult= mysqli_query($link, $queryRole) or die(mysqli_error());

	if( $roleResult ){
		$_SESSION['info']="You have successfully update the user role ";
		$_SESSION['passFail']=1;
		echo "pass";
		header('location:'.$dest );	
	}
	else{
		
		$_SESSION['info']="Unable to update the user role ";
		$_SESSION['passFail']=0;
		echo "Fail";
		header('location:'.$dest );	
	}
		
	}
	
else{
	echo "Never meet the requirement";
}




?>