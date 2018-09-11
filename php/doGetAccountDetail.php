<?php 
include("dbconn.php");
	if(isset($_GET['acc_id'])){
		$accID = $_GET['acc_id'];
		$query = "select * from User where user_id = $accID";
		$result = mysqli_query($link,$query) or die(mysqli_error());
		$row = mysqli_fetch_assoc($result);
		$acc_id =$row ['user_id'];
		$acc_name = $row ['user_name'];
		$acc_email= $row ['user_email'];
		$acc_gender = $row ['user_gender'];
		$acc_birthdate = $row ['user_birthdate'];
		$acc_role = $row ['user_role'];
		$acc_violation = $row ['user_violation'];
		$acc_status = $row ['user_status'];
		$acc_last_login = $row ['user_last_login'];
		
		if (strcasecmp($acc_gender, "F") == 0) {
			$acc_gender = "Female";
		}else{
			$acc_gender = "Male";
		}
		
		if (strcasecmp($acc_role, "A") == 0) {
			$acc_role = "Admin";
		}else if (strcasecmp($acc_role, "U") == 0){
			$acc_role = "User";
		}
		
		if (strcasecmp($acc_status, "B") == 0) {
			$acc_status = "Banned";
		}
		else if(strcasecmp($acc_status, "I") == 0) {
			$acc_status = "Inactive";
		}
		else{
			$acc_status = "Active";
		}

	}
	else{
		header("Location: aManage.php");
	}

?>