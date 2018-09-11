<?php 
session_start();
include ("dbconn.php");

if(isset($_POST['user_id']) &&  isset($_POST['user_name'])){
	
	//Delete Type Switch Statement
	//Other
	$user_id = $_POST['user_id'];
	$user_name = $_POST['user_name'];
	$msg = "";
	$query ="";

	if(strcasecmp($_POST['submit'] ,'Ban')==0){
		$query = "UPDATE `User` SET `user_status` = 'B' WHERE `user_id` = $user_id;";
		$msg = "ban";
	}
	elseif (strcasecmp($_POST['submit'] ,'Unban')==0){
		$query = "UPDATE `User` SET `user_status` = 'A' WHERE `user_id` = $user_id;";
		$resetViolation ="UPDATE `User` SET `user_violation`='0' WHERE `user_id`='$user_id';";
		$resetResult = mysqli_query($link,$resetViolation) or die(mysqli_error());
		if(!$resetResult){
			$_SESSION['info']="Unable to reset violation to 0";
			$_SESSION['passFail']=1;
			exit();
		}
		$msg = "unban";
	}
	
	
	$result = mysqli_query($link,$query);
	if($result){
			$_SESSION['info']="You have successfully ".$msg. " $user_name . ";
			$_SESSION['passFail']=1;
			//echo "Pass";
			
	}
	else{
			$_SESSION['info']="Unable to".$msg." the user!";
			$_SESSION['passFail']=0;
			//echo "Fail";
			
	}
	
	header('location:'.'../aAccount.php' );	
}


?>