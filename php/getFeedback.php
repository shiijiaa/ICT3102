<?php
	include 'dbConn.php';
	
	$limit = 5;
	$page = addslashes($_GET['page']);
	$name = addslashes($_GET['name']);
	$offset = ($page - 1) * $limit;
	
	$page_sql="SELECT COUNT(fb_id) as total 
	FROM Feedback 
	INNER JOIN School ON Feedback.sch_id = School.sch_id 
	WHERE School.sch_name = '".$name."'
	";
	
	$result = mysqli_query($link, $page_sql);
	$row = mysqli_fetch_assoc($result);
	$total = $row['total'];
	
	$max_pages = ceil($total / $limit);
	
	$rating_sql="SELECT 
	AVG(fb_rating) as avgRating
	FROM Feedback 
	INNER JOIN School ON Feedback.sch_id = School.sch_id 
	WHERE School.sch_name = '".$name."'
	";
	
	$rating = mysqli_query($link, $rating_sql);
	$row = mysqli_fetch_assoc($rating);
	$avgRating = $row['avgRating'];
	
	echo '<div id="locationAverageRating" class="col-xs-12">';
	if ($avgRating > 0) {
		echo round($avgRating * 2) / 2;
	}
	echo '</div>';
	
	$feedback_sql="SELECT 
	Feedback.fb_id, 
	Feedback.fb_rating, 
	Feedback.fb_comment, 
	Feedback.fb_date, 
	User.user_name
	FROM Feedback 
	INNER JOIN School ON Feedback.sch_id = School.sch_id 
	INNER JOIN User ON Feedback.user_id = User.user_id 
	WHERE School.sch_name = '".$name."' 
	ORDER BY Feedback.fb_date DESC 
	LIMIT ".$offset.", ".$limit." 
	";
	
	$feedback = mysqli_query($link, $feedback_sql);
	$rowcount = mysqli_num_rows($feedback);
	
	$feedbackList = array();
	while($row = mysqli_fetch_assoc($feedback)) {
		$feedbackList[] = $row;
	}
	
	if ($rowcount > 0) {
		for ($i = 0; $i < $rowcount; $i++) {
			echo '<div class="feedback col-xs-12">';
			
				echo '<div class="feedbackHeader col-xs-12">';
				
					echo '<div class="feedbackUser col-xs-5">';
					echo $feedbackList[$i]['user_name'];
					echo '</div>';
					
					echo '<div class="feedbackDetails col-xs-4">';
					echo $feedbackList[$i]['fb_date'];
					echo '</div>';
					
					echo '<div class="feedbackRating col-xs-2">Rating: ';
					echo $feedbackList[$i]['fb_rating'];
					echo '</div>';
					
					
					echo "<div class=\"feedbackFlag\" name=\"".$feedbackList[$i]['fb_id']."\" col-xs-1\">";
					echo '<i class="fa fa-flag" aria-hidden="true"></i>';
					echo '</div>';
				
				echo '</div>';
				
				echo '<div class="feedbackComment col-xs-12">';
				echo $feedbackList[$i]['fb_comment'];
				echo '</div>';
			
			echo '</div>';
		}
		echo '<div id="paging" class="col-xs-12">';
			echo '<div id="previousButton" class="col-xs-4">';
			if ($page > 1) {
				$previous_page = $page - 1;
				echo "<a href=\"javascript:getFeedback('".$name."', ".$previous_page.")\" class=\"btn btn-info\" role=\"button\">Previous</a>";
			} else {
				echo "<a href=\"#\" class=\"btn btn-info disabled\" role=\"button\">Previous</a>";
			}
			echo '</div>';
			
			echo '<div id="currentPage" class="col-xs-4">';
			echo "Page ".$page." of ".$max_pages."";
			echo '</div>';
			
			echo '<div id="nextButton" class="col-xs-4">';
			if ($page < $max_pages) {
				$next_page = $page + 1;
				echo "<a href=\"javascript:getFeedback('".$name."' , ".$next_page.")\" class=\"btn btn-info\" role=\"button\">Next</a>";
			} else {
				echo "<a href=\"#\" class=\"btn btn-info disabled\" role=\"button\">Next</a>";
			}
			echo '</div>';
		echo '</div>';
	}
	else {
		echo "<p>This school does not have any feedback yet! Be the first!</p>";
	}
	
	mysqli_close($link);
?>