<?php
	include 'dbConn.php';
	
	$id = mysqli_real_escape_string($link, $_GET['id']);
	
	$id_sql="UPDATE Feedback SET fb_flag = fb_flag + 1 WHERE fb_id = ".$id."";
	$increment = mysqli_query($link, $id_sql);
	
	if ($increment) {
		echo '
		<p>This comment has been flagged for review.</p>
		';
	} else {
		echo '
		<p>Something went wrong! Please try again!</p>
		';
	}
	
	mysqli_close($link);
?>