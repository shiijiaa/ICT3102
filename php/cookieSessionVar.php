<?php 
session_start();

$user_id ="";
$user_role="";

if (isset($_SESSION['sl_user_id'])){
	$user_id =$_SESSION['sl_user_id'];
	$user_name= $_SESSION['sl_user_name'];
	$user_birthdate=$_SESSION['sl_user_birthdate'];
	$user_email=$_SESSION['sl_user_email'];
	$user_role=$_SESSION['sl_user_role'];
	$user_status=$_SESSION['sl_user_status'];
	$user_violation = $_SESSION['sl_user_violation'];
	$user_gender=$_SESSION['sl_user_gender'];
} 
else if (isset($_COOKIE['sl_user_id']) ){
	$user_id =$_COOKIE['sl_user_id'];
	$user_name= $_COOKIE['sl_user_name'];
	$user_birthdate=$_COOKIE['sl_user_birthdate'];
	$user_email=$_COOKIE['sl_user_email'];
	$user_role=$_COOKIE['sl_user_role'];
	$user_status=$_COOKIE['sl_user_status'];
	$user_violation = $_COOKIE['sl_user_violation'];
	$user_gender=$_COOKIE['sl_user_gender'];
}
?>