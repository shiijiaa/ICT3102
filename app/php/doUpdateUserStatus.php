<?php 
include ("dbconn.php");
date_default_timezone_set("asia/singapore");
$y = date("Y")-1;
$dateTime =  $y."-".date("m-d") ." ". date("H:i:s");
//echo $dateTime;
$query= "UPDATE `User` SET `user_status` = 'I' WHERE  '$dateTime'>`User`.`user_last_login` and  `user_status` != 'B';";
$result = mysqli_query($link,$query)  or die(mysqli_error());;

?>
