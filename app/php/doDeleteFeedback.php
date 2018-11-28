<?php 
//Have to modify 
session_start();
include("dbconn.php");
$directTo ="index.php";
	if(isset($_POST['linkLocation'])){
		$directTo = $_POST['linkLocation'];
	}
	if($_POST['submit']=='Ignore'){
		if(isset($_POST['fb_id'])){
		$fb_id = $_POST['fb_id'];
		$queryFlag= "UPDATE `Feedback` SET `fb_flag` = '0' WHERE `Feedback`.`fb_id` = $fb_id;";
		$flagResult = mysqli_query($link,$queryFlag) or die(mysqli_error());
		if($flagResult){
			$_SESSION['info']="You have successfully unflag the Feedback. ";
			$_SESSION['passFail']=1;
		}
		}
		else{
			$_SESSION['info']="Unable to unflag this comment";
			$_SESSION['passFail']=1;
		}
		
		}
	
	elseif($_POST['submit']=='Delete'){
		if(isset($_POST['user_id']) && isset($_POST['fb_id']) && isset($_POST['user_violation']) ){
			$user_id = $_POST['user_id'];
			$fb_id = $_POST['fb_id'];
			$user_violation = $_POST['user_violation'];
			
			$query = "DELETE FROM `Feedback` WHERE fb_id = $fb_id";
			$result = mysqli_query($link,$query);
			
			if($result){
				echo "before:".$user_violation;
			$user_violation+=1;
			echo "after:".$user_violation;
			$userQuery = "UPDATE `User` SET `user_violation` ='$user_violation'  WHERE `User`.`user_id` = '$user_id';";
			$userResult = mysqli_query($link,$userQuery);
			
			if($userResult){
				$_SESSION['info']="You have successfully delete the Feedback. ";
				$_SESSION['passFail']=1;
				
				//--------Check and ban------------------------------
				if($user_violation>=3){
					$userVolationQuery = "UPDATE `User` SET `user_status` = 'B' WHERE `User`.`user_id` = $user_id and user_violation>=3 ;";
					$userVolationResult = mysqli_query($link,$userVolationQuery) or die(mysqli_error());
				}
				
				}
				else{
						$_SESSION['info']="Unable to update  the user violation!";
						$_SESSION['passFail']=0;
					
						
				}
				
			}
			else{
					$_SESSION['info']="Unable to delete the feedback!";
					$_SESSION['passFail']=0;
				
			}
	}

	}
	else{
		echo "Never meet requirement";
		exit();
	}
	header('location: ../'.$directTo);
	
	
?>