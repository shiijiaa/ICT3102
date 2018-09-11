<?php 
//Have to modify 
session_start();
include("dbconn.php");
$directTo ="";
$typeName ="";

if(isset($_POST['user_id']) &&  isset($_POST['user_name'])){
	
	//Delete Type Switch Statement
	//Other
	$user_id = $_POST['user_id'];
	$user_name = $_POST['user_name'];
	$query = "DELETE FROM `User` WHERE user_id = $user_id";
	$result = mysqli_query($link,$query);
	if($result){
			$_SESSION['info']="You have successfully delete $user_name . ";
			$_SESSION['passFail']=1;
			
	}
	else{
			$_SESSION['info']="Unable to delete the user!";
			$_SESSION['passFail']=0;
			
	}
}
?>