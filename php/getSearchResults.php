<?php
	include 'dbConn.php';
	
	$name = addslashes($_GET['name']);
	if($name != "") {
		$search_sql="SELECT sch_name FROM School WHERE sch_name LIKE '%".$name."%' LIMIT 3;";
		
		$search = mysqli_query($link, $search_sql);
		$rowcount=mysqli_num_rows($search);
		
		$searchList = array();
		while($row = mysqli_fetch_assoc($search)) {
			$searchList[] = $row;
		}
		
		if ($rowcount > 0) {
			for ($i = 0; $i < $rowcount; $i++) {
				echo '<div class="searchResult col-xs-12">';
				echo $searchList[$i]['sch_name'];
				echo '</div>';
			}
		}
		else {
			echo "No suggestions found!";
		}
	}
	
	mysqli_close($link);
?>