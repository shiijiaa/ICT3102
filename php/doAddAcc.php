<?php 
session_start();
include ("dbconn.php");
date_default_timezone_set("asia/singapore");
$dateTime =  date("Y-m-d") ." ". date("H:i:s");
$reg_message='';
$reg_validation=0;

if(
isset($_POST['reg_email']) && 
isset($_POST['reg_password']) &&
isset($_POST['reg_full_name']) &&
isset($_POST['reg_gender']) &&
isset($_POST['reg_birthday']) &&
isset($_POST['user_role']) 
)

{
$user_email = 	$_POST['reg_email'];
$user_password = $_POST['reg_password'];
$user_name =$_POST['reg_full_name'];
$user_gender = $_POST['reg_gender'];
$user_birthdate = $_POST['reg_birthday'];
$user_role =$_POST['user_role'];


//Check if existed
$reg_checkQuery ="select user_email from User where user_email = '$user_email'" ;
$reg_checkStatus = mysqli_query($link, $reg_checkQuery);
$reg_checkRow= mysqli_fetch_row($reg_checkStatus);


if(count($reg_checkRow)>0){
	$_SESSION['info']="An account already exists with this email, please select another email address. ";
	$_SESSION['passFail']=0;
	header('location: ../addAcc.php');		

}
else{
	
	$query ="INSERT INTO `User` 
	(`user_id`, `user_email`, `user_password`, `user_name`, `user_gender`, `user_birthdate`, `user_role`, `user_violation`, `user_status`, `user_last_login`)
	 VALUES (NULL, '$user_email', SHA1('$user_password'), '$user_name', '$user_gender', '$user_birthdate', '$user_role', '0', 'I', '1000-01-01');";
	 $result= mysqli_query($link, $query);
	 $acc_id = mysqli_insert_id($link);
	 if($result){
		 $_SESSION['info']="You've successfully register a new account ";
		 $_SESSION['passFail']=1;
		 header('location: ../accountDetail.php?acc_id='.$acc_id);	

	 }
	 else{
		$_SESSION['info']="Unable to create a new account";
		$_SESSION['passFail']=0;
		header('location: ../addAcc.php');	

	 }	
}
}

?>