<?php
	include 'dbConn.php';
	
	$name = mysqli_real_escape_string($link, $_GET['name']);
	$rating = mysqli_real_escape_string($link, $_GET['rating']);
	$comment = mysqli_real_escape_string($link, $_GET['comment']);
	$userID = mysqli_real_escape_string($link, $_GET['userID']);
	$date = date("Y-m-d H:i:s");
	
	$id_sql="SELECT sch_id FROM School WHERE sch_name = '".$name."'";
	$result = mysqli_query($link, $id_sql);
	$row = mysqli_fetch_assoc($result);
	$schoolID = $row["sch_id"];

	$insert_sql="INSERT INTO Feedback (
	fb_rating, 
	fb_comment, 
	fb_date,  
	fb_flag, 
	user_id, 
	sch_id) 
	VALUES (
	".$rating.", 
	'".$comment."', 
	'".$date."', 
	0, 
	".$userID.", 
	".$schoolID."
	)";
	
	$insert = mysqli_query($link, $insert_sql);
	
	if ($insert) {
		echo '
		<p>Thank you for providing feedback!</p>
		';
	} else {
		echo '
		<p>Something went wrong! Please try again!</p>
		';
	}
	
	mysqli_close($link);
?>