<?php 

include("dbConn.php");
//Decalre message
$login_validation=0;
$login_message="";
$directLinkTo='';
//Check
if(isset($_POST['login-email']) && isset($_POST['login-password'])){
	$login_email = $_POST['login-email'];
	$login_password = $_POST['login-password'];
	
	$login_queryCheck ="select * from User where user_email = '$login_email' and user_password=SHA1('$login_password') ";
	$login_resultCheck = mysqli_query($link,$login_queryCheck);

	if(mysqli_num_rows($login_resultCheck)==1) {
		$login_validation=1;
		$login_row = mysqli_fetch_array($login_resultCheck);
		
		if ($login_row['user_status']=='B'){
			$login_validation=-1;
			$login_message="Your account has been banned.";
		}
		else{
		
		
			//Fetch Row
			if (isset($_POST['rmbMe'])){
				setcookie("sl_user_id", $login_row['user_id'], time() +(60*60*24 *365), "/"); //30 DAY
				setcookie("sl_user_name", $login_row['user_name'], time() +(60*60*24 *365), "/"); //30 DAY
				setcookie("sl_user_birthdate", $login_row['user_birthdate'], time() +(60*60*24 *365), "/"); //30 DAY
				setcookie("sl_user_email", $login_row['user_email'], time() +(60*60*24 *365), "/"); //30 DAY
				setcookie("sl_user_role", $login_row['user_role'], time() +(60*60*24 *365), "/"); //30 DAY
				setcookie("sl_user_violation", $login_row['user_violation'], time() +(60*60*24 *365), "/"); //30 DAY
				setcookie("sl_user_gender", $login_row['user_gender'], time() +(60*60*24 *365), "/"); //30 DAY
				setcookie("sl_user_password", $login_row['user_password'], time() +(60*60*24 *365), "/"); //30 DAY
				setcookie("sl_user_status", $login_row['user_status'], time() +(60*60*24 *365), "/"); //30 DAY
				
			}
			else{
				
				$_SESSION['sl_user_id'] = $login_row['user_id'];
				$_SESSION['sl_user_name'] = $login_row['user_name'];
				$_SESSION['sl_user_birthdate'] = $login_row['user_birthdate'];
				$_SESSION['sl_user_email'] = $login_row['user_email'];
				$_SESSION['sl_user_role'] = $login_row['user_role'];
				$_SESSION['sl_user_status'] = $login_row['user_status'];
				$_SESSION['sl_user_violation'] = $login_row['user_violation'];
				$_SESSION['sl_user_gender'] = $login_row['user_gender'];
				$_SESSION['sl_user_password'] = $login_row['user_password'];
				
			}

				
			//Update Last login_date
			$todayDate = date('Y-m-d');
			$login_updateLoginDate_query="UPDATE `User` SET  `user_last_login` = '$todayDate' , user_status='A'  WHERE user_email='$login_email' ";
			$updateLoginDate_result = mysqli_query($link, $login_updateLoginDate_query) or die(mysqli_error());

			switch($login_row['user_role']){
				case "A":
				$directLinkTo= "adminHomePage.php";
				break;

				case "U":
				$directLinkTo= "index.php";
				break;	
			}


			header("Location: $directLinkTo");
		}
		
		
	}
	else{
		$login_validation=-1;
		$login_message="Invalid email or password. Please try again.";

	}
}

?>