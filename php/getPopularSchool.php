<?php 

include("dbconn.php");
error_reporting(0); //Ignore all Warning and Error Message
$sch_education_level ="";
$mostPop=array();

if(isset($_GET['sch_education_level'])){
	
	$sch_education_level = $_GET['sch_education_level'];
	
	if ($sch_education_level==""){
		$query1 = "SELECT s.sch_name,sch_education_level,f.sch_id, avg(fb_rating) as avg_rating,COUNT(*) as comment_count FROM Feedback f, School s where s.sch_id=f.sch_id  GROUP BY sch_id ORDER BY avg_rating DESC LIMIT 20 ";
	}else{
		$query1 = "SELECT s.sch_name,sch_education_level,f.sch_id, avg(fb_rating) as avg_rating,COUNT(*) as comment_count FROM Feedback f, School s where s.sch_id=f.sch_id and sch_education_level='$sch_education_level' GROUP BY sch_id ORDER BY avg_rating DESC LIMIT 20 ";
	}
}


//get top 20 sch_id of most number of fb_rating/fb_comment and avg fb_rating
$result1 = mysqli_query($link,$query1) or die(mysqli_error());
while($row = mysqli_fetch_assoc($result1))
{
	array_push($mostPop,$row);
}
//===========================================================================

//if same avg fb_rating, compare the highest fb_rating and its count
$mostRate = array();
for($i =0; $i<sizeof($mostPop);$i++)
{
	//if (!(($i+1) >= sizeof($mostPop)))
	for($j = 0; $j<sizeof($mostPop);$j++)	
	{
		if (($mostPop[$i]['avg_rating']) == ($mostPop[$j]['avg_rating']) && ($i!=$j))
		{
			//count number of people who rate 5 star
			
			$query3= "SELECT s.sch_name,sch_education_level,f.sch_id,f.fb_rating, COUNT(*) as highestRate_count FROM Feedback f, School s WHERE f.sch_id=s.sch_id and s.sch_id = ".$mostPop[$i]['sch_id']." GROUP BY fb_rating ORDER BY fb_rating DESC LIMIT 1;";
			$result3 = mysqli_query($link,$query3) or die(mysqli_error($link));
			while($row = mysqli_fetch_assoc($result3))
			{
				array_push($mostRate,$row);
			}
			
			$query4= "SELECT s.sch_name,sch_education_level,f.sch_id,f.fb_rating, COUNT(*) AS rating_count FROM Feedback f, School s WHERE f.sch_id=s.sch_id and f.sch_id = ".$mostPop[$j]['sch_id']." GROUP BY fb_rating ORDER BY fb_rating DESC LIMIT 1;";
			$result4 = mysqli_query($link,$query4) or die(mysqli_error($link));
			while($row = mysqli_fetch_assoc($result4))
			{
				array_push($mostRate,$row);
			}
		}
	}
}

//combine array($mostPop - sch_id, avg(fb_rating) and $mostRate - sch_id, fb_rating and count of fb_rating) via sch_id and sort according to avg(fb_rating followed by highest fb_rating then count)
foreach($mostPop as $key => $value){
    foreach($mostRate as $value2){
        if(($value['sch_id'] === $value2['sch_id']) && !empty($value2['rating_count'])){
			$mostPop[$key]['sch_education_level'] = $value2['sch_education_level'];
			$mostPop[$key]['sch_name'] = $value2['sch_name'];
			$mostPop[$key]['fb_rating'] = $value2['fb_rating'];
            $mostPop[$key]['rating_count'] = $value2['rating_count'];
			$ratingCount[$key] = $value2['rating_count'];
			
        }   
			$rateAvg[$key] = $value['avg_rating'];  
			$rating[$key]  = $value2['fb_rating'];
			
    }		
	array_multisort($rateAvg, SORT_DESC, $rating, SORT_DESC, $mostPop);
}
$limitTop5 = array_slice($mostPop, 0, 5); 


/*/sort according to rating then count
foreach ($mostRate as $key =>$count) {
	$rating[$key]  = $count['fb_rating'];
    $totalNo[$key] = $count['rating_count'];
	array_multisort($rating, SORT_DESC,	$totalNo, SORT_DESC, $mostRate);
	//array_multisort($rating, SORT_DESC,$mostRate);
}*/

echo json_encode($limitTop5)	
?>