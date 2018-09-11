<?php
	include 'dbConn.php';
	
	$name = mysqli_real_escape_string($link, $_GET['name']);
	
	$visited_sql="UPDATE School SET visited = visited + 1 WHERE sch_name = '".$name."'";
	$increment = mysqli_query($link, $visited_sql);
	
	mysqli_close($link);
?>