<?php 
session_start();

$user_id ="";
if (isset($_COOKIE['sl_user_id']) ){
	unset($_COOKIE['sl_user_id']);
	unset($_COOKIE['sl_user_name']);
	unset($_COOKIE['sl_user_birthdate']);
	unset($_COOKIE['sl_user_email']);
	unset($_COOKIE['sl_user_role']);
	unset($_COOKIE['sl_user_status']);
	unset($_COOKIE['sl_user_violation']);
	unset($_COOKIE['sl_user_gender']);
	unset($_COOKIE['sl_user_last_login']);
	
	setcookie("sl_user_id", "", time() -3600, '/'); 
	setcookie("sl_user_name", "", time()  -3600, '/'); 
	setcookie("sl_user_birthdate", "", time() -3600, '/'); 
	setcookie("sl_user_email", "", time()  -3600, '/'); 
	setcookie("sl_user_role", "", time()  -3600, '/'); 
	setcookie("sl_user_violation", "", time()  -3600, '/'); 
	setcookie("sl_user_gender", "", time()  -3600, '/'); 
	setcookie("sl_user_last_login", "", time()  -3600, '/'); 
}

else if (isset($_SESSION['sl_user_id'])){

	unset($_SESSION['sl_user_id']);
	unset($_SESSION['sl_user_name']);
	unset($_SESSION['sl_user_birthdate']);
	unset($_SESSION['sl_user_email']);
	unset($_SESSION['sl_user_role']);
	unset($_SESSION['sl_user_status']);
	unset($_SESSION['sl_user_violation']);
	unset($_SESSION['sl_user_gender']);
	unset($_SESSION['sl_user_last_login']);
	session_destroy();
	
}

header('Location: ../index.php');
?>