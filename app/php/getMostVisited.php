<?php 
include("dbconn.php");



if(isset($_GET['sch_education_level'])){
	$sch_education_level = $_GET['sch_education_level'];
	if ($sch_education_level==""){
		$query ="SELECT sch_name,visited FROM School  order by visited desc LIMIT 10";
	}else{
		$query ="SELECT sch_name,visited FROM School where sch_education_level='$sch_education_level'  order by visited desc LIMIT 10";
	}
	
}

	




$result = mysqli_query($link,$query) or die(mysqli_error($link));
$visitedArr=array();
while($row = mysqli_fetch_assoc($result))
	{
		array_push($visitedArr,$row);
	}

echo json_encode($visitedArr)	
//print_r($visitedArr);
?>